<?php
include 'db.php';
include 'header.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM items WHERE (name LIKE '%$search%' OR description LIKE '%$search%') and featured = 0";
} else {
    $sql = "SELECT * FROM items WHERE featured = 0";
}
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h1 class="mb-4">Sales</h1>
    <form method="get" action="gallery.php" class="form-inline mb-4">
        <input type="text" name="search" class="form-control mr-2" placeholder="Search items..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <div class="row">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                     <a href="item_details.php?id=<?php echo $row['id']; ?>" >
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
