<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-white" style="flex: 1!important;">
        <div class="d-flex justify-content-md-between my-5">
            <a href="../quan-ly-hinh-anh" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i>
                Quay lại
            </a>
        </div>
        <form id="addImageForm" action="add_image" method="POST" enctype="multipart/form-data">
            <div class="row mx-5">
                <label for="inputImages" class="form-label text-black">Hình ảnh</label>
                <input class="form-control" name="category_name" type="file" id="inputImages" multiple  accept="image/*">
            </div>
            <div class="row mt-5 justify-content-md-center" id="previewImages">
            </div>
            <div class="row mt-5 justify-content-md-center">
                <button class="btn btn-primary btn-lg" style="width: 20rem" type="submit">
                    <i class="fas fa-plus"></i>
                    Thêm vào hình ảnh
                </button>
            </div>
        </form>
    </div>
</main>
<script>
    $add_form = new Form("#addImageForm");
    $("#inputImages").on("change", function() {
        $('#previewImages').html("");
        imagesPreview(this, '#previewImages');
    });

    function imagesPreview(input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    image = $($.parseHTML('<img>'));
                    image.attr('class', "rounded float-left");
                    image.attr('style', "width: 200px; height: 200px;");
                    image.attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    }
</script>
