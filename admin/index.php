<?php
/**
 * Created by PhpStorm.
 * @author Yann Le Scouarnec <bunkermaster@gmail.com>
 * Date: 16/05/2018
 * Time: 09:12
 */

require_once "../includes/connection.php";
require_once "../includes/functions.php";
$sql = "SELECT 
  `id`, 
  `slug`, 
  `title` 
FROM 
  `page`
ORDER BY
  `id` DESC
;
";
$stmt = $pdo->prepare($sql);
$stmt->execute();
try {
    handlePDOError($stmt);
} catch(Exception $exception){
    die("Argh X_x");
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des pages</title>
</head>
<body>
<table>
    <tr>
        <th>id</th>
        <th>titre</th>
        <th>action</th>
    </tr>
    <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)):?>
    <tr>
        <td><a href="show.php?id=<?=$row['id']?>"><?=$row['id']?></a></td>
        <td><?=$row['title']?></td>
        <td>
            <a href="delete.php?id=<?=$row['id']?>">Delete</a>
            <a href="edit.php?id=<?=$row['id']?>">Edit</a>
        </td>
    </tr>
    <?php endwhile;?>
</table>
<h1>Ajouter</h1>
<form action="doadd.php" method="post">
    <label for="">Title</label><br><input type="text" name="page[title]" value=""><br>
    <label for="">slug</label><br><input type="text" name="page[slug]" value=""><br>
    <label for="">H1</label><br><input type="text" name="page[h1]" value=""><br>
    <label for="">Nav Title</label><br><input type="text" name="page[nav-title]" value=""><br>
    <label for="">P</label><br><textarea name="page[p]" id="" cols="30" rows="10"></textarea><br>
    <label for="">Span text</label><br><input type="text" name="page[span-text]" value=""><br>
    <label for="">Span class</label><br><input type="text" name="page[span-class]" value=""><br>
    <label for="">Alt text</label><br><input type="text" name="page[img-alt]" value=""><br>
    <label for="">File</label><br><input type="text" name="page[img-src]" value=""><br>
    <input type="submit" value="Ajouter">
</form>

</body>
</html>
