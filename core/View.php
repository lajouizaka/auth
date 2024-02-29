<?php

namespace Core;

use Core\support\File;

class View
{
    public static $layout;
    public static $content;

    public static function make(string $view_path, string $layout_path = "", array $data = [])
    {
        if(str_contains($view_path, ".")) {
            $view_path = str_replace(".", "/", $view_path);
        };

        $head = VIEWS. "layout/" . ($layout_path === "" ? "" : "$layout_path/")  . "head.php";
        $view = VIEWS. "$view_path.php";
        $end =  VIEWS. "layout/" . ($layout_path === "" ? "" : "$layout_path/")  . "end.php";

        if (File::exists([$head,$view,$end])) {
            extract($data);
            require($head);
            require($view);
            require($end);
        }
    }
}
