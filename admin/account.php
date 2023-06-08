<?php include('header.php'); ?>

<?php

if(!isset($_SESSION['logged_in'])){
    
    header('location: ../login.php');
    exit;

}else if($_SESSION['user_type'] == 'employee'){

    http_response_code(404);
    include('my_404.php'); // provide your own HTML for the error page
    die();

}else if($_SESSION['user_type'] == 'user'){

    http_response_code(404);
    include('my_404.php'); // provide your own HTML for the error page
    die();

}else{

}

?>

<?php

    //1. determine page no.
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        //if user has already entered page then page number is the one that they selected
        $page_no = $_GET['page_no'];
    }else{
        //if user just entered the page then default page is 1
        $page_no = 1;
    }

    //2. return number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM users WHERE user_type IN ('admin','employee')");
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    //3. products per page
    $total_records_per_page = 5;
    $offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";
    $total_no_of_pages = ceil($total_records/$total_records_per_page);

    //4. get all products
    $stmt2 = $conn->prepare("SELECT * FROM users WHERE user_type IN ('admin','employee') ORDER BY user_id DESC LIMIT $offset, $total_records_per_page");
    $stmt2->execute();
    $users = $stmt2->get_result();//array

?>
<?php include('sidemenu.php'); ?>

<div class="main-content">
    <div class="container-fluid">
    <i class="fas fa-chevron-circle-left" style="font-size: 50px; color: #f9881c; cursor: pointer;" onclick="goBack()" onmouseover="this.style.backgroundColor='#d6d6d7'" onmouseout="this.style.backgroundColor='transparent'"></i>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>

            <h1 class="my-4">Account Management</h1>
            <a class="btn btn-success btn mb-4" style="float:right;" href="create_user.php"><i class="fas fa-plus-circle"></i> Create Account</a>

                <?php if(isset($_GET['error'])){ ?>
                    <p class="text-center" style="color: red;"><?php echo $_GET['error']; ?></p> 
                <?php }?>

                <?php if(isset($_GET['user_updated'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['user_updated']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['user_update_failed'])){ ?>
                    <p class="text-center" style="color: red;"><?php echo $_GET['user_update_failed']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['delete_success_message'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['delete_success_message']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['delete_failure_message'])){ ?>
                    <p class="text-center" style="color: red;"><?php echo $_GET['delete_failure_message']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['user_created'])){ ?>
                    <p class="text-center" style="color: green;"><?php echo $_GET['user_created']; ?></p>   
                <?php }?>

                <?php if(isset($_GET['user_failed'])){ ?>
                    <p class="text-center" style="color: red;"><?php echo $_GET['user_failed']; ?></p>   
                <?php }?>
            
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover table-sm text-center">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php while($row = $users->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['user_name']; ?></td>
                            <td><?php echo $row['user_email']; ?></td>
                            <td><?php echo $row['user_type']; ?></td>
                            <td><a class="btn btn-primary btn-sm" href="edit_user.php?user_id=<?php echo $row['user_id']; ?>">Change <i class="fas fa-key"></i></a></td>
                            <td><a class="btn btn-danger btn-sm" href="delete_user.php?user_id=<?php echo $row['user_id']; ?>"><i class="fas fa-trash"></i></a></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                    <nav aria-label="Page navigation example" class="text-center">
                    <ul class="pagination mt-5 justify-content-center">
                        <li class="page-item">
                            <a class="page-link <?= ($page_no <= 1) ? 'disabled' : ''; ?> " <?= ($page_no > 1) ? 'href=?page_no=' .$previous_page : ''; ?>>Previous</a>
                        </li>


                        <li class="page-item"><a href="?page_no=1" class="page-link">1</a></li>
                        <li class="page-item"><a href="?page_no=2" class="page-link">2</a></li>

                            <?php if($page_no >= 3) { ?>
                                <li class="page-item"><a href="#" class="page-link">...</a></li>
                                <li class="page-item"><a href="?page_no=<?= $page_no; ?>" class="page-link"><?= $page_no; ?></a></li>
                            <?php } ?>

                        <li class="page-item">
                            <a class="page-link <?= ($page_no >= $total_no_of_pages) ? 'disabled' : ''; ?> " <?= ($page_no < $total_no_of_pages) ? 'href=?page_no=' .$next_page : ''; ?>>Next</a>
                        </li>

                    </ul>
                </nav>

                <div class="p-10">
                    <strong>Page <?= $page_no; ?> of <?= $total_no_of_pages ?></strong>
                </div>

            </div>
    </div>
</div> 