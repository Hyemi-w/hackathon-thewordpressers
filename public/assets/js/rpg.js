
var map = new Map("map");

window.onload = function() {
	var canvas = document.getElementById('canvas');
	var ctx = canvas.getContext('2d');
	
	canvas.width  = map.getWidth() * 48;
	canvas.height = map.getHeight() * 48;

	map.drawMap(ctx);
}
