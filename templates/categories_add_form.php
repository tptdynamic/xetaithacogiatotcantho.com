<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-white" style="flex: 1!important;">
        <div class="d-flex justify-content-md-between my-5">
            <a href="../quan-ly-chuyen-muc" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i>
                Quay lại
            </a>
        </div>
        <form id="addCategoriesForm" action="add_category" method="POST">
            <div class="row mx-5">
                <label for="inputCategories" class="form-label text-black">Tên chuyên mục</label>
                <input class="form-control" name="category_name" type="text" id="inputCategory">
            </div>
            <div class="row mx-5">
                <label for="inputCategoryDescription" class="form-label text-black">Mô tả</label>
                <textarea name="category_description" type="text" id="inputCategoryDescription" rows="10"></textarea>
            </div>
            <div class="row mx-5">
                <label for="inputSubCategory" class="form-label text-black">Chọn chuyên mục chính</label>
                <select class="form-control" name="main_category" type="text" id="inputSubCategory" value="<?= $category->ChuyenMucChinh ?>">
                    <option value="0">Không có</option>
                    <?php
                        foreach ($categories as $arr) {
                            echo '<option value="' . $arr->ID . '">' . $arr->TenChuyenMuc . '</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="row m-5">
                <input type="button" name="path" id="inputThumbnail" name="thumbnail" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#getImageModal" value="Chọn ảnh đại diện" onclick="$('#getImagesModal').submit()"></input>
            </div>
            <div class="row mt-5 justify-content-md-center">
                <button class="btn btn-primary btn-lg" style="width: 20rem" type="submit">
                    <i class="fas fa-plus"></i>
                    Thêm vào chuyên mục
                </button>
            </div>
        </form>
        <form id="getImagesModal" action="get_images" method="POST">
            <input name="page" type="number" class="d-none" value="1"></input>
        </form>
        <div class="modal fade" id="getImageModal" tabindex="-1" aria-labelledby="getImageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-black" id="getImageModalLabel">Chọn ảnh đại diện cho sản phẩm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
    $add_form = new Form("#addCategoriesForm");
    $get_images = new Form("#getImagesModal");
    $index = 1;
    $url = -1;
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
        if ($url == -1) {
            $("#inputThumbnail")[0].value = "Chọn ảnh đại diện";
        } else {
            $("#inputThumbnail")[0].value = $url;
            $url = -1;
        }
        
        $(".modal-body").html('<button class="form-control" type="button" onclick="moreImages();">Thêm ảnh</button>');
    });
    CKEDITOR.config.width = "100%";
    CKEDITOR.replace('inputCategoryDescription');
</script>
