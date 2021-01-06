<?php

class Logout extends Controller {

    public function __construct() {}

    public function index() {

        session_unset();
        session_destroy();
        header('Location: '.URLROOT.'/tasklist');
    }
}