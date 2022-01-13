<?php

session_start();  //dhmiourgoume to session epeidh tha apothikeusoume ta dedomena login twn users ston server

require 'config\db.php';  // to kanoume require epeidh tha sundethoume sthn dbusers etsi wste na tsekarei an 2 atoma exoun idio email@ epeidh prepei na einai unique.
require_once 'config\controllers\emailController.php';


$errors = array(); //dhlwsh ths global metavlhths errors did pinakas pou tha krataei ta errors gia to validation ths formas.
$username = "";
$password = "";
$firstname  = "";
$lastname   = "";


//an o user kanei click sto signup button lamvanoume ta values pou evale sto form kai ta vazoume sta values $username, $email,$password,$passwordConf
if(isset($_POST['signup-btn'])) {   //kanei click sto sign up button
  $username = $_POST['username'];     //h timh pou evale sto username ginetai set sthn metavlhth $username
  $email = $_POST['email'];       //h timh pou evale sto username ginetai set sthn metavlhth $email
  $password = $_POST['password'];     //h timh pou evale sto username ginetai set sthn metavlhth $password
  $passwordConf = $_POST['passwordConf'];
  $firstname  = $_POST['firstname'];
  $lastname   = $_POST['lastname'];
  $role       = $_POST['role'];


  if (empty($firstname)) {
    $errors['firstname'] = "Firstname required";
}

if (empty($lastname)) {
    $errors['lastname'] = "Lastname required";
}

if(empty($username)) {
  $errors['username'] = "Username required";  // an to uname einai empty tote error oti einai required.
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {   // sunarthsh !filter_var pou testarei an to email exei thn morfh email diaforetika petaei error.
  $errors['email'] = "Email adress is invalid";
}

if(empty($email)) {
  $errors['email'] = "Email required";   //an to email einai empty tote error  oti einai required
}

if(empty($password)) {
  $errors['password'] = "Password required";   // an to pass einai empty tote error oti einai required.
}

if($password !== $passwordConf){
  $errors['password'] = "the two passwords do not match";   // tsekarei an ta 2 passwords kanoun match kai an oxi vgazei error.
}

if (empty($role)) {
  $errors['role'] = "Role required";
}

$emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";   // tsekaroume to users table kai an vroume estw 1 email idio me auto tou user stamataei na psaxnei sthn vash.
$stmt = $conn->prepare($emailQuery);  // etoimazoume to prepared statement.
$stmt->bind_param('s',$email);  // kanoume bind tis parametrous sto sqlQuery dhl to erwthmatiko tou email me to s pou einai tupos string. 
$stmt->execute();        //kanoume execute to statement
$result = $stmt->get_result();    //pairnoume to result tou an uparxei user me to idio email.
$userCount = $result->num_rows; //anathetei sth metavlhth userCount tis grammes me ta idia email pou phre apo ton server
$stmt->close();  

if($userCount > 0){
  $errors['email'] = "Email already exists";  // an uparxei xrhsths me auto to email petaei error oti to email hdh xrhsimopoieitai
}

if(count($errors) === 0){             // an den uparxei errors sto $errors array[]
  $password = password_hash($password,PASSWORD_DEFAULT);     // tote kane encrypt to password sto database me thn function ,function_hash
  $token = bin2hex(random_bytes(50));  // pairnei to token kai to metatrepei se dekae3adiko gia to email verification. 
  $verified = false; // o xrhsths na mhn einai arxika verified . Gia na ginei verified sth sunexeia  xrhsimopoioume to token.

  $sql = "INSERT INTO users (firstname, lastname, username, email, verified, token, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";   // dhmiourgoume to sql query
  $stmt = $conn->prepare($sql); 
$stmt->bind_param('ssssbsss', $firstname, $lastname, $username, $email, $verified, $token, $password, $role); // anathetoume to type stis metavlhtes . px ssbss= string string boolean string string.


if($stmt->execute()){  // an ektelestei successfully
//login user
$user_id = $conn->insert_id; //sto $conn object pairnoume to last id pou egine entered.
$_SESSION['id'] = $user_id;   // twra vazoume to id pou phrame se ena session
$_SESSION['firstname']  = $firstname;
$_SESSION['lastname']   = $lastname;
$_SESSION['username'] = $username; // to idio kai gia email username kai verified
$_SESSION['email'] = $email;
$_SESSION['verified'] = $verified;
$_SESSION['role']       = $role;


sendVerificationEmail($email, $token);

//set flash message
$_SESSION['message'] = "you are now logged in!";  //kanei inform ton user oti einai logged in!  
$_SESSION['alert-class'] = "alert-success";  // vgazei message oti to login htan sucessful
header('location: index.php'); //kanoume redirect sto index.php dhladh sto homepage
exit();

  } else {
    $errors['db_error'] = "Database error: failed to register"; // diaforetika dberror , den egine h eggrafh.
      }

    }

}
  
  
  // an o user kanei click sto login button tote ==>

if(isset($_POST['login-btn'])) {   // an kanei click sto login up button
  $username = $_POST['username'];     //h timh pou evale sto username ginetai set sthn metavlhth $username
  $password = $_POST['password'];     //h timh pou evale sto username ginetai set sthn metavlhth $password


  //validation tou xrhsth
if(empty($username)) {
  $errors['username'] = "Username required";  // an to uname einai empty tote error oti einai required.
}

if(empty($password)) {
  $errors['password'] = "Password required";   // an to pass einai empty tote error oti einai required.
    }

  
if(count($errors) === 0){
    //dhmiourgoume to query gia to login
    $sql= "SELECT * FROM users WHERE  email=? OR username=? LIMIT 1"; // vazoume ?? epeidh tha kanoume prepared statement gia binding twn timwn se metavlhtes
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $username); // username 2fores epeidh sto login form input type name=username gia username h email.
    $stmt->execute(); //execute tou statement.
    $result = $stmt->get_result(); // pairnei to result to sql query 
    $user = $result->fetch_assoc();  // epistrefei enan xrhsth me to fetch_assoc o opoios evale swsta ta stoixeia tou kai ekane login sto susthma
    // o user pou tha epistrepsei h vash tha exei ola ta fields tou database. opws kai to encrypted password tou.
  

  
if(password_verify($password, $user['password'])) { // an to password pou evale o user einai idio me to password tou user sthn vash dedomenwn 

//login user
$_SESSION['id'] = $user['id'];    // epomenws vazoume ta values tou user pou ginetai login se ena session . opws fenetai gia kathe ena apo ta values parakatw.
$_SESSION['firstname']  = $user['firstname'];
$_SESSION['lastname']   = $user['lastname'];
$_SESSION['username'] = $user['username']; 
$_SESSION['email'] = $user['email'];
$_SESSION['verified'] = $user['verified'];
$_SESSION['role']       = $user['role'];
//set flash message
$_SESSION['message'] = "you are now logged in!";  //kanei inform ton user oti einai logged in!  
$_SESSION['alert-class'] = "alert-success";  // vgazei message oti to login htan sucessful
header('location: index.php'); //kanoume redirect sto index.php dhladh sto homepage
exit();

    } else{
      $errors['login-fail'] = "Wrong credentials";
    }
  
  }
}

