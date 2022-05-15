<?php
include("header.php");
?>	
<script>
	document.getElementById('title').innerHTML = "GestMob :: Ajouter";
</script>
	<form method="get" action="index.php?salle=<?php echo $_GET['salle'] ?>" name="formSalle">
	
            <fieldset data-role="controlgroup" data-type="horizontal">
                <legend>Type de chaise :</legend>	
                <input name="optType" id="optTypeSimple" value="Simple" checked="checked" type="radio">
                <label for="optTypeSimple">Simple</label>
                <input name="optType" id="optTypeBureau" value="Bureau" type="radio">
                <label for="optTypeBureau">Bureau</label>
            </fieldset>

            <label for="sldHauteur">Hauteur :</label>
            <input name="sldHauteur" id="sldHauteur" min="40" max="60" value="50" type="range" width='70%'>

            <div data-role="fieldcontain">
                    <label for="lstCouleur">Couleur:</label>
                    <select name="lstCouleur" id="lstCouleur">
                            <option value="rouge" selected="selected">Rouge</option>
                            <option value="verte">Vert</option>
                            <option value="bleue">Bleu</option>
                    </select>
            </div>			
            <fieldset class="ui-grid-a">
                <div class="ui-block-a"><input name="cmdAjouter" type="submit" id="cmdAjouter" value="Ajouter la chaise" /></div>
                <div class="ui-block-b"><button name="cmdAccueil" onclick="location.href='index.php?salle=<?php echo $_GET['salle']; ?>'" id="cmdAccueil" value="Accueil" /></div>
            </fieldset>
	</form> 
	</div>
	</body>
</html>
