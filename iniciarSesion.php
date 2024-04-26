<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <?php
    session_start();
    include("conexion2.php");
    $mensaje = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre_usuario = $_POST['nombre_usuario'];
        $contraseña = $_POST['contraseña'];    
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ?");
        $stmt->execute([$nombre_usuario]);       
        if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($contraseña, $user['contraseña'])) {
                $_SESSION['nombre_usuario'] = $nombre_usuario;
                header('Location: index.php');
                exit;
            } else {
                $mensaje = "Contraseña incorrecta.";
            }
        } else {
            $mensaje = "Nombre de usuario incorrecto.";
        }
    }
    ?>

    <button id="botonInsertar" onclick="location.href='index.php'">Volver</button>
    <?php
    if ($mensaje != '') {
        echo '<p>' . $mensaje . '</p>';
    }
    ?>
    <form class="formulario-iniciar-Sesion" method="POST">
        Nombre de Usuario: <input type="text" name="nombre_usuario" required><br>
        Contraseña: <input type="password" name="contraseña" required><br>
        <a href="restablecerContrasena.php">¿Has olvidado tu contraseña?</a><br>
        <input type="submit" value="Iniciar Sesión">
        <a href="registroUsuario.php" id="botonInsertar">Registrarse</a>
    </form>   
</body>
</html>
