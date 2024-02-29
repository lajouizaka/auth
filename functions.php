<?php

use Core\http\Request;
use Core\http\Response;
use Core\support\Session;
use Core\support\Token;

function load_language(string $path = "")
{
    $selected_language = "en";
    $allowed_languages = ["en", "sp", "fr", "ar"];

    if (isset($_GET["language"])) {
        $selected_language = $_GET["language"]; // Selected by User
    } elseif (isset($_COOKIE["language"])) {
        $selected_language = $_COOKIE["language"]; // From Cookie
    } else {
        $selected_language = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2); // Browser's Default Language
    }

    if (!isset($_COOKIE["language"])) {
        setcookie(
            "language",
            $selected_language,
            strtotime("+10 days"),
            "/"
        );
    }

    if (!in_array($selected_language, $allowed_languages)) {
        $selected_language = "en";
    }

    $lang_path = ADMIN_LANG . ($path === "" ? "" : $path."/") . $selected_language . ".php";
    require($lang_path);
    return $selected_language;
}

function e($str)
{
    echo htmlspecialchars($str);
}

function text(string $str): string
{
    $str = str_replace("_", " ", $str);
    return $str;
}

function auth(Response $response)
{
    $loggedIn = Session::get("loggedIn");

    if (!$loggedIn) {
        $response->json(["redirect" => "/admin/login"]);
    }
}

function csrf_protection(Request $request, Response $response)
{
    if ($request->isGet()) {
        Session::setIfNotExists("token", Token::generate());

    } elseif ($request->isPost() || $request->isDelete() || $request->isPut()) {
        if (!Token::verify($request->input("csrf_token"))) {
            $response->statusCode(419)->end();
        }
    }
}


function validate_product($product)
{
    $errors = [];
    /**
     * TODO: Data Validation
     */
    foreach ($product as $key => $value) {
        if ($value === "") {
            $errors[$key] = ucfirst($key) . " should not be empty";
        }
    }

    return empty($errors) ? false : $errors;
}
