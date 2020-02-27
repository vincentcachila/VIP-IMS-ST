<?php include "session.php"; 

require_once 'config.php';
$account = $_SESSION['username'];
$qry = "SELECT username, warehouse FROM area_center WHERE username = '$account'";
$result = mysqli_query($link, $qry) or die(mysqli_error($link));

if (mysqli_num_rows($result) > 0) {
  while($rows = mysqli_fetch_array($result)){
    $username = $rows['username'];
    $warehouse_ac = $rows['warehouse'];
    //echo "<script>alert('$warehouse_ac');</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include "includes/header.php"; ?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <?php include "includes/navbar.php"; ?>
  <?php include "includes/sidebar-manage.php"; ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">VIP Inventory Management System</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Manage Stock Requests</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Manage Stock Requests</h3>
                  
                </div>
              </div>

              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Area Center</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Warehouse</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Product</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Qty</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Remarks</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Status</th>
                          
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Created_at</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Include config file
                        require_once 'config.php';

                        // Attempt select query execution
                        $query = "SELECT * FROM stock_request WHERE warehouse = '$warehouse_ac' ORDER BY status  DESC";
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){
                            $ctr = 0;
                            while($row = mysqli_fetch_array($result)){
                              $ctr++;
                              $id = $row['warehouse'];
                              echo "<tr>";
                              echo "<td>" . $ctr . "</td>";
                              echo "<td>" . $row['created_by'] . "</td>";
                              echo "<td><a href='warehouse-view.php?id=$id'>" . $row['warehouse'] . "</a></td>";
                              
                              echo "<td>" . $row['product'] . "</td>";
                              echo "<td>" . $row['qty'] . "</td>";
                              echo "<td>" . $row['remarks'] . "</td>";  

                              if($row['status']=='Pending'){
                              echo "<td class='text-warning'>" . $row['status'] . "</td>";  
                              } elseif($row['status']=='Approved') {
                              echo "<td class='text-success'>" . $row['status'] . "</td>";  
                              } else {
                               echo "<td class='text-muted'>" . $row['status'] . "</td>";  
                              }

                              echo "<td>" . $row['created_at'] . "</td>";
                              echo "<td>";

                              if($row['status']=='Pending'){
                              echo " &nbsp; <a href='request-approve.php?id=".$row['id']."' title='Approve Request' data-toggle='tooltip'><span class='fas fa fa-check'></span></a>";

                              echo " &nbsp; <a href='request-decline.php?id=".$row['id']."' title='Decline Request' data-toggle='tooltip'><span class='fas fa fa-times'></span></a>";

                              } else {

                              

                              }

                              
                              //echo " &nbsp; <a href='user-delete.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='fas fa fa-eye'></span></a>";
                              echo "</td>";
                              echo "</tr>";
                            }
                            // Free result set
                            mysqli_free_result($result);
                          } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                          }
                        } else{
                          echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                        }

                        // Close connection
                        mysqli_close($link);
                        ?>
                      </tbody>
                    </table>


              </div>

              <div class="card-footer">

              </div>
            </div>
          </div>

        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <?php include "includes/footer.php"; ?>
</div>
<!-- ./wrapper -->

 <?php include "includes/js.php"; ?>


</body>
</html>
