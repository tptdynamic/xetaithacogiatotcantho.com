<div class="container">
    <form class="login-form row g-3 justify-content-md-between mt-5" style="min-height: 90vh;" id="loginForm" action="login" method="POST">
        <div class="col-md-6 d-flex align-items-center justify-content-md-center">
            <img src="res/images/admin_avatar.webp" class="img-fluid align-middle" alt="Ảnh đại diện quản trị viên">
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-md-center">
            <div class="d-block">
                <div class="row mb-5">
                    <h2>Trang đăng nhập quản trị viên</h2>
                </div>
                <div class="row mt-2">
                    <label for="inputEmail" class="form-label">Tên tài khoản</label>
                    <input type="text" name="username" class="form-control" id="inputEmail">
                </div>
                <div class="row mt-2">
                    <label for="inputPassword" class="form-label">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" id="inputPassword">
                </div>
                <div class="row mt-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="checkboxRemember">
                        <label class="form-check-label" for="checkboxRemember">
                            Ghi nhớ
                        </label>
                    </div>
                    <button class="login-button mt-3">Đăng nhập</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="alert-popup"></div>
<script>
    $login_form = new Form("#loginForm");
</script>