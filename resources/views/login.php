<?php

declare(strict_types=1);
session_start();

//Si intenta volver al login y ya ha "iniciado sesión", redirige a la bienvenida.
if (isset($_SESSION['usuario'])) {
    header('Location: /bienvenida');
    exit;
}
?>
<?php
//Declaramos los regex.
$regexUsuario = '^[a-zA-Z]{1,20}$';
$regexContraseña = '^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$';

//Declaramos la variable para el manejo de error.
$errorRegex = false;
$mensajeError = '';
$errorUsuario = false;
$errorContraseña = false;

//Cuando se envíe el cuestionario.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Validación usuario.
    if (!preg_match("/$regexUsuario/", $_POST['usuario'])) {
        $errorRegex = true;
        $mensajeError .= '<li>' . "Nombre de usuario no válido." . '</li>';
    }

    //Validación contraseña.
    if (!preg_match("/$regexContraseña/", $_POST['contraseña'])) {
        $errorRegex = true;
        $mensajeError .= '<li>' . "Contraseña no válida." . '</li>';
    }

    //Si pasa por los regex
    if (!$errorRegex) {
        $contenidoJSON = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'ficheros' . DIRECTORY_SEPARATOR . 'usuarios.json');
        $usuariosExistentes = json_decode($contenidoJSON, true);
        $usuarioEncontrado = false;

        //Por cada usuario, comprobamos si coincide con el usuario introducido.
        foreach ($usuariosExistentes as $usuario) {
            if ($usuario['usuario'] === $_POST['usuario']) {
                $usuarioEncontrado = true;
                //Si coincide el usuario, comprobamos la contraseña.
                if (password_verify($_POST['contraseña'], $usuario['contraseña'])) {
                    //Redirigimos a la pagina de bienvenida.
                    $_SESSION['usuario'] = $_POST['usuario'];
                    $_SESSION['rol'] = $usuario['rol'];
                    $_SESSION['nombre'] = $usuario['nombre'];
                    $_SESSION['tiempoSesion'] = $usuario['tiempoSesion'];
                    header('Location: /bienvenida');
                } else {
                    $errorContraseña = true;
                    $mensajeError .= '<li>' . "Contraseña incorrecta." . '</li>';
                }
            }
        }
        if (!$usuarioEncontrado) {
            $errorUsuario = true;
            $mensajeError .= '<li>' . "El usuario no existe." . '</li>';
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
                <h1 class="">Welcome back!</h1>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="field">
                        <i class='bx bx-user'></i>
                        <input
                            class=""
                            type="text"
                            name="usuario"
                            id="usuario"
                            placeholder="Usuario" />
                    </div>
                    <div class="field">
                        <i class='bx bx-lock-alt'></i>
                        <input
                            class=""
                            type="password"
                            name="contraseña"
                            id="contraseña"
                            placeholder="Contraseña" />
                    </div>
                    <button
                        class="btn"
                        type="submit">
                        Login
                    </button>
                    <div class="new_account">
                        <p>¿No tienes cuenta?
                            <a href="/registro">Regístrate</a>
                        </p>
                    </div>
                </form>
            </div>
            <?php
            if ($errorRegex || $errorContraseña || $errorUsuario) {
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