<?php
/**
 * Created by PhpStorm.
 * @author Yann Le Scouarnec <bunkermaster@gmail.com>
 * Date: 16/05/2018
 * Time: 10:13
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
<h1><?=htmlspecialchars($row['title'])?></h1>
<a href="index.php">&lt; Home!</a>
<a href="edit.php?id=<?=$row['id']?>">Edit!</a> 
<a href="delete.php?id=<?=$row['id']?>">Supprimer!</a>

<h2>id</h2>
<p><?=htmlspecialchars($row['id'])?></p>
<h2>slug</h2>
<p><?=htmlspecialchars($row['slug'])?></p>
<h2>h1</h2>
<p><?=htmlspecialchars($row['h1'])?></p>
<h2>p</h2>
<p><?=nl2br(htmlspecialchars($row['p']))?></p>
<h2>span-class</h2>
<p><?=htmlspecialchars($row['span-class'])?></p>
<h2>span-text</h2>
<p><?=htmlspecialchars($row['span-text'])?></p>
<h2>img-alt</h2>
<p><?=htmlspecialchars($row['img-alt'])?></p>
<h2>img-src</h2>
<p><?=htmlspecialchars($row['img-src'])?></p>
<h2>nav-title</h2>
<p><?=htmlspecialchars($row['nav-title'])?></p>

</body>
</html>
