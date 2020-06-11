<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>

    <div class="content">
  
    <div class="logo">
      <img id="logo" src="logov5.png" alt="zzzchedule">
    </div>
      <div class="text">Login</div>
      <form action="user_login.php" method="post">
        <div class="field">
          <span class="fas fa-user"></span>
          <input type="text" placeholder="Enter Username" name="username" required>
          <!-- <label>Email or Phone</label> -->
        </div>
        <div class="field">
          <span class="fas fa-lock"></span>
          <input type="password" placeholder="Enter Password" name="password" required>
          <!-- <label>Password</label> -->
        </div>
        <div class="forgot-pass"><a href="#">Forgot Password?</a></div>
        
        <button type="submit" value="submit" name="submit">Login</button>
        <div class="signup">No account?
          <a href="#">signup now</a>
        </div>
      </form>
  </div>
</body>
</html>
<!-- partial -->
  
</body>
</html>
