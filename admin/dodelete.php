<?php
/**
 * Created by PhpStorm.
 * @author Yann Le Scouarnec <bunkermaster@gmail.com>
 * Date: 16/05/2018
 * Time: 10:49
 */
if (!isset($_POST['page'])) {
    header("Location: admin/index.php");
    exit;
}
require_once "../includes/connection.php";
require_once "../includes/functions.php";
$page = $_POST['page'];
$sql = "DELETE FROM 
  `page` 
WHERE 
  `id` = :id
;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $page['id']);
$stmt->execute();
handlePDOError($stmt);
header("Location: index.php");


