<?php

declare(strict_types=1);
session_start();

//Si existe ya un token al entrar, lo quitas. Esto evita problemas de no mandar el formulario, cambiar de página, volver a esta y mandarlo.
if (isset($_SESSION['token'])) {
    unset($_SESSION['token']);
}

//Controlar el tiempo de sesión. $_SESSION['timeout'] = time(); Esto va en la bienvenida porque es la web en la que entramos primero.
if (isset($_SESSION['timeout'])) {
    $tiempoNavegando = time() - $_SESSION['timeout'];
    if ($tiempoNavegando >= $_SESSION['tiempoSesion']) {
        session_destroy();
        header('Location: /');
        exit;
    }
}
?>
<?php
//Declaramos los regex.
$regexUsuario = '^[a-zA-Z]{1,20}$';
$regexContraseña = '^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$';

//Declaramos la variable que guardaremos en el JSON de usuarios.
$datosUsuarios = [];

//Declaramos la variable para el manejo de error.
$error = false;
$mensajeError = '';

//Cuando se envíe el cuestionario.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Validación usuario.
    if (!preg_match("/$regexUsuario/", $_POST['usuario'])) {
        $error = true;
        $mensajeError .= '<li>' . "Nombre de usuario no válido." . '</li>';
    }

    //Validación contraseña.
    if (!preg_match("/$regexContraseña/", $_POST['contraseña'])) {
        $error = true;
        $mensajeError .= '<li>' . "Contraseña no válida." . '</li>';
    }

    //Validación nombre.
    if (!preg_match("/$regexUsuario/", $_POST['nombre'])) {
        $error = true;
        $mensajeError .= '<li>' . "Nombre no válido." . '</li>';
    }

    //Validación tiempo de sesión.
    if (!filter_var($_POST['tiempoSesion'], FILTER_VALIDATE_INT) || $_POST['tiempoSesion'] <= 0) {
        $error = true;
        $mensajeError .= '<li>' . "Tiempo de sesión no válido." . '</li>';
    }

    //Validación rol.
    if ($_POST['rol'] !== "administrador" && $_POST['rol'] !== "usuario") {
        $error = true;
        $mensajeError .= '<li>' . "Rol no válido." . '</li>';
    }

    //Comprobamos que el nombre de usuario no exista ya, y si no existe lo añadimos.
    if (!$error) {

        $contenidoJSON = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'ficheros' . DIRECTORY_SEPARATOR . 'usuarios.json');
        $usuariosExistentes = json_decode($contenidoJSON, true);
        $usuarioEncontrado = false;

        foreach ($usuariosExistentes as $usuario) {
            if ($usuario['usuario'] === $_POST['usuario']) {
                $error = true;
                $usuarioEncontrado = true;
                $mensajeError .= '<li>' . "Usuario ya existente." . '</li>';
            }
        }

        if (!$usuarioEncontrado) {
            $datosUsuarios['usuario'] = $_POST['usuario'];
            $datosUsuarios['contraseña'] = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
            $datosUsuarios['nombre'] = $_POST['nombre'];
            $datosUsuarios['tiempoSesion'] = $_POST['tiempoSesion'];
            $datosUsuarios['rol'] = $_POST['rol'];

            //Añadimos los datos del nuevo usuario al array de usuarios existentes.
            $usuariosExistentes[] = $datosUsuarios;

            //Guardamos los nuevos usuarios existentes en el JSON. file_put_contents requiere todo esto porque sobrescribe el JSON.
            file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'ficheros' . DIRECTORY_SEPARATOR . 'usuarios.json', json_encode($usuariosExistentes, JSON_PRETTY_PRINT));

            //Redirigimos a la pagina de bienvenida.
            header('Location: /bienvenida');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'head.php';
?>

<body>
    <div class="container">
        <?php
        include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'header.php';
        ?>
        <main class="main">
            <div class="login">
                <h1 class="">¡Una cara nueva!</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="field">
                        <i class='bx bx-user'></i>
                        <input
                            class=""
                            type="text"
                            name="usuario"
                            id="usuario"
                            placeholder="Usuario"
                            required />
                    </div>
                    <div class="field">
                        <i class='bx bx-lock-alt'></i>
                        <input
                            class=""
                            type="password"
                            name="contraseña"
                            id="contraseña"
                            placeholder="Contraseña"
                            required />
                    </div>
                    <div class="field">
                        <i class='bx bxs-face'></i>
                        <input
                            class=""
                            type="text"
                            name="nombre"
                            id="nombre"
                            placeholder="Nombre"
                            required />
                    </div>
                    <div class="field">
                        <i class='bx bx-time'></i>
                        <input
                            class=""
                            type="number"
                            name="tiempoSesion"
                            id="tiempoSesion"
                            placeholder="Tiempo de sesión"
                            required />
                    </div>
                    <div class="field">
                        <i class='bx bx-hard-hat'></i>
                        <select
                            id="rol"
                            name="rol"
                            required>
                            <option value="administrador">Administrador</option>
                            <option value="usuario">Usuario</option>
                        </select>
                    </div>
                    <button
                        class="btn"
                        type="submit">
                        Sign in
                    </button>
                </form>
            </div>
            <?php
            if ($error) {
                echo '<div class="login" style="margin-left:1rem">' . '<h2>' . $mensajeError . '</h2>' . '</div>';
            }
            ?>
        </main>
        <?php
        include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'footer.php';
        ?>
    </div>
</body>

</html>