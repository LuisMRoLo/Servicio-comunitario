<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("conexion2.php");

    // Verificar que los campos obligatorios no estén vacíos
    $camposObligatorios = ['nombre_usuario', 'prefijo_identidad', 'numero_identidad', 'numero_telefono', 'correo_electronico', 'contraseña', 'confirmar_contraseña', 'pregunta_secreta', 'respuesta_secreta'];
    foreach ($camposObligatorios as $campo) {
        if (empty($_POST[$campo])) {
            die("Error: El campo $campo es obligatorio.");
        }
    }

    // Verificar que las contraseñas coincidan
    if ($_POST['contraseña'] != $_POST['confirmar_contraseña']) {
        die("Error: Las contraseñas no coinciden.");
    }

    // Verificar que el usuario exista y que los datos proporcionados coincidan
    $documenti_identidad = $_POST['prefijo_identidad'] . $_POST['numero_identidad'];
    $stmt = $db->prepare("SELECT COUNT(*) FROM usuarios WHERE nombre_usuario = :nombre_usuario AND documenti_identidad = :documenti_identidad AND numero_telefono = :numero_telefono AND correo_electronico = :correo_electronico AND pregunta_secreta = :pregunta_secreta AND respuesta_secreta = :respuesta_secreta");
    $stmt->bindParam(':nombre_usuario', $_POST['nombre_usuario']);
    $stmt->bindParam(':documenti_identidad', $documenti_identidad);
    $stmt->bindParam(':numero_telefono', $_POST['numero_telefono']);
    $stmt->bindParam(':correo_electronico', $_POST['correo_electronico']);
    $stmt->bindParam(':pregunta_secreta', $_POST['pregunta_secreta']);
    $stmt->bindParam(':respuesta_secreta', $_POST['respuesta_secreta']);
    $stmt->execute();
    if ($stmt->fetchColumn() == 0) {
        die("Error: Los datos proporcionados no coinciden con nuestros registros.");
    }

    // Si todo está bien, actualizar la contraseña del usuario
    $sql = "UPDATE usuarios SET contraseña = :contraseña WHERE nombre_usuario = :nombre_usuario";

    $stmt = $db->prepare($sql);

    $contraseña_hash = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

    $stmt->bindParam(':nombre_usuario', $_POST['nombre_usuario']);
    $stmt->bindParam(':contraseña', $contraseña_hash);

    $stmt->execute();

    // Redirige al usuario a index.php después de un restablecimiento de contraseña exitoso
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <form class="formulario-restablecer" method="POST">
    <h2>Restablecer Contraseña</h2> 
        <!-- Tus campos existentes -->
        <label>Nombre de Usuario</label>: <input type="text" name="nombre_usuario" required><br>
        <label>Documento de Identidad</label>: 
        <div class="input-group-identidad">
            <select name="prefijo_identidad" required>
                <option value="">...</option>
                <option value="V-">V-</option>
                <option value="E-">E-</option>
            </select>
            <input type="text" name="numero_identidad" required>
        </div>
        <br>
        <label>Número de Teléfono</label>: <input type="text" name="numero_telefono" required><br>
        <label>Correo Electrónico</label>: <input type="email" name="correo_electronico" required><br>
        <label>Pregunta Secreta</label>: 
        <select name="pregunta_secreta" required>
            <option value="">Selecciona...</option>
            <option value="lugar_nacimiento_papa">¿Cuál es el lugar de nacimiento de tu papá?</option>
            <option value="nombre_primera_mascota">¿Cuál es el nombre de tu primera mascota?</option>
            <option value="apellido_soltera_mama">¿Cuál es el apellido de soltera de tu mamá?</option>
            <option value="nombre_mejor_amigo">¿Cuál es el nombre de tu mejor amigo de la infancia?</option>
            <option value="nombre_colegio_primaria">¿Cuál es el nombre de tu colegio de primaria?</option>
            <option value="ciudad_favorita">¿Cuál es tu ciudad favorita para visitar?</option>
        </select><br>
        <label>Respuesta Secreta</label>: <input type="text" name="respuesta_secreta" required><br>
        <label>Nueva Contraseña</label>: <input type="password" name="contraseña" required><br>
        <label>Confirmar Nueva Contraseña</label>: <input type="password" name="confirmar_contraseña" required><br>
        <input type="submit" value="Restablecer Contraseña">
    </form>
</body>
</html>
