<?php

namespace Core\models;

use Core\Database\DB;
use Core\support\Model;

class Category extends Model
{
    protected string $table = "categories";
    protected array $fillable = ["name","slug"];

    public static function allWithProductCount(): array | bool
    {
        $stm = DB::rawQuery("SELECT categories.id as id, categories.name as name, COUNT(products.id) AS product_count
                            FROM categories
                            LEFT JOIN products ON products.store_id = categories.id
                            GROUP BY categories.id;");

        return $stm->fetchAll();
    }
}
