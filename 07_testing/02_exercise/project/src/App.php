<?php

use Widget\Widget;
use Widget\Link;
use Widget\Button;

use Storage\StorageFactoryImpl;
use Config\Directory;

class App
{
    public function run()
    {

        $parts = explode('/', $_SERVER['REQUEST_URI']);
        array_shift($parts);

        $option = $parts[0] ?? 'home' ?: 'home';

        $controllerClassName = "Controller\\" . ucwords($option) . "Controller";

        if (class_exists($controllerClassName)) {

            $controller = new $controllerClassName(new StorageFactoryImpl());

            $controllerMethodName = $parts[1] ?? 'index' ?: 'index';
            $controllerMethodArguments = array_slice($parts, 2);

            if (is_numeric($controllerMethodName)) {
                $controllerMethodName = "show";
                $controllerMethodArguments = array_slice($parts, 1);
            }

            if (method_exists($controller, $controllerMethodName)) {

                $result = call_user_func_array([$controller, $controllerMethodName], $controllerMethodArguments);

            } else {

                Log::error("No such method '$controllerMethodName' in '$controllerClassName'.");
                $result = "404";
            }

        } else {
            Log::error("No such class '$controllerClassName'.");
            $result = "404";
        }

        if (is_array($result)) {
            $view = $result[0];
            $data = $result[1];
        } else {
            $view = $result;
            $data = [];
        }

        $view = $view ?? "404";

        $file = Directory::view() . str_replace('.', '/', $view) . '.php';

        extract($data);

        require_once(Directory::view() . 'layout.php');
    }
}
