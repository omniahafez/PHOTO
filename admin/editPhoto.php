<?php
include_once('include/loginchecker.php');
if (isset ($_GET['id']) and $_GET['id'] >0) {
	include_once("../include/conn.php");
	$id = $_GET['id'];
	$msg ="";
	
	
  //update car information
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
  try{
	$photo_date = $_POST['photo_date'];
	$title = $_POST['title'];
	$license = $_POST["license"];
	$dimension = $_POST["dimension"];
	$active = isset($_POST["active"]);
	$format = $_POST["format"];
	$taq_id = $_POST["taq_id"];
	if ($_FILES['image']['error']=== UPLOAD_ERR_OK) {
	  include_once('include/upload.php');
	  $photoimage = $image_name;
	}else{
	  $photoimage = $_POST['oldimage'];
	}
  
	$sql = "UPDATE `photos` SET `title`=?, `image`=?, `license`=?,`dimension`=?,`format`=?,`active`=?,`taq_id`=?,`photo_date`=? WHERE id =?";
	  $stmt = $conn->prepare($sql);
	  $stmt->execute([$title, $photoimage, $license, $dimension, $format, $active, $taq_id, $photo_date, $id]);
  // Check if any rows were affected
  if ($stmt->rowCount() > 0) {
	$msg = "Car updated successfully";
	$alert = "alert-success";
  } else {
	$msg = "No changes made";
	$alert = "alert-info";
  }
  } catch (PDOException $e) {
	echo $e->getMessage();


  $msg = "Error: " . $e->getMessage();
  $alert = "alert-danger";
  }
  }
	
  //to appear the old data from DP in this page
  try{
	$sql = "SELECT * FROM `photos` WHERE `id` = ?";
	$stmtphoto = $conn->prepare($sql);
	$stmtphoto->execute([$id]);
	$resultphoto = $stmtphoto->fetch();
	$active = $resultphoto['active'] ? "checked" : "";
  } catch(PDOException $e) {
	echo $e->getMessage();
  }
	
  //show category in check box
  try{
	$sql = "SELECT * FROM `taq`";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
  } catch(PDOException $e) {
	echo $e->getMessage();
  }
  }
  ?>


<!DOCTYPE html>
<html lang="en">
  <head>
  <?php
    $title = "photos";
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
							<h3>Manage Photos</h3>
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
									<h2>Edit Photo</h2>
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

									<div class="alert <?php echo $alert ?>">
            <?php echo $msg ?>
            </div>
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="post" enctype="multipart/form-data">

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="photo date">Photo Date <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="date" id="photo-date" name="photo date" required="required" class="form-control " value="<?php echo $resultphoto['photo_date'] ?>">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="title">Title <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="title" required="required" name="title" class="form-control "value="<?php echo $resultphoto['title'] ?>">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="license">License <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<textarea id="content" name="license" required="required" class="form-control" ><?php echo $resultphoto['license'] ?></textarea>
											</div>
										</div>

										<div class="item form-group">
											<label for="dimension" class="col-form-label col-md-3 col-sm-3 label-align">Dimension <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="dimension" class="form-control" type="text" name="dimension" required="required" value="<?php echo $resultphoto['dimension'] ?>">
											</div>
										</div>

										<div class="item form-group">
											<label for="format" class="col-form-label col-md-3 col-sm-3 label-align">Format <span class="required">*</span></label>
											<div class="col-md-6 col-sm-6 ">
												<input id="format" class="form-control" type="text" name="format" required="required" value="<?php echo $resultphoto['format'] ?>">
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align">Active</label>
											<div class="checkbox">
												<label>
													<input type="checkbox" class="flat" name="active" <?php echo $resultphoto['active'] ? "checked" : ""; ?>>
												</label>
											</div>
										</div>

										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="image">Image <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="file" id="image" name="image"  class="form-control" >
												<img src="../img/<?php echo $resultphoto['image']?>" alt="<?php echo $resultphoto['title']?>" style="width: 300px;">
												
											</div>
										</div>


										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="tqa_id">Tag <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<select class="form-control" name="taq_id" id="">
													<option value=" ">Select Tag</option>
													<?php
                                                     foreach ($result as $taq){
                                                       ?>
                                                       <option value="<?php echo $taq["id"]; ?>" <?php echo $resultphoto['taq_id'] == $taq['id']? "selected" : "" ?> ><?php echo $taq["taq_name"] ?></option>
                                                       <?php
                                                       }
                                                       ?>
													
												</select>
											</div>
										</div>

										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
											<input type="hidden" name="oldimage" value="<?php echo $resultphoto['image']?>">
												<button class="btn btn-primary" type="button">Cancel</button>
												<button type="submit" class="btn btn-success">Add</button>
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
