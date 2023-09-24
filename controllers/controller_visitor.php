<?php

require_once "models/model_visitor.php";
require_once "views/view_visitor.php";

class Controller_Visitor {
    private $id;

    public function __construct($id, $page, $search) {
        $this->id = $id;
        $this->page = $page;
        $this->search = $search;

        $this->insert_visitor();
    }

    public function insert_visitor() {
        $model = new Model_Visitor();
        $ip = $this->get_ip_address();
        $information = "{}";
        if ($model->check_existed_visitor($ip) == false) {
            $information = file_get_contents("https://ipinfo.io/" . $ip . "?token=1bc6069582adc4");
        }
        $model->insert_visitor([":ip" => $ip, ":information" => $information, ":last_visited_url" => "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"]);
    }

    public function get_ip_address() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function show_frontpage() {
        $data = [];
        $model = new Model_Visitor();
        $view = new View_Visitor();
        array_push($data, $model->get_all_category());
        if ($this->search == "") {
            $product_each_category = $model->get_parent_category();
            foreach ($product_each_category as $key => $value) {
                $product_each_category[$key]->SanPham = $model->get_product_by_parent_category($value->ID);
            }
            array_push($data, $product_each_category);
            $view->show_frontpage($data);
        } else {
            $search[0] = new stdClass;
            $search[0]->TenChuyenMuc = "Tìm kiếm sản phẩm: " . $this->search;
            $search[0]->SanPham = $model->get_products_by_search($this->search);
            array_push($data, $search);
            $view->show_search_page($data, $this->search);
        }
    }

    public function show_category_page() {
        $data = [];
        $model = new Model_Visitor();
        array_push($data, $model->get_all_category());
        if ($category = $model->get_category_by_id($this->id)) {
            $category->ChuyenMucNho = $model->get_sub_category($this->id, $this->page);
            $category->SanPham = $model->get_product_by_category($this->id);
            foreach ($category->ChuyenMucNho as $key => $value) {
                $category->ChuyenMucNho[$key]->SanPham = $model->get_product_by_category($value->ID);
            }
            array_push($data, $category);
            array_push($data, $model->count_sub_category($this->id));
            $view = new View_Visitor();
            $view->show_category_page($data, $this->page);
        } else {
            $this->show_404();
        }
    }

    public function show_product_page() {
        $data = [];
        $model = new Model_Visitor();
        array_push($data, $model->get_all_category());
        
        if ($product = $model->get_product_by_id($this->id)) {
            array_push($data, $product);
            $model->increase_product_view($this->id);
            array_push($data, $model->get_product_by_category($data[1]->ChuyenMuc, 1));
            $view = new View_Visitor();
            $view->show_product_page($data);
        } else {
            $this->show_404();
        }
        
    }

    public function show_404() {
        header("Location: " . Config::Root);
    }
}

?>