function Tileset(url) {
	// Chargement de l'image dans l'attribut image
	this.image = new Image();
	this.image.referenceDuTileset = this;
	this.image.onload = function() {
		if(!this.complete) 
			throw new Error("Erreur de chargement du tileset nommé \"" + url + "\".");
		
		// Largeur du tileset en tiles
		this.referenceDuTileset.width = this.width / 48;
	}
	this.image.src = "assets/tilesets/" + url;
}

// Méthode de dessin du tile numéro "numero" dans le contexte 2D "context" aux coordonnées x et y
Tileset.prototype.drawTile = function(numero, context, xDestination, yDestination) {
	var xSourceEnTiles = numero % this.width;
	if(xSourceEnTiles == 0) xSourceEnTiles = this.width;
	var ySourceEnTiles = Math.ceil(numero / this.width);
	
	var xSource = (xSourceEnTiles - 1) * 48;
	var ySource = (ySourceEnTiles - 1) * 48;
	
	context.drawImage(this.image, xSource, ySource, 48, 48, xDestination, yDestination, 48, 48);
}
