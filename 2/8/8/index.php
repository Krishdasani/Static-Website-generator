<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Media Gallery - 8</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .grid { display: flex; flex-wrap: wrap; gap: 10px; }
        .grid img, .grid video { width: 300px; height: 300px; object-fit: cover; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .grid div { flex: 1 1 calc(25% - 10px); box-sizing: border-box; }
        .grid img { transition: transform 0.2s ease-in-out; }
        .grid img:hover { transform: scale(1.1); }
        .filter { margin-bottom: 20px; }
    </style>
</head>
<body>
    <?php
    $conn = new mysqli('devweb2023.cis.strath.ac.uk', 'tmb23194', 'Eihu5na6ongo', 'tmb23194');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    $tagsResult = mysqli_query($conn, "SELECT DISTINCT Tag FROM Tags WHERE user_id = '$_COOKIE[user_id]'");
    $tags = [];
    while ($row = mysqli_fetch_assoc($tagsResult)) {
        $tags[] = $row['Tag'];
    }
    $tagsResult = mysqli_query($conn, "SELECT DISTINCT Tag FROM Tags WHERE user_id = '$_COOKIE[user_id]'");
    $tags = [];
    while ($row = mysqli_fetch_assoc($tagsResult)) {
        $tags[] = $row['Tag'];
    }
    ?>
    <h1>Media Gallery - 8</h1>
    <div class='filter'>
        <label for='tag-filter'>Filter by tag:</label>
        <select id='tag-filter' onchange='filterMedia()'>
            <option value=''>All</option>;

   <?php  foreach ($tags as $tag) {?>
    <option value='<?php echo $tag?>'><?php echo $tag?></option>;
   <?php }?></select>
    </div>
    <div class='grid' id='media-grid'>
    <?php
        if(isset($_GET['output'])) {
            $matched_files = json_decode(urldecode($_GET['output']), true);
            if (is_array($matched_files)) {
                foreach ($matched_files as $match) {
                    echo "<div class='media-item' data-tags=''><a href='{$match}.php'><img src='{$match}' alt='{$match}'></a></div>";
                }
            } else {
                echo '<p>No matches found.</p>';
            }
        } else {
            ?>
    <?php
        $tagsQuery = mysqli_query($conn, "SELECT Tag FROM Tags WHERE image_id = '68'");
        $mediaTags = [];
        while ($tagRow = mysqli_fetch_assoc($tagsQuery)) {
            $mediaTags[] = $tagRow['Tag'];
        }
        $tagList = implode(' ', $mediaTags);?><div class='media-item' data-tags='<?php echo $tagList?>'><a href='000_34Y96RL.jpg.php'><img src='000_34Y96RL.jpg' alt='000_34Y96RL.jpg'></a></div><?php
        $tagsQuery = mysqli_query($conn, "SELECT Tag FROM Tags WHERE image_id = '69'");
        $mediaTags = [];
        while ($tagRow = mysqli_fetch_assoc($tagsQuery)) {
            $mediaTags[] = $tagRow['Tag'];
        }
        $tagList = implode(' ', $mediaTags);?><div class='media-item' data-tags='<?php echo $tagList?>'><a href='1700348401042_ae2ead23-8688-450b-adf0-4bf9ada8aa7c.jpg.php'><img src='1700348401042_ae2ead23-8688-450b-adf0-4bf9ada8aa7c.jpg' alt='1700348401042_ae2ead23-8688-450b-adf0-4bf9ada8aa7c.jpg'></a></div><?php
        $tagsQuery = mysqli_query($conn, "SELECT Tag FROM Tags WHERE image_id = '70'");
        $mediaTags = [];
        while ($tagRow = mysqli_fetch_assoc($tagsQuery)) {
            $mediaTags[] = $tagRow['Tag'];
        }
        $tagList = implode(' ', $mediaTags);?><div class='media-item' data-tags='<?php echo $tagList?>'><a href='FBL-EURO-2024-MATCH46-POR-FRA-572_1720216053006_1720216106826.jpg.php'><img src='FBL-EURO-2024-MATCH46-POR-FRA-572_1720216053006_1720216106826.jpg' alt='FBL-EURO-2024-MATCH46-POR-FRA-572_1720216053006_1720216106826.jpg'></a></div><?php
        $tagsQuery = mysqli_query($conn, "SELECT Tag FROM Tags WHERE image_id = '71'");
        $mediaTags = [];
        while ($tagRow = mysqli_fetch_assoc($tagsQuery)) {
            $mediaTags[] = $tagRow['Tag'];
        }
        $tagList = implode(' ', $mediaTags);?><div class='media-item' data-tags='<?php echo $tagList?>'><a href='Nico Williams Spain Euro 2024.jpg.php'><img src='Nico Williams Spain Euro 2024.jpg' alt='Nico Williams Spain Euro 2024.jpg'></a></div><?php
        $tagsQuery = mysqli_query($conn, "SELECT Tag FROM Tags WHERE image_id = '72'");
        $mediaTags = [];
        while ($tagRow = mysqli_fetch_assoc($tagsQuery)) {
            $mediaTags[] = $tagRow['Tag'];
        }
        $tagList = implode(' ', $mediaTags);?><div class='media-item' data-tags='<?php echo $tagList?>'><a href='download.jpg.php'><img src='download.jpg' alt='download.jpg'></a></div><?php
        $tagsQuery = mysqli_query($conn, "SELECT Tag FROM Tags WHERE image_id = '73'");
        $mediaTags = [];
        while ($tagRow = mysqli_fetch_assoc($tagsQuery)) {
            $mediaTags[] = $tagRow['Tag'];
        }
        $tagList = implode(' ', $mediaTags);?><div class='media-item' data-tags='<?php echo $tagList?>'><a href='fbl-euro-2024-match51-esp-eng.jpg.php'><img src='fbl-euro-2024-match51-esp-eng.jpg' alt='fbl-euro-2024-match51-esp-eng.jpg'></a></div><?php
        $tagsQuery = mysqli_query($conn, "SELECT Tag FROM Tags WHERE image_id = '74'");
        $mediaTags = [];
        while ($tagRow = mysqli_fetch_assoc($tagsQuery)) {
            $mediaTags[] = $tagRow['Tag'];
        }
        $tagList = implode(' ', $mediaTags);?><div class='media-item' data-tags='<?php echo $tagList?>'><a href='unnamed.jpg.php'><img src='unnamed.jpg' alt='unnamed.jpg'></a></div>
    <?php
        }
        ?>
    </div>
<h2>Find Your Photos</h2>
<form action='../../../find_photos.php' method='post' enctype='multipart/form-data'>
<input type='hidden' name='portfolio_id' value='8'>
<div class='form-group'>
    <label for='userPhoto'>Upload Your Photo:</label>
    <input type='file' name='userPhoto' id='userPhoto' accept='image/*' required>
</div>
<div class='form-group'>
    <input type='submit' name='submit' value='Find Photos'>
</div>
</form>
<script>
    function filterMedia() {
        const selectedTag = document.getElementById('tag-filter').value.toLowerCase();
        const mediaItems = document.querySelectorAll('.media-item');

        mediaItems.forEach(item => {
            const tags = item.getAttribute('data-tags').toLowerCase().split(' ');
            if (selectedTag === '' || tags.includes(selectedTag)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
</body>
</html>