<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Media Gallery - 9</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .single-focus { display: flex; flex-direction: column; align-items: center; }
        .single-focus img, .single-focus video { width: 80%; max-width: 800px; height: auto; object-fit: cover; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); margin-bottom: 20px; }
        .single-focus img { transition: transform 0.2s ease-in-out; }
        .single-focus img:hover { transform: scale(1.05); }
        .carousel { display: flex; overflow-x: auto; gap: 10px; justify-content: center; }
        .carousel img, .carousel video { width: 150px; height: 150px; object-fit: cover; cursor: pointer; flex: 0 0 auto; }
        .carousel img:hover, .carousel video:hover { border: 2px solid #007BFF; }
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
<h1>Media Gallery - 9</h1>
<div class='filter'>
    <label for='tag-filter'>Filter by tag:</label>
    <select id='tag-filter' onchange='filterMedia()'>
        <option value=''>All</option>;

<?php  foreach ($tags as $tag) {?>
<option value='<?php echo $tag?>'><?php echo $tag?></option>;
<?php }?></select>
</div>


    <div class='single-focus'>
        <div id='main-media'><a href='55927-lakshya-sen.jpg.php'><img src='55927-lakshya-sen.jpg' id='main-image' alt='55927-lakshya-sen.jpg'></a></div>
        <div class='carousel'>
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
            ?><img src='55927-lakshya-sen.jpg' alt='55927-lakshya-sen.jpg' onclick='changeImage("55927-lakshya-sen.jpg")'><img src='5iKc9469dOuq_7MDPgaF2aMLo_1440x960.jpg' alt='5iKc9469dOuq_7MDPgaF2aMLo_1440x960.jpg' onclick='changeImage("5iKc9469dOuq_7MDPgaF2aMLo_1440x960.jpg")'><img src='AP24213656982606-1-2024-08-9b24f4b4cce1c06012a5f30c91511608.jpg' alt='AP24213656982606-1-2024-08-9b24f4b4cce1c06012a5f30c91511608.jpg' onclick='changeImage("AP24213656982606-1-2024-08-9b24f4b4cce1c06012a5f30c91511608.jpg")'><img src='EMPOWERING MOMENTS 310724 OLYMPICS.jpg' alt='EMPOWERING MOMENTS 310724 OLYMPICS.jpg' onclick='changeImage("EMPOWERING MOMENTS 310724 OLYMPICS.jpg")'><img src='FLQQEY45XJKWFLZ74NHSESKAQI.jpg' alt='FLQQEY45XJKWFLZ74NHSESKAQI.jpg' onclick='changeImage("FLQQEY45XJKWFLZ74NHSESKAQI.jpg")'><img src='SEI215856459.jpg' alt='SEI215856459.jpg' onclick='changeImage("SEI215856459.jpg")'><img src='indian-hockey-team-defeat-great-britan-paris-olympics-2024_202408782624.jpg' alt='indian-hockey-team-defeat-great-britan-paris-olympics-2024_202408782624.jpg' onclick='changeImage("indian-hockey-team-defeat-great-britan-paris-olympics-2024_202408782624.jpg")'><img src='lugapskt1zdoxbgpw6uf.jpg' alt='lugapskt1zdoxbgpw6uf.jpg' onclick='changeImage("lugapskt1zdoxbgpw6uf.jpg")'><img src='download.jpeg' alt='download.jpeg' onclick='changeImage("download.jpeg")'>
    </div>
    <?php } ?>
    </div>
    <h2>Find Your Photos</h2>
    <form action='../../../find_photos.php' method='post' enctype='multipart/form-data'>
        <input type='hidden' name='portfolio_id' value='9'>
        <div class='form-group'>
            <label for='userPhoto'>Upload Your Photo:</label>
            <input type='file' name='userPhoto' id='userPhoto' accept='image/*' required>
        </div>
        <div class='form-group'>
            <input type='submit' name='submit' value='Find Photos'>
        </div>
    </form>
    <script>
        function changeImage(src) {
            document.getElementById('main-image').src = src;
        }

        function filterMedia() {
            const selectedTag = document.getElementById('tag-filter').value.toLowerCase();
            const mediaItems = document.querySelectorAll('.carousel img');

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