class Form {
    constructor(selector) {
        this.url = "/xetaithacokiahaugiang.com/tpt-admin-pannel-2021/";
        this.form = $(selector);
        this.form.on("submit", ((e) => {
            e.preventDefault();
            this.form_handle();
        }));
    }

    async form_handle() {
        var action = this.form.attr("action");
        var method = this.form.attr("method");
        var input = $("input, textarea, select", this.form);
        var data = {};
        for (var i = 0; i < input.length; i++) {
            if (input[i].getAttribute("type") == "checkbox") {
                input[i].value = (input[i].checked) ? "on" : "off";
            } else if (input[i].getAttribute("type") == "button") {
                input[i].value = (input[i].value == ("Chọn ảnh đại diện" || "")) ? "Null" : input[i].value;
            } else if (input[i].getAttribute("type") == "file") {
                var totalfiles = input[i].files.length;
                var filesData = [];
                for (var index = 0; index < totalfiles; index++) {
                    var content = await this.readFile(input[i].files[index]);
                    filesData.push([input[i].files[index].name, encodeURIComponent(content)]);
                }
                
                data["files"] = filesData;
                continue
            } else if (input[i].localName == "textarea") {
                input[i].value = encodeURIComponent(CKEDITOR.instances[input[i].id].getData());
            }
            if  (typeof input[i].value != "undefined") {
                if (typeof data[input[i].getAttribute("name")] == "undefined") {
                    data[input[i].getAttribute("name")] = input[i].value;
                } else {
                    data[input[i].getAttribute("name")] += ", " + input[i].value;
                }
            }
        }
        
        $.ajax({
            type: method,
            url: this.url + "?action=" + action,
            data: '{"data" : ' + JSON.stringify(data) + '}',
            success: this[action],
            error: this.callback_error,
            contentType: "application/json; charset=utf-8",
        });
    }

    login(data) {
        data = JSON.parse(data);
        const alertpopup = document.getElementsByClassName("alert-popup")[0];
        alertpopup.innerHTML = "<h1>Chào mừng " + data["message"]["HoVaTen"] + "</h1>";
        alertpopup.classList.add("active-popup");
        alertpopup.classList.remove("alert-fail");
        setTimeout(() => {
            alertpopup.classList.remove("active-popup");
            window.location.reload();
        }, 2000);
    }

    logout(data) {
        data = JSON.parse(data);
        const alertpopup = document.getElementsByClassName("alert-popup")[0];
        alertpopup.innerHTML = "<h1>" + data["message"] + "</h1>";
        alertpopup.classList.add("active-popup");
        alertpopup.classList.remove("alert-fail");
        setTimeout(() => {
            alertpopup.classList.remove("active-popup");
            window.location.replace(this.url.replace("?action=logout",""));
        }, 2000);
    }

    create_view_report(data) {
        data = JSON.parse(data);
        const alertpopup = document.getElementsByClassName("alert-popup")[0];
        alertpopup.innerHTML = "<h1>" + data["message"] + "</h1>";
        alertpopup.classList.add("active-popup");
        alertpopup.classList.remove("alert-fail");
        setTimeout(() => {
            alertpopup.classList.remove("active-popup");
            window.location.replace(this.url.replace("?action=create_view_report",""));
        }, 2000);
    }

    add_category(data) {
        data = JSON.parse(data);
        const alertpopup = document.getElementsByClassName("alert-popup")[0];
        alertpopup.innerHTML = "<h1>" + data["message"] + "</h1>";
        alertpopup.classList.add("active-popup");
        alertpopup.classList.remove("alert-fail");
        setTimeout(() => {
            alertpopup.classList.remove("active-popup");
            window.location.replace(this.url.replace("?action=add_category","/quan-ly-chuyen-muc"));
        }, 2000);
    }

    edit_category(data) {
        data = JSON.parse(data);
        const alertpopup = document.getElementsByClassName("alert-popup")[0];
        alertpopup.innerHTML = "<h1>" + data["message"] + "</h1>";
        alertpopup.classList.add("active-popup");
        alertpopup.classList.remove("alert-fail");
        setTimeout(() => {
            alertpopup.classList.remove("active-popup");
            window.location.replace(this.url.replace("?action=edit_category","/quan-ly-chuyen-muc"));
        }, 2000);
    }

    delete_category(data) {
        data = JSON.parse(data);
        const alertpopup = document.getElementsByClassName("alert-popup")[0];
        alertpopup.innerHTML = "<h1>" + data["message"] + "</h1>";
        alertpopup.classList.add("active-popup");
        alertpopup.classList.remove("alert-fail");
        setTimeout(() => {
            alertpopup.classList.remove("active-popup");
            window.location.replace(this.url.replace("?action=delete_category","/quan-ly-chuyen-muc"));
        }, 2000);
    }

