<!DOCTYPE html>
<html>
<head>
    <title>Página de Bienvenida</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <h1>Bienvenido a nuestra parroquia</h1>

    <?php
    session_start();
    include("conexion2.php");

    if (isset($_SESSION['nombre_usuario'])) {
        $nombre_usuario = $_SESSION['nombre_usuario'];
        $stmt = $db->prepare("SELECT es_maestro, es_administrador FROM usuarios WHERE nombre_usuario = ?");
        $stmt->execute([$nombre_usuario]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        echo '<p>Te damos la bienvenida ' . $_SESSION['nombre_usuario'] . '</p>';
        echo '<button id="cerrarSesion" onclick="window.location.href=\'cerrarSesion.php\'">Cerrar Sesión</button>';
    } else {
        echo '<button id="iniciarSesion" onclick="window.location.href=\'iniciarSesion.php\'">Iniciar Sesión</button>';
    }
    ?>

    <div class="menu-registros">
        <button>Registros</button>
        <div class="opciones-registros">
            <a href="indexBautizo.php">Bautizos</a>
            <a href="indexComunion.php">Comuniones</a>
            <a href="indexConfirmacion.php">Confirmaciones</a>
            <a href="indexMatrimonio.php">Matrimonios</a>
            <?php
            if (isset($user) && ($user['es_maestro'] || $user['es_administrador'])) {
                echo '<a href="cuentasRegistradas.php">Cuentas</a>';
            }
            ?>
        </div>
    </div>

</body>
</html>
