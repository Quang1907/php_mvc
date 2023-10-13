<?php

namespace Core;

class Route
{
    static private $path;
    static private $routeConfig;
    static private $route;
    static private $routeWhere;

    public function __construct()
    {
        self::$route = $this;
    }

    public static function get($path = "", $callback = [])
    {
        self::$path = trim($path, "/");
        self::$routeConfig["get"][self::$path] = $callback;
        return self::$route;
    }

    public static function post($path = "", $callback = [])
    {
        self::$path =  trim($path, "/");
        self::$routeConfig["post"][self::$path] = $callback;
        return self::$route;
    }

    public static function where($where = [])
    {
        self::$routeWhere[self::$path] = $where;
        return self::$route;
    }

    public function loadRoute()
    {
        $pathRoute = __DIR_ROOT__ . "routes/web.php";
        if (file_exists($pathRoute)) {
            return require_once $pathRoute;
        }
        Error::render(["message" => "Vui long kiem tra lai duong dan: " . $pathRoute]);
    }

    public function execute()
    {
        $checkPath = $this->getParams($params, $callback);

        if ($checkPath) {
            try {
                if (is_array($callback)) {
                    $controller = new $callback[0];
                    $callback = [$controller, $callback[1]];
                }
                return call_user_func_array($callback, $params);
            } catch (\Throwable $th) {
                Error::render(["message" => $th->getMessage()]);
            }
        }
    }

    public function getParams(&$params, &$callback)
    {
        $check = false;

        $method = strtolower($_SERVER["REQUEST_METHOD"]);
        $currentPath = trim($_SERVER["PATH_INFO"] ?? "", "/");

        if (!empty(self::$routeConfig[$method])) {
            foreach (self::$routeConfig[$method] as $path => $callback) {
                $pattern = "~^$path$~is";
                if (!empty(self::$routeWhere[$path])) {
                    foreach (self::$routeWhere[$path] as $patternName => $pathPattern) {
                        $pattern  = str_replace("{" . $patternName . "}", "(" . $pathPattern . ")", $pattern);
                    }
                }
                $pattern = preg_replace("~{.+?}~", "(.+?)", $pattern);
                preg_match($pattern, $currentPath, $matches);
                if (!empty($matches)) {
                    $check = true;
                    unset($matches[0]);
                    $params = array_values($matches);
                    break;
                }
            }
        }
        return $check;
    }
}
