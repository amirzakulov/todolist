<?php

class Todolist_model {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function get_task($task_id) {
        $this->db->query("SELECT t.id, t.user_name, t.user_email, t.task FROM `tasks` t WHERE t.id = ".$task_id);

        return $this->db->single();
    }

    public function get_tasks($offset = null, $order_field = null, $order_type = "ASC") {
        switch ($order_type) {
            case "a":
                $order_type = "ASC";
                break;
            case "d":
                $order_type = "DESC";
                break;
            default:
                $order_type = "ASC";
        }

        $offset_str         = is_null($offset) ? "":"OFFSET ".$offset;
        $order_field_str    = is_null($order_field) ? "t.user_name":"t.".$order_field." ".$order_type;

        $this->db->query('
            SELECT t.id, t.user_name, t.user_email, t.`status`, t.task, t.updated
            FROM `tasks` t 
            ORDER BY '.$order_field_str.'
            LIMIT 3 '
            . $offset_str
        );

        return $this->db->resultSet();
    }

    public function get_count() {
        $this->db->query("SELECT count(t.id) as `count` FROM `tasks` t");

        return $this->db->single();
    }

    public function add_task($arr) {
        foreach ($arr as $key => $val) {
            $arr[$key] = $this->db->cleanData($val);
        }

        $this->db->query("INSERT INTO tasks (user_name, user_email, task, status, updated, created_date, updated_date)
                              VALUES ('".$arr['user_name']."', '".$arr['user_email']."','".$arr['task']."', 0, 0, '2021-01-01 01:14:42', '2021-01-01 01:14:42');");

        return $this->db->insertedId();
    }

    public function update_task($task_id, $arr) {
        $query_part = "";
        foreach ($arr as $field=>$val) {
            $query_part .= " ".$field."='".$val."',";
        }

        $query_part = rtrim($query_part, ",");

        $this->db->query("UPDATE tasks SET ".$query_part." WHERE id=".$task_id);
        return $this->db->update();
    }

    public function task_status($task_id) {
        $this->db->query("SELECT t.id, t.user_name, t.user_email, t.status FROM `tasks` t WHERE t.id = ".$task_id);

        return $this->db->single();
    }
}