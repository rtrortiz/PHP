<?php
/*Using Abstract PDO Stmts*/
//--Connect to Database-------------------------------------------------------------------------------------------------------------------------
function db_connect(){

       $servername = "localhost";
       $dbusername   = "root";
       $dbpassword   = "";
       $dbname     = "userDB";
       $dbh = new PDO( "mysql:host=$servername;dbname=$dbname;", $dbusername, $dbpassword );
       return $dbh;

}
//--Login User----------------------------------------------------------------------------------------------------------------------------------
function loginUser($userName, $pass){

     if(!empty($userName && $pass)){

       $username = $userName; 
       $password = $pass;

try {
     $conn = db_connect();
    //--Retrieve user id from DB and use it to create a Session
    $sth2 = $conn->prepare( "SELECT * FROM users WHERE username = :username AND password = :password" );
    $sth2->bindParam( ':username', $username );
    $sth2->bindParam( ':password', $password );
    $sth2->execute();
    $row = $sth2->fetch(PDO::FETCH_ASSOC);
if(! empty($row)){

    $_SESSION["UserID"] = $row['id'];
    header("Location: http://localhost/LoginReg2/membersPage.php");

}//end of if stmt

}
catch( PDOException $e ) {
    die( 'Failed: ' . $e->getMessage() );
}
		
}//end of if stmt

if (empty($userName)){

                $errors[] = 'No username provided.';
		return $errors;
}

if (empty($pass)){

                $errors[] = 'No password provided.';
		return $errors;

}
   
}

//--Register User-------------------------------------------------------------------------------------------------------------------------------
function registerUser($userName, $pass){

    if(!empty($userName && $pass)){
       $username = $userName; 
       $password = $pass;
try {
    //--Insert data into DB
    $conn = db_connect();
    $sth = $conn->prepare( "INSERT INTO users ( username, password ) VALUES ( :username, :password )" );
    $sth->bindParam( ':username', $username );
    $sth->bindParam( ':password', $password );
    $sth->execute();
    //--Retrieve user id from DB and use it to create a Session
    $sth2 = $conn->prepare( "SELECT * FROM users WHERE username = :username AND password = :password" );
    $sth2->bindParam( ':username', $username );
    $sth2->bindParam( ':password', $password );
    $sth2->execute();
    $row = $sth2->fetch(PDO::FETCH_ASSOC);

if(! empty($row)){
    $_SESSION["UserID"] = $row['id'];
    header("Location: http://localhost/LoginReg2/profileSetup.php");
}//end of if stmt

else {
		//printf('one or more fields are incorrect. Correct the fields below as marked');
		$errors[] = 'one or more fields are incorrect. Correct the fields below as marked';
		return $errors;
	}//end of else stmt    
}
catch( PDOException $e ) {
    die( 'Failed: ' . $e->getMessage() );
}

}//end of if stmt

if (empty($userName)){

                $errors[] = 'No username provided.';
		return $errors;


}

if (empty($pass)){

                $errors[] = 'No password provided.';
		return $errors;

}

}//end of registerUser function
//--Insert user profile data into Database------------------------------------------------------------------------------------------------------
function insertUserProfileData($id, $firstName, $lastName, $email, $userBio){

    if(!empty($id && $firstName && $lastName && $email && $userBio)){

	$fstName = $firstName;
	$lstName = $lastName;
	$userBio = $userBio;
	$userId = $id;

	if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'That is not a valid email address';
	}else{
		$email = $email;
	}

try {
    $conn = db_connect();
    //--Insert data into DB
    $sth = $conn->prepare("INSERT INTO userProfile ( id, bio, email, firstName, lastName ) VALUES ( :id, :bio, :email, :firstName, :lastName )");
    $sth->bindParam( ':id', $userId);
    $sth->bindParam( ':bio', $userBio);
    $sth->bindParam( ':email', $email);
    $sth->bindParam( ':firstName', $fstName);
    $sth->bindParam( ':lastName', $lstName);
    $sth->execute();
    header("Location: http://localhost/LoginReg2/membersPage.php");
    
}
catch( PDOException $e ) {
    die( 'Failed: ' . $e->getMessage() );
}

}//end of if stmt

}//end of function
//--Display user profile data by retrieving the data from the DB--------------------------------------------------------------------------------
function displayUserProfileData ($id){

	$userId = $id;

try {
    $conn = db_connect();
    $sth2 = $conn->prepare( "SELECT * FROM userProfile WHERE id = :id" );
    $sth2->bindParam( ':id', $userId );
    $sth2->execute();
    $row = $sth2->fetch(PDO::FETCH_ASSOC);

    return $row;
}
catch( PDOException $e ) {
    die( 'Failed: ' . $e->getMessage() );
}

}
//--Update user profile data--------------------------------------------------------------------------------------------------------------------
function updateUserProfileData ($id, $firstName, $lastName, $email, $userBio){

if(!empty($id && $firstName && $lastName && $email && $userBio)){

	$fstName = $firstName;
	$lstName = $lastName;
	$userBio = $userBio;
	$userId = $id;

	if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors[] = 'That is not a valid email address';
	}else{
		$email = $email;
	}

try {
    $conn = db_connect();
    //--Insert data into DB
    $sth = $conn->prepare("UPDATE userProfile SET bio = :bio, email = :email, firstName = :firstName, lastName = :lastName WHERE id = :id");
    $sth->bindParam( ':id', $userId);
    $sth->bindParam( ':bio', $userBio);
    $sth->bindParam( ':email', $email);
    $sth->bindParam( ':firstName', $fstName);
    $sth->bindParam( ':lastName', $lstName);
    $sth->execute();
    header("Location: http://localhost/LoginReg2/membersPage.php");
}
catch( PDOException $e ) {
    die( 'Failed: ' . $e->getMessage() );
}

}//end of if stmt

}//end of function

?>
