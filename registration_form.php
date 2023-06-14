<?php
    require_once("includes/conn.inc.php");
    require_once("includes/common.inc.php");

    $errorMessages = [];

    $vorname = '';
    $nachname = '';
    $email = '';
    $passwort = '';

    // sind Daten mittels Post-Request abgesendet worden?
    if (count($_POST) > 0) {
        $vorname = $_POST['vorname'] ?? '';
        $nachname = $_POST['nachname'] ?? '';
        $email = $_POST['email'] ?? '';
        $passwort = $_POST['passwort'] ?? '';


        // strlen... die Anzahl der Zeichen eines Textes/Strings
        if (strlen($vorname) < 2) {
            $errorMessages['vorname'] = 'Bitte geben Sie einen Vornamen mit mind. 2 Zeichen ein.';
        }

        // strlen... die Anzahl der Zeichen eines Textes/Strings
        if (strlen($nachname) < 2) {
            $errorMessages['nachname'] = 'Bitte geben Sie ein Nachnamen mit mind. 2 Zeichen ein.';
        }

        // Prüfen, ob es sich um eine korrekte E-Mail Adresse handelt
        // es wird nur das Format geprüft, nicht aber ob die E-Mail Adresse existiert
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessages['email'] = 'Bitte geben Sie eine gültige E-Mail Adresse ein.';
        }

        // strlen... die Anzahl der Zeichen eines Textes/Strings
        if (strlen($passwort) < 10) {
            $errorMessages['passwort'] = 'Bitte geben Sie ein Passwort mit mind. 10 Zeichen ein.';
        }

        // Wenn keine Validierung aufgeschlagen ist, dann mache eine Weiterleitung
        if (count($errorMessages) == 0) {
            $sicheresPasswort = password_hash($passwort, PASSWORD_BCRYPT);

            // Daten in die Datenbank einfügen
            $sql = "INSERT INTO tbl_user (Vorname, Nachname, Email, Passwort) VALUES ('$vorname', '$nachname', '$email', '$sicheresPasswort')";
            $result = $conn->query($sql);

            if ($result) {
                // Weiterleitung auf login_form.php
                header('Location: login_form.php');
            } else {
                $errorMessages['allgemein'] = 'Beim Registrieren ist ein Fehler aufgetreten.';
            }
        }
    }

    $conn->close();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrierungs-Formular</title>
</head>
<body>
    <h1>Registrierungs-Formular</h1>
    
    <?php
        if (isset($errorMessages['allgemein'])) {
            echo "<div class='error-msg'>" . $errorMessages['allgemein'] . "</div>";
        }
    ?>

    <form action="registration_form.php" method="post">
        <div class="form-field">
            <label for="vorname">Vorname</label>
            <input type="text" name="vorname" id="vorname" value="<?php echo $vorname; ?>" required>
            <?php
                if (isset($errorMessages['vorname'])) {
                    echo "<div class='error-msg'>" . $errorMessages['vorname'] . "</div>";
                }
            ?>
        </div>
        
        <div class="form-field">
            <label for="nachname">Nachname</label>
            <input type="text" name="nachname" id="nachname" value="<?php echo $nachname; ?>" required>
            <?php
                if (isset($errorMessages['nachname'])) {
                    echo "<div class='error-msg'>" . $errorMessages['nachname'] . "</div>";
                }
            ?>
        </div>
    
        <div class="form-field">
            <label for="email">E-Mail</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
            <?php
                if (isset($errorMessages['email'])) {
                    echo "<div class='error-msg'>" . $errorMessages['email'] . "</div>";
                }
            ?>
        </div>

        <div class="form-field">
            <label for="passwort">Passwort</label>
            <input type="password" name="passwort" id="passwort" value="<?php echo $passwort; ?>">
            <?php
                if (isset($errorMessages['passwort'])) {
                    echo "<div class='error-msg'>" . $errorMessages['passwort'] . "</div>";
                }
            ?>
        </div>

        <button type="submit">Registrieren</button>
    </form>
</body>
</html>