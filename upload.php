<?php
if (isset($_POST['submit'])) {
    if (isset($_COOKIE['user_id'])) {
        $userid = $_COOKIE['user_id'];
        $file = $_FILES['file'];
        $cover = $_FILES['cover'];
        $description = $_POST['Description'];
        $name = preg_replace('/[^a-zA-Z0-9_-]/', '', trim($_POST['name']));
        $layout = $_POST['layout'];
        include 'server.php';

        $insertQuery = "INSERT INTO portfolio (userid, name, description) VALUES ('$userid', '$name', '$description')";
        mysqli_query($conn, $insertQuery);

        $last_id = mysqli_insert_id($conn);
        $fetchQuery = "SELECT * FROM portfolio WHERE portfolio_id = $last_id";
        $result = mysqli_query($conn, $fetchQuery);
        $latestData = mysqli_fetch_assoc($result);
        $id = $latestData['portfolio_id'];

        $fileType = mime_content_type($file['tmp_name']);
        if ($fileType !== 'application/zip') {
            echo "Please upload a valid ZIP file.";
            exit;
        }

        $uploadDir = $userid . '/' . $id . '/';
        $tempExtractDir = $userid . '/temp_' . $id . '/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        if (!is_dir($tempExtractDir)) {
            mkdir($tempExtractDir, 0755, true);
        }

        $uploadFilePath = $tempExtractDir . basename($file['name']);
        if (!move_uploaded_file($file['tmp_name'], $uploadFilePath)) {
            echo "Failed to upload the file.";
            exit;
        }

        $zip = new ZipArchive;
        if ($zip->open($uploadFilePath) === TRUE) {
            $zip->extractTo($tempExtractDir);
            $zip->close();
            echo "File uploaded and extracted successfully.";
            header("location:dashboard/index.php");
            $extractedFolderName = '';
            $extractedItems = scandir($tempExtractDir);
            foreach ($extractedItems as $item) {
                if ($item !== '.' && $item !== '..' && is_dir($tempExtractDir . $item)) {
                    $extractedFolderName = $item;
                    break;
                }
            }

            rename($tempExtractDir . $extractedFolderName, $uploadDir . $id);

            $coverPath = $uploadDir . $id . '/cover.jpg';
            $coverDB = $id . '/' . $id . '/cover.jpg';
            mysqli_query($conn, "UPDATE `portfolio` SET `image_path`='$coverDB' WHERE portfolio_id = '$id'");
            if (!move_uploaded_file($cover['tmp_name'], $coverPath)) {
                echo "Failed to upload the cover photo.";
            }

            createWebPages($uploadDir . $id . '/', $id, $conn, $layout);

            deleteDirectory($tempExtractDir);
        } else {
            echo "Failed to unzip the file.";
        }

        if (file_exists($uploadFilePath)) {
            unlink($uploadFilePath);
        }
    }
} else {
    echo "No file uploaded.";
}

