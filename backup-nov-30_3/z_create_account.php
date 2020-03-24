<?php 
    session_start();

    //redirect if the user is already logged in
    if(isset($_SESSION['userID'])){
        header("Location: https://crc353.encs.concordia.ca/home_page.php");
    }

    if(!empty($_POST)){
        if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['secretCode']) && isset($_POST['fName']) && isset($_POST['lName'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $secretCode = $_POST['secretCode'];
            $fName = $_POST['fName'];
            $lName = $_POST['lName'];
            $secretCodeCorrect = false;
            $redirect = false;

            require('./db_connect.php');

            $checkSecretCode="SELECT * FROM SecretCodes WHERE Email = '{$email}'";
            if ($result = $con->query($checkSecretCode)) {
                $secretCodeResult = $result->fetch_object();
                if($secretCode == $secretCodeResult->Code){
                    $secretCodeCorrect = true;
                }
                /*freeresultset*/
                $result->free();
            }

            if($secretCodeCorrect){
                // implement hashing?
                $createUser="INSERT into User VALUES (NULL, '{$email}', '{$fName}', '{$lName}', 0, 0, '{$password}')";
                if($result = $con->query($createUser)){
                    header("Location: https://crc353.encs.concordia.ca/z_login.php");
                };
            } else {
                print("The secret code is incorrect.");
            }
        }
    }
?>
<html>
    <?php
        require('./html_header.php');
    ?>
    <body>
    <div class="d-flex justify-content-center" style="margin-top:100px">
	   <div class="card" style="width:20rem; text-align:center">
	     <div class="card-body">
	      <h5 class="card-title">Create Account</h5> 
            <form action="" method="POST">
                <div>
                    <input type="text" class="form-control" placeholder="Enter Email" name="email" required>
                    <br />
                    <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
                    <br />
                    <?php
                        if (isset($_GET['secretCode'])) {
                            $secretCode = $_GET['secretCode'];
                            print(
                                "<input type='text' class='form-control' placeholder='Enter Secret Code' name='secretCode' required value='{$secretCode}'><br />");
                        }
                        else{ 
                            print(            
                                "<input type='text' class='form-control' placeholder='Enter Secret Code' name='secretCode' required><br />");
                        }
                    ?>
                    <input type="text" class="form-control" placeholder="Enter First Name" name="fName" required>
                    <br />
                    <input type="text" class="form-control" placeholder="Enter Last Name" name="lName" required>
                    <br />
                    <button type="submit" class="btn btn-primary btn-block">Create Account</button>
                </div>
            </form>
            <p>Click here to <a href='./z_login.php'>Log in</a>.</p>
    </body>
</html>

