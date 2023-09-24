<?php

$canonical_url = (isset($data->TenChuyenMuc) ? Config::Root . "dong-xe-" . $this->to_slug($data->TenChuyenMuc) . '-' . $data->ChuyenMuc . (isset($data->TenSanPham) ? '/' . $this->to_slug($data->TenSanPham) . '-' . $data->ID . '.html' : '.html') : Config::Root);

?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?= $title ?></title>
        <meta property="og:url" content="<?= $canonical_url ?>" />
        <meta property="og:title" content="<?= $title ?>" />
        <meta name="description" content="<?= $description ?>" />
        <meta property="og:description" content="<?= $description ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:image" content="<?= $thumbnail ?>" />
        <meta property="fb:app_id" content="<?= Config::FacebookAppId ?>" />
        <link href="<?= Config::Root?>res/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= Config::Root?>res/css/main.css" rel="stylesheet">
        <link rel="canonical" href="<?= $canonical_url ?>">

        <script src="<?= Config::Root?>res/js/bootstrap.bundle.min.js"></script>
        <script src="<?= Config::Root?>res/js/popper.min.js"></script>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122932681-2"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-122932681-2');
        </script>
    </head>
    <body>
    <header class="main-header">
        <a href="<?= Config::Root?>" class="logo-header">
            <img src="<?= Config::Domain?>res/images/logo.png">
        </a>
        <div class="right-header">
            <div class="top-header">
                <div></div><div></div>
                <form action="<?= Config::Root ?>" class="search-form col-md-3" method="GET" autocomplete="off">
                    <input type="text" name="search" class="form-control" value="" placeholder="Nhập vào tìm kiếm sản phẩm...">
                </form>
                <div class="social-icon">
                    <a target="_blank" href="<?= Config::Facebook ?>">
                        <img src="<?= Config::Domain?>res/images/facebook-square.png">
                    </a>
                    <a target="_blank" href="<?= Config::Zalo ?>">
                        <img src="<?= Config::Domain?>res/images/zalo.png">
                    </a>
                </div>
                <a target="_blank" class="text-black" href="tel:+84<?= substr(Config::Telephone, 1, count(Config::Telephone) - 1) ?>">SĐT: <?= Config::Telephone ?></a>
            </div>
            <div class="bottom-header">
                <?php
                $last_category = "";
                $last_key = end($categories);
                foreach ($categories as $arr) {
                    if ($last_category == $arr->TenChuyenMuc) {
                        echo '<p><a href="' . Config::Root . 'dong-xe-'. $this->to_slug($arr->TenChuyenMuc) . '-' . $arr->ID . '.html">' . $arr->ChuyenMucPhu .'</a></p>';
                    } else {
                        if ($last_category != "") {
                            echo '</div></div>';
                        }
                        echo '
                            <div class="header-popup text-black">
                                <a href="' . Config::Root . 'dong-xe-'. $this->to_slug($arr->TenChuyenMuc) . '-' . $arr->IDChuyenMucChinh . '.html">' . $arr->TenChuyenMuc .'</a>
                                <div class="popup-text">
                                    <p><a href="' . Config::Root . 'dong-xe-'. $this->to_slug($arr->TenChuyenMuc) . '-' . $arr->ID . '.html">' . $arr->ChuyenMucPhu .'</a></p>
                        ';
                        if ($arr == $last_key) {
                            echo '</div></div>';
                        }
                    }
                    $last_category = $arr->TenChuyenMuc;
                }
                
                ?>
            </div>
        </div>
    </header>
    
    