function createWebPages($directory, $folderName, $conn, $layout) {
    $mediaFiles = glob($directory . "*.{jpg,jpeg,png,gif,mp4,avi,mov}", GLOB_BRACE);

    foreach ($mediaFiles as $media) {
        $mediaName = basename($media);
        if ($mediaName == 'cover.jpg') continue;
        $mediaType = mime_content_type($media);
        $userid = $_COOKIE['user_id'];
        $mediaPath = $folderName . '/' . $folderName.'/'.$mediaName;
        mysqli_query($conn, "INSERT INTO images (userid, portfolio_id, name, description, path) VALUES ('$userid', '$folderName', '$mediaName', '', '$mediaName')");
        $lastInsertedId = mysqli_insert_id($conn);
        $mediaFileName = pathinfo($mediaName, PATHINFO_FILENAME);

        // Generating individual media page
        $individualHtml = "<?php
            \$conn = new mysqli('devweb2023.cis.strath.ac.uk', 'tmb23194', 'Eihu5na6ongo', 'tmb23194');
            if (\$conn->connect_error) {
                die('Connection failed: ' . \$conn->connect_error);
            }

            \$fetchMedia = \"SELECT * FROM images WHERE id = '$lastInsertedId'\";
            \$result = mysqli_query(\$conn, \$fetchMedia);
            \$mediaData = mysqli_fetch_assoc(\$result);

            if (\$mediaData) {
                \$mediaPath = \$mediaData['path'];
                \$mediaType = mime_content_type(\$mediaPath);
                \$mediaName = \$mediaData['name'];
                \$mediaElement = '';
                if (strpos(\$mediaType, 'video') !== false) {
                    \$mediaElement = \"<video src='\$mediaName' alt='\$mediaName' controls></video>\";
                } else {
                    \$mediaElement = \"<img src='\$mediaName' alt='\$mediaName'>\";
                }

                echo \"<!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <title>\$mediaName</title>
                </head>
                <body>
                    <h1>\$mediaName</h1>
                    \$mediaElement
                    <p>Description: {\$mediaData['description']}</p>
                    <p><a href='index.php'>Back to Gallery</a></p>
                </body>
                </html>\";
            } else {
                echo \"Media not found.\";
            }
        ?>";

        file_put_contents($directory . $mediaName . ".php", $individualHtml);
    }

    

    if ($layout == 'grid') {
        $indexHtml = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Media Gallery - $folderName</title>
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
    \$conn = new mysqli('devweb2023.cis.strath.ac.uk', 'tmb23194', 'Eihu5na6ongo', 'tmb23194');
    if (\$conn->connect_error) {
        die('Connection failed: ' . \$conn->connect_error);
    }
    \$tagsResult = mysqli_query(\$conn, \"SELECT DISTINCT Tag FROM Tags WHERE user_id = '\$_COOKIE[user_id]'\");
    \$tags = [];
    while (\$row = mysqli_fetch_assoc(\$tagsResult)) {
        \$tags[] = \$row['Tag'];
    }
    \$tagsResult = mysqli_query(\$conn, \"SELECT DISTINCT Tag FROM Tags WHERE user_id = '\$_COOKIE[user_id]'\");
    \$tags = [];
    while (\$row = mysqli_fetch_assoc(\$tagsResult)) {
        \$tags[] = \$row['Tag'];
    }
    ?>
    <h1>Media Gallery - $folderName</h1>
    <div class='filter'>
        <label for='tag-filter'>Filter by tag:</label>
        <select id='tag-filter' onchange='filterMedia()'>
            <option value=''>All</option>;

   <?php  foreach (\$tags as \$tag) {?>
    <option value='<?php echo \$tag?>'><?php echo \$tag?></option>;
   <?php }?>";
    $indexHtml .= "</select>
    </div>
    <div class='grid' id='media-grid'>
    <?php
        if(isset(\$_GET['output'])) {
            \$matched_files = json_decode(urldecode(\$_GET['output']), true);
            if (is_array(\$matched_files)) {
                foreach (\$matched_files as \$match) {
                    echo \"<div class='media-item' data-tags=''><a href='{\$match}.php'><img src='{\$match}' alt='{\$match}'></a></div>\";
                }
            } else {
                echo '<p>No matches found.</p>';
            }
        } else {
            ?>
    ";

    foreach ($mediaFiles as $media) { 
        $mediaName = basename($media);
        if ($mediaName == 'cover.jpg') continue;
        $mediaPath = $folderName . '/' . $folderName . '/' . $mediaName;
        $mediaIdQuery = mysqli_query($conn, "SELECT id FROM images WHERE name = '$mediaName' and portfolio_id ='$folderName'");
        $mediaIdRow = mysqli_fetch_assoc($mediaIdQuery);
        $mediaId = $mediaIdRow['id'];
        $indexHtml .= "<?php
        \$tagsQuery = mysqli_query(\$conn, \"SELECT Tag FROM Tags WHERE image_id = '$mediaId'\");
        \$mediaTags = [];
        while (\$tagRow = mysqli_fetch_assoc(\$tagsQuery)) {
            \$mediaTags[] = \$tagRow['Tag'];
        }
        \$tagList = implode(' ', \$mediaTags);?>";
        $indexHtml .= "<div class='media-item' data-tags='<?php echo \$tagList?>'><a href='$mediaName.php'><img src='$mediaName' alt='$mediaName'></a></div>";
    }
    $indexHtml .= "
    <?php
        }
        ?>
    </div>
<h2>Find Your Photos</h2>
<form action='../../../find_photos.php' method='post' enctype='multipart/form-data'>
<input type='hidden' name='portfolio_id' value='$folderName'>
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
</html>";
}
if ($layout == 'masonry') {
    $indexHtml = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Media Gallery - $folderName</title>
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
\$conn = new mysqli('devweb2023.cis.strath.ac.uk', 'tmb23194', 'Eihu5na6ongo', 'tmb23194');
if (\$conn->connect_error) {
    die('Connection failed: ' . \$conn->connect_error);
}
\$tagsResult = mysqli_query(\$conn, \"SELECT DISTINCT Tag FROM Tags WHERE user_id = '\$_COOKIE[user_id]'\");
\$tags = [];
while (\$row = mysqli_fetch_assoc(\$tagsResult)) {
    \$tags[] = \$row['Tag'];
}
\$tagsResult = mysqli_query(\$conn, \"SELECT DISTINCT Tag FROM Tags WHERE user_id = '\$_COOKIE[user_id]'\");
\$tags = [];
while (\$row = mysqli_fetch_assoc(\$tagsResult)) {
    \$tags[] = \$row['Tag'];
}
?>
<h1>Media Gallery - $folderName</h1>
<div class='filter'>
    <label for='tag-filter'>Filter by tag:</label>
    <select id='tag-filter' onchange='filterMedia()'>
        <option value=''>All</option>;

<?php  foreach (\$tags as \$tag) {?>
<option value='<?php echo \$tag?>'><?php echo \$tag?></option>;
<?php }?>";
$indexHtml .= "</select>
</div>
<div class='masonry' id='media-grid'>
<?php
    if(isset(\$_GET['output'])) {
        \$matched_files = json_decode(urldecode(\$_GET['output']), true);
        if (is_array(\$matched_files)) {
            foreach (\$matched_files as \$match) {
                echo \"<div class='media-item' data-tags=''><a href='{\$match}.php'><img src='{\$match}' alt='{\$match}'></a></div>\";
            }
        } else {
            echo '<p>No matches found.</p>';
        }
    } else {
        ?>
";

    foreach ($mediaFiles as $media) {
        $mediaName = basename($media);
        if ($mediaName == 'cover.jpg') continue;
        $mediaPath = $folderName . '/' . $folderName . '/' . $mediaName;
        $mediaIdQuery = mysqli_query($conn, "SELECT id FROM images WHERE name = '$mediaName' and portfolio_id ='$folderName'");
        $mediaIdRow = mysqli_fetch_assoc($mediaIdQuery);
        $mediaId = $mediaIdRow['id'];
        $tagsQuery = mysqli_query($conn, "SELECT Tag FROM Tags WHERE image_id = '$mediaId'");
        $mediaTags = [];
        while ($tagRow = mysqli_fetch_assoc($tagsQuery)) {
            $mediaTags[] = $tagRow['Tag'];
        }
        $tagList = implode(' ', $mediaTags);
        $indexHtml .= "<div class='media-item' data-tags='$tagList'><a href='$mediaName.php'><img src='$mediaName' alt='$mediaName'></a></div>";
    }

    $indexHtml .= "
<?php } ?>
    </div>
<h2>Find Your Photos</h2>
<form action='../../../find_photos.php' method='post' enctype='multipart/form-data'>
    <input type='hidden' name='portfolio_id' value='$folderName'>
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
</html>";
}
elseif ($layout == 'single') {
    $indexHtml = "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Media Gallery - $folderName</title>
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
\$conn = new mysqli('devweb2023.cis.strath.ac.uk', 'tmb23194', 'Eihu5na6ongo', 'tmb23194');
if (\$conn->connect_error) {
    die('Connection failed: ' . \$conn->connect_error);
}
\$tagsResult = mysqli_query(\$conn, \"SELECT DISTINCT Tag FROM Tags WHERE user_id = '\$_COOKIE[user_id]'\");
\$tags = [];
while (\$row = mysqli_fetch_assoc(\$tagsResult)) {
    \$tags[] = \$row['Tag'];
}
\$tagsResult = mysqli_query(\$conn, \"SELECT DISTINCT Tag FROM Tags WHERE user_id = '\$_COOKIE[user_id]'\");
\$tags = [];
while (\$row = mysqli_fetch_assoc(\$tagsResult)) {
    \$tags[] = \$row['Tag'];
}
?>
<h1>Media Gallery - $folderName</h1>
<div class='filter'>
    <label for='tag-filter'>Filter by tag:</label>
    <select id='tag-filter' onchange='filterMedia()'>
        <option value=''>All</option>;

<?php  foreach (\$tags as \$tag) {?>
<option value='<?php echo \$tag?>'><?php echo \$tag?></option>;
<?php }?>";
$indexHtml .= "</select>
</div>


    <div class='single-focus'>
        <div id='main-media'>";

    $mainMedia = $mediaFiles[0];
    $mainMediaName = basename($mainMedia);
    $mainMediaPath = $folderName . '/' . $folderName . '/' . $mainMediaName;
    $indexHtml .= "<a href='$mainMediaName.php'><img src='$mainMediaName' id='main-image' alt='$mainMediaName'></a>";

    $indexHtml .= "</div>
        <div class='carousel'>
        <?php
        if(isset(\$_GET['output'])) {
            \$matched_files = json_decode(urldecode(\$_GET['output']), true);
            if (is_array(\$matched_files)) {
                foreach (\$matched_files as \$match) {
                    echo \"<div class='media-item' data-tags=''><a href='{\$match}.php'><img src='{\$match}' alt='{\$match}'></a></div>\";
                }
            } else {
                echo '<p>No matches found.</p>';
            }
        } else {
            ?>";
    foreach ($mediaFiles as $media) {
        $mediaName = basename($media);
        if ($mediaName == 'cover.jpg') continue;
        $mediaPath = $folderName . '/' . $folderName . '/' . $mediaName;

        $indexHtml .= "<img src='$mediaName' alt='$mediaName' onclick='changeImage(\"$mediaName\")'>";
    }

    $indexHtml .= "
    </div>
    <?php } ?>
    </div>
    <h2>Find Your Photos</h2>
    <form action='../../../find_photos.php' method='post' enctype='multipart/form-data'>
        <input type='hidden' name='portfolio_id' value='$folderName'>
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
</html>";
}
            
            file_put_contents($directory . "index.php", $indexHtml);
            }
            
            function deleteDirectory($tempExtractDir) {
            if (!file_exists($tempExtractDir)) {
                return false;
            }
            
            if (!is_dir($tempExtractDir)) {
                return unlink($tempExtractDir);
            }
            
            $items = array_diff(scandir($tempExtractDir), ['.', '..']);
            foreach ($items as $item) {
                $path = $tempExtractDir . DIRECTORY_SEPARATOR . $item;
                is_dir($path) ? deleteDirectory($path) : unlink($path);
            }
            
            return rmdir($tempExtractDir);
            }
            ?>
            
