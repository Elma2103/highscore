<?php
    // Session starten
    session_start();

    require_once("includes/conn.inc.php");
    require_once("includes/common.inc.php");

    $user = $_SESSION['user'] ?? null;

    if ($user) {
        // Weiterleitung auf die Startseite
        header('location: index.php');
    }

    $errorMessages = [];
    $email = '';
    $passwort = '';

    // sind Daten mittels Post-Request abgesendet worden?
    if (count($_POST) > 0) {
        $email = $_POST['email'] ?? '';
        $passwort = $_POST['passwort'] ?? '';

        // Prüfen, ob es sich um eine korrekte E-Mail Adresse handelt
        // es wird nur das Format geprüft, nicht aber ob die E-Mail Adresse existiert
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessages['email'] = 'Bitte geben Sie eine gültige E-Mail Adresse ein.';
        }

        // strlen... die Anzahl der Zeichen eines Textes/Strings
        if (strlen($passwort) < 1) {
            $errorMessages['passwort'] = 'Bitte geben Sie ein Passwort mit mind. 1 Zeichen ein.';
        }
        
        // Wenn keine Validierung aufgeschlagen ist, dann mache eine Weiterleitung
        if (count($errorMessages) == 0) {
            // TODO: Prüfen, ob die Daten korrekt sind (z.B. ob es den User in der Datenbank gibt)
            $sql = "SELECT * FROM tbl_user WHERE email LIKE '$email'";

            $result = $conn->query($sql);

            if ($result && $result->num_rows == 1) {
                $user = $result->fetch_assoc();
                $passwortKorrekt = password_verify($passwort, $user['Passwort']);

                if ($passwortKorrekt) {
                    // user-Datensatz in der Session/Sitzung speichern
                    $_SESSION['user'] = $user;

                    // Weiterleitung auf index.php
                    header('Location: index.php');
                }
            }

            $errorMessages['allgemein'] = 'Ungültige Daten eingegeben.';
        }
    }
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Formular</title>
</head>
<body>
    <h1>Login Formular</h1>
    
    <?php
        if (isset($errorMessages['allgemein'])) {
            echo "<div class='error-msg'>" . $errorMessages['allgemein'] . "</div>";
        }
    ?>

    <form action="login_form.php" method="post">
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

        <button type="submit">Login</button>
    </form>
</body>
</html>