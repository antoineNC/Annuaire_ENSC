<?php
require_once "includes/functions.php";
session_start();
session_destroy();//fermture de la sessions
redirect('index.php');//retour à l'accueil (non connecté)
?>