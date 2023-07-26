<?php include_once "header.php"; ?>
<style type="text/css">
  a{
      color: #333;
    } 
  a:hover{
      text-decoration: underline; 
    }
    a:visited{
      color: #333;
    }
</style>
<body>
  <div class="wrapper">
    <section class="form reset" style="padding-top: 10px;">
      <header style="border-bottom: 1px solid #e6e6e6; display: flex; align-items: center; padding-bottom: 0px; margin-top:0px;">
    <a href="login.php" style="color: #333; font-size: 18px; float: left;"><i class="fas fa-arrow-left"></i></a>
          <span style="margin: 20px; font-size: 18px; font-weight: 500;">Reset Password</span>
      </header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Email</label>
          <input type="email" name="email" placeholder="Enter Email Address" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Reset Password">
        </div>
      </form>
      <div class="redirect-text"></div>
    </section>
  </div>

  <script src="javascript/resetpassword.js"></script>

</body>
</html>
