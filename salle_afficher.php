<?php
include("header.php");
?>	
<script>
	document.getElementById('title').innerHTML = "GestMob :: Afficher";
</script>
        <div align='center'>
			<?php
			$i = 0;
			foreach($maSalle->getMesChaises() as $chaise){
				$chaise->dessiner();
				?>
				<a href="salle_supprimer.php?salle=<?php echo $_GET['salle']; ?>&chaise=<?php echo $i; ?>"><img src="img/red_cross.png" height="18px" title="Supprimer"></a>
				<?php
				$i+=1;
			}
			echo "<hr>";
			if($maSalle->estSalleInfo()){
			$i = 0;
			foreach($maSalle->getMesOrdinateurs() as $ordi){
				$ordi->dessiner();
				?>
				<a href="salle_supprimer.php?salle=<?php echo $_GET['salle']; ?>&ordi=<?php echo $i; ?>"><img src="img/red_cross.png" height="18px" title="Supprimer"></a>
				<?php
				$i+=1;
			}
		}
			if($maSalle->getNbOrdiProf()){
				$maSalle->getOrdiProf()->dessiner();
				?>
				<a href="salle_supprimer.php?salle=<?php echo $_GET['salle']; ?>&ordiProf=<?php echo $i; ?>"><img src="img/red_cross.png" height="18px" title="Supprimer"></a>
				<?php
				$i+=1;
			}
			?>
        </div> 
        
		<fieldset class="ui-grid-solo">
			<p><div class="ui-block-a"><label for="salleInfo">Salle info?</label><input type="checkbox" name="salleInfo" id="salleInfo" onclick="location.href='salle_changertype.php?salle=<?php echo $maSalle->getNom(); ?>'"/></div></p>
			<script>
				document.getElementsByName('salleInfo')[0].checked = "<?php echo $maSalle->estSalleInfo(); ?>";
			</script>
            <p><div class="ui-block-a"><button name="cmdAjouter" id="cmdAjouter" onclick="location.href='salle_ajouter.php?salle=<?php echo $_GET['salle']?>'" value="Ajouter une chaise" /></div></p>
			<?php
			if($maSalle->getNbOrdiProf() == 0 or $maSalle->estSalleInfo()){
				?>
				<div class="ui-block-a"><button name="cmdAjouterOrdi" id="cmdAjouterOrdi" onclick="location.href='salle_ajouter_ordi.php?salle=<?php echo $_GET['salle']?>'" value="Ajouter un ordinateur" /></div></p>
				<?php
			}?>
				<p><div class="ui-block-b"><button name="cmdAccueil" onclick="location.href='index.php?salle=<?php echo $_GET['salle']; ?>'" id="cmdAccueil" value="Accueil" /></div></p>
        </fieldset>        
        
	</div>
	</body>
</html>







