<!--Include PHP file header and navigation partials-->
<?php include 'partials/header.php'; ?>
<?php 

    if(isset($_SESSION["UserID"])){

       include 'partials/MemberNavigation.php';
       $user_id = $_SESSION["UserID"];
       $userData = displayUserProfileData($user_id);

     }//end of if stmt
	$_SESSION["firstName"] = $userData['firstName'];
	$_SESSION["lastName"] = $userData['lastName'];
	$_SESSION["email"] = $userData['email'];
	$_SESSION["bio"] = $userData['bio'];
?>
<?php //$userData = displayUserProfileData($user_id)?>
<!--end of PHP code-->


<!--Page Content for Login-->

<div class="container">
  <h2>Main Member page</h2>
  <p>first name: <?php echo $userData['firstName'];?></p>
  <p>last name: <?php echo $userData['lastName'];?></p>
  <p>email: <?php echo $userData['email'];?></p>
  <p>My Bio: <?php echo $userData['bio'];?></p>

<a href="editProfile.php">Edit</a>
</div><!--end container -->


<!--end of Page content-->

		    

<!--Include PHP file footer partial-->
    <?php include 'partials/footer.php'; ?>
<!--end-->
   
