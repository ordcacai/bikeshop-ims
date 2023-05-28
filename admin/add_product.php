<?php include('header.php'); ?>
<?php include('security.php');
include('sidemenu.php'); ?>

<div class="main-content">
    <div class="container-fluid">
            <h1 class="my-4">Add New Product</h1>
            <div class="table-responsive">

                <div class="mx-auto container">

                    <form id="create-form" enctype="multipart/form-data" method="POST" action="create_product.php">
                        <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>

                        <div class="form-group mt-2">
                            <label><strong>Product Name</strong></label>
                            <input type="text" class="form-control" id="product-name" name="name" placeholder="Product Name" required>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Category</strong></label>
                            <select class="form-select" required name="category">

                                <option value="Bike">Bike</option>
                                <option value="parts">Parts & Accessories</option>
                                <option value="Ebike">E-Bike</option>

                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Description</strong></label>
                            <textarea class="form-control" id="product-desc" name="description" rows="7" placeholder="Description" required></textarea>
                        </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group mt-2">
                                <label><strong>Image 1</strong></label>
                                <input type="file" class="form-control" id="image1" name="image1" placeholder="Image 1" required>
                            </div>

                            <div class="form-group mt-2">
                                <label><strong>Image 2</strong></label>
                                <input type="file" class="form-control" id="image2" name="image2" placeholder="Image 2" required>
                            </div>

                            <div class="form-group mt-2">
                                <label><strong>Image 3</strong></label>
                                <input type="file" class="form-control" id="image3" name="image3" placeholder="Image 3" required>
                            </div>

                            <div class="form-group mt-2">
                                <label><strong>Image 4</strong></label>
                                <input type="file" class="form-control" id="image4" name="image4" placeholder="Image 4" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group mt-2">
                                <label><strong>Base Price</strong></label>
                                <input type="text" class="form-control" id="base-price" min="1" max="500000" name="base-price" placeholder="Base Price" required>
                            </div>

                            <div class="form-group mt-2">
                                <label><strong>Retail Price</strong></label>
                                <input type="text" class="form-control" id="retail-price" min="1" max="500000" name="retail-price" placeholder="Retail Price" required>
                            </div>

                            <div class="form-group mt-2">
                                <label><strong>Wholesale Price</strong></label>
                                <input type="text" class="form-control" id="ws-price" min="1" max="500000" name="ws-price" placeholder="Wholesale Price" required>
                            </div>

                            <div class="form-group mt-2">
                                <label><strong>Discounted Price</strong></label>
                                <input type="number" class="form-control" id="product-disc" name="discount" min="1" max="100" placeholder="Discounted Price" required>
                            </div>
                        </div>
                    </div><br><br>

                    <h4>Add Stocks  <button type="button" class="btn btn-primary" onclick="addRow()">+</button></h4>

                    <div class="container">
                            <div id="dynamicForm">
                                <div class="row">
                                    <div class="col">
                                        <label><strong>Color & Size</strong></label>
                                        <input type="text" class="form-control" placeholder="Color & Size" name="color-size">
                                    </div>

                                    <div class="col">
                                        <label><strong>Quantity</strong></label>
                                        <input type="text" class="form-control" placeholder="Quantity" name="quantity">

                                     </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group my-5">
                            <input type="submit" class="btn btn-primary me-5" name="add_product" value="Add Product">
                            <a class="btn btn-danger" href="inventory.php">Cancel</a>
                        </div>

                    </form>

                </div>

            </div>

        </main>
    </div>
</div>

<!-- Script to add new row -->
<script>
    function addRow() {
        var form = document.getElementById("dynamicForm");
        var row = form.firstElementChild.cloneNode(true);
        form.appendChild(row);
    }
</script>