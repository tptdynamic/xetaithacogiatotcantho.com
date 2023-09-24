<div class="d-flex justify-content-md-center">
    <nav>
        <ul class="pagination">
            <?php
                if ($current_page > 1 && $total_page > 1){
                    echo '
                    <li class="page-item">
                        <a class="page-link" href="' . $url . "/" .($current_page-1).'" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>';
                }

                if ($total_page < 7) {
                    for ($i = 1; $i <= $total_page; $i++){
                        if ($i == $current_page){
                            echo '
                            <li class="page-item active">
                                <span class="page-link">' . $i . '</span>
                            </li>
                            ';
                        }
                        else{
                            echo '
                            <li class="page-item">
                                <a class="page-link" href="' . $url . "/" . $i . '">' . $i . '</a>
                            </li>
                            ';
                        }
                    }
                } else {
                    if ($current_page > 3) {
                        for ($i = 1; $i < 3; $i++) {
                            if ($i >= $current_page - 2) {
                                continue;
                            }

                            echo '
                            <li class="page-item">
                                <a class="page-link" href="' . $url . "/" . $i . '">' . $i . '</a>
                            </li>
                            ';
                        }

                        if ($current_page > 5) {
                            echo '
                            <li class="page-item">
                                <span class="page-link">...</span>
                            </li>
                            ';
                        }
                        
                    }

                    if ($current_page > 1) {
                        for ($i = $current_page - 2; $i < $current_page; $i++) {
                            if ($i < 1) {
                                continue;
                            }

                            echo '
                            <li class="page-item">
                                <a class="page-link" href="' . $url . "/" . $i . '">' . $i . '</a>
                            </li>
                            ';
                        }
                    }
                    
                    if ($current_page <= $total_page) {
                        for ($i = $current_page; $i <= $current_page + 2; $i++) {
                            if ($i > $total_page) {
                                continue;
                            }

                            if ($i == $current_page){
                                echo '
                                <li class="page-item active">
                                    <span class="page-link">' . $i . '</span>
                                </li>
                                ';
                            }
                            else{
                                echo '
                                <li class="page-item">
                                    <a class="page-link" href="' . $url . "/" . $i . '">' . $i . '</a>
                                </li>
                                ';
                            }
                        }
                    }

                    if ($current_page < $total_page - 2) {
                        if ($current_page < $total_page - 4) {
                            echo '
                            <li class="page-item">
                                <span class="page-link">...</span>
                            </li>
                            ';
                        }

                        for ($i = $total_page - 1; $i <= $total_page; $i++) {
                            if ($i <= $current_page + 2) {
                                continue;
                            }

                            echo '
                            <li class="page-item">
                                <a class="page-link" href="' . $url . "/" . $i . '">' . $i . '</a>
                            </li>
                            ';
                        }
                    }
                }

                if ($current_page < $total_page && $total_page > 1) {
                    echo '
                    <li class="page-item">
                        <a class="page-link" href="' . $url . "/" . ($current_page+1).'" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>';
                }
                
            ?>
        </ul>
    </nav>
</div>