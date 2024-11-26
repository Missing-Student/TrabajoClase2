<?php

declare(strict_types=1);
session_start();

if (isset($_SESSION['token'])) {
  unset($_SESSION['token']);
}

//Redirigir al login si no hay usuario
if (!isset($_SESSION['usuario'])) {
  header('Location: /');
  exit;
}
session_destroy();

//Destruimos las cookies de los colores.
setcookie('color_fondo', '', time() - 3600);
setcookie('color_encabezado', '', time() - 3600);
setcookie('color_pie', '', time() - 3600);

header("refresh:2;url=/");
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
        <h2>Será redirigido a la página de login en 2 segundos</h2>
      </div>
    </main>
    <?php
    include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'footer.php';
    ?>
  </div>
</body>

</html>