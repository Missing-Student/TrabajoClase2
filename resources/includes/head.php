<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen</title>
    <!-- CSS -->
    <link rel="stylesheet" href="/css/estilos.css">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Modificaciones con cookies -->
    <style>
        .header {
            background-color: <?php echo $_COOKIE['color_encabezado'] ?? '#000000'; ?>;
        }

        .nav {
            background-color: <?php echo $_COOKIE['color_encabezado'] ?? '#000000'; ?>;
        }

        .main {
            background-color: <?php echo $_COOKIE['color_fondo'] ?? '#666'; ?>;
        }

        .footer {
            background-color: <?php echo $_COOKIE['color_pie'] ?? '#000000'; ?>;
        }

        .contenido_footer {
            background-color: <?php echo $_COOKIE['color_pie'] ?? '#000000'; ?>;
        }
    </style>
</head>