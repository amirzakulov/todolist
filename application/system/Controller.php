<?php

class Controller {

    //Load model
    public function model($model) {
        require_once '../application/models/'.$model.'.php';

        return new $model();
    }

    //Load view
    public function view($view, $data = []) {
        if(file_exists('../application/views/'.$view.'.php')) {
            require_once '../application/views/'.$view.'.php';
        } else {
            die("View does not exist!");
        }
    }

    //Load library
    public function library($library) {
        if(file_exists('../application/libraries/'.$library.'.php')) {
            require_once '../application/libraries/'.$library.'.php';
        } else {
            die("Library does not exist!");
        }
    }

    //Load helper
    public function helper($helper) {
        if(file_exists('../application/helpers/'.$helper.'_helper.php')) {
            require_once '../application/helpers/'.$helper.'_helper.php';
        } else {
            die("Helper does not exist!");
        }
    }
}