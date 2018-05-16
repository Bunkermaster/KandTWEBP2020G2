<?php
/**
 * Created by PhpStorm.
 * @author Yann Le Scouarnec <bunkermaster@gmail.com>
 * Date: 16/05/2018
 * Time: 09:12
 */
if (!isset($_POST['page'])) {
    header("Location: admin/index.php");
    exit;
}
require_once "../includes/connection.php";
require_once "../includes/functions.php";
$page = $_POST['page'];
$sql = "INSERT INTO `page`(
  `slug`,
  `title`,
  `h1`,
  `p`,
  `span-class`,
  `span-text`,
  `img-alt`,
  `img-src`,
  `nav-title`
)
VALUES(
  :slug,
  :title,
  :h1,
  :p,
  :spanclass,
  :spantext,
  :imgalt,
  :imgsrc,
  :navtitle
);";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':slug', $page['slug']);
$stmt->bindValue(':title', $page['title']);
$stmt->bindValue(':h1', $page['h1']);
$stmt->bindValue(':p', $page['p']);
$stmt->bindValue(':spanclass', $page['span-class']);
$stmt->bindValue(':spantext', $page['span-text']);
$stmt->bindValue(':imgalt', $page['img-alt']);
$stmt->bindValue(':imgsrc', $page['img-src']);
$stmt->bindValue(':navtitle', $page['nav-title']);
$stmt->execute();
handlePDOError($stmt);
header("Location: index.php");
