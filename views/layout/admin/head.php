<?php
use Core\support\Session;

/**
 *  @author Zakriae Lajoui
 *  @package ecommerce management
 */

defined('ABSPATH') || exit; ?>
<?php $selected_language = load_language("admin"); ?>

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
    <nav class="navbar navbar-expand-lg site-nav">
        <div class="container">
            <a href="#" class="navbar-brand">Ecom Manager</a>

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

            <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a href="/admin"
                            class="nav-link px-lg-3 <?php true && e("active") ?>">
                            <?php e(HOME) ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/products"
                            class="nav-link px-lg-3 <?php false && e("active") ?>">
                            <?php e(PRODUCTS) ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/stores"
                            class="nav-link px-lg-3 <?php false && e("active") ?>">
                            <?php e(STORES) ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/categories"
                            class="nav-link px-lg-3 <?php false && e("active") ?>">
                            <?php e(CATEGORIES) ?>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle ps-lg-3 pe-0" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <?php e(ACCOUNT) ?>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/media">
                                    <?php e(MEDIA) ?>
                                </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="/logout.php">
                                    <?php e(LOG_OUT) ?>
                                </a></li>
                        </ul>
                    </li>

                </ul>
            </div>

        </div>

    </nav>