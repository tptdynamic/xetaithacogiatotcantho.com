<?php

class View_Visitor {
    public function show_frontpage($data) {
        $this->get_header($data[0], Config::Title, "Chuyên cung cấp cho khách hàng các loại xe THACO, KIA uy tính chất lượng. Tư vấn về xe và các chương trình khuyến mãi. Chi tiết liên hệ", "", null);

        $this->get_carousel();

        $this->get_breadscumb(null);

        $this->get_product_listing($data[1]);

        $this->get_footer();
    }
    
    public function get_carousel() {
        include "res/templates/carousel.php";
    }

    public function get_breadscumb($data) {
        include "res/templates/breadscumb.php";
    }

    public function get_product_listing($data) {
        include "res/templates/product_list.php";
    }

    public function show_search_page($data, $search) {
        $this->get_header($data[0], "Tìm kiếm " . $search . " - " . Config::Title, "Chuyên cung cấp cho khách hàng các loại xe THACO, KIA uy tính chất lượng. Tư vấn về xe và các chương trình khuyến mãi. Chi tiết liên hệ", "", null);

        $this->get_breadscumb(null);

        $this->get_product_listing($data[1]);

        $this->get_footer();
    }

    public function show_category_page($data, $page) {
        $this->get_header($data[0], $data[1]->TenChuyenMuc . " - " . Config::Title, substr(strip_tags(trim(preg_replace('/\s\s+/', ' ', $data[1]->MoTa))), 0, 100), Config::Root . $data[1]->AnhDaiDien, $data[1]);

        echo '<p>&nbsp;</p><img src="' . Config::Domain . $data[1]->AnhDaiDien . '" width="100%" height="640px">';

        $this->get_breadscumb($data[1]);

        echo '<div class="container">' . $data[1]->MoTa . '</div>';

        $product = $data[1]->ChuyenMucNho;
        unset($data[1]->ChuyenMucNho);
        array_unshift($product, $data[1]);
        $this->get_product_listing($product);

        $this->show_pagination("dong-xe-" . $this->to_slug($data[1]->TenChuyenMuc) . "-" . $data[1]->ID . ".html", $page, 6, $data[2]->TongChuyenMuc);

        $this->get_footer();
    }

    public function show_product_page($data) {
        $this->get_header($data[0], $data[1]->TenSanPham . " - " . Config::Title, substr(strip_tags(trim(preg_replace('/\s\s+/', ' ', $data[1]->MoTa))), 0, 100), Config::Root . $data[1]->AnhDaiDien, $data[1]);

        $this->get_breadscumb($data[1]);

        $this->get_product_page_layout($data[1], $data[2]);

        $this->get_footer();
    }

    public function get_product_page_layout($data, $relateto) {
        include "res/templates/product_page_layout.php";
    }

    public function get_header($categories, $title, $description, $thumbnail, $data) {
        include "res/templates/header.php";
    }

    public function get_footer() {
        include "res/templates/footer.php";
    }

    public function show_pagination($url, $current_page, $limit, $total_records) {
        $url = Config::Root . $url;
        $total_page = ceil($total_records / $limit);
        include "res/templates/pagination.php";
    }

    public function to_slug($str) {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }

    public function to_vnd($str) {
        return number_format($str,2,",",".");
    }
}

?>