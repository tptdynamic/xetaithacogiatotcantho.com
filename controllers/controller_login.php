<?php

require_once "models/model_login.php";
require_once "views/view_login.php";

class Controller_Login {
    private $salt = "tpt_dev_this_website@2021";
    private $data;

    public function __construct($data = "") {
        $this->data = $data;
    }

    public function login() {
        foreach($this->data as $key => $item) {
            if ($item == "" && $key != "password") {
                $this->callback_message(2, "Vui lòng nhập vào tài khoản và mật khẩu");
                return;
            }
        }

        $_SESSION["login_attempt"] = (isset($_SESSION["login_attempt"]) ? $_SESSION["login_attempt"] : 0);

        if ($_SESSION["login_attempt"] < 3) {
            $login_data = $this->check_login($this->data);
            if ($login_data) {
                if ($this->data->remember == "on") {
                    $this->set_session($this->data);
                    setcookie("Session", $this->get_session_md5($this->data), time() + 1296000, "/");
                }
                $_SESSION['admin'] = json_encode(["message" => $login_data]);
                $_SESSION["login_attempt"] = 0;
                $this->callback_message(1, $login_data);
            } else {
                $_SESSION["login_attempt"]++;
                $this->callback_message(2, "Sai tài khoản mật khẩu!");
            }
        } else {
            $this->callback_message(2, "Vui lòng đăng nhập lại sau...");
        }
    }

    public function check_login() {
        $login = new Model_Login();
        return $login->validate_user_password($this->data->username, MD5($this->salt . $this->data->password));
    }

    public function get_session_md5($data) {
        return MD5("login_session" . time() . $data->username . $data->password);
    }

    public function set_session($data) {
        $login = new Model_Login();
        return $login->insert_session($data->username, $this->get_session_md5($data));
    }

    public function check_login_session($session) {
        $login = new Model_Login();
        return $login->validate_session($session);
    }

    public function show_login() {
        $view = new View_Login();
        $view->show_login_header();
        $view->show_login_form();
        $view->show_login_footer();
    }

    
    public function callback_message($type, $message) {
        switch ($type) {
            case 1:
                http_response_code(200);
                die(json_encode(["status" => "success", "message" => $message]));
                break;
            case 2:
                http_response_code(404);
                die(json_encode(["status" => "fail", "message" => $message]));
                break;
        }
    }
}


?>