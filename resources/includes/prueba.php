<?php

$variablePrueba = "3";
//Comprobar tipo valor
var_dump(is_int($variablePrueba));

//Comprobar tipo variable
is_int($variablePrueba);

//Cambiar tipo variable
settype($variablePrueba, "string");
$variablePrueba = (int)$variablePrueba;

//Obtener el tipo de variable
gettype($variablePrueba);

//Números decimales, negativos, octal, hexadecimal, binario, coma flotante
$a = 1234;
$a = -123;
$a = 0123;
$a = 0x1A;
$a = 0b1011;
$a = 1.123;
$a = 1e3;
$a = 1E-10;

//Redondeo
$a = 123.456;
$a = floor($a); //Hacia abajo.
$a = ceil($a); //Hacia arriba.
$a = round($a); //Hacia arriba o hacia abajo.

//Cadenas
$cadena = '$a es una cadena' . "\n"; //No muestra $a
$cadena = "$a es una cadena" . "\n"; //Muestra $a

//Heredoc = ""
$var = <<<identificador
    Hola
    $a
    Hola
identificador;

//Nowdoc = ''
$var = <<<'identificador'
    Hola
    $a
    Hola
identificador;

//Echo
echo "$cadena en mayúsculas es strtoupper($cadena)."; //Sale en mayus.
echo "$cadena en mayúsculas es /strtoupper($cadena)."; //No sale en mayus.

//Modificadores de cadenas
$cadena = "Esto es una cadena de prueba";
$cadena2 = "Esto es otra cadena de prueba";

ltrim($cadena); //Elimina espacios en blanco al principio.
rtrim($cadena); //Elimina espacios en blanco al final.
trim($cadena); //Elimina espacios en blanco al principio y al final.
strtoupper($cadena); //Pasa a mayúsculas.
strtolower($cadena); //Pasa a minúsculas.
ucfirst($cadena); //Pasa la primera letra a mayúscula.
strtr($cadena, "a", "e"); //Devuelve una copia de $cadena pero cambia las "a" por "e".
substr($cadena, 0, 5); //Devuelve una subcadena con los caracteres del 0 al 5. Si es negativo, empieza desde el final.
strcasecmp($cadena, $cadena2); //Compara las dos cadenas sin mirar CASE. Devuelve >0 (si 1 es mayor que 2), 0 (iguales) y <0 (si 1 es menor que 2).
strcmp($cadena, $cadena2); //Compara las dos cadenas mirando el CASE. Devuelve >0 (si 1 es mayor que 2), 0 (iguales) y <0 (si 1 es menor que 2).
strlen($cadena); //Devuelve la longitud de la cadena. Cuenta los espacios en blanco.
substr_replace($cadena, "e", 0, 1); //Sustituye una subcadena por otra que se pasa como argumento.
chr(65); //Devuelve el caracter con el código ASCII 65.
ord("A"); //Devuelve el código ASCII del caracter "A".

//Arrays asociativos. Se le da un valor a la clave.

//Funciones para arrays
$array = [1, 2, 3, 4, 5];
sort($array); //Ordena el array.
rsort($array); //Ordena el array en orden inverso.
asort($array); //Ordena el array por el valor.
arsort($array); //Ordena el array en orden inverso por el valor.
ksort($array); //Ordena el array por las claves.
krsort($array); //Ordena el array en orden inverso por las claves.
uasort($array, function ($a, $b) {
    return $a <=> $b;
}); //Ordena el array por el valor y mantiene la asociación entre las claves y los valores. Salida: Array([clave2] => 2 [clave1] => 5 [clave3] => 8)
usort($array, function ($a, $b) {
    return $a <=> $b;
}); //Ordena el array por el valor, pero no mantiene la asociación entre las claves y los valores. Salida: Array([0] => 2 [1] => 5 [2] => 8)
uksort($array, function ($a, $b) {
    return $a <=> $b;
}); //Ordena el array por la clave y mantiene la asociación entre las claves y los valores. Salida: Array([clave1] => 2 [clave2] => 8 [clave3] => 5)
count($array); //Devuelve la longitud del array.
next($array); //Devuelve el siguiente elemento del array.
prev($array); //Devuelve el anterior elemento del array.
foreach ($array as $clave => $valor) {
}
foreach ($array as $valor) {
}
foreach ($capitales as list($pais, $ciudad)) {
}
print "<pre>\n";
print_r($datos);
print "</pre>\n";
unset($array[0]); //Borra un array o un elemento del array.
count($array, COUNT_RECURSIVE); //Devuelve la longitud del array multidimensional.
max($array); //Devuelve el valor máximo del array.
min($array); //Devuelve el valor mínimo del array.
in_array($valor, $array); //Devuelve true si el valor se encuentra en el array.
array_search($valor, $array); //Devuelve el indice del array donde se encuentra el valor.
array_keys($clave, $array); //Devuelve una matriz con las claves del array coincidentes con el valor especificado.
array_count_values($array); //Devuelve un array con el conteo de cuantas veces aparece un elemento en el array.
array_values($array); //Devuelve un array con los valores del array. Cambia los índices a [0].[1]..
list($clave1, $clave2, $clave3) = $array; //Asigna los valores del array a las variables de la lista.
array_slice($array, 0, 3); //Devuelve un array con los elementos del array desde el 0 hasta el 3.
array_splice($array, 0, 3); //Elimina los elementos del array desde el 0 hasta el 3.
implode(",", $array); //Convierte un array en una cadena separada por comas.
array_pop($array); //Extrae y devuelve el ultimo elemento del array.
array_push($array, "elemento"); //Añade un elemento al final del array.
array_shift($array); //Extrae y devuelve el primer elemento del array.
array_unshift($array, "elemento"); //Añade un elemento al principio del array.
current($array); //Devuelve el elemento que indica el puntero.
pos($array); //Devuelve el elemento que indica el puntero.
reset($array); //Pone el puntero al principio del array.
end($array); //Pone el puntero al final del array.
next($array); //Pone el puntero al siguiente elemento del array.
prev($array); //Pone el puntero al anterior elemento del array.
key($array); //Devuelve la clave del elemento que indica el puntero.

