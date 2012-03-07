/* This notice must remain at all times.

pie.js
Copyright (c) Balamurugan S, 2005. sbalamurugan @ hotmail.com
Development support by Jexp, Inc http://www.jexp.com 

This package is free software. It is distributed under GPL - legalese removed, 
it means that you can use this for any purpose, but cannot charge for this software. 
Any enhancements you make to this piece of code, should be made available free to 
the general public!

Latest version can be downloaded from http://www.sbmkpm.com

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 

pie.js provides a simple mechanism to draw pie charts. It  uses 
wz_jsgraphics.js  which is copyright of its author.

Usage:
var p = new pie();
p.add("title1",value1);
p.add("title2",value2);

p.render("canvas_name", "graph_title", imageSize);

  canvas_name is a div defined INSIDE body tag
  graph_title is the text that is displayed over the graph itself
  imageSize is the desired size of the pie chart (in pixels)
  
<body>
<div id="canvas_name" style="overflow: auto; position:relative;height:400px;width:400px;"></div>
*/

hD="0123456789ABCDEF";
function d2h(d) 
{
	var h = hD.substr(d&15,1);
	while(d>15) {d>>=4;h=hD.substr(d&15,1)+h;}
	return h;
}

function h2d(h) 
{
	return parseInt(h,16);
}

function pie()
{
	this.ct = 0;

	this.data      	= new Array();
	this.x_name    	= new Array();
	this.div_id		= new Array();
	this.max       	= 0;

	this.c_array = new Array();
	this.c_array[0] = new Array(255, 192, 95);
	this.c_array[1] = new Array(80, 127, 175);
	this.c_array[2] = new Array(159, 87, 112);
	this.c_array[3] = new Array(111, 120, 96);
	this.c_array[4] = new Array(224, 119, 96);
	this.c_array[5] = new Array(80, 159, 144);
	this.c_array[6] = new Array(207, 88, 95);
	this.c_array[7] = new Array(64, 135, 96);
	this.c_array[8] = new Array(239, 160, 95);
	this.c_array[9] = new Array(144, 151, 80);
	this.c_array[10] = new Array(255, 136, 80);

	this.getColor = function()
	{
		if(this.ct >= (this.c_array.length-1))
			this.ct = 0;
		else
			this.ct++;
		
		return "#" + d2h(this.c_array[this.ct][0]) + d2h(this.c_array[this.ct][1]) + d2h(this.c_array[this.ct][2]);
	}


	this.add = function(x_name, value, divId)
	{
		this.x_name.push(x_name);  
		this.data.push(parseInt(value,10));
		divId?this.div_id.push(divId):null;
		this.max += parseInt(value,10);
	}

	this.render = function(canvas, title, size)
	{
		var jg,cnv,r,sW,cH,sx,xy,st_angle,hyp,lblFnt,graphFnt;
		jg = new jsGraphics(canvas);
		cnv = document.getElementById(canvas);	//location of Graph
		cW = (cnv.style.width).substring(0,(cnv.style.width).lastIndexOf('px'));	//width of chart canvas
		cH = (cnv.style.height).substring(0,(cnv.style.height).lastIndexOf('px'));	//height of chart canvas
		size?size=size:size=cW*.5; //if no size is provided, default to 50% of the canvas width.
		r = size/2;
		sx = cW/2 - r;	//start X
		sy = cH/2 - r;	//start Y
		st_angle = 0;	//starting position for piechart graph
		hyp = r*1.25;	//the length of the ray used to position the text (125% of the radius)
		lblFnt = 10;
		graphFnt = 14;
		
		// pie shadow
		jg.setColor("gray");
		jg.fillEllipse(sx+3,sy+3,2*r,2*r);
		   
		for(i = 0; i<this.data.length; i++)
		{
			var angle = Math.round(this.data[i]/this.max*360);
			var pc    = Math.round(this.data[i]/this.max*100);
			jg.setColor(this.getColor());
			jg.fillArc(sx,sy,2*r,2*r,st_angle,st_angle+angle);
			var ang_rads = (st_angle+(angle/2)) * (Math.PI/180);
			var my  = Math.sin(ang_rads) * hyp;
			var mx  = Math.cos(ang_rads) * hyp;
			st_angle += angle;
			mxa = (mx < 0 ? 50 : 0);
			jg.setColor("black");
			jg.setFont("verdana, arial, sans-serif",lblFnt+"px",Font.PLAIN);
			jg.drawString(this.x_name[i]+"("+pc+"%"+")",cW/2+mx-mxa,cH/2-my, this.div_id[i]);
		}
		jg.setFont("verdana, arial, sans-serif", graphFnt+"px",Font.BOLD);
		jg.drawStringRect(title, 0, 0, cW, 'center');
		jg.setColor("black");
		jg.drawEllipse(sx, sy, 2*r, 2*r);
		jg.paint();
	}
}
