<?php
include_once('include/loginchecker.php');
if (isset ($_GET['id']) and $_GET['id'] >0) {
include_once("../include/conn.php");
  try{
    $id = $_GET['id'];
    // SQL query to delete a taq where the id matches
    $sql = "DELETE FROM `taq` WHERE `id` =?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $msg = "deleted succefuly";
    $alert = "alert-success";
} catch(PDOException $e) {
  $msg = "Error: ". $e->getMessage();
  $alert = "alert-danger";
}

}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
    $title = "delet taq";
    include_once("include/head.php");
    ?>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-file-image-o"></i></i> <span>Images Admin</span></a>
            </div>

            <div class="clearfix"></div>

            <?php
             include_once("include/profile.php");
            ?>

            <br />

            <?php
             include_once("include/sidebar.php");
            ?>

            <?php
             include_once("include/footer.php");
            ?>
          </div>
        </div>

        <?php
             include_once("include/navigation.php");
            ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><?php echo $title ?></h3>

                <div class="alert <?php echo $alert ?>">
            <?php echo $msg ?>

                
              </div>

              
              </div>
            </div>

            
        </div>
        <!-- /page content -->

        <?php
             include_once("include/lists_footerjs.php");
            ?>

  </body>
</html>