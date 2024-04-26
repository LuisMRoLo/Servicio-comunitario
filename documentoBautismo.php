<!DOCTYPE html>
<html>
<head>
    <title>Documento de Bautizo</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
</head>
<body>
    <div id="content">
        <?php
        session_start();
        include("conexion2.php");

        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $sql = "SELECT COUNT(*) FROM bautizos WHERE id = $id";
            $count = $db->query($sql)->fetchColumn();

            if ($count > 0) {
                $sql = "SELECT * FROM bautizos WHERE id = $id";
                $result = $db->query($sql);
                $row = $result->fetch(PDO::FETCH_ASSOC);
                echo "<div id='content-to-capture'>";
                echo "<div class='certificado' style='display: flex; align-items: start;'>";
                echo "<img src='prueba de logo.png' alt='Escudo' style='width: 100px; height: 100px; margin-right: 20px;'>";
                echo "<div style='text-align: center;'>";
                echo "<h1>DIÓCESIS DE SAN CRISTÓBAL</h1>";
                echo "<h2>PARROQUIA ECLESIÁSTICA “DIVINO MAESTRO”</h2>";
                echo "<h3>San Cristóbal – Estado Táchira - Venezuela</h3>";
                echo "<h2>FE DE BAUTISMO</h2>";   
                echo "<p>Quien suscribe, Presbitero Joel Javier Escalante Buitrago, en calidad de párroco de esta parroquia, certifica y da fe de que:</p>";
                echo "<p><strong>El ciudadano:</strong> " . $row["primer_nombre"]. " " . $row["segundo_nombre"]. " " . $row["primer_apellido"]. " " . $row["segundo_apellido"]. "</p>";
                echo "<p><strong>Fue bautizado (a) el día:</strong> " . $row["dia_de_bautizo"]. " de " . $row["mes_de_bautizo"]. " del año " . $row["ano_de_bautizo"]. ".</p>";
                echo "<p><strong>Nació el día:</strong> " . $row["dia_de_nacimiento"]. " de " . $row["mes_de_nacimiento"]. " del año " . $row["ano_de_nacimiento"]. " en " . $row["lugar_de_nacimiento"]. ", Estado " . $row["estado_de_nacimiento"]. ".</p>";
                echo "<p><strong>Padres:</strong> " . $row["primer_nombre_papa"]. " " . $row["segundo_nombre_papa"]. " " . $row["primer_apellido_papa"]. " " . $row["segundo_apellido_papa"]. " y " . $row["primer_nombre_mama"]. " " . $row["segundo_nombre_mama"]. " " . $row["primer_apellido_mama"]. " " . $row["segundo_apellido_mama"]. ".</p>";
                echo "<p><strong>Padrinos:</strong> " . $row["primer_nombre_padrino"]. " " . $row["segundo_nombre_padrino"]. " " . $row["primer_apellido_padrino"]. " " . $row["segundo_apellido_padrino"]. " y " . $row["primer_nombre_padrina"]. " " . $row["segundo_nombre_padrina"]. " " . $row["primer_apellido_padrina"]. " " . $row["segundo_apellido_padrina"]. ".</p>";
                echo "<p><strong>Ministro:</strong> " . $row["primer_nombre_ministro"]. " " . $row["segundo_nombre_ministro"]. " " . $row["primer_apellido_ministro"]. " " . $row["segundo_apellido_ministro"]. ".</p>";
                echo "<p><strong>Registrado en el libro de Bautismo Nº:</strong> ___________ <strong>Folio:</strong> _____________ <strong>Numeral:</strong> ______________.</p>";
                echo "<p><strong>De haber una nota marginal, se prescribe a continuación:</strong> __________________________________________________________________________________________________________________________________________.</p>";
                echo "<p><strong>Documento que se expide en este despacho a la fecha de hoy:</strong> " . date("d - m - Y") . ".</p>";
                echo "<p><strong>Para fines:</strong> ___________________________________________________________________________________________________________.</p>";
                echo "<br><br>";
                echo "<p style='text-align: center;'>________________________</p>";
                echo "<p style='text-align: center;'>PÁRROCO</p>";
                echo "</div>";
                echo "</div>";               
                echo "</div>";
                echo "<button id='download' class='button' style='display: none;'>Descargar como imagen</button>";
                echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js'></script>";
                echo "<script>
                        document.getElementById('download').style.display = 'block';
                        document.getElementById('download').addEventListener('click', function() {
                            var node = document.getElementById('content-to-capture');
                            domtoimage.toPng(node)
                                .then(function (dataUrl) {
                                    var link = document.createElement('a');
                                    link.download = 'Fe de Bautizo de " . $row["primer_nombre"] . " " . $row["segundo_nombre"] . " " . $row["primer_apellido"] . " " . $row["segundo_apellido"] . ".png';
                                    link.href = dataUrl;
                                    link.click();
                                })
                                .catch(function (error) {
                                    console.error('oops, something went wrong!', error);
                                });
                        });
                    </script>";
            } else {
                echo "No se encontraron resultados para el ID proporcionado.";
            }
        }
        ?>
    </div>
    <a href="indexBautizo.php"><button class="button">Volver</button></a>
</body>
</html>
