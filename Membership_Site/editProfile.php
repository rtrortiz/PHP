<!--Include PHP file header and navigation partials-->
<?php include 'partials/header.php'; ?>
<?php 
    if(isset($_SESSION["UserID"])){

       include 'partials/MemberNavigation.php';
       $user_id = $_SESSION["UserID"];

     }
?>
<?php 
if(!empty($_POST)){

       $firstName = $_POST['firstName']; 
       $lastName = $_POST['lastName'];
       $email = $_POST['email'];
       $userBio = $_POST['userBio'];
       $userId = $user_id;
       $errors = updateUserProfileData($userId, $firstName, $lastName, $email, $userBio);
       

}//end of if stmt
?>
<!--end of PHP code-->
<!--Page Content for Login-->
<div class="container">
  <h2>Edit your profile</h2>
<p><?php echo $user_id ?></p>
<?php if ( ! empty( $errors ) ) : ?>
     <div class="errors">
       <p class="bg-danger"><?php echo implode( '</p><p class="bg-danger">', $errors ); ?></p>
     </div><?php endif; ?>
<p><?php //echo $user_id ?></p>
<form method="post" action="editProfile.php" enctype="multipart/form-data">
  <div class="form-group">
    <label for="firstName">First name</label>
    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" 
     value="<?php echo $_SESSION['firstName'];?>">
  </div>
  <div class="form-group">
    <label for="lastName">Last name</label>
    <input type="text" class="form-control"  id="lastName" name="lastName" placeholder="" 
    value="<?php echo $_SESSION['lastName'];?>">
  </div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control"  id="email" name="email" placeholder="" 
    value="<?php echo $_SESSION['email'];?>">
  </div>
<div class="form-group">
    <label for="userBio">Enter Your bio</label>
    <textarea class="form-control" rows="3" id="userBio" name="userBio"
    value=""><?php echo $_SESSION['bio'];?></textarea>
  </div>
  <button type="submit" class="btn btn-success">Submit</button>
</form>
</div><!--end container -->
<!--end of Page content-->		    
<!--Include PHP file footer partial-->
    <?php include 'partials/footer.php'; ?>
<!--end-->
   
