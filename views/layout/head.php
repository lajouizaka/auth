<?php
use Core\support\Session;

/**
 *  @author Zakriae Lajoui
 *  @package ecommerce management
 */

defined('ABSPATH') || exit; ?>
<?php $selected_language = load_language(); ?>

<!DOCTYPE html>

<html lang="<?php e($selected_language) ?>">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="<?php e(CSS) ?>normalize.css?v=<?php e(rand(1, 1000)) ?>">
    <link rel="stylesheet"
        href="<?php e(CSS) ?>all.css?v=<?php e(rand(1, 1000)) ?>">
    <link rel="stylesheet"
        href="<?php e(CSS) ?>app.css?v=<?php e(rand(1, 1000)) ?>">

    <meta name="csrf_token"
        content="<?php echo Session::get("token")?>" />

    <title>
        <?php e(TITLE) ?>
    </title>

</head>

<body>
    <nav class="site_auth_nav">

        <div class="container">

            <ul class="list-unstyled d-flex flex-row justify-content-around align-items-center">
                <li class="nav-item">
                    <a class="nav-link mx-2" href="/admin/login">
                        <?php e(LOG_IN) ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link mx-2" href="/admin/register">
                        <?php e(SIGN_UP) ?>
                    </a>
                </li>

                <div class="lang ms-auto">
                    <form class="my-2" style="width: 70px;"
                        action="<?php e($_SERVER["REQUEST_URI"]) ?>"
                        method="get">
                        <select class="form-select" name="language" onchange="document.forms[0].submit()">
                            <?php foreach (["en", "fr", "ar", "sp"] as $lang) : ?>
                            <option value="<?php e($lang) ?>" <?php e($selected_language === $lang ? "selected" : "") ?>>
                                <?php e($lang) ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </form>
                </div>
            </ul>

        </div>

    </nav>