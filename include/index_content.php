<?php
  include_once("include/conn.php");
  try{
    $sql = "SELECT `id`, `title`, `image`, `created_at`, `views` FROM `photos` WHERE `active`=1 ORDER by `created_at` DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
 
} catch(PDOException $e) {
    echo $e->getMessage();
}

?>
<div class="container-fluid tm-container-content tm-mt-60">
        <div class="row mb-4">
            <h2 class="col-6 tm-text-primary">
                Latest Photos
            </h2>
            <div class="col-6 d-flex justify-content-end align-items-center">
                <form action="" class="tm-text-primary">
                    Page <input type="text" value="1" size="1" class="tm-input-paging tm-text-primary"> of 200
                </form>
            </div>
        </div>
        <div class="row tm-mb-90 tm-gallery">

        <?php   
foreach ($result as $photo){
    $id = $photo['id'];
$title = $photo['title'];
$image = $photo['image'];
$created_at = $photo['created_at'];
$views = $photo['views'];

    ?>

        
        
        	<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <figure class="effect-ming tm-video-item">
                
                    <img src="img/<?php echo $image ?>" alt="<?php echo $title ?>" class="img-fluid">
                
                    <figcaption class="d-flex align-items-center justify-content-center">
                        <h2><?php echo $title ?></h2>
                        <a href="photo-detail.php?id=<?php echo $id; echo $title ?>">View more</a> <!-- Add the photo ID to the URL -->
                    </figcaption>                    
                </figure>
                <div class="d-flex justify-content-between tm-text-gray">
                    <span class="tm-text-gray-light"><?php echo $created_at ?></span>
                    <span><?php echo  $views ?></span>   
                </div>
            </div>
            <?php
}

?>
        </div> <!-- row -->
        