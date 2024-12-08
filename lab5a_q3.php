<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lab 5a Q3</title>
</head>
<body><br><br>
<?php

function calculateArea($length, $width) {
    return $length * $width;
}

$length = 10; 
$width = 5;   
$area = calculateArea($length, $width); 

echo "the area of a rectangle with of $length and $width is $area ";

?>
</body>
</html>
