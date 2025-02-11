<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM items WHERE id = $id";
    $result = $conn->query($sql);
    $item = $result->fetch_assoc();
} else {
    header('Location: delete_items.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "DELETE FROM items WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header('Location: delete_items.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirm Delete</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="my-4">Confirm Delete</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $item['name']; ?></h5>
                <p class="card-text"><?php echo $item['description']; ?></p>
                <p class="card-text"><strong>Price: $<?php echo $item['price']; ?></strong></p>
                <form method="post">
                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                    <a href="delete_items.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
