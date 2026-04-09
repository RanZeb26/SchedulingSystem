<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// role helper
function isAdmin() {
    return $_SESSION['user']['role'] === 'admin';
}