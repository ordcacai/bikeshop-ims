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

<?php 

$stmt1 = $conn->prepare("SELECT * FROM stocks WHERE product_id = ?");
$stmt1->bind_param("i", $product_id);
$stmt1->execute();
$stock = $stmt1->get_result();

?>

<?php include('security.php');
include('sidemenu.php'); ?>

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
            </div><br>
            <div class="product-info">
                <table class="product-table mx-5">
                    <tr>
                        <th>Product Name</th>
                        <td><?php echo $product['product_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Retail Price</th>
                        <td><?php echo $product['product_price']; ?></td>
                    </tr>
                    <tr>
                        <th>Base Price</th>
                        <td><?php echo $product['product_bp']; ?></td>
                    </tr>
                    <tr>
                        <th>Wholesale Price</th>
                        <td><?php echo $product['product_wsp']; ?></td>
                    </tr>
                    <tr>
                        <th>Discounted Price</th>
                        <td><?php echo $product['product_special_offer']; ?></td>
                    </tr>
                </table>
            </div><br>
            <div class="product-info ms-5">
                <table class="product-table">
                <tr>
                        <th>Color & Size</th>
                        <th>QTY</th>
                    </tr>
                    <?php foreach($stock as $row){ ?>
                    <tr>
                        
                        <td><?php echo $row['color_size']; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <div class="specifications-box mt-5 pt-5">
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
            <a href="edit_product.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-primary btn-lg py-2 px-4 me-4" style="font-weight: 500; font-size: 19px;">Edit</a>
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


