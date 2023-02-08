<?php
include_once "autoload.php";
use Maze\Maze;
$maze = new Maze(10,10);
$maze->generate();
var_dump($maze->toArray());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
  <!-- <div><img src="img/maze2.svg#p0" alt=""></div> -->
  <!-- <object data="img/maze2.svg#p0" type=""></object>   -->
</body>
</html>