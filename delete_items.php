<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';
include 'header.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);  // Use intval to prevent SQL injection

    // Get the item details to find the media files
    $sql = "SELECT * FROM items WHERE id = $id";
    $result = $conn->query($sql);
    $item = $result->fetch_assoc();

    if ($item) {
        // Delete the media files
        if (file_exists($item['image1'])) {
            unlink($item['image1']);
        }
        if (!empty($item['image2']) && file_exists($item['image2'])) {
            unlink($item['image2']);
        }
        if (!empty($item['image3']) && file_exists($item['image3'])) {
            unlink($item['image3']);
        }
        if (!empty($item['image4']) && file_exists($item['image4'])) {
            unlink($item['image4']);
        }
        if (!empty($item['image5']) && file_exists($item['image5'])) {
            unlink($item['image5']);
        }
        if (!empty($item['video']) && file_exists($item['video'])) {
            unlink($item['video']);
        }

        // Delete the item from the database
        $sql = "DELETE FROM items WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success' role='alert'>Item deleted successfully</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error deleting item: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger' role='alert'>Item not found.</div>";
    }
}

$sql = "SELECT * FROM items";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Delete Items</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="my-4">Delete Items</h1>
        <div class="row">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img class="card-img-top" src="<?php echo !empty($row['image1']) ? $row['image1'] : 'default.jpg'; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                            <a href="delete_items.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
