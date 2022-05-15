<?php
include("header.php");
?>	
<script>
	document.getElementById('title').innerHTML = "GestMob :: Supprimer";
</script>
    
    <?php

	//POST
	if(isset($_GET['chaise'])){
    echo "Index: ".$_GET['chaise']."<br>";
    echo $maSalle->getChaiseAt($_GET['chaise'])."<br>";
    
    $maSalle->getChaiseAt($_GET['chaise'])->dessiner();
    ?>
    <em>Voulez-vous vraiment supprimer la chaise?</em>
    <fieldset class="ui-grid-solo">
            <p><div class="ui-block-a"><button name="cmdYes" id="cmdYes" onclick="location.href='salle_supprimer.php?salle=<?php echo $_GET['salle']; ?>&chaise=<?php echo $_GET['chaise']; ?>&action=True'" value="Oui"></div></p>
			<div class="ui-block-a"><button name="cmdNo" id="cmdNo" onclick="location.href='salle_afficher.php?salle=<?php echo $_GET['salle']; ?>'" value="Non"></div>
	</fieldset>
<?php
	}
	if(isset($_GET['ordi'])){
		echo "Index: ".$_GET['ordi']."<br>";
		echo $maSalle->getOrdiAt($_GET['ordi'])."<br>";
		
		$maSalle->getOrdiAt($_GET['ordi'])->dessiner();
		?>
		<em>Voulez-vous vraiment supprimer l'ordinateur?</em>
		<fieldset class="ui-grid-solo">
				<p><div class="ui-block-a"><button name="cmdYes" id="cmdYes" onclick="location.href='salle_supprimer.php?salle=<?php echo $_GET['salle']; ?>&ordi=<?php echo $_GET['ordi']; ?>&action=True'" value="Oui"></div></p>
				<div class="ui-block-a"><button name="cmdNo" id="cmdNo" onclick="location.href='salle_afficher.php?salle=<?php echo $_GET['salle']; ?>'" value="Non"></div>
		</fieldset>
	<?php
		}
	if(isset($_GET['ordiProf'])){
		echo $maSalle->getOrdiProf()."<br>";
		
		$maSalle->getOrdiProf()->dessiner();
		?>
		<em>Voulez-vous vraiment supprimer l'ordinateur?</em>
		<fieldset class="ui-grid-solo">
				<p><div class="ui-block-a"><button name="cmdYes" id="cmdYes" onclick="location.href='salle_supprimer.php?salle=<?php echo $_GET['salle']; ?>&ordiProf=<?php echo $_GET['ordiProf']; ?>&action=True'" value="Oui"></div></p>
				<div class="ui-block-a"><button name="cmdNo" id="cmdNo" onclick="location.href='salle_afficher.php?salle=<?php echo $_GET['salle']; ?>'" value="Non"></div>
		</fieldset>
	<?php }
if(!empty($_GET['action'])){
    if($_GET['action']=="True"){
		if(isset($_GET['ordi'])){
			$monOrdi = $maSalle->getOrdiAt($_GET['ordi']);
			$cnx->exec("DELETE FROM ordinateur WHERE idOrdinateur='".$monOrdi->getIdOrdiBDD()."' AND nomSalle='".$_GET['salle']."';");
			header("Location: salle_afficher.php?salle=".$_GET['salle']);
		}else if(isset($_GET['ordiProf'])){
			$monOrdi = $maSalle->getOrdiProf();
			$cnx->exec("DELETE FROM ordinateur_prof WHERE idOrdi='".$monOrdi->getIdOrdiBDD()."';");
			if(!$maSalle->estSalleInfo()){
				$cnx->exec("DELETE FROM ordinateur WHERE idOrdinateur='".$monOrdi->getIdOrdiBDD()."';");
			}
			header("Location: salle_afficher.php?salle=".$_GET['salle']);
		}else{
			$maChaise = $maSalle->getChaiseAt($_GET['chaise']);
			$cnx->exec("DELETE FROM chaise WHERE idChaise='".$maChaise->getIdChaise()."' AND nomSalle='".$_GET['salle']."';");
			if(get_class($maChaise) == "ChaiseBureau"){
				$cnx->exec("DELETE FROM chaise_bureau WHERE idChaiseBureau='".$maChaise->getidChaiseBureau()."';");
			}
			header("Location: salle_afficher.php?salle=".$_GET['salle']);
		}
    }
}
?>