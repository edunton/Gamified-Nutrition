<?php
include('login.php'); // Includes Login Script
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="login.css">

<title>Login page</title>
</head>
<body>
<div class="wrapper">

    <form class="form-signin">       
      <h2 class="form-signin-heading">Plz login!</h2>
      
     	<div class="form-group">
      <label for="username" class="control-label">Username</label>
      <input type="text" class="form-control" name="username" id="username" placeholder="Email Address" required="" autofocus="" />
      <span class="help-block"></span>
      </div>
      
      <div class="form-group">
      <label for="password" class="control-label">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Password" required=""/>
      <span class="help-block"></span>
      </div>
      
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>  
      <span class="help-block"></span>
      <p><a href="signuppage.html" class="btn btn-info btn-block">Register now!</a></p>
       
    </form>
  </div>
  
<span><?php echo $error; ?></span>

</form>
</div>
</div>
</body>
</html>
