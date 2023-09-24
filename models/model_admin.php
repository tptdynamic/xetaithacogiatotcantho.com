<?php
require_once "../config/database.php";

class Model_Admin extends Database {

    public function create_view_report() {
        $sql = "INSERT INTO thongkekhach(LuotXem, ThoiGian) VALUES((SELECT COUNT(ID) FROM khach), NOW())";

        $this->set_query($sql);
        return $this->execute_return_status();
    }

    public function get_top_visitors() {
        $sql = "SELECT ID, IP FROM khach ORDER BY LanGheThamCuoi DESC LIMIT 0, 10";

        $this->set_query($sql);
        return $this->load_rows();
    }

    public function get_visitors($page, $limit) {
        $limit = ($page == -1) ? "" : "LIMIT " . (($page - 1) * $limit) . ", $limit";
        $sql = "SELECT ID, IP, ThongTin, UrlGheThamCuoi, LanGheThamCuoi FROM khach ORDER BY ID DESC " . $limit;
        
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function count_visitor() {
        $sql = "SELECT COUNT(ID) as TongKhach FROM khach";

        $this->set_query($sql);
        return $this->load_row();
    }

    public function get_report_7days_visitor() {
        $sql = "SELECT IFNULL((LuotXem - (SELECT LuotXem FROM thongkekhach WHERE ID < tkk.ID ORDER BY ID DESC LIMIT 1)), 0) as LuotXem, ThoiGian, DAYOFWEEK(ThoiGian) AS Thu FROM thongkekhach tkk WHERE ThoiGian BETWEEN ADDDATE(NOW(), -7) and NOW()";

        $this->set_query($sql);
        return $this->load_rows();
    }

    public function get_top_products() {
        $sql = "SELECT sanpham.ID, TenSanPham, TenChuyenMuc, LuotXem FROM sanpham, chuyenmuc WHERE ChuyenMuc = chuyenmuc.ID ORDER BY LuotXem DESC LIMIT 10";

        $this->set_query($sql);
        return $this->load_rows();
        
    }

    public function get_categories($page, $limit) {
        $limit = ($page == -1) ? "" : "LIMIT " . (($page - 1) * $limit) . ", $limit";
        $sql = "SELECT c1.ID, c1.TenChuyenMuc, c1.MoTa, c1.AnhDaiDien, c2.TenChuyenMuc as ChuyenMucChinh FROM chuyenmuc c1 LEFT OUTER JOIN chuyenmuc c2 on c1.ChuyenMucChinh = c2.ID  ORDER BY ID DESC " . $limit;
        
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function get_category_by_id($id) {
        $sql = "SELECT ID, TenChuyenMuc, MoTa, AnhDaiDien, ChuyenMucChinh FROM chuyenmuc WHERE ID = :id";

        $params = [":id" => $id];
        $this->set_query($sql, $params);
        return $this->load_row();
    }

    public function insert_category($data) {
        $sql = "INSERT INTO chuyenmuc(TenChuyenMuc, MoTa, ChuyenMucChinh, AnhDaiDien) VALUES(:category_name, :category_description, :main_category, :path)";

        $params = [":category_name" => $data->category_name, ":category_description" => urldecode($data->category_description), ":main_category" => $data->main_category, ":path" => $data->path];
        $this->set_query($sql, $params);
        return $this->execute_return_status();
    }

    public function update_category($data) {
        $sql = "UPDATE chuyenmuc SET TenChuyenMuc = :category_name, MoTa = :category_description, ChuyenMucChinh = :main_category, AnhDaiDien = :path WHERE ID = :id";

        $params = [":category_name" => $data->category_name, ":category_description" => urldecode($data->category_description), ":main_category" => $data->main_category, ":id" => $data->id, ":path" => $data->path];
        $this->set_query($sql, $params);
        return $this->execute_return_status();
    }

    public function delete_category($id) {
        $sql = "DELETE FROM chuyenmuc WHERE ID = :id";

        $params = [":id" => $id];
        $this->set_query($sql, $params);
        return $this->execute_return_status();
    }

    public function count_category() {
        $sql = "SELECT COUNT(ID) as TongChuyenMuc FROM chuyenmuc";

        $this->set_query($sql);
        return $this->load_row();
    }

    public function get_products($page, $limit) {
        $page = ($page - 1) * $limit;
        $sql = "SELECT sanpham.ID, TenSanPham, ThongSo, sanpham.MoTa, GiaTien, GiamGia, ChuyenMuc, TenChuyenMuc, sanpham.AnhDaiDien, LuotXem FROM sanpham, chuyenmuc WHERE ChuyenMuc = chuyenmuc.ID ORDER BY ID DESC LIMIT $page, $limit";
        
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function get_product_by_id($id) {
        $sql = "SELECT sanpham.ID, TenSanPham, ThongSo, sanpham.MoTa, GiaTien, GiamGia, ChuyenMuc, TenChuyenMuc, sanpham.AnhDaiDien, BoSuuTapAnh FROM sanpham, chuyenmuc WHERE ChuyenMuc = chuyenmuc.ID AND sanpham.ID = :id";

        $params = [":id" => $id];
        $this->set_query($sql, $params);
        return $this->load_row();
    }

    public function insert_product($data) {
        $sql = "INSERT INTO sanpham(TenSanPham, ThongSo, MoTa, GiaTien, GiamGia, ChuyenMuc, AnhDaiDien, BoSuuTapAnh) VALUES(:product_name, :product_specification, :product_description, :product_price, :product_sale, :category, :thumbnail, :slideshow)";

        $params = [":product_name" => $data->product_name, ":product_specification" => urldecode($data->product_specification), ":product_description" => urldecode($data->product_description), ":product_price" => $data->product_price, ":product_sale" => $data->product_sale, ":category" => $data->category, ":thumbnail" => $data->thumbnail, ":slideshow" => $data->slideshow];
        $this->set_query($sql, $params);
        return $this->execute_return_status();
    }

    public function update_product($data) {
        $sql = "UPDATE sanpham SET TenSanPham = :product_name, ThongSo = :product_specification, MoTa = :product_description, GiaTien = :product_price, GiamGia = :product_sale, ChuyenMuc = :category, AnhDaiDien = :thumbnail, BoSuuTapAnh = :slideshow WHERE ID = :id";

        $params = [":product_name" => $data->product_name, ":product_specification" => urldecode($data->product_specification), ":product_description" => urldecode($data->product_description), ":product_price" => $data->product_price, ":product_sale" => $data->product_sale, ":category" => $data->category, ":id" => $data->id, ":thumbnail" => $data->thumbnail, ":slideshow" => $data->slideshow];
        $this->set_query($sql, $params);
        return $this->execute_return_status();
    }

    public function delete_product($id) {
        $sql = "DELETE FROM sanpham WHERE ID = :id";

        $params = [":id" => $id];
        $this->set_query($sql, $params);
        return $this->execute_return_status();
    }

    public function count_product() {
        $sql = "SELECT COUNT(ID) as TongSanPham FROM sanpham";

        $this->set_query($sql);
        return $this->load_row();
    }

    public function get_images($page, $limit) {
        $page = ($page - 1) * $limit;
        $sql = "SELECT ID, DuongDan, NgayDangTai FROM hinhanh ORDER BY ID DESC LIMIT $page, $limit";
        
        $this->set_query($sql);
        return $this->load_rows();
    }

    public function get_image_by_id($id) {
        $sql = "SELECT ID, DuongDan, NgayDangTai FROM hinhanh WHERE sanpham.ID = :id";

        $params = [":id" => $id];
        $this->set_query($sql, $params);
        return $this->load_row();
    }

    public function insert_image($data) {
        $sql = "INSERT INTO hinhanh(DuongDan, NgayDangTai) VALUES(CONCAT(:path, :filename), NOW())";

        $params = [":filename" => $data["filename"], ":path" => $data["path"]];
        $this->set_query($sql, $params);
        return $this->execute_return_status();
    }

    public function delete_image($id) {
        $sql = "DELETE FROM hinhanh WHERE ID = :id";

        $params = [":id" => $id];
        $this->set_query($sql, $params);
        return $this->execute_return_status();
    }

    public function count_image() {
        $sql = "SELECT COUNT(ID) as TongHinhAnh FROM hinhanh";

        $this->set_query($sql);
        return $this->load_row();
    }
}

?>