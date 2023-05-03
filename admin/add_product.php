<?php include('header.php'); ?>

<div class="container-fluid">
    <div class="row" style="min-height:1000px">

        <?php include('sidemenu.php'); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 mt-2">
                <h1 class="primary">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2"></div>
                </div>
            </div>

            <h2 class="form-weight-bold mt-3 my-3">Edit Products</h2>
            <div class="table-responsive">

                <div class="mx-auto container">

                    <form id="create-form" enctype="multipart/form-data" method="POST" action="create_product.php">
                        <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; } ?></p>

                        <div class="form-group mt-2">
                            <label><strong>Product Name</strong></label>
                            <input type="text" class="form-control" id="product-name" name="name" placeholder="Product Name" required>
                        </div>
                        
                        <div class="form-group mt-2">
                            <label><strong>Price</strong></label>
                            <input type="text" class="form-control" id="product-price" min="1" max="500000" name="price" placeholder="Price" required>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Product Discount</strong></label>
                            <input type="number" class="form-control" id="product-disc" name="discount" min="1" max="100" placeholder="Discount" required>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Color</strong></label>
                            <input type="text" class="form-control" id="product-color" name="color" placeholder="Color" required>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Description</strong></label>
                            <input type="text" class="form-control" id="product-desc" name="description" placeholder="Description" required>
                        </div>

                        <div class="form-group mt-2">
                            <label><strong>Category</strong></label>
                            <select class="form-select" required name="category">

                                <option value="Bike">Bike</option>
                                <option value="parts">Parts & Accessories</option>

                            </select>
                        </div>

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
                        
                        <div class="form-group my-5">
                            <input type="submit" class="btn btn-primary me-5" name="add_product" value="Add Product">
                            <input type="submit" class="btn btn-danger" name="cancel_btn" value="Cancel">
                        </div>

                    </form>

                </div>

            </div>

        </main>
    </div>
</div>

