
var map = new Map("map");

window.onload = function() {
	var canvas = document.getElementById('canvas');
	var ctx = canvas.getContext('2d');
	
	canvas.width  = map.getWidth() * 48;
	canvas.height = map.getHeight() * 48;

	map.drawMap(ctx);
}

window.onload = Construct();
var c;
var ctx;
var mouse = {
	x: 0,
	y: 0
};
var lastStep = 0;
var particles = [{
	x: 0,
	y: 0
}];

function Construct() {
	setTimeout(function() {
		c = document.getElementById("canvas");
		ctx = c.getContext("2d");
		c.addEventListener('mousemove', function(e) {
			var m = getMousePos(c, e);

			mouse.x = e.x;
			mouse.y = e.y;

			mouse.x -= c.offsetLeft;
			mouse.y -= c.offsetTop;

		}, false);

		window.requestAnimationFrame(animationFrame);
	}, 1);
}

function animationFrame(milliseconds) {
	var elapsed = milliseconds - lastStep;
	lastStep = milliseconds;

	render(elapsed);

	window.requestAnimationFrame(animationFrame);
}

function getMousePos(canvas, evt) {
	var rect = canvas.getBoundingClientRect();
	var mouseX = evt.clientX - rect.top;
	var mouseY = evt.clientY - rect.left;
	return {
		x: mouseX,
		y: mouseY
	};
}

function render(elapsed) {
	setCanvasSize();
	moveParticles(elapsed);
	clearCanvas();
	renderParticles();
}

function setCanvasSize() {
	ctx.canvas.width = window.innerWidth;
	ctx.canvas.height = window.innerHeight;
}

function clearCanvas() {
	map.drawMap(ctx);
}

function moveParticles(milliseconds) {
	particles.forEach(function(p) {
		var data = distanceAndAngleBetweenTwoPoints(p.x, p.y, mouse.x, mouse.y);
		var velocity = data.distance / 0.5;
		var toMouseVector = new Vector(velocity, data.angle);
		var elapsedSeconds = milliseconds / 1000;

		p.x += (toMouseVector.magnitudeX * elapsedSeconds);
		p.y += (toMouseVector.magnitudeY * elapsedSeconds);
	});
}

function renderParticles() {
	particles.forEach(function(p) {
		ctx.save();
		let image = new Image();
		image.src = 'assets/images/hero/hero.png';
		ctx.drawImage(image, p.x, p.y);
		ctx.beginPath();
		ctx.translate(p.x, p.y);
		ctx.fill();
		ctx.stroke();
		ctx.restore();
	});
}

function distanceAndAngleBetweenTwoPoints(x1, y1, x2, y2) {
	var x = x2 - x1,
		y = y2 - y1;

	return {
		// x^2 + y^2 = r^2
		distance: Math.sqrt(x * x + y * y),

		// convert from radians to degrees
		angle: Math.atan2(y, x) * 180 / Math.PI
	}
}

function Vector(magnitude, angle) {
	var angleRadians = (angle * Math.PI) / 180;

	this.magnitudeX = magnitude * Math.cos(angleRadians);
	this.magnitudeY = magnitude * Math.sin(angleRadians);
}

