<?php include "session.php"; ?>

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
              <li class="breadcrumb-item active">Manage Stocks</li>
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
              <?php $warehouse = $_GET['id']; ?>
                <div class="d-flex justify-content-between">
                  <h3 class="card-title"><?php echo $warehouse; ?> Stocks</h3>
                  
                </div>
              </div>

              <div class="card-body">
                <table id="example2" class="table dataTable">
                      <thead>
                        <tr>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">No.</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Product Description</th>
                          <!-- <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Warehouse</th> -->
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Quantity</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        // Include config file
                        require_once 'config.php';
                        
                        // Attempt select query execution
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
                        $query = "SELECT * FROM stocks WHERE warehouse = '$warehouse_ac' ORDER BY product";
                        if($result = mysqli_query($link, $query)){
                          if(mysqli_num_rows($result) > 0){
                            $ctr = 0;
                            while($row = mysqli_fetch_array($result)){
                              $ctr++;
                              
                              echo "<tr>";
                              echo "<td>" . $ctr . "</td>";
                              echo "<td>" . $row['product'] . "</td>";
                              //echo "<td>" . $row['warehouse'] . "</td>";
                              echo "<td>" . $row['quantity'] . "</td>";
                              //echo "<td>";
                              
                              //echo " &nbsp; <a href='warehouse-update.php?warehouse_id=". $row['warehouse_id'] ."' title='Update Record' data-toggle='tooltip'><span class='fas fa-pen'></span></a>";
                              //echo " &nbsp; <a href='warehouse-delete.php?warehouse_id=". $row['warehouse_id'] ."' title='Delete Record' data-toggle='tooltip' onclick='return checkDelete()'><span class='fas fa fa-trash'></span></a>";

                              //echo "</td>";
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