//Tiempo
time(); //Devuelve el tiempo actual en segundos.
$detallesHora = getdate(time()); //Devuelve un array con los detalles de la hora actual.
// "hours" "minutes" "seconds" "mday" "mon" "year" "wday" "yday" "weekday" "month"
$date = date("m"); // h(05) H(09) g(5) G(9) i(50) s(59) d(05) J(5) m(01) n(1) Y(1996) y(96) L(bisiesto) w(domingo) t(28-31) a(am) A(AM)
date_default_timezone_set('Europe/Madrid'); //Establece la zona horaria por defecto.
$fechaInventada = mktime(23, 59, 59, 12, 31, 1996); //Devuelve el timestamp de la fecha y hora especificada.
checkdate(12, 32, 2020); //Devuelve true si la fecha es válida.

// REGEX COLOR HEXADECIMAL preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'
// REGEX EMAIL preg_match('/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/'
// REGEX IP preg_match('/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/'
// REGEX URL preg_match('/^(http|https):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/i'
// REGEX FECHA preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/'
// REGEX FECHA HORA preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})$/'
// REGEX TELÉFONO preg_match('/^(\+34|0034|34)?[ ]?(\(?\d{3}\)?[ ]?\d{3}[ ]?\d{3})$/'

//CSV. Realiza un sistema que gestione el guardado de nuevo usuarios en un archivo .CSV, manteniendo los nuevos ya existentes.
function guardarUsuarioCSV($nombre, $apellido, $email)
{
    $fp = fopen('../resources/data/usuarios.csv', 'a');
    $usuario = array($nombre, $apellido, $email);
    fputcsv($fp, $usuario);
    fclose($fp);
}
function guardarUsuarioCSV2($nombre, $apellido, $email)
{
    $archivo = '../resources/data/usuarios.csv';
    $usuarios = array();

    // Leer el contenido del archivo CSV
    if (file_exists($archivo)) {
        $fp = fopen($archivo, 'r');
        while (($datos = fgetcsv($fp)) !== FALSE) {
            $usuarios[] = $datos;
        }
        fclose($fp);
    }

    // Comprobar si el usuario ya existe
    foreach ($usuarios as $usuario) {
        if ($usuario[2] == $email) {
            echo "Error: Usuario ya existente.";
            return;
        }
    }

    // Si no existe, agregarlo al array de usuarios
    $nuevoUsuario = array($nombre, $apellido, $email);
    $usuarios[] = $nuevoUsuario;

    // Guardar el array de usuarios en el archivo CSV
    $fp = fopen($archivo, 'w');
    foreach ($usuarios as $usuario) {
        fputcsv($fp, $usuario);
    }
    fclose($fp);

    echo "Usuario agregado con éxito.";
}

