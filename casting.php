<?php
$x = 5;

$x_float = (float)$x;
$x_boolean = (bool)$x;
$x_array = (array)$x;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Casting Example</title>
</head>
<body>
    <h1>Casting converting</h1>

    <p>Original $x: <?php echo $x; ?></p>
    <p>$x as Float: <?php echo $x_float; ?></p>
    <p>$x as Boolean: <?php echo $x_boolean ? 'true' : 'false'; ?></p>
    <p>$x as Array: <?php echo '[' . implode(', ', $x_array) . ']'; ?></p>
</body>
</html>
