<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

include 'db.php';
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $description = htmlspecialchars($_POST['description']);
    $featured = isset($_POST['featured']) ? 1 : 0;
    $price = htmlspecialchars($_POST['price']);

    // Handle file uploads
    $uploadOk = 1;
    $target_dir = "uploads/";

    // Define file paths
    $image1 = $target_dir . basename($_FILES["image1"]["name"]);
    $image2 = !empty($_FILES["image2"]["name"]) ? $target_dir . basename($_FILES["image2"]["name"]) : NULL;
    $image3 = !empty($_FILES["image3"]["name"]) ? $target_dir . basename($_FILES["image3"]["name"]) : NULL;
    $image4 = !empty($_FILES["image4"]["name"]) ? $target_dir . basename($_FILES["image4"]["name"]) : NULL;
    $image5 = !empty($_FILES["image5"]["name"]) ? $target_dir . basename($_FILES["image5"]["name"]) : NULL;
    $video = !empty($_FILES["video"]["name"]) ? $target_dir . basename($_FILES["video"]["name"]) : NULL;

    // Define file types
    $allowedImageTypes = ["jpg", "jpeg", "png", "gif"];
    $allowedVideoTypes = ["mp4", "avi", "mov"];

    // Validate the first image file
    $imageFileType1 = strtolower(pathinfo($image1, PATHINFO_EXTENSION));
    $check1 = getimagesize($_FILES["image1"]["tmp_name"]);
    if ($check1 === false || !in_array($imageFileType1, $allowedImageTypes)) {
        echo "<div class='alert alert-danger' role='alert'>The first image is not valid. Only JPG, JPEG, PNG, and GIF files are allowed.</div>";
        $uploadOk = 0;
    }

    // Validate other image files if provided
    $validateImage = function($file, $allowedImageTypes) {
        if (!empty($file)) {
            $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            return in_array($fileType, $allowedImageTypes);
        }
        return true;
    };

    $validateVideo = function($file, $allowedVideoTypes) {
        if (!empty($file)) {
            $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            return in_array($fileType, $allowedVideoTypes);
        }
        return true;
    };

    if (!$validateImage($image2, $allowedImageTypes) || !$validateImage($image3, $allowedImageTypes) ||
        !$validateImage($image4, $allowedImageTypes) || !$validateImage($image5, $allowedImageTypes) ||
        !$validateVideo($video, $allowedVideoTypes)) {
        echo "<div class='alert alert-danger' role='alert'>One or more uploaded files are not valid. Only JPG, JPEG, PNG, GIF, MP4, AVI, and MOV files are allowed.</div>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<div class='alert alert-danger' role='alert'>Sorry, your file was not uploaded.</div>";
    } else {
        // Move files to the target directory
        if (move_uploaded_file($_FILES["image1"]["tmp_name"], $image1) &&
            (empty($image2) || move_uploaded_file($_FILES["image2"]["tmp_name"], $image2)) &&
            (empty($image3) || move_uploaded_file($_FILES["image3"]["tmp_name"], $image3)) &&
            (empty($image4) || move_uploaded_file($_FILES["image4"]["tmp_name"], $image4)) &&
            (empty($image5) || move_uploaded_file($_FILES["image5"]["tmp_name"], $image5)) &&
            (empty($video) || move_uploaded_file($_FILES["video"]["tmp_name"], $video))) {

            // Prepare SQL statement to prevent SQL injection
            $stmt = $conn->prepare("INSERT INTO items (name, description, price, featured, image1, image2, image3, image4, image5, video) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdsssssss", $name, $description, $price, $featured, $image1, $image2, $image3, $image4, $image5, $video);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success' role='alert'>New item added successfully</div>";
            } else {
                echo "<div class='alert alert-danger' role='alert'>Error: " . $stmt->error . "</div>";
            }

            $stmt->close();
        } else {
            echo "<div class='alert alert-danger' role='alert'>Sorry, there was an error uploading your files.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Item</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="my-4">Add New Item</h1>
        <form method="post" enctype="multipart/form-data" class="form-add-item">
            <div class="form-group">
                <label for="name">Item Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="image1">Upload Main Image (Required)</label>
                <input type="file" id="image1" name="image1" class="form-control-file" required>
            </div>
            <div class="form-group">
                <label for="image2">Upload Additional Image 1 (Optional)</label>
                <input type="file" id="image2" name="image2" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="image3">Upload Additional Image 2 (Optional)</label>
                <input type="file" id="image3" name="image3" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="image4">Upload Additional Image 3 (Optional)</label>
                <input type="file" id="image4" name="image4" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="image5">Upload Additional Image 4 (Optional)</label>
                <input type="file" id="image5" name="image5" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="video">Upload Video (Optional)</label>
                <input type="file" id="video" name="video" class="form-control-file">
            </div>
            <div class="form-group">
                <input type="checkbox" id="featured" name="featured">
                <label for="featured">Featured</label>
            </div>
            <button type="submit" class="btn btn-primary">Add Item</button>
        </form>
        <a href="delete_items.php" class="btn btn-danger mt-3">Delete Items</a>
    </div>
<?php include 'footer.php'; ?>
</body>
</html>
