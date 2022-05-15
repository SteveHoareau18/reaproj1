<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
require_once('lib/SalleInfo.class.php');
require_once('lib/ChaiseBureau.class.php');
require_once('lib/OrdinateurProf.class.php');
require_once('lib/outils/connexion.php');
require_once('lib/outils/connect.php');
$cnx = $connexion->getConnexion();
?>
<html>
	<?php include 'entete.html'; ?>
	<body>
	<div class='page'>
	<div data-role="header">
		<h1 id="title" align='center'>GestMob :: Menu</h1>
	</div>
    <p>
		
		<em>Actuellement dans la salle <b><?php
			if (empty($_GET)) {
				echo "<br>Salles disponibles: ";
				$salles = $cnx->query("SELECT nomSalle FROM salle;")->fetchAll();
				if(empty($salles)){
					die("Aucune salle disponible...");
				}
				foreach($salles as $salle){
				?>
				<p><div class="ui-block-a"><a href="?salle=<?php echo $salle['nomSalle']; ?>"><?php echo $salle['nomSalle']; ?></a></div></p>
				<?php
				}
				die();
			}else{
				$salle = $cnx->query("SELECT * FROM salle WHERE nomSalle='".$_GET['salle']."';")->fetchAll();
				if(empty($salle)){
					header("Location: index.php");
				}
				$salle = $cnx->query("SELECT * FROM salle WHERE nomSalle='".$_GET['salle']."';")->fetchAll()[0];
				$salleInfo = $cnx->query("SELECT * FROM salle_info WHERE nomSalleInfo='".$_GET['salle']."';")->fetchAll();
				if(!empty($salleInfo)){
					$maSalle = new SalleInfo($_GET['salle'], $salle['capaciteSalle'], $salleInfo[0]['capaciteOrdi']);
				}else{
					$maSalle = new Salle($_GET['salle'], $salle['capaciteSalle']);
				}
				
				$lesChaises = $cnx->query("SELECT * FROM chaise WHERE nomSalle='".$_GET['salle']."';")->fetchAll();
				foreach($lesChaises as $chaise){
					$instanceChaiseBureau = $cnx->query("SELECT chaise_bureau.* FROM chaise_bureau INNER JOIN chaise ON chaise.idChaise = chaise_bureau.idChaise WHERE chaise_bureau.idChaise='".$chaise['idChaise']."' AND nomSalle='".$_GET['salle']."';")->fetchAll();
					if(empty($instanceChaiseBureau)){
						$maSalle->ajouter(new Chaise($chaise['couleur'],$chaise['image'],$chaise['hauteur'],$chaise['idChaise']));
					}
				}
				$lesChaisesBureau = $cnx->query("SELECT chaise_bureau.* FROM chaise_bureau INNER JOIN chaise ON chaise.idChaise = chaise_bureau.idChaise WHERE nomSalle='".$_GET['salle']."';")->fetchAll();
				foreach($lesChaisesBureau as $chaise){
					$laChaise = $cnx->query("SELECT * FROM chaise WHERE idChaise='".$chaise['idChaise']."';")->fetchAll()[0];
					$maSalle->ajouter(new ChaiseBureau($laChaise['couleur'],$laChaise['image'],$laChaise['hauteur'],$chaise['hauteurMin'],$chaise['hauteurMax'],$chaise['idChaise'],$chaise['idChaiseBureau']));
				}
				
                if($maSalle->estSalleInfo()){
                    $lesOrdis = $cnx->query("SELECT * FROM ordinateur INNER JOIN ordinateur_prof ON idOrdi!=idOrdinateur WHERE nomSalle='".$_GET['salle']."';")->fetchAll();
                    foreach($lesOrdis as $ordi){
                        $maSalle->ajouterOrdi(new Ordinateur($ordi['image'],$ordi['OS'],$ordi['idOrdinateur']));
                    }
                }
				$ordiProf = $cnx->query("SELECT * FROM ordinateur_prof INNER JOIN ordinateur ON ordinateur.idOrdinateur = ordinateur_prof.idOrdi WHERE nomSalle='".$_GET['salle']."';")->fetchAll();
                if(!empty($ordiProf)) $maSalle->setOrdiProf(new OrdinateurProf($ordiProf[0]['image'],$ordiProf[0]['OS'],$ordiProf[0]['idOrdinateur'],$ordiProf[0]['idOrdinateurProf']));
				
			}
			echo $_GET['salle'];
		?></b> :</em>
		<ul>
		<li><b><?php echo $maSalle->getNbChaiseSimple() ?></b> chaise(s) simple(s)</li>
		<li><b><?php echo $maSalle->getNbChaiseBureau() ?></b> chaise(s) de bureau</li>
		<li><b><?php echo $maSalle->getNbOrdiProf() ?></b> ordinateur de professeur</li>
		<?php
			if($maSalle->estSalleInfo()){
				?>
				<li><b><?php echo $maSalle->getNbOrdinateurs() ?></b> ordinateur(s)</li>
				<?php
			}
		?>
		
		</ul>
		<?php
			if($maSalle->estSalleInfo()){
				?>
				<em>Capacité de la salle : </em><b><?php echo $maSalle->getCapaciteOrdi();?></b> ordinateurs
				<?php
			}
		?>
		<br><em>Capacité de la salle : </em><b><?php echo $maSalle->getCapacite();?></b> chaises
    </p>
	<hr/>	