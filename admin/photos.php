<?php
include_once('include/loginchecker.php');
include_once("../include/conn.php");

try{
  // import all photos from the database
  $sql = "SELECT * FROM photos";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();

} catch(PDOException $e) {
  echo $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
    $title = "photos";
    include_once("include/lists_head.php");
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
                <h3>Manage Photos</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Photos</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="photos.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="photos.php">Settings 1</a>
                            <a class="dropdown-item" href="photos.php">Settings 2</a>
                          </div>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Photo Date</th>
                          <th>Title</th>
                          <th>Active</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <?php
                      // Looping each photo information in a table row
foreach ($result as $row){
  $id = $row['id'];
$title = $row['title'];
$photo_date = $row['photo_date'];
if ($row['active'] ==0) {
  $active = "No";
}else{
  $active = "yes";
}
?> 

                      <tbody>
                        <tr>
                          <td><?php echo $photo_date ?></td>
                          <td><?php echo $title ?></td>
                          <td><?php echo $active ?></td>
                          <td><a href = "editphoto.php?id=<?php echo $id ?>"><img src="./images/edit.png" alt="Edit"></td>
                          <td><a href = "deletphoto.php?id=<?php echo $id ?>" onclick="return confirm('Are you sure you want to delete?')"><img src="./images/delete.png" alt="Delete" ></td>
                        </tr>

                        <?php
      }
      ?> 
                        
                      </tbody>
                    </table>
                  </div>
                  </div>
              </div>
            </div>
                </div>
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