<?php

use Core\Router;

require realpath($_SERVER["DOCUMENT_ROOT"]) . "/config.php";
require ABSPATH . "vendor/autoload.php";
require ABSPATH . "functions.php";

require ABSPATH. "web.php";

Router::resolve();
