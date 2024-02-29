<?php

namespace Core\models;

use Core\support\Model;

class Product extends Model
{
    protected string $table = "products";

    protected array $fillable = ["title","description","cost","price","stock","ready_to_sell","user_id","category_id","store_id"];

}
