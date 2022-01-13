<?php require_once 'config\controllers\authController.php';?>  <!--tsekarei an to file einai included kai an dn einai to kanei include-->
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <!-- boostrap - css-- anti gia dload tou source code sto application kanoume point ston bootstrap code online gia to style tou signup form  -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
      <link rel="stylesheet" href="style.css">
      <meta name="viewport" content="width=device-width,initial-scale=1.0">
   
      <title>Register</title>
</head>
<body>

  <div class="container">  <!-- gia dhmiourgia bootstrap grid-->
    <div class="row"> <!-- dhmiourgia 1 row me medium sized columns (4) . Max size = 12-->
      <div class="col-md-4 offset-md-4 form-div"> <!-- 4 medium size columns , offset=4 gia na einai centered-->
        <form action="signup.php" method="post"> <!-- ta form values tha ginoun submited sto signup.php me thn methodo post -->
          <h3 class="text-center" id="registerid"> Register </h3>

          <?php if(count($errors) > 0): ?>     <!--an uparxoun errors ston pinaka  $errors -->
          <div class= "alert alert-danger">   <!--otan uparxei errors ( > 0) tote  -->
            <?php foreach($errors as $error): ?> <!-- gia kathe error  emfanise to error sto opoio antistoixei -->
            <li><?php echo $error; ?></li>    
            <?php endforeach; ?>    
          </div> 
          <?php endif; ?>   
          
          <div class="form-group">
                    <label for="firstname" class="">Firstname</label>
                    <input type="text" name="firstname" value="<?php echo $firstname; ?>" class="form-control form-control-lg">
                </div>                
                <div class="form-group">
                    <label for="lastname" class="">Lastname</label>
                    <input type="text" name="lastname" value="<?php echo $lastname; ?>" class="form-control form-control-lg">
                </div>

          <div class="form-group">  <!-- bootstrap class form-group-->
          <label for="username">Username</label>
          <input type="text" name="username" value="<?php echo $username; ?>" class="form-control form-control-lg">  <!-- form-control=boostrap class -->
        </div>        <!-- to value = " echo $username to vazw dioti exoume dilwsei to $username sto authcontroller ara exei to value ths metavlhths. -->

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control form-control-lg">  <!-- form-control=boostrap class -->
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control form-control-lg">  <!-- form-control=boostrap class -->
        </div>

        <div class="form-group">
          <label for="passwordConf">Confirm Password</label>
          <input type="password" name="passwordConf" class="form-control form-control-lg">  <!-- form-control=boostrap class -->
        </div>

        <div class="form-group">
          <label class="">Please select your role</label>
          <div>
          <label for="Student" class="">Student</label>
          <input type="radio" name="role" id="Student" value="Student">
         </div>
         
          <div>
          <label for="Professor" class="">Professor</label>
          <input type="radio" name="role" id="Professor" value="Professor">
          </div>
         </div>

        <div class="form-group">
         <button type="submit" name="signup-btn" class="btn btn-primary btn-block btn-lg">Signup</button>  <!-- btn-block = gia block button pou kaluptei olo to size //btn-lg = gia large button apo bootstrap.-->
        </div>

        <p class="text-center">Already a member? <a href="login.php">Sign In</a></p>
        </form>
    </div>  
  </div>
</div>
</body>
</html>