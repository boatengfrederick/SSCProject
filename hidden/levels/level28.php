<?php include('session.php'); ?>
<html>


<head>
    <meta charset="utf-8" />
    <title>Gamedev Canvas Workshop</title>
    <style>
        * {
            padding: 0;
            margin: 0;
        }
        
        canvas {
            background: #eee;
            display: block;
            margin: 0 auto;
            cursor: none;
        }
    </style>
</head>

<body>
    <button onclick="setInterval(update,iterationTime);">start</button>

    <canvas id="myCanvas" width="980" height="420"></canvas>
    <p id="keycode">
        <p>
            <script>
//discover the word, make invisible bullet bariers
//locations are a sh*t show
//player good, now cursor and spitter
//Things are a little bit off center..... draw function problem
//*******CURSOR NOT MATCHIGN VIEWPORT
//TODO 
//make it so that bullets can check what object they belong to
//decide how you want to do different shots (entire new class, or just options?)
//if they differ in methods, they must be different class.maybe?I could just pass the method different things depending on what we want it to do, or nothign at all.
//same data, health speed, x,y different methods, fireOnspace or fireNearPlayer
//diff data though because health and speed are different things
//for a new gun all I need to do is make a different fire method that calls shot constructor with different parameters
//pass it the shooting function to assign?
								var iterationTime = 30;
                //canvas
                var canvas = document.getElementById("myCanvas");
          var message = document.getElementById("keycode");
                var ctx = canvas.getContext("2d");
                //mouse
								var mouseDown = false;
                //keyboard
                var upPressed = false;
                var downPressed = false;
                var leftPressed = false;
                var rightPressed = false;
                //viewport
                var viewMaxX = canvas.width;
                var viewMaxY = canvas.height;
                var viewMinX = 0;
                var viewMinY = 0;
                //rectangles
                var rectangle = new Rectangle(50, 50, 30, 30, "red");
                var rectangle2 = new Rectangle(100, 50, 30, 30, "green");
                var rectangle3 = new Rectangle(300, 50, 30, 30, "orange");
                var rectangle4 = new Rectangle(50, 200, 30, 30, "yellow");
                var rectangles = [rectangle, rectangle2, rectangle3, rectangle4];
//order is important!!!!!! some are defined based on others
								//cursor
								var cursor = new Cursor();
								var cursors = [cursor];
//make these the same class, like person, fighter? making classes in javascript is werid. You could have one class and just pass it different things to make entirely different objects with different methods

//basically difference between player and spitter is xy update and team also wouldnt have to look through whole array to find the one to update. or you could make a function that contains the one you found so you no longer search? I am getting so confused with classes
                //player
                var player = new Player(20, 20, 15, 1500);
                var players = [player];

                //spitters
                var spitter = new Spitter(40, 40, 40, 40);
                var spitters = [spitter];
								//maybe make it so that it check if it is an array? avoid this silly stuff
                //playershots
                var circleShots = [];
                //anything that has methods constantly invoked
                var instances = [rectangles, spitters, players, circleShots, cursors];
								//*******METHODS*********
//death methods
                function healthDie(containingArray) { return function(){
													if(this.health < 1){
															containingArray.splice(containingArray.indexOf(this), 1);
												}
										};
                }
								//CircleShot.prototype.isAlive = function(){distanceDie(this, circleShots);};
                function distanceDie(that){ 
									if(getDistance(that.startX, that.startY, that.x,that.y) > that.range){	
											that.storage.splice(that.storage.indexOf(that), 1);
										}
								}

                function timeDie(that){
									if(that.durationSeconds <0 ){	
											that.storage.splice(that.storage.indexOf(that), 1);
										}else{
											that.durationSeconds -= iterationTime/1000;
										}
                
									}
