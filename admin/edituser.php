<?php
include_once('include/loginchecker.php');
include_once("../include/conn.php");
// Checking for 'id' 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
  }else{
    header("location: users.php");
  }
 if ($_SERVER["REQUEST_METHOD"] === "POST") {
  try {
	// SQL query to update user data
    $sql = "UPDATE `users` SET `fullname`=?, `user_name`=?, `password`=?, `email`=?, `active`=? WHERE `id` =?";
    $fullname = $_POST['fullname'];
	$user_name = $_POST['user_name'];
    $email = $_POST['email'];
	// Checking if password is empty
    if (empty($_POST["password"])) {
      $password = $_POST["oldpassword"];
    }else{
		// Hashing new password
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    }
    $active = isset($_POST['active']);
        $stmt = $conn->prepare($sql);
    $stmt->execute([$fullname, $user_name, $password, $email, $active, $id]);
    
} catch(PDOException $e) {
    echo $e->getMessage();
}
}
  
  try {
	// Selecting user data based on provided 'id'
      $sql = "SELECT * FROM `users` WHERE `id` = ?";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$id]);
      $result = $stmt->fetch();
	  $fullname = $result['fullname'];
      $user_name = $result['user_name'];
      $password = $result['password'];
      $email = $result["email"];
      $active = $result['active'] ? "checked" : "";
      echo "Inserted Successfully";
  } catch(PDOException $e) {
      echo $e->getMessage();
  }
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
    $title = " Images Admin | Edit User";
    include_once("include/head.php");
    ?>
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="index.html" class="site_title"><i class="fa fa-file-image-o"></i> <span>Images Admin</span></a>
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
							<h3>Manage Users</h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5  form-group pull-right top_search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search for...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">Go!</button>
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
									<h2>Edit User</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a class="dropdown-item" href="#">Settings 1</a>
												</li>
												<li><a class="dropdown-item" href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Full Name <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="first-name" required="required" class="form-control " name="fullname" value="<?php echo $fullname ?>">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Username <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="user-name" name="user_name" required="required" class="form-control" value="<?php echo $user_name ?>">
											</div>
										</div>

										<div class="item form-group">
											<label for="email" class="col-form-label col-md-3 col-sm-3 label-align">Email <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="email" class="form-control" type="email" name="email" required="required" value="<?php echo $email ?>">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Active</label>
											<div class="checkbox">
												<label>
													<input type="checkbox" class="flat" name="active" <?php echo $active ?>>
												</label>
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="password">Password <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="password" id="password" name="password" required="required" class="form-control" value="<?php echo $password ?>">
											</div>
										</div>
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
											<input type="hidden" name="oldpassword" value="<?php echo $password?>">
												<button class="btn btn-primary" type="button">Cancel</button>
												<button type="submit" class="btn btn-success">Update</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- /page content -->

			<?php
             include_once("include/footerjs.php");
            ?>

</body></html>
