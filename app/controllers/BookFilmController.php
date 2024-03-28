<?php
include_once '../models/BookFilmModel.php';

class BookFilmController {
    private $model;

    public function __construct() {
        $this->model = new BookFilmModel();
    }

    public function getFilmDetails($maPhim) {
        return $this->model->getFilmDetails($maPhim);
    }
}
?>
