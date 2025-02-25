<?php
include 'server.php';
$id = $_COOKIE['user_id'];

if (isset($_POST['update'])) {
   
   
   $reply = $_POST['description'];
        // Update the database with the new image name and path
        $updateQuery = "UPDATE users SET about='$reply' WHERE id='$id'";
        mysqli_query($conn, $updateQuery);

      
        header("Location: index.php"); 
        exit;
   
}
$about = mysqli_query($conn,"select * from users where id=$id");
$fetch = mysqli_fetch_array($about);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    margin: 0;
   
}


        .navbar {
            width:100%;
            background-color: #007BFF;
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #0056b3;
            color: white;
        }
        

.container {
    width: 60%;
    background: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    margin-top: 80px; /* Space for the navbar */
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

.form-group input[type="text"],
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.form-group input[type="submit"],
.form-group input[type="button"] {
    width: 100%;
    padding: 10px;
    background: #007BFF;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 16px;
    border-radius: 4px;
}

.form-group input[type="submit"]:hover,
.form-group input[type="button"]:hover {
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
 <div class="navbar">
        <a href="index.php">Portfolios</a>
        <a href="about.php">About</a>
        <a href="contact.php">Messages</a>
    </div>
    <div class="container">
        <h1>About</h1>
         <p></p>   
        <form action="" method="post">
           
            <div class="form-group">
                <label for="description">About</label>
                <textarea name="description" id="description" rows="10" required><?php echo $fetch['about']; ?></textarea>
            </div>
            
            <div class="form-group">
                <input type="submit" name="update" value="Update">
            </div>
        </form>
    </div>
</body>
</html>
