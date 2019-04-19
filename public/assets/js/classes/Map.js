function Map(nom) {
	// Création de l'objet XmlHttpRequest
	var xhr = getXMLHttpRequest();
		
	// Chargement du fichier
	xhr.open("GET", 'assets/maps/' + nom + '.json', false);
	xhr.send(null);
	if(xhr.readyState != 4 || (xhr.status != 200 && xhr.status != 0)) // Code == 0 en local
		throw new Error("Impossible de charger la carte nommée \"" + nom + "\" (code HTTP : " + xhr.status + ").");
	var mapJsonData = xhr.responseText;
	
	// Analyse des données
	var mapData = JSON.parse(mapJsonData);
	this.tileset = new Tileset(mapData.tileset);
	this.terrain = mapData.terrain;
}

// Pour récupérer la taille (en tiles) de la carte
Map.prototype.getHeight = function() {
	return this.terrain.length;
}
Map.prototype.getWidth = function() {
	return this.terrain[0].length;
}

Map.prototype.drawMap = function(context) {
	for(var i = 0, l = this.terrain.length ; i < l ; i++) {
		var line = this.terrain[i];
		var y = i * 48;
		for(var j = 0, k = line.length ; j < k ; j++) {
			this.tileset.drawTile(line[j], context, j * 48, y);
		}
	}
}















