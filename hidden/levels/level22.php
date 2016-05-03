<?php include('session.php'); ?>
<html>
<head>
    <meta charset="utf-8" />
    <title>Gamedev Canvas Workshop</title>
    <style>
    	* { padding: 0; margin: 0; }
    	canvas { background: #eee; display: block; margin: 0 auto; cursor:none;}
    </style>
</head>
<body>
<button  onclick="setInterval(update,5);">start</button>

<canvas id="myCanvas" width="680" height="320"></canvas>
<p id="keycode"><p>
<script>
var canvas = document.getElementById("myCanvas");
var message = document.getElementById("keycode");
var ctx = canvas.getContext("2d");

var mouseX = canvas.width/2;
var mouseY = canvas.height/2;

var upPressed = false;
var downPressed = false;
var leftPressed = false;
var rightPressed = false;

var viewMaxX =  canvas.width;
var viewMaxY =  canvas.height; 
var viewMinX = 0;
var viewMinY =  0;

var boxX = 100;
var boxY = 100;
var boxHeight = 50;
var boxWidth = 50;



//**************PLAYER CLASS************
function Player(width, height, speed) {
        this.width = width;
        this.height = height;
        this.x = ((viewMaxX-viewMinX)/2) - (this.width/2);
        this.y = ((viewMaxY-viewMinY)/2) - (this.height/2);
	this.speed = speed;
        };

Player.prototype.draw = function () {
    ctx.beginPath();
    ctx.rect(getCanvasX(this.x), getCanvasY(this.y), this.width, this.height);
    ctx.fillStyle = "blue";
    ctx.fill();
    ctx.closePath();
}
//changes made here
/*
Player.prototype.setXY = function () {
        this.x = ((viewMaxX-viewMinX)/2) - (this.width/2);
        this.y = ((viewMaxY-viewMinY)/2) - (this.height/2);
	message.innerHTML = this.x + "x " + this.y + "y ";
}
*/
var player = new Player(20, 20, 1);
//PLAYER CODE ENDS HERE

//********PROJECTILE CLASS***********
function Projectile(){
	this.x = player.x+player.width/2;
	this.y = player.y-player.height/2;
	this.radius = 2.5;
        this.speed = 1.5;
//and here
	this.differenceY = getGameY(mouseY) - this.y ;
	this.differenceX = getGameX(mouseX) - this.x;
        this.angle = (Math.atan2(this.differenceY, this.differenceX))*(180/Math.PI);
        this.radians = this.angle * (Math.PI / 180);
        this.dx = (this.speed * Math.cos(this.radians));
        this.dy = (this.speed * Math.sin(this.radians));
        };

var projectiles = [];
function makeProjectile(){
	projectiles.push(new Projectile());
	//message.innerHTML = projectiles.length;
}
function getCanvasX(gameX){
	return gameX-viewMinX;
}
function getCanvasY(gameY, reindex){
onlyReindex = reindex || false;
//this also accounts for reindexing the 
if(onlyReindex){
	return (canvas.height-gameY);
}else{
	return (canvas.height-(gameY-viewMinY));
}
}

function drawProjectiles(){
	for(var i=0; i<projectiles.length; i++){
		projectiles[i].draw();
	}
}

Projectile.prototype.draw = function(){
	if(this.x < viewMaxX+this.radius && this.x > viewMinX-this.radius && this.y < viewMaxY + this.radius && this.y > viewMinY - this.radius){
    ctx.beginPath();
    ctx.arc(getCanvasX(this.x), getCanvasY(this.y), this.radius, 0, Math.PI*2);
    ctx.fillStyle = this.color;
    ctx.fill();
    ctx.closePath();
	}
};
//PROJECTILE ENDS HERE
//********CURSOR*********
function drawCursor(){
    ctx.beginPath();
    ctx.rect(mouseX -10, mouseY -10, 20, 20);
    ctx.fillStyle = "blue";
    ctx.fill();
    ctx.closePath();
}
//getGameXY
function getGameX(x){
	 return x + viewMinX;
}
function getGameY(y){
	 return ((canvas.height - y) + viewMinY);
}
function mouseMoveHandler(e) {
    mouseX = e.clientX - canvas.getBoundingClientRect().left;
    mouseY = e.clientY - canvas.getBoundingClientRect().top;
}
document.addEventListener("mousemove", mouseMoveHandler, false);
///MOUSE ENDS HERE

function move(){
	for(var i=0; i<projectiles.length; i++){
		projectiles[i].x +=projectiles[i].dx;
		projectiles[i].y +=projectiles[i].dy;
	}
}

function update(){
    ctx.clearRect(0, 0, canvas.width, canvas.height);
	move();
//	player.setXY();
	player.draw();
	viewUpdate();
	drawCursor();
	drawProjectiles();
	drawBox();
}


function viewUpdate(){
	if(rightPressed){
		viewMaxX += player.speed;
		viewMinX += player.speed;
		player.x += player.speed;
	}
	if(upPressed){
		viewMaxY += player.speed;
		viewMinY += player.speed;
		player.y += player.speed;
	}
	if(leftPressed){
		viewMaxX -= player.speed;
		viewMinX -= player.speed;
		player.x -= player.speed;
	}
	if(downPressed){
		viewMaxY -= player.speed;
		viewMinY -= player.speed;
		player.y -= player.speed;
	}
}

function drawBox() {
	if(boxX < viewMaxX && boxX > viewMinX && boxY < viewMaxY && boxY > viewMinY){
    ctx.beginPath();
    ctx.rect(getCanvasX(boxX), getCanvasY(boxY), boxWidth, boxHeight);
    ctx.fillStyle = "blue";
    ctx.fill();
    ctx.closePath();
	}
}
	
document.addEventListener("click", makeProjectile, false);
document.addEventListener("keydown", keydown, false);
document.addEventListener("keyup", keyup, false);
function keydown(e) {
	if(e.keyCode == 39){
		rightPressed = true;	
	}
	if(e.keyCode == 37){
		leftPressed = true;
	}
	if(e.keyCode == 38){
		upPressed = true;	
	}
	if(e.keyCode == 40){
		downPressed = true;
	}
	if(e.keyCode == 82){
		window.alert("restarting");
		document.location.reload();
		
	}
}
function keyup(e) {
	if(e.keyCode == 39){
		rightPressed = false;	
	}
	if(e.keyCode == 37){
		leftPressed = false;
	}
	if(e.keyCode == 38){
		upPressed = false;	
	}
	if(e.keyCode == 40){
		downPressed = false;
	}
}
</script>

</body>
</html>
<?php if ($_POST['answer'] == 'more'): ?>
<?php $_SESSION['correct'] = 'true'; ?>
<?php endif; ?>
