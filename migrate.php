<?php

use Core\Database\DB;

/**
 * migrate: drop the tables and recreate them
 * seed: Fill the tables with data
 */

require "./config.php";
require "./vendor/autoload.php";

$action = $argv[1];

if ($action === "migrate") {
    dropTables();
    createTables();
} elseif($action === "seed") {
    emptyDB();
    seedDB();
}

function dropTables(): void
{
    DB::rawQuery("DROP TABLE IF EXISTS `order_items`;");

    DB::rawQuery("DROP TABLE IF EXISTS `orders`;");

    DB::rawQuery("DROP TABLE IF EXISTS `products`;");

    DB::rawQuery("DROP TABLE IF EXISTS `categories`;");

    DB::rawQuery("DROP TABLE IF EXISTS `stores`;");

    DB::rawQuery("DROP TABLE IF EXISTS `requests`;");

    DB::rawQuery("DROP TABLE IF EXISTS `login_attempts`;");

    DB::rawQuery("DROP TABLE IF EXISTS `users_permissions`;");

    DB::rawQuery("DROP TABLE IF EXISTS `permissions`;");

    DB::rawQuery("DROP TABLE IF EXISTS `users`;");

}

function createTables(): void
{
    DB::rawQuery(file_get_contents("sql/users/table.sql"));

    DB::rawQuery(file_get_contents("sql/permissions/table.sql"));

    DB::rawQuery(file_get_contents("sql/users_permissions/table.sql"));

    DB::rawQuery(file_get_contents("sql/requests/table.sql"));

    DB::rawQuery(file_get_contents("sql/login_attempts/table.sql"));

    DB::rawQuery(file_get_contents("sql/stores/table.sql"));

    DB::rawQuery(file_get_contents("sql/categories/table.sql"));

    DB::rawQuery(file_get_contents("sql/products/table.sql"));

    DB::rawQuery(file_get_contents("sql/orders/table.sql"));

    DB::rawQuery(file_get_contents("sql/order_items/table.sql"));

}

function emptyDB(): void
{

    DB::rawQuery("DELETE FROM order_items;");

    DB::rawQuery("DELETE FROM orders;");

    DB::rawQuery("DELETE FROM products;");

    DB::rawQuery("DELETE FROM categories;");

    DB::rawQuery("DELETE FROM stores;");

    DB::rawQuery("DELETE FROM login_attempts;");

    DB::rawQuery("DELETE FROM requests;");

    DB::rawQuery("DELETE FROM users_permissions;");

    DB::rawQuery("DELETE FROM permissions;");

    DB::rawQuery("DELETE FROM users;");
}

// Database Seeding
function seedDB()
{

    DB::query("INSERT INTO users (email,password) VALUES (?,?),(?,?)")
    ->execute(["lajouizakariae@gmail.com" , password_hash("12345", PASSWORD_DEFAULT), "user@one.com", password_hash("12345", PASSWORD_DEFAULT)]);

    DB::rawQuery(file_get_contents("sql/permissions/data.sql"));

    DB::rawQuery(file_get_contents("sql/users_permissions/data.sql"));

    DB::rawQuery(file_get_contents("sql/stores/data.sql"));

    DB::rawQuery(file_get_contents("sql/categories/data.sql"));

    DB::rawQuery(file_get_contents("sql/products/data.sql"));

}
