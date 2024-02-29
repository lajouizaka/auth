<?php

namespace Core\models;

use Core\Database\DB;

class PasswordResetRequest
{
    public static function save(int $user_id)
    {
        $hash = password_hash(random_bytes(8), PASSWORD_DEFAULT);
        $stm = DB::query("INSERT INTO requests (user_id,verif_code,timestamp,type) VALUES (?,?,?,?);");
        $stm->execute([$user_id, $hash, time(), 1]);
        return [
            "id" => DB::lastID(),
            "verif_code" => $hash
    ];
    }

    public static function find(int $id): array|bool
    {
        $stm = DB::query("SELECT user_id,timestamp,verif_code from requests WHERE id=? AND type=1 LIMIT 1;");
        $stm->execute([$id]);
        return $stm->fetch();
    }

    public static function clear(int $id): int
    {
        $stm = DB::query("DELETE FROM requests WHERE user_id=? and type=1");
        $stm->execute([$id]);
        return $stm->rowCount();
    }
}
