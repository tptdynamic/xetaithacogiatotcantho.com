<?php

require_once "models/model_admin.php";
require_once "views/view_admin.php";

class Controller_Admin {
    private $data;
    private $page;
    private $id;

    const limit_categories_show = 12;
    const limit_products_show = 12;
    const limit_images_show = 12;
    const limit_visitors_show = 12;

    public function __construct($data = "", $page = 0, $id = "") {
        $this->data = $data;
        if ($page < 1) $page = 1;
        $this->page = $page;
        $this->id = $id;
    }

    public function show_admin_dashboard() {
        $model = new Model_Admin();
        $data = new stdClass;
        $data->count_category = $model->count_category();
        $data->count_product = $model->count_product();
        $data->count_image = $model->count_image();
        $data->count_visitor = $model->count_visitor();
        $data->visitors = $model->get_top_visitors();
        $data->report_visitor = $model->get_report_7days_visitor();
        $data->products = $model->get_top_products();
        $view = new View_Admin();
        $view->show_admin_dashboard($data);
    }

    public function show_categories() {
        $model = new Model_Admin();
        $view = new View_Admin();
        $view->show_categories($model->get_categories($this->page, self::limit_categories_show), $this->page, self::limit_categories_show, $model->count_category()->TongChuyenMuc);
    }

    public function show_add_category_form() {
        $model = new Model_Admin();
        $view = new View_Admin();
        $view->show_add_category_form($model->get_categories(-1, null));
    }

    public function show_edit_category_form() {
        $model = new Model_Admin();
        $category = [$model->get_category_by_id($this->id), $model->get_categories(-1, null)];
        $view = new View_Admin();
        $view->show_edit_category_form($category);
    }

    public function add_category() {
        foreach($this->data as $key => $item) {
            if ($item == "" && $key != "category_description") {
                $this->callback_message(2, "Vui lòng nhập vào tên chuyên mục!");
                return;
            }
        }

        $query_data = $this->insert_category($this->data);
        if ($query_data) {
            $this->callback_message(1, "Thêm thành công chuyên mục");
        } else {
            $this->callback_message(2, "Có lỗi xảy ra!");
        }
    }

    public function edit_category() {
        foreach($this->data as $key => $item) {
            if ($item == "" && $key != "category_description") {
                $this->callback_message(2, "Vui lòng nhập vào tên chuyên mục!");
                return;
            }
        }

        $query_data = $this->update_category($this->data);
        if ($query_data) {
            $this->callback_message(1, "Chỉnh sửa thành công chuyên mục");
        } else {
            $this->callback_message(2, "Có lỗi xảy ra!");
        }
    }

    public function delete_category() {
        $model = new Model_Admin();
        $query_data = $model->delete_category($this->data->id);
        if ($query_data) {
            $this->callback_message(1, "Xóa thành công chuyên mục");
        } else {
            $this->callback_message(2, "Có lỗi xảy ra!");
        }
    }

    public function insert_category($data) {
        $model = new Model_Admin();
        return $model->insert_category($data);
    }

    public function update_category($data) {
        $model = new Model_Admin();
        return $model->update_category($data);
    }

    public function show_products() {
        $model = new Model_Admin();
        $view = new View_Admin();
        $view->show_products($model->get_products($this->page, self::limit_products_show), $this->page, self::limit_products_show, $model->count_product()->TongSanPham);
    }

    public function show_add_product_form() {
        $model = new Model_Admin();
        $view = new View_Admin();
        $view->show_add_product_form($model->get_categories(-1, null));
    }

    public function show_edit_product_form() {
        $model = new Model_Admin();
        $product = $model->get_product_by_id($this->id);
        $view = new View_Admin();
        $view->show_edit_product_form($product, $model->get_categories(-1, null));
    }

    public function add_product() {
        foreach($this->data as $key => $item) {
            if ($item == "" && $key != "product_description") {
                $this->callback_message(2, "Vui lòng nhập vào tên sản phẩm, thông số và chọn chuyên mục!");
                return;
            }
        }

        $query_data = $this->insert_product($this->data);
        if ($query_data) {
            $this->callback_message(1, "Thêm thành công sản phẩm");
        } else {
            $this->callback_message(2, "Có lỗi xảy ra!");
        }
    }

    public function edit_product() {
        foreach($this->data as $key => $item) {
            if ($item == "" && $key != "category_description") {
                $this->callback_message(2, "Vui lòng nhập vào tên sản phẩm, thông số và chọn chuyên mục!");
                return;
            }
        }

        $query_data = $this->update_product($this->data);
        if ($query_data) {
            $this->callback_message(1, "Chỉnh sửa thành công sản phẩm");
        } else {
            $this->callback_message(2, "Có lỗi xảy ra!");
        }
    }

    public function insert_product($product) {
        $model = new Model_Admin();
        return $model->insert_product($product);
    }

    public function update_product($product) {
        $model = new Model_Admin();
        return $model->update_product($product);
    }

    public function delete_product() {
        $model = new Model_Admin();
        $query_data = $model->delete_product($this->data->id);
        if ($query_data) {
            $this->callback_message(1, "Xóa thành công sản phẩm");
        } else {
            $this->callback_message(2, "Có lỗi xảy ra!");
        }
    }

    public function show_images() {
        $model = new Model_Admin();
        $view = new View_Admin();
        $view->show_images($model->get_images($this->page, self::limit_images_show), $this->page, self::limit_images_show, $model->count_image()->TongHinhAnh);
    }

    public function show_add_image_form() {
        $model = new Model_Admin();
        $view = new View_Admin();
        $view->show_add_image_form();
    }

    public function add_image() {
        foreach ($this->data->files as $arr) {
            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', urldecode($arr[1])));
            file_put_contents("../uploads/images/" . $arr[0], $data);
            $this->insert_image(["filename" => $arr[0], "path" => "uploads/images/"]);
        }
        
        $this->callback_message(1, "Thêm các hình ảnh thành công!");
    }

    public function insert_image($image) {
        $model = new Model_Admin();
        return $model->insert_image($image);
    }

    public function delete_image() {
        $model = new Model_Admin();
        $query_data = $model->delete_image($this->data->id);
        unlink("../" . $this->data->path);
        if ($query_data) {
            $this->callback_message(1, "Xóa thành công hình ảnh");
        } else {
            $this->callback_message(2, "Có lỗi xảy ra!");
        }
    }

    public function get_images() {
        $model = new Model_Admin();
        $message = $model->get_images($this->data->page, self::limit_images_show);
        if ($message != false) {
            $this->callback_message(1, $message);
        } else {
            $this->callback_message(2, "Không có hình ảnh nào!");
        }
    }

    public function show_visitors() {
        $model = new Model_Admin();
        $view = new View_Admin();
        $view->show_visitors($model->get_visitors($this->page, self::limit_visitors_show), $this->page, self::limit_visitors_show, $model->count_visitor()->TongKhach);
    }

    public function create_view_report() {
        $model = new Model_Admin();
        $query_data = $model->create_view_report();
        if ($query_data) {
            $this->callback_message(1, "Tạo thành công báo cáo lượt xem");
        } else {
            $this->callback_message(2, "Có lỗi xảy ra!");
        }
    }

    public function logout() {
        $session = $_SESSION['admin'];
        unset($_SESSION['admin']);
        setcookie('Session', null, -1, '/');
        $this->callback_message(1, ["Đăng xuất " . json_decode($session)->message->HoVaTen]);
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