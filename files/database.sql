CREATE TABLE IF NOT EXISTS `quantrivien`(
    ID INT AUTO_INCREMENT PRIMARY KEY ,
    HoVaTen VARCHAR(255),
    GioiTinh VARCHAR(3),
    DiaChi VARCHAR(255),
    AnhDaiDien VARCHAR(255),
    Email VARCHAR(255),
    TenTaiKhoan VARCHAR(50),
    MatKhau VARCHAR(128),
    PhienDangNhap VARCHAR(128)
);

CREATE TABLE IF NOT EXISTS `chuyenmuc`(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    TenChuyenMuc VARCHAR(255),
    MoTa TEXT,
    AnhDaiDien TEXT,
    ChuyenMucChinh INT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS `sanpham`(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    TenSanPham VARCHAR(255),
    ThongSo TEXT,
    MoTa TEXT,
    GiaTien INT,
    GiamGia INT,
    ChuyenMuc INT,
    AnhDaiDien TEXT,
    BoSuuTapAnh TEXT,
    LuotXem INT DEFAULT 0,
    FOREIGN KEY (ChuyenMuc) REFERENCES `chuyenmuc`(ID) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS `hinhanh`(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    DuongDan TEXT,
    NgayDangTai DATE
);

CREATE TABLE IF NOT EXISTS `khach`(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    IP TEXT UNIQUE,
    ThongTin JSON,
    UrlGheThamCuoi TEXT,
    LanGheThamCuoi DATETIME
);

CREATE TABLE IF NOT EXISTS `thongkekhach`(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    LuotXem INT,
    ThoiGian DATETIME
);

CREATE EVENT thongkekhach_event
    ON SCHEDULE 
        EVERY 1 HOUR
    DO
        INSERT INTO thongkekhach(LuotXem, ThoiGian) VALUES((SELECT COUNT(ID) FROM khach), NOW());

