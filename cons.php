<?php

$title = "Using Constants in PHP";


define("MESSAGE", "ULK is best private learning institutions in Rwanda.");


function ulk() {
    return MESSAGE;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
</head>
<body>
    <h1><?php echo $title; ?></h1>
    <p><?php echo ulk(); ?></p>
</body>
</html>