    add_product(data) {
        data = JSON.parse(data);
        const alertpopup = document.getElementsByClassName("alert-popup")[0];
        alertpopup.innerHTML = "<h1>" + data["message"] + "</h1>";
        alertpopup.classList.add("active-popup");
        alertpopup.classList.remove("alert-fail");
        setTimeout(() => {
            alertpopup.classList.remove("active-popup");
            window.location.replace(this.url.replace("?action=add_product","/quan-ly-san-pham"));
        }, 2000);
    }

    edit_product(data) {
        data = JSON.parse(data);
        const alertpopup = document.getElementsByClassName("alert-popup")[0];
        alertpopup.innerHTML = "<h1>" + data["message"] + "</h1>";
        alertpopup.classList.add("active-popup");
        alertpopup.classList.remove("alert-fail");
        setTimeout(() => {
            alertpopup.classList.remove("active-popup");
            window.location.replace(this.url.replace("?action=edit_product","/quan-ly-san-pham"));
        }, 2000);
    }

    delete_product(data) {
        data = JSON.parse(data);
        const alertpopup = document.getElementsByClassName("alert-popup")[0];
        alertpopup.innerHTML = "<h1>" + data["message"] + "</h1>";
        alertpopup.classList.add("active-popup");
        alertpopup.classList.remove("alert-fail");
        setTimeout(() => {
            alertpopup.classList.remove("active-popup");
            window.location.replace(this.url.replace("?action=delete_product","/quan-ly-san-pham"));
        }, 2000);
    }

    add_image(data) {
        data = JSON.parse(data);
        const alertpopup = document.getElementsByClassName("alert-popup")[0];
        alertpopup.innerHTML = "<h1>" + data["message"] + "</h1>";
        alertpopup.classList.add("active-popup");
        alertpopup.classList.remove("alert-fail");
        setTimeout(() => {
            alertpopup.classList.remove("active-popup");
            window.location.replace(this.url.replace("?action=add_image","/quan-ly-hinh-anh"));
        }, 2000);
    }

    delete_image(data) {
        data = JSON.parse(data);
        const alertpopup = document.getElementsByClassName("alert-popup")[0];
        alertpopup.innerHTML = "<h1>" + data["message"] + "</h1>";
        alertpopup.classList.add("active-popup");
        alertpopup.classList.remove("alert-fail");
        setTimeout(() => {
            alertpopup.classList.remove("active-popup");
            window.location.replace(this.url.replace("?action=delete_image","/quan-ly-hinh-anh"));
        }, 2000);
    }

    get_images(data) {
        data = JSON.parse(data);
        data["message"].forEach(function(element) {
            $(".modal-body").append(`
                <figure class="figure m-2" style="width: 300px;"> 
                    <img src="https://xetaithacokiahaugiang.com/` + element["DuongDan"] + `" class="figure-img img-fluid rounded" alt="Hình ảnh">
                    <figcaption class="figure-caption"> 
                        <button class="form-control" onclick="chooseImage('` + element["DuongDan"] + `')" readonly>Chọn ảnh</button>
                    </figcaption>
                </figure>
            `);
        });
        
    }

    callback_success(data) {
        const alertpopup = document.getElementsByClassName("alert-popup")[0];
        alertpopup.innerHTML = "<h1>" + data["message"] + "</h1>";
        alertpopup.classList.add("active-popup");
        alertpopup.classList.remove("alert-fail");
        setTimeout(() => {
            alertpopup.classList.remove("active-popup");
            window.location.reload();
        }, 2000);
    }

    callback_error(XMLHttpRequest, textStatus, errorThrown) {
        var decoded_text = JSON.parse(XMLHttpRequest.responseText);
        const alertpopup = document.getElementsByClassName("alert-popup")[0];
        alertpopup.innerHTML = "<h1>" + decoded_text["message"] + "</h1>";
        alertpopup.classList.add("active-popup");
        alertpopup.classList.remove("alert-fail");
        if (decoded_text['status'] == "fail") alertpopup.classList.add("alert-fail");
        setTimeout(() => {
            alertpopup.classList.remove("active-popup");
        }, 2000);
    }

    readFile(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
        
            reader.onload = res => {
                resolve(res.target.result);
            };
            reader.onerror = err => reject(err);
        
            reader.readAsDataURL(file);
        });
    }
}