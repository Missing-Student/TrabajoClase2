<?php

//Forzamos que no nos metan caracteres "peligrosos" en la URL.
$request = htmlspecialchars($_SERVER['REQUEST_URI']);

//Para tener en cuenta la consulta GET.
$requestArray = explode("?", $request);
$requestProcesada = $requestArray[0];


// Lista blanca de rutas permitidas
$allowed_routes = [
    '/' => 'login.php',
    '/bienvenida' => 'bienvenida.php',
    '/registro' => 'registro.php',
    '/cerrarsesion' => 'cerrarsesion.php'
];

/*Comprobamos si la URL que aporta el usuario coincide con alguna de las claves que se encuentran en el array anterior. Si coinciden, se 
redirecciona a la página correspondiente, y de lo contrario a la página del error 404.*/
if (array_key_exists($requestProcesada, $allowed_routes)) {
    require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $allowed_routes[$requestProcesada];
} else {
    // Manejar rutas no encontradas
    http_response_code(404);
    require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . '404.php';
}