//fix this shitstorm******
//bounce methods
//current Problem here, art is drawn centered at position now rather than from lowerleft
//soo to be hit
function willHit(that, hitting){
						if(getDistance((that.x+that.dx), (that.y+that.dy), hitting.x, hitting.y) < 100){
return true;
}else{
return false;
}
}
								 function circleBounce(degree) {return function(){
										for (var j = 0; j < instances.length; j++) {
											if(instances[j].length >0){
														if (instances[j][0].solid == true) {

												for (var i = 0; i < instances[j].length; i++) {
																//checking will hit
if(willHit(this, instances[j][i]) && this.whose !== instances[j][i]){
																								this.angle += 180 ;
																//make a function that takes this/that and checks for width, or radius of both then checks if they are hitting and returns true/false. maybe include who it belongs to aswell
																/*if (this.x + this.dx < instances[j][i].x + /*like this*//*(instances[j][i].width/2) + this.radius && this.x + this.dx > instances[j][i].x - (instances[j][i].width/2) - this.radius && this.whose !== instances[j][i] ) {
//maybe a simple if statement passed two objects, checks if circle, or rectangle (width vs radius) then applys tests, and returns true or false
																		if (this.y + this.dy < instances[j][i].y + (instances[j][i].height/2) + this.radius && this.y + this.dy > instances[j][i].y -(instances[j][i].hieght/2)- this.radius) {
*/

/*
																				instances[j][i].health--;

																					
																				//is above or below currently
																				if (this.x < instances[j][i].x + instances[j][i].width + this.radius && this.x > instances[j][i].x - this.radius) {
																					if(degree == true){
																							this.angle*= -1;
																							}else{
																						this.dy *= -1;
																							}
																				}else///remove for allwoing corner shots
																				//is to the side currently
																				if (this.y < instances[j][i].y + instances[j][i].height + this.radius && this.y > instances[j][i].y - this.radius) {
																					if(degree == true){
																								this.angle = 180 -this.angle;
																							}else{
																						this.dx *= -1;
																							}
																				}
																					else

																					if(degree == true){
																								this.angle = 180 -this.angle;
																							this.angle*= -1;
																							}else{
																						this.dx *= -1;
																						this.dy *= -1;
																							}
}
																		}
*/
}
																}
}
														}
												}
}
}
//draw methods
                var drawRectangle = function() {
                    if (this.x < viewMaxX && this.x > viewMinX - this.width && this.y < viewMaxY && this.y > viewMinY - this.height) {
                        ctx.beginPath();
//look into why thses are not drawn at a minus width and heigt, be consistent
//123
                        ctx.rect(getCanvasX(this.x)-(this.width/2), getCanvasY(this.y)-(this.height/2), this.width, /*canvas....*/ this.height);
                        ctx.fillStyle = this.color || "purple";
                        ctx.fill();
                        ctx.closePath();
                    }
                }
/*
								var drawObject = function(){
															if(this.radius){}else{
                        ctx.beginPath();
//look into why thses are not drawn at a minus width and heigt, be consistent
//123
                        ctx.rect(getCanvas("x", this), getCanvas("y", this), 20, 20);
                        ctx.fillStyle = this.color || "purple";
                        ctx.fill();
                        ctx.closePath();
maube more confusion than good
						}
}
*/

                var drawSprite = function() {
                    if (this.x < viewMaxX && this.x > viewMinX - this.width && this.y < viewMaxY && this.y > viewMinY - this.height) {
                        ctx.beginPath();
                    		drawing = new Image();
                    		drawing.src = this.src;
                    		ctx.drawImage(drawing, getCanvasX(this.x) - (this.width/2), getCanvasY(this.y)-(this.height/2), this.width, this.height);
                        //ctx.drawImage(drawing, getCanvasX(this.x), getCanvasY(this.y), this.width, /*canvas....*/ -this.height);
                        ctx.closePath();
                    }
                }
                var drawCircle = function() {
                    if (this.x < viewMaxX + this.radius && this.x > viewMinX - this.radius && this.y < viewMaxY + this.radius && this.y > viewMinY - this.radius) {
                        ctx.beginPath();
                        ctx.arc(getCanvasX(this.x), getCanvasY(this.y), this.radius, 0, Math.PI * 2);
                        ctx.fillStyle = this.color || "red";
                        ctx.fill();
                        ctx.closePath();
                    }
                };
//firing methods
								function fireMouseDown(shotType, shotArray) { return function(){
									if(mouseDown){
                    shotArray.push(new shotType(this));
									}
                };}
								function fireAlways(shotType, shotArray) { return function(){
									if(true){
                    shotArray.push(new shotType(this));
									}
                };}
//warp methods
								function degreeWarp(amount){
										return function(){
											this.angle+=correctForInterval(amount);
										}
								}
//update methods
//avoid the bounceing back and forth when they want to go somewhere?? myabe its somewhat realistic
								function angleToDxDy(){	
										return function(){
                    this.radians = this.angle * (Math.PI / 180);
                    this.dx = (this.speed * Math.cos(this.radians));
                    this.dy = (this.speed * Math.sin(this.radians));
										}
								}
//tracking methods
							
function trackToObject(that, to, bounceRange){
			if( getDistance(that.x, that.y, to.x, to.y) >(bounceRange||100)){
								setDxDyToObject(that, to);
}}	
function trackToCursor(that, bounceRange){
			if( getDistance(that.x, that.y, cursor.x, cursor.y) >(bounceRange||100)){
								setDxDyToObject(that, cursor);
}}	
function getDistance(x1, y1, x2, y2) {
	var distance = Math.sqrt(Math.pow((y2-y1),2)+(Math.pow((x2-x1),2) ));
	return distance;
}
//maybe update have contant cursor tracking
function setDxDyToObject(that, to){
//fix cursor draw loaction so it uses 
//took out getGameBla here
                    that.differenceY = to.y - that.y;
                    that.differenceX = to.x - that.x;
                    that.angle = (Math.atan2(that.differenceY, that.differenceX)) * (180 / Math.PI);
                    that.radians = that.angle * (Math.PI / 180);
                    that.dx = (that.speed * Math.cos(that.radians));
                    that.dy = (that.speed * Math.sin(that.radians));
}

