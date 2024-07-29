<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $title = "index";
    include_once("include/head.php");
    ?>
</head>
<body>
<?php
    include_once("include/loader.php");
    ?>
    <?php
    include_once("include/navbar.php");
    ?>
<?php
    include_once("include/search.php");
    ?>
<?php
    include_once("include/index_content.php");
    ?>
     <?php
    include_once("include/paging.php");
    ?>   
    </div> <!-- container-fluid, tm-container-content -->

    <?php
    $pargrphe = '<p>Catalog-Z is free <a rel="sponsored" href="https://v5.getbootstrap.com/">Bootstrap 5</a> Alpha 2 HTML Template for video and photo websites. You can freely use this TemplateMo layout for a front-end integration with any kind of CMS website.</p>';
    include_once("include/footer.php");
    ?>    
    <?php
    include_once("include/js.php");
    ?>    
    
</body>
</html>