<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pflanzen Bildergalerie</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            color: #333;
        }
        h1 {
            color: #2c3e50;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 10px;
            text-transform: capitalize;
        }
        .bild-container {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .bild-titel {
            font-size: 1.2rem;
            margin-top: 0;
            margin-bottom: 10px;
            color: #555;
            word-break: break-all; /* Verhindert, dass extrem lange Namen das Layout sprengen */
        }
        .pflanzen-bild {
            max-width: 100%;
            height: auto;
            display: block;
            border-radius: 4px;
        }
        .fehler {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<?php
// 1. Den Ordnernamen aus der URL holen (Sicherheitsbereinigt)
// Beispiel-Aufruf: galerie.php?pflanze=monstera_deliciosa
$pflanze = isset($_GET['pflanze']) ? basename($_GET['pflanze']) : '';

// Pfad zum Hauptordner (passe den Namen an, falls dein Ordner anders heißt)
$hauptOrdner = "pflanzen_galerie/"; 
$zielOrdner = $hauptOrdner . $pflanze . "/";

if (!empty($pflanze) && is_dir($zielOrdner)) {
    
    // Schönen Titel aus dem Ordnernamen machen (Ersetzt Unterstriche für die Hauptüberschrift)
    $schoenerName = str_replace('_', ' ', $pflanze);
    echo "<h1>Bilderchronik: " . htmlspecialchars($schoenerName) . "</h1>";

    // 2. Alle Bilder aus dem Ordner auslesen (.jpg, .jpeg, .png, .gif, .webp)
    $bilder = glob($zielOrdner . "{*.jpg,*.jpeg,*.png,*.gif,*.webp,*.JPG,*.JPEG,*.PNG}", GLOB_BRACE);

    if (!empty($bilder)) {
        // 3. Jedes einzelne Bild in einer Schleife ausgeben
        foreach ($bilder as $bildPfad) {
            // Reinen Dateinamen für die Überschrift herausfiltern (z.B. "mein_bild.jpg")
            $dateiName = basename($bildPfad);
            
            echo '<div class="bild-container">';
            echo '<h3 class="bild-titel">' . htmlspecialchars($dateiName) . '</h3>';
            echo '<img src="' . htmlspecialchars($bildPfad) . '" alt="' . htmlspecialchars($dateiName) . '" class="pflanzen-bild">';
            echo '</div>';
        }
    } else {
        echo "<p>In diesem Ordner wurden noch keine Bilder hochgeladen.</p>";
    }

} else {
    // Falls der Link falsch war oder kein Ordner übergeben wurde
    echo '<div class="fehler">';
    echo '<h3>Pflanze nicht gefunden</h3>';
    echo '<p>Bitte wähle eine gültige Pflanze aus der Liste aus oder stelle sicher, dass der Ordner auf dem Server existiert.</p>';
    echo '</div>';
}
?>

</body>
</html>