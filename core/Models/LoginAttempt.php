<?php

namespace Core\models;

use Core\Database\DB;
use Core\support\Model;

class LoginAttempt
{
    public static function save(int $user_id): bool
    {
        $stm = DB::query("INSERT INTO login_attempts (user_id , ip , timestamp) VALUES (?,?,?);");
        $stm->execute([$user_id, $_SERVER["REMOTE_ADDR"] ,time()]);
        return (bool) $stm->rowCount();
    }

    public static function clear(int $id): bool
    {
        $stm = DB::query("DELETE FROM login_attempts WHERE user_id=?");
        $stm->execute([$id]);
        return (bool) $stm->rowCount();
    }
}
