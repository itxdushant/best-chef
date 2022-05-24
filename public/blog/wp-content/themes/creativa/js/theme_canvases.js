/*
 * Canvases
 */
(function($) {

	// animations:
	// - bouncyPolygons (color)
	// - metaBalls (color)

	function creativa_animatedCanvas() {
		$('.animated-canvas').each(function(){
			var canvasAnimation = $(this).attr('data-animation'),
				canvasSelector = $(this)[0];

			if (canvasAnimation == 'metaBalls' ) {
				var animColor = $(this).attr('data-color'),
					ballsCount = $(this).attr('data-balls-count');
				
				// metaBalls 
				var ge1doot = ge1doot || {
				
					screen: {
						elem:     null,
						callback: null,
						ctx:      null,
						width:    $(this).width(),
						height:   $(this).height(),
						left:     0,
						top:      0,
						init: function (id, callback, initRes) {
							this.elem = canvasSelector;
							this.callback = callback || null;
							this.ctx = this.elem.getContext("2d");
							window.addEventListener('resize', function () {
								this.resize();
							}.bind(this), false);
							this.elem.onselectstart = function () { return false; }
							this.elem.ondrag        = function () { return false; }
							initRes && this.resize();
							return this;
						},
						resize: function () {
							var o = this.elem;
							this.width  = o.offsetWidth;
							this.height = o.offsetHeight;
							for (this.left = 0, this.top = 0; o != null; o = o.offsetParent) {
								this.left += o.offsetLeft;
								this.top  += o.offsetTop;
							}
							if (this.ctx) {
								this.elem.width  = this.width;
								this.elem.height = this.height;
							}
							this.callback && this.callback();
						},
						pointer: {
							screen:   null,
							elem:     null,
							callback: null,
							pos:   {x:0, y:0},
							mov:   {x:0, y:0},
							drag:  {x:0, y:0},
							start: {x:0, y:0},
							end:   {x:0, y:0},
							active: false,
							touch: false,
							down: function (e, touch) {
								this.touch = touch;
								// e.preventDefault();
								var pointer = touch ? e.touches[0] : e;
								(!touch && document.setCapture) && document.setCapture();
								this.pos.x = this.start.x = pointer.clientX - this.screen.left;
								this.pos.y = this.start.y = pointer.clientY - this.screen.top;
								this.active = true;
								this.callback.down && this.callback.down();
							},
							up: function (e, touch) {
								this.touch = touch;
								// e.preventDefault();
								(!touch && document.releaseCapture) && document.releaseCapture();
								this.end.x = this.drag.x;
								this.end.y = this.drag.y;
								this.active = false;
								this.callback.up && this.callback.up();
							},
							move: function (e, touch) {
								this.touch = touch;
								// e.preventDefault();
								var pointer = touch ? e.touches[0] : e;
								this.mov.x = pointer.clientX - this.screen.left;
								this.mov.y = pointer.clientY - this.screen.top;
								if (this.active) {
									this.pos.x = this.mov.x;
									this.pos.y = this.mov.y;
									this.drag.x = this.end.x - (this.pos.x - this.start.x);
									this.drag.y = this.end.y - (this.pos.y - this.start.y);
									this.callback.move && this.callback.move();
								}
							},
							init: function (callback) {
								this.screen = ge1doot.screen;
								this.elem = this.screen.elem;
								this.callback = callback || {};
								if ('ontouchstart' in window) {
									// touch
									this.elem.ontouchstart  = function (e) { this.down(e, true); }.bind(this);
									this.elem.ontouchmove   = function (e) { this.move(e, true); }.bind(this);
									this.elem.ontouchend    = function (e) { this.up(e, true);   }.bind(this);
									this.elem.ontouchcancel = function (e) { this.up(e, true);   }.bind(this);
								}
								// mouse
								document.addEventListener("mousedown", function (e) { this.down(e, false); }.bind(this), true);
								document.addEventListener("mousemove", function (e) { this.move(e, false); }.bind(this), true);
								document.addEventListener("mouseup",   function (e) { this.up  (e, false); }.bind(this), true);
								return this;
							}
						},
						loadImages: function (container) {
							var elem = document.getElementById(container),
							canvas = canvasSelector,
							init = false, complete = false,
							n = document.images.length;
							function arc(color, val, r) {
								ctx.beginPath();
								ctx.moveTo(50,50);
								ctx.arc(50, 50, r, 0, val);
								ctx.fillStyle = color;
								ctx.fill();
								ctx.closePath();
							}
							function load () {
								if (complete) {
									canvas.style.display = "none";
									return;
								}
								var m = 0, timer = 32;
								for(var i = 0; i < n; i++) m += (document.images[i].complete)?1:0;
								if (m < n) {
									if (!init) {
										init = true;
										canvas.style.width = canvas.style.height = "100px";
										canvas.width = canvas.height = 100;
										canvas.style.position = "fixed";
										canvas.style.left = canvas.style.top = "50%";
										canvas.style.marginTop = canvas.style.marginLeft = "-50px";
										canvas.style.zIndex = 10000;
										ctx = canvas.getContext("2d");
										arc('rgb(64,64,64)', Math.PI*2, 48);
										elem.appendChild(canvas);
									}
									arc('rgb(255,255,255)', (m / n) * 2 * Math.PI, 50);
								} else {
									if (init) {
										arc('rgb(255,255,255)', 2 * Math.PI, 50);
										timer = 300;
									}
									complete = true;
								}
								setTimeout(load, timer);
							}
							setTimeout(load, 32);
						}
					}
				}

				! function()
				{
					"use strict";
					var lava0, lava1;
					// ==== Point constructor ====
					var Point = function(x, y)
					{
						this.x = x;
						this.y = y;
						this.magnitude = x * x + y * y;
						this.computed = 0;
						this.force = 0;
					}
					Point.prototype.add = function(p)
					{
						return new Point(this.x + p.x, this.y + p.y);
					}
					// ==== Ball constructor ====
					var Ball = function(parent)
					{
						this.vel = new Point(
							(Math.random() > 0.5 ? 1 : -1) * (0.2 + Math.random() * 0.25), (Math.random() > 0.5 ? 1 : -1) * (0.2 + Math.random() * 1)
						);
						this.pos = new Point(
							parent.width * 0.2 + Math.random() * parent.width * 0.6,
							parent.height * 0.2 + Math.random() * parent.height * 0.6
						);
						this.size = (parent.wh / 10) + Math.random() * (parent.wh / 10);
						this.width = parent.width;
						this.height = parent.height;
					}
					// ==== move balls ====
					Ball.prototype.move = function()
					{
						// ---- interact with pointer ----
						// if (pointer.active)
						// {
						// 	var dx = pointer.pos.x - this.pos.x;
						// 	var dy = pointer.pos.y - this.pos.y;
						// 	var a = Math.atan2(dy, dx);
						// 	var v = -Math.min(
						// 		10,
						// 		500 / Math.sqrt(dx * dx + dy * dy)
						// 	);
						// 	this.pos = this.pos.add(
						// 		new Point(
						// 			Math.cos(a) * v,
						// 			Math.sin(a) * v
						// 		)
						// 	);
						// }
						// ---- bounce borders ----
						if (this.pos.x >= this.width - this.size)
						{
							if (this.vel.x > 0) this.vel.x = -this.vel.x;
							this.pos.x = this.width - this.size;
						}
						else if (this.pos.x <= this.size)
						{
							if (this.vel.x < 0) this.vel.x = -this.vel.x;
							this.pos.x = this.size;
						}
						if (this.pos.y >= this.height - this.size)
						{
							if (this.vel.y > 0) this.vel.y = -this.vel.y;
							this.pos.y = this.height - this.size;
						}
						else if (this.pos.y <= this.size)
						{
							if (this.vel.y < 0) this.vel.y = -this.vel.y;
							this.pos.y = this.size;
						}
						// ---- velocity ----
						this.pos = this.pos.add(this.vel);
					}
					// ==== lavalamp constructor ====
					var LavaLamp = function(width, height, numBalls, c0, c1)
					{
						this.step = 5;
						this.width = width;
						this.height = height;
						this.wh = Math.min(width, height);
						this.sx = Math.floor(this.width / this.step);
						this.sy = Math.floor(this.height / this.step);
						this.paint = false;
						this.metaFill = createRadialGradient(width, height, width, c0, c1);
						this.plx = [0, 0, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, 0, 0];
						this.ply = [0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 1, 1, 0, 1, 0, 1];
						this.mscases = [0, 3, 0, 3, 1, 3, 0, 3, 2, 2, 0, 2, 1, 1, 0];
						this.ix = [1, 0, -1, 0, 0, 1, 0, -1, -1, 0, 1, 0, 0, 1, 1, 0, 0, 0, 1, 1];
						this.grid = [];
						this.balls = [];
						this.iter = 0;
						this.sign = 1;
						// ---- init grid ----
						for (var i = 0; i < (this.sx + 2) * (this.sy + 2); i++)
						{
							this.grid[i] = new Point(
								(i % (this.sx + 2)) * this.step, (Math.floor(i / (this.sx + 2))) * this.step
							)
						}
						// ---- create metaballs ----
						for (var i = 0; i < numBalls; i++)
						{
							this.balls[i] = new Ball(this);
						}
					}
					// ==== compute cell force ====
					LavaLamp.prototype.computeForce = function(x, y, idx)
					{
						var force;
						var id = idx || x + y * (this.sx + 2);
						if (x === 0 || y === 0 || x === this.sx || y === this.sy)
						{
							var force = 0.6 * this.sign;
						}
						else
						{
							var cell = this.grid[id];
							var force = 0;
							var i = 0,
								ball;
							while (ball = this.balls[i++])
							{
								force += ball.size * ball.size / (-2 * cell.x * ball.pos.x - 2 * cell.y * ball.pos.y + ball.pos.magnitude + cell.magnitude);
							}
							force *= this.sign
						}
						this.grid[id].force = force;
						return force;
					}
					// ---- compute cell ----
					LavaLamp.prototype.marchingSquares = function(next)
					{
						var x = next[0];
						var y = next[1];
						var pdir = next[2];
						var id = x + y * (this.sx + 2);
						if (this.grid[id].computed === this.iter) return false;
						var dir, mscase = 0;
						// ---- neighbors force ----
						for (var i = 0; i < 4; i++)
						{
							var idn = (x + this.ix[i + 12]) + (y + this.ix[i + 16]) * (this.sx + 2);
							var force = this.grid[idn].force;
							if ((force > 0 && this.sign < 0) || (force < 0 && this.sign > 0) || !force)
							{
								// ---- compute force if not in buffer ----
								force = this.computeForce(
									x + this.ix[i + 12],
									y + this.ix[i + 16],
									idn
								);
							}
							if (Math.abs(force) > 1) mscase += Math.pow(2, i);
						}
						if (mscase === 15)
						{
							// --- inside ---
							return [x, y - 1, false];
						}
						else
						{
							// ---- ambiguous cases ----
							if (mscase === 5) dir = (pdir === 2) ? 3 : 1;
							else if (mscase === 10) dir = (pdir === 3) ? 0 : 2;
							else
							{
								// ---- lookup ----
								dir = this.mscases[mscase];
								this.grid[id].computed = this.iter;
							}
							// ---- draw line ----
							var ix = this.step / (
								Math.abs(Math.abs(this.grid[(x + this.plx[4 * dir + 2]) + (y + this.ply[4 * dir + 2]) * (this.sx + 2)].force) - 1) /
								Math.abs(Math.abs(this.grid[(x + this.plx[4 * dir + 3]) + (y + this.ply[4 * dir + 3]) * (this.sx + 2)].force) - 1) + 1
							);
							ctx.lineTo(
								this.grid[(x + this.plx[4 * dir + 0]) + (y + this.ply[4 * dir + 0]) * (this.sx + 2)].x + this.ix[dir] * ix,
								this.grid[(x + this.plx[4 * dir + 1]) + (y + this.ply[4 * dir + 1]) * (this.sx + 2)].y + this.ix[dir + 4] * ix
							);
							this.paint = true;
							// ---- next ----
							return [
								x + this.ix[dir + 4],
								y + this.ix[dir + 8],
								dir
							];
						}
					}
					LavaLamp.prototype.renderMetaballs = function()
					{
						var i = 0,
							ball;
						while (ball = this.balls[i++]) ball.move();
						// ---- reset grid ----
						this.iter++;
						this.sign = -this.sign;
						this.paint = false;
						ctx.fillStyle = this.metaFill;
						ctx.beginPath();
						// ---- compute metaballs ----
						i = 0;
						ctx.shadowBlur = 0;
						ctx.shadowColor = "black";
						while (ball = this.balls[i++])
						{
							// ---- first cell ----
							var next = [
								Math.round(ball.pos.x / this.step),
								Math.round(ball.pos.y / this.step), false
							];
							// ---- marching squares ----
							do {
								next = this.marchingSquares(next);
							} while (next);
							// ---- fill and close path ----
							if (this.paint)
							{
								ctx.fill();
								ctx.closePath();
								ctx.beginPath();
								this.paint = false;
							}
						}
					}
					// ---- gradients ----
					var createRadialGradient = function(w, h, r, c0, c1)
					{
						var gradient = ctx.createRadialGradient(
							w / 2, h / 2, 0,
							w / 2, h / 2, r
						);
						gradient.addColorStop(0, c0);
						gradient.addColorStop(1, c1);
						return gradient;
					}
					// ==== main loop ====
					var run = function()
					{
						requestAnimationFrame(run);
						ctx.clearRect(0, 0, screen.width, screen.height);
						lava0.renderMetaballs();
						// lava1.renderMetaballs();
					}
					// ---- canvas ----
					var screen = ge1doot.screen.init("canvas", null, true),
						ctx = screen.ctx;
						// pointer = screen.pointer.init();
					screen.resize();
					// ---- create LavaLamps ----
					lava0 = new LavaLamp(screen.width, screen.height, ballsCount, animColor, animColor);
					// ---- start engine ----
					run();
				}();

			} // metaBalls END

			else if (canvasAnimation == 'bouncyPolygons') {
				var animColor = $(this).attr('data-color'),
					polysCount = $(this).attr('data-balls-count');

				// bouncyPolygons
				Object.getOwnPropertyNames(Math).map(function(p) {
				  window[p] = Math[p];
				});

				var rand = function(max, min, is_int) {
				  var max = (max - 1 || 0) + 1, 
				      min = min || 0, 
				      gen = min + (max - min)*random();
				  
				  return (is_int)?round(gen):gen;
				};

				var sigma = function(c) {
				  return (random() < (c || .5))?-1:1;
				}

				var N_POLY = polysCount, 
				    c = canvasSelector, 
				    ctx = c.getContext('2d'), 
				    w = 150, h = 150, 
				    polygons = [], 
				    t = 0, r_id = null, 
				    rep_pt = {'x': 0, 'y': 0}, 
				    cutoff_d = 100;

				var Poly = function(n, R, o, fi, hue, v, af, omega) {
				  this.n = n || rand(7, 3, 1);
				  this.alpha = 2*PI/this.n;
				  this.R = R || rand(16, 8);
				  this.o = o || null;
				  this.fi = fi || rand(PI/2);
				  this.hue = hue || rand(360, 0, 1);
				  this.c = animColor;
				  this.v = v || null;
				  this.af = af || (25 - this.R)/250 - 1;
				  this.omega = omega || sigma()*rand(2, .25)*PI/180;
				  this.vertices = [];
				  
				  this.init = function() {
				    var theta = 0;
				    
				    if(!this.o) {
				      this.o = {
				        'x': rand(w - this.R, this.R, 1), 
				        'y': rand(h - this.R, this.R, 1)
				      };
				    }
				    
				    if(!this.v) {
				      this.v = {
				        'x': sigma()*rand(2, .5), 
				        'y': sigma()*rand(2, .5)
				      };
				    }
				    
				    for(var i = 0; i < this.n; i++) {
				      theta = i*this.alpha + this.fi;
				            
				      this.vertices.push({
				        'x': this.o.x + this.R*cos(theta), 
				        'y': this.o.y + this.R*sin(theta)
				      });
				    }
				  };
				  
				  this.move = function() {
				    this.v.x += ~~(2/(this.o.x - rep_pt.x));
				    this.v.y += ~~(2/(this.o.y - rep_pt.y));
				    
				    if(this.v.x > 4) { this.v.x = 4; }
				    if(this.v.y > 4) { this.v.y = 4; }
				    if(this.v.x < -4) { this.v.x = -4; }
				    if(this.v.y < -4) { this.v.y = -4; }
				    
				    this.o.x += this.v.x;
				    this.o.y += this.v.y;
				    
				    this.fi += this.omega;
				    this.hue += sigma(.8)*rand(5, 1, 1);
				    this.c = animColor;
				    
				    if(this.o.x < this.R) {
				      this.o.x = this.R;
				      this.v.x *= this.af;
				    }
				    if(this.o.x > w - this.R) {
				      this.o.x = w - this.R;
				      this.v.x *= this.af;
				    }
				    if(this.o.y < this.R) {
				      this.o.y = this.R;
				      this.v.y *= this.af;
				    }
				    if(this.o.y > h - this.R) {
				      this.o.y = h - this.R;
				      this.v.y *= this.af;
				    }
				    
				    for(var i = 0; i < N_POLY; i++) {
				      if(polygons[i] != this) {
				        if(abs(this.o.x - polygons[i].o.x) < (this.R + polygons[i].R) && 
				           abs(this.o.y - polygons[i].o.y) < (this.R + polygons[i].R)) {
				          this.o.x -= this.v.x;
				          polygons[i].o.x -= polygons[i].v.x;
				          this.v.x *= -1;
				          polygons[i].v.x *= -1;
				          this.o.y -= this.v.y;
				          polygons[i].o.y -= polygons[i].v.y;
				          this.v.y *= -1;
				          polygons[i].v.y *= -1;
				        }
				      }
				    }
				    
				    for(var i = 0; i < this.n; i++) {
				      var theta = i*this.alpha + this.fi;
				            
				      this.vertices[i] = {
				        'x': this.o.x + this.R*cos(theta), 
				        'y': this.o.y + this.R*sin(theta)
				      };
				    }
				  };
				  
				  this.draw = function(ctxt) {
				    ctxt.lineWidth = 3;
				    ctxt.strokeStyle = this.c;
				    ctxt.beginPath();
				    
				    for(var i = 0; i < this.n; i++) {
				      if(i == 0) {
				        ctxt.moveTo(this.vertices[i].x, this.vertices[i].y);
				      }
				      else {
				        ctxt.lineTo(this.vertices[i].x, this.vertices[i].y);
				      }
				    }
				    
				    ctxt.closePath();
				    ctxt.stroke();
				  };
				  
				  this.connectTo = function(ctxt, poly) {
				    var min_d = max(w, h), conn_i, conn_j, 
				        curr_d, dx, dy, 
				        c0, c1, g, la;
				    
				    for(var i = 0; i < this.n; i++) {
				      for(var j = 0; j < poly.n; j++) {
				        dx = this.vertices[i].x - poly.vertices[j].x;
				        dy = this.vertices[i].y - poly.vertices[j].y;
				        curr_d = sqrt(pow(dx, 2) + pow(dy, 2));
				        if(min_d > curr_d) {
				          min_d = curr_d;
				          conn_i = i;
				          conn_j = j;
				        }
				      }
				    }
				    
				    if(min_d < cutoff_d) {
				      la = (1 - min_d/cutoff_d);
				      c0 = animColor;
				      c1 = animColor;
				      g = ctxt.createLinearGradient(
				        this.vertices[conn_i].x, 
				        this.vertices[conn_i].y, 
				        poly.vertices[conn_j].x, 
				        poly.vertices[conn_j].y
				      );
				      g.addColorStop(0, c0);
				      g.addColorStop(1, c1);
				      
				      ctxt.strokeStyle = g;
				      ctxt.beginPath();
				      ctxt.moveTo(this.vertices[conn_i].x, 
				        this.vertices[conn_i].y);
				      ctxt.lineTo(poly.vertices[conn_j].x, 
				        poly.vertices[conn_j].y);
				      ctxt.closePath();
				      ctxt.stroke()
				    }
				  };
				};

				var init = function() {
				  var s = getComputedStyle(c);
				  
				  if(r_id) {
				    cancelAnimationFrame(r_id);
				  }
				  
				  w = c.width = ~~s.width.split('px')[0];
				  h = c.height = ~~s.height.split('px')[0];
				  
				  rep_pt = {'x': w/2, 'y': h/2};
				  
				  for(var i = 0; i < N_POLY; i++) {
				    polygons.push(new Poly());
				    polygons[i].init();
				  }
				  
				  draw();
				};

				var draw = function() {
				  var hue_diff;
				  
				  ctx.clearRect(0, 0, w, h);
				  
				  for(var i = 0; i < N_POLY; i++) {
				    polygons[i].move();
				    polygons[i].draw(ctx);
				    
				    for(var j = 0; j < i; j++) {
				      hue_diff = abs(polygons[i].hue - polygons[j].hue);
				      
				      if(hue_diff < 32 || hue_diff > 328) {
				        polygons[i].connectTo(ctx, polygons[j]);
				      }
				    }
				  }
				  
				  t++;
				  
				  r_id = requestAnimationFrame(draw);
				};

				setTimeout(function() {
				  init();
				  
				  addEventListener('resize', init, false);
				  
				  c.addEventListener('mousemove', function(e) {
				    rep_pt = {'x': e.clientX, 'y': e.clientY}
				  }, false);
				}, 15);
				
			} // bouncyPolygons END

			else if (canvasAnimation == 'bouncyBalls') {
				var animColor = $(this).data('color'),
					bBallsCount = $(this).data('balls-count');

				// bouncyBalls
				Object.getOwnPropertyNames(Math).map(function(p) {
				  window[p] = Math[p];
				});

				if(!hypot) {
				  var hypot = function(x, y) {
				    return sqrt(pow(x, 2) + pow(y, 2));
				  }
				}

				var rand = function(max, min, is_int) {
				  var max = ((max - 1) || 0) + 1, 
				      min = min || 0, 
				      gen = min + (max - min)*random();
				  
				  return (is_int)?round(gen):gen;
				};

				var randSign = function(k) {
				  return (random() < (k || .5))?-1:1;
				};

				var sigma = function(n) {
				  return n/abs(n);
				};

				var mi = function(values, weights) {
				  var n = min(values.length, weights.length), 
				      num = 0, den = 0;
				  
				  for(var i = 0; i < n; i++) {
				    num += weights[i]*values[i];
				    den += weights[i];
				  }
				  
				  return num/den;
				}

				var N_BALLS = bBallsCount, 
				    EXPLAIN_MODE = false, 
				    balls = [], 
				    c = canvasSelector, 
				    w, h, 
				    ctx = c.getContext('2d'), 
				    r_id = null, running = true;

				var Segment = function(p1, p2) {
				  this.p1 = p1 || null;
				  this.p2 = p2 || null;
				  this.alpha = null;
				  
				  this.init = function() {
				    if(!this.p1) {
				      this.p1 = {
				        'x': rand(w, 0, 1), 'y': rand(h, 0, 1)
				      };
				    }
				    
				    if(!this.p2) {
				      this.p2 = {
				        'x': rand(w, 0, 1), 'y': rand(h, 0, 1)
				      };
				    }
				    
				    this.alpha = atan2(this.p2.y - this.p1.y, 
				                   this.p2.x - this.p1.x);
				  };
				  
				  this.init();
				};

				var Ball = function(hue, r, o, v) {
				  var k = EXPLAIN_MODE?4:1, 
				      l = (9 - k)*10;
				  
				  this.hue = hue || rand(360, 0, 1);
				  this.c = animColor;
				  
				  this.r = r || rand(k*32, k*8, 1);
				  
				  this.o = o || null;
				  
				  this.init = function() {
				    if(!this.o) {
				      this.o = {
				        'x': rand(w - this.r, this.r, 1), 
				        'y': rand(h - this.r, this.r, 1)
				      };
				    }
				    
				    if(!this.v) {
				      this.v = {
				        'x': randSign()*rand(sqrt(k)*4, k), 
				        'y': randSign()*rand(sqrt(k)*4, k)
				      };
				    }
				  };
				  
				  this.handleWallHits = function(dir, lim, f) {
				    var cond = (f === 'up') ? 
				        			 (this.o[dir] > lim) : 
				    					 (this.o[dir] < lim);
				    
				    if(cond) {
				      this.o[dir] = lim;
				      this.v[dir] *= -1;
				    }
				  };
				  
				  this.keepInBounds = function() {
				    this.handleWallHits('x', this.r, 'low');
				    this.handleWallHits('x', w - this.r, 'up');
				    this.handleWallHits('y', this.r, 'low');
				    this.handleWallHits('y', h - this.r, 'up');
				  };
				  
				  this.move = function() {
				    this.o.x += this.v.x;
				    this.o.y += this.v.y;
				    
				    this.keepInBounds();
				  };
				  
				  this.distanceTo = function(p) {
				    return hypot(this.o.x - p.x, this.o.y - p.y);
				  };
				  
				  this.collidesWith = function(b) {
				    return this.distanceTo(b.o) < (this.r + b.r);
				  };
				  
				  this.handleBallHit = function(b, ctxt) {
				    var theta1, theta2, 
				        
				        /* the normal segment */
				    		ns = new Segment(this.o, b.o), 
				        
				        /* contact point */
				        cp = {
				          'x': mi([this.o.x, b.o.x], 
				                 [b.r, this.r]), 
				          'y': mi([this.o.y, b.o.y], 
				                 [b.r, this.r])
				        };
				    
				    this.cs = {
				      'x': sigma(cp.x - this.o.x), 
				      'y': sigma(cp.y - this.o.y)
				    };
				    b.cs = {
				      'x': sigma(cp.x - b.o.x), 
				      'y': sigma(cp.y - b.o.y)
				    };
				        
				    this.o = {
				      'x': cp.x - 
				      		this.cs.x*this.r*abs(cos(ns.alpha)),
				      'y': cp.y - 
				      		this.cs.y*this.r*abs(sin(ns.alpha))
				    };
				    b.o = {
				      'x': cp.x - b.cs.x*b.r*abs(cos(ns.alpha)),
				      'y': cp.y - b.cs.y*b.r*abs(sin(ns.alpha))
				    };
				    
				    if(EXPLAIN_MODE) {
				      ctxt.clearRect(0, 0, w, h);
				      this.draw(ctxt);
				      b.draw(ctxt);
				      
				      this.connect(b, ctxt);
				    }
				       
				    this.v.alpha = atan2(this.v.y, this.v.x);
				    b.v.alpha = atan2(b.v.y, b.v.x);
				    
				    this.v.val = hypot(this.v.y, this.v.x);
				    b.v.val = hypot(b.v.y, b.v.x);
				    
				    theta1 = ns.alpha - this.v.alpha;
				    theta2 = ns.alpha - b.v.alpha;
				    
				    this.v.alpha -= PI - 2*theta1;
				    b.v.alpha -= PI - 2*theta2;
				        
				    this.v.x = this.v.val*cos(this.v.alpha);
				    this.v.y = this.v.val*sin(this.v.alpha);
				    
				    b.v.x = b.v.val*cos(b.v.alpha);
				    b.v.y = b.v.val*sin(b.v.alpha);
				  };
				  
				  this.connect = function(b, ctxt) {
				    ctxt.strokeStyle = '#fff';
				    ctxt.setLineDash([5]);
				    
				    ctxt.beginPath();
				    ctxt.moveTo(this.o.x, this.o.y);
				    ctxt.lineTo(b.o.x, b.o.y);
				    ctxt.closePath();
				    ctxt.stroke();
				  }; 
				  
				  this.drawV = function(ctxt, lc) {
				    var m = 32;
				    
				    ctxt.strokeStyle = lc || this.c;
				    
				    ctxt.beginPath();
				    ctxt.moveTo(this.o.x, this.o.y);
				    ctxt.lineTo(this.o.x + m*this.v.x, 
				                this.o.y + m*this.v.y);
				    ctxt.closePath();
				    ctxt.stroke();
				  };
				  
				  this.draw = function(ctxt) {
				    ctxt.strokeStyle = this.c;
				    
				    ctxt.beginPath();
				    ctxt.arc(this.o.x, this.o.y, this.r, 
				             0, 2*PI);
				    ctxt.closePath();
				    ctxt.stroke();
				    
				    if(EXPLAIN_MODE) {
				      this.drawV(ctxt);
				    }
				  };
				  
				  this.init();
				};

				var init = function() {
				  var s = getComputedStyle(c), 
				      hue;
				  
				  w = c.width = $(this).width();
				  h = c.height = $(this).height();
				  
				  if(r_id) {
				    cancelAnimationFrame(r_id);
				    r_id = null;
				  }
				  
				  balls = [];
				  
				  ctx.lineWidth = 3;
				  
				  if(EXPLAIN_MODE) {
				    N_BALLS = 2;
				    running = true;
				  }
				  
				  for(var i = 0; i < N_BALLS; i++) {
				    hue = EXPLAIN_MODE?(i*169 + 1):null;
				    balls.push(new Ball(hue));
				  }
				  
				  handleCollisions();
				  
				  draw();
				};

				var handleCollisions = function() {
				  var collis = false;
				  
				  do {
				    for(var i = 0; i < N_BALLS; i++) {
				      for(var j = 0; j < i; j++) {
				        if(balls[i].collidesWith(balls[j])) {
				          balls[i].handleBallHit(balls[j], ctx);
				        }
				      }
				    }
				  } while(collis);
				};

				var draw = function() {
				  ctx.clearRect(0, 0, w, h);
				  
				  for(var i = 0; i < N_BALLS; i++) {
				    ctx.setLineDash([0]);
				    balls[i].draw(ctx);
				    balls[i].move();
				    handleCollisions();
				  }
				  
				  if(!EXPLAIN_MODE || running) {
				    r_id = requestAnimationFrame(draw);
				  }
				};

				setTimeout(function() {
				  init();
				  
				  addEventListener('resize', init, false);
				  // c.addEventListener('dblclick', init, false);
				  // addEventListener('keydown', function(e) {
				  //   if(e.keyCode == 13) {
				  //     //EXPLAIN_MODE = !EXPLAIN_MODE;
				  //     //init();
				  //   }    
				  // }, false);
				}, 15);


			} // bouncyBalls END

			else if (canvasAnimation == 'slowBubbles') {
				var animColor = $(this).attr('data-color'),
					ballsCount = $(this).attr('data-balls-count');
				
				// slowBubbles
				var canvas = canvasSelector,
				    width = canvas.width = $(this).width(),
				    height = canvas.height = $(this).height(),
				    ctx = canvas.getContext("2d"),
				    aBubbleX = [],
				    aBubbleY = [],
				    aBubbleLR = [],
				    aBubbleTB = [],
				    iBubbleSpeed = 1,
				    aBubbleSize = [],
				    colors = [animColor],
				    aBubbleColor = [],
				    iBubbles = ballsCount;

				function getWidth() {
				  return parseInt(window.getComputedStyle(document.body).getPropertyValue("width"));
				}

				window.addEventListener("resize", function(){
				  // width = canvas.width = $(this).width();
				}, false);

				function fnRandom(min, max) {
				  return Math.floor(Math.random() * (max - min) + min);
				}

				for(i = 0; i < iBubbles; i++) {
				  aBubbleX[i] = fnRandom(0, width);
				  aBubbleY[i] = fnRandom(0, height);
				  aBubbleLR[i] = fnRandom(-iBubbleSpeed, iBubbleSpeed) / 40;
				  if(aBubbleLR[i] == 0) aBubbleLR[i] += 0.2;
				  aBubbleTB[i] = fnRandom(-iBubbleSpeed, 0) / 5;
				  if(aBubbleTB[i] == 0) aBubbleTB[i] += 0.2;
				  aBubbleSize[i] = fnRandom(25, 60);
				}

				for(i = 0; i < iBubbles; i++) {
				  aBubbleColor[i] = colors[fnRandom(0, colors.length)];
				}

				function fnBubbles() {
				  for(i = 0; i < iBubbles; i++) {
				    ctx.beginPath();
				    ctx.arc(aBubbleX[i], aBubbleY[i], aBubbleSize[i], 0, Math.PI * 2);
				    ctx.fillStyle = aBubbleColor[i];
				    ctx.fill();
				  }
				}

				function fnIncrement() {
				  for(i = 0; i < iBubbles; i++) {
				    aBubbleX[i] += aBubbleLR[i];
				    aBubbleY[i] += aBubbleTB[i];
				  }
				}

				function fnControllBubble() {
				  for(i = 0; i < iBubbles; i++) {
				    if(aBubbleX[i] < -60) {
				      aBubbleX[i] += width + 120;
				    }
				    if(aBubbleX[i] > width + 60) {
				      aBubbleX[i] -= width + 120;
				    }
				    if(aBubbleY[i] < -60) {
				      aBubbleY[i] += height + 120;
				    }
				    if(aBubbleY[i] > height + 60) {
				      aBubbleY[i] -= height + 120;
				    }
				  }
				}

				function fnDraw() {
				  canvas.width = canvas.width;
				  
				  fnBubbles();
				  fnIncrement();
				  fnControllBubble();
				  
				  window.requestAnimationFrame(fnDraw);
				}
				fnDraw();
			
			} // slowBubbles

			else if (canvasAnimation == 'confetti') {
				var animColor = $(this).attr('data-color');

				!function(r,n){function t(r,n,t){var e=f[n.type]||{};return null==r?t||!n.def?null:n.def:(r=e.floor?~~r:parseFloat(r),isNaN(r)?n.def:e.mod?(r+e.mod)%e.mod:0>r?0:e.max<r?e.max:r)}function e(n){var t=l(),e=t._rgba=[];return n=n.toLowerCase(),h(u,function(r,o){var a,s=o.re.exec(n),i=s&&o.parse(s),u=o.space||"rgba";return i?(a=t[u](i),t[c[u].cache]=a[c[u].cache],e=t._rgba=a._rgba,!1):void 0}),e.length?("0,0,0,0"===e.join()&&r.extend(e,a.transparent),t):a[n]}function o(r,n,t){return t=(t+1)%1,1>6*t?r+(n-r)*t*6:1>2*t?n:2>3*t?r+(n-r)*(2/3-t)*6:r}var a,s="backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor",i=/^([\-+])=\s*(\d+\.?\d*)/,u=[{re:/rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,parse:function(r){return[r[1],r[2],r[3],r[4]]}},{re:/rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,parse:function(r){return[2.55*r[1],2.55*r[2],2.55*r[3],r[4]]}},{re:/#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,parse:function(r){return[parseInt(r[1],16),parseInt(r[2],16),parseInt(r[3],16)]}},{re:/#([a-f0-9])([a-f0-9])([a-f0-9])/,parse:function(r){return[parseInt(r[1]+r[1],16),parseInt(r[2]+r[2],16),parseInt(r[3]+r[3],16)]}},{re:/hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,space:"hsla",parse:function(r){return[r[1],r[2]/100,r[3]/100,r[4]]}}],l=r.Color=function(n,t,e,o){return new r.Color.fn.parse(n,t,e,o)},c={rgba:{props:{red:{idx:0,type:"byte"},green:{idx:1,type:"byte"},blue:{idx:2,type:"byte"}}},hsla:{props:{hue:{idx:0,type:"degrees"},saturation:{idx:1,type:"percent"},lightness:{idx:2,type:"percent"}}}},f={"byte":{floor:!0,max:255},percent:{max:1},degrees:{mod:360,floor:!0}},p=l.support={},d=r("<p>")[0],h=r.each;d.style.cssText="background-color:rgba(1,1,1,.5)",p.rgba=d.style.backgroundColor.indexOf("rgba")>-1,h(c,function(r,n){n.cache="_"+r,n.props.alpha={idx:3,type:"percent",def:1}}),l.fn=r.extend(l.prototype,{parse:function(o,s,i,u){if(o===n)return this._rgba=[null,null,null,null],this;(o.jquery||o.nodeType)&&(o=r(o).css(s),s=n);var f=this,p=r.type(o),d=this._rgba=[];return s!==n&&(o=[o,s,i,u],p="array"),"string"===p?this.parse(e(o)||a._default):"array"===p?(h(c.rgba.props,function(r,n){d[n.idx]=t(o[n.idx],n)}),this):"object"===p?(o instanceof l?h(c,function(r,n){o[n.cache]&&(f[n.cache]=o[n.cache].slice())}):h(c,function(n,e){var a=e.cache;h(e.props,function(r,n){if(!f[a]&&e.to){if("alpha"===r||null==o[r])return;f[a]=e.to(f._rgba)}f[a][n.idx]=t(o[r],n,!0)}),f[a]&&r.inArray(null,f[a].slice(0,3))<0&&(f[a][3]=1,e.from&&(f._rgba=e.from(f[a])))}),this):void 0},is:function(r){var n=l(r),t=!0,e=this;return h(c,function(r,o){var a,s=n[o.cache];return s&&(a=e[o.cache]||o.to&&o.to(e._rgba)||[],h(o.props,function(r,n){return null!=s[n.idx]?t=s[n.idx]===a[n.idx]:void 0})),t}),t},_space:function(){var r=[],n=this;return h(c,function(t,e){n[e.cache]&&r.push(t)}),r.pop()},transition:function(r,n){var e=l(r),o=e._space(),a=c[o],s=0===this.alpha()?l("transparent"):this,i=s[a.cache]||a.to(s._rgba),u=i.slice();return e=e[a.cache],h(a.props,function(r,o){var a=o.idx,s=i[a],l=e[a],c=f[o.type]||{};null!==l&&(null===s?u[a]=l:(c.mod&&(l-s>c.mod/2?s+=c.mod:s-l>c.mod/2&&(s-=c.mod)),u[a]=t((l-s)*n+s,o)))}),this[o](u)},blend:function(n){if(1===this._rgba[3])return this;var t=this._rgba.slice(),e=t.pop(),o=l(n)._rgba;return l(r.map(t,function(r,n){return(1-e)*o[n]+e*r}))},toRgbaString:function(){var n="rgba(",t=r.map(this._rgba,function(r,n){return null==r?n>2?1:0:r});return 1===t[3]&&(t.pop(),n="rgb("),n+t.join()+")"},toHslaString:function(){var n="hsla(",t=r.map(this.hsla(),function(r,n){return null==r&&(r=n>2?1:0),n&&3>n&&(r=Math.round(100*r)+"%"),r});return 1===t[3]&&(t.pop(),n="hsl("),n+t.join()+")"},toHexString:function(n){var t=this._rgba.slice(),e=t.pop();return n&&t.push(~~(255*e)),"#"+r.map(t,function(r){return r=(r||0).toString(16),1===r.length?"0"+r:r}).join("")},toString:function(){return 0===this._rgba[3]?"transparent":this.toRgbaString()}}),l.fn.parse.prototype=l.fn,c.hsla.to=function(r){if(null==r[0]||null==r[1]||null==r[2])return[null,null,null,r[3]];var n,t,e=r[0]/255,o=r[1]/255,a=r[2]/255,s=r[3],i=Math.max(e,o,a),u=Math.min(e,o,a),l=i-u,c=i+u,f=.5*c;return n=u===i?0:e===i?60*(o-a)/l+360:o===i?60*(a-e)/l+120:60*(e-o)/l+240,t=0===l?0:.5>=f?l/c:l/(2-c),[Math.round(n)%360,t,f,null==s?1:s]},c.hsla.from=function(r){if(null==r[0]||null==r[1]||null==r[2])return[null,null,null,r[3]];var n=r[0]/360,t=r[1],e=r[2],a=r[3],s=.5>=e?e*(1+t):e+t-e*t,i=2*e-s;return[Math.round(255*o(i,s,n+1/3)),Math.round(255*o(i,s,n)),Math.round(255*o(i,s,n-1/3)),a]},h(c,function(e,o){var a=o.props,s=o.cache,u=o.to,c=o.from;l.fn[e]=function(e){if(u&&!this[s]&&(this[s]=u(this._rgba)),e===n)return this[s].slice();var o,i=r.type(e),f="array"===i||"object"===i?e:arguments,p=this[s].slice();return h(a,function(r,n){var e=f["object"===i?r:n.idx];null==e&&(e=p[n.idx]),p[n.idx]=t(e,n)}),c?(o=l(c(p)),o[s]=p,o):l(p)},h(a,function(n,t){l.fn[n]||(l.fn[n]=function(o){var a,s=r.type(o),u="alpha"===n?this._hsla?"hsla":"rgba":e,l=this[u](),c=l[t.idx];return"undefined"===s?c:("function"===s&&(o=o.call(this,c),s=r.type(o)),null==o&&t.empty?this:("string"===s&&(a=i.exec(o),a&&(o=c+parseFloat(a[2])*("+"===a[1]?1:-1))),l[t.idx]=o,this[u](l)))})})}),l.hook=function(n){var t=n.split(" ");h(t,function(n,t){r.cssHooks[t]={set:function(n,o){var a,s,i="";if("transparent"!==o&&("string"!==r.type(o)||(a=e(o)))){if(o=l(a||o),!p.rgba&&1!==o._rgba[3]){for(s="backgroundColor"===t?n.parentNode:n;(""===i||"transparent"===i)&&s&&s.style;)try{i=r.css(s,"backgroundColor"),s=s.parentNode}catch(u){}o=o.blend(i&&"transparent"!==i?i:"_default")}o=o.toRgbaString()}try{n.style[t]=o}catch(u){}}},r.fx.step[t]=function(n){n.colorInit||(n.start=l(n.elem,t),n.end=l(n.end),n.colorInit=!0),r.cssHooks[t].set(n.elem,n.start.transition(n.end,n.pos))}})},l.hook(s),r.cssHooks.borderColor={expand:function(r){var n={};return h(["Top","Right","Bottom","Left"],function(t,e){n["border"+e+"Color"]=r}),n}},a=r.Color.names={aqua:"#00ffff",black:"#000000",blue:"#0000ff",fuchsia:"#ff00ff",gray:"#808080",green:"#008000",lime:"#00ff00",maroon:"#800000",navy:"#000080",olive:"#808000",purple:"#800080",red:"#ff0000",silver:"#c0c0c0",teal:"#008080",white:"#ffffff",yellow:"#ffff00",transparent:[null,null,null,0],_default:"#ffffff"}}(jQuery);

				// confetti
				var COLORS, Confetti, NUM_CONFETTI, PI_2, canvas, confetti, context, drawCircle, i, range, resizeWindow, xpos;

				NUM_CONFETTI = 100;

				var colorConv = jQuery.Color( animColor ).hsla(), // random
				 	colorsArray = new Array(5);

				for(var i=0;i<colorsArray.length;i++){

				  	var hueShift = i * 16,
				  		colors = new Array();

				  		colors[i] = [colorConv[0] + hueShift, colorConv[1] * 100, colorConv[2] * 100];

				  	// console.log(colors);

				 	colorsArray[i] = colors[i];
				 	// colorsArray[1] = colorConv;

				}

				// console.log(colorsArray);

				// COLORS = [[249, 110, 91], [174, 61, 99], [219, 56, 83], [244, 92, 68], [248, 182, 70]];
				// COLORS = [[7, 92.9, 66.7], [17, 92.9, 66.7], [27, 92.9, 66.7], [37, 92.9, 66.7], [47, 92.9, 66.7]]; // hsl

				PI_2 = 2 * Math.PI;

				canvas = canvasSelector;

				context = canvas.getContext("2d");

				// window.w = 0;
				// window.h = 0;

				w = $(this).width();
				h = $(this).height();

				resizeWindow = function() {
				  w = canvas.width = $(this).width();
				  return h = canvas.height = h;
				};

				window.addEventListener('resize', resizeWindow, false);

				window.onload = function() {
				  return setTimeout(resizeWindow, 0);
				};

				range = function(a, b) {
				  return (b - a) * Math.random() + a;
				};

				drawCircle = function(x, y, r, style) {
				  context.beginPath();
				  // context.arc(x, y, r, 0, PI_2, false);
				  context.fillRect(x,y,r,r*2);
				  context.fillStyle = style;
				  return context.fill();
				};

				xpos = 0.5;

				document.onmousemove = function(e) {
				  return xpos = e.pageX / w;
				};

				window.requestAnimationFrame = (function() {
				  return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(callback) {
				    return window.setTimeout(callback, 1000 / 60);
				  };
				})();

				Confetti = (function() {
				  function Confetti() {
				    this.style = colorsArray[~~range(0, 5)];
				    this.rgb = "hsla(" + this.style[0] + "," + this.style[1] + "%," + this.style[2];
				    // this.rgb = "rgba(" + this.style[0] + "," + this.style[1] + "," + this.style[2];
				    // this.rgb = animColor;
				    this.r = ~~range(2, 6);
				    this.r2 = 2 * this.r;
				    this.replace();
				  }


				  Confetti.prototype.replace = function() {
				    this.opacity = 0;
				    this.dop = 0.03 * range(1, 4);
				    this.x = range(-this.r2, w - this.r2);
				    this.y = range(-20, h - this.r2);
				    this.xmax = w - this.r;
				    this.ymax = h - this.r;
				    this.vx = range(0, 2) + 8 * xpos - 5;
				    return this.vy = 0.7 * this.r + range(-1, 1);
				  };

				  Confetti.prototype.draw = function() {
				    var ref;
				    this.x += this.vx;
				    this.y += this.vy;
				    this.opacity += this.dop;
				    if (this.opacity > colorConv[3]) {
				      this.opacity = colorConv[3];
				      this.dop *= -colorConv[3];
				    }
				    if (this.opacity < 0 || this.y > this.ymax) {
				      this.replace();
				    }
				    if (!((0 < (ref = this.x) && ref < this.xmax))) {
				      this.x = (this.x + this.xmax) % this.xmax;
				    }
				    return drawCircle(~~this.x, ~~this.y, this.r, this.rgb + "%," + this.opacity + ")");
				  };

				  return Confetti;

				})();

				confetti = (function() {
				  var j, ref, results;
				  results = [];
				  for (i = j = 1, ref = NUM_CONFETTI; 1 <= ref ? j <= ref : j >= ref; i = 1 <= ref ? ++j : --j) {
				    results.push(new Confetti);
				  }
				  return results;
				})();

				window.step = function() {
				  var c, j, len, results;
				  requestAnimationFrame(step);
				  context.clearRect(0, 0, w, h);
				  results = [];
				  for (j = 0, len = confetti.length; j < len; j++) {
				    c = confetti[j];
				    results.push(c.draw());
				  }
				  return results;
				};

				step();
				// confetti END
			}
			else if (canvasAnimation == 'linesRain') {
				var animColor = $(this).attr('data-color');

				var c = canvasSelector,
					ctx = c.getContext("2d");
				
				c.width = $(this).width();
				c.height = $(this).height();
				
				var lines = [],
						maxSpeed = 1,
						spacing = 30,
						xSpacing = 0,
						n = innerWidth / spacing,
						colors = [animColor],
						i;
				
				for (i = 0; i < n; i++){
					xSpacing += spacing;
					lines.push({
						x: xSpacing,
						y: Math.round(Math.random()*c.height),
						width: 2,
						height: Math.round(Math.random()*(innerHeight/10)),
						speed: Math.random()*maxSpeed + 1,
						color: colors[Math.floor(Math.random() * colors.length)]
					});
				}
				
				function draw(){
					var i;
					ctx.clearRect(0,0,c.width,c.height);
					
					for (i = 0; i < n; i++){
						ctx.fillStyle = lines[i].color;
						ctx.fillRect(lines[i].x, lines[i].y, lines[i].width, lines[i].height);
						lines[i].y += lines[i].speed;
						
						if (lines[i].y > c.height)
							lines[i].y = 0 - lines[i].height;
					}
					
					requestAnimationFrame(draw);
					
				}
				
				draw();
			}

			else if (canvasAnimation == 'filmGrain') {
				var viewWidth,
				    viewHeight,
				    canvas = canvasSelector,
				    ctx;

				// change these settings
				var patternSize = 128,
				    patternScaleX = 1,
				    patternScaleY = 1,
				    patternRefreshInterval = 8,
				    patternAlpha = 30; // int between 0 and 255,

				var patternPixelDataLength = patternSize * patternSize * 4,
				    patternCanvas,
				    patternCtx,
				    patternData,
				    frame = 0;

				window.onload = function() {
				    initCanvas();
				    initGrain();
				    requestAnimationFrame(loop);
				};

				// create a canvas which will render the grain
				function initCanvas() {
				    viewWidth = canvas.width = $(this).width();
				    viewHeight = canvas.height = $(this).height();
				    ctx = canvas.getContext('2d');

				    ctx.scale(patternScaleX, patternScaleY);
				}

				// create a canvas which will be used as a pattern
				function initGrain() {
				    patternCanvas = document.createElement('canvas');
				    patternCanvas.width = patternSize;
				    patternCanvas.height = patternSize;
				    patternCtx = patternCanvas.getContext('2d');
				    patternData = patternCtx.createImageData(patternSize, patternSize);
				}

				// put a random shade of gray into every pixel of the pattern
				function update() {
				    var value;

				    for (var i = 0; i < patternPixelDataLength; i += 4) {
				        value = (Math.random() * 255) | 0;

				        patternData.data[i    ] = value;
				        patternData.data[i + 1] = value;
				        patternData.data[i + 2] = value;
				        patternData.data[i + 3] = patternAlpha;
				    }

				    patternCtx.putImageData(patternData, 0, 0);
				}

				// fill the canvas using the pattern
				function drawFilmGrain() {
				    ctx.clearRect(0, 0, viewWidth, viewHeight);

				    ctx.fillStyle = ctx.createPattern(patternCanvas, 'repeat');
				    ctx.fillRect(0, 0, viewWidth, viewHeight);
				}

				function loop() {
				    if (++frame % patternRefreshInterval === 0) {
				        update();
				        drawFilmGrain();
				    }

				    requestAnimationFrame(loop);
				}
			}

		})
	}

	creativa_animatedCanvas();
	$('.vc_row:has(.animated-canvas), .page-title--animation').on("mresize", function(){
		creativa_animatedCanvas();
	})



})(jQuery);
