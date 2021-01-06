<?php

class Login extends Controller {

    public function __construct() {
        $this->helper("login");
        $this->users_model = $this->model("Users_model");
        if(isLoggedIn()) {
            header('Location: '.URLROOT.'/todolist');
        }
    }

    public function index() {
        $data["title"] = "Авторизаця";
        $data["was_validated"] = "";

        if(isset($_POST['login'])) {
            $this->library("FormValidator");
            $validator = new FormValidator();
            $validator->addValidation("username","req","Имя пользователя обязательно");
            $validator->addValidation("password","req","Пароль обязательно");
            //Now, validate the form
            if($validator->ValidateForm()) {
                $username = $_POST["username"];
                $password = $_POST["password"];

                $user = $this->users_model->check_user($username, $password);
                if($user) {
                    $_SESSION["logged_in"] = true;
                    header('Location: '.URLROOT.'/tasklist');
                } else {
                    $data["validation_errors"] = array("login" => "Имя пользователя или Пароль не верна");
                }
            }  else  {
                $data["was_validated"]      = "was-validated";
                $data["validation_errors"]  = $validator->GetErrors();
            }
        }

        $this->view('template/_parts/master_header', $data);
        $this->view('login/index', $data);
        $this->view('template/_parts/master_footer');
    }
}