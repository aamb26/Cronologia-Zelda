<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <title>cronologia</title>
</head>

<body>
    <?php
    if (isset($_POST['juego'])) {
        $juego = urlencode($_POST['juego']);
        $url_api = "https://zelda.fanapis.com/api/games?name={$juego}";
        $curl = curl_init($url_api);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $execute = curl_exec($curl);
        curl_close($curl);

        // Verifica si la solicitud fue exitosa
        if ($execute === false) {
            echo "Error al conectarse a la API.";
            exit;
        }

        // Convertir JSON a PHP
        $response = json_decode($execute, true);

        // Definir la cronología de los juegos de Zelda
        $cronologia = [
            "The Legend of Zelda: Skyward Sword" => ["Línea: Unificada", "images/skyward_sword.jpg"],
            "The Legend of Zelda: The Minish Cap" => ["Línea: Unificada", "images/minish_cap.jpg"],
            "The Legend of Zelda: Four Swords" => ["Línea: Unificada", "images/Four_Swords.jpg"],
            "The Legend of Zelda: Ocarina of Time" => ["Línea: Unificada", "images/Ocarina_of_Time.jpg"],
            "The Legend of Zelda: A Link to the Past" => ["Línea: Héroe Derrotado", "images/link_to_the_past.jpg"],
            "The Legend of Zelda: Link's Awakening" => ["Línea: Héroe Derrotado", "images/links_awakening.jpg"],
            "The Legend of Zelda: Oracle of Ages" => ["Línea: Héroe Derrotado", "images/oracle_of_ages.jpg"],
            "The Legend of Zelda: Oracle of Seasons" => ["Línea: Héroe Derrotado", "images/oracle_of_seasons.jpg"],
            "The Legend of Zelda: A Link Between Worlds" => ["Línea: Héroe Derrotado", "images/Between_Worlds.jpg"],
            "The Legend of Zelda: Tri Force Heroes" => ["Línea: Héroe Derrotado", "images/Tri_Force_Heroes.jpg"],
            "The Legend of Zelda" => ["Línea: Héroe Derrotado", "images/The_Legend_of_Zelda.jpg"],
            "Zelda II: The Adventure of Link" => ["Línea: Héroe Derrotado", "images/Zelda_II.jpg"],
            "The Legend of Zelda: The Wind Waker" => ["Línea: Héroe Victorioso <br> Link Adulto", "images/The_Wind_Waker.jpg"],
            "The Legend of Zelda: Phantom Hourglass" => ["Línea: Héroe Victorioso <br> Link Adulto", "images/Phantom_Hourglass.jpg"],
            "The Legend of Zelda: Spirit Tracks" => ["Línea: Héroe Victorioso <br> Link Adulto", "images/Spirit_Tracks.jpg"],
            "The Legend of Zelda: Majora's Mask" => ["Línea: Héroe Victorioso <br> Link Niño", "images/Mask.jpg"],
            "The Legend of Zelda: Twilight Princess" => ["Línea: Héroe Victorioso <br> Link Niño", "images/Twilight_Princess.jpg"],
            "The Legend of Zelda: Four Swords Adventures" => ["Línea: Héroe Victorioso <br> Link Niño", "images/The_Legend_of_Zelda_Four_Swords_Adventures.jpg"],
        ];

        // Verifica la estructura de la respuesta y que haya datos
        if (isset($response['data']) && count($response['data']) > 0) {

            for ($i = 0; $i < $response['count']; ) {

                if ($response['count'] >= 3 || $response['count'] == 2) {
                    $game = $response['data'][$i + 1];

                } else {
                    $game = $response['data'][$i];
                }


                if (isset($cronologia[$game['name']])) {

                    echo "<p class= text>" . $cronologia[$game['name']][0] . "</p>";
                    echo "<p class= text>Juego: " . $game['name'] . "</p>";


                    // Mostrar la imagen del juego
                    echo "<div id= img >";
                    $image_path = $cronologia[$game['name']][1];
                    echo "<img src='" . $image_path . "' alt='" . $game['name'] . "'><br>";
                    echo "</div>";
                    break;
                } else {
                    echo "<div class= not_found >";
                    $img_not_found = "images/not_found.jpg";
                    echo "<p class= text>El juego " . $_POST['juego'] . " no está en la cronología de Zelda." . "</p>";
                    echo "<img clas=img_not_found src='" . $img_not_found . "'><br>";
                    echo "</div>";
                    break;
                }
            }

        } else {
            echo "<div class= not_found >";
            $img_not_found = "images/not_found.jpg";
            echo "<p class= text>No se encontró el juego." . "</p>";
            echo "<img clas=img_not_found src='" . $img_not_found . "'><br>";
            echo "</div>";
        }
    }

    ?>
</body>

</html>