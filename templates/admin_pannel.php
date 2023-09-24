<main>
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark">
        <a href="<?= Config::Root ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <i class="fas fa-home"></i>&nbsp;
            Quay lại trang chủ
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="<?= Config::AdminRoot ?>" class="nav-link text-white <?= (!isset($_GET['action']) || $_GET['action'] == "show_admin_dashboard") ? "active" : "" ?>" aria-current="page">
                    <i class="fas fa-tachometer-alt"></i>
                    Bảng điều khiển
                </a>
            </li>
            <li>
                <a href="<?= Config::AdminRoot ?>quan-ly-chuyen-muc" class="nav-link text-white <?= (isset($_GET['action']) && ($_GET['action'] == "show_categories" || $_GET['action'] == "show_add_category_form" || $_GET['action'] == "show_edit_category_form")) ? "active" : "" ?>">
                    <i class="fas fa-list-alt"></i>
                    Chuyên mục
                </a>
            </li>
            <li>
                <a href="<?= Config::AdminRoot ?>quan-ly-san-pham" class="nav-link text-white <?= (isset($_GET['action']) && ($_GET['action'] == "show_products" || $_GET['action'] == "show_add_product_form" || $_GET['action'] == "show_edit_product_form")) ? "active" : "" ?>">
                    <i class="fas fa-boxes"></i>
                    Sản phẩm
                </a>
            </li>
            <li>
                <a href="<?= Config::AdminRoot ?>quan-ly-hinh-anh" class="nav-link text-white <?= (isset($_GET['action']) && ($_GET['action'] == "show_images" || $_GET['action'] == "show_add_image_form")) ? "active" : "" ?>">
                    <i class="fas fa-images"></i>
                    Hình ảnh
                </a>
            </li>
            <li>
                <a href="<?= Config::AdminRoot ?>quan-ly-khach" class="nav-link text-white <?= (isset($_GET['action']) && ($_GET['action'] == "show_visitors")) ? "active" : "" ?>">
                    <i class="fas fa-users"></i>
                    Khách
                </a>
            </li>
        </ul>
        <hr>
        <form id="logoutForm" action="logout" method="POST">
            <button class="btn btn-danger btn-lg btn-block" type="submit">Đăng xuất</button>
        </form>
    </div>
    <div class="divider"></div>
