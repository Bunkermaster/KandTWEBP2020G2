<?php
/**
 * Created by PhpStorm.
 * @author Yann Le Scouarnec <bunkermaster@gmail.com>
 * Date: 16/05/2018
 * Time: 10:00
 */
if (!isset($_POST['page'])) {
    header("Location: index.php?error=noeditdataposted");
    exit;
}
require_once "../includes/connection.php";
require_once "../includes/functions.php";
$page = $_POST['page'];
$sql = "UPDATE
  `page`
SET
  `slug`= :slug,
  `title` = :title,
  `h1` = :h1,
  `p` = :p,
  `span-class` = :spanclass,
  `span-text` = :spantext,
  `img-alt` = :imgalt,
  `img-src` = :imgsrc,
  `nav-title` = :navtitle
WHERE
`id` = :id
;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', htmlspecialchars($page['id']), PDO::PARAM_INT);
$stmt->bindValue(':slug', htmlspecialchars($page['slug']));
$stmt->bindValue(':title', htmlspecialchars($page['title']));
$stmt->bindValue(':h1', htmlspecialchars($page['h1']));
$stmt->bindValue(':p', htmlspecialchars($page['p']));
$stmt->bindValue(':spanclass', htmlspecialchars($page['span-class']));
$stmt->bindValue(':spantext', htmlspecialchars($page['span-text']));
$stmt->bindValue(':imgalt', htmlspecialchars($page['img-alt']));
$stmt->bindValue(':imgsrc', htmlspecialchars($page['img-src']));
$stmt->bindValue(':navtitle', htmlspecialchars($page['nav-title']));
$stmt->execute();
handlePDOError($stmt);
header("Location: index.php");
