
<?php
    require_once 'config\controllers\authController.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <!-- boostrap - css-- anti gia dload tou source code sto application kanoume point ston bootstrap code online gia to style tou signup form  -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
      <link rel="stylesheet" href="style.css">
      <meta name="viewport" content="width=device-width,initial-scale=1.0">
   
      <title>Blog using PHP & MySQL</title>
</head>

<body>

<header>
<?php if(!isset($_SESSION['id'])):?> <!--an o user einai verified  -->
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
        <a class="nav-link" href="login.php"><span class="text-dark"><h6>Sign in</h6></span></a>
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
<?php elseif(isset($_SESSION['id'])):?>
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
<?php endif; ?>    
</header>
      <!-- create.php -->
    <div class="container mt-5">
        <form  method="GET">
            <input type="text" name="title" placeholder="Blog Title"  class= "form-control bg-dark text-white my-3 text-center">  <!-- titlos tou post -->
            <textarea name="content" class="form-control bg-dark text-white my-3"></textarea>
            <button name="new_post" class="btn btn-dark">Add post</button>
        </form>
    </div>
        

<div class="container container-fixed-bottom">
	<footer class="row row-cols-5 py-5 my-5 border-top">
    <div class="col">
      <p class="text-center text-muted">TEI-POST PAGE, Copyright &copy 2022</p>
    </div>
	</footer>
</div>






  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>