<?php

class Config {
    const Title = "Xe tải THACO KIA giá tốt Hậu Giang";
    const Author = "Trần Phương Trí";
    const Localhost = true;
    const Domain = "https://xetaithacokiahaugiang.com/";
    const Root = ((Config::Localhost == true) ? "http://localhost/xetaithacokiahaugiang.com/" : Config::Domain);
    const AdminRoot = Config::Root . "tpt-admin-pannel-2021/";
    const TimeZone = "Asia/Ho_Chi_Minh";
    const UTC = "+07:00";
    const Telephone = "0908151099";
    const Zalo = "https://zalo.me/0908151099";
    const Facebook = "https://www.facebook.com/xetaikiagiatotcantho";
    const FacebookAppId = "888863448137206";
    const Email = "quoctoan.261699@gmail.com";
}

?>