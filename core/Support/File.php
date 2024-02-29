<?php

namespace Core\support;

class File
{
    protected static $imgExtentions = ["jpg","jpeg","png","webp"];

    public static function read(string $path)
    {
        if (file_exists($path)) {
            return file_get_contents($path);
        } else {
            return '';
        }
    }

    public static function getExt(string $filename)
    {
        $filename = explode('.', $filename);
        $ext = array_pop($filename);
        return $ext;
    }

    protected static function is(string $type, string $path)
    {
        $ext = self::getExt($path);

        return match ($type) {
            "text"  => ($ext === "txt"),
            "pdf"   => ($ext === "pdf"),
            "img"   => in_array(self::getExt($path), self::$imgExtentions)
        };
    }

    public static function isText(string $path)
    {
        return self::is("text", $path);
    }

    public static function isImg(string $path)
    {
        return self::is("img", $path);
    }

    public static function isPdf(string $path)
    {
        return self::is("pdf", $path);
    }

    public static function exists(string|array $paths)
    {
        if (is_array($paths)) {

            foreach ($paths as $path) {

                if (!file_exists($path)) {
                    return false;
                }

            }

            return true;
        }

        return file_exists($paths);
    }

    public static function missing(string $path)
    {
        return !self::exists($path);
    }

    public static function delete(string $path)
    {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return false;
        }
    }
}
