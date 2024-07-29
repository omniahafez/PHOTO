<?php
if (isset ($_GET['id']) and $_GET['id'] >0) {
	include_once("include/conn.php");
	$id = $_GET['id'];

try{
    $sqlUpdateViews = "UPDATE `photos` SET `views` = `views` + 1 WHERE `id` = ?";
        $stmtUpdateViews = $conn->prepare($sqlUpdateViews);
        if ($stmtUpdateViews->execute([$id])) {
           // echo "Views updated successfully!";
        } else {
            echo "Error updating views: " . $stmtUpdateViews->errorInfo()[2];
        }
    
    
  
} catch(PDOException $e) {
    echo $e->getMessage();
}

  
  try{
    $sql = "SELECT photos.*, taq.taq_name FROM photos INNER JOIN taq ON photos.taq_id = taq.id WHERE photos.id=?";
    $stmtphoto = $conn->prepare($sql);
    $stmtphoto->execute([$id]);
    $resultphoto = $stmtphoto->fetch();
    $active = $resultphoto['active'] ? "checked" : "";
} catch(PDOException $e) {
    echo $e->getMessage();
}

try{
    $sql = "SELECT * FROM `taq`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
} catch(PDOException $e) {
    echo $e->getMessage();
}
}

if (isset($resultphoto) and isset($result)) {
    // $resultphoto is set, you can access its values here
    $title = $resultphoto['title'];
    $image = $resultphoto['image'];
    $dimension = $resultphoto['dimension'];
    $format = $resultphoto['format'];
    $license = $resultphoto['license'];
    $taq_name = $resultphoto['taq_name'];

}else{
echo "no photo found";
}
?>

<div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-12 tm-text-primary"><?php echo $title ?></h2>
        </div>
        <div class="row tm-mb-90">            
            <div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
                <img src="img/<?php echo $image ?>" alt="Image" class="img-fluid">
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
                <div class="tm-bg-gray tm-video-details">
                    <p class="mb-4">
                        Please support us by making <a href="https://paypal.me/templatemo" target="_parent" rel="sponsored">a PayPal donation</a>. Nam ex nibh, efficitur eget libero ut, placerat aliquet justo. Cras nec varius leo.
                    </p>
                    <div class="text-center mb-5">
                        <a href="#" class="btn btn-primary tm-btn-big">Download</a>
                    </div>   

                    



                    <div class="mb-4 d-flex flex-wrap">
                        <div class="mr-4 mb-2">
                            <span class="tm-text-gray-dark">Dimension: </span><span class="tm-text-primary"><?php echo $dimension ?></span>
                        </div>

                        <div class="mr-4 mb-2">
                            <span class="tm-text-gray-dark">Format: </span><span class="tm-text-primary"><?php echo $format ?></span>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h3 class="tm-text-gray-dark mb-3">License</h3>
                        <p><?php echo $license ?></p>
                    </div>
                    

                    <div>
                        
                        <h3 class="tm-text-gray-dark mb-3">Tag</h3>
                        <a href="#" class="tm-text-primary mr-4 mb-2 d-inline-block"><?php echo $taq_name ?></a>
                        
                    </div>
                </div>
            </div>
        </div>
<?php
if (isset ($_GET['id']) and $_GET['id'] >0) {
	include_once("include/conn.php");
	$id = $_GET['id'];
    try {
        // Retrieve the taq_id corresponding to the provided id
        $sql = "SELECT taq_id FROM photos WHERE id=?";
        $stm = $conn->prepare($sql);
        $stm->execute([$id]);
        $taq_id_result = $stm->fetchColumn();
        
        // Fetch all photos with the same taq_id
        $sql = "SELECT * FROM photos WHERE taq_id=? AND id!=?";
        $stmtphotos = $conn->prepare($sql);
        $stmtphotos->execute([$taq_id_result, $id]);
        $resultphotos = $stmtphotos->fetchAll();
    } catch(PDOException $e) {
        echo $e->getMessage();
    }
}
?>

        <div class="row mb-4">
            <h2 class="col-12 tm-text-primary">
                Related Photos
            </h2>
        </div>

        <div class="row mb-3 tm-gallery">

        <?php
        foreach ($resultphotos as $taq){
            $id2 = $taq['id'];
            $title2 = $taq['title'];
            $image2 = $taq['image'];
            $photo_date2 = $taq['photo_date'];
            $views2 = $taq['views'];
            $active2 = $taq['active'] ? "checked" : "";
            
            ?>


            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                    <img src="img/<?php echo $image2 ?>" alt="<?php echo $title2 ?>" class="img-fluid">
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2><?php echo $title2 ?></h2>
                        <a href="photo-detail.php?id=<?php echo $id2; echo $title2 ?>">View more</a>
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light"><?php echo $photo_date2 ?></span>
                    <span><?php echo $views2 ?></span>
                </div>
            </div>
            <?php
        }
        ?>


            
                  
        </div> <!-- row -->
    </div> <!-- container-fluid, tm-container-content -->
    