//an o user kanei logout :
if(isset($_GET['logout'])) {         // an uparxei metavlhth logout sthn superglobal get tote:
  session_destroy();   //katastrefei to session p dhmiourghsame sthn arxh , ara tha kanoume unsset oles tis metavlhtes apo to session giati kanoume logout
  unset($_SESSION['id']);
  unset($_SESSION['firstname']);
  unset($_SESSION['lastname']);
  unset($_SESSION['username']);
  unset($_SESSION['email']);    //dhl; edw kanoume unset oles tis metavlhtes p kaname set otan kaname login 
  unset($_SESSION['verify']);
  unset($_SESSION['role']);
  header('location: login.php');  //epistrefei sthn login page
  exit();

}


//function gia verification tou user me to token. 
function verifyUser($token) {
  global $conn;  // kanoume to conn global wste na to anagnwrizei h sunarthsh
  $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";  // an uparxei estw 1 user sto db me auto to token 
  $result = mysqli_query($conn, $sql);  // apothikeuei sto result to apotelesma tou sql query

  if(mysqli_num_rows($result) > 0){
    $user = mysqli_fetch_Assoc($result);
    $update_query = "UPDATE users SET verified=1 WHERE token='$token' ";

    if(mysqli_query($conn, $update_query)) {  // an to query ektelestei epituxws tote -->
      $_SESSION['id'] = $user['id'];    // epomenws vazoume ta values tou user pou ginetai login se ena session . opws fenetai gia kathe ena apo ta values parakatw.
      $_SESSION['firstname']  = $user['firstname'];
      $_SESSION['lastname']   = $user['lastname'];
      $_SESSION['username'] = $user['username']; 
      $_SESSION['email'] = $user['email'];
      $_SESSION['verified'] = 1;

//set flash message
      $_SESSION['message'] = "your email adress has been verified!";  //kanei inform ton user oti einai logged in!  
      $_SESSION['alert-class'] = "alert-success";  // vgazei message oti to login htan sucessful
    header('location: index.php'); //kanoume redirect sto index.php dhladh sto homepage
  exit();
    }

  }else{
    echo "User not found";
  }

}
  