//TXT. Realiza un sistema que gestione el guardado de nuevo usuarios en un archivo .TXT, manteniendo los nuevos ya existentes.
function guardarUsuarioTXT($nombre, $apellido, $email)
{
    $fp = fopen('../resources/data/usuarios.txt', 'a');
    fwrite($fp, "Nombre: $nombre, Apellido: $apellido, Email: $email\n");
    fclose($fp);
}
function guardarUsuarioTXT2($nombre, $apellido, $email)
{
    $archivo = '../resources/data/usuarios.txt';
    $usuarios = array();

    // Leer el contenido del archivo TXT
    if (file_exists($archivo)) {
        $fp = fopen($archivo, 'r');
        while (($linea = fgets($fp)) !== FALSE) {
            $usuario = explode(',', $linea);
            $usuarios[] = $usuario;
        }
        fclose($fp);
    }

    // Comprobar si el usuario ya existe
    foreach ($usuarios as $usuario) {
        if ($usuario[2] == $email) {
            echo "Error: Usuario ya existente.";
            return;
        }
    }

    // Si no existe, agregarlo al array de usuarios
    $nuevoUsuario = array($nombre, $apellido, $email);
    $usuarios[] = $nuevoUsuario;

    // Guardar el array de usuarios en el archivo TXT
    $fp = fopen($archivo, 'w');
    foreach ($usuarios as $usuario) {
        fwrite($fp, implode(',', $usuario) . "\n");
    }
    fclose($fp);

    echo "Usuario agregado con éxito.";
}

//JSON. Realiza un sistema que gestione el guardado de nuevo usuarios en un archivo .JSON, manteniendo los nuevos ya existentes.
function guardarUsuarioJSON($nombre, $apellido, $email)
{
    $usuarios = json_decode(file_get_contents('../resources/data/usuarios.json'), true);
    $usuario = array('nombre' => $nombre, 'apellido' => $apellido, 'email' => $email);
    $usuarios[] = $usuario;
    file_put_contents('../resources/data/usuarios.json', json_encode($usuarios, JSON_PRETTY_PRINT));
}
function guardarUsuarioJSON2($nombre, $apellido, $email)
{
    $archivo = '../resources/data/usuarios.json';
    $usuarios = json_decode(file_get_contents($archivo), true);

    // Comprobar si el usuario ya existe
    foreach ($usuarios as $usuario) {
        if ($usuario['email'] == $email) {
            echo "Error: Usuario ya existente.";
            return;
        }
    }

    // Si no existe, agregarlo al array de usuarios
    $nuevoUsuario = array('nombre' => $nombre, 'apellido' => $apellido, 'email' => $email);
    $usuarios[] = $nuevoUsuario;

    // Guardar el array de usuarios en el archivo JSON
    file_put_contents($archivo, json_encode($usuarios, JSON_PRETTY_PRINT));

    echo "Usuario agregado con éxito.";
}

//Funciones de validación.
function validarEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validarTelefono($telefono)
{
    return preg_match('/^(\+34|0034|34)?[ ]?(\(?\d{3}\)?[ ]?\d{3}[ ]?\d{3})$/', $telefono);
}

function validarFecha($fecha)
{
    return preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/', $fecha);
}

function validarHora($hora)
{
    return preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})$/', $hora);
}

function validarNombre($nombre)
{
    return preg_match('/^[a-zA-Z]+$/', $nombre);
}

function validarPassword($password)
{
    return preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password);
}

function validarDNI($dni)
{
    return preg_match('/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i', $dni);
}

function validarTextareaRegex($textarea)
{
    $patron = '/^[a-zA-Z0-9\s\.,!?-]+$/';
    if (preg_match($patron, $textarea)) {
        return true;
    } else {
        return false;
    }
}

//Función arreglar textareas
function validarTextarea($textarea)
{
    // Eliminar etiquetas HTML
    $textarea = strip_tags($textarea);

    // Eliminar caracteres especiales
    $textarea = preg_replace('/[^a-zA-Z0-9\s\.,!?-]/', '', $textarea);

    // Eliminar espacios en blanco múltiples
    $textarea = preg_replace('/\s+/', ' ', $textarea);

    // Eliminar saltos de línea múltiples
    $textarea = preg_replace('/\n+/', "\n", $textarea);

    return $textarea;
}

//Gestión tiempoSesión
// Configuración de la sesión
$tiempoSesion = 30; // Tiempo de sesión en segundos

// Iniciar la sesión
session_start();

// Comprobar si la sesión ha expirado
if (isset($_SESSION['ultimo_acceso'])) {
    $tiempo_actual = time();
    $tiempo_ultimo_acceso = $_SESSION['ultimo_acceso'];
    $diferencia_tiempo = $tiempo_actual - $tiempo_ultimo_acceso;

    // Comprobar si ha pasado el tiempo de sesión
    if ($diferencia_tiempo > $tiempoSesion) {
        // Destruir la sesión
        session_destroy();
        //Aquí ponemos el header a la web de login;
        exit;
    }
}

// Actualizar el tiempo de último acceso
$_SESSION['ultimo_acceso'] = time();
