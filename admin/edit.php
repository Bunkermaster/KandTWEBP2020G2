<?php
/**
 * Created by PhpStorm.
 * @author Yann Le Scouarnec <bunkermaster@gmail.com>
 * Date: 16/05/2018
 * Time: 09:49
 */
if (!isset($_GET['id'])) {
    header("Location: index.php?error=noidtoedit");
    exit;
}
require_once "../includes/connection.php";
require_once "../includes/functions.php";
$sql = "SELECT 
  `id`, 
  `slug`,
  `title`,
  `h1`,
  `p`,
  `span-class`,
  `span-text`,
  `img-alt`,
  `img-src`,
  `nav-title`
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
<form action="doedit.php" method="post">
    <input type="hidden" name="page[id]" value="<?=$row["id"]?>">
    <label for="">Title</label><br><input type="text" name="page[title]" value="<?=$row["title"]?>"><br>
    <label for="">slug</label><br><input type="text" name="page[slug]" value="<?=$row["slug"]?>"><br>
    <label for="">H1</label><br><input type="text" name="page[h1]" value="<?=$row["h1"]?>"><br>
    <label for="">Nav Title</label><br><input type="text" name="page[nav-title]" value="<?=$row["nav-title"]?>"><br>
    <label for="">P</label><br><textarea name="page[p]" id="" cols="30" rows="10"><?=$row["p"]?></textarea><br>
    <label for="">Span text</label><br><input type="text" name="page[span-text]" value="<?=$row["span-text"]?>"><br>
    <label for="">Span class</label><br><input type="text" name="page[span-class]" value="<?=$row["span-class"]?>"><br>
    <label for="">Alt text</label><br><input type="text" name="page[img-alt]" value="<?=$row["img-alt"]?>"><br>
    <label for="">File</label><br><input type="text" name="page[img-src]" value="<?=$row["img-src"]?>"><br>
    <input type="submit" value="Modifier">
</form>
</body>
</html>
