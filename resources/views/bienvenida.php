<?php

declare(strict_types=1);
session_start();

//Generar el token CSRF y guardarlo en la sesión.
if (!isset($_SESSION['token'])) {
  $token = bin2hex(random_bytes(32));
  $_SESSION['token'] = $token;
}

//Redirigir al login si no hay usuario
if (!isset($_SESSION['usuario'])) {
  header('Location: /');
  exit;
}

//Controlar el tiempo de sesión
if (isset($_SESSION['timeout'])) {
  $tiempoNavegando = time() - $_SESSION['timeout'];
  if ($tiempoNavegando >= $_SESSION['tiempoSesion']) {
    session_destroy();
    header('Location: /');
    exit;
  }
}
$_SESSION['timeout'] = time();
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

  if (!isset($_POST['token'], $_SESSION['token']) || $_POST['token'] !== $_SESSION['token']) {
    //Token CSRF no válido.
    $error = true;
    $mensajeError .= '<li>Token CSRF no válido.</li>';
  } else {
    //Eliminar el token.
    unset($_SESSION['token']);

    //Validación usuario.
    if (!preg_match("/$regexUsuario/", $_POST['usuario'])) {
      $error = true;
      $mensajeError .= '<li>' . "Nombre de usuario no válido." . '</li>';
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

    if (!$error) {

      $contenidoJSON = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'ficheros' . DIRECTORY_SEPARATOR . 'usuarios.json');
      $usuariosExistentes = json_decode($contenidoJSON, true);
      $usuarioEncontrado = false;

      //Comprobamos que el nombre de usuario no exista ya y que no sea el tuyo propio.
      foreach ($usuariosExistentes as $usuario) {
        if ($usuario['usuario'] === $_POST['usuario'] && $_POST['usuario'] !== $_SESSION['usuario']) {
          $error = true;
          $usuarioEncontrado = true;
          $mensajeError .= '<li>' . "Usuario ya existente." . '</li>';
        }
      }

      if (!$usuarioEncontrado) {
        foreach ($usuariosExistentes as $key => $usuario) {
          if ($usuario['usuario'] === $_SESSION['usuario']) {
            $usuariosExistentes[$key]['usuario'] = $_POST['usuario'];
            $usuariosExistentes[$key]['rol'] = $_POST['rol'];
            $usuariosExistentes[$key]['tiempoSesion'] = $_POST['tiempoSesion'];
            break;
          }
        }
        file_put_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'ficheros' . DIRECTORY_SEPARATOR . 'usuarios.json', json_encode($usuariosExistentes, JSON_PRETTY_PRINT));
      }
      //Guardamos los datos del nuevo usuario en la sesión.
      $_SESSION['usuario'] = $_POST['usuario'];
      $_SESSION['rol'] = $_POST['rol'];
      $_SESSION['tiempoSesion'] = $_POST['tiempoSesion'];
      $_SESSION['nombre'] = $_POST['nombre'];
      //Recargamos la página.
      header('Location: /bienvenida');
    }

    //Cookies para los colores.
    if (isset($_POST['color_fondo']) && isset($_POST['color_encabezado']) && isset($_POST['color_pie'])) {
      setcookie('color_fondo', $_POST['color_fondo'], time() + 3600);
      setcookie('color_encabezado', $_POST['color_encabezado'], time() + 3600);
      setcookie('color_pie', $_POST['color_pie'], time() + 3600);
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
        <h3>Bienvenido
          <?php
          echo $_SESSION['usuario'];
          ?></h3>
      </div>
      <div class="login">
        <h1 class="">Panel de usuario</h1>
        <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="token" value="<?php echo $token; ?>">
          <div class="field">
            <i class='bx bx-user'></i>
            <input
              class=""
              type="text"
              name="usuario"
              id="usuario"
              value="<?php echo $_SESSION['usuario']; ?>"
              required />
          </div>
          <div class="field">
            <i class='bx bxs-face'></i>
            <input
              class=""
              type="text"
              name="nombre"
              id="nombre"
              value="<?php echo $_SESSION['nombre']; ?>"
              required />
          </div>
          <div class="field">
            <i class='bx bx-time'></i>
            <input
              class=""
              type="number"
              name="tiempoSesion"
              id="tiempoSesion"
              value="<?php echo $_SESSION['tiempoSesion']; ?>"
              required />
          </div>
          <div class="field">
            <i class='bx bx-hard-hat'></i>
            <select
              id="rol"
              name="rol"
              value="<?php echo $_SESSION['rol']; ?>"
              required>
              <option value="administrador">Administrador</option>
              <option value="usuario">Usuario</option>
            </select>
          </div>
          <div class="field">
            <label for="color_fondo">Color de fondo:</label>
            <input type="color" id="color_fondo" name="color_fondo" value="<?php echo $_COOKIE['color_fondo'] ?? '#ffffff'; ?>">
          </div>
          <div class="field">
            <label for="color_encabezado">Color de encabezado:</label>
            <input type="color" id="color_encabezado" name="color_encabezado" class="w-full" value="<?php echo $_COOKIE['color_encabezado'] ?? '#000000'; ?>">
          </div>
          <div class="field">
            <label for="color_pie">Color de pie:</label>
            <input type="color" id="color_pie" name="color_pie" class="w-full" value="<?php echo $_COOKIE['color_pie'] ?? '#000000'; ?>">
          </div>
          <button
            class="btn"
            type="submit">
            Modificar
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