<?php

namespace Core\controllers;

use Core\auth\Auth;
use Core\http\Request;
use Core\http\Response;
use Core\models\Category;
use Core\models\Product;
use Core\models\Store;
use Core\View;

class CategoryController
{
    public static function index(Request $request, Response $response)
    {

        $user = Auth::user();

        // if(!$user->can_select_categories()) {
        //     $response->redirect("/admin/");
        // };

        $categories = Category::allWithProductCount();

        View::make("admin.categories.index", "admin", [
            "categories" => $categories
        ]);
    }

    public static function post(Request $request, Response $response)
    {

        // if(!Auth::user()->can_insert_categories()) {
        //     $response->json(["Not Authorized"]);
        // };

        /**
         * Save Category
         */

        $response->json(["Hello"]);
    }
}
