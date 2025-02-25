<?php
        $conn = new mysqli('devweb2023.cis.strath.ac.uk', 'tmb23194', 'Eihu5na6ongo', 'tmb23194');
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            $stmt = $conn->prepare("INSERT INTO contacts (userid, name, email, message) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", 1, $name, $email, $message);
            $stmt->execute();
            $stmt->close();
            echo '<p>Thank you for contacting us!</p>';
        }
        ?>
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <title>Contact Us</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 20px;
                }
                .navbar {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    background-color: #007BFF;
                    padding: 10px 20px;
                }
                .navbar .logo {
                    font-size: 24px;
                    color: white;
                }
                .navbar .nav-links {
                    display: flex;
                    gap: 20px;
                }
                .navbar .nav-links a {
                    color: white;
                    text-decoration: none;
                }
                .content {
                    max-width: 800px;
                    margin: 20px auto;
                    background: #fff;
                    padding: 20px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    border-radius: 8px;
                }
                .content h1 {
                    text-align: center;
                }
                .form-group {
                    margin-bottom: 15px;
                }
                .form-group label {
                    display: block;
                    margin-bottom: 5px;
                }
                .form-group input, .form-group textarea {
                    width: 100%;
                    padding: 10px;
                    box-sizing: border-box;
                }
                .form-group button {
                    width: 100%;
                    padding: 10px;
                    background: #007BFF;
                    border: none;
                    color: white;
                    cursor: pointer;
                }
                .form-group button:hover {
                    background: #0056b3;
                }
            </style>
        </head>
        <body>
            <div class='navbar'>
                <div class='logo'>Logo</div>
                <div class='nav-links'>
                    <a href='home.php'>Home</a>
                    <a href='index.php'>Portfolio</a>
                    <a href='about.php'>About Us</a>
                    <a href='contact.php'>Contact</a>
                </div>
            </div>
            <div class='content'>
                <h1>Contact Us</h1>
                <form method='post' action=''>
                    <div class='form-group'>
                        <label for='name'>Name:</label>
                        <input type='text' id='name' name='name' required>
                    </div>
                    <div class='form-group'>
                        <label for='email'>Email:</label>
                        <input type='email' id='email' name='email' required>
                    </div>
                    <div class='form-group'>
                        <label for='message'>Message:</label>
                        <textarea id='message' name='message' required></textarea>
                    </div>
                    <div class='form-group'>
                        <button type='submit'>Send Message</button>
                    </div>
                </form>
            </div>
        </body>
        </html>