<?php
session_start();
include_once('includes/config.php');
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
} else {
  // Code for handling complaint submission
  if(isset($_POST['submit_complaint'])) {
    $userid = $_SESSION['id'];
    $address_line1 = $_POST['address_line1'];
    $address_line2 = $_POST['address_line2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $country = $_POST['country'];
    $note = $_POST['note'];
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    $query = "INSERT INTO complaints (user_id, address_line1, address_line2, city, state, zip, country, note, image) VALUES ('$userid', '$address_line1', '$address_line2', '$city', '$state', '$zip', '$country', '$note', '$target_file')";
    $result = mysqli_query($con, $query);

    if($result) {
      echo "<script>alert('Complaint lodged successfully!');</script>";
      echo "<script type='text/javascript'> document.location = 'lodge_complain.php'; </script>";
    } else {
      echo "<script>alert('Error in lodging complaint!');</script>";
      echo "<script type='text/javascript'> document.location = 'lodge_complain.php'; </script>";
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Lodge Garbage Complaint | Garbage Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
  <?php include_once('includes/navbar.php');?>
    <div id="layoutSidenav">
      <?php include_once('includes/sidebar.php');?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Lodge Garbage Complaint</h1>
                    <div class="card mb-4">
                        <form method="post" name="lodge_complaint" enctype="multipart/form-data">
                                <table class="table table-bordered">
                                   <tr>
                                    <th>Address Line 1</th>
                                       <td><input class="form-control" id="address_line1" name="address_line1" type="text" required /></td>
                                   </tr>
                                   <tr>
                                    <th>Address Line 2</th>
                                       <td><input class="form-control" id="address_line2" name="address_line2" type="text" /></td>
                                   </tr>
                                   <tr>
                                    <th>City</th>
                                       <td><input class="form-control" id="city" name="city" type="text" required /></td>
                                   </tr>
                                   <tr>
                                    <th>State</th>
                                       <td><input class="form-control" id="state" name="state" type="text" required /></td>
                                   </tr>
                                   <tr>
                                    <th>ZIP Code</th>
                                       <td><input class="form-control" id="zip" name="zip" type="text" required /></td>
                                   </tr>
                                   <tr>
                                    <th>Country</th>
                                       <td><input class="form-control" id="country" name="country" type="text" required /></td>
                                   </tr>
                                   <tr>
                                       <th>Note</th>
                                       <td><textarea class="form-control" id="note" name="note"></textarea></td>
                                   </tr>
                                   <tr>
                                       <th>Image</th>
                                       <td><input class="form-control" id="image" name="image" type="file" accept="image/*" required /></td>
                                   </tr>
                                   <tr>
                                       <td colspan="4" style="text-align:center ;"><button type="submit" class="btn btn-primary btn-block" name="submit_complaint">Submit</button></td>
                                   </tr>
                                </table>
                        </form>
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
