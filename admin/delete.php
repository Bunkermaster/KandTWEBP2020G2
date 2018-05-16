<?php
/**
 * Created by PhpStorm.
 * @author Yann Le Scouarnec <bunkermaster@gmail.com>
 * Date: 16/05/2018
 * Time: 10:49
 */
if (!isset($_GET['id'])) {
    header("Location: index.php?error=noeditdataposted");
    exit;
}
require_once "../includes/connection.php";
require_once "../includes/functions.php";
$sql = "SELECT 
  `id`, 
  `slug`
FROM
  `page`
WHERE 
  `id` = :id
;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $_GET['id']);
$stmt->execute();
handlePDOError($stmt);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false) {
    header("Location: index.php?error=nodatatoedit");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="index.php">&lt; Home!</a>
<form action="dodelete.php" method="post">
    <h1>Supprimer la page</h1>
    <h2><?=$row['slug']?></h2>
    <input type="hidden" name="page[id]" value="<?=$_GET['id']?>">
    <input type="submit" value="Supprimer!">
    <input type="button" value="Noooooooooo!" onclick="javascript: history.back()">
</form>
</body>
</html>