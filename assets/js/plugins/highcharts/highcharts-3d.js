!function(a){function b(b,c,d,e){var f,k,l;d*=g,c*=g;var n,o,p,m=[];d*=-1,n=e.x,o=e.y,p=(0===e.z?1e-4:e.z)*(e.vd||25),p=Math.max(500,p);var u,v,w,q=h(d),r=i(d),s=h(c),t=i(c);return a.each(b,function(a){u=a.x-n,v=a.y-o,w=a.z||0,f=r*u-q*w,k=-q*s*u-r*s*w+t*v,l=q*t*u+r*t*w+s*v,f=f*((p-l)/p)+n,k=k*((p-l)/p)+o,m.push({x:j(f),y:j(k),z:j(l)})}),m}function c(a){return void 0!==a&&null!==a}function d(a,b,c,e,g,j,l,m){var n=[];return j>g&&j-g>f/2+1e-4?(n=n.concat(d(a,b,c,e,g,g+f/2,l,m)),n=n.concat(d(a,b,c,e,g+f/2,j,l,m))):j<g&&g-j>f/2+1e-4?(n=n.concat(d(a,b,c,e,g,g-f/2,l,m)),n=n.concat(d(a,b,c,e,g-f/2,j,l,m))):(n=j-g,["C",a+c*i(g)-c*k*n*h(g)+l,b+e*h(g)+e*k*n*i(g)+m,a+c*i(j)+c*k*n*h(j)+l,b+e*h(j)-e*k*n*i(j)+m,a+c*i(j)+l,b+e*h(j)+m])}function e(b){if(this.chart.is3d()){var c=this.chart.options.plotOptions.column.grouping;void 0!==c&&!c&&void 0!==this.group.zIndex&&this.group.attr({zIndex:10*this.group.zIndex});var d=this.options,e=this.options.states;this.borderWidth=d.borderWidth=d.edgeWidth||1,a.each(this.data,function(b){null!==b.y&&(b=b.pointAttr,this.borderColor=a.pick(d.edgeColor,b[""].fill),b[""].stroke=this.borderColor,b.hover.stroke=a.pick(e.hover.edgeColor,this.borderColor),b.select.stroke=a.pick(e.select.edgeColor,this.borderColor))})}b.apply(this,[].slice.call(arguments,1))}var f=Math.PI,g=f/180,h=Math.sin,i=Math.cos,j=Math.round,k=4*(Math.sqrt(2)-1)/3/(f/2);a.SVGRenderer.prototype.toLinePath=function(b,c){var d=[];return a.each(b,function(a){d.push("L",a.x,a.y)}),d[0]="M",c&&d.push("Z"),d},a.SVGRenderer.prototype.cuboid=function(b){var d=this.g(),b=this.cuboidPath(b);return d.front=this.path(b[0]).attr({zIndex:b[3],"stroke-linejoin":"round"}).add(d),d.top=this.path(b[1]).attr({zIndex:b[4],"stroke-linejoin":"round"}).add(d),d.side=this.path(b[2]).attr({zIndex:b[5],"stroke-linejoin":"round"}).add(d),d.fillSetter=function(b){var c=a.Color(b).brighten(.1).get(),d=a.Color(b).brighten(-.1).get();return this.front.attr({fill:b}),this.top.attr({fill:c}),this.side.attr({fill:d}),this.color=b,this},d.opacitySetter=function(a){return this.front.attr({opacity:a}),this.top.attr({opacity:a}),this.side.attr({opacity:a}),this},d.attr=function(b){return b.shapeArgs||c(b.x)?(b=this.renderer.cuboidPath(b.shapeArgs||b),this.front.attr({d:b[0],zIndex:b[3]}),this.top.attr({d:b[1],zIndex:b[4]}),this.side.attr({d:b[2],zIndex:b[5]})):a.SVGElement.prototype.attr.call(this,b),this},d.animate=function(b,d,e){return c(b.x)&&c(b.y)?(b=this.renderer.cuboidPath(b),this.front.attr({zIndex:b[3]}).animate({d:b[0]},d,e),this.top.attr({zIndex:b[4]}).animate({d:b[1]},d,e),this.side.attr({zIndex:b[5]}).animate({d:b[2]},d,e)):b.opacity?(this.front.animate(b,d,e),this.top.animate(b,d,e),this.side.animate(b,d,e)):a.SVGElement.prototype.animate.call(this,b,d,e),this},d.destroy=function(){return this.front.destroy(),this.top.destroy(),this.side.destroy(),null},d.attr({zIndex:-b[3]}),d},a.SVGRenderer.prototype.cuboidPath=function(a){var c=a.x,d=a.y,e=a.z,f=a.height,g=a.width,h=a.depth,i=a.alpha,j=a.beta,c=[{x:c,y:d,z:e},{x:c+g,y:d,z:e},{x:c+g,y:d+f,z:e},{x:c,y:d+f,z:e},{x:c,y:d+f,z:e+h},{x:c+g,y:d+f,z:e+h},{x:c+g,y:d,z:e+h},{x:c,y:d,z:e+h}],c=b(c,i,j,a.origin),a=["M",c[0].x,c[0].y,"L",c[7].x,c[7].y,"L",c[6].x,c[6].y,"L",c[1].x,c[1].y,"Z"],d=["M",c[3].x,c[3].y,"L",c[2].x,c[2].y,"L",c[5].x,c[5].y,"L",c[4].x,c[4].y,"Z"],e=["M",c[1].x,c[1].y,"L",c[2].x,c[2].y,"L",c[5].x,c[5].y,"L",c[6].x,c[6].y,"Z"],f=["M",c[0].x,c[0].y,"L",c[7].x,c[7].y,"L",c[4].x,c[4].y,"L",c[3].x,c[3].y,"Z"];return[["M",c[0].x,c[0].y,"L",c[1].x,c[1].y,"L",c[2].x,c[2].y,"L",c[3].x,c[3].y,"Z"],c[7].y<c[1].y?a:c[4].y>c[2].y?d:[],c[6].x>c[1].x?e:c[7].x<c[0].x?f:[],(c[0].z+c[1].z+c[2].z+c[3].z)/4,j>0?(c[0].z+c[7].z+c[6].z+c[1].z)/4:(c[3].z+c[2].z+c[5].z+c[4].z)/4,i>0?(c[1].z+c[2].z+c[5].z+c[6].z)/4:(c[0].z+c[7].z+c[4].z+c[3].z)/4]},a.SVGRenderer.prototype.arc3d=function(b){b.alpha*=g,b.beta*=g;var d=this.g(),e=this.arc3dPath(b),f=d.renderer,h=100*e.zTop;return d.shapeArgs=b,d.top=f.path(e.top).attr({zIndex:e.zTop}).add(d),d.side1=f.path(e.side2).attr({zIndex:e.zSide2}),d.side2=f.path(e.side1).attr({zIndex:e.zSide1}),d.inn=f.path(e.inn).attr({zIndex:e.zInn}),d.out=f.path(e.out).attr({zIndex:e.zOut}),d.fillSetter=function(b){this.color=b;var c=a.Color(b).brighten(-.1).get();return this.side1.attr({fill:c}),this.side2.attr({fill:c}),this.inn.attr({fill:c}),this.out.attr({fill:c}),this.top.attr({fill:b}),this},d.translateXSetter=function(a){this.out.attr({translateX:a}),this.inn.attr({translateX:a}),this.side1.attr({translateX:a}),this.side2.attr({translateX:a}),this.top.attr({translateX:a})},d.translateYSetter=function(a){this.out.attr({translateY:a}),this.inn.attr({translateY:a}),this.side1.attr({translateY:a}),this.side2.attr({translateY:a}),this.top.attr({translateY:a})},d.animate=function(b,d,e){return c(b.end)||c(b.start)?(this._shapeArgs=this.shapeArgs,a.SVGElement.prototype.animate.call(this,{_args:b},{duration:d,step:function(){var b=arguments[1],c=b.elem,d=c._shapeArgs,e=b.end,b=b.pos,d=a.merge(d,{x:d.x+(e.x-d.x)*b,y:d.y+(e.y-d.y)*b,r:d.r+(e.r-d.r)*b,innerR:d.innerR+(e.innerR-d.innerR)*b,start:d.start+(e.start-d.start)*b,end:d.end+(e.end-d.end)*b}),e=c.renderer.arc3dPath(d);c.shapeArgs=d,c.top.attr({d:e.top,zIndex:e.zTop}),c.inn.attr({d:e.inn,zIndex:e.zInn}),c.out.attr({d:e.out,zIndex:e.zOut}),c.side1.attr({d:e.side1,zIndex:e.zSide1}),c.side2.attr({d:e.side2,zIndex:e.zSide2})}},e)):a.SVGElement.prototype.animate.call(this,b,d,e),this},d.destroy=function(){this.top.destroy(),this.out.destroy(),this.inn.destroy(),this.side1.destroy(),this.side2.destroy(),a.SVGElement.prototype.destroy.call(this)},d.hide=function(){this.top.hide(),this.out.hide(),this.inn.hide(),this.side1.hide(),this.side2.hide()},d.show=function(){this.top.show(),this.out.show(),this.inn.show(),this.side1.show(),this.side2.show()},d.zIndex=h,d.attr({zIndex:h}),d},a.SVGRenderer.prototype.arc3dPath=function(a){var b=a.x,c=a.y,e=a.start,g=a.end-1e-5,j=a.r,k=a.innerR,l=a.depth,m=a.alpha,n=a.beta,o=i(e),p=h(e),a=i(g),q=h(g),r=j*i(n),s=j*i(m),t=k*i(n);k*=i(m);var u=l*h(n),v=l*h(m),l=["M",b+r*o,c+s*p],l=l.concat(d(b,c,r,s,e,g,0,0)),l=l.concat(["L",b+t*a,c+k*q]),l=l.concat(d(b,c,t,k,g,e,0,0)),l=l.concat(["Z"]),n=n>0?f/2:0,m=m>0?0:f/2,n=e>-n?e:g>-n?-n:e,w=g<f-m?g:e<f-m?f-m:g,m=["M",b+r*i(n),c+s*h(n)],m=m.concat(d(b,c,r,s,n,w,0,0)),m=m.concat(["L",b+r*i(w)+u,c+s*h(w)+v]),m=m.concat(d(b,c,r,s,w,n,u,v)),m=m.concat(["Z"]),n=["M",b+t*o,c+k*p],n=n.concat(d(b,c,t,k,e,g,0,0)),n=n.concat(["L",b+t*i(g)+u,c+k*h(g)+v]),n=n.concat(d(b,c,t,k,g,e,u,v)),n=n.concat(["Z"]),o=["M",b+r*o,c+s*p,"L",b+r*o+u,c+s*p+v,"L",b+t*o+u,c+k*p+v,"L",b+t*o,c+k*p,"Z"],b=["M",b+r*a,c+s*q,"L",b+r*a+u,c+s*q+v,"L",b+t*a+u,c+k*q+v,"L",b+t*a,c+k*q,"Z"],c=h((e+g)/2),e=h(e),g=h(g);return{top:l,zTop:j,out:m,zOut:Math.max(c,e,g)*j,inn:n,zInn:Math.max(c,e,g)*j,side1:o,zSide1:e*j*.99,side2:b,zSide2:g*j*.99}},a.Chart.prototype.is3d=function(){return this.options.chart.options3d&&this.options.chart.options3d.enabled},a.wrap(a.Chart.prototype,"isInsidePlot",function(a){return!!this.is3d()||a.apply(this,[].slice.call(arguments,1))}),a.getOptions().chart.options3d={enabled:!1,alpha:0,beta:0,depth:100,viewDistance:25,frame:{bottom:{size:1,color:"rgba(255,255,255,0)"},side:{size:1,color:"rgba(255,255,255,0)"},back:{size:1,color:"rgba(255,255,255,0)"}}},a.wrap(a.Chart.prototype,"init",function(b){var d,c=[].slice.call(arguments,1);c[0].chart.options3d&&c[0].chart.options3d.enabled&&(d=c[0].plotOptions||{},d=d.pie||{},d.borderColor=a.pick(d.borderColor,void 0)),b.apply(this,c)}),a.wrap(a.Chart.prototype,"setChartSize",function(a){if(a.apply(this,[].slice.call(arguments,1)),this.is3d()){var b=this.inverted,c=this.clipBox,d=this.margin;c[b?"y":"x"]=-(d[3]||0),c[b?"x":"y"]=-(d[0]||0),c[b?"height":"width"]=this.chartWidth+(d[3]||0)+(d[1]||0),c[b?"width":"height"]=this.chartHeight+(d[0]||0)+(d[2]||0)}}),a.wrap(a.Chart.prototype,"redraw",function(a){this.is3d()&&(this.isDirtyBox=!0),a.apply(this,[].slice.call(arguments,1))}),a.Chart.prototype.retrieveStacks=function(b,c){var d={},e=1;return b||!c?this.series:(a.each(this.series,function(a){d[a.options.stack||0]?d[a.options.stack||0].series.push(a):(d[a.options.stack||0]={series:[a],position:e},e++)}),d.totalStacks=e+1,d)},a.wrap(a.Axis.prototype,"init",function(b){var c=arguments;c[1].is3d()&&(c[2].tickWidth=a.pick(c[2].tickWidth,0),c[2].gridLineWidth=a.pick(c[2].gridLineWidth,1)),b.apply(this,[].slice.call(arguments,1))}),a.wrap(a.Axis.prototype,"render",function(a){if(a.apply(this,[].slice.call(arguments,1)),this.chart.is3d()){var b=this.chart,c=b.renderer,d=b.options.chart.options3d,e=d.alpha,f=d.beta*(b.yAxis[0].opposite?-1:1),g=d.frame,h=g.bottom,i=g.back,g=g.side,j=d.depth,k=this.height,l=this.width,m=this.left,n=this.top,d={x:b.plotLeft+b.plotWidth/2,y:b.plotTop+b.plotHeight/2,z:j,vd:d.viewDistance};if(this.horiz)this.axisLine&&this.axisLine.hide(),f={x:m,y:n+(b.yAxis[0].reversed?-h.size:k),z:0,width:l,height:h.size,depth:j,alpha:e,beta:f,origin:d},this.bottomFrame?this.bottomFrame.animate(f):this.bottomFrame=c.cuboid(f).attr({fill:h.color,zIndex:b.yAxis[0].reversed&&e>0?4:-1}).css({stroke:h.color}).add();else{var o={x:m,y:n,z:j+1,width:l,height:k+h.size,depth:i.size,alpha:e,beta:f,origin:d};this.backFrame?this.backFrame.animate(o):this.backFrame=c.cuboid(o).attr({fill:i.color,zIndex:-3}).css({stroke:i.color}).add(),this.axisLine&&this.axisLine.hide(),b={x:(b.yAxis[0].opposite?l:0)+m-g.size,y:n,z:0,width:g.size,height:k+h.size,depth:j+i.size,alpha:e,beta:f,origin:d},this.sideFrame?this.sideFrame.animate(b):this.sideFrame=c.cuboid(b).attr({fill:g.color,zIndex:-2}).css({stroke:g.color}).add()}}}),a.wrap(a.Axis.prototype,"getPlotLinePath",function(a){var c=a.apply(this,[].slice.call(arguments,1));if(!this.chart.is3d())return c;if(null===c)return c;var d=this.chart,e=d.options.chart.options3d,f=e.depth;e.origin={x:d.plotLeft+d.plotWidth/2,y:d.plotTop+d.plotHeight/2,z:f,vd:e.viewDistance};var c=[{x:c[1],y:c[2],z:this.horiz||this.opposite?f:0},{x:c[1],y:c[2],z:f},{x:c[4],y:c[5],z:f},{x:c[4],y:c[5],z:this.horiz||this.opposite?0:f}],f=d.options.inverted?e.beta:e.alpha,g=d.options.inverted?e.alpha:e.beta;return g*=d.yAxis[0].opposite?-1:1,c=b(c,f,g,e.origin),c=this.chart.renderer.toLinePath(c,!1)}),a.wrap(a.Axis.prototype,"getPlotBandPath",function(a){if(this.chart.is3d()){var b=arguments,c=b[1],b=this.getPlotLinePath(b[2]);return(c=this.getPlotLinePath(c))&&b?c.push(b[7],b[8],b[4],b[5],b[1],b[2]):c=null,c}return a.apply(this,[].slice.call(arguments,1))}),a.wrap(a.Tick.prototype,"getMarkPath",function(a){var c=a.apply(this,[].slice.call(arguments,1));if(!this.axis.chart.is3d())return c;var d=this.axis.chart,e=d.options.chart.options3d,f={x:d.plotLeft+d.plotWidth/2,y:d.plotTop+d.plotHeight/2,z:e.depth,vd:e.viewDistance},c=[{x:c[1],y:c[2],z:0},{x:c[4],y:c[5],z:0}],g=d.inverted?e.beta:e.alpha,e=d.inverted?e.alpha:e.beta;return e*=d.yAxis[0].opposite?-1:1,c=b(c,g,e,f),c=["M",c[0].x,c[0].y,"L",c[1].x,c[1].y]}),a.wrap(a.Tick.prototype,"getLabelPosition",function(a){var c=a.apply(this,[].slice.call(arguments,1));if(!this.axis.chart.is3d())return c;var d=this.axis.chart,e=d.options.chart.options3d,f={x:d.plotLeft+d.plotWidth/2,y:d.plotTop+d.plotHeight/2,z:e.depth,vd:e.viewDistance},g=d.inverted?e.beta:e.alpha,e=d.inverted?e.alpha:e.beta;return e*=d.yAxis[0].opposite?-1:1,c=b([{x:c.x,y:c.y,z:0}],g,e,f)[0]}),a.wrap(a.Axis.prototype,"drawCrosshair",function(a){var b=arguments;this.chart.is3d()&&b[2]&&(b[2]={plotX:b[2].plotXold||b[2].plotX,plotY:b[2].plotYold||b[2].plotY}),a.apply(this,[].slice.call(b,1))}),a.wrap(a.seriesTypes.column.prototype,"translate",function(c){if(c.apply(this,[].slice.call(arguments,1)),this.chart.is3d()){var d=this.chart,e=this.options,f=d.options.chart.options3d,g=e.depth||25,h={x:d.plotWidth/2,y:d.plotHeight/2,z:f.depth,vd:f.viewDistance},i=f.alpha,j=f.beta*(d.yAxis[0].opposite?-1:1),k=(e.stacking?e.stack||0:this._i)*(g+(e.groupZPadding||1));e.grouping!==!1&&(k=0),k+=e.groupZPadding||1,a.each(this.data,function(a){if(null!==a.y){var c=a.shapeArgs,d=a.tooltipPos;a.shapeType="cuboid",c.alpha=i,c.beta=j,c.z=k,c.origin=h,c.depth=g,d=b([{x:d[0],y:d[1],z:k}],i,j,h)[0],a.tooltipPos=[d.x,d.y]}})}}),a.wrap(a.seriesTypes.column.prototype,"animate",function(b){if(this.chart.is3d()){var c=arguments[1],d=this.yAxis,e=this,f=this.yAxis.reversed;a.svg&&(c?a.each(e.data,function(a){null===a.y||(a.height=a.shapeArgs.height,a.shapey=a.shapeArgs.y,a.shapeArgs.height=1,f)||(a.shapeArgs.y=a.stackY?a.plotY+d.translate(a.stackY):a.plotY+(a.negative?-a.height:a.height))}):(a.each(e.data,function(a){null!==a.y&&(a.shapeArgs.height=a.height,a.shapeArgs.y=a.shapey,a.graphic&&a.graphic.animate(a.shapeArgs,e.options.animation))}),this.drawDataLabels(),e.animate=null))}else b.apply(this,[].slice.call(arguments,1))}),a.wrap(a.seriesTypes.column.prototype,"init",function(a){if(a.apply(this,[].slice.call(arguments,1)),this.chart.is3d()){var b=this.options,c=b.grouping,d=b.stacking,e=0;if((void 0===c||c)&&d){for(c=this.chart.retrieveStacks(c,d),d=b.stack||0,e=0;e<c[d].series.length&&c[d].series[e]!==this;e++);e=10*c.totalStacks-10*(c.totalStacks-c[d].position)-e}b.zIndex=e}}),a.wrap(a.Series.prototype,"alignDataLabel",function(a){if(this.chart.is3d()&&("column"===this.type||"columnrange"===this.type)){var c=this.chart,d=c.options.chart.options3d,e=arguments[4],f={x:e.x,y:e.y,z:0},f=b([f],d.alpha,d.beta*(c.yAxis[0].opposite?-1:1),{x:c.plotWidth/2,y:c.plotHeight/2,z:d.depth,vd:d.viewDistance})[0];e.x=f.x,e.y=f.y}a.apply(this,[].slice.call(arguments,1))}),a.seriesTypes.columnrange&&a.wrap(a.seriesTypes.columnrange.prototype,"drawPoints",e),a.wrap(a.seriesTypes.column.prototype,"drawPoints",e);var l=a.getOptions();l.plotOptions.cylinder=a.merge(l.plotOptions.column),l=a.extendClass(a.seriesTypes.column,{type:"cylinder"}),a.seriesTypes.cylinder=l,a.wrap(a.seriesTypes.cylinder.prototype,"translate",function(b){if(b.apply(this,[].slice.call(arguments,1)),this.chart.is3d()){var c=this.chart,d=c.options,e=d.plotOptions.cylinder,d=d.chart.options3d,i=e.depth||0,j={x:c.inverted?c.plotHeight/2:c.plotWidth/2,y:c.inverted?c.plotWidth/2:c.plotHeight/2,z:d.depth,vd:d.viewDistance},k=d.alpha,l=e.stacking?(this.options.stack||0)*i:this._i*i;l+=i/2,e.grouping!==!1&&(l=0),a.each(this.data,function(a){var b=a.shapeArgs;a.shapeType="arc3d",b.x+=i/2,b.z=l,b.start=0,b.end=2*f,b.r=.95*i,b.innerR=0,b.depth=b.height*(1/h((90-k)*g))-l,b.alpha=90-k,b.beta=0,b.origin=j})}}),a.wrap(a.seriesTypes.pie.prototype,"translate",function(b){if(b.apply(this,[].slice.call(arguments,1)),this.chart.is3d()){var c=this,d=c.chart,e=c.options,f=e.depth||0,k=d.options.chart.options3d,l={x:d.plotWidth/2,y:d.plotHeight/2,z:k.depth},m=k.alpha,n=k.beta,o=e.stacking?(e.stack||0)*f:c._i*f;o+=f/2,e.grouping!==!1&&(o=0),a.each(c.data,function(a){a.shapeType="arc3d";var b=a.shapeArgs;a.y&&(b.z=o,b.depth=.75*f,b.origin=l,b.alpha=m,b.beta=n,b=(b.end+b.start)/2,a.slicedTranslation={translateX:j(i(b)*c.options.slicedOffset*i(m*g)),translateY:j(h(b)*c.options.slicedOffset*i(m*g))})})}}),a.wrap(a.seriesTypes.pie.prototype.pointClass.prototype,"haloPath",function(a){var b=arguments;return this.series.chart.is3d()?[]:a.call(this,b[1])}),a.wrap(a.seriesTypes.pie.prototype,"drawPoints",function(b){if(this.chart.is3d()){var c=this.options,d=this.options.states;this.borderWidth=c.borderWidth=c.edgeWidth||1,this.borderColor=c.edgeColor=a.pick(c.edgeColor,c.borderColor,void 0),d.hover.borderColor=a.pick(d.hover.edgeColor,this.borderColor),d.hover.borderWidth=a.pick(d.hover.edgeWidth,this.borderWidth),d.select.borderColor=a.pick(d.select.edgeColor,this.borderColor),d.select.borderWidth=a.pick(d.select.edgeWidth,this.borderWidth),a.each(this.data,function(a){var b=a.pointAttr;b[""].stroke=a.series.borderColor||a.color,b[""]["stroke-width"]=a.series.borderWidth,b.hover.stroke=d.hover.borderColor,b.hover["stroke-width"]=d.hover.borderWidth,b.select.stroke=d.select.borderColor,b.select["stroke-width"]=d.select.borderWidth})}if(b.apply(this,[].slice.call(arguments,1)),this.chart.is3d()){var e=this.group;a.each(this.points,function(a){a.graphic.out.add(e),a.graphic.inn.add(e),a.graphic.side1.add(e),a.graphic.side2.add(e)})}}),a.wrap(a.seriesTypes.pie.prototype,"drawDataLabels",function(b){this.chart.is3d()&&a.each(this.data,function(a){var b=a.shapeArgs,c=b.r,d=b.depth,e=b.alpha*g,b=(b.start+b.end)/2,a=a.labelPos;a[1]+=-c*(1-i(e))*h(b)+(h(b)>0?h(e)*d:0),a[3]+=-c*(1-i(e))*h(b)+(h(b)>0?h(e)*d:0),a[5]+=-c*(1-i(e))*h(b)+(h(b)>0?h(e)*d:0)}),b.apply(this,[].slice.call(arguments,1))}),a.wrap(a.seriesTypes.pie.prototype,"addPoint",function(a){a.apply(this,[].slice.call(arguments,1)),this.chart.is3d()&&this.update()}),a.wrap(a.seriesTypes.pie.prototype,"animate",function(b){if(this.chart.is3d()){var c=arguments[1],d=this.options.animation,e=this.center,f=this.group,g=this.markerGroup;a.svg&&(d===!0&&(d={}),c?(f.oldtranslateX=f.translateX,f.oldtranslateY=f.translateY,c={translateX:e[0],translateY:e[1],scaleX:.001,scaleY:.001},f.attr(c),g&&(g.attrSetters=f.attrSetters,g.attr(c))):(c={translateX:f.oldtranslateX,translateY:f.oldtranslateY,scaleX:1,scaleY:1},f.animate(c,d),g&&g.animate(c,d),this.animate=null))}else b.apply(this,[].slice.call(arguments,1))}),a.wrap(a.seriesTypes.scatter.prototype,"translate",function(c){if(c.apply(this,[].slice.call(arguments,1)),this.chart.is3d()){var d=this.chart,e=this.chart.options.chart.options3d,f=e.alpha,g=e.beta,h={x:d.inverted?d.plotHeight/2:d.plotWidth/2,y:d.inverted?d.plotWidth/2:d.plotHeight/2,z:e.depth,vd:e.viewDistance},e=e.depth,i=d.options.zAxis||{min:0,max:e},j=e/(i.max-i.min);a.each(this.data,function(a){var c={x:a.plotX,y:a.plotY,z:(a.z-i.min)*j},c=b([c],f,g,h)[0];a.plotXold=a.plotX,a.plotYold=a.plotY,a.plotX=c.x,a.plotY=c.y,a.plotZ=c.z})}}),a.wrap(a.seriesTypes.scatter.prototype,"init",function(a){var b=a.apply(this,[].slice.call(arguments,1));return this.chart.is3d()&&(this.pointArrayMap=["x","y","z"],this.tooltipOptions.pointFormat=this.userOptions.tooltip?this.userOptions.tooltip.pointFormat||"x: <b>{point.x}</b><br/>y: <b>{point.y}</b><br/>z: <b>{point.z}</b><br/>":"x: <b>{point.x}</b><br/>y: <b>{point.y}</b><br/>z: <b>{point.z}</b><br/>"),b}),a.VMLRenderer&&(a.setOptions({animate:!1}),a.VMLRenderer.prototype.cuboid=a.SVGRenderer.prototype.cuboid,a.VMLRenderer.prototype.cuboidPath=a.SVGRenderer.prototype.cuboidPath,a.VMLRenderer.prototype.toLinePath=a.SVGRenderer.prototype.toLinePath,a.VMLRenderer.prototype.createElement3D=a.SVGRenderer.prototype.createElement3D,a.VMLRenderer.prototype.arc3d=function(b){return b=a.SVGRenderer.prototype.arc3d.call(this,b),b.css({zIndex:b.zIndex}),b},a.VMLRenderer.prototype.arc3dPath=a.SVGRenderer.prototype.arc3dPath,a.Chart.prototype.renderSeries=function(){for(var a,b=this.series.length;b--;)a=this.series[b],a.translate(),a.setTooltipPoints&&a.setTooltipPoints(),a.render()},a.wrap(a.Axis.prototype,"render",function(a){a.apply(this,[].slice.call(arguments,1)),this.sideFrame&&(this.sideFrame.css({zIndex:0}),this.sideFrame.front.attr({fill:this.sideFrame.color})),this.bottomFrame&&(this.bottomFrame.css({zIndex:1}),this.bottomFrame.front.attr({fill:this.bottomFrame.color})),this.backFrame&&(this.backFrame.css({zIndex:0}),this.backFrame.front.attr({fill:this.backFrame.color}))}))}(Highcharts);