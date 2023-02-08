<?php
if (!isset($_GET['securite'])) {
  header('location:https://google.ca');
  die;
}
if (isset($_GET['bob'])) {
  $bob = $_GET['bob'];
  var_dump('Bob is in the house... C\'est '.$bob.'');
} else {
  $bob = 'Anonyme';
}


// include_once "autoload.php";
// use Maze\Maze;
// $maze = new Maze(100,100);
// $maze->generate();
// var_dump($_GET['joueur']);
// var_dump($_GET['plateau']);
// // var_dump($_GET['pos']);
// var_dump(array_key_exists('pos', $_GET));
// var_dump(isset($_GET['pos']));
// var_dump($maze->toArray());
// $bob = 10;
// var_dump(isset($bob));
// var_dump(isset($bill));
// if (isset($bob)) {
//   var_dump($bob);
// } else {
//   var_dump('La variable n\'existe pas');
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      table {
        border-collapse: collapse;
      }
      th {
        padding: 0;
      }
      img {
        display: block;
        width: 32px;
        height: 32px;
      }
    </style>
</head>
<body>
  <form action="" method="get">
    <div>
      <label for="bob">Qui est Bob ?</label>
      <span>
        <input 
          type="text" 
          id="bob" 
          name="bob" 
          value="<?php echo $bob; ?>"/>
    </span>
    </div>
    <div><button>Identifier Bob</button></div>
  </form>
  <div><a href="?bob=vrai">Faire entrer BOB</a></div>
  <table>
    <tr>
      <th><img src="img/maze3.svg#p6" alt=""></th>
      <th><img src="img/maze3.svg#p14" alt=""></th>
      <th><img src="img/maze3.svg#p8" alt=""></th>
    </tr>
    <tr>
      <th><img src="img/maze3.svg#p5" alt=""></th>
      <th><img src="img/maze3.svg#p1" alt=""></th>
      <th><img src="img/maze3.svg#p4" alt=""></th>
    </tr>
    <tr>
      <th><img src="img/maze3.svg#p3" alt=""></th>
      <th><img src="img/maze3.svg#p10" alt=""></th>
      <th><img src="img/maze3.svg#p9" alt=""></th>
    </tr>
  </table>
  <!-- <div><img src="img/maze2.svg#p0" alt=""></div> -->
  <!-- <object data="img/maze2.svg#p0" type=""></object>   -->
</body>
</html>