<?php
include 'server.php';
$userid = $_COOKIE['user_id'];
$portfolio_id = $_GET['id'];
if (isset($_POST['update'])) {
   
    $name = $_POST['name'];
    $description = $_POST['description'];
   

   
    $fetchOldImageQuery = "SELECT * FROM portfolio WHERE portfolio_id=$portfolio_id";
    $oldImageResult = mysqli_query($conn, $fetchOldImageQuery);
    $oldImageData = mysqli_fetch_assoc($oldImageResult);
    $portfolio = $oldImageData['portfolio_id'];
    $userid = $oldImageData['userid'];
    

    
   
        // Update the database with the new image name and path
        $updateQuery = "UPDATE portfolio SET name='$name', description='$description' WHERE portfolio_id='$portfolio_id'";
        mysqli_query($conn, $updateQuery);

       

        header("Location: index.php"); // Redirect to a success page
        exit;
   
}


$fetchImageQuery = "SELECT * FROM portfolio WHERE portfolio_id='$portfolio_id'";
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
        <h1>Update Portfolio Details</h1>
        <img src="<?php echo $imagepath.'cover.jpg'; ?>" alt="Image">

        <form action="" method="post">
            <!-- <input type="hidden" name="image_id" value="<?php echo $imageData['id']; ?>"> -->
            <div class="form-group">
                <label for="name">Image Name</label>
                <input type="text" name="name" id="name" value="<?php echo $imageData['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" required><?php echo $imageData['description']; ?></textarea>
            </div>
            
            <div class="form-group">
                <input type="submit" name="update" value="Update">
            </div>
        </form>
    </div>
</body>
</html>
