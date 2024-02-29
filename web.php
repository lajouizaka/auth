<?php

use Core\controllers\AccountController;
use Core\controllers\AuthController;
use Core\controllers\CategoryController;
use Core\controllers\ProductController;
use Core\controllers\StoreController;
use Core\Router;
use Core\support\Logger;
use Core\View;

/**
* Auth Routing
*/
Router::_404(fn () => View::make("404", "admin"));

Router::get("/admin/login", [AuthController::class,"login_page"]);
Router::post("/admin/login", [AuthController::class,"login"]);

Router::post("/admin/logout", [AuthController::class,"logout"]);

Router::post("/admin/mail-verification", [AuthController::class,"request_mail_verification"]);
Router::get("/admin/mail-verification/verify", [AuthController::class,"verify_mail"]);

Router::get("/admin/change-password", [AuthController::class,"change_password_form"]);
Router::post("/admin/change-password", [AuthController::class,"change_password"]);
Router::post("/admin/change-password/request", [AuthController::class,"change_password_request"]);

Router::post("/admin/account/delete", [AccountController::class,"destroy"]);
Router::post("/admin/account", [AccountController::class,"post"]);
Router::get("/admin/account/create", [AccountController::class,"create"]);

/**
* Products Routing
*/
Router::get("/admin/products", [ProductController::class,"index"]);

Router::get("/admin/products/create", [ProductController::class,"create"]);

Router::get("/admin/products/single", [ProductController::class,"single"]);

Router::post("/admin/products", [ProductController::class,"post"]);

Router::delete("/admin/products", [ProductController::class,"destroy"]);

/**
* Categories Routing
*/
Router::get("/admin/categories", [CategoryController::class,"index"]);
Router::post("/admin/categories", [CategoryController::class,"post"]);

/**
* Stores Routing
*/
Router::get("/admin/stores", [StoreController::class,"index"]);
Router::post("/admin/stores", [StoreController::class,"post"]);
