<?php
include 'db.php';
include 'header.php';

$sql = "SELECT * FROM items WHERE featured = 1";
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="my-4">Main Fields</h1>
        <!-- Button to go to Gallery -->
        <a href="gallery.php" class="btn btn-primary">View Items For Sale</a>
    </div>
    <div class="row">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <a href="item_details.php?id=<?php echo $row['id']; ?>">
                    <img class="card-img-top responsive-img" src="<?php echo $row['image1']; ?>" alt="<?php echo $row['name']; ?>">
                       </a>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['name']; ?></h5>
                         <h3><?php if($row['price']!=0){echo $row['price'];} ?></h3>
                        <p class="card-text">
                            <?php
                            $description = explode("\n", wordwrap($row['description'], 150, "\n"));
                            $short_description = implode(" ", array_slice($description, 0, 3));
                            if (count($description) > 3) {
                                $short_description .= '...';
                            }
                            echo nl2br($short_description);
                            ?>
                        </p>
                      
                     
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
