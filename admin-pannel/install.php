<?php

require_once "config/database.php";
require_once "config/config.php";

$database = new Database();
$connect = include "config/connect.php";

date_default_timezone_set(Config::TimeZone);

$action = (isset($_GET['action'])) ? $_GET['action'] : "";
$permission = (isset($_SESSION['permission'])) ? $_SESSION['permission'] : "";
$data = (isset($_POST['data'])) ? json_decode($_POST['data']) : "";

switch ($action) {
    case "check_validate_dbname":
        foreach($data as $key => $item) {
            if ($item == "" && $key != "password") {
                callback_message(2, "Dữ liệu không được để trống!");
                return;
            }
        }

        $database = new Database($data);

        if ($database->get_db_status() == "ok") {
            callback_message(1, "Có kết nối đến cơ sở dữ liệu!");
        } else {
            callback_message(2, "Không có kết nối đến cơ sở dữ liệu!");
        }

        break;

    case "set_config":
        foreach($data as $key => $item) {
            if ($item == "" && $key != "password") {
                callback_message(2, "Dữ liệu không được để trống!");
                return;
            }
        }

        $write_text = "<?php\n\nreturn (object) array(\n\t\"host\" => \"$data->host\",\n\t\"port\" => $data->port,\n\t\"user\" => \"$data->user\",\n\t\"password\" => \"$data->password\",\n\t\"dbname\" => \"$data->dbname\",\n\t\"INSTALL_MODE\" => false\n);\n\n?>";
        file_put_contents("config/connect.php", $write_text);

        $database_file = file_get_contents("res/files/database.sql");
        $database = new Database();
        $database->query($database_file);
        
        callback_message(1, "Cài đặt thành công");

        break;
    
}

