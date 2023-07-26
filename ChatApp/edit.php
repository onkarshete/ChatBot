<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <?php 
        $user_id = mysqli_real_escape_string($conn, $_SESSION['unique_id']);
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }
  ?>
  <div class="wrapper">
    <section class="form edit" style="padding-top: 10px;">
      <header style="border-bottom: 1px solid #e6e6e6; display: flex; align-items: center; padding-bottom: 0px; margin-top:0px;">
    <a href="users.php" style="color: #333; font-size: 18px; float: left;"><i class="fas fa-arrow-left"></i></a>
          <span style="margin: 20px; font-size: 18px; font-weight: 500;">Edit Profile</span>
      </header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" value="<?php echo $row['fname'] ?>" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" value="<?php echo $row['lname'] ?>" required>
          </div>
        </div>
        <div class="field input">
          <label>About</label>
          <select name="about" class="select">
            <option value="Busy" class="item-content">Busy</option>
            <option value="Available">Available</option>
            <option value="Not Working">Not Working</option>
          </select>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" value="<?php echo $_SESSION['pass'] ?>" placeholder="Enter new password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg">
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Update Profile">
        </div>
      </form>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/edit.js"></script>

</body>
</html>
