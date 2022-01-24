<?php namespace app\responses;

class AuthenticationResponse {

    public static int $SUCCESS = 200;

    public static int $PASSWORD_INVALID = 300;
    public static int $PASSWORD_SMALL = 301;
    public static int $PASSWORDS_NOT_MATCH = 303;

    public static int $USERNAME_INVALID = 400;
    public static int $USERNAME_SMALL = 401;
    public static int $USERNAME_TAKEN = 402;

    public static int $EMAIL_INVALID = 500;
    public static int $EMAIL_TAKEN = 502;

    public static int $TOKEN_INVALID = 600;

    public static int $MAIL_ERROR = 700;

    private int $response = 0;

    public function __construct(int $response)
    {
        $this->response = $response;
    }

    public function code() : int {
        return $this->response;
    }

    public function success() : bool {
        return $this->response == self::$SUCCESS ? true : false;
    }
    
    public function passwordInvalid() : bool {
        return $this->response == self::$PASSWORD_INVALID ? true : false;
    }

    public function passwordsNotMatch() : bool {
        return $this->response == self::$PASSWORDS_NOT_MATCH ? true : false;
    }

    public function passwordSmall() : bool {
        return $this->response == self::$PASSWORD_SMALL ? true : false;
    }

    public function usernameInvalid() : bool {
        return $this->response == self::$USERNAME_INVALID ? true : false;
    }

    public function usernameSmall() : bool {
        return $this->response == self::$USERNAME_SMALL ? true : false;
    }

    public function usernameTaken() : bool {
        return $this->response == self::$USERNAME_TAKEN ? true : false;
    }

    public function emailInvalid() : bool {
        return $this->response == self::$EMAIL_INVALID ? true : false;
    }

    public function emailTaken() : bool {
        return $this->response == self::$EMAIL_TAKEN ? true : false;
    }

    public function tokenInvalid() : bool {
        return $this->response == self::$TOKEN_INVALID ? true : false;
    }

    public function mailError() : bool {
        return $this->response == self::$MAIL_ERROR ? true : false;
    }

}
