<?php require_once 'config\controllers\authController.php'; ?>

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
      <li class="nav-item">
        <a class="nav-link" href="postpage.php"><span class="text-dark"><h6>Home</h6></span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="login.php"><h6>Sign in</h6><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signup.php"><span class="text-dark"><h6>Sign up</h6></span></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-dark my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
</header>

  <div class="container">  <!-- gia dhmiourgia bootstrap grid-->
    <div class="row"> <!-- dhmiourgia 1 row me medium sized columns (4) . Max size = 12-->
      <div class="col-md-4 offset-md-4 form-div login"> <!-- 4 medium size columns , offset=4 gia na einai centered-->
        <form action="login.php" method="post"> <!-- ta form values tha ginoun submited sto login.php me thn methodo post -->
          <h3 class="text-center" id="loginid"> Login </h3>

          <?php if(count($errors) > 0): ?>     <!--an uparxoun errors ston pinaka  $errors -->
          <div class= "alert alert-danger">   <!--otan uparxoun errors ( > 0) tote  -->
            <?php foreach($errors as $error): ?> <!-- gia kathe error  emfanise to error sto opoio antistoixei -->
            <li><?php echo $error; ?></li>    
            <?php endforeach; ?>    
          </div> 
          <?php endif; ?>       

          <div class="form-group">  <!-- bootstrap class form-group-->
          <label for="username">Username or Email</label>
          <input type="text" name="username" value="<?php echo $username; ?>" class="form-control form-control-lg" required>  <!-- form-control=boostrap class -->
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password"  class="form-control form-control-lg" required>  <!-- form-control=boostrap class -->
        </div>

    
        <div class="form-group">
         <button type="submit" name="login-btn" class="btn btn-primary btn-block btn-lg">Login</button>  <!-- btn-block = gia block button pou kaluptei olo to size //btn-lg = gia large button apo bootstrap.-->
        </div>

        <p class="text-center">Not yet a member? <a href="signup.php">Signup</a></p>
      </form>
    </div>   
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
