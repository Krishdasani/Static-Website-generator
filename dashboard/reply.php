<?php
include 'server.php';
$portfolio_id = $_GET['id'];
$email = $_GET['email'];
if (isset($_POST['update'])) {
   
    $reply = $_POST['description'];
    $to = $email;
    $subject = "Reply!";
    $email_message = "$reply";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    
   
        // Update the database with the new image name and path
        $updateQuery = "UPDATE contacts SET status='Replied' WHERE id='$portfolio_id'";
        mysqli_query($conn, $updateQuery);

        echo "<script>window.alert('Replied')</script>";
        header("Location: contact.php"); 
        exit;
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reply</title>
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
        <h1>Reply</h1>
            
        <form action="" method="post">
           
            <div class="form-group">
                <label for="description">Reply</label>
                <textarea name="description" id="description" required></textarea>
            </div>
            
            <div class="form-group">
                <input type="submit" name="update" value="Update">
            </div>
        </form>
    </div>
</body>
</html>
