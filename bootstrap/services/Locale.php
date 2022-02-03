<?php namespace bootstrap\services;

class Locale {
    
    public static string $ENGLISH = 'en';
    public static string $PORTUGUESE = 'pt';
    public static string $SPANISH = 'es';
    public static string $FRENCH = 'fr';

    public function __construct() {
        require '../bootstrap/providers/LocaleProvider.php';
    }
    
    public static function isLocale(string $locale) : bool {
        return self::currentLocale() == $locale;
    }

    public static function currentLocale() : string {
        if(!isset($_COOKIE['locale']))
            return self::setLocale(app['fallback_locale']);

        return $_COOKIE['locale'];
    }

    public static function setLocale(string $locale) : string {
        setcookie("locale", $locale, time() + (10 * 365 * 24 * 60 * 60));
        return $locale;
    }
}
