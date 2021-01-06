<?php

class Users_model {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function check_user($username, $password) {
        $this->db->query("SELECT u.* FROM users u WHERE u.username = '".$username."' AND u.password = '".$password."'");

        if(!$this->db->single()) {
            return false;
        } else {
            return true;
        }
    }
}