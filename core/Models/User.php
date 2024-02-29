<?php

namespace Core\models;

use Core\auth\AuthGuard;
use Core\Database\DB;
use Core\support\Model;

class User extends Model
{
    protected string $table = "users";
    protected array $fillable = ["email","password","verified"];

    public static function findGuard(int $id): AuthGuard|bool
    {
        $stm = DB::query("SELECT email,verified,(
            SELECT CONCAT( \"[\", GROUP_CONCAT( CONCAT('\"',( permissions.name ),'\"')) , \"]\" )
            FROM users
            LEFT JOIN users_permissions  ON users.id = users_permissions.user_id
            LEFT JOIN permissions ON users_permissions.permission_id = permissions.id
            WHERE users.id = ?

        ) AS user_permissions
        FROM users
        WHERE users.id = ? LIMIT 1;");

        $stm->execute([$id,$id]);

        $user = $stm->fetch();
        $user["id"] = $id;

        return  $user ? (new AuthGuard($user)) : false;
    }

    public static function exists(string $email): bool
    {
        $stm = DB::query("SELECT email FROM users WHERE email=? LIMIT 1;");
        $stm->execute([$email]);
        return  $stm->rowCount() === 1 ? true : false;
    }

    public static function findWithLoginAtemmpts(string $email)
    {
        $stm = DB::query("SELECT 
                            users.id,
                            password,
                            COUNT(login_attempts.id) AS login_attempts
                            FROM users LEFT JOIN login_attempts 
                            ON users.id =  login_attempts.user_id 
                            AND login_attempts.timestamp > ?
                            WHERE email=?
                            GROUP BY users.id;");

        $stm->execute([ time() - 60 * 60 , $email ]);
        return  $stm->fetch();
    }

    public static function emailVerificationRequestCount($email): array|bool
    {
        $stm = DB::query("SELECT
                            users.id AS	user_id,
                            verified,
                            count(requests.id) AS request_count
                            FROM users
                            LEFT JOIN requests
                            ON	users.id = requests.user_id
                            AND requests.type = 0
                            AND requests.timestamp > ?
                            WHERE users.email = ?
                            GROUP BY users.id;");

        $stm->execute([time() - 60 * 60 * 24,$email]);
        return $stm->fetch();
    }

    public static function PasswordResetRequestCount($email): array|bool
    {
        $stm = DB::query("SELECT
                            users.id AS	user_id,
                            verified,
                            count(requests.id) AS request_count
                            FROM users
                            LEFT JOIN requests
                            ON	users.id = requests.user_id
                            AND requests.type = 1
                            AND requests.timestamp > ?
                            WHERE users.email = ?
                            GROUP BY users.id;");

        $stm->execute([time() - 60 * 60 * 24,$email]);
        return $stm->fetch();
    }

    public static function setVerifiedEmail(int $id)
    {
        $stm = DB::query("UPDATE users SET verified=1 WHERE id=?;");
        $stm->execute([$id]);
        return $stm->rowCount();
    }

    public static function setNewPassword(int $id, string $password): bool
    {
        $stm = DB::query("UPDATE users SET password=? WHERE id=?;");
        $stm->execute([ password_hash($password, PASSWORD_DEFAULT) ,  $id ]);
        return (bool)$stm->rowCount();
    }

}
