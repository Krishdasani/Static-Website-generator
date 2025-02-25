<?php
        $conn = new mysqli('devweb2023.cis.strath.ac.uk', 'tmb23194', 'Eihu5na6ongo', 'tmb23194');
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }
    
        $fetchProjects = "SELECT * FROM portfolio WHERE userid = '1'";
        $projects = mysqli_query($conn, $fetchProjects);
        ?>
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <title>User Projects</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    
                    justify-content: center;
                    
                    margin: 0;
                }
                .container {
                   
                    width: 100%;
                    display: flex;
                    flex-wrap: wrap;
                    gap: 20px;
                    justify-content: center;
                }
                .card {
                    background: #fff;
                    border-radius: 8px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    overflow: hidden;
                    width: calc(25% - 20px); /* Four cards in a row */
                    margin: 10px;
                    text-align: center;
                    transition: transform 0.2s;
                }
                .card:hover {
                    transform: scale(1.05);
                }
                .card img {
                    width: 100%;
                    height: 200px;
                    object-fit: cover;
                }
                .card h2 {
                    margin: 10px 0;
                    font-size: 1.5em;
                }
                .card p {
                    margin: 0 10px 10px;
                    color: #666;
                }
                .card a {
                    display: inline-block;
                    margin: 10px;
                    padding: 10px 20px;
                    background: #007BFF;
                    color: white;
                    text-decoration: none;
                    border-radius: 4px;
                }
                .card a:hover {
                    background: #0056b3;
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
            <div class='container'>
            <?php
            while ($project = mysqli_fetch_assoc($projects)) {
                $projectId = $project['portfolio_id'];
                $projectName = $project['name'];
                $projectCover = $project['image_path'];
                $projectDescription = $project['description'];
                echo "<div class='card'>
                <img src='$projectCover' alt='$projectName'>
                <h2>$projectName</h2>
                <p>$projectDescription</p>
                <a href='$projectId/$projectId/index.php'>View Portfolio</a>
            </div>";
            }
            ?>
            </div>
        </body>
        </html>