<!DOCTYPE html>
<html>
<head>
    <title>Registros de Usuarios</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<button id="botonInsertar" onclick="location.href='index.php'">Volver</button>
<?php
// Iniciar una nueva sesión o reanudar la existente
session_start();

// Conexión a la base de datos
include("conexion2.php");

// Consulta SQL para obtener todos los usuarios
$sql = "SELECT * FROM usuarios";
$result = $db->query($sql);

// Comprobamos si la consulta ha devuelto resultados
if ($result) {
    // Creamos una tabla para mostrar los resultados
    echo "<table>";
    echo "<tr><th></th><th>ID</th><th>Primer Nombre</th><th>Segundo Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Género</th><th>Documento de Identidad</th><th>Fecha de Nacimiento</th><th>Nombre de Usuario</th><th>Correo Electrónico</th><th>Número de Teléfono</th><th>Dirección</th><th>Ciudad</th><th>Estado</th><th>País</th><th>Código Postal</th><th>Rol</th><th>Es Administrador</th><th>Es Maestro</th><th>Fecha de Registro</th><th>Fecha Último Ingreso</th></tr>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        if (isset($_SESSION['nombre_usuario'])) {
            $nombre_usuario = $_SESSION['nombre_usuario'];
            $stmt = $db->prepare("SELECT es_maestro FROM usuarios WHERE nombre_usuario = ?");
            $stmt->execute([$nombre_usuario]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user['es_maestro']) {
                echo '<td><a href="borrarUsuario.php?id=' . $row['id'] . '"><button>Borrar</button></a></td>';
            } else {
                echo '<td></td>';
            }
        }
        foreach ($row as $key => $value) {
            if ($key != 'contraseña') {
                echo "<td>" . $value . "</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron usuarios.";
}
?>
</body>
</html>
