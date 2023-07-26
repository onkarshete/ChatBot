<?php 
include_once "header.php"; 
$token = $_GET['token'];
?>
<style type="text/css">
  p{
    text-align: center;
  }
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
    <section class="form login">
      <input class="token" value="<?php echo $token;?>" hidden>
      <form action="#">
        <div class="error-text"></div>
        <div class="redirect-text"></div>
      </form>
    </section>
  </div>
  
  <script src="javascript/verify.js"></script>

</body>
</html>
