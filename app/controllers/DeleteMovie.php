<?php
include_once '../controllers/MovieController.php';
include_once '../config/Database.php';

$database = new Database();
$conn = $database->getConnection();
$controller = new MovieController($conn);

if (isset($_GET['maPhim'])) {
    $maPhim = $_GET['maPhim'];
    $controller->deleteMovie($maPhim);
} else {

}
?>
