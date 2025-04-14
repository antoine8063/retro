<?php
session_start();
require_once "utils/database.php";
$db = db_connect();
$id = $_GET['id'] ?? '';
$req = $db->prepare('DELETE FROM postit WHERE id = ?');
$req->execute([$id]);