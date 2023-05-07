<?php include('header.php'); ?>
<style>
		textarea {
			margin-left: 50px;
            height: 5em;
		}
        .button {
            display: inline-block;
            background-color: #f9881c;
            border: 2px solid #f9881c;
            border-radius: 12px;
            padding: 10px 20px;
            margin-right: 10px;
            font-size: 20px;
            font-weight: bold;
            color: #000;
            text-decoration: none;
            text-align: center;
            box-shadow: 2px 2px 2px #888888;
        }
        .outermode {
            width: 1000px;
        }

        .innermode {
            margin-left: 50px;
        }
        select {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 8px 12px;
            font-size: 16px;
            color: #555;
            background-color: #fff;
            width: 200px;
        }

        select:hover {
            background-color: #f2f2f2;
        }
        input[type=text], input[type=tel], input[type=url], textarea {
			padding: 12px 20px;
			margin: 8px 0;
			box-sizing: border-box;
			border: none;
			border-bottom: 2px solid grey;
			border-radius: 4px;
			transition: border-color 0.3s ease-in-out;
			width: 30%; /* set width to 50% for all input fields */
		}

		input[type=text]:hover, input[type=tel]:hover, input[type=url]:hover, textarea:hover {
			border-color: blue;
		}
		/* set width to 50% for the textarea field */
		textarea {
			width: 50%;
		}
</style>
<?php
    if(!isset($_SESSION['admin_logged_in'])){
        header('location: login.php');
        exit;
    }
?>

<div class="container-fluid">
    <div class="row" style="min-height:1000px">

        <?php include('sidemenu.php'); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 mt-2">
                <h1 class="primary">Orders</h1>
            </div>
            <h3 class="tertiary">Order Type </h3>
            <h4> RETAIL | <a href="ordersbackup.php" id="logout-btn">Switch to WHOLESALE</a></h4>
            <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 70%;">
            <form method="post" action="submit.php">
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name" required><br>

                <label for="phone">Contact Number:</label><br>
                <input type="tel" id="phone" name="phone" required><br>

                <label for="address">Address:</label><br>
                <textarea id="address" name="address" required></textarea><br>

                <label for="landmark">Nearest Landmark:</label><br>
                <input type="text" id="landmark" name="landmark"><br>

                <label for="location">Location Link:</label><br>
                <input type="url" id="location" name="location"><br>
            </form>
            <hr style="height: 3px; border: none; color: #000; background-color: #000; width: 70%;">
            <br>
            <table id="myTable" style="width: 70%; border-collapse: collapse; text-align: center;">
                <tr>
                    <th style="padding: 10px;">Item Name:</th>
                    <th style="padding: 10px;">Price:</th>
                    <th style="padding: 10px;">Color:</th>
                    <th style="padding: 10px;">Size:</th>
                    <th style="padding: 10px;">Quantity:</th>
                </tr>
                <tr>
                    <td style="padding: 10px;">
                    <select name="option1">
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select>
                    </td>
                    <td style="padding: 10px;"><input type="text" name="row1col2"></td>
                    <td style="padding: 10px;"><input type="text" name="row1col3"></td>
                    <td style="padding: 10px;"><input type="text" name="row1col4"></td>
                    <td style="padding: 10px;"><input type="text" name="row1col5"></td>
                </tr>
                <tr>
                    <td style="padding: 10px;">
                    <select name="option2">
                        <option value="option1">Option 1</option>
                        <option value="option2">Option 2</option>
                        <option value="option3">Option 3</option>
                    </select>
                    </td>
                    <td style="padding: 10px;"><input type="text" name="row2col2"></td>
                    <td style="padding: 10px;"><input type="text" name="row2col3"></td>
                    <td style="padding: 10px;"><input type="text" name="row2col4"></td>
                    <td style="padding: 10px;"><input type="text" name="row2col5"></td>
                </tr>
            </table>
            
        <br><h3 class="tertiary">Payment and Shipment</h3>
        <div class="outermode"> 
            <div class="innermode" style="font-size:1.5em; color:black">Mode of Delivery</div>
                <div class="dropdown">
                    <select id="del_option" name="option">
                    <option value="delop1">Cash on Delivery</option>
                    <option value="delop2">GCash</option>
                    <option value="delop3">PayMaya</option>
                    <option value="delop4">Bank Transfer</option>
                </div>
		</select></div>
        </div>
        <br><h3 class="tertiary">Remarks:</h3>
                <form method="post">
                    <textarea id="input" name="input" rows="10" cols="50" maxlength="300" placeholder="Enter your remarks here."></textarea><br>
                    <button type="submit" class="button"> Save </button>
                </form>
                

    </div>
</div> 

