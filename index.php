<?php
    // Session starten
    session_start();
    
    require_once("includes/conn.inc.php");
    require_once("includes/common.inc.php");

    $user = $_SESSION['user'] ?? null;

    if (!$user) {
        // Weiterleitung auf Login-Formular
        header('location: login_form.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Highscore</title>
</head>
<body>
    <h1>Highscore</h1>
    <p>angemeldet als <?php echo $user['Vorname'] . ' ' . $user['Nachname']; ?> <a href="logout.php">abmelden</a></p>

    <!-- Highscore als Tabelle ausgeben -->
    

    <!-- Formular wo ein neuer Highscore in die Tabelle eingetragen werden kann -->

</body>
</html>