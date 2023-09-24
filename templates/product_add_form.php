    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-white" style="flex: 1!important;">
        <div class="d-flex justify-content-md-between my-5">
            <a href="../quan-ly-san-pham" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i>
                Quay lại
            </a>
        </div>
        <form id="addProductForm" action="add_product" method="POST">
            <div class="row m-5">
                <label for="inputProduct" class="form-label text-black">Tên sản phẩm</label>
                <input class="form-control" name="product_name" type="text" id="inputProduct">
            </div>
            <div class="row m-5">
                <label for="inputProductSpecification" class="form-label text-black">Thông số kĩ thuật</label>
                <textarea name="product_specification" type="text" id="inputProductSpecification" rows="10"></textarea>
            </div>
            <div class="row m-5">
                <label for="inputProductDescription" class="form-label text-black">Mô tả</label>
                <textarea name="product_description" type="text" id="inputProductDescription" rows="10"></textarea>
            </div>
            <div class="row m-5">
                <label for="inputProductPrice" class="form-label text-black">Giá tiền</label>
                <input name="product_price" type="number" class="form-control" id="inputProductPrice">
            </div>
            <div class="row m-5">
                <label for="inputProductSale" class="form-label text-black">Giảm giá</label>
                <input name="product_sale" type="number" class="form-control" id="inputProductSale">
            </div>
            <div class="row m-5">
                <label for="inputProductDescription" class="form-label text-black">Chuyên mục</label>
                <select name="category" class="form-select" aria-label="Default select example">
                    <?php

                        foreach ($categories as $arr) {
                            echo '<option value="' . $arr->ID . '">' . $arr->TenChuyenMuc . '</option>';
                        }

                    ?>
                </select>
            </div>
            <div class="row m-5">
                <input type="button" id="inputThumbnail" name="thumbnail" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#getImageModal" value="Chọn ảnh đại diện" onclick="$button_id='inputThumbnail';$('#getImagesModal').submit()">
            </div>
            <div class="row m-5" id="inputSlideImage">
                <input type="button" name="slideshow" class="button-add-image col-md-2" data-bs-toggle="modal" data-bs-target="#getImageModal" onclick="$button_id='inputSlideImage'; $button_index = 0;$('#getImagesModal').submit()">
            </div>
            <div class="row m-5 justify-content-md-center">
                <button class="btn btn-primary btn-lg" style="width: 20rem" type="submit">
                    <i class="fas fa-plus"></i>
                    Thêm vào sản phẩm
                </button>
            </div>
        </form>
        <form id="getImagesModal" action="get_images" method="POST">
            <input name="page" type="number" class="d-none" value="1">
        </form>
        <div class="modal fade" id="getImageModal" tabindex="-1" aria-labelledby="getImageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-black" id="getImageModalLabel">Chọn ảnh đại diện cho sản phẩm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body flex-row row align-items-end">
                        <button class="form-control" type="button" onclick="moreImages();">Thêm ảnh</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Thoát</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    $add_form = new Form("#addProductForm");
    $get_images = new Form("#getImagesModal");
    $index = 1;
    $url = -1;
    $button_id = "";
    $button_index = -1;
    $button_length = 0;
    function chooseImage(url) {
        $url = url;
        $("#getImageModal").modal("hide");
    }

    function moreImages() {
        index++;
        $("#getImagesModal input").val(index);
        $("#getImagesModal").submit();
    }

    $("#getImageModal").on("hidden.bs.modal", function () {
        index = 1;
        $("#getImagesModal input").val(index);
        if ($button_id == "inputThumbnail") {
            if ($url == -1) {
                $("#inputThumbnail")[0].value = "Chọn ảnh đại diện";
            } else {
                $("#inputThumbnail")[0].value = $url;
                $url = -1;
            }
        } else {
            if ($url == -1) {
                $("#inputSlideImage input")[$button_index].value = null;
                $("#inputSlideImage input")[$button_index].style.backgroundImage = "";
                if ($("#inputSlideImage input").length > 1) {
                    $("#inputSlideImage input")[$button_index].remove();
                    $("#inputSlideImage input").each(function(index, element)  {
                        element.setAttribute("onclick", `$button_id='inputSlideImage'; $button_index = ` + (index) + `;$('#getImagesModal').submit()`);
                    });
                }
            } else {
                $("#inputSlideImage input")[$button_index].value = $url;
                $("#inputSlideImage input")[$button_index].style.backgroundImage = "url('https://xetaithacokiahaugiang.com/" + $url + "')";
                if ($("#inputSlideImage input").length == $button_index + 1) {
                    $("#inputSlideImage input")[$button_index].parentNode.innerHTML += `<input type="button" name="slideshow" class="button-add-image col-md-2" data-bs-toggle="modal" data-bs-target="#getImageModal" onclick="$button_id='inputSlideImage'; $button_index = ` + ($button_index + 1) + `;$('#getImagesModal').submit()">`;
                }
                $url = -1;
            }
        }

        $(".modal-body").html('<button class="form-control" type="button" onclick="moreImages();">Thêm ảnh</button>');
    });

    CKEDITOR.config.width = "100%";
    CKEDITOR.replace('inputProductDescription');
    CKEDITOR.replace('inputProductSpecification');
</script>
