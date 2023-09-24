<p>&nbsp;</p>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div id="carouselThumbnailIndicators" class="carousel slide" data-bs-ride="carousel" style="margin-bottom: 70%">
                <div class="carousel-indicators carousel-indicators-e">
                    <?php 

                    $split = explode(", ", $data->BoSuuTapAnh);

                    for ($i = 0; $i < count($split) - 1; $i++) {
                        echo '<button type="button" data-bs-target="#carouselThumbnailIndicators" data-bs-slide-to="' . $i . '" class="' . (($i == 0) ? "active" : "") . '" aria-current="true" aria-label="Slide ' . $i . '" style="background-image: url(\'' . Config::Root . $split[$i] . '\')"></button>';
                    }

                    ?>
                </div>
                <div class="carousel-inner animate-fadein">
                    <?php
                    
                    for ($i = 0; $i < count($split) - 1; $i++) {
                        echo '
                            <div class="carousel-item ' . (($i == 0) ? "active" : "") . '">
                                <img src="' . Config::Domain . $split[$i] . '" class="d-block w-100" style="max-height: 640px" alt="...">
                            </div>
                        ';
                    }

                    ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselThumbnailIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Quay về</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselThumbnailIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Tiến tới</span>
                </button>
            </div>
        </div>
        <div class="col-md-6">
            <h1><?= $data->TenSanPham ?></h1>
            <hr>
            <h1 class="text-info"><b><?= $this->to_vnd($data->GiaTien) ?> VNĐ</b></h1>
            <?= $data->ThongSo ?>
        </div>
        <p>&nbsp;</p>
        <hr>
        <div class="d-flex justify-content-md-center">
            <div class="col-md-7">
                <h1 class="text-danger"><b>Mô tả xe:</b></h1>
                <?= $data->MoTa ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row align-items-end">
            <h1 class="text-danger"><b>Sản phẩm liên quan:</b></h1>
            <?php
            foreach ($relateto as $arr) {
                echo '
                    <div class="col-md-4 my-3">
                        <div class="card">
                            <a href="' . Config::Root . 'dong-xe-'. $this->to_slug($arr->TenChuyenMuc) . '-' . $arr->ChuyenMuc . '/' . $this->to_slug($arr->TenSanPham) . '-' . $arr->ID . '.html">
                                <img class="card-img-top" src="' . Config::Domain . $arr->AnhDaiDien . '"></img>
                                <div class="card-body">
                                    <h4 class="card-title" title="' . $arr->TenSanPham . '">' . $arr->TenSanPham . '</h4>
                                    <div class="mt-2">
                                        <p class="card-text">' . $this->to_vnd($arr->GiaTien) . ' VNĐ</p>
                                    </div>
                                </div>
                            </a>
                            <div class="card-reveal">
                                <a href="' . Config::Root . 'dong-xe-'. $this->to_slug($arr->TenChuyenMuc) . '-' . $arr->ChuyenMuc . '/' . $this->to_slug($arr->TenSanPham) . '-' . $arr->ID . '.html" class="moreinfo-button">Xem thêm...</a>
                            </div>
                        </div>
                    </div>
                ';
            }
            ?>
        </div>
    </div>
</div>