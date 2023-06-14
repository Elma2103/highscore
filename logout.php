<?php
    // Session starten
    session_start();

    // Sitzung beenden
    session_destroy();

    // Weiterleitung auf index.php
    header('Location: index.php');