    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-white" style="flex: 1!important;">
        <div class="d-flex justify-content-md-between my-5">
            <a href="<?= Config::AdminRoot ?>quan-ly-san-pham/them-san-pham" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Thêm sản phẩm
            </a>
        </div>
        <table class="table table-dark table-hover align-middle text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Thông số</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Giá tiền</th>
                    <th scope="col">Giảm giá</th>
                    <th scope="col">Thuộc chuyên mục</th>
                    <th scope="col">Lượt xem</th>
                    <th class="col-md-2" scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($products) {
                        foreach ($products as $arr) {
                            echo '
                            <tr>
                                <th scope="row">' . $arr->ID . '</th>
                                <td>' . $arr->TenSanPham . '</td>
                                <td>' . substr(strip_tags($arr->ThongSo), 0, 10) . '...</td>
                                <td>' . substr(strip_tags($arr->MoTa), 0, 10) . '...</td>
                                <td>' . $arr->GiaTien . '</td>
                                <td>' . $arr->GiamGia . '</td>
                                <td>' . $arr->TenChuyenMuc . '</td>
                                <td>' . $arr->LuotXem . '</td>
                                <td>
                                    <div class="d-flex justify-content-md-between gap-3">
                                        <a class="btn btn-info text-white" href="' . Config::AdminRoot . 'quan-ly-san-pham/chinh-sua-san-pham-' . $arr->ID . '">
                                            <i class="fas fa-edit"></i>
                                            Chỉnh sửa
                                        </a>
                                        <form action="delete_product" method="POST">
                                            <input class="d-none" name="id" value="' . $arr->ID . '">
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                                Xóa
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            ';
                        }
                    } else  {
                        echo '<div class="alert alert-info">Hiện chưa có sản phẩm nào!</div>';
                    }
                    
                ?>
            </tbody>
        </table>
        <div class="flex-fill"></div>
    <script>
        $("td form").each(function(form) {
            new Form(this);
        });
    </script>