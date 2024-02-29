<?php

namespace Core\controllers;

use Core\auth\Auth;
use Core\http\Request;
use Core\http\Response;
use Core\models\Category;
use Core\models\Product;
use Core\models\Store;
use Core\View;

class ProductController
{
    public static function index(Request $request, Response $response): void
    {
        $user = Auth::user();
        $productsObj = Product::paginate();

        if (!$productsObj) {
            $response->redirect("/admin/products?page=1");
        }

        View::make("admin.products.index", "admin", [
            "user"          => $user,
            "productsObj"   => $productsObj,
            "page"          => (int) $request->param("page")
        ]);
    }

    public static function create(Request $request, Response $response): void
    {
        $user = Auth::user();

        if (!$user->can_insert_products()) {
            $response->redirect("/admin/products/");
        }

        $categories =  Category::all();
        $stores =  Store::all();

        View::make("admin.products.create", "admin", [
            "stores"    => $stores,
            "categories"    => $categories,
        ]);
    }

    public static function single(Request $request, Response $response): void
    {
        View::make("admin.products.single", "admin", [
             "product"   => Product::find($request->param("id"))
         ]);
    }

    private static function extractData(Request $request)
    {
        $product = [
            "title" => $request->input("title"),
            "description" => $request->input("description"),
            "price" => $request->input("price"),
            "cost" => $request->input("cost"),
            "stock" => $request->input("stock"),
            "ready_to_sell" => $request->input("ready_to_sell") ? 1 : 0,
            "user_id" => Auth::user()->id,
            "store_id" => $request->input("store"),
            "category_id" => $request->input("category")
        ];

        $errors = validate_product($product);

        return [
            "errors"    => $errors,
            "data"      => $product
        ];
    }

    public static function post(Request $request, Response $response): void
    {
        $user = Auth::user();

        if (!$user->can_insert_products()) {
            $response->json(["msg" => "You don't have permission to create products"]);
        }

        $validated = self::extractData($request);

        if ($validated["errors"]) {
            $response->json(
                [$validated]
            );
        }

        $saved = Product::save($validated["data"]);

        $response->json($saved);
    }

    public static function update(Request $request, Response $response): void
    {
        $user = Auth::user();

        if (!$user->can_insert_products()) {
            $response->json(["msg" => "You don't have permission to create products"]);
        }

        $validated = self::extractData($request);

        if ($validated["errors"]) {
            $response->json(
                [$validated]
            );
        }

        Product::update((int) $request->input("id"), $validated["data"]);


        // $response->json($updated);

    }

    public static function destroy(Request $request, Response $response): void
    {
        $user = Auth::user();

        if (!$user->can_delete_products()) {
            $response->json(["msg" => "You don't have permission to delete products"]);
        }

        $product_id = (int) $request->input("id");

        $deleted =  Product::destroy($product_id);

        $response->json(["deleted" => $deleted]);
    }
}
