var map = new Map("map");

window.onload = function() {
	var canvas = document.getElementById('canvas');
	var ctx = canvas.getContext('2d');
	
	canvas.width  = map.getLargeur() * 48;
	canvas.height = map.getHauteur() * 48;


	map.dessinerMap(ctx);
}
