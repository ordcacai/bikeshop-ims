<?php
    include('layouts/header.php');
    include('server/connection.php');

    $stmt = $conn->prepare('SELECT * FROM products');
    $stmt->execute();
    $products = $stmt->get_result();
?>

<style>
    td>img {
        width: 100%;
        height: 250px;
        object-fit: contain;
    }
</style>

<section class="py-5">
    <div class="container text-center mt-5 py-5">
        <h3>Our Products</h3>
        <hr class="mx-auto">
    </div>
    <div class="container">
        <div class="col-md-9 mx-auto">
            <table class="table">
                <tr class="bg-light">
                    <th>Select Product</th>
                    <th width="300px">
                        <select class="form-control" id="select1" onchange="item1(this.value)">
                            <option value="0">-- Select Item 1 --</option>
                            <?php while($row = $products->fetch_assoc()){ ?>
                                <option value="<?php echo $row['product_id'] ?>"><?php echo $row['product_name'] ?></option>
                            <?php } ?>
                        </select>
                    </th>
                    <th width="300px">
                        <select class="form-control" id="select2" onchange="item2(this.value)">
                            <option value="0">-- Select Item 2 --</option>
                            <?php
                                $products->data_seek(0);
                                while($row = $products->fetch_assoc()){ ?>
                                <option value="<?php echo $row['product_id'] ?>"><?php echo $row['product_name'] ?></option>
                            <?php } ?>
                        </select>
                    </th>
                </tr>
                <tr>
                    <th>Product Image</th>
                    <td>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png"
                            id="img1" alt=" ">
                    </td>
                    <td>
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png"
                            id="img2" alt=" ">
                    </td>
                </tr>
                <tr>
                    <th>Product Price</th>
                    <td id="price1">N/A</td>
                    <td id="price2">N/A</td>
                </tr>
                <tr>
                    <th>Product Description</th>
                    <td id="desc1">N/A</td>
                    <td id="desc2">N/A</td>
                </tr>
                <tr>
                    <th>Product Brand</th>
                    <td id="brand1">N/A</td>
                    <td id="brand2">N/A</td>
                </tr>
            </table>
        </div>
    </div>
</section>

<script>
    var products = <?php echo json_encode($products->fetch_all(MYSQLI_ASSOC)); ?>;

    function item1(productId) {
        var select2 = document.getElementById("select2").value;
        if (productId !== select2) {
            var selectedProduct = products.find(function(product) {
                return product.product_id == productId;
            });
            document.getElementById("img1").src = selectedProduct.product_image;
            document.getElementById("price1").innerHTML = "PHP " + selectedProduct.product_price;
            document.getElementById("desc1").innerHTML = selectedProduct.product_description;
            document.getElementById("brand1").innerHTML = selectedProduct.product_category;
        } else {
            document.getElementById("select1").selectedIndex = 0;
            document.getElementById("img1").src = "https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png";
            document.getElementById("price1").innerHTML = "N/A";
            document.getElementById("desc1").innerHTML = "N/A";
            document.getElementById("brand1").innerHTML = "N/A";
        }
    }

    function item2(productId) {
        var select1 = document.getElementById("select1").value;
        if (productId !== select1) {
            var selectedProduct = products.find(function(product) {
                return product.product_id == productId;
            });
            document.getElementById("img2").src = selectedProduct.product_image;
            document.getElementById("price2").innerHTML = "PHP " + selectedProduct.product_price;
            document.getElementById("desc2").innerHTML = selectedProduct.product_description;
            document.getElementById("brand2").innerHTML = selectedProduct.product_category;
        } else {
            document.getElementById("select2").selectedIndex = 0;
            document.getElementById("img2").src = "https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png";
            document.getElementById("price2").innerHTML = "N/A";
            document.getElementById("desc2").innerHTML = "N/A";
            document.getElementById("brand2").innerHTML = "N/A";
        }
    }
</script>

<?php include('layouts/footer.php'); ?>
