<?php
session_start(); // Iniciar una nueva sesión o reanudar la existente
include("conexion2.php");
$search = (isset($_GET['search'])) ? $_GET['search'] : '';
$column = (isset($_GET['column'])) ? $_GET['column'] : 'primer_nombre';
$stmt = $db->prepare("SELECT * FROM bautizos WHERE " . $column . " LIKE :search");
$stmt->execute(array(':search' => '%' . $search . '%'));
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registros de Bautizos</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<button id="botonInsertar" onclick="location.href='index.php'">Volver</button>
<?php
if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
    $stmt = $db->prepare("SELECT es_administrador FROM usuarios WHERE nombre_usuario = ?");
    $stmt->execute([$nombre_usuario]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user['es_administrador']) {
        echo '<button id="botonInsertar" onclick="location.href=\'inserBautizo.php\'">Insertar Bautizo</button>';
    }
    echo '<button id="cerrarSesion" onclick="window.location.href=\'cerrarSesion.php\'">Cerrar Sesión</button>';
    } else {
        echo '<button id="iniciarSesion" onclick="window.location.href=\'iniciarSesion.php\'">Iniciar Sesión</button>';
    }
?>

<script>
$(document).ready(function(){
    $("#updateButton").click(function(){
        $("#updateModal").show();
    });
});
</script>
    <form action="" method="get">
        <select name="column">
            <option value="primer_nombre">Primer Nombre</option>
            <option value="segundo_nombre">Segundo Nombre</option>
            <option value="primer_apellido">Primer Apellido</option>
            <option value="segundo_apellido">Segundo Apellido</option>
            <option value="primer_nombre_papa">Primer Nombre Papa</option>
            <option value="segundo_nombre_papa">Segundo Nombre Papa</option>
            <option value="primer_apellido_papa">Primer Apellido Papa</option>
            <option value="segundo_apellido_papa">Segundo Apellido Papa</option>
            <option value="primer_nombre_mama">Primer Nombre Mama</option>
            <option value="segundo_nombre_mama">Segundo Nombre Mama</option>
            <option value="primer_apellido_mama">Primer Apellido Mama</option>
            <option value="segundo_apellido_mama">Segundo Apellido Mama</option>
            <option value="filiacion">Filiacion</option>
            <option value="lugar_de_nacimiento">Ciudad de Nacimiento</option>
            <option value="dia_de_nacimiento">Dia de Nacimiento</option>
            <option value="mes_de_nacimiento">Mes de Nacimiento</option>
            <option value="ano_de_nacimiento">Año de Nacimiento</option>
            <option value="dia_de_bautizo">Dia de Bautizo</option>
            <option value="mes_de_bautizo">Mes de Bautizo</option>
            <option value="ano_de_bautizo">Año de Bautizo</option>
            <option value="primer_nombre_padrino">Primer Nombre Padrino</option>
            <option value="segundo_nombre_padrino">Segundo Nombre Padrino</option>
            <option value="primer_apellido_padrino">Primer Apellido Padrino</option>
            <option value="segundo_apellido_padrino">Segundo Apellido Padrino</option>
            <option value="primer_nombre_padrina">Primer Nombre Madrina</option>
            <option value="segundo_nombre_padrina">Segundo Nombre Madrina</option>
            <option value="primer_apellido_padrina">Primer Apellido Madrina</option>
            <option value="segundo_apellido_padrina">Segundo Apellido Madrina</option>
            <option value="primer_nombre_ministro">Primer Nombre Ministro</option>
            <option value="segundo_nombre_ministro">Segundo Nombre Ministro</option>
            <option value="primer_apellido_ministro">Primer Apellido Ministro</option>
            <option value="segundo_apellido_ministro">Segundo Apellido Ministro</option>
            <option value="observacion">Observacion</option>
            <option value="numero_registro_civil">Numero Registro Civil</option>
            <option value="ano_registro_civil">Año Registro Civil</option>
        </select>
        <input type="text" name="search" value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Buscar...">
        <input type="submit" value="Buscar">
    </form>

    <table>
    <tr>
    <th>ID</th>
    <th>Primer Nombre</th>
    <th>Segundo Nombre</th>
    <th>Primer Apellido</th>
    <th>Segundo Apellido</th>
    <th>Primer Nombre Papa</th>
    <th>Segundo Nombre Papa</th>
    <th>Primer Apellido Papa</th>
    <th>Segundo Apellido Papa</th>
    <th>Primer Nombre Mama</th>
    <th>Segundo Nombre Mama</th>
    <th>Primer Apellido Mama</th>
    <th>Segundo Apellido Mama</th>
    <th>Filiacion</th>
    <th>Lugar de Nacimiento</th>
    <th>Dia de Nacimiento</th>
    <th>Mes de Nacimiento</th>
    <th>Año de Nacimiento</th>
    <th>Dia de Bautizo</th>
    <th>Mes de Bautizo</th>
    <th>Año de Bautizo</th>
    <th>Primer Nombre Padrino</th>
    <th>Segundo Nombre Padrino</th>
    <th>Primer Apellido Padrino</th>
    <th>Segundo Apellido Padrino</th>
    <th>Primer Nombre Madrina</th>
    <th>Segundo Nombre Madrina</th>
    <th>Primer Apellido Madrina</th>
    <th>Segundo Apellido Madrina</th>
    <th>Primer Nombre Ministro</th>
    <th>Segundo Nombre Ministro</th>
    <th>Primer Apellido Ministro</th>
    <th>Segundo Apellido Ministro</th>
    <th>Observacion</th>
    <th>Numero Registro Civil</th>
    <th>Año Registro Civil</th>
