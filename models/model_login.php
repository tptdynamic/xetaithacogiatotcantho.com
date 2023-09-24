<?php
require_once "../config/database.php";

class Model_Login extends Database {
    public function validate_user_password($user, $pass) {
        $sql = "SELECT ID, HoVaTen, GioiTinh, DiaChi, Email, AnhDaiDien FROM quantrivien WHERE TenTaiKhoan = :user AND MatKhau = :password ";

        $params = [":user" => $user, ":password" => $pass];
        $this->set_query($sql, $params);
        return $this->load_row();
    }

    public function insert_session($user, $session) {
        $sql = "UPDATE quantrivien SET PhienDangNhap = :phiendangnhap WHERE TenTaiKhoan = :user";

        $params = [":user" => $user, ":phiendangnhap" => $session];
        $this->set_query($sql, $params);
        return $this->load_row();
    }

    public function validate_session($session) {
        $sql = "SELECT ID, HoVaTen, GioiTinh, DiaChi, Email, AnhDaiDien FROM quantrivien WHERE PhienDangNhap = :phiendangnhap";

        $params = [":phiendangnhap" => $session];
        $this->set_query($sql, $params);
        return $this->load_row();
    }
}

?>