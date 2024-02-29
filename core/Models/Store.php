<?php

namespace Core\models;

use Core\Database\DB;
use Core\support\Model;

class Store extends Model
{
    protected string $table = "stores";

    public static function allWithProductCount(): array | bool
    {
        $stm = DB::rawQuery("SELECT stores.id as id, stores.name as name, COUNT(products.id) AS product_count
                            FROM stores
                            LEFT JOIN products ON products.store_id = stores.id
                            GROUP BY stores.id;");

        return $stm->fetchAll();
    }



}
