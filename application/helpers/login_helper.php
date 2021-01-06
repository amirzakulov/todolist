<?php

function isLoggedIn() {
    if(isset($_SESSION["logged_in"])) {
        return true;
    } else {
        return false;
    }
}

function isIndex(){
    $url = urlParse();
    if(strtolower($url[0]) == "tasklist" && strtolower($url[1]) == 'edit_task') {
        return false;
    } else {
        return true;
    }
}

function urlParse() {
    if(isset($_GET['url'])) {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        return $url;
    }
}

