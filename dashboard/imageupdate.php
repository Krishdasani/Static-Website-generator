<?php
include 'server.php';
$userid = $_COOKIE['user_id'];

if (isset($_POST['update'])) {
    $image_id = $_POST['image_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $UpdateTag = $_POST['UserTag'];

    // Fetch the old image data
    $fetchOldImageQuery = "SELECT * FROM images WHERE id='$image_id'";
    $oldImageResult = mysqli_query($conn, $fetchOldImageQuery);
    $oldImageData = mysqli_fetch_assoc($oldImageResult);
    $portfolio = $oldImageData['portfolio_id'];
    $userid = $oldImageData['userid'];
    $oldname = $oldImageData['name'];
    $oldImagePath = '../' . $userid . '/' . $portfolio . '/' . $portfolio . '/' . $oldname;

    // Rename the image file
    $newImagePath = dirname($oldImagePath) . '/' . $name;
    if (rename($oldImagePath, $newImagePath)) {
        // Update the database with the new image name and path
        $updateQuery = "UPDATE images SET name='$name', description='$description', path='$newImagePath' WHERE id='$image_id'";
        mysqli_query($conn, $updateQuery);

        $fetchOldTag = mysqli_query($conn, "SELECT * FROM Tags WHERE image_id='$image_id'");
        if (mysqli_num_rows($fetchOldTag) > 0) {
            mysqli_query($conn, "UPDATE Tags SET Tag='$UpdateTag' WHERE image_id='$image_id'");
        } else {
            mysqli_query($conn, "INSERT INTO Tags (Tag, image_id, user_id) VALUES ('$UpdateTag', '$image_id', '$userid')");
        }

        header("Location: portfolio.php?id=$portfolio"); // Redirect to a success page
        exit;
    } else {
        echo "Failed to rename the image file.";
    }
}

$image_id = $_GET['id'];
$fetchImageQuery = "SELECT * FROM images WHERE id='$image_id'";
$imageResult = mysqli_query($conn, $fetchImageQuery);
$imageData = mysqli_fetch_assoc($imageResult);
$imagepath = '../' . $userid . '/' . $imageData['portfolio_id'] . '/' . $imageData['portfolio_id'] . '/';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Image Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 600px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"], .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="submit"], .form-group input[type="button"] {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 16px;
            border-radius: 4px;
        }
        .form-group input[type="submit"]:hover {
            background: #0056b3;
        }
        .container img {
    display: block;
    max-width: 100%;
    height: 250px;
    margin: 20px auto;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Update Image Details</h1>
        <img src="<?php echo $imagepath.$imageData['name']; ?>" alt="Image">

        <form action="" method="post">
            <input type="hidden" name="image_id" value="<?php echo $imageData['id']; ?>">
            <div class="form-group">
                <label for="name">Image Name</label>
                <input type="text" name="name" id="name" value="<?php echo $imageData['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" required><?php echo $imageData['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="Tags">Tags</label>
                <select name="UserTag">
                    <?php
                    $UserTags = mysqli_query($conn, "SELECT DISTINCT Tag FROM Tags WHERE user_id = $userid");
                    while ($ut = mysqli_fetch_assoc($UserTags)) {
                        echo "<option value='" . $ut['Tag'] . "'>" . $ut['Tag'] . "</option>";
                    }
                    ?>
                </select>
                <a href="NewTag.php?imageid=<?php echo $image_id ?>"><input type="button" name="newTag" value="Add New Tag"></a>
            </div>
            <div class="form-group">
                <input type="submit" name="update" value="Update">
            </div>
        </form>
    </div>
</body>
</html>
