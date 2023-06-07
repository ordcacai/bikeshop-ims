<?php include('header.php'); ?>

<?php
// Check if product_id is provided in the URL
if (!isset($_GET['product_id'])) {
    header('location: inventory.php');
    exit;
}

// Retrieve the product details from the database based on the provided product_id
$product_id = $_GET['product_id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

// Retrieve the images URLs from the product columns
$images = [];
$images[] = $product['product_image'];
$images[] = $product['product_image2'];
$images[] = $product['product_image3'];
$images[] = $product['product_image4'];
?>

<?php include('security.php');
include('sidemenu.php'); ?>

<link rel="stylesheet" type="text/css" href="admin_style.css">


<div class="main-content">
    <div class="container-fluid">
        <h1 class="my-4">Product Details</h1>

        <div class="product-details-container mt-5">
            <div class="product-image">
                <div class="product-carousel-container">
                    <div class="product-carousel">
                        <img src="<?php echo "../assets/imgs/".$product['product_image']; ?>" alt="Product Image" class="img-fluid carousel-image active" onclick="carouselNext()">
                    </div>
                    <div class="carousel-navigation">
                        <button class="carousel-button" onclick="carouselPrevious()">&lt;</button>
                        <button class="carousel-button" onclick="carouselNext()">&gt;</button>
                    </div>
                </div>
            </div>
            <div class="product-info">
                <table class="product-table">
                    <tr>
                        <th>SRP</th>
                        <td><?php echo $product['product_price']; ?></td>
                    </tr>
                    <tr>
                        <th>WSP</th>
                        <td><?php echo $product['product_special_offer']; ?></td>
                    </tr>
                    <tr>
                        <th>Stocks</th>
                        <td><?php echo $product['product_quantity']; ?></td>
                    </tr>
                    <tr>
                        <th>Color & Size</th>
                        <td><?php echo $product['product_color']; ?>, <?php echo $product['product_size']; ?></td>
                    </tr>
                    <tr>
                        <th>QTY</th>
                        <td><?php echo $product['product_quantity']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="specifications-box">
            <h2>Specifications</h2>
            <table class="specifications-table">
                <tr>
                    <th>Description</th>
                </tr>
                <tr>
                    <td class="description-details"><?php echo $product['product_description']; ?></td>
                </tr>
            </table>
        </div>
        <div class="buttons-container">
            <a href="edit_product.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-primary me-4">Edit</a>
            
            <button type="button" class="btn btn-success me-4" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Add Variant</button>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <form action="add_variant.php" method="POST">
                    <div class="modal-content">
                    <div class="modal-header mb-3">
                        <h5 class="modal-title" id="exampleModalLabel">Add Variant</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <h4 class="ms-3">Add Stocks  <button type="button" class="add-more-form btn btn-primary ">+</button></h4>
                    <div class="modal-body">
                        
                            <div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label><strong>Color & Size</strong></label>
                                        <input type="text" class="form-control" placeholder="Color & Size" name="color_size">
                                    </div>
                                    <div class="col-md-5">
                                        <label><strong>Quantity</strong></label>
                                        <input type="text" class="form-control" placeholder="Quantity" name="quantity">
                                     </div>
                                     <div class="col-md-2">
                                        <label><strong>Remove</strong></label>
                                        <button type="button" class="remove-btn btn btn-danger form-control">X</button>
                                    </div>
                                </div>
                            </div>
                        
                    </div>

                    <div class="add-new-form pt-2"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" value="Add Variant/s">
                    </div>
                    </div>
                </form>
                </div>
                </div>
                <a href="inventory.php" class="btn btn-secondary">Cancel</a>
        </div>
    </div>
</div>

<script>
    var images = [
        <?php
        foreach ($images as $image) {
            if (!empty($image)) {
                echo "'" . "../assets/imgs/" . $image . "', ";
            }
        }
        ?>
    ];

    var currentIndex = 0;
    var carouselImage = document.querySelector('.carousel-image');

    function fadeOut() {
        carouselImage.classList.add('fade-out');
        setTimeout(function() {
            carouselImage.src = images[currentIndex];
            carouselImage.classList.remove('fade-out');
            carouselImage.classList.add('active');
        }, 500);
    }

    function carouselNext() {
        currentIndex = (currentIndex + 1) % images.length;
        fadeOut();
    }

    function carouselPrevious() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        fadeOut();
    }
</script>

<!-- Script to add new row -->
<script>
    $(document).ready(function () {

        $(document).on('click', '.remove-btn', function () {

            $(this).closest('.modal-body').remove();

        });

        $(document).on('click', '.add-more-form', function () {
            $('.add-new-form').append('<div class="modal-body">\
                            <div>\
                                <div class="row">\
                                    <div class="col-md-5">\
                                        <label><strong>Color & Size</strong></label>\
                                        <input type="text" class="form-control" placeholder="Color & Size" name="color_size">\
                                    </div>\
                                    <div class="col-md-5">\
                                        <label><strong>Quantity</strong></label>\
                                        <input type="text" class="form-control" placeholder="Quantity" name="quantity">\
                                     </div>\
                                     <div class="col-md-2">\
                                        <label><strong>Remove</strong></label>\
                                        <button type="button" class="remove-btn btn btn-danger form-control">X</button>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>');
        });
    });
</script>
