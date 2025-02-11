<?php
include 'db.php';
include 'header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM items WHERE id = $id";
    $result = $conn->query($sql);
    $item = $result->fetch_assoc();
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <!-- Bootstrap Carousel for Images -->
            <div id="itemCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php if (!empty($item['image1'])): ?>
                        <div class="carousel-item active">
                            <img src="<?php echo $item['image1']; ?>" class="d-block w-100" alt="<?php echo $item['name']; ?>">
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($item['image2'])): ?>
                        <div class="carousel-item">
                            <img src="<?php echo $item['image2']; ?>" class="d-block w-100" alt="<?php echo $item['name']; ?>">
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($item['image3'])): ?>
                        <div class="carousel-item">
                            <img src="<?php echo $item['image3']; ?>" class="d-block w-100" alt="<?php echo $item['name']; ?>">
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($item['image4'])): ?>
                        <div class="carousel-item">
                            <img src="<?php echo $item['image4']; ?>" class="d-block w-100" alt="<?php echo $item['name']; ?>">
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($item['image5'])): ?>
                        <div class="carousel-item">
                            <img src="<?php echo $item['image5']; ?>" class="d-block w-100" alt="<?php echo $item['name']; ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <a class="carousel-control-prev" href="#itemCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#itemCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <!-- Video (if available) -->
            <?php if (!empty($item['video'])): ?>
                <video class="img-fluid mt-4" controls>
                    <source src="<?php echo $item['video']; ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            <?php endif; ?>
        </div>
        <div class="col-md-6">
            <h1><?php echo $item['name']; ?></h1>
            <hr>
            <h3><?php if($item['price']!=0){echo $item['price'];} ?></h3>
            <p><?php echo nl2br($item['description']); ?></p>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
