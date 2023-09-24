<div class="container">
    <?php
        foreach ($data as $key => $arr) {
            echo '
                <div class="row mt-5 align-items-end">
                ' . ((isset($arr->ID)) ? '<a class="section-title" href="' . Config::Root . 'dong-xe-'. $this->to_slug($arr->TenChuyenMuc) . '-' . $arr->ID . '.html">' : '') . '
                    <h1>
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-truck" viewBox="0 0 16 16"><path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/></svg>
                        ' . $arr->TenChuyenMuc . '
                    </h1>
                ' . ((isset($arr->ID)) ? '</a>' : '') . '
                <hr>
            ';
            if (count($arr->SanPham) > 0) {
                foreach ($arr->SanPham as $_arr) {
                    echo '
                    <div class="col-md-4 my-3">
                        <div class="card">
                            <a href="' . Config::Root . 'dong-xe-'. $this->to_slug($_arr->TenChuyenMuc) . '-' . $_arr->ChuyenMuc . '/' . $this->to_slug($_arr->TenSanPham) . '-' . $_arr->ID . '.html">
                                <img class="card-img-top" src="' . Config::Domain . $_arr->AnhDaiDien . '">
                                <div class="card-body">
                                    <h4 class="card-title" title="' . $_arr->TenSanPham . '">' . $_arr->TenSanPham . '</h4>
                                    <div class="mt-2">
                                        <p class="card-text">' . $this->to_vnd($_arr->GiaTien) . ' VNĐ</p>
                                    </div>
                                </div>
                            </a>
                            <div class="card-reveal">
                                <a href="' . Config::Root . 'dong-xe-'. $this->to_slug($_arr->TenChuyenMuc) . '-' . $_arr->ChuyenMuc . '/' . $this->to_slug($_arr->TenSanPham) . '-' . $_arr->ID . '.html" class="moreinfo-button">Xem thêm...</a>
                            </div>
                        </div>
                    </div>
                    ';
                }
            } else {
                echo '<h1 class="text-danger">Hiện chưa có sản phẩm nào! <br> Vui lòng quay lại trang chủ</h1>';
            }
            echo '</div>';
        }
    ?>
</div>