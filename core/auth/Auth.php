<?php

namespace Core\auth;

use Core\models\LoginAttempt;
use Core\models\User;
use Core\support\Session;
use Core\support\Singleton;

class Auth
{
    use Singleton;

    private AuthGuard | bool $user;

    protected function __construct()
    {
        $this->user = User::findGuard((int) Session::get("userId")) ;
    }

    public static function user()
    {
        return self::instance()->user;
    }

    public static function logout()
    {
        Session::destroy();
    }

    public static function attempt(array $credentials)
    {
        $user = User::findWithLoginAtemmpts($credentials["email"]);

        if (!$user) {
            return (["error" => "user does not exist"]);
        }

        // if ($user["login_attempts"] >= MAX_LOGIN_ATTEMPTS_PER_HOUR) {
        //     return ["error" => "Login Attempts Reached the Limit"];
        // }

        if (!password_verify($credentials["password"], $user["password"])) {
            // Login Attempt
            LoginAttempt::save($user["id"]);
            return ["error" => "Incorrect Password"];
        }

        LoginAttempt::clear($user["id"]);
        Session::set("loggedIn", true);
        Session::set("userId", $user["id"]);

        return true;
    }
}
