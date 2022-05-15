<?php
include("header.php");
?>	
<script>
	document.getElementById('title').innerHTML = "GestMob :: Ajouter";
</script>
	<form method="get" action="index.php?salle=<?php echo $_GET['salle'] ?>" name="formSalle">
	
            <fieldset data-role="controlgroup" data-type="horizontal">
                <legend>Type d'ordinateur :</legend>	
                <?php 
                if($maSalle->estSalleInfo()){
                ?>
                <input name="optOrdiType" id="optTypeSimple" value="Simple" checked="checked" type="radio">
                <label for="optTypeSimple">Simple</label>
                
                <?php
                 }
                    if($maSalle->getNbOrdiProf() == 0){
                        
                ?>
                <input name="optOrdiType" id="optTypeProf" value="Professeur" checked="checked" type="radio">
                <label for="optTypeProf">Professeur</label>
                <?php
                    }
                ?>
            </fieldset>

                <div data-role="fieldcontain">
                        <label for="lstOS">OS:</label>
                        <select name="lstOS" id="lstOS">
                                <option value="Windows7" selected="selected">Windows 7</option>
                                <option value="Windows10">Windows 10</option>
                                <option value="Linux">Linux</option>
                                <option value="iOS">iOS</option>
                        </select>
                </div>		
            
            <fieldset class="ui-grid-a">
                <div class="ui-block-a"><input name="cmdAjouterOrdi" type="submit" id="cmdAjouterOrdi" value="Ajouter l'ordinateur" /></div>
                <div class="ui-block-b"><button name="cmdAccueil" onclick="location.href='index.php?salle=<?php echo $_GET['salle']; ?>'" id="cmdAccueil" value="Accueil" /></div>
            </fieldset>
	</form> 
	</div>
	</body>
</html>
