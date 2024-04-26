<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("conexion2.php");

    // Verificar que los campos obligatorios no estén vacíos
    $camposObligatorios = ['primer_nombre', 'primer_apellido', 'prefijo_identidad', 'numero_identidad', 'nombre_usuario', 'correo_electronico', 'contraseña', 'fecha_nacimiento', 'direccion', 'ciudad', 'estado', 'pais', 'numero_telefono', 'genero', 'pregunta_secreta', 'respuesta_secreta'];

    foreach ($camposObligatorios as $campo) {
        if (empty($_POST[$campo])) {
            die("Error: El campo $campo es obligatorio.");
        }
    }

    // Verificar que el correo electrónico, el documento de identidad y el nombre de usuario sean únicos
    $camposUnicos = ['correo_electronico', 'documenti_identidad', 'nombre_usuario'];
    foreach ($camposUnicos as $campo) {
        $stmt = $db->prepare("SELECT COUNT(*) FROM usuarios WHERE $campo = :valor");
        $stmt->bindParam(':valor', $_POST[$campo]);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) {
            die("Error: El $campo ya está en uso.");
        }
    }

    // Verificar que las contraseñas coincidan
    if ($_POST['contraseña'] != $_POST['confirmar_contraseña']) {
        die("Error: Las contraseñas no coinciden.");
    }

    // Si todo está bien, insertar el nuevo usuario
    $sql = "INSERT INTO usuarios (primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, genero, documenti_identidad, fecha_nacimiento, nombre_usuario, correo_electronico, numero_telefono, direccion, ciudad, estado, pais, codigo_postal, contraseña, pregunta_secreta, respuesta_secreta) VALUES (:primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, :genero, :documenti_identidad, :fecha_nacimiento, :nombre_usuario, :correo_electronico, :numero_telefono, :direccion, :ciudad, :estado, :pais, :codigo_postal, :contraseña, :pregunta_secreta, :respuesta_secreta)";

    $stmt = $db->prepare($sql);

    $contraseña_hash = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

    $stmt->bindParam(':primer_nombre', $_POST['primer_nombre']);
    $stmt->bindParam(':segundo_nombre', $_POST['segundo_nombre']);
    $stmt->bindParam(':primer_apellido', $_POST['primer_apellido']);
    $stmt->bindParam(':segundo_apellido', $_POST['segundo_apellido']);
    $stmt->bindParam(':genero', $_POST['genero']);
    $documenti_identidad = $_POST['prefijo_identidad'] . $_POST['numero_identidad'];
    $stmt->bindParam(':documenti_identidad', $documenti_identidad);
    $stmt->bindParam(':fecha_nacimiento', $_POST['fecha_nacimiento']);
    $stmt->bindParam(':nombre_usuario', $_POST['nombre_usuario']);
    $stmt->bindParam(':correo_electronico', $_POST['correo_electronico']);
    $stmt->bindParam(':numero_telefono', $_POST['numero_telefono']);
    $stmt->bindParam(':direccion', $_POST['direccion']);
    $stmt->bindParam(':ciudad', $_POST['ciudad']);
    $stmt->bindParam(':estado', $_POST['estado']);
    $stmt->bindParam(':pais', $_POST['pais']);
    $stmt->bindParam(':codigo_postal', $_POST['codigo_postal']);
    $stmt->bindParam(':contraseña', $contraseña_hash);
    $stmt->bindParam(':pregunta_secreta', $_POST['pregunta_secreta']);
    $stmt->bindParam(':respuesta_secreta', $_POST['respuesta_secreta']);

    $stmt->execute();

    // Redirige al usuario a index.php después de un registro exitoso
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuarios</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        .obligatorio::after {
            content: " *";
            color: red;
        }
    </style>
</head>
<body class="body-registro">
    <form class="formulario-registro" method="POST">
    <h2>Formulario de Registro</h2> 
        <!-- Tus campos existentes -->
        <label class="obligatorio">Primer Nombre</label>: <input type="text" name="primer_nombre" required><br>
        Segundo Nombre: <input type="text" name="segundo_nombre"><br>
        <label class="obligatorio">Primer Apellido</label>: <input type="text" name="primer_apellido" required><br>
        Segundo Apellido: <input type="text" name="segundo_apellido"><br>
        <label class="obligatorio">Género</label>: 
        <select name="genero" required>
            <option value="">Selecciona...</option>
            <option value="Hombre">Hombre</option>
            <option value="Mujer">Mujer</option>
            <option value="Prefiero no decirlo">Prefiero no decirlo</option>
        </select><br>
        <label class="obligatorio">Documento de Identidad</label>: 
        <div class="input-group-identidad">
            <select name="prefijo_identidad" required>
                <option value="">...</option>
                <option value="V-">V-</option>
                <option value="E-">E-</option>
            </select>
            <input type="text" name="numero_identidad" required>
        </div>
        <br>
        <label class="obligatorio">Fecha de Nacimiento</label>: <input type="date" name="fecha_nacimiento" required><br>
        <label class="obligatorio">Nombre de Usuario</label>: <input type="text" name="nombre_usuario" required><br>
        <label class="obligatorio">Correo Electrónico</label>: <input type="email" name="correo_electronico" required><br>
        <label class="obligatorio">Número de Teléfono</label>: <input type="text" name="numero_telefono" required><br>
        <label class="obligatorio">Dirección</label>: <input type="text" name="direccion" required><br>
        <label class="obligatorio">Ciudad</label>: <input type="text" name="ciudad" required><br>
        <label class="obligatorio">Estado</label>: <input type="text" name="estado" required><br>
        <label class="obligatorio">País</label>: <input type="text" name="pais" required><br>
        Código Postal: <input type="text" name="codigo_postal"><br>
        <label class="obligatorio">Contraseña</label>: <input type="password" name="contraseña" required><br>
        <label class="obligatorio">Confirmar Contraseña</label>: <input type="password" name="confirmar_contraseña" required><br>
        <label class="obligatorio">Pregunta Secreta</label>: 
        <select name="pregunta_secreta" required>
            <option value="">Selecciona...</option>
            <option value="lugar_nacimiento_papa">¿Cuál es el lugar de nacimiento de tu papá?</option>
            <option value="nombre_primera_mascota">¿Cuál es el nombre de tu primera mascota?</option>
            <option value="apellido_soltera_mama">¿Cuál es el apellido de soltera de tu mamá?</option>
            <option value="nombre_mejor_amigo">¿Cuál es el nombre de tu mejor amigo de la infancia?</option>
            <option value="nombre_colegio_primaria">¿Cuál es el nombre de tu colegio de primaria?</option>
            <option value="ciudad_favorita">¿Cuál es tu ciudad favorita para visitar?</option>
        </select><br>
        <label class="obligatorio">Respuesta Secreta</label>: <input type="text" name="respuesta_secreta" required><br>
        <input type="submit" value="Registrar">
        <button id="botonRegreso" onclick="location.href='iniciarSesion.php'">Volver</button>
    </form>
</body>
</html>
