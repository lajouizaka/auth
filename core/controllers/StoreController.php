<?php

namespace Core\controllers;

use Core\auth\Auth;
use Core\http\Request;
use Core\http\Response;
use Core\models\Category;
use Core\models\Product;
use Core\models\Store;
use Core\View;

class StoreController
{
    public static function index(Request $request, Response $response)
    {
        $stores = Store::allWithProductCount();

        // if(!Auth::user()->can_select_stores()){
        // $response->redirect("/admin/");
        // };

        View::make("admin.stores.index", "admin", [
            "stores" => $stores
        ]);
    }

    public static function post(Request $request, Response $response)
    {

        // if(!Auth::user()->can_insert_stores()) {
        //     $response->json(["Not Authorized"]);
        // };

        /**
         * Save Store
         */

        $response->json(["Hello"]);
    }
}
