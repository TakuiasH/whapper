<?php

use app\models\User;
use app\services\AuthenticationService;
use bootstrap\services\DB;
use bootstrap\services\Locale;

class Auth {

    public static function user() : User | null {
        return AuthenticationService::getUser();
    }

    public static function loggedIn() : bool {
        return AuthenticationService::isLoggedIn();
    }

    public static function setLocale(string $locale) {
        Locale::setLocale($locale);
        if(self::loggedIn())
            DB::table('accounts')->update(['locale' => $locale])->where(['username' => self::user()->username])->execute();
    }

}