function callback_message($type, $message) {
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
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

?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cài đặt tổng quan</title>
        <style>
            * {
                box-sizing: border-box;
                font-family: Roboto, Helvetica, sans-serif;
                overflow: hidden;
            }

            body {
                background-color: #2d3437;
                margin: 0;
                padding: 0;
            }

            .alert-popup {
                background-color: #00a65a;
                color: white;
                text-align: center;
                transition: max-height 0.3s ease-in;
                max-height: 0;
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 1;
            }

            .active-popup {
                max-height: 10rem;
                transition: max-height 0.5s ease-out;
            }

            .alert-fail {
                background-color: #FF013C;
            }

            .content {
                width: 100%;
                display: block;
                position: relative;
            }

            .content-block {
                margin: 1rem auto;
                width: 30%;
            }

            .content-head {
                background-color: #008d4c;
                color: white;
                box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
                border-radius: 0.75rem 0.75rem 0 0;
                text-align: center;
            }

            .content-body {
                background-color: white;
                box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
                border-radius: 0 0 0.75rem 0.75rem;
            }

            .content-body h2{
                margin: 1rem 2rem;
            }

            .status-check {
                color: #00a65a;
            }

            .status-uncheck {
                color: #dd4b39;
            }

            .form-config {
                display: block;
                position: relative;
            }

            .form-row {
                position: relative;
                display: block;
                height: 5rem;
                margin: 1rem 2rem;
            }

            .form-input {
                border: none;
                border-bottom: 1px solid #3c763d;
                width: 100%;
                height: 3rem;
                outline: none;
                font-size: 16px;
                padding: 0;
                -webkit-transition: color .2s ease-out, -webkit-transform .2s ease-out;
                transition: color .2s ease-out, -webkit-transform .2s ease-out;
                background-color: transparent;
                margin-top: 1rem;
                color: #3c763d;
            }

            .form-input:focus {
                color: black;
                border-bottom: 2px solid #3c763d;
            }

            .form-input ~ label {
                position: absolute;
                top: 0;
                left: 0;
                -webkit-transform: translateY(calc(16px + 1rem));
                transform: translateY(calc(16px + 1rem));
                color: #3c763d;
                -webkit-transition: color .2s ease-out, -webkit-transform .2s ease-out;
                transition: color .2s ease-out, -webkit-transform .2s ease-out;
            }

            .form-input:focus ~ label, .form-input:not(:placeholder-shown) ~ label {
                -webkit-transform: translateY(6px) scale(0.9);
                transform: translateY(6px) scale(0.9);
                color: #26a69a;
            }

            button, button::after {
                width: 6rem;
                height: 3rem;
                font-size: .8rem;
                font-family: 'Bebas Neue', cursive;
                border: 0;
                color: #fff;
                letter-spacing: 3px;
                line-height: 1rem;
                outline: transparent;
                position: relative;
            }

            button::after {
                --slice-0: inset(50% 50% 50% 50%);
                --slice-1: inset(80% -6px 0 0);
                --slice-2: inset(50% -6px 30% 0);
                --slice-3: inset(10% -6px 85% 0);
                --slice-4: inset(40% -6px 43% 0);
                --slice-5: inset(80% -6px 5% 0);
                
                content: 'Meow Meow';
                display: block;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                text-shadow: -3px -3px 0px #F8F005, 3px 3px 0px #00E6F6;
                clip-path: var(--slice-0);
            }

            button:hover::after {
                animation: 1s glitch;
                animation-timing-function: steps(2, end);
            }

            @keyframes glitch {
                0% {
                    clip-path: var(--slice-1);
                    transform: translate(-20px, -10px);
                }
                10% {
                    clip-path: var(--slice-3);
                    transform: translate(10px, 10px);
                }
                20% {
                    clip-path: var(--slice-1);
                    transform: translate(-10px, 10px);
                }
                30% {
                    clip-path: var(--slice-3);
                    transform: translate(0px, 5px);
                }
                40% {
                    clip-path: var(--slice-2);
                    transform: translate(-5px, 0px);
                }
                50% {
                    clip-path: var(--slice-3);
                    transform: translate(5px, 0px);
                }
                60% {
                    clip-path: var(--slice-4);
                    transform: translate(5px, 10px);
                }
                70% {
                    clip-path: var(--slice-2);
                    transform: translate(-10px, 10px);
                }
                80% {
                    clip-path: var(--slice-5);
                    transform: translate(20px, -10px);
                }
                90% {
                    clip-path: var(--slice-1);
                    transform: translate(-10px, 0px);
                }
                100% {
                    clip-path: var(--slice-1);
                    transform: translate(0);
                }
            }

            .check-button {
                background: linear-gradient(45deg, transparent 5%, #FF013C 5%);
                box-shadow: 6px 0px 0px #00E6F6;
            }

            .check-button:after {
                background: linear-gradient(45deg, transparent 3%, #00E6F6 3%, #00E6F6 5%, #FF013C 5%);
            }

            .submit-button {
                background: linear-gradient(315deg, transparent 5%, #0099FF 5%);
                box-shadow: -6px 0px 0px #00E6F6;
                float: right;
            }

            .submit-button:after {
                background: linear-gradient(45deg, transparent 3%, #00E6F6 3%, #00E6F6 5%, #0099FF 5%);
            }
        </style>
    </head>
    <body>
        <div class="alert-popup"></div>
        <div class="content">
            <div class="content-block">
                <div class="content-head">
                    <h1>Trạng thái cài đặt</h1>
                </div>
                <div class="content-body">
                    <h2>Chế độ cài đặt: <span class="<?= ($connect->INSTALL_MODE == true) ? 'status-uncheck">Chưa cài đặt' : 'status-check">Đã cài đặt'?></span></h2>
                    <h2>Kết nối cơ sở dữ liệu: <span class="<?= ($database->get_db_status() == "ok") ? 'status-check">Đạt' : 'status-uncheck">Không đạt'?></span></h2>
                </div>
            </div>
            <div class="content-block">
                <div class="content-head">
                    <h1>Cài đặt cơ sở dữ liệu</h1>
                </div>
                <div class="content-body">
                    <form class="form-config" onSubmit="return formValidation();">
                        <div class="form-row">
                            <input class="form-input" type="text" id="input-host" placeholder=" " value="<?= $connect->host ?>">
                            <label for="input-host">Địa chỉ cơ sở dữ liệu.</label>
                        </div>
                        <div class="form-row">
                            <input class="form-input" type="text" id="input-port" placeholder=" " value="<?= $connect->port ?>">
                            <label for="input-port">Cổng giao tiếp cơ sở dữ liệu.</label>
                        </div>
                        <div class="form-row">
                            <input class="form-input" type="text" id="input-dbname" placeholder=" " value="<?= $connect->dbname ?>">
                            <label for="input-dbname">Tên cơ sở dữ liệu.</label>
                        </div>
                        <div class="form-row">
                            <input class="form-input" type="text" id="input-user" placeholder=" " value="<?= $connect->user ?>">
                            <label for="input-user">Tên tài khoản.</label>
                        </div>
                        <div class="form-row">
                            <input class="form-input" type="text" id="input-password" placeholder=" " value="<?= $connect->password ?>">
                            <label for="input-password">Mật khẩu.</label>
                        </div>
                        <div class="form-row">
                            <button class="check-button" type="button" onclick="checkValidate()">Kiểm tra kết nối</button>
                            <button class="submit-button" type="submit">Cài đặt</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function formValidation() {
                data = {
                    "host": document.getElementById("input-host").value,
                    "port": document.getElementById("input-port").value,
                    "dbname": document.getElementById("input-dbname").value,
                    "user": document.getElementById("input-user").value,
                    "password": document.getElementById("input-password").value
                }

                var http = new XMLHttpRequest();
                var url = '<?= Config::Root ?>/admin/install.php?action=set_config';
                var params = 'data=' + JSON.stringify(data);
                http.open('POST', url, true);

                http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                http.onreadystatechange = function() {
                    if(http.readyState == 4 && (http.status == 200 || http.status == 404)) {
                        var decoded_text = JSON.parse(http.responseText);
                        const alertpopup = document.getElementsByClassName("alert-popup")[0];
                        alertpopup.innerHTML = "<h1>" + decoded_text["message"] + "</h1>";
                        alertpopup.classList.add("active-popup");
                        alertpopup.classList.remove("alert-fail");
                        if (decoded_text['status'] == "fail") alertpopup.classList.add("alert-fail");
                        setTimeout(() => {
                            if (http.status == 200) {
                                document.location.reload();
                            } else {
                                alertpopup.classList.remove("active-popup");
                            }  
                        }, 2000);
                    }
                }
                http.send(params);
                
                return false;
            }

            function checkValidate() {
                data = {
                    "host": document.getElementById("input-host").value,
                    "port": document.getElementById("input-port").value,
                    "dbname": document.getElementById("input-dbname").value,
                    "user": document.getElementById("input-user").value,
                    "password": document.getElementById("input-password").value
                }

                var http = new XMLHttpRequest();
                var url = '<?= Config::Root ?>/admin/install.php?action=check_validate_dbname';
                var params = 'data=' + JSON.stringify(data);
                http.open('POST', url, true);

                http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                http.onreadystatechange = function() {
                    if(http.readyState == 4 && (http.status == 200 || http.status == 404)) {
                        var decoded_text = JSON.parse(http.responseText);
                        const alertpopup = document.getElementsByClassName("alert-popup")[0];
                        alertpopup.innerHTML = "<h1>" + decoded_text["message"] + "</h1>";
                        alertpopup.classList.add("active-popup");
                        alertpopup.classList.remove("alert-fail");
                        if (decoded_text['status'] == "fail") alertpopup.classList.add("alert-fail");
                        setTimeout(() => {
                            alertpopup.classList.remove("active-popup");
                        }, 2000);
                    }
                }
                http.send(params);
            }
        </script>
    </body>
</html>
