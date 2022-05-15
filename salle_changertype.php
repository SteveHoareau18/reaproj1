<?php
include('index.php');
$salle = $cnx->query("SELECT * FROM salle WHERE nomSalle='".$_GET['salle']."';")->fetchAll();
				if(empty($salle)){
					header("Location: index.php?salle=".$_GET['salle']);
				}
$salleInfo = $cnx->query("SELECT * FROM salle_info WHERE nomSalleInfo='".$_GET['salle']."';")->fetchAll();
if(!empty($salleInfo)){
	$cnx->exec("DELETE FROM salle_info WHERE nomSalleInfo='".$_GET['salle']."';");
	$cnx->exec("DELETE O FROM ordinateur O INNER JOIN ordinateur_prof OP WHERE idOrdi!=idOrdinateur AND nomSalle='".$_GET['salle']."';");
}else{
	$cnx->exec("INSERT INTO `salle_info`(`nomSalleInfo`, `capaciteOrdi`) VALUES ('".$_GET['salle']."','".$salle[0]['capaciteSalle']."')");
}
header("Location: index.php?salle=".$_GET['salle']);
?>