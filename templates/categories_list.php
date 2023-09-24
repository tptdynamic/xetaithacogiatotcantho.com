    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-white" style="flex: 1!important;">
        <div class="d-flex justify-content-md-between my-5">
            <a href="<?= Config::AdminRoot ?>quan-ly-chuyen-muc/them-chuyen-muc" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Thêm chuyên mục
            </a>
        </div>
        <table class="table table-dark table-hover align-middle text-center">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên chuyên mục</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Chuyên mục chính</th>
                    <th class="col-md-2" scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($categories) {
                        foreach ($categories as $arr) {
                            echo '
                            <tr>
                                <th scope="row">' . $arr->ID . '</th>
                                <td>' . $arr->TenChuyenMuc . '</td>
                                <td>' . substr(strip_tags($arr->MoTa), 0, 50) . '...' . '</td>
                                <td>' . $arr->ChuyenMucChinh . '</td>
                                <td>
                                    <div class="d-flex justify-content-md-between gap-3">
                                        <a class="btn btn-info text-white" href="' . Config::AdminRoot . 'quan-ly-chuyen-muc/chinh-sua-chuyen-muc-' . $arr->ID . '">
                                            <i class="fas fa-edit"></i>
                                            Chỉnh sửa
                                        </a>
                                        <form action="delete_category" method="POST">
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
                        echo '<div class="alert alert-info">Hiện chưa có chuyên mục nào!</div>';
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