//move methods
/*
                function move() {
                            if ("dx" in this) {
                                this.x += instances[j][i].dx;
                                this.y += instances[j][i].dy;
                            }
                        }
I might regret having to put that method in every class as it is likely to be the same
*/
                //END METHODS HERE
                //**************PLAYER CLASS************
                function Player(width, height, speed, health, color) {
                    this.width = width;
										this.solid = true;
                    this.height = height;
										this.trackTarget = cursor;
                    this.x = ((viewMaxX - viewMinX) / 2) - (this.width / 2);
                    this.y = ((viewMaxY - viewMinY) / 2) - (this.height / 2);
                    this.speed = correctForInterval(speed);
                    this.health = health;
                    this.color = color;
                };

								Player.prototype.fire = fireMouseDown(CircleShot, circleShots);
                Player.prototype.draw = drawRectangle;
                Player.prototype.isAlive = healthDie(players);

                //PLAYER CODE ENDS HERE
                //**************Spitter CLASS************
                function Spitter(x, y, width, height, health, speed, color) {
                    this.x = x;
                    this.y = y;
										this.trackTarget = player;
                    this.width = width;
                    this.height = height;
                    this.solid = true;
                    this.health = health || 15000;
                    this.speed = correctForInterval(speed) || 0;
                    this.color = color || "green";
                    this.reload = 0;
                };

//								Spitter.prototype.fire = fireMouseDown(CircleShot, circleShots);
								Spitter.prototype.fire = fireAlways(CircleShot, circleShots);
                Spitter.prototype.isAlive = healthDie(spitters); 
                Spitter.prototype.draw = drawRectangle;
								//Spitter.prototype.fire = fireAtPlayer(SpitterBullet, spitterBullets);


                //SPITTER CODE ENDS HERE

                //********CIRCLE SHOT CLASS***********
                function CircleShot(whose) {
										this.whose = whose;//like player1 object, or spitter one object, then calls the xy wy of that for the bullet x y
                    this.x = whose.x;
                    this.y = whose.y;
										this.storage = circleShots;
										this.trackTarget = whose.trackTarget;
										this.still = false;
										//	console.log(whose);
										
										this.startX = this.x;
										this.startY = this.y;
										this.range = 1000;
										this.durationSeconds = 5;
										this.color = whose.color;
										
                    this.radius = 2.5;
                    this.speed = correctForInterval(25);
                    //and here
//problem here
										setDxDyToObject(this, whose.trackTarget);
//make this section just dx = getDxToCursor(this);
/*
                    this.differenceY = getGameY(cursor.y) - this.y;
                    this.differenceX = getGameX(cursor.x) - this.x;
                    this.angle = (Math.atan2(this.differenceY, this.differenceX)) * (180 / Math.PI);
                    this.radians = this.angle * (Math.PI / 180);
                    this.dx = (this.speed * Math.cos(this.radians));
                    this.dy = (this.speed * Math.sin(this.radians));
*/
                }
										//Test.prototype.testmethod = function(){testfunc(this);};
								CircleShot.prototype.isAlive = function(){distanceDie(this);timeDie(this);};
                CircleShot.prototype.bounce = circleBounce(true);
                CircleShot.prototype.draw = drawCircle;
								//CircleShot.prototype.warp = degreeWarp(80);
								CircleShot.prototype.update = angleToDxDy();
								CircleShot.prototype.track = function(){trackToObject(this, this.trackTarget, 100);};
                //PROJECTILE ENDS HERE
								function testfunc(that){
												//console.log(that.num);
												console.log("hey");
								}
								var test2 = new Test2();
								var test1 = new Test();
								function Test2(){
											this.other = test1;
								}
								function Test(){
										this.num = 3;
										Test.prototype.testmethod = function(){testfunc(this);};
								}
								//console.log(test2.other.num);
                //*****RectangleClass*********
                function Rectangle(x, y, width, height, color, health) {
                    this.x = x;
                    this.y = y;
                    this.solid = true;
                    this.width = width;
                    this.height = height;
                    this.color = color || "blue";
                    this.health = health || 100;
                }
                Rectangle.prototype.draw = drawRectangle;
                Rectangle.prototype.isAlive = healthDie(rectangles); 


                //RECTANGLE ENDS HERE
                //********CURSOR CLASS*********
                function Cursor() {
										this.x = 100;
										this.y = 100;
										this.height = 20;
										this.width = 20;
                    this.src = "/images/crossheirs.png"
                }
										Cursor.prototype.draw = drawSprite;
								//END CURSOR HERE

                function mouseMoveHandler(e) {
                    cursor.x = getGameX(e.clientX - canvas.getBoundingClientRect().left);
                    cursor.y = getGameY(e.clientY - canvas.getBoundingClientRect().top);
                }
                document.addEventListener("mousemove", mouseMoveHandler, false);
                ///MOUSE ENDS HERE
