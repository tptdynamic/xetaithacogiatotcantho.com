<?php

class View_Admin {
    public function show_admin_dashboard($data) {
        include "res/templates/admin_header.php";

        $this->show_admin_pannel();

        $this->show_dashboard($data);

        include "res/templates/admin_footer.php";
    }

    public function show_dashboard($data) {
        include "res/templates/dashboard.php";
    }

    public function show_categories($categories, $current_page, $limit, $total_page) {
        include "res/templates/admin_header.php";

        $this->show_admin_pannel();

        $this->show_categories_list($categories);

        $this->show_pagination("quan-ly-chuyen-muc", $current_page, $limit, $total_page);

        include "res/templates/admin_footer.php";
    }

    public function show_add_category_form($categories) {
        include "res/templates/admin_header.php";

        $this->show_admin_pannel();

        $this->show_category_add_form($categories);

        include "res/templates/admin_footer.php";
    }

    public function show_edit_category_form($category) {
        include "res/templates/admin_header.php";

        $this->show_admin_pannel();

        $this->show_category_edit_form($category[0], $category[1]);

        include "res/templates/admin_footer.php";
    }

    public function show_admin_pannel() {
        include "res/templates/admin_pannel.php";
    }

    public function show_categories_list($categories) {
        include "res/templates/categories_list.php";
    }

    public function show_category_add_form($categories) {
        include "res/templates/categories_add_form.php";
    }

    public function show_category_edit_form($category, $options) {
        include "res/templates/categories_edit_form.php";
    }

    public function show_products($products, $current_page, $limit, $total_page) {
        include "res/templates/admin_header.php";

        $this->show_admin_pannel();

        $this->show_products_list($products);

        $this->show_pagination("quan-ly-san-pham", $current_page, $limit, $total_page);

        include "res/templates/admin_footer.php";
    }

    public function show_products_list($products) {
        include "res/templates/products_list.php";
    }

    public function show_add_product_form($categories) {
        include "res/templates/admin_header.php";

        $this->show_admin_pannel();

        $this->show_product_add_form($categories);

        include "res/templates/admin_footer.php";
    }

    public function show_edit_product_form($product, $categories) {
        include "res/templates/admin_header.php";

        $this->show_admin_pannel();

        $this->show_product_edit_form($product, $categories);

        include "res/templates/admin_footer.php";
    }

    public function show_product_add_form($categories) {
        include "res/templates/product_add_form.php";
    }

    public function show_product_edit_form($product, $categories) {
        include "res/templates/product_edit_form.php";
    }

    public function show_images($images, $current_page, $limit, $total_page) {
        include "res/templates/admin_header.php";

        $this->show_admin_pannel();

        $this->show_images_list($images);

        $this->show_pagination("quan-ly-hinh-anh", $current_page, $limit, $total_page);

        include "res/templates/admin_footer.php";
    }

    public function show_add_image_form() {
        include "res/templates/admin_header.php";

        $this->show_admin_pannel();

        $this->show_image_add_form();

        include "res/templates/admin_footer.php";
    }

    public function show_images_list($images) {
        include "res/templates/images_list.php";
    }

    public function show_image_add_form() {
        include "res/templates/image_add_form.php";
    }

    public function show_visitors($visitors, $current_page, $limit, $total_page) {
        include "res/templates/admin_header.php";

        $this->show_admin_pannel();

        $this->show_visitors_list($visitors);

        $this->show_pagination("quan-ly-khach", $current_page, $limit, $total_page);

        include "res/templates/admin_footer.php";
    }

    public function show_visitors_list($visitors) {
        include "res/templates/visitors_list.php";
    }

    public function show_pagination($url, $current_page, $limit, $total_records) {
        $url = Config::AdminRoot . $url;
        $total_page = ceil($total_records / $limit);
        include "res/templates/pagination.php";
    }
}

?>