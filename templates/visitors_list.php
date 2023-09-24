    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-white" style="flex: 1!important;">
        <div class="container-fluid">
            <div class="row">
                <table class="table table-dark table-hover align-middle text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">IP</th>
                            <th scope="col">Thông tin</th>
                            <th scope="col">Url ghé thăm cuối</th>
                            <th scope="col">Lần ghé thăm cuối</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if ($visitors) {
                                foreach ($visitors as $arr) {
                                    $json = json_decode($arr->ThongTin);
                                    $information = "";
                                    if (!isset($json->bogon)) {
                                        $information = "
                                            Nước: $json->country <br>
                                            Vùng: $json->region <br>
                                            Thành phố: $json->city <br>
                                            Vị trí: $json->loc <a class=\"btn btn-primary\" target=\"_blank\" href=\"https://www.google.com/maps/search/?api=1&query=$json->loc\"><i class=\"fas fa-map\"></i> Mở google map</a><br>
                                            Múi giờ: $json->timezone <br>
                                            Tổ chức: $json->org <br>
                                        ";
                                    } else{
                                        $information = "Không thể lấy thông tin";
                                    }
                                    
                                    echo '
                                    <tr>
                                        <th scope="row">' . $arr->ID . '</th>
                                        <td>' . $arr->IP . '</td>
                                        <td class="text-start">' . $information . '</td>
                                        <td>' . $arr->UrlGheThamCuoi . '</td>
                                        <td>' . $arr->LanGheThamCuoi . '</td>
                                    </tr>
                                    ';
                                }
                            } else  {
                                echo '<div class="alert alert-info">Hiện chưa có khách nào ghé!</div>';
                            }
                            
                        ?>
                    </tbody>
                </table>