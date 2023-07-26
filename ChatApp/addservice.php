<?php 
  session_start();
  if($_SESSION['admin'] != 1){
    header("location: login.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header style="border-bottom: 1px solid #e6e6e6; display: flex; align-items: center; padding-bottom: 0px; margin-top:0px;">
    <a href="dashboard.php" style="color: #333; font-size: 18px; float: left;"><i class="fas fa-arrow-left"></i></a>
          <span style="margin: 20px; font-size: 18px; font-weight: 500;">Service</span>
      </header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>Service First Name</label>
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
            <label>Service Last Name</label>
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter new password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
         <div style="align-items: center; margin-top:20px;" class="field">
          <div class="g-recaptcha" data-sitekey="6LfLTCobAAAAAB1nFx6Y1qPKxdObfMOWPMn22ApE"></div>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Add Service">
        </div>
      </form>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/addservice.js"></script>

</body>
</html>
