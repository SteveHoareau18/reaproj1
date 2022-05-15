<?php
include("header.php");
?>
        
	<fieldset class="ui-grid-solo">
			<p><div class="ui-block-a"><label for="salleInfo">Salle info?</label><input type="checkbox" name="salleInfo" id="salleInfo" onclick="location.href='salle_changertype.php?salle=<?php echo $maSalle->getNom(); ?>'"/></div></p>
			<script>
				console.log("<?php echo $maSalle->estSalleInfo(); ?>");
				document.getElementsByName('salleInfo')[0].checked = "<?php echo $maSalle->estSalleInfo(); ?>";
			</script>
            <p><div class="ui-block-a"><button name="cmdAjouter" id="cmdAjouter" onclick="location.href='salle_ajouter.php?salle=<?php echo $_GET['salle']?>'" value="Ajouter une chaise" /></div></p>
			<?php
			if($maSalle->getNbOrdiProf() == 0 or $maSalle->estSalleInfo()){
				?>
				<div class="ui-block-a"><button name="cmdAjouterOrdi" id="cmdAjouterOrdi" onclick="location.href='salle_ajouter_ordi.php?salle=<?php echo $_GET['salle']?>'" value="Ajouter un ordinateur" /></div></p>
				<?php
			}?>
			<div class="ui-block-a"><button name="cmdAfficher" id="cmdAfficher" onclick="location.href='salle_afficher.php?salle=<?php echo $_GET['salle']?>'" value="Afficher la salle" /></div>
	</fieldset>
	</div>
	</body>
</html>
<?php
//GET
if(isset($_GET['lstCouleur']) && isset($_GET['sldHauteur'])){
	$countChaise = ($cnx->query("SELECT MAX(idChaise) FROM `chaise`")->fetchAll()[0][0])+1; 
	$countChaiseBureau = ($cnx->query("SELECT MAX(idChaiseBureau) FROM `chaise_bureau`")->fetchAll()[0][0])+1; 
	$chaise = new Chaise($_GET['lstCouleur'],"",$_GET['sldHauteur'], $countChaise);
	$chaiseExiste = $cnx->query("SELECT idChaise FROM `chaise` WHERE idChaise = '".$countChaise."'")->fetchAll();
	if(!empty($chaiseExiste)){
		header("Location: index.php?salle=".$_GET['salle']);
	}
	$cnx->exec("INSERT INTO `chaise`(`idChaise`, `couleur`, `hauteur`, `image`, `nomSalle`) VALUES ('".$countChaise."','".$_GET['lstCouleur']."','".$_GET['sldHauteur']."','".$chaise->getImage()."','".$maSalle->getNom()."')");
	if($_GET['optType'] == "Bureau"){
		$chaiseParent = $cnx->query("SELECT idChaise FROM chaise WHERE couleur='".$_GET['lstCouleur']."' AND hauteur='".$_GET['sldHauteur']."' AND nomSalle='".$maSalle->getNom()."'")->fetchAll()[0];
		$chaise = new ChaiseBureau($_GET['lstCouleur'],"",$_GET['sldHauteur'],floatval($_GET['sldHauteur'])-1,1.5*$_GET['sldHauteur'],$countChaise,$countChaiseBureau);
		$cnx->exec("INSERT INTO `chaise_bureau`(`idChaiseBureau`,`hauteurMin`, `hauteurMax`, `idChaise`) VALUES ('".$countChaiseBureau."','".$chaise->getHauteurMin()."','".$chaise->getHauteurMax()."','".$chaiseParent[0]."')");
	}
	$maSalle->ajouter($chaise);
	
	header("Location: index.php?salle=".$_GET['salle']);
}else if(isset($_GET['optOrdiType']) && isset($_GET['lstOS'])){
	$countOrdi = ($cnx->query("SELECT MAX(idOrdinateur) FROM `ordinateur`")->fetchAll()[0][0])+1; 
	$countOrdiProf = ($cnx->query("SELECT MAX(idOrdinateurProf) FROM `ordinateur_prof`")->fetchAll()[0][0])+1; 
	$ordi = new Ordinateur("",$_GET['lstOS'], $countOrdi);
	$ordiExiste = $cnx->query("SELECT idOrdinateur FROM `ordinateur` WHERE idOrdinateur = '".$countOrdi."'")->fetchAll();
	if(!empty($ordiExiste)){
		header("Location: index.php?salle=".$_GET['salle']);
	}
	
	$cnx->exec("INSERT INTO `ordinateur`(`idOrdinateur`, `OS`, `image`, `nomSalle`) VALUES ('".$countOrdi."','".$_GET['lstOS']."','".$ordi->getImage()."','".$_GET['salle']."')");
	if($_GET['optOrdiType'] == "Professeur"){
		$ordiParent = $cnx->query("SELECT idOrdinateur FROM ordinateur WHERE nomSalle='".$maSalle->getNom()."'")->fetchAll()[0];
		$ordinateurProf = new OrdinateurProf("",$_GET['lstOS'],$countOrdi,$countOrdiProf);
		$cnx->exec("INSERT INTO `ordinateur_prof`(`idOrdinateurProf`, `idOrdi`) VALUES ('".$ordiParent[0]."','".$countOrdiProf."')");
		$maSalle->setOrdiProf($ordinateurProf);
	}else{
		$maSalle->ajouterOrdi($ordinateurProf);
	}
	
	header("Location: index.php?salle=".$_GET['salle']);
}

?>