<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Media Gallery - 7</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .masonry { column-count: 3; column-gap: 10px; }
        .masonry img, .masonry video { width: 100%; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 10px; }
        .masonry img { transition: transform 0.2s ease-in-out; }
        .masonry img:hover { transform: scale(1.1); }
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
<h1>Media Gallery - 7</h1>
<div class='filter'>
    <label for='tag-filter'>Filter by tag:</label>
    <select id='tag-filter' onchange='filterMedia()'>
        <option value=''>All</option>;

<?php  foreach ($tags as $tag) {?>
<option value='<?php echo $tag?>'><?php echo $tag?></option>;
<?php }?></select>
</div>
<div class='masonry' id='media-grid'>
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
<div class='media-item' data-tags=''><a href='gettyimages-1705162581-612x612.jpg.php'><img src='gettyimages-1705162581-612x612.jpg' alt='gettyimages-1705162581-612x612.jpg'></a></div><div class='media-item' data-tags=''><a href='gettyimages-1705233603-612x612.jpg.php'><img src='gettyimages-1705233603-612x612.jpg' alt='gettyimages-1705233603-612x612.jpg'></a></div><div class='media-item' data-tags=''><a href='gettyimages-1707570552-612x612.jpg.php'><img src='gettyimages-1707570552-612x612.jpg' alt='gettyimages-1707570552-612x612.jpg'></a></div><div class='media-item' data-tags=''><a href='gettyimages-1712284433-612x612.jpg.php'><img src='gettyimages-1712284433-612x612.jpg' alt='gettyimages-1712284433-612x612.jpg'></a></div><div class='media-item' data-tags=''><a href='gettyimages-1715816961-612x612.jpg.php'><img src='gettyimages-1715816961-612x612.jpg' alt='gettyimages-1715816961-612x612.jpg'></a></div><div class='media-item' data-tags=''><a href='gettyimages-1745437131-612x612.jpg.php'><img src='gettyimages-1745437131-612x612.jpg' alt='gettyimages-1745437131-612x612.jpg'></a></div><div class='media-item' data-tags=''><a href='gettyimages-1745437183-612x612.jpg.php'><img src='gettyimages-1745437183-612x612.jpg' alt='gettyimages-1745437183-612x612.jpg'></a></div><div class='media-item' data-tags=''><a href='gettyimages-1782807205-612x612.jpg.php'><img src='gettyimages-1782807205-612x612.jpg' alt='gettyimages-1782807205-612x612.jpg'></a></div><div class='media-item' data-tags=''><a href='gettyimages-1806661467-612x612.jpg.php'><img src='gettyimages-1806661467-612x612.jpg' alt='gettyimages-1806661467-612x612.jpg'></a></div>
<?php } ?>
    </div>
<h2>Find Your Photos</h2>
<form action='../../../find_photos.php' method='post' enctype='multipart/form-data'>
    <input type='hidden' name='portfolio_id' value='7'>
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