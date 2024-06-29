<?php session_start();
include_once('includes/config.php');
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else {
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard | Garbage Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
      <?php include_once('includes/navbar.php');?>
        <div id="layoutSidenav">
          <?php include_once('includes/sidebar.php');?>
            <div id="layoutSidenav_content">
<?php 
$userid=$_SESSION['id'];
$query=mysqli_query($con,"SELECT * FROM users WHERE id='$userid'");
while($result=mysqli_fetch_array($query))
{?>                        
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Welcome Back, <?php echo $result['fname'] . ' ' . $result['lname']; ?></h1>
                        <hr />
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>


<?php } ?>

<?php 
// Get total complaints
$totalComplaintsQuery = mysqli_query($con, "SELECT COUNT(*) as total FROM complaints WHERE user_id='$userid'");
$totalComplaintsResult = mysqli_fetch_array($totalComplaintsQuery);
$totalComplaints = $totalComplaintsResult['total'];

// Get pending complaints
$pendingComplaintsQuery = mysqli_query($con, "SELECT COUNT(*) as pending FROM complaints WHERE user_id='$userid' AND status='Pending'");
$pendingComplaintsResult = mysqli_fetch_array($pendingComplaintsQuery);
$pendingComplaints = $pendingComplaintsResult['pending'];

// Get completed complaints
$completedComplaintsQuery = mysqli_query($con, "SELECT COUNT(*) as completed FROM complaints WHERE user_id='$userid' AND status='Completed'");
$completedComplaintsResult = mysqli_fetch_array($completedComplaintsQuery);
$completedComplaints = $completedComplaintsResult['completed'];
?>

                        <div class="row">
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Total Complaints:<br> <strong><?php echo $totalComplaints; ?></strong></div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Pending Complaints:<br> <strong><?php echo $pendingComplaints; ?></strong></div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Completed Complaints:<br> <strong><?php echo $completedComplaints; ?></strong></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
          <?php include('includes/footer.php');?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
<?php } ?>
