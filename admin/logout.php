<?php
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/functions.php';

$_SESSION = [];
session_destroy();

header('Location: ' . SITE_URL . '/admin/login.php');
exit;
