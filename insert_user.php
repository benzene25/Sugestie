<?php
include("includes/connection.php");

    if(isset($_POST['sign_up'])){
		
		$name = mysqli_real_escape_string($con,$_POST['u_name']) ;
		$pass = mysqli_real_escape_string($con,$_POST['u_pass']);
	    $email =mysqli_real_escape_string ($con,$_POST['u_email']);
		$branch =mysqli_real_escape_string($con, $_POST['u_branch']);
		$status = mysqli_real_escape_string($con,$_POST['u_status']);
		$birthday = mysqli_real_escape_string($con,$_POST['u_birthday']);
		$status = "unverified";
		$posts = "no";
		$ver_code = mt_rand();
		if(strlen($pass)<8)
		{
			echo "<script>alert('Password should be minimum 8 characters!')</script>";
			exit(); 
			
		}
		$check_email="select * from users where user_email='$email'";
		$run_email = mysqli_query($con,$check_email);
		
		$check = mysqli_num_rows($run_email);
		
		if($check==1){
		 echo "<script>alert('Email already exist,please try another!')</script>";
		 exit();
		 
		}
		
		$insert = "insert into users (user_name,user_pass,user_email,user_branch,user_status,user_birthday,user_image,user_reg_date,status,ver_code,posts) values ('$name','$pass','$email','$branch','$status','$birthday','default.jpg',NOW(),'$status','$ver_code','$posts')";
		
		$query = mysqli_query($con,$insert);
		if($query){
			echo "<h3 style='width:400px; text-align:justify;'>Hi, $name congratulations, registration is almost complete please check your email for final verification.</h3>";
		} 
			
			else{
				
				echo "Registration failed, try again!";
				
				
			}
			 
			
			
			
		
		
	}


?>