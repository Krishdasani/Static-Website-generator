<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            position: relative;
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

        .form-group .error {
            color: red;
            font-size: 0.9em;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            border: none;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        #togglePassword {
            position: absolute;
            right: 10px;
            top: 26px;
            width: 10px;
            background: blue;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form id="registerForm" action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="company">Company Name:</label>
                <input type="text" id="company" name="company" required>
                <span class="error" id="companyError"></span>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <span class="error" id="emailError"></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="button" id="togglePassword">Show</button>
                <span class="error" id="passwordError"></span>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <span class="error" id="confirmPasswordError"></span>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required>
                <span class="error" id="phoneError"></span>
            </div>
            <div class="form-group">
                <label for="logo">Logo:</label>
                <input type="file" id="logo" name="logo" accept="image/*" required>
                <span class="error" id="logoError"></span>
            </div>
            <div class="form-group">
                <label for="about">About Us:</label>
                <textarea id="about" name="about" required></textarea>
                <span class="error" id="aboutError"></span>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.textContent = type === 'password' ? 'Show' : 'Hide';
        });

        document.getElementById('registerForm').addEventListener('submit', function (event) {
            let valid = true;

            // Company Name Validation
            const company = document.getElementById('company').value;
            const companyError = document.getElementById('companyError');
            const companyRegex = /^[a-zA-Z0-9\s]+$/;
            if (!companyRegex.test(company)) {
                companyError.textContent = 'Company name can only contain letters, numbers, and spaces.';
                valid = false;
            } else {
                companyError.textContent = '';
            }

            // Email Validation
            const email = document.getElementById('email').value;
            const emailError = document.getElementById('emailError');
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(email)) {
                emailError.textContent = 'Please enter a valid email address.';
                valid = false;
            } else {
                emailError.textContent = '';
            }

            // Password Validation
            const password = document.getElementById('password').value;
            const passwordError = document.getElementById('passwordError');
            const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;
            if (!passwordRegex.test(password)) {
                passwordError.textContent = 'Password must be between 6 to 20 characters and contain at least one numeric digit, one uppercase and one lowercase letter.';
                valid = false;
            } else {
                passwordError.textContent = '';
            }

            // Confirm Password Validation
            const confirmPassword = document.getElementById('confirmPassword').value;
            const confirmPasswordError = document.getElementById('confirmPasswordError');
            if (confirmPassword !== password) {
                confirmPasswordError.textContent = 'Passwords do not match.';
                valid = false;
            } else {
                confirmPasswordError.textContent = '';
            }

            // Phone Validation
            const phone = document.getElementById('phone').value;
            const phoneError = document.getElementById('phoneError');
            const phoneRegex = /^[0-9]{10}$/;
            if (!phoneRegex.test(phone)) {
                phoneError.textContent = 'Please enter a valid phone number.';
                valid = false;
            } else {
                phoneError.textContent = '';
            }

            if (!valid) {
                event.preventDefault();
            }
        });
    </script>
    <?php
    include 'server.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $company = sanitizeInput($_POST["company"]);
        $email = sanitizeInput($_POST["email"]);
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
        $phone = sanitizeInput($_POST["phone"]);
        $about = sanitizeInput($_POST["about"]);
        $logo = $_FILES['logo'];
        $errors = [];
        if (!preg_match("/^[a-zA-Z0-9\s]+$/", $company)) {
            $errors[] = "Company name can only contain letters, numbers, and spaces.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address.";
        }
        if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/", $password)) {
            $errors[] = "Password must be between 6 to 20 characters and contain at least one numeric digit, one uppercase and one lowercase letter.";
        }
        if ($password !== $confirmPassword) {
            $errors[] = "Passwords do not match.";
        }
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $errors[] = "Please enter a valid phone number.";
        }
        if (empty($errors)) {          
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (company, email, password, phone, about) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $company, $email, $hashedPassword, $phone, $about);

            if ($stmt->execute()) {
                $userId = $stmt->insert_id;
                $userDir = $userId;
                if (!is_dir($userDir)) {
                    mkdir($userDir, 0755, true);
                }
                $logoPath = $userDir . '/logo.jpg';
                move_uploaded_file($logo['tmp_name'], $logoPath);
                generateUserIndex($userId, $conn);
                generateHomePage($userId, $conn);
                generateAboutPage($userId, $conn);
                generateContactPage($userId, $conn);
                $websitelink = 'https://devweb2023.cis.strath.ac.uk/~tmb23194/genrator/'.$userId.'/home.php';
$dashboardlink = 'https://devweb2023.cis.strath.ac.uk/~tmb23194/genrator/dashboard/index.php';

$to = $email;
$subject = 'Website Links';
$message = 'Hi, welcome onboard. The links to your website are:<br>Website Link: '.$websitelink.'<br>Dashboard Link: '.$dashboardlink.'<br><b>Note:</b> Please login before accessing the dashboard.';

$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

mail($to, $subject, $message, $headers);


             echo "<script>window.location.href = 'login.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();
            $conn->close();
        } else {
            foreach ($errors as $    $error) {
                echo "<p>" . $error . "</p>";
            }
        }
    }

    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function generateUserIndex($userid, $conn) {
        $userDir = $userid . '/';
        $indexPhp = "<?php
        \$conn = new mysqli('devweb2023.cis.strath.ac.uk', 'tmb23194', 'Eihu5na6ongo', 'tmb23194');
        if (\$conn->connect_error) {
            die('Connection failed: ' . \$conn->connect_error);
        }
    
        \$fetchProjects = \"SELECT * FROM portfolio WHERE userid = '$userid'\";
        \$projects = mysqli_query(\$conn, \$fetchProjects);
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
            while (\$project = mysqli_fetch_assoc(\$projects)) {
                \$projectId = \$project['portfolio_id'];
                \$projectName = \$project['name'];
                \$projectCover = \$project['image_path'];
                \$projectDescription = \$project['description'];
                echo \"<div class='card'>
                <img src='\$projectCover' alt='\$projectName'>
                <h2>\$projectName</h2>
                <p>\$projectDescription</p>
                <a href='\$projectId/\$projectId/index.php'>View Portfolio</a>
            </div>\";
            }
            ?>
            </div>
        </body>
        </html>";

        file_put_contents($userDir . "index.php", $indexPhp);
    }

    function generateHomePage($userid, $conn) {
        $userDir = $userid . '/';
        $homePhp = "<?php
        \$conn = new mysqli('devweb2023.cis.strath.ac.uk', 'tmb23194', 'Eihu5na6ongo', 'tmb23194');
        if (\$conn->connect_error) {
            die('Connection failed: ' . \$conn->connect_error);
        }
    
        // Fetch latest 3 portfolios for slideshow
        \$latestPortfoliosQuery = \"SELECT * FROM portfolio WHERE userid = '$userid' ORDER BY portfolio_id DESC LIMIT 3\";
        \$latestPortfoliosResult = mysqli_query(\$conn, \$latestPortfoliosQuery);
    
        // Fetch first 3 portfolios for cards
        \$firstPortfoliosQuery = \"SELECT * FROM portfolio WHERE userid = '$userid' ORDER BY portfolio_id DESC LIMIT 3\";
        \$firstPortfoliosResult = mysqli_query(\$conn, \$firstPortfoliosQuery);
        ?>
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <title>Home</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
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
                .slideshow-container {
                    position: relative;
                    max-width: 100%;
                    margin: auto;
                    overflow: hidden;
                }
                .slides {
                    display: flex;
                    transition: transform 0.5s ease-in-out;
                }
                .slide {
                    min-width: 100%;
                    box-sizing: border-box;
                }
                .slideshow-container img {
                    width: 100%;
                    height: auto;
                }
                .prev, .next {
                    cursor: pointer;
                    background-color:black;
                    position: absolute;
                    top: 50%;
                    width: auto;
                    margin-top: -22px;
                    padding: 16px;
                    color: white;
                    font-weight: bold;
                    font-size: 18px;
                    transition: 0.6s ease;
                    border-radius: 0 3px 3px 0;
                    user-select: none;
                }
                .next {
                    right: 0;
                    border-radius: 3px 0 0 3px;
                }
                .prev:hover, .next:hover {
                    background-color: rgba(0,0,0,0.8);
                }
                .cards {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 20px;
                    justify-content: center;
                    padding: 20px;
                }
                .card {
                    background: #fff;
                    border-radius: 8px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    overflow: hidden;
                    width: calc(33% - 20px); /* Three cards in a row */
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
                .card a,.button{
                    display: inline-block;
                    margin: 10px;
                    padding: 10px 20px;
                    background: #007BFF;
                    color: white;
                    text-decoration: none;
                    border-radius: 4px;
                }
                .card a:hover,button:hover {
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
    
            <div class='slideshow-container'>
                <div class='slides'>
                    <?php
                    while (\$portfolio = mysqli_fetch_assoc(\$latestPortfoliosResult)) {
                        echo \"<div class='slide'><img src='\$portfolio[image_path]' alt='\$portfolio[name]'></div>\";
                    }
                    ?>
                </div>
                <a class='prev' onclick='plusSlides(-1)'>&#10094;</a>
                <a class='next' onclick='plusSlides(1)'>&#10095;</a>
            </div>
            <div class='cards'>
                <?php
                while (\$portfolio = mysqli_fetch_assoc(\$firstPortfoliosResult)) {
                    echo \"<div class='card'>
                        <img src='\$portfolio[image_path]' alt='\$portfolio[name]'>
                        <h2>\$portfolio[name]</h2>
                        <p>\$portfolio[description]</p>
                        <a href='\$portfolio[portfolio_id]/\$portfolio[portfolio_id]/index.php'>View Portfolio</a>
                    </div>\";
                }
                ?>
               
            </div>
            <script>
            let slideIndex = 0;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function showSlides(n) {
            let slides = document.getElementsByClassName('slide');
            if (n >= slides.length) { slideIndex = 0 }
            if (n < 0) { slideIndex = slides.length - 1 }
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = 'none';
            }
            slides[slideIndex].style.display = 'block';
        }

            </script>
        </body>
        </html>";
    
        file_put_contents($userDir . "home.php", $homePhp);
    }
    function generateAboutPage($userid, $conn) {
        $userDir = $userid . '/';
        $aboutPhp = "<?php
        \$conn = new mysqli('devweb2023.cis.strath.ac.uk', 'tmb23194', 'Eihu5na6ongo', 'tmb23194');
        if (\$conn->connect_error) {
            die('Connection failed: ' . \$conn->connect_error);
        }
    
        \$aboutQuery = \"SELECT about FROM users WHERE id = '$userid'\";
        \$aboutResult = mysqli_query(\$conn, \$aboutQuery);
        \$aboutData = mysqli_fetch_assoc(\$aboutResult);
        \$aboutText = \$aboutData['about'];
        ?>
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <title>About Us</title>
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
                <h1>About Us</h1>
                <p><?php echo nl2br(\$aboutText); ?></p>
            </div>
        </body>
        </html>";
        
        file_put_contents($userDir . "about.php", $aboutPhp);
    }
    function generateContactPage($userid, $conn) {
        $userDir = $userid . '/';
        $contactPhp = "<?php
        \$conn = new mysqli('devweb2023.cis.strath.ac.uk', 'tmb23194', 'Eihu5na6ongo', 'tmb23194');
        if (\$conn->connect_error) {
            die('Connection failed: ' . \$conn->connect_error);
        }
    
        if (\$_SERVER['REQUEST_METHOD'] == 'POST') {
            \$name = \$_POST['name'];
            \$email = \$_POST['email'];
            \$message = \$_POST['message'];
            mysqli_query(\$conn,\"INSERT INTO `contacts`(`userid`, `name`, `email`, `message`) VALUES ('\$userid','\$name','\$email','\$message')\");
            ?><script>window.alert('Thnaks for contacting us we will get back to you shortly')</script><?php;
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
        </html>";
        
        file_put_contents($userDir . "contact.php", $contactPhp);
    }
    
    ?>
</body>
</html>

