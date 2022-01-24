<?php namespace app\services;

use app\models\User;
use app\responses\AuthenticationResponse;
use bootstrap\services\DB;
use bootstrap\services\Locale;
use bootstrap\services\Mail;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;

class AuthenticationService {

    public static string $login_page = "/auth/login";
    public static string $client_page = "/client";

    public static function login(string $username, string $password, bool $remember) : AuthenticationResponse {
        $result = DB::table("accounts")->select()->where("username", $username)->first();

        if(empty($result))
            return new AuthenticationResponse(AuthenticationResponse::$USERNAME_INVALID);

        if(!password_verify($password, $result['password']))
            return new AuthenticationResponse(AuthenticationResponse::$PASSWORD_INVALID);

        $payload = [
            'id' => $result['id'],
            'username' => $result['username'],
            'email' => $result['email'],
            'locale' => $result['locale']
        ];
            
        Locale::setLocale($result['locale']);

        $token = JWT::encode($payload, app['jwt_key']);

        if($remember) {
            setcookie('usi', $token, time() + (10 * 365 * 24 * 60 * 60));
        }
        
        $_SESSION['usi'] = $token;

        return new AuthenticationResponse(AuthenticationResponse::$SUCCESS);
    }

    public static function register(string $username, string $email, string $password, string $repassword) : AuthenticationResponse {
        $usernameCheck = DB::table("accounts")->select(['id'])->where("username", $username)->first();
        if(!empty($usernameCheck))
            return new AuthenticationResponse(AuthenticationResponse::$USERNAME_TAKEN);

        $emailCheck = DB::table("accounts")->select(['id'])->where("email", $email)->first();
        if(!empty($emailCheck))
            return new AuthenticationResponse(AuthenticationResponse::$EMAIL_TAKEN);

        if(strlen($username) < 6)
            return new AuthenticationResponse(AuthenticationResponse::$USERNAME_SMALL);

        if($password != $repassword)
            return new AuthenticationResponse(AuthenticationResponse::$PASSWORDS_NOT_MATCH);

        if(strlen($password) < 4)
            return new AuthenticationResponse(AuthenticationResponse::$PASSWORD_SMALL);

        DB::table("accounts")->insert([
            "username" => $username,
            "email" => $email,
            "password" => password_hash($password, PASSWORD_DEFAULT),
            "locale" => app['fallback_locale'],
        ])->execute();;

        return new AuthenticationResponse(AuthenticationResponse::$SUCCESS);
    }

    public static function logout() {
        $_SESSION['usi'] = null;
        setcookie("usi", "", time()-3600);
    }

    public static function forgot(string $email) : AuthenticationResponse {                
        $token = self::generateToken();

        $url = app['url'];
        if(!str_ends_with($url, "/")) $url = $url."/";
        $url = $url . 'auth/reset?code=' . $token . '&email=' .$email;

        $response = Mail::send("Reset Your Password!", 'mail.reset-password', $email, ['url' => $url]);
        
        echo $response;

        if(!empty($response))
            return new AuthenticationResponse(AuthenticationResponse::$MAIL_ERROR);
        
        $tokenCheck = DB::table('reset_password')->select()->where('email', $email)->first();
        
        if (!empty($tokenCheck)) {
            DB::table('reset_password')->update(['token' => $token])->where('email', $email)->execute();
        }else{
            DB::table('reset_password')->insert(['email' => $email, 'token' => $token])->execute();
        }
        
        return new AuthenticationResponse(AuthenticationResponse::$SUCCESS);
    }
    
    public static function reset(string $email, string $token, string $password, string $repassword) : AuthenticationResponse {        
        $emailCheck = DB::table('reset_password')->select()->where('email', $email)->first();
        
        if (empty($emailCheck)) 
            return new AuthenticationResponse(AuthenticationResponse::$EMAIL_INVALID);
        
        if($emailCheck['token'] != $token)
            return new AuthenticationResponse(AuthenticationResponse::$TOKEN_INVALID);
        
        if(strlen($password) < 4)
            return new AuthenticationResponse(AuthenticationResponse::$PASSWORD_SMALL);
        
        if($password != $repassword)
            return new AuthenticationResponse(AuthenticationResponse::$PASSWORDS_NOT_MATCH);
        
        DB::table('reset_password')->delete()->where('email', $email)->execute();
        DB::table('accounts')->update(['password' => password_hash($password, PASSWORD_DEFAULT)])->where('email', $email)->execute();
        
        return new AuthenticationResponse(AuthenticationResponse::$SUCCESS);
    }

    public static function getUser() : User | null {
        if(!isset($_SESSION['usi'])){
            if(isset($_COOKIE['usi']))
                $_SESSION['usi'] = $_COOKIE['usi'];
            else
                return null;
        }

        try {
            $d = JWT::decode($_SESSION['usi'], new Key(app['jwt_key'], 'HS256'));
            return new User($d->id, $d->username, $d->email, $d->locale);
        } catch (SignatureInvalidException $ex) {
            self::Logout();
            return null;
        }
    }

    public static function isLoggedIn() : bool {
        return !is_null(self::getUser());
    }

    private static function generateToken() : string {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(32/strlen($x)) )),1,32);
    }
}