<?php
require_once __DIR__ . '/../../includes/db.php';
require_once __DIR__ . '/../../includes/functions.php';

if (empty($_SESSION['admin_id'])) {
    header('Location: ' . SITE_URL . '/admin/login.php');
    exit;
}
