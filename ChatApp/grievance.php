<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
  if ($_SESSION['addc'] == 0) {
    header("location: users.php");
  }
  $msg = "";
  if (isset($_SESSION['Msg'])) {
    $msg = $_SESSION['Msg'];
    unset($_SESSION['Msg']);
  }
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<?php include_once "header.php"; ?>
<body>
  <?php 
        $user_id = mysqli_real_escape_string($conn, $_SESSION['unique_id']);
        $sql = mysqli_query($conn, "SELECT * FROM grievances WHERE service_id = {$user_id}");
  ?>

  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Grievance</h5>
            <a class="close" data-dismiss="modal" aria-label="Close" style="color: #333; font-size: 18px; float: left;"><i class="fas fa-times-circle"></i></a>
            </div>
            <form class="text-center border border-light" action="php/griv.php" method="post">
            <div class="modal-body">
                <div class="form-group">
                <label for="title">Grievance No</label>
                <input type="text" class="form-control" id="titleEdit" name="grivEdit" disabled="disabled">
                </div>

                <div class="form-group">
                <label for="desc">Problem</label>
                <textarea class="form-control" id="descriptionEdit" rows="3" disabled="disabled"></textarea>
                </div>
                <div class="form-group">
                <label for="title">Grievance Status</label>
                <input type="text" class="form-control" id="titleSEdit" name="grivSEdit">
                </div> 
            </div>
            <div class="modal-footer d-block mr-auto">
                <button type="submit" name="edit" class="btn btn-sm btn-dark">Update</button>
            </div>
            </form>
        </div>
    </div>
  </div>

  <div class="wrapper" style="max-width: 70%;">
    <section class="form" style="padding-top: 10px;">
      <header style="border-bottom: 1px solid #e6e6e6; display: flex; align-items: center; padding-bottom: 0px; margin-top:0px;">
    <a href="commands.php" style="color: #333; font-size: 18px; float: left;"><i class="fas fa-arrow-left"></i></a>
          <span style="margin: 20px; font-size: 18px; font-weight: 500;">Grievances</span>
      </header>
      <?php
        if(mysqli_num_rows($sql) > 0){
          if ($msg != "") {
              echo '
              <div class="alert alert-info alert-dismissible fade show" role="alert">
              '.$msg.'
              <a class="close" data-dismiss="alert" aria-label="Close" style="color: #333; font-size: 18px; float: right;"><i class="fas fa-times-circle"></i></a>
              </div>';
          }
      ?>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <table class="display table-responsive" id="GrievanceTable">
            <thead>
                <tr>
                <th style="width: 14%">Grievance No</th>
                <th style="width: 60%">Problem</th>
                <th style="width: 12%">Grievance Status</th>
                <th style="width: 6%">Edit</th>
                <th style="width: 8%">Delete</th>
                </tr>
            </thead>
        <tbody>
            <?php
            while($row = mysqli_fetch_assoc($sql)){
                
            ?>
            <tr>
            <td><?php echo $row['id']?></td>
            <td><?php echo $row['griv_msg']?></td>
            <td><?php echo $row['status']?></td>
            <td>
            <input type="button" class="edit btn btn-sm btn-dark" id="<?php echo $row['id']?>" value="Edit">
            </td>
            <td>
            <form action="php/griv.php" method="post">
                <button class="btn btn-sm btn-dark" type="submit" name="delete">Delete</button>
                <input type="hidden" name="sr" value="<?php echo $row['id']?>">
            </form>
            </td>
            </tr>
            <?php
            }
            } 
            else{
              echo "No Grievances";
            }
            ?>
        </tbody>
        </table>
      </form>
    </section>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready( function () {
    $('#GrievanceTable').DataTable();
} );
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        stitle = tr.getElementsByTagName("td")[2].innerText;
        titleEdit.value = title;
        titleSEdit.value = stitle;
        descriptionEdit.value = description;
        $('#editModal').modal('toggle');
      })
    })
  </script>
</body>
</html>
