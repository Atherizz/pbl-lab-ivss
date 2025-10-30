<?php
use App\Http\Middleware\AuthMiddleware;

session_start();

define('BASE_PATH', dirname(__DIR__));
define('BASE_URL', '/mini-mvc/public');

require BASE_PATH . '/vendor/autoload.php';

$routes = require BASE_PATH . '/routes/web.php';

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 

$base_path = '/mini-mvc/public';

if (strpos($request_uri, $base_path) === 0) {
    $request_uri = substr($request_uri, strlen($base_path));
}

if (empty($request_uri) || $request_uri[0] !== '/') {
    $request_uri = '/' . $request_uri;
}

$path = $request_uri ?: '/';
$method = $_SERVER['REQUEST_METHOD'];


$routesForMethod = $routes[$method] ?? [];
$routeFound = false;

foreach ($routesForMethod as $routePath => $routeInfo) {

    if (isset($routeInfo['view'])) {
        $viewName = $routeInfo['view'];
        view($viewName); 
        $routeFound = true;
    } else if (isset($routeInfo['controller']) && isset($routeInfo['action'])) {
    $controllerName = $routeInfo['controller'];
    $action = $routeInfo['action'];
    // Ubah route path (e.g., /ekskul/detail/{id}) menjadi pola Regex
    // Ini akan mengubah {id} menjadi ([a-zA-Z0-9_]+)
    $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $routePath);
    
    // Buat pola Regex yang utuh (tambahkan ^ dan $ agar cocok persis)
    $pattern = "#^" . $pattern . "$#";

    // cocokkan URL saat ini dengan pola Regex
    if (preg_match($pattern, $path, $matches)) {
        
        array_shift($matches); 
        $params = $matches;


        if (isset($routeInfo['middleware'])) {
            $auth = new AuthMiddleware();

            if ($routeInfo['middleware'] === 'auth') {
                $auth->requireLogin(); 
            } elseif ($routeInfo['middleware'] === 'admin') {
                $auth->requireAdmin(); 
            }
        }

        if (class_exists($controllerName)) {
            $controller = new $controllerName();
            if (method_exists($controller, $action)) {
                call_user_func_array([$controller, $action], $params);
                
                $routeFound = true;
                break; 
            } else {
                echo "Action not found!";
                $routeFound = true;
                break;
            }
        } else {
            echo "Controller not found!";
            $routeFound = true; 
            break;
        }
        }
        

    }
}

if (!$routeFound) {
    echo "404 - Page not found!";
}