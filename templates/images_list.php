    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-white" style="flex: 1!important;">
        <div class="d-flex justify-content-md-between my-5">
            <a href="<?= Config::AdminRoot ?>quan-ly-hinh-anh/them-hinh-anh" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                Thêm hình ảnh
            </a>
        </div>
        <div class="container-fluid">
            <div class="row">
                <?php
                    if ($images) {
                        foreach ($images as $arr) {
                            echo '
                            <div class="col-md-3 text-center">
                                <figure class="figure">
                                    <img src="' . (Config::Domain . $arr->DuongDan) . '" class="figure-img img-fluid rounded" alt="Hình ảnh" width="300px">
                                    <figcaption class="figure-caption">
                                        <input class="form-control" value="' . (Config::Domain . $arr->DuongDan) . '" readonly>
                                        <div class="d-flex justify-content-md-between mt-2 gap-3">
                                            <button class="btn btn-info text-white">Sao chép</button>
                                            <form action="delete_image" method="POST">
                                                <input class="d-none" name="path" value="' . $arr->DuongDan . '">
                                                <input class="d-none" name="id" value="' . $arr->ID . '">
                                                <button class="btn btn-danger text-white">Xóa</button>
                                            </form>
                                        </div>
                                    </figcaption>
                                </figure>
                            </div>
                            ';
                        }
                    } else {
                        echo '<div class="alert alert-info">Hiện không có hình ảnh nào!</div>';
                    }
                    
                ?>
            </div>
        </div>
        <div class="flex-fill"></div>
    <script>
        $("figcaption form").each(function(form) {
            new Form(this);
        });

        $("figcaption button:first-child").click(function() {
            var index = $("figcaption button:first-child").index(this);
            $("figcaption input.form-control")[index].select();
            $("figcaption input.form-control")[index].setSelectionRange(0, 99999);
            navigator.clipboard.writeText($("figcaption input.form-control")[index].value);
        });
    </script>