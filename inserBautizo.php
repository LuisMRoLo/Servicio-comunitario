<?php
    session_start();
    include("conexion2.php");
    if ($user['es_administrador']) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST['primer_nombre']) || empty($_POST['primer_apellido']) || empty($_POST['lugar_de_nacimiento']) || empty($_POST['dia_de_nacimiento']) || empty($_POST['mes_de_nacimiento']) || empty($_POST['ano_de_nacimiento']) || empty($_POST['dia_de_bautizo']) || empty($_POST['mes_de_bautizo']) || empty($_POST['ano_de_bautizo']) || empty($_POST['primer_nombre_ministro']) || empty($_POST['primer_apellido_ministro']) || empty($_POST['numero_registro_civil']) || empty($_POST['ano_registro_civil']) || ((empty($_POST['primer_nombre_padrino']) || empty($_POST['primer_apellido_padrino'])) && (empty($_POST['primer_nombre_padrina']) || empty($_POST['primer_apellido_padrina'])) || ((empty($_POST['primer_nombre_papa']) || empty($_POST['primer_apellido_papa'])) && (empty($_POST['primer_nombre_mama']) || empty($_POST['primer_apellido_mama']))))) {
            echo 'Por favor, completa todos los campos obligatorios.';
        } else if ((empty($_POST['primer_nombre_padrino']) && empty($_POST['primer_apellido_padrino'])) && (empty($_POST['primer_nombre_padrina']) && empty($_POST['primer_apellido_padrina']))) {
            echo 'Por favor, completa los campos requeridos de los padrinos.';
        } else if ((empty($_POST['primer_nombre_papa']) && empty($_POST['primer_apellido_papa'])) && (empty($_POST['primer_nombre_mama']) && empty($_POST['primer_apellido_mama']))) {
            echo 'Por favor, completa los campos requeridos de los padres.';
        } else {
            $stmt = $db->prepare('INSERT INTO "bautizos" (
                "primer_nombre", 
                "segundo_nombre", 
                "primer_apellido", 
                "segundo_apellido", 
                "primer_nombre_papa", 
                "segundo_nombre_papa", 
                "primer_apellido_papa", 
                "segundo_apellido_papa", 
                "primer_nombre_mama", 
                "segundo_nombre_mama", 
                "primer_apellido_mama", 
                "segundo_apellido_mama", 
                "filiacion", 
                "lugar_de_nacimiento", 
                "dia_de_nacimiento", 
                "mes_de_nacimiento", 
                "ano_de_nacimiento", 
                "dia_de_bautizo", 
                "mes_de_bautizo", 
                "ano_de_bautizo", 
                "primer_nombre_padrino", 
                "segundo_nombre_padrino", 
                "primer_apellido_padrino", 
                "segundo_apellido_padrino", 
                "primer_nombre_padrina", 
                "segundo_nombre_padrina", 
                "primer_apellido_padrina", 
                "segundo_apellido_padrina", 
                "primer_nombre_ministro", 
                "segundo_nombre_ministro", 
                "primer_apellido_ministro", 
                "segundo_apellido_ministro", 
                "observacion", 
                "numero_registro_civil", 
                "ano_registro_civil"
            ) VALUES (
                :primer_nombre, 
                :segundo_nombre, 
                :primer_apellido, 
                :segundo_apellido, 
                :primer_nombre_papa, 
                :segundo_nombre_papa, 
                :primer_apellido_papa, 
                :segundo_apellido_papa, 
                :primer_nombre_mama, 
                :segundo_nombre_mama, 
                :primer_apellido_mama, 
                :segundo_apellido_mama, 
                :filiacion, 
                :lugar_de_nacimiento, 
                :dia_de_nacimiento, 
                :mes_de_nacimiento, 
                :ano_de_nacimiento, 
                :dia_de_bautizo, 
                :mes_de_bautizo, 
                :ano_de_bautizo, 
                :primer_nombre_padrino, 
                :segundo_nombre_padrino, 
                :primer_apellido_padrino, 
                :segundo_apellido_padrino, 
                :primer_nombre_padrina, 
                :segundo_nombre_padrina, 
                :primer_apellido_padrina, 
                :segundo_apellido_padrina, 
                :primer_nombre_ministro, 
                :segundo_nombre_ministro, 
                :primer_apellido_ministro, 
                :segundo_apellido_ministro, 
                :observacion, 
                :numero_registro_civil, 
                :ano_registro_civil
            )');

            $stmt->bindValue(':primer_nombre', $_POST['primer_nombre'], PDO::PARAM_STR);
            $stmt->bindValue(':segundo_nombre', $_POST['segundo_nombre'], PDO::PARAM_STR);
            $stmt->bindValue(':primer_apellido', $_POST['primer_apellido'], PDO::PARAM_STR);
            $stmt->bindValue(':segundo_apellido', $_POST['segundo_apellido'], PDO::PARAM_STR);
            $stmt->bindValue(':primer_nombre_papa', $_POST['primer_nombre_papa'], PDO::PARAM_STR);
            $stmt->bindValue(':segundo_nombre_papa', $_POST['segundo_nombre_papa'], PDO::PARAM_STR);
            $stmt->bindValue(':primer_apellido_papa', $_POST['primer_apellido_papa'], PDO::PARAM_STR);
            $stmt->bindValue(':segundo_apellido_papa', $_POST['segundo_apellido_papa'], PDO::PARAM_STR);
            $stmt->bindValue(':primer_nombre_mama', $_POST['primer_nombre_mama'], PDO::PARAM_STR);
            $stmt->bindValue(':segundo_nombre_mama', $_POST['segundo_nombre_mama'], PDO::PARAM_STR);
            $stmt->bindValue(':primer_apellido_mama', $_POST['primer_apellido_mama'], PDO::PARAM_STR);
            $stmt->bindValue(':segundo_apellido_mama', $_POST['segundo_apellido_mama'], PDO::PARAM_STR);
            $stmt->bindValue(':filiacion', $_POST['filiacion'], PDO::PARAM_STR);
            $stmt->bindValue(':lugar_de_nacimiento', $_POST['lugar_de_nacimiento'], PDO::PARAM_STR);
            $stmt->bindValue(':dia_de_nacimiento', $_POST['dia_de_nacimiento'], PDO::PARAM_STR);
            $stmt->bindValue(':mes_de_nacimiento', $_POST['mes_de_nacimiento'], PDO::PARAM_STR);
            $stmt->bindValue(':ano_de_nacimiento', $_POST['ano_de_nacimiento'], PDO::PARAM_INT);
            $stmt->bindValue(':dia_de_bautizo', $_POST['dia_de_bautizo'], PDO::PARAM_STR);
            $stmt->bindValue(':mes_de_bautizo', $_POST['mes_de_bautizo'], PDO::PARAM_STR);
            $stmt->bindValue(':ano_de_bautizo', $_POST['ano_de_bautizo'], PDO::PARAM_INT);
            $stmt->bindValue(':primer_nombre_padrino', $_POST['primer_nombre_padrino'], PDO::PARAM_STR);
            $stmt->bindValue(':segundo_nombre_padrino', $_POST['segundo_nombre_padrino'], PDO::PARAM_STR);
            $stmt->bindValue(':primer_apellido_padrino', $_POST['primer_apellido_padrino'], PDO::PARAM_STR);
            $stmt->bindValue(':segundo_apellido_padrino', $_POST['segundo_apellido_padrino'], PDO::PARAM_STR);
            $stmt->bindValue(':primer_nombre_padrina', $_POST['primer_nombre_padrina'], PDO::PARAM_STR);
            $stmt->bindValue(':segundo_nombre_padrina', $_POST['segundo_nombre_padrina'], PDO::PARAM_STR);
            $stmt->bindValue(':primer_apellido_padrina', $_POST['primer_apellido_padrina'], PDO::PARAM_STR);
            $stmt->bindValue(':segundo_apellido_padrina', $_POST['segundo_apellido_padrina'], PDO::PARAM_STR);
            $stmt->bindValue(':primer_nombre_ministro', $_POST['primer_nombre_ministro'], PDO::PARAM_STR);
            $stmt->bindValue(':segundo_nombre_ministro', $_POST['segundo_nombre_ministro'], PDO::PARAM_STR);
            $stmt->bindValue(':primer_apellido_ministro', $_POST['primer_apellido_ministro'], PDO::PARAM_STR);
            $stmt->bindValue(':segundo_apellido_ministro', $_POST['segundo_apellido_ministro'], PDO::PARAM_STR);
            $stmt->bindValue(':observacion', $_POST['observacion'], PDO::PARAM_STR);
            $stmt->bindValue(':numero_registro_civil', $_POST['numero_registro_civil'], PDO::PARAM_INT);
            $stmt->bindValue(':ano_registro_civil', $_POST['ano_registro_civil'], PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo 'Bautizo agregado exitosamente!';
            } else {
                echo 'Hubo un error al agregar el bautizo.';
            }
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Agregar Bautizo</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body class="centro">
    <h1>Agregar Bautizo</h1>
    <form class="formulario-estilizado" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="primer_nombre" class="obligatorio">Primer Nombre:</label><br>
        <input type="text" id="primer_nombre" name="primer_nombre" required><br>
        <label for="segundo_nombre">Segundo Nombre:</label><br>
        <input type="text" id="segundo_nombre" name="segundo_nombre"><br>
        <label for="primer_apellido" class="obligatorio">Primer Apellido:</label><br>
        <input type="text" id="primer_apellido" name="primer_apellido" required><br>
        <label for="segundo_apellido">Segundo Apellido:</label><br>
        <input type="text" id="segundo_apellido" name="segundo_apellido"><br>
        <label for="primer_nombre_papa">Primer Nombre del Papa:</label><br>
        <input type="text" id="primer_nombre_papa" name="primer_nombre_papa"><br>
        <label for="segundo_nombre_papa">Segundo Nombre del Papa:</label><br>
        <input type="text" id="segundo_nombre_papa" name="segundo_nombre_papa"><br>
        <label for="primer_apellido_papa">Primer Apellido del Papa:</label><br>
        <input type="text" id="primer_apellido_papa" name="primer_apellido_papa"><br>
        <label for="segundo_apellido_papa">Segundo Apellido del Papa:</label><br>
        <input type="text" id="segundo_apellido_papa" name="segundo_apellido_papa"><br>
        <label for="primer_nombre_mama">Primer Nombre de la Mama:</label><br>
        <input type="text" id="primer_nombre_mama" name="primer_nombre_mama"><br>
        <label for="segundo_nombre_mama">Segundo Nombre de la Mama:</label><br>
        <input type="text" id="segundo_nombre_mama" name="segundo_nombre_mama"><br>
        <label for="primer_apellido_mama">Primer Apellido de la Mama:</label><br>
        <input type="text" id="primer_apellido_mama" name="primer_apellido_mama"><br>
        <label for="segundo_apellido_mama">Segundo Apellido de la Mama:</label><br>
        <input type="text" id="segundo_apellido_mama" name="segundo_apellido_mama"><br>
        <label for="filiacion">Filiación:</label><br>
        <input type="text" id="filiacion" name="filiacion"><br>
        <label for="lugar_de_nacimiento" class="obligatorio">Lugar de Nacimiento:</label><br>
        <input type="text" id="lugar_de_nacimiento" name="lugar_de_nacimiento" required><br>
        <label for="dia_de_nacimiento" class="obligatorio">Día de Nacimiento:</label><br>
        <input type="text" id="dia_de_nacimiento" name="dia_de_nacimiento" required pattern="\d{1,2}"><br>
        <label for="mes_de_nacimiento" class="obligatorio">Mes de Nacimiento:</label><br>
        <input type="text" id="mes_de_nacimiento" name="mes_de_nacimiento" required pattern="\d{1,2}"><br>
        <label for="ano_de_nacimiento" class="obligatorio">Año de Nacimiento:</label><br>
        <input type="text" id="ano_de_nacimiento" name="ano_de_nacimiento" required pattern="\d{4}"><br>
        <label for="dia_de_bautizo" class="obligatorio">Día de Bautizo:</label><br>
        <input type="text" id="dia_de_bautizo" name="dia_de_bautizo" required pattern="\d{1,2}"><br>
        <label for="mes_de_bautizo" class="obligatorio">Mes de Bautizo:</label><br>
        <input type="text" id="mes_de_bautizo" name="mes_de_bautizo" required pattern="\d{1,2}"><br>
        <label for="ano_de_bautizo" class="obligatorio">Año de Bautizo:</label><br>
        <input type="text" id="ano_de_bautizo" name="ano_de_bautizo" required pattern="\d{4}"><br>
        <label for="primer_nombre_padrino">Primer Nombre del Padrino:</label><br>
        <input type="text" id="primer_nombre_padrino" name="primer_nombre_padrino"><br>
        <label for="segundo_nombre_padrino">Segundo Nombre del Padrino:</label><br>
        <input type="text" id="segundo_nombre_padrino" name="segundo_nombre_padrino"><br>
        <label for="primer_apellido_padrino">Primer Apellido del Padrino:</label><br>
        <input type="text" id="primer_apellido_padrino" name="primer_apellido_padrino"><br>
        <label for="segundo_apellido_padrino">Segundo Apellido del Padrino:</label><br>
        <input type="text" id="segundo_apellido_padrino" name="segundo_apellido_padrino"><br>
        <label for="primer_nombre_padrina">Primer Nombre de la Madrina:</label><br>
        <input type="text" id="primer_nombre_padrina" name="primer_nombre_padrina"><br>
        <label for="segundo_nombre_padrina">Segundo Nombre de la Madrina:</label><br>
        <input type="text" id="segundo_nombre_padrina" name="segundo_nombre_padrina"><br>
        <label for="primer_apellido_padrina">Primer Apellido de la Madrina:</label><br>
        <input type="text" id="primer_apellido_padrina" name="primer_apellido_padrina"><br>
        <label for="segundo_apellido_padrina">Segundo Apellido de la Madrina:</label><br>
        <input type="text" id="segundo_apellido_padrina" name="segundo_apellido_padrina"><br>
        <label for="primer_nombre_ministro" class="obligatorio">Primer Nombre del Ministro:</label><br>
        <input type="text" id="primer_nombre_ministro" name="primer_nombre_ministro" required><br>
        <label for="segundo_nombre_ministro">Segundo Nombre del Ministro:</label><br>
        <input type="text" id="segundo_nombre_ministro" name="segundo_nombre_ministro"><br>
        <label for="primer_apellido_ministro" class="obligatorio">Primer Apellido del Ministro:</label><br>
        <input type="text" id="primer_apellido_ministro" name="primer_apellido_ministro" required><br>
        <label for="segundo_apellido_ministro">Segundo Apellido del Ministro:</label><br>
        <input type="text" id="segundo_apellido_ministro" name="segundo_apellido_ministro"><br>
        <label for="observacion">Observación:</label><br>
        <input type="text" id="observacion" name="observacion"><br>
        <label for="numero_registro_civil" class="obligatorio">Número de Registro Civil:</label><br>
        <input type="text" id="numero_registro_civil" name="numero_registro_civil" required pattern="\d+"><br>
        <label for="ano_registro_civil" class="obligatorio">Año de Registro Civil:</label><br>
        <input type="text" id="ano_registro_civil" name="ano_registro_civil" required pattern="\d{4}"><br>
        <input type="submit" value="Agregar Bautizo">
    </form>
    <button id="botonRegreso" onclick="location.href='indexBautizo.php'">Volver</button>
</body>
</html>
