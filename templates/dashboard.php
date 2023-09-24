<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-white" style="flex: 1!important;">
    <div class="row">
        <div class="col-md-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?= $data->count_category->TongChuyenMuc ?></h3>
                    <p>Tổng chuyên mục</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list-alt"></i>
                </div>
                <a href="<?= Config::AdminRoot ?>quan-ly-chuyen-muc" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= $data->count_product->TongSanPham ?></h3>
                    <p>Tổng sản phẩm</p>
                </div>
                <div class="icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <a href="<?= Config::AdminRoot ?>quan-ly-san-pham" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?= $data->count_image->TongHinhAnh ?></h3>
                    <p>Tổng hình ảnh</p>
                </div>
                <div class="icon">
                    <i class="fas fa-images"></i>
                </div>
                <a href="<?= Config::AdminRoot ?>quan-ly-hinh-anh" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?= $data->count_visitor->TongKhach ?></h3>
                    <p>Tổng khách ghé thăm</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="<?= Config::AdminRoot ?>quan-ly-khach" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <h1 class="text-black"><b><i class="fa fa-file" aria-hidden="true"></i> Thống kê</b></h1>
        <div class="d-flex justify-content-md-center">
            <form id="createReportForm" action="create_view_report" method="POST">
                <button class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Tạo báo cáo lượt xem</button>
            </form>
        </div>
        <div class="col-md-8 d-flex align-items-end">
            <canvas id="visitors-chart" style="width:100%;"></canvas>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <div class="container-fluid">
                <h2 class="text-black"><b>10 lượt xem gần nhất:</b></h2>
                <table class="table table-dark table-hover align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($data->visitors) {
                                foreach ($data->visitors as $arr) {
                                    echo '
                                    <tr>
                                        <th scope="row">' . $arr->ID . '</th>
                                        <td>' . $arr->IP . '</td>
                                    </tr>
                                    ';
                                }
                            } else  {
                                echo '<div class="alert alert-info">Hiện chưa có khách nào ghé!</div>';
                            }
                            
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-12">
            <div class="container-fluid">
                <h2 class="text-black"><b>10 sản phẩm có lượt xem cao nhất:</b></h2>
                <table class="table table-dark table-hover align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Thuộc chuyên mục</th>
                            <th scope="col">Lượt xem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($data->products) {
                                foreach ($data->products as $arr) {
                                    echo '
                                    <tr>
                                        <th scope="row">' . $arr->ID . '</th>
                                        <td>' . $arr->TenSanPham . '</td>
                                        <td>' . $arr->TenChuyenMuc . '</td>
                                        <td>' . $arr->LuotXem . '</td>
                                    </tr>
                                    ';
                                }
                            } else  {
                                echo '<div class="alert alert-info">Hiện chưa có sản phẩm nào!</div>';
                            }
                            
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="flex-fill"></div>
    <script>
        new Form("#createReportForm");
        <?php 
            $x_values = '';
            $y_values = '';
            foreach ($data->report_visitor as $key => $value) {
                $x_values .= '"Thứ ' . $value->Thu . '(' . $value->ThoiGian . ')"';
                $y_values .= '"' . $value->LuotXem . '"';
                if ($key < count($data->report_visitor)) {
                    $x_values .= ', ';
                    $y_values .= ', ';
                }
            }
        ?>
        var xValues = [<?= $x_values ?>];
        var yValues = [<?= $y_values ?>];
        var barColors = ['rgba(75, 192, 192, 0.7)'];

        new Chart("visitors-chart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    label: 'Lượt xem tăng',
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {display: false},
                plugins: {
                    title: {
                        display: true,
                        text: "Biểu đồ lượt xem tăng trong 7 ngày trước"
                    }
                }
            }
        });
    </script>