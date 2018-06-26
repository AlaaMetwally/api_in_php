<?php
$query = $_POST['query'];
define("DB_HOST", "localhost");
define("DB_NAME", "socialapi");
define("DB_USER", "root");
define("DB_PASSWORD", "root");
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$found='';
$name = $query["name"];
$email = $query["email"];
$image= $query["image"];
$picture = file_get_contents($image);
$pic=__DIR__ . '/uploads/' . time() . '.png';
$sql = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($conn,$sql) or die("Error: ".mysqli_error($conn));
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    if($row){
        $found=$row;
    }
}
if(!$found){
file_put_contents($pic, $picture);
$query = "INSERT INTO `user` VALUES ('$name','$email','$pic')";
$data = mysqli_query($conn, $query)or die(mysqli_error($conn));
}
else{
$sql = "SELECT image FROM user WHERE email = '$email'";
$result = mysqli_query($conn,$sql) or die("Error: ".mysqli_error($conn));
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
unlink($row["image"]);
file_put_contents($pic, $picture);
file_put_contents($pic, $picture);
$db="UPDATE `user` SET `name`='{$name}',`image`='{$pic}' WHERE `email`='{$email}'";
$data = mysqli_query($conn, $db)or die(mysqli_error($conn));
}

?>
