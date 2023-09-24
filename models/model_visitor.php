<?php
require_once "config/database.php";

class Model_Visitor extends Database {
    public function get_all_category() {
        $sql = "SELECT c2.ID, c1.TenChuyenMuc, c2.AnhDaiDien, c2.TenChuyenMuc as ChuyenMucPhu, c1.ID as IDChuyenMucChinh FROM chuyenmuc c1 INNER JOIN chuyenmuc c2 on c2.ChuyenMucChinh = c1.ID";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function get_category_by_id($id) {
        $sql = "SELECT ID, ID as ChuyenMuc, TenChuyenMuc, MoTa, AnhDaiDien FROM chuyenmuc WHERE ID = :id";

        $params = [":id" => $id];
        $this->set_query($sql, $params);
        return $this->load_row();
    }

    public function get_parent_category() {
        $sql = "SELECT ID, TenChuyenMuc, AnhDaiDien FROM chuyenmuc WHERE ChuyenMucChinh = 0";
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function get_product_by_parent_category($parent_category) {
        $sql = "SELECT sanpham.ID, TenSanPham, GiaTien, GiamGia, sanpham.AnhDaiDien, ChuyenMuc, chuyenmuc.TenChuyenMuc FROM sanpham, chuyenmuc JOIN chuyenmuc chuyenmuc2 on chuyenmuc.ChuyenMucChinh = chuyenmuc2.ID WHERE chuyenmuc2.ID = :parent_category AND ChuyenMuc = chuyenmuc.ID ORDER BY sanpham.ID DESC LIMIT 0, 6";

        $params = [":parent_category" => $parent_category];
        $this->set_query($sql, $params);
        return $this->load_rows();
    }

    public function get_sub_category($id, $page) {
        $page = ($page - 1) * 6;
        $sql = "SELECT ID, TenChuyenMuc, AnhDaiDien FROM chuyenmuc WHERE ChuyenMucChinh = :id ORDER BY ID LIMIT $page, 6";
        
        $params = [":id" => $id];
        $this->set_query($sql, $params);
        return $this->load_rows();
    }

    public function get_product_by_category($category) {
        $sql = "SELECT sanpham.ID, TenSanPham, GiaTien, GiamGia, sanpham.AnhDaiDien, ChuyenMuc, TenChuyenMuc FROM sanpham, chuyenmuc WHERE ChuyenMuc = :category AND chuyenmuc.ID = ChuyenMuc ORDER BY ID DESC";

        $params = [":category" => $category];
        $this->set_query($sql, $params);
        return $this->load_rows();
    }
    
    public function count_sub_category($parent_category) {
        $sql = "SELECT COUNT(ID) as TongChuyenMuc FROM chuyenmuc WHERE ChuyenMucChinh = :parent_category";

        $params = [":parent_category" => $parent_category];
        $this->set_query($sql, $params);
        return $this->load_row();
    }

    public function get_product_by_id($id) {
        $sql = "SELECT sanpham.ID, TenSanPham, GiaTien, GiamGia, ThongSo, sanpham.MoTa, sanpham.AnhDaiDien, ChuyenMuc, TenChuyenMuc, BoSuuTapAnh FROM sanpham, chuyenmuc WHERE ChuyenMuc = chuyenmuc.ID AND sanpham.ID = :id";

        $params = [":id" => $id];
        $this->set_query($sql, $params);
        return $this->load_row();
    }

    public function get_products_by_search($search) {
        $search = "%$search%";
        $sql = "SELECT sanpham.ID, TenSanPham, GiaTien, GiamGia, sanpham.AnhDaiDien, ChuyenMuc, TenChuyenMuc FROM sanpham, chuyenmuc WHERE TenSanPham LIKE :search AND chuyenmuc.ID = ChuyenMuc ORDER BY ID DESC";

        $params = [":search" => $search];
        $this->set_query($sql, $params);
        return $this->load_rows();
    }

    public function increase_product_view($id) {
        $sql = "UPDATE sanpham SET LuotXem = LuotXem + 1 WHERE ID = :id";

        $params = [":id" => $id];
        $this->set_query($sql, $params);
        return $this->execute_return_status();
    }

    public function insert_visitor($data) {
        $sql = "INSERT INTO khach(IP, ThongTin, UrlGheThamCuoi, LanGheThamCuoi) VALUES(:ip, :information, :last_visited_url, NOW()) ON DUPLICATE KEY UPDATE UrlGheThamCuoi = :last_visited_url, LanGheThamCuoi = NOW()";

        $this->set_query($sql, $data);
        return $this->execute_return_status();
    }

    public function check_existed_visitor($ip) {
        $sql = "SELECT ID FROM khach WHERE IP = :ip";

        $params = [":ip" => $ip];
        $this->set_query($sql, $params);
        return $this->load_row();
    }
}

?>