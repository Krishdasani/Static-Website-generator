<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'server.php';
$id =  $_POST['portfolio_id'];
$user = $_COOKIE['user_id'];
$target_dir = $user .'/'. $id.'/'.$id.'/';
$uploadpath = $target_dir;
$target_file = $target_dir . $_FILES['userPhoto']['name'];

$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$extensions_arr = array("jpg", "jpeg");

if (in_array($imageFileType, $extensions_arr)) {
    $temp = explode(".", $_FILES["userPhoto"]["name"]);
    $newfilename = 'search.' . end($temp);
   

    $move = move_uploaded_file($_FILES['userPhoto']['tmp_name'], $target_dir . $newfilename);
    if ($move) {
        // echo 'Upload success in ' . $uploadpath;
    } else {
        echo "Failure in $uploadpath";
    }
}

$command = 'python3 face_recognition_script.py ' . escapeshellarg($target_dir) . ' 2>&1';
$output = shell_exec($command);
if ($output !== null) {
    $matches = array_filter(explode(PHP_EOL, trim($output)));
    $matches_query = urlencode(json_encode($matches));
 header("location:$target_dir/index.php?output=$matches_query");
} else {
    echo 'Unable to execute the Python code';
}
?>
