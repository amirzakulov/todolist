<?php

class Tasklist extends Controller {

    public function __construct() {
        $this->helper("login");

        if(!isLoggedIn() && !isIndex()) {
            header('Location: '.URLROOT.'/login');
            exit();
        }

        $this->todolist_model = $this->model("Todolist_model");
    }

    public function index($currentPage = null, $colName = null, $colSort = "a") {
        $data["title"] = "Тестовое задание от BeeJee";
        if(isset($_SESSION["alert_message"])) {
            $data["alert_message"] = $_SESSION["alert_message"];
            unset($_SESSION["alert_message"]);
        }

        $cols = array(
            "user_name"     => array("width"=>"18%", "name"=>"Имя", "sortable"=>true),
            "user_email"    => array("width"=>"18%", "name"=>"е-mail", "sortable"=>true),
            "task"          => array("width"=>"", "name"=>"Задача", "sortable"=>false),
            "status"        => array("width"=>"10%", "name"=>"Статус", "sortable"=>true),
        );
        $colName = (array_key_exists($colName, $cols) ? $colName:"user_name");
        $currentPage = (is_null($currentPage) ? 1:(int) $currentPage);

        //pagination
        $this->pagination = $this->library("Pagination");
        $taskCount      = $this->todolist_model->get_count();
        $totalItems     = $taskCount->count;
        $itemsPerPage   = 3;
        $urlPattern     = URLROOT.'/tasklist/index/(:num)/'.$colName.'/'.$colSort;

        $paginator = new Pagination($totalItems, $itemsPerPage, $currentPage, $urlPattern);
        $data["pagination"] = $paginator;

        $colSort    = ($colSort != "d" ? "a":"d");
        $offset = is_null($currentPage) ? 0:(($currentPage-1) * $itemsPerPage);
        $data["tasks"] = $this->todolist_model->get_tasks($offset, $colName, $colSort);

        //sorting
        $sort_type  = array("a"=>"d", "d"=>"a");
        $sort_class = array("a"=>"sortAZ", "d"=>"sortZA");

        foreach ($cols as $col_name => $arr) {
            if($arr["sortable"]) {
                $sort = ($col_name == $colName) ? $sort_type[$colSort] : "a";
                $class = ($col_name == $colName) ? $sort_class[$colSort] : "sortNO";
                $cols[$col_name]["href"] = URLROOT."/tasklist/index/".$currentPage."/".$col_name."/".$sort;
                $cols[$col_name]["class"] = $class;
            }
        }

        $data["cols"] = $cols;

        $this->view('template/_parts/master_header', $data);
        $this->view('tasklist/index', $data);
        $this->view('template/_parts/master_footer');
    }

    public function add() {
        $data["title"] = "Добавить задачу";
        $data["was_validated"] = "";

        if(isset($_POST['submit_task'])) {
            $this->library("FormValidator");
            $validator = new FormValidator();
            $validator->addValidation("user_name","req","Имя пользователя обязательно");
            $validator->addValidation("user_email","email","Email должно содержать действительный адрес электронной почты (с @ and .)");
            $validator->addValidation("user_email","req","Email обязательно");
            $validator->addValidation("task","req","Текст задачи обязательно");

            if($validator->ValidateForm()) {
                unset($_POST['submit_task']);
                $this->todolist_model->add_task($_POST);

                $_SESSION['alert_message'] = "Задача добавлено успешно!";
                header('Location: '.URLROOT.'/tasklist');
            }  else  {
                $data["was_validated"]      = "was-validated";
                $data["validation_errors"]  = $validator->GetErrors();
            }
        }

        $this->view('template/_parts/master_header', $data);
        $this->view('tasklist/add', $data);
        $this->view('template/_parts/master_footer');
    }

    public function edit_task($task_id = null) {
        $data["title"] = "Редактировать задачу";
        $data["task"] = $this->todolist_model->get_task($task_id);

        if(isset($_POST['submit_task'])) {

            $post = array(
                "updated" => 1,
                "task" => $_POST["task"]
            );

            $this->todolist_model->update_task($task_id, $post);

            $_SESSION['alert_message'] = "Задача отредактировано успешно!";
            header('Location: '.URLROOT.'/tasklist');
        }

        $this->view('template/_parts/master_header', $data);
        $this->view('tasklist/edit', $data);
        $this->view('template/_parts/master_footer');
    }

    public function change_status($task_id) {
        $data["title"] = "Изменить статус";
            $data["task"] = $this->todolist_model->task_status($task_id);
        if(isset($_POST['submit_task'])) {

            $status = isset($_POST["status"]) ? $_POST["status"]:0;
            $post   = array("status" => $status);

            $this->todolist_model->update_task($task_id, $post);

            $_SESSION['alert_message'] = "Статус изменено успешно!";
            header('Location: '.URLROOT.'/tasklist');
        }

        $this->view('template/_parts/master_header', $data);
        $this->view('tasklist/change_status', $data);
        $this->view('template/_parts/master_footer');
    }
}