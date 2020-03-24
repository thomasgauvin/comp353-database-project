<?php 
    session_start();

    //redirect if the user is already logged in
    if(isset($_SESSION['userID'])){
        header("Location: https://crc353.encs.concordia.ca/home_page.php");
    }

    if(!empty($_POST)){
        if(isset($_POST['email']) && isset($_POST['password'])){
            $email = $_POST['email'];
	        $_SESSION["email"] = $email;
            $password = $_POST['password'];

            require('./db_connect.php');
            $selectUsers="SELECT * from User WHERE Email = '{$email}'";
            if ($result = $con->query($selectUsers)) {
                $user = $result->fetch_object();

                // implement hashing?
                // if(password_verify($password, $user->Password)){
                if($password == $user->Password){
                    $_SESSION['userID'] = $user->UserID;
                    header("Location: https://crc353.encs.concordia.ca/home_page.php");
                }
        
                /*freeresultset*/
                $result->free();
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
	      <h5 class="card-title">Log In</h5> 
		    <form action="" method="POST">
			<br>
            	<input type="text" class="form-control" placeholder="Enter Email" name="email" required>
	    	<br>
               	<input type="password" class="form-control" placeholder="Enter Password" name="password" required>
			<br>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
    		</form>
    		<p>Click here to <a href='./z_create_account.php'>Create Account</a>.</p>
	    </div>
	   </div>
	  </div>
	</body>
</html>
