<!DOCTYPE html>
<html lang="en">
<head>
    <title>Lab 5a Q1</title>
</head>
<body><br><br>
<?php

$name = "Muhammad Zulkifle bin Mohd Afandi";
$matric_number = "DI220049";
$course = "Bachelor of Computer Science (Web Technology) With Honours";
$year_of_study = "3nd Year";
$address = "PT 968, Taman Binaraya, Kota Bharu, Kelantan";
?>

<table border="1">
    <tr>
        <td><strong>Name</strong></td>
        <td><?php echo $name; ?></td>
    </tr>
    <tr>
        <td><strong>Matric Number</strong></td>
        <td><?php echo $matric_number; ?></td>
    </tr>
    <tr>
        <td><strong>Course</strong></td>
        <td><?php echo $course; ?></td>
    </tr>
    <tr>
        <td><strong>Year of Study</strong></td>
        <td><?php echo $year_of_study; ?></td>
    </tr>
    <tr>
        <td><strong>Address</strong></td>
        <td><?php echo $address; ?></td>
    </tr>
</table>

</body>
</html>
