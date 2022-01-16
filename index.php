<?php
 require_once 'config\controllers\authController.php';  // gia na mn 3anaxreiastei na arxisoume to session, kai na boroume na xrhsimopoihsoume sto index.php ta sessionvariables tou authController  

 //kanoume verify ton user xrhsimopoiontas to token
 if(isset($_GET['token'])) {  // an to token exei ginei set (otan kanoume verify apo email)
   $token = $_GET['token'];  // tote kane grab to token
   verifyUser($token);
 }

if(!isset($_SESSION['id'])) { // an to id den einai set (dhladh an o user den einai logged in)
  header('location: login.php');  // anti gia to index.php phgene mas otan kanei refresh sto login page gia na kanei o user login.
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <!-- boostrap - css-- anti gia dload tou source code sto application kanoume point ston bootstrap code online gia to style tou signup form  -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
      <link rel="stylesheet" href="style.css">
      <meta name="viewport" content="width=device-width,initial-scale=1.0">
   
      <title>Login</title>
</head>
<body>

<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#"><h2><span class="text-warning">TEI</span>-POSTS</h2></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="postpage.php"><h6>Home</h6><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="upload.php"><span class="text-dark"><h6>Post</h6></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link logout" href="index.php?logout=1"><span class="text-dark"><h6>Log out</h6></span></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-dark my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
</header>

  <div class="container">     <!-- gia dhmiourgia bootstrap grid-->
    <div class="row">     <!-- dhmiourgia 1 row me medium sized columns (4) . Max size = 12-->
      <div class="col-md-4 offset-md-4 form-div login">    <!-- 4 medium size columns , offset=4 gia na einai centered-->
       
      <?php if(isset($_SESSION['message'])):?>  <!-- tsekarei an einai set kapoio message kai ektelei ton parakatw kwdika  -->
      <div class="alert <?php echo $_SESSION['alert-class']; ?>">  <!-- emfanizei to alert message -->
        <?php
         echo $_SESSION['message'];  // emfanise to message oti einai logged in! 
        unset($_SESSION['message']);      // to kanoume unset etsi wste na mhn emfanizetai 3ana to message otan kanoume refresh 
        unset($_SESSION['alert-class']);  // kanoume unset to alert class etsi wste na mn emfanizetai 3ana to sucessful login meta to refresh ths selidas
        ?>  
        </div>  
        <?php endif; ?> <!-- telos ths if -->

        <h3>Welcome, <?php echo $_SESSION['username']; ?></h3> <!-- pairnei apo to session to username to xrhsth pou ekane login-->



        <?php if(!$_SESSION['verified']): ?> <!--an o user den einai verified  -->
        <div class="alert alert-warning">   <!-- gia tous users pou kanoun login xwris verification emfanise auto to mhnyma-->
        You need to verify your account.
        Sign in to your email account and click on the 
        verification link to enable your account.
        <strong><?php echo $_SESSION['email']; ?></strong> <!-- stelnei sto email tou xrhsth apo to session tou authController verification link -->
        </div>
        <?php endif; ?> <!-- telos ths if statement -->
        
        <?php if($_SESSION['verified']):?> <!--an o user einai verified  -->
        <form action="postpage.php" class="form-group">
        <button class="btn btn-block btn-lg btn-primary">I am verified </button>   <!-- mono gia tous verified users emfanise to blue "iam verified" button -->
        </form>
        <?php endif; ?>

    </div>
  </div>

  <div class="container container-fixed-bottom">
	<footer class="row row-cols-5 py-5 my-5 border-top">
    <div class="col">
      <p class="text-center text-muted">TEI-POST PAGE, Copyright &copy 2022</p>
    </div>
	</footer>
</div>
</body>
</html>
