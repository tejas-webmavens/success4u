!function(a){function g(b,g,h,i){h*=c,g*=c;var k,l,m,j=[];h*=-1,k=i.x,l=i.y,m=(0===i.z?1e-4:i.z)*(i.vd||25),m=Math.max(500,m);var r,s,t,u,n=d(h),o=e(h),p=d(g),q=e(g);return a.each(b,function(a){r=a.x-k,s=a.y-l,t=a.z||0,u={x:o*r-n*t,y:-n*p*r-o*p*t+q*s,z:n*q*r+o*q*t+p*s},u.x=u.x*((m-u.z)/m)+k,u.y=u.y*((m-u.z)/m)+l,j.push({x:f(u.x),y:f(u.y),z:f(u.z)})}),j}function i(a){return void 0!==a&&null!==a}function j(a,c,f,g,i,k,l,m){var n=[];if(k>i&&k-i>b/2+1e-4)return n=n.concat(j(a,c,f,g,i,i+b/2,l,m)),n=n.concat(j(a,c,f,g,i+b/2,k,l,m));if(k<i&&i-k>b/2+1e-4)return n=n.concat(j(a,c,f,g,i,i-b/2,l,m)),n=n.concat(j(a,c,f,g,i-b/2,k,l,m));var o=k-i;return["C",a+f*e(i)-f*h*o*d(i)+l,c+g*d(i)+g*h*o*e(i)+m,a+f*e(k)+f*h*o*d(k)+l,c+g*d(k)-g*h*o*e(k)+m,a+f*e(k)+l,c+g*d(k)+m]}function l(b){if(this.chart.is3d()){var c=this.chart.options.plotOptions.column.grouping;void 0===c||c||void 0===this.group.zIndex||this.group.attr({zIndex:10*this.group.zIndex});var d=this.options,e=this.options.states;this.borderWidth=d.borderWidth=d.edgeWidth||1,a.each(this.data,function(b){if(null!==b.y){var c=b.pointAttr;this.borderColor=a.pick(d.edgeColor,c[""].fill),c[""].stroke=this.borderColor,c.hover.stroke=a.pick(e.hover.edgeColor,this.borderColor),c.select.stroke=a.pick(e.select.edgeColor,this.borderColor)}})}b.apply(this,[].slice.call(arguments,1))}var b=Math.PI,c=b/180,d=Math.sin,e=Math.cos,f=Math.round,h=4*(Math.sqrt(2)-1)/3/(b/2);a.SVGRenderer.prototype.toLinePath=function(b,c){var d=[];return a.each(b,function(a){d.push("L",a.x,a.y)}),d[0]="M",c&&d.push("Z"),d},a.SVGRenderer.prototype.cuboid=function(b){var c=this.g(),d=this.cuboidPath(b);return c.front=this.path(d[0]).attr({zIndex:d[3],"stroke-linejoin":"round"}).add(c),c.top=this.path(d[1]).attr({zIndex:d[4],"stroke-linejoin":"round"}).add(c),c.side=this.path(d[2]).attr({zIndex:d[5],"stroke-linejoin":"round"}).add(c),c.fillSetter=function(b){var c=b,d=a.Color(b).brighten(.1).get(),e=a.Color(b).brighten(-.1).get();return this.front.attr({fill:c}),this.top.attr({fill:d}),this.side.attr({fill:e}),this.color=b,this},c.opacitySetter=function(a){return this.front.attr({opacity:a}),this.top.attr({opacity:a}),this.side.attr({opacity:a}),this},c.attr=function(b){if(b.shapeArgs||i(b.x)){var c=b.shapeArgs||b,d=this.renderer.cuboidPath(c);this.front.attr({d:d[0],zIndex:d[3]}),this.top.attr({d:d[1],zIndex:d[4]}),this.side.attr({d:d[2],zIndex:d[5]})}else a.SVGElement.prototype.attr.call(this,b);return this},c.animate=function(b,c,d){if(i(b.x)&&i(b.y)){var e=this.renderer.cuboidPath(b);this.front.attr({zIndex:e[3]}).animate({d:e[0]},c,d),this.top.attr({zIndex:e[4]}).animate({d:e[1]},c,d),this.side.attr({zIndex:e[5]}).animate({d:e[2]},c,d)}else b.opacity?(this.front.animate(b,c,d),this.top.animate(b,c,d),this.side.animate(b,c,d)):a.SVGElement.prototype.animate.call(this,b,c,d);return this},c.destroy=function(){return this.front.destroy(),this.top.destroy(),this.side.destroy(),null},c.attr({zIndex:-d[3]}),c},a.SVGRenderer.prototype.cuboidPath=function(a){var b=a.x,c=a.y,d=a.z,e=a.height,f=a.width,h=a.depth,i=a.alpha,j=a.beta,k=a.origin,l=[{x:b,y:c,z:d},{x:b+f,y:c,z:d},{x:b+f,y:c+e,z:d},{x:b,y:c+e,z:d},{x:b,y:c+e,z:d+h},{x:b+f,y:c+e,z:d+h},{x:b+f,y:c,z:d+h},{x:b,y:c,z:d+h}];l=g(l,i,j,k);var m,n,o;m=["M",l[0].x,l[0].y,"L",l[1].x,l[1].y,"L",l[2].x,l[2].y,"L",l[3].x,l[3].y,"Z"];var p=(l[0].z+l[1].z+l[2].z+l[3].z)/4,q=["M",l[0].x,l[0].y,"L",l[7].x,l[7].y,"L",l[6].x,l[6].y,"L",l[1].x,l[1].y,"Z"],r=["M",l[3].x,l[3].y,"L",l[2].x,l[2].y,"L",l[5].x,l[5].y,"L",l[4].x,l[4].y,"Z"];n=l[7].y<l[1].y?q:l[4].y>l[2].y?r:[];var s=j>0?(l[0].z+l[7].z+l[6].z+l[1].z)/4:(l[3].z+l[2].z+l[5].z+l[4].z)/4,t=["M",l[1].x,l[1].y,"L",l[2].x,l[2].y,"L",l[5].x,l[5].y,"L",l[6].x,l[6].y,"Z"],u=["M",l[0].x,l[0].y,"L",l[7].x,l[7].y,"L",l[4].x,l[4].y,"L",l[3].x,l[3].y,"Z"];o=l[6].x>l[1].x?t:l[7].x<l[0].x?u:[];var v=i>0?(l[1].z+l[2].z+l[5].z+l[6].z)/4:(l[0].z+l[7].z+l[4].z+l[3].z)/4;return[m,n,o,p,s,v]},a.SVGRenderer.prototype.arc3d=function(b){b.alpha*=c,b.beta*=c;var d=this.g(),e=this.arc3dPath(b),f=d.renderer,g=100*e.zTop;return d.shapeArgs=b,d.top=f.path(e.top).attr({zIndex:e.zTop}).add(d),d.side1=f.path(e.side2).attr({zIndex:e.zSide2}),d.side2=f.path(e.side1).attr({zIndex:e.zSide1}),d.inn=f.path(e.inn).attr({zIndex:e.zInn}),d.out=f.path(e.out).attr({zIndex:e.zOut}),d.fillSetter=function(b){this.color=b;var c=b,d=a.Color(b).brighten(-.1).get();return this.side1.attr({fill:d}),this.side2.attr({fill:d}),this.inn.attr({fill:d}),this.out.attr({fill:d}),this.top.attr({fill:c}),this},d.translateXSetter=function(a){this.out.attr({translateX:a}),this.inn.attr({translateX:a}),this.side1.attr({translateX:a}),this.side2.attr({translateX:a}),this.top.attr({translateX:a})},d.translateYSetter=function(a){this.out.attr({translateY:a}),this.inn.attr({translateY:a}),this.side1.attr({translateY:a}),this.side2.attr({translateY:a}),this.top.attr({translateY:a})},d.animate=function(b,c,d){return i(b.end)||i(b.start)?(this._shapeArgs=this.shapeArgs,a.SVGElement.prototype.animate.call(this,{_args:b},{duration:c,step:function(){var b=arguments,c=b[1],d=c.elem,e=d._shapeArgs,f=c.end,g=c.pos,h=a.merge(e,{x:e.x+(f.x-e.x)*g,y:e.y+(f.y-e.y)*g,r:e.r+(f.r-e.r)*g,innerR:e.innerR+(f.innerR-e.innerR)*g,start:e.start+(f.start-e.start)*g,end:e.end+(f.end-e.end)*g}),i=d.renderer.arc3dPath(h);d.shapeArgs=h,d.top.attr({d:i.top,zIndex:i.zTop}),d.inn.attr({d:i.inn,zIndex:i.zInn}),d.out.attr({d:i.out,zIndex:i.zOut}),d.side1.attr({d:i.side1,zIndex:i.zSide1}),d.side2.attr({d:i.side2,zIndex:i.zSide2})}},d)):a.SVGElement.prototype.animate.call(this,b,c,d),this},d.destroy=function(){this.top.destroy(),this.out.destroy(),this.inn.destroy(),this.side1.destroy(),this.side2.destroy(),a.SVGElement.prototype.destroy.call(this)},d.hide=function(){this.top.hide(),this.out.hide(),this.inn.hide(),this.side1.hide(),this.side2.hide()},d.show=function(){this.top.show(),this.out.show(),this.inn.show(),this.side1.show(),this.side2.show()},d.zIndex=g,d.attr({zIndex:g}),d},a.SVGRenderer.prototype.arc3dPath=function(a){var c=a.x,f=a.y,g=a.start,h=a.end-1e-5,i=a.r,k=a.innerR,l=a.depth,m=a.alpha,n=a.beta,o=e(g),p=d(g),q=e(h),r=d(h),s=i*e(n),t=i*e(m),u=k*e(n),v=k*e(m),w=l*d(n),x=l*d(m),y=["M",c+s*o,f+t*p];y=y.concat(j(c,f,s,t,g,h,0,0)),y=y.concat(["L",c+u*q,f+v*r]),y=y.concat(j(c,f,u,v,h,g,0,0)),y=y.concat(["Z"]);var z=n>0?b/2:0,A=m>0?0:b/2,B=g>-z?g:h>-z?-z:g,C=h<b-A?h:g<b-A?b-A:h,D=["M",c+s*e(B),f+t*d(B)];D=D.concat(j(c,f,s,t,B,C,0,0)),D=D.concat(["L",c+s*e(C)+w,f+t*d(C)+x]),D=D.concat(j(c,f,s,t,C,B,w,x)),D=D.concat(["Z"]);var E=["M",c+u*o,f+v*p];E=E.concat(j(c,f,u,v,g,h,0,0)),E=E.concat(["L",c+u*e(h)+w,f+v*d(h)+x]),E=E.concat(j(c,f,u,v,h,g,w,x)),E=E.concat(["Z"]);var F=["M",c+s*o,f+t*p,"L",c+s*o+w,f+t*p+x,"L",c+u*o+w,f+v*p+x,"L",c+u*o,f+v*p,"Z"],G=["M",c+s*q,f+t*r,"L",c+s*q+w,f+t*r+x,"L",c+u*q+w,f+v*r+x,"L",c+u*q,f+v*r,"Z"],H=d((g+h)/2),I=d(g),J=d(h);return{top:y,zTop:i,out:D,zOut:Math.max(H,I,J)*i,inn:E,zInn:Math.max(H,I,J)*i,side1:F,zSide1:I*(.99*i),side2:G,zSide2:J*(.99*i)}},a.Chart.prototype.is3d=function(){return this.options.chart.options3d&&this.options.chart.options3d.enabled},a.wrap(a.Chart.prototype,"isInsidePlot",function(a){return!!this.is3d()||a.apply(this,[].slice.call(arguments,1))});var k=a.getOptions();k.chart.options3d={enabled:!1,alpha:0,beta:0,depth:100,viewDistance:25,frame:{bottom:{size:1,color:"rgba(255,255,255,0)"},side:{size:1,color:"rgba(255,255,255,0)"},back:{size:1,color:"rgba(255,255,255,0)"}}},a.wrap(a.Chart.prototype,"init",function(b){var d,e,c=[].slice.call(arguments,1);c[0].chart.options3d&&c[0].chart.options3d.enabled&&(d=c[0].plotOptions||{},e=d.pie||{},e.borderColor=a.pick(e.borderColor,void 0)),b.apply(this,c)}),a.wrap(a.Chart.prototype,"setChartSize",function(a){if(a.apply(this,[].slice.call(arguments,1)),this.is3d()){var b=this.inverted,c=this.clipBox,d=this.margin,e=b?"y":"x",f=b?"x":"y",g=b?"height":"width",h=b?"width":"height";c[e]=-(d[3]||0),c[f]=-(d[0]||0),c[g]=this.chartWidth+(d[3]||0)+(d[1]||0),c[h]=this.chartHeight+(d[0]||0)+(d[2]||0)}}),a.wrap(a.Chart.prototype,"redraw",function(a){this.is3d()&&(this.isDirtyBox=!0),a.apply(this,[].slice.call(arguments,1))}),a.Chart.prototype.retrieveStacks=function(b,c){var d={},e=1;return b||!c?this.series:(a.each(this.series,function(a){d[a.options.stack||0]?d[a.options.stack||0].series.push(a):(d[a.options.stack||0]={series:[a],position:e},e++)}),d.totalStacks=e+1,d)},a.wrap(a.Axis.prototype,"init",function(b){var c=arguments;c[1].is3d()&&(c[2].tickWidth=a.pick(c[2].tickWidth,0),c[2].gridLineWidth=a.pick(c[2].gridLineWidth,1)),b.apply(this,[].slice.call(arguments,1))}),a.wrap(a.Axis.prototype,"render",function(a){if(a.apply(this,[].slice.call(arguments,1)),this.chart.is3d()){var b=this.chart,c=b.renderer,d=b.options.chart.options3d,e=d.alpha,f=d.beta*(b.yAxis[0].opposite?-1:1),g=d.frame,h=g.bottom,i=g.back,j=g.side,k=d.depth,l=this.height,m=this.width,n=this.left,o=this.top,p={x:b.plotLeft+b.plotWidth/2,y:b.plotTop+b.plotHeight/2,z:k,vd:d.viewDistance};if(this.horiz){this.axisLine&&this.axisLine.hide();var q={x:n,y:o+(b.yAxis[0].reversed?-h.size:l),z:0,width:m,height:h.size,depth:k,alpha:e,beta:f,origin:p};this.bottomFrame?this.bottomFrame.animate(q):this.bottomFrame=c.cuboid(q).attr({fill:h.color,zIndex:b.yAxis[0].reversed&&e>0?4:-1}).css({stroke:h.color}).add()}else{var r={x:n,y:o,z:k+1,width:m,height:l+h.size,depth:i.size,alpha:e,beta:f,origin:p};this.backFrame?this.backFrame.animate(r):this.backFrame=c.cuboid(r).attr({fill:i.color,zIndex:-3}).css({stroke:i.color}).add(),this.axisLine&&this.axisLine.hide();var s={x:(b.yAxis[0].opposite?m:0)+n-j.size,y:o,z:0,width:j.size,height:l+h.size,depth:k+i.size,alpha:e,beta:f,origin:p};this.sideFrame?this.sideFrame.animate(s):this.sideFrame=c.cuboid(s).attr({fill:j.color,zIndex:-2}).css({stroke:j.color}).add()}}}),a.wrap(a.Axis.prototype,"getPlotLinePath",function(a){var b=a.apply(this,[].slice.call(arguments,1));if(!this.chart.is3d())return b;if(null===b)return b;var c=this.chart,d=c.options.chart.options3d,e=d.depth;d.origin={x:c.plotLeft+c.plotWidth/2,y:c.plotTop+c.plotHeight/2,z:e,vd:d.viewDistance};var f=[{x:b[1],y:b[2],z:this.horiz||this.opposite?e:0},{x:b[1],y:b[2],z:e},{x:b[4],y:b[5],z:e},{x:b[4],y:b[5],z:this.horiz||this.opposite?0:e}],h=c.options.inverted?d.beta:d.alpha,i=c.options.inverted?d.alpha:d.beta;return i*=c.yAxis[0].opposite?-1:1,f=g(f,h,i,d.origin),b=this.chart.renderer.toLinePath(f,!1)}),a.wrap(a.Axis.prototype,"getPlotBandPath",function(a){if(this.chart.is3d()){var b=arguments,c=b[1],d=b[2],e=this.getPlotLinePath(d),f=this.getPlotLinePath(c);return f&&e?f.push(e[7],e[8],e[4],e[5],e[1],e[2]):f=null,f}return a.apply(this,[].slice.call(arguments,1))}),a.wrap(a.Tick.prototype,"getMarkPath",function(a){var b=a.apply(this,[].slice.call(arguments,1));if(!this.axis.chart.is3d())return b;var c=this.axis.chart,d=c.options.chart.options3d,e={x:c.plotLeft+c.plotWidth/2,y:c.plotTop+c.plotHeight/2,z:d.depth,vd:d.viewDistance},f=[{x:b[1],y:b[2],z:0},{x:b[4],y:b[5],z:0}],h=c.inverted?d.beta:d.alpha,i=c.inverted?d.alpha:d.beta;return i*=c.yAxis[0].opposite?-1:1,f=g(f,h,i,e),b=["M",f[0].x,f[0].y,"L",f[1].x,f[1].y]}),a.wrap(a.Tick.prototype,"getLabelPosition",function(a){var b=a.apply(this,[].slice.call(arguments,1));if(!this.axis.chart.is3d())return b;var c=this.axis.chart,d=c.options.chart.options3d,e={x:c.plotLeft+c.plotWidth/2,y:c.plotTop+c.plotHeight/2,z:d.depth,vd:d.viewDistance},f=c.inverted?d.beta:d.alpha,h=c.inverted?d.alpha:d.beta;return h*=c.yAxis[0].opposite?-1:1,b=g([{x:b.x,y:b.y,z:0}],f,h,e)[0]}),a.wrap(a.Axis.prototype,"drawCrosshair",function(a){var b=arguments;this.chart.is3d()&&b[2]&&(b[2]={plotX:b[2].plotXold||b[2].plotX,plotY:b[2].plotYold||b[2].plotY}),a.apply(this,[].slice.call(b,1))}),a.wrap(a.seriesTypes.column.prototype,"translate",function(b){if(b.apply(this,[].slice.call(arguments,1)),this.chart.is3d()){var c=this,d=c.chart,e=d.options,f=c.options,h=e.chart.options3d,i=f.depth||25,j={x:d.plotWidth/2,y:d.plotHeight/2,z:h.depth,vd:h.viewDistance},k=h.alpha,l=h.beta*(d.yAxis[0].opposite?-1:1),m=f.stacking?f.stack||0:c._i,n=m*(i+(f.groupZPadding||1));f.grouping!==!1&&(n=0),n+=f.groupZPadding||1,a.each(c.data,function(a){if(null!==a.y){var b=a.shapeArgs,c=a.tooltipPos;a.shapeType="cuboid",b.alpha=k,b.beta=l,b.z=n,b.origin=j,b.depth=i,c=g([{x:c[0],y:c[1],z:n}],k,l,j)[0],a.tooltipPos=[c.x,c.y]}})}}),a.wrap(a.seriesTypes.column.prototype,"animate",function(b){if(this.chart.is3d()){var c=arguments,d=c[1],e=this.yAxis,f=this,g=this.yAxis.reversed;a.svg&&(d?a.each(f.data,function(a){null!==a.y&&(a.height=a.shapeArgs.height,a.shapey=a.shapeArgs.y,a.shapeArgs.height=1,g||(a.stackY?a.shapeArgs.y=a.plotY+e.translate(a.stackY):a.shapeArgs.y=a.plotY+(a.negative?-a.height:a.height)))}):(a.each(f.data,function(a){null!==a.y&&(a.shapeArgs.height=a.height,a.shapeArgs.y=a.shapey,a.graphic&&a.graphic.animate(a.shapeArgs,f.options.animation))}),this.drawDataLabels(),f.animate=null))}else b.apply(this,[].slice.call(arguments,1))}),a.wrap(a.seriesTypes.column.prototype,"init",function(a){if(a.apply(this,[].slice.call(arguments,1)),this.chart.is3d()){var b=this.options,c=b.grouping,d=b.stacking,e=0;if((void 0===c||c)&&d){var h,f=this.chart.retrieveStacks(c,d),g=b.stack||0;for(h=0;h<f[g].series.length&&f[g].series[h]!==this;h++);e=10*f.totalStacks-10*(f.totalStacks-f[g].position)-h}b.zIndex=e}}),a.wrap(a.Series.prototype,"alignDataLabel",function(a){if(this.chart.is3d()&&("column"===this.type||"columnrange"===this.type)){var b=this,c=b.chart,d=c.options,e=d.chart.options3d,f={x:c.plotWidth/2,y:c.plotHeight/2,z:e.depth,vd:e.viewDistance},h=e.alpha,i=e.beta*(c.yAxis[0].opposite?-1:1),j=arguments,k=j[4],l={x:k.x,y:k.y,z:0};l=g([l],h,i,f)[0],k.x=l.x,k.y=l.y}a.apply(this,[].slice.call(arguments,1))}),a.seriesTypes.columnrange&&a.wrap(a.seriesTypes.columnrange.prototype,"drawPoints",l),a.wrap(a.seriesTypes.column.prototype,"drawPoints",l);var m=a.getOptions();m.plotOptions.cylinder=a.merge(m.plotOptions.column);var n=a.extendClass(a.seriesTypes.column,{type:"cylinder"});a.seriesTypes.cylinder=n,a.wrap(a.seriesTypes.cylinder.prototype,"translate",function(e){if(e.apply(this,[].slice.call(arguments,1)),this.chart.is3d()){var f=this,g=f.chart,h=g.options,i=h.plotOptions.cylinder,j=h.chart.options3d,k=i.depth||0,l={x:g.inverted?g.plotHeight/2:g.plotWidth/2,y:g.inverted?g.plotWidth/2:g.plotHeight/2,z:j.depth,vd:j.viewDistance},m=j.alpha,n=i.stacking?(this.options.stack||0)*k:f._i*k;n+=k/2,i.grouping!==!1&&(n=0),a.each(f.data,function(a){var e=a.shapeArgs;a.shapeType="arc3d",e.x+=k/2,e.z=n,e.start=0,e.end=2*b,e.r=.95*k,e.innerR=0,e.depth=e.height*(1/d((90-m)*c))-n,e.alpha=90-m,e.beta=0,e.origin=l})}}),a.wrap(a.seriesTypes.pie.prototype,"translate",function(b){if(b.apply(this,[].slice.call(arguments,1)),this.chart.is3d()){var g=this,h=g.chart,i=h.options,j=g.options,k=j.depth||0,l=i.chart.options3d,m={x:h.plotWidth/2,y:h.plotHeight/2,z:l.depth},n=l.alpha,o=l.beta,p=j.stacking?(j.stack||0)*k:g._i*k;p+=k/2,j.grouping!==!1&&(p=0),a.each(g.data,function(a){a.shapeType="arc3d";var b=a.shapeArgs;if(a.y){b.z=p,b.depth=.75*k,b.origin=m,b.alpha=n,b.beta=o;var h=(b.end+b.start)/2;a.slicedTranslation={translateX:f(e(h)*g.options.slicedOffset*e(n*c)),translateY:f(d(h)*g.options.slicedOffset*e(n*c))}}else b=null})}}),a.wrap(a.seriesTypes.pie.prototype.pointClass.prototype,"haloPath",function(a){var b=arguments;return this.series.chart.is3d()?[]:a.call(this,b[1])}),a.wrap(a.seriesTypes.pie.prototype,"drawPoints",function(b){if(this.chart.is3d()){var c=this.options,d=this.options.states;this.borderWidth=c.borderWidth=c.edgeWidth||1,this.borderColor=c.edgeColor=a.pick(c.edgeColor,c.borderColor,void 0),d.hover.borderColor=a.pick(d.hover.edgeColor,this.borderColor),d.hover.borderWidth=a.pick(d.hover.edgeWidth,this.borderWidth),d.select.borderColor=a.pick(d.select.edgeColor,this.borderColor),d.select.borderWidth=a.pick(d.select.edgeWidth,this.borderWidth),a.each(this.data,function(a){var b=a.pointAttr;b[""].stroke=a.series.borderColor||a.color,b[""]["stroke-width"]=a.series.borderWidth,b.hover.stroke=d.hover.borderColor,b.hover["stroke-width"]=d.hover.borderWidth,b.select.stroke=d.select.borderColor,b.select["stroke-width"]=d.select.borderWidth})}if(b.apply(this,[].slice.call(arguments,1)),this.chart.is3d()){var e=this.group;a.each(this.points,function(a){a.graphic.out.add(e),a.graphic.inn.add(e),a.graphic.side1.add(e),a.graphic.side2.add(e)})}}),a.wrap(a.seriesTypes.pie.prototype,"drawDataLabels",function(b){if(this.chart.is3d()){var f=this;a.each(f.data,function(a){var b=a.shapeArgs,f=b.r,g=b.depth,h=b.alpha*c,i=(b.start+b.end)/2,j=a.labelPos;j[1]+=-f*(1-e(h))*d(i)+(d(i)>0?d(h)*g:0),j[3]+=-f*(1-e(h))*d(i)+(d(i)>0?d(h)*g:0),j[5]+=-f*(1-e(h))*d(i)+(d(i)>0?d(h)*g:0)})}b.apply(this,[].slice.call(arguments,1))}),a.wrap(a.seriesTypes.pie.prototype,"addPoint",function(a){a.apply(this,[].slice.call(arguments,1)),this.chart.is3d()&&this.update()}),a.wrap(a.seriesTypes.pie.prototype,"animate",function(b){if(this.chart.is3d()){var f,c=arguments,d=c[1],e=this.options.animation,g=this.center,h=this.group,i=this.markerGroup;a.svg&&(e===!0&&(e={}),d?(h.oldtranslateX=h.translateX,h.oldtranslateY=h.translateY,f={translateX:g[0],translateY:g[1],scaleX:.001,scaleY:.001},h.attr(f),i&&(i.attrSetters=h.attrSetters,i.attr(f))):(f={translateX:h.oldtranslateX,translateY:h.oldtranslateY,scaleX:1,scaleY:1},h.animate(f,e),i&&i.animate(f,e),this.animate=null))}else b.apply(this,[].slice.call(arguments,1))}),a.wrap(a.seriesTypes.scatter.prototype,"translate",function(b){if(b.apply(this,[].slice.call(arguments,1)),this.chart.is3d()){var c=this,d=c.chart,e=c.chart.options.chart.options3d,f=e.alpha,h=e.beta,i={x:d.inverted?d.plotHeight/2:d.plotWidth/2,y:d.inverted?d.plotWidth/2:d.plotHeight/2,z:e.depth,vd:e.viewDistance},j=e.depth,k=d.options.zAxis||{min:0,max:j},l=j/(k.max-k.min);a.each(c.data,function(a){var b={x:a.plotX,y:a.plotY,z:(a.z-k.min)*l};b=g([b],f,h,i)[0],a.plotXold=a.plotX,a.plotYold=a.plotY,a.plotX=b.x,a.plotY=b.y,a.plotZ=b.z})}}),a.wrap(a.seriesTypes.scatter.prototype,"init",function(a){var b=a.apply(this,[].slice.call(arguments,1));if(this.chart.is3d()){this.pointArrayMap=["x","y","z"];var c="x: <b>{point.x}</b><br/>y: <b>{point.y}</b><br/>z: <b>{point.z}</b><br/>";this.userOptions.tooltip?this.tooltipOptions.pointFormat=this.userOptions.tooltip.pointFormat||c:this.tooltipOptions.pointFormat=c}return b}),a.VMLRenderer&&(a.setOptions({animate:!1}),a.VMLRenderer.prototype.cuboid=a.SVGRenderer.prototype.cuboid,a.VMLRenderer.prototype.cuboidPath=a.SVGRenderer.prototype.cuboidPath,a.VMLRenderer.prototype.toLinePath=a.SVGRenderer.prototype.toLinePath,a.VMLRenderer.prototype.createElement3D=a.SVGRenderer.prototype.createElement3D,a.VMLRenderer.prototype.arc3d=function(b){var c=a.SVGRenderer.prototype.arc3d.call(this,b);return c.css({zIndex:c.zIndex}),c},a.VMLRenderer.prototype.arc3dPath=a.SVGRenderer.prototype.arc3dPath,a.Chart.prototype.renderSeries=function(){for(var a,b=this.series.length;b--;)a=this.series[b],a.translate(),a.setTooltipPoints&&a.setTooltipPoints(),a.render()},a.wrap(a.Axis.prototype,"render",function(a){a.apply(this,[].slice.call(arguments,1)),this.sideFrame&&(this.sideFrame.css({zIndex:0}),this.sideFrame.front.attr({fill:this.sideFrame.color})),this.bottomFrame&&(this.bottomFrame.css({zIndex:1}),this.bottomFrame.front.attr({fill:this.bottomFrame.color})),this.backFrame&&(this.backFrame.css({zIndex:0}),this.backFrame.front.attr({fill:this.backFrame.color}))}))}(Highcharts);