//no need to put in the classes themselves, just buff it up here
                function move() {
                    for (var j = 0; j < instances.length; j++) {
                        for (var i = 0; i < instances[j].length; i++) {
													
                            //if it has movement
                            if ("dx" in instances[j][i]) {
                                instances[j][i].x += instances[j][i].dx;
                                instances[j][i].y += instances[j][i].dy;
													}	
                            }
                        }
                    }

                function update() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
//oh so debating making move a method for all
										viewUpdate();
										["isAlive", "fire", "draw", "track", "bounce",/*set angle to dxdy*/ "update",  "warp"].map(invokeOnInstances);
                    move();
                }

                function invokeOnInstances(method) {
                    for (var i = 0; i < instances.length; i++) {
                        for (var j = 0; j < instances[i].length; j++) {
                            if (instances[i][j][method] && typeof instances[i][j][method] === "function") {
                                instances[i][j][method]();
                            };
                        }
                    }
                }

                function viewUpdate() {
                    if (rightPressed) {
                        viewMaxX += player.speed;
                        viewMinX += player.speed;
                        player.x += player.speed;
												cursor.x += player.speed;
                    }
                    if (upPressed) {
                        viewMaxY += player.speed;
                        viewMinY += player.speed;
                        player.y += player.speed;
												cursor.y += player.speed;
                    }
                    if (leftPressed) {
                        viewMaxX -= player.speed;
                        viewMinX -= player.speed;
                        player.x -= player.speed;
												cursor.x -= player.speed;
                    }
                    if (downPressed) {
                        viewMaxY -= player.speed;
                        viewMinY -= player.speed;
                        player.y -= player.speed;
												cursor.y -= player.speed;
                    }
                }
//*******UTILITY FUNCTIONS*******
function getDistance(x1, y1, x2, y2) {
	return Math.sqrt(Math.pow((y2-y1),2)+(Math.pow((x2-x1),2) ));
}
/*
function setDxDyToObject(that, to){
									seennconsole.log(to);
                    that.differenceY = getGameY(to.y) - that.y;
                    that.differenceX = getGameX(to.x) - that.x;
                    that.angle = (Math.atan2(that.differenceY, that.differenceX)) * (180 / Math.PI);
                    that.radians = that.angle * (Math.PI / 180);
                    that.dx = (that.speed * Math.cos(that.radians));
                    that.dy = (that.speed * Math.sin(that.radians));
}
*/
								function correctForInterval(x){
											return (iterationTime/100)* x;
								}
                function getGameX(x) {
                    return x + viewMinX;
                }

                function getGameY(y) {
                    return ((canvas.height - y) + viewMinY);
                }

								function getCanvas(){}
                function getCanvasX(gameX) {
                    return gameX - viewMinX;
                }

                function getCanvasY(gameY, reindex) {
                    onlyReindex = reindex || false;
                    if (onlyReindex) {
                        return (canvas.height - gameY);
                    } else {
                        return (canvas.height - (gameY - viewMinY));
                    }
                }
//END UTILITY FUNCTIONS HERE
                function mouseDownHandler() {
										mouseDown = true;
                }
								function mouseUpHandler(){
										mouseDown = false;
								}
                document.addEventListener("mousedown", mouseDownHandler, false);
                document.addEventListener("mouseup", mouseUpHandler, false);
                document.addEventListener("keydown", keydown, false);
                document.addEventListener("keyup", keyup, false);

                function keydown(e) {
                    if (e.keyCode == 68) {
                        rightPressed = true;
                    }
                    if (e.keyCode == 65) {
                        leftPressed = true;
                    }
                    if (e.keyCode == 87) {
                        upPressed = true;
                    }
                    if (e.keyCode == 83) {
                        downPressed = true;
                    }
                    if (e.keyCode == 82) {
                        window.alert("restarting");
                        document.location.reload();

                    }
                }

                function keyup(e) {
                    if (e.keyCode == 68) {
                        rightPressed = false;
                    }
                    if (e.keyCode == 65) {
                        leftPressed = false;
                    }
                    if (e.keyCode == 87) {
                        upPressed = false;
                    }
                    if (e.keyCode == 83) {
                        downPressed = false;
                    }
}
</script>

</body>
</html>
<?php if ($_POST['answer'] == 'more'): ?>
<?php $_SESSION['correct'] = 'true'; ?>
<?php endif; ?>
