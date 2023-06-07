<?php include('header.php'); ?>
<?php include('security.php');
include('sidemenu.php'); ?>

<div class="main-content">
    <div class="container">

    <form action="create_variant.php" method="POST">
    <h4>Add Stocks  <button type="button" class="add-more-form btn btn-primary ">+</button></h4>

    <div class="container dynamicForm">
            <div>
                <div class="row">
                    <input type="hidden" class="form-control sl" name="row[]" value=1>
                    <div class="col-md-8">
                        <label><strong>Color & Size</strong></label>
                        <input type="text" class="form-control" placeholder="Color & Size" name="color_size[]">
                    </div>
                    <div class="col-md-3">
                        <label><strong>Quantity</strong></label>
                        <input type="number" class="form-control" placeholder="Quantity" name="quantity[]">
                        </div>
                        <div class="col-md-1">
                        <label><strong>Remove</strong></label>
                        <button type="button" class="remove-btn btn btn-danger form-control"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="add-new-form"></div>

        <div class="form-group my-5">
                            <input type="submit" class="btn btn-primary me-5" name="add_variant" value="Add Variant">
                            <a class="btn btn-danger" href="add_product.php">Cancel</a>
        </div>
        </form>
    </div>
</div>

<!-- Script to add new row -->
<script>
    $(document).ready(function () {

        $(document).on('click', '.remove-btn', function () {

            $(this).closest('.dynamicForm').remove();

        });

        $(document).on('click', '.add-more-form', function () {
            var length = $('.sl').length;
            var i = parseInt(length)+parseInt(1);
            var newrow = $('.add-new-form').append('<div class="container dynamicForm">\
                            <div>\
                                <div class="row">\
                                    <input type="hidden" class="form-control sl" name="row[]" value="'+i+'">\
                                    <div class="col-md-8">\
                                        <label><strong>Color & Size</strong></label>\
                                        <input type="text" class="form-control" placeholder="Color & Size" name="color_size[]">\
                                    </div>\
                                    <div class="col-md-3">\
                                        <label><strong>Quantity</strong></label>\
                                        <input type="text" class="form-control" placeholder="Quantity" name="quantity[]">\
                                     </div>\
                                     <div class="col-md-1">\
                                        <label><strong>Remove</strong></label>\
                                        <button type="button" class="remove-btn btn btn-danger form-control"><i class="fas fa-trash"></i></button>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>');
        });
    });
</script>