</tr>

    <?php foreach ($data as $row): ?>
        <tr>
            <td><button onclick="location.href='documentoBautismo.php?id=<?php echo $row['id']; ?>'"><?php echo $row['id']; ?></button></td>
            <td><?php echo $row['primer_nombre']; ?></td>
            <td><?php echo $row['segundo_nombre']; ?></td>
            <td><?php echo $row['primer_apellido']; ?></td>
            <td><?php echo $row['segundo_apellido']; ?></td>
            <td><?php echo $row['primer_nombre_papa']; ?></td>
            <td><?php echo $row['segundo_nombre_papa']; ?></td>
            <td><?php echo $row['primer_apellido_papa']; ?></td>
            <td><?php echo $row['segundo_apellido_papa']; ?></td>
            <td><?php echo $row['primer_nombre_mama']; ?></td>
            <td><?php echo $row['segundo_nombre_mama']; ?></td>
            <td><?php echo $row['primer_apellido_mama']; ?></td>
            <td><?php echo $row['segundo_apellido_mama']; ?></td>
            <td><?php echo $row['filiacion']; ?></td>
            <td><?php echo $row['lugar_de_nacimiento']; ?></td>
            <td><?php echo $row['dia_de_nacimiento']; ?></td>
            <td><?php echo $row['mes_de_nacimiento']; ?></td>
            <td><?php echo $row['ano_de_nacimiento']; ?></td>
            <td><?php echo $row['dia_de_bautizo']; ?></td>
            <td><?php echo $row['mes_de_bautizo']; ?></td>
            <td><?php echo $row['ano_de_bautizo']; ?></td>
            <td><?php echo $row['primer_nombre_padrino']; ?></td>
            <td><?php echo $row['segundo_nombre_padrino']; ?></td>
            <td><?php echo $row['primer_apellido_padrino']; ?></td>
            <td><?php echo $row['segundo_apellido_padrino']; ?></td>
            <td><?php echo $row['primer_nombre_padrina']; ?></td>
            <td><?php echo $row['segundo_nombre_padrina']; ?></td>
            <td><?php echo $row['primer_apellido_padrina']; ?></td>
            <td><?php echo $row['segundo_apellido_padrina']; ?></td>
            <td><?php echo $row['primer_nombre_ministro']; ?></td>
            <td><?php echo $row['segundo_nombre_ministro']; ?></td>
            <td><?php echo $row['primer_apellido_ministro']; ?></td>
            <td><?php echo $row['segundo_apellido_ministro']; ?></td>
            <td><?php echo $row['observacion']; ?></td>
            <td><?php echo $row['numero_registro_civil']; ?></td>
            <td><?php echo $row['ano_registro_civil']; ?></td>
            <?php
            if (isset($_SESSION['nombre_usuario'])) {
                $nombre_usuario = $_SESSION['nombre_usuario'];
                $stmt = $db->prepare("SELECT es_administrador FROM usuarios WHERE nombre_usuario = ?");
                $stmt->execute([$nombre_usuario]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($user['es_administrador']) {
                    ?>
                    <!-- BOTON DE BORRAR -->
                    <td class="bot"><input type='button' name='del' id='del' value='Borrar' onclick="confirmarBorrado('<?php echo $row['primer_nombre']; ?>', '<?php echo $row['primer_apellido']; ?>', '<?php echo $row['id']; ?>')"></td>
                    <script>
                    function confirmarBorrado(primerNombre, primerApellido, id) {
                        var confirmacion = confirm("¿Estás seguro que deseas borrar el registro de " + primerNombre.trim() + " " + primerApellido.trim() + "?");
                        if (confirmacion == true) {
                            window.location.href = "borrar2.php?id=" + id;
                        }
                    }
                    </script>


                    <!-- BOTON DE ACTUALIZAR -->
            <td class='bot'><a href="actualizar.php?id=<?php echo $row['id'];?>
                & nom1=<?php echo $row['primer_nombre'];?> 
                & nom2=<?php echo $row['segundo_nombre'];?> 
                & ape1=<?php echo $row['primer_apellido'];?>
                & ape2=<?php echo $row['segundo_apellido'];?>
                & nom_papa1=<?php echo $row['primer_nombre_papa'];?>
                & nom_papa2=<?php echo $row['segundo_nombre_papa'];?>
                & apepapa1=<?php echo $row['primer_apellido_papa'];?>
                & apepapa2=<?php echo $row['segundo_apellido_papa'];?>
                & nom_mama1=<?php echo $row['primer_nombre_mama'];?>
                & nom_mama2=<?php echo $row['segundo_nombre_mama'];?>
                & apemama1=<?php echo $row['primer_apellido_mama'];?>
                & apemama2=<?php echo $row['segundo_apellido_mama'];?>
                & fili=<?php echo $row['filiacion'];?>
                & lugar_nac=<?php echo $row['lugar_de_nacimiento'];?>
                & estado_nac=<?php echo $row['estado_de_nacimiento'];?>
                & dia_nac=<?php echo $row['dia_de_nacimiento'];?>
                & mes_nac=<?php echo $row['mes_de_nacimiento'];?>
                & ano_nac=<?php echo $row['ano_de_nacimiento'];?>
                & dia_bau=<?php echo $row['dia_de_bautizo'];?>
                & mes_bau=<?php echo $row['mes_de_bautizo'];?>
                & ano_bau=<?php echo $row['ano_de_bautizo'];?>
                & nom_padri1=<?php echo $row['primer_nombre_padrino'];?>
                & nom_padri2=<?php echo $row['segundo_nombre_padrino'];?>
                & apepadri1=<?php echo $row['primer_apellido_padrino'];?>
                & apepadri2=<?php echo $row['segundo_apellido_padrino'];?>
                & nom_madri1=<?php echo $row['primer_nombre_padrina'];?>
                & nom_madri2=<?php echo $row['segundo_nombre_padrina'];?>
                & apemadri1=<?php echo $row['primer_apellido_padrina'];?>
                & apemadri2=<?php echo $row['segundo_apellido_padrina'];?>
                & nom_minis1=<?php echo $row['primer_nombre_ministro'];?>
                & nom_minis2=<?php echo $row['segundo_nombre_ministro'];?>
                & apeminis1=<?php echo $row['primer_apellido_ministro'];?>
                & apeminis2=<?php echo $row['segundo_apellido_ministro'];?>
                & observ=<?php echo $row['observacion'];?>
                & num_reg_civil=<?php echo $row['numero_registro_civil'];?>
                & ano_reg_civil=<?php echo $row['ano_registro_civil'];?>"><input type='button' name='up' id='up' value='Actualizar'></a></td>

                    <?php
                }
            }
            ?>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
