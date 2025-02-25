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
        .form-group input[type="text"],.form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="submit"],.form-group input[type="button"] {
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Add a new Tag</h1>
        <form action="" method="post">
            <!-- <input type="hidden" name="image_id" value="<?php echo $imageData['id']; ?>"> -->
            <div class="form-group">
                <label for="name">Tag</label>
                <input type="text" name="name" id="name" required>
            </div>
            
            <div class="form-group">
                <input type="submit" name="update" value="Update">
            </div>
        </form>
    </div>
</body>
</html>
<?php
include 'server.php';
$userid = $_COOKIE['user_id'];
if (isset($_POST['update'])) {
$imageid = $_GET['imageid'];
$tag = $_POST['name'];
$query = mysqli_query($conn,"INSERT INTO `Tags`( `Tag`, `image_id`, `user_id`) VALUES ('$tag','$imageid','$userid')");
if($query)
{?>
    <script>window.location.href = "index.php   ";
</script>
<?php }
else{
    echo 'error adding a new tag';
}
}
?> 