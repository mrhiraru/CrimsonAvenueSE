<?php
session_start();

if (isset($_SESSION['verification_status']) && $_SESSION['verification_status'] != 'Verified') {
    header('location: ./user/verify.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<?php
// Change title for each page.
$title = "Home | Crimson Avenue";
$index_page = "active";
require_once('./includes/head.php');
include_once('./includes/preloader.php');
?>

<body>
    <?php
    require_once('./includes/header.user.php');
    ?>
    <div class="container-fluid col-md-9 mt-4 mx-sm-auto">
        <main>
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner rounded">
                    <div class="carousel-item carousel-custom active" data-bs-interval="5000">
                        <img src="./images/main/ye-background.jpg" class="d-block img-custom" alt="...">
                    </div>
                    <div class="carousel-item carousel-custom" data-bs-interval="5000">
                        <img src="./images/main/ye-background.jpg" class="d-block img-custom" alt="...">
                    </div>
                    <div class="carousel-item carousel-custom" data-bs-interval="5000">
                        <img src="./images/main/ye-background.jpg" class="d-block img-custom" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </main>
        <section>

        </section>
    </div>
    <?php
    require_once('./includes/js.php');
    ?>
</body>

</html>