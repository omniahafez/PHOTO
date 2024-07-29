<?php
// Include the necessary PHP files and perform any database connection/setup if required
if (isset ($_GET['search']) && !empty($_GET['search'])) {
	include_once("include/conn.php");
	$search = $_GET['search'];
// Check if the search form is submitted
try{
    $sql = "SELECT * FROM photos WHERE title LIKE :search";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['search' => "%$search%"]);
    $result = $stmt->fetchAll();
   // $active = $result['active'] ? "checked" : "";
} catch(PDOException $e) {
    echo $e->getMessage();
}

}
?>


<div class="tm-hero d-flex justify-content-center align-items-center" data-parallax="scroll" data-image-src="img/hero.jpg">
        <form class="d-flex tm-search-form">
            <input class="form-control tm-search-input" type="search" placeholder="Search" aria-label="Search" name="search">
            <button class="btn btn-outline-success tm-search-btn" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>