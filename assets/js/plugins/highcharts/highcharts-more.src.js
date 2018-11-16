!function(a,b){function C(a,b,c){this.init.call(this,a,b,c)}var c=a.arrayMin,d=a.arrayMax,e=a.each,f=a.extend,g=a.merge,h=a.map,i=a.pick,j=a.pInt,k=a.getOptions().plotOptions,l=a.seriesTypes,m=a.extendClass,n=a.splat,o=a.wrap,p=a.Axis,q=a.Tick,r=a.Point,s=a.Pointer,t=a.CenteredSeriesMixin,u=a.TrackerMixin,v=a.Series,w=Math,x=w.round,y=w.floor,z=w.max,A=a.Color,B=function(){};f(C.prototype,{init:function(a,b,c){var f,d=this,h=d.defaultOptions;d.chart=b,b.angular&&(h.background={}),d.options=a=g(h,a),f=a.background,f&&e([].concat(n(f)).reverse(),function(a){var b=a.backgroundColor;a=g(d.defaultBackgroundOptions,a),b&&(a.backgroundColor=b),a.color=a.backgroundColor,c.options.plotBands.unshift(a)})},defaultOptions:{center:["50%","50%"],size:"85%",startAngle:0},defaultBackgroundOptions:{shape:"circle",borderWidth:1,borderColor:"silver",backgroundColor:{linearGradient:{x1:0,y1:0,x2:0,y2:1},stops:[[0,"#FFF"],[1,"#DDD"]]},from:-Number.MAX_VALUE,innerRadius:0,to:Number.MAX_VALUE,outerRadius:"105%"}});var D=p.prototype,E=q.prototype,F={getOffset:B,redraw:function(){this.isDirty=!1},render:function(){this.isDirty=!1},setScale:B,setCategories:B,setTitle:B},G={isRadial:!0,defaultRadialGaugeOptions:{labels:{align:"center",x:0,y:null},minorGridLineWidth:0,minorTickInterval:"auto",minorTickLength:10,minorTickPosition:"inside",minorTickWidth:1,tickLength:10,tickPosition:"inside",tickWidth:2,title:{rotation:0},zIndex:2},defaultRadialXOptions:{gridLineWidth:1,labels:{align:null,distance:15,x:0,y:null},maxPadding:0,minPadding:0,showLastLabel:!1,tickLength:0},defaultRadialYOptions:{gridLineInterpolation:"circle",labels:{align:"right",x:-3,y:-2},showLastLabel:!1,title:{x:4,text:null,rotation:90}},setOptions:function(a){var b=this.options=g(this.defaultOptions,this.defaultRadialOptions,a);b.plotBands||(b.plotBands=[])},getOffset:function(){D.getOffset.call(this),this.chart.axisOffset[this.side]=0,this.center=this.pane.center=t.getCenter.call(this.pane)},getLinePath:function(a,b){var c=this.center;return b=i(b,c[2]/2-this.offset),this.chart.renderer.symbols.arc(this.left+c[0],this.top+c[1],b,b,{start:this.startAngleRad,end:this.endAngleRad,open:!0,innerR:0})},setAxisTranslation:function(){D.setAxisTranslation.call(this),this.center&&(this.isCircular?this.transA=(this.endAngleRad-this.startAngleRad)/(this.max-this.min||1):this.transA=this.center[2]/2/(this.max-this.min||1),this.isXAxis?this.minPixelPadding=this.transA*this.minPointOffset:this.minPixelPadding=0)},beforeSetTickPositions:function(){this.autoConnect&&(this.max+=this.categories&&1||this.pointRange||this.closestPointRange||0)},setAxisSize:function(){D.setAxisSize.call(this),this.isRadial&&(this.center=this.pane.center=a.CenteredSeriesMixin.getCenter.call(this.pane),this.isCircular&&(this.sector=this.endAngleRad-this.startAngleRad),this.len=this.width=this.height=this.center[2]*i(this.sector,1)/2)},getPosition:function(a,b){return this.postTranslate(this.isCircular?this.translate(a):0,i(this.isCircular?b:this.translate(a),this.center[2]/2)-this.offset)},postTranslate:function(a,b){var c=this.chart,d=this.center;return a=this.startAngleRad+a,{x:c.plotLeft+d[0]+Math.cos(a)*b,y:c.plotTop+d[1]+Math.sin(a)*b}},getPlotBandPath:function(a,b,c){var l,m,n,p,d=this.center,e=this.startAngleRad,f=d[2]/2,g=[i(c.outerRadius,"100%"),c.innerRadius,i(c.thickness,10)],k=/%$/,o=this.isCircular;return"polygon"===this.options.gridLineInterpolation?p=this.getPlotLinePath(a).concat(this.getPlotLinePath(b,!0)):(o||(g[0]=this.translate(a),g[1]=this.translate(b)),g=h(g,function(a){return k.test(a)&&(a=j(a,10)*f/100),a}),"circle"!==c.shape&&o?(l=e+this.translate(a),m=e+this.translate(b)):(l=-Math.PI/2,m=1.5*Math.PI,n=!0),p=this.chart.renderer.symbols.arc(this.left+d[0],this.top+d[1],g[0],g[0],{start:l,end:m,innerR:i(g[1],g[0]-g[2]),open:n})),p},getPlotLinePath:function(a,b){var h,i,j,k,c=this,d=c.center,f=c.chart,g=c.getPosition(a);return c.isCircular?k=["M",d[0]+f.plotLeft,d[1]+f.plotTop,"L",g.x,g.y]:"circle"===c.options.gridLineInterpolation?(a=c.translate(a),a&&(k=c.getLinePath(0,a))):(e(f.xAxis,function(a){a.pane===c.pane&&(h=a)}),k=[],a=c.translate(a),j=h.tickPositions,h.autoConnect&&(j=j.concat([j[0]])),b&&(j=[].concat(j).reverse()),e(j,function(b,c){i=h.getPosition(b,a),k.push(c?"L":"M",i.x,i.y)})),k},getTitlePosition:function(){var a=this.center,b=this.chart,c=this.options.title;return{x:b.plotLeft+a[0]+(c.x||0),y:b.plotTop+a[1]-{high:.5,middle:.25,low:0}[c.align]*a[2]+(c.y||0)}}};o(D,"init",function(a,c,d){var m,o,p,q,t,u,e=this,h=c.angular,j=c.polar,k=d.isX,l=h&&k,r=c.options,s=d.pane||0;h?(f(this,l?F:G),m=!k,m&&(this.defaultRadialOptions=this.defaultRadialGaugeOptions)):j&&(f(this,G),m=k,this.defaultRadialOptions=k?this.defaultRadialXOptions:g(this.defaultYAxisOptions,this.defaultRadialYOptions)),a.call(this,c,d),l||!h&&!j||(q=this.options,c.panes||(c.panes=[]),this.pane=t=c.panes[s]=c.panes[s]||new C(n(r.pane)[s],c,e),u=t.options,c.inverted=!1,r.chart.zoomType=null,this.startAngleRad=o=(u.startAngle-90)*Math.PI/180,this.endAngleRad=p=(i(u.endAngle,u.startAngle+360)-90)*Math.PI/180,this.offset=q.offset||0,this.isCircular=m,m&&d.max===b&&p-o===2*Math.PI&&(this.autoConnect=!0))}),o(E,"getPosition",function(a,b,c,d,e){var f=this.axis;return f.getPosition?f.getPosition(c):a.call(this,b,c,d,e)}),o(E,"getLabelPosition",function(a,b,c,d,e,f,g,h,j){var m,k=this.axis,l=f.y,n=f.align,o=(k.translate(this.pos)+k.startAngleRad+Math.PI/2)/Math.PI*180%360;return k.isRadial?(m=k.getPosition(this.pos,k.center[2]/2+i(f.distance,-25)),"auto"===f.rotation?d.attr({rotation:o}):null===l&&(l=k.chart.renderer.fontMetrics(d.styles.fontSize).b-d.getBBox().height/2),null===n&&(n=k.isCircular?o>20&&o<160?"left":o>200&&o<340?"right":"center":"center",d.attr({align:n})),m.x+=f.x,m.y+=l):m=a.call(this,b,c,d,e,f,g,h,j),m}),o(E,"getMarkPath",function(a,b,c,d,e,f,g){var i,j,h=this.axis;return h.isRadial?(i=h.getPosition(this.pos,h.center[2]/2+d),j=["M",b,c,"L",i.x,i.y]):j=a.call(this,b,c,d,e,f,g),j}),k.arearange=g(k.area,{lineWidth:1,marker:null,threshold:null,tooltip:{pointFormat:'<span style="color:{series.color}">●</span> {series.name}: <b>{point.low}</b> - <b>{point.high}</b><br/>'},trackByArea:!0,dataLabels:{align:null,verticalAlign:null,xLow:0,xHigh:0,yLow:0,yHigh:0},states:{hover:{halo:!1}}}),l.arearange=m(l.area,{type:"arearange",pointArrayMap:["low","high"],toYData:function(a){return[a.low,a.high]},pointValKey:"low",getSegments:function(){var a=this;e(a.points,function(b){a.options.connectNulls||null!==b.low&&null!==b.high?null===b.low&&null!==b.high&&(b.y=b.high):b.y=null}),v.prototype.getSegments.call(this)},translate:function(){var a=this,b=a.yAxis;l.area.prototype.translate.apply(a),e(a.points,function(a){var c=a.low,d=a.high,e=a.plotY;null===d&&null===c?a.y=null:null===c?(a.plotLow=a.plotY=null,a.plotHigh=b.translate(d,0,1,0,1)):null===d?(a.plotLow=e,a.plotHigh=null):(a.plotLow=e,a.plotHigh=b.translate(d,0,1,0,1))})},getSegmentPath:function(a){var b,f,g,h,k,c=[],d=a.length,e=v.prototype.getSegmentPath,i=this.options,j=i.step;for(b=HighchartsAdapter.grep(a,function(a){return null!==a.plotLow});d--;)f=a[d],null!==f.plotHigh&&c.push({plotX:f.plotX,plotY:f.plotHigh});return h=e.call(this,b),j&&(j===!0&&(j="left"),i.step={left:"right",center:"center",right:"left"}[j]),k=e.call(this,c),i.step=j,g=[].concat(h,k),k[0]="L",this.areaPath=this.areaPath.concat(h,k),g},drawDataLabels:function(){var c,h,a=this.data,b=a.length,d=[],e=v.prototype,f=this.options.dataLabels,g=f.align,i=this.chart.inverted;if(f.enabled||this._hasPointLabels){for(c=b;c--;)h=a[c],h.y=h.high,h._plotY=h.plotY,h.plotY=h.plotHigh,d[c]=h.dataLabel,h.dataLabel=h.dataLabelUpper,h.below=!1,i?(g||(f.align="left"),f.x=f.xHigh):f.y=f.yHigh;for(e.drawDataLabels&&e.drawDataLabels.apply(this,arguments),c=b;c--;)h=a[c],h.dataLabelUpper=h.dataLabel,h.dataLabel=d[c],h.y=h.low,h.plotY=h._plotY,h.below=!0,i?(g||(f.align="right"),f.x=f.xLow):f.y=f.yLow;e.drawDataLabels&&e.drawDataLabels.apply(this,arguments)}f.align=g},alignDataLabel:function(){l.column.prototype.alignDataLabel.apply(this,arguments)},getSymbol:B,drawPoints:B}),k.areasplinerange=g(k.arearange),l.areasplinerange=m(l.arearange,{type:"areasplinerange",getPointSpline:l.spline.prototype.getPointSpline}),function(){var a=l.column.prototype;k.columnrange=g(k.column,k.arearange,{lineWidth:1,pointRange:null}),l.columnrange=m(l.arearange,{type:"columnrange",translate:function(){var d,b=this,c=b.yAxis;a.translate.apply(b),e(b.points,function(a){var g,h,i,e=a.shapeArgs,f=b.options.minPointLength;a.tooltipPos=null,a.plotHigh=d=c.translate(a.high,0,1,0,1),a.plotLow=a.plotY,i=d,h=a.plotY-d,h<f&&(g=f-h,h+=g,i-=g/2),e.height=h,e.y=i})},trackerGroups:["group","dataLabelsGroup"],drawGraph:B,pointAttrToOptions:a.pointAttrToOptions,drawPoints:a.drawPoints,drawTracker:a.drawTracker,animate:a.animate,getColumnMetrics:a.getColumnMetrics})}(),k.gauge=g(k.line,{dataLabels:{enabled:!0,defer:!1,y:15,borderWidth:1,borderColor:"silver",borderRadius:3,crop:!1,style:{fontWeight:"bold"},verticalAlign:"top",zIndex:2},dial:{},pivot:{},tooltip:{headerFormat:""},showInLegend:!1});var H=m(r,{setState:function(a){this.state=a}}),I={type:"gauge",pointClass:H,angular:!0,drawGraph:B,fixedBox:!0,forceDL:!0,trackerGroups:["group","dataLabelsGroup"],translate:function(){var a=this,b=a.yAxis,c=a.options,d=b.center;a.generatePoints(),e(a.points,function(a){var e=g(c.dial,a.dial),f=j(i(e.radius,80))*d[2]/200,h=j(i(e.baseLength,70))*f/100,k=j(i(e.rearLength,10))*f/100,l=e.baseWidth||3,m=e.topWidth||1,n=c.overshoot,o=b.startAngleRad+b.translate(a.y,null,null,null,!0);n&&"number"==typeof n?(n=n/180*Math.PI,o=Math.max(b.startAngleRad-n,Math.min(b.endAngleRad+n,o))):c.wrap===!1&&(o=Math.max(b.startAngleRad,Math.min(b.endAngleRad,o))),o=180*o/Math.PI,a.shapeType="path",a.shapeArgs={d:e.path||["M",-k,-l/2,"L",h,-l/2,f,-m/2,f,m/2,h,l/2,-k,l/2,"z"],translateX:d[0],translateY:d[1],rotation:o},a.plotX=d[0],a.plotY=d[1]})},drawPoints:function(){var a=this,b=a.yAxis.center,c=a.pivot,d=a.options,f=d.pivot,h=a.chart.renderer;e(a.points,function(b){var c=b.graphic,e=b.shapeArgs,f=e.d,i=g(d.dial,b.dial);c?(c.animate(e),e.d=f):b.graphic=h[b.shapeType](e).attr({stroke:i.borderColor||"none","stroke-width":i.borderWidth||0,fill:i.backgroundColor||"black",rotation:e.rotation}).add(a.group)}),c?c.animate({translateX:b[0],translateY:b[1]}):a.pivot=h.circle(0,0,i(f.radius,5)).attr({"stroke-width":f.borderWidth||0,stroke:f.borderColor||"silver",fill:f.backgroundColor||"black"}).translate(b[0],b[1]).add(a.group)},animate:function(a){var b=this;a||(e(b.points,function(a){var c=a.graphic;c&&(c.attr({rotation:180*b.yAxis.startAngleRad/Math.PI}),c.animate({rotation:a.shapeArgs.rotation},b.options.animation))}),b.animate=null)},render:function(){this.group=this.plotGroup("group","series",this.visible?"visible":"hidden",this.options.zIndex,this.chart.seriesGroup),v.prototype.render.call(this),this.group.clip(this.chart.clipRect)},setData:function(a,b){v.prototype.setData.call(this,a,!1),this.processData(),this.generatePoints(),i(b,!0)&&this.chart.redraw()},drawTracker:u&&u.drawTrackerPoint};l.gauge=m(l.line,I),k.boxplot=g(k.column,{fillColor:"#FFFFFF",lineWidth:1,medianWidth:2,states:{hover:{brightness:-.3}},threshold:null,tooltip:{pointFormat:'<span style="color:{series.color}">●</span> <b> {series.name}</b><br/>Maximum: {point.high}<br/>Upper quartile: {point.q3}<br/>Median: {point.median}<br/>Lower quartile: {point.q1}<br/>Minimum: {point.low}<br/>'},whiskerLength:"50%",whiskerWidth:2}),l.boxplot=m(l.column,{type:"boxplot",pointArrayMap:["low","q1","median","q3","high"],toYData:function(a){return[a.low,a.q1,a.median,a.q3,a.high]},pointValKey:"high",pointAttrToOptions:{fill:"fillColor",stroke:"color","stroke-width":"lineWidth"},drawDataLabels:B,translate:function(){var a=this,b=a.yAxis,c=a.pointArrayMap;l.column.prototype.translate.apply(a),e(a.points,function(a){e(c,function(c){null!==a[c]&&(a[c+"Plot"]=b.translate(a[c],0,1,0,1))})})},drawPoints:function(){var h,j,k,l,m,n,o,p,q,r,s,t,u,v,w,z,A,B,C,D,E,F,a=this,c=a.points,d=a.options,f=a.chart,g=f.renderer,G=a.doQuartiles!==!1,H=parseInt(a.options.whiskerLength,10)/100;e(c,function(c){q=c.graphic,E=c.shapeArgs,s={},v={},z={},F=c.color||a.color,c.plotY!==b&&(h=c.pointAttr[c.selected?"selected":""],A=E.width,B=y(E.x),C=B+A,D=x(A/2),j=y(G?c.q1Plot:c.lowPlot),k=y(G?c.q3Plot:c.lowPlot),l=y(c.highPlot),m=y(c.lowPlot),s.stroke=c.stemColor||d.stemColor||F,s["stroke-width"]=i(c.stemWidth,d.stemWidth,d.lineWidth),s.dashstyle=c.stemDashStyle||d.stemDashStyle,v.stroke=c.whiskerColor||d.whiskerColor||F,v["stroke-width"]=i(c.whiskerWidth,d.whiskerWidth,d.lineWidth),z.stroke=c.medianColor||d.medianColor||F,z["stroke-width"]=i(c.medianWidth,d.medianWidth,d.lineWidth),z["stroke-linecap"]="round",o=s["stroke-width"]%2/2,p=B+D+o,r=["M",p,k,"L",p,l,"M",p,j,"L",p,m],G&&(o=h["stroke-width"]%2/2,p=y(p)+o,j=y(j)+o,k=y(k)+o,B+=o,C+=o,t=["M",B,k,"L",B,j,"L",C,j,"L",C,k,"L",B,k,"z"]),H&&(o=v["stroke-width"]%2/2,l+=o,m+=o,u=["M",p-D*H,l,"L",p+D*H,l,"M",p-D*H,m,"L",p+D*H,m]),o=z["stroke-width"]%2/2,n=x(c.medianPlot)+o,w=["M",B,n,"L",C,n],q?(c.stem.animate({d:r}),H&&c.whiskers.animate({d:u}),G&&c.box.animate({d:t}),c.medianShape.animate({d:w})):(c.graphic=q=g.g().add(a.group),c.stem=g.path(r).attr(s).add(q),H&&(c.whiskers=g.path(u).attr(v).add(q)),G&&(c.box=g.path(t).attr(h).add(q)),c.medianShape=g.path(w).attr(z).add(q)))})}}),k.errorbar=g(k.boxplot,{color:"#000000",grouping:!1,linkedTo:":previous",tooltip:{pointFormat:'<span style="color:{series.color}">●</span> {series.name}: <b>{point.low}</b> - <b>{point.high}</b><br/>'},whiskerWidth:null}),l.errorbar=m(l.boxplot,{type:"errorbar",pointArrayMap:["low","high"],toYData:function(a){return[a.low,a.high]},pointValKey:"high",doQuartiles:!1,drawDataLabels:l.arearange?l.arearange.prototype.drawDataLabels:B,getColumnMetrics:function(){return this.linkedParent&&this.linkedParent.columnMetrics||l.column.prototype.getColumnMetrics.call(this)}}),k.waterfall=g(k.column,{lineWidth:1,lineColor:"#333",dashStyle:"dot",borderColor:"#333",states:{hover:{lineWidthPlus:0}}}),l.waterfall=m(l.column,{type:"waterfall",upColorProp:"fill",pointArrayMap:["low","y"],pointValKey:"y",init:function(a,b){b.stacking=!0,l.column.prototype.init.call(this,a,b)},translate:function(){var d,e,f,g,h,i,j,k,m,n,p,a=this,b=a.options,c=a.yAxis,o=b.threshold;for(l.column.prototype.translate.apply(this),k=m=o,f=a.points,e=0,d=f.length;e<d;e++)g=f[e],h=g.shapeArgs,i=a.getStack(e),n=i.points[a.index+","+e],isNaN(g.y)&&(g.y=a.yData[e]),j=z(k,k+g.y)+n[0],h.y=c.translate(j,0,1),g.isSum?(h.y=c.translate(n[1],0,1),h.height=c.translate(n[0],0,1)-h.y):g.isIntermediateSum?(h.y=c.translate(n[1],0,1),h.height=c.translate(m,0,1)-h.y,m=n[1]):k+=i.total,h.height<0&&(h.y+=h.height,h.height*=-1),g.plotY=h.y=x(h.y)-a.borderWidth%2/2,h.height=z(x(h.height),.001),g.yBottom=h.y+h.height,p=g.plotY+(g.negative?h.height:0),a.chart.inverted?g.tooltipPos[0]=c.len-p:g.tooltipPos[1]=p},processData:function(a){var f,i,j,k,l,m,n,b=this,c=b.options,d=b.yData,e=b.points,g=d.length,h=c.threshold||0;for(j=i=k=l=h,n=0;n<g;n++)m=d[n],f=e&&e[n]?e[n]:{},"sum"===m||f.isSum?d[n]=j:"intermediateSum"===m||f.isIntermediateSum?d[n]=i:(j+=m,i+=m),k=Math.min(j,k),l=Math.max(j,l);v.prototype.processData.call(this,a),b.dataMin=k,b.dataMax=l},toYData:function(a){return a.isSum?0===a.x?null:"sum":a.isIntermediateSum?0===a.x?null:"intermediateSum":a.y},getAttribs:function(){l.column.prototype.getAttribs.apply(this,arguments);var b=this,c=b.options,d=c.states,f=c.upColor||b.color,h=a.Color(f).brighten(.1).get(),i=g(b.pointAttr),j=b.upColorProp;i[""][j]=f,i.hover[j]=d.hover.upColor||h,i.select[j]=d.select.upColor||f,e(b.points,function(a){a.y>0&&!a.color&&(a.pointAttr=i,a.color=f)})},getGraphPath:function(){var h,i,j,k,a=this.data,b=a.length,c=this.options.lineWidth+this.borderWidth,d=x(c)%2/2,e=[],f="M",g="L";for(j=1;j<b;j++)i=a[j].shapeArgs,h=a[j-1].shapeArgs,k=[f,h.x+h.width,h.y+d,g,i.x,h.y+d],a[j-1].y<0&&(k[2]+=h.height,k[5]+=h.height),e=e.concat(k);return e},getExtremes:B,getStack:function(a){var b=this.yAxis,c=b.stacks,d=this.stackKey;return this.processedYData[a]<this.options.threshold&&(d="-"+d),c[d][a]},drawGraph:v.prototype.drawGraph}),k.bubble=g(k.scatter,{dataLabels:{formatter:function(){return this.point.z},inside:!0,style:{color:"white",textShadow:"0px 0px 3px black"},verticalAlign:"middle"},marker:{lineColor:null,lineWidth:1},minSize:8,maxSize:"20%",states:{hover:{halo:{size:5}}},tooltip:{pointFormat:"({point.x}, {point.y}), Size: {point.z}"},turboThreshold:0,zThreshold:0});var J=m(r,{haloPath:function(){return r.prototype.haloPath.call(this,this.shapeArgs.r+this.series.options.states.hover.halo.size)}});l.bubble=m(l.scatter,{type:"bubble",pointClass:J,pointArrayMap:["y","z"],parallelArrays:["x","y","z"],trackerGroups:["group","dataLabelsGroup"],bubblePadding:!0,pointAttrToOptions:{stroke:"lineColor","stroke-width":"lineWidth",fill:"fillColor"},applyOpacity:function(a){var b=this.options.marker,c=i(b.fillOpacity,.5);return a=a||b.fillColor||this.color,1!==c&&(a=A(a).setOpacity(c).get("rgba")),a},convertAttribs:function(){var a=v.prototype.convertAttribs.apply(this,arguments);return a.fill=this.applyOpacity(a.fill),a},getRadii:function(a,b,c,d){var e,f,g,k,h=this.zData,i=[],j="width"!==this.options.sizeBy;for(f=0,e=h.length;f<e;f++)k=b-a,g=k>0?(h[f]-a)/(b-a):.5,j&&g>=0&&(g=Math.sqrt(g)),i.push(w.ceil(c+g*(d-c))/2);this.radii=i},animate:function(a){var b=this.options.animation;a||(e(this.points,function(a){var c=a.graphic,d=a.shapeArgs;c&&d&&(c.attr("r",1),c.animate({r:d.r},b))}),this.animate=null)},translate:function(){var a,d,e,c=this.data,f=this.radii;for(l.scatter.prototype.translate.call(this),a=c.length;a--;)d=c[a],e=f?f[a]:0,d.negative=d.z<(this.options.zThreshold||0),e>=this.minPxSize/2?(d.shapeType="circle",d.shapeArgs={x:d.plotX,y:d.plotY,r:e},d.dlBox={x:d.plotX-e,y:d.plotY-e,width:2*e,height:2*e}):d.shapeArgs=d.plotY=d.dlBox=b},drawLegendSymbol:function(a,b){var c=j(a.itemStyle.fontSize)/2;b.legendSymbol=this.chart.renderer.circle(c,a.baseline-c,c).attr({zIndex:3}).add(b.legendGroup),b.legendSymbol.isMarker=!0},drawPoints:l.column.prototype.drawPoints,alignDataLabel:l.column.prototype.alignDataLabel}),p.prototype.beforePadding=function(){var a=this,f=this.len,g=this.chart,h=0,k=f,l=this.isXAxis,m=l?"xData":"yData",n=this.min,o={},p=w.min(g.plotWidth,g.plotHeight),q=Number.MAX_VALUE,r=-Number.MAX_VALUE,s=this.max-n,t=f/s,u=[];this.tickPositions&&(e(this.series,function(b){var h,f=b.options;!b.bubblePadding||!b.visible&&g.options.chart.ignoreHiddenSeries||(a.allowZoomOutside=!0,u.push(b),l&&(e(["minSize","maxSize"],function(a){var b=f[a],c=/%$/.test(b);b=j(b),o[a]=c?p*b/100:b}),b.minPxSize=o.minSize,h=b.zData,h.length&&(q=i(f.zMin,w.min(q,w.max(c(h),f.displayNegative===!1?f.zThreshold:-Number.MAX_VALUE))),r=i(f.zMax,w.max(r,d(h))))))}),e(u,function(a){var d,b=a[m],c=b.length;if(l&&a.getRadii(q,r,o.minSize,o.maxSize),s>0)for(;c--;)"number"==typeof b[c]&&(d=a.radii[c],h=Math.min((b[c]-n)*t-d,h),k=Math.max((b[c]-n)*t+d,k))}),u.length&&s>0&&i(this.options.min,this.userMin)===b&&i(this.options.max,this.userMax)===b&&(k-=f,t*=(f+h-k)/f,this.min+=h/t,this.max+=k/t))},function(){function d(a,b,c){a.call(this,b,c),this.chart.polar&&(this.closeSegment=function(a){var b=this.xAxis.center;a.push("L",b[0],b[1])},this.closedStacks=!0)}function g(a,b){var j,c=this.chart,d=this.options.animation,e=this.group,f=this.markerGroup,g=this.xAxis.center,h=c.plotLeft,i=c.plotTop;c.polar?c.renderer.isSVG&&(d===!0&&(d={}),b?(j={translateX:g[0]+h,translateY:g[1]+i,scaleX:.001,scaleY:.001},e.attr(j),f&&f.attr(j)):(j={translateX:h,translateY:i,scaleX:1,scaleY:1},e.animate(j,d),f&&f.animate(j,d),this.animate=null)):a.call(this,b)}var c,a=v.prototype,b=s.prototype;a.toXY=function(a){var b,f,c=this.chart,d=a.plotX,e=a.plotY;a.rectPlotX=d,a.rectPlotY=e,f=(d/Math.PI*180+this.xAxis.pane.options.startAngle)%360,f<0&&(f+=360),a.clientX=f,b=this.xAxis.postTranslate(a.plotX,this.yAxis.len-e),a.plotX=a.polarPlotX=b.x-c.plotLeft,a.plotY=a.polarPlotY=b.y-c.plotTop},a.orderTooltipPoints=function(a){this.chart.polar&&(a.sort(function(a,b){return a.clientX-b.clientX}),a[0]&&(a[0].wrappedClientX=a[0].clientX+360,a.push(a[0])))},l.area&&o(l.area.prototype,"init",d),l.areaspline&&o(l.areaspline.prototype,"init",d),l.spline&&o(l.spline.prototype,"getPointSpline",function(a,b,c,d){var e,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,f=1.5,g=f+1;return this.chart.polar?(h=c.plotX,i=c.plotY,j=b[d-1],k=b[d+1],this.connectEnds&&(j||(j=b[b.length-2]),k||(k=b[1])),j&&k&&(l=j.plotX,m=j.plotY,n=k.plotX,o=k.plotY,p=(f*h+l)/g,q=(f*i+m)/g,r=(f*h+n)/g,s=(f*i+o)/g,t=Math.sqrt(Math.pow(p-h,2)+Math.pow(q-i,2)),u=Math.sqrt(Math.pow(r-h,2)+Math.pow(s-i,2)),v=Math.atan2(q-i,p-h),w=Math.atan2(s-i,r-h),x=Math.PI/2+(v+w)/2,Math.abs(v-x)>Math.PI/2&&(x-=Math.PI),p=h+Math.cos(x)*t,q=i+Math.sin(x)*t,r=h+Math.cos(Math.PI+x)*u,s=i+Math.sin(Math.PI+x)*u,c.rightContX=r,c.rightContY=s),d?(e=["C",j.rightContX||j.plotX,j.rightContY||j.plotY,p||h,q||i,h,i],j.rightContX=j.rightContY=null):e=["M",h,i]):e=a.call(this,b,c,d),e}),o(a,"translate",function(a){if(a.call(this),this.chart.polar&&!this.preventPostTranslate)for(var b=this.points,c=b.length;c--;)this.toXY(b[c])}),o(a,"getSegmentPath",function(a,b){var c=this.points;return this.chart.polar&&this.options.connectEnds!==!1&&b[b.length-1]===c[c.length-1]&&null!==c[0].y&&(this.connectEnds=!0,b=[].concat(b,[c[0]])),a.call(this,b)}),o(a,"animate",g),o(a,"setTooltipPoints",function(a,b){return this.chart.polar&&f(this.xAxis,{tooltipLen:360}),a.call(this,b)}),l.column&&(c=l.column.prototype,o(c,"animate",g),o(c,"translate",function(a){var g,h,j,k,b=this.xAxis,c=this.yAxis.len,d=b.center,e=b.startAngleRad,f=this.chart.renderer;if(this.preventPostTranslate=!0,a.call(this),b.isRadial)for(h=this.points,k=h.length;k--;)j=h[k],g=j.barX+e,j.shapeType="path",j.shapeArgs={d:f.symbols.arc(d[0],d[1],c-j.plotY,null,{start:g,end:g+j.pointWidth,innerR:c-i(j.yBottom,c)})},this.toXY(j),j.tooltipPos=[j.plotX,j.plotY],j.ttBelow=j.plotY>d[1]}),o(c,"alignDataLabel",function(b,c,d,e,f,g){if(this.chart.polar){var i,j,h=c.rectPlotX/Math.PI*180;null===e.align&&(i=h>20&&h<160?"left":h>200&&h<340?"right":"center",e.align=i),null===e.verticalAlign&&(j=h<45||h>315?"bottom":h>135&&h<225?"top":"middle",e.verticalAlign=j),a.alignDataLabel.call(this,c,d,e,f,g)}else b.call(this,c,d,e,f,g)})),o(b,"getIndex",function(a,b){var c,e,f,g,d=this.chart;return d.polar?(e=d.xAxis[0].center,f=b.chartX-e[0]-d.plotLeft,g=b.chartY-e[1]-d.plotTop,c=180-Math.round(Math.atan2(f,g)/Math.PI*180)):c=a.call(this,b),c}),o(b,"getCoordinates",function(a,b){var c=this.chart,d={xAxis:[],yAxis:[]};return c.polar?e(c.axes,function(a){var e=a.isXAxis,f=a.center,g=b.chartX-f[0]-c.plotLeft,h=b.chartY-f[1]-c.plotTop;d[e?"xAxis":"yAxis"].push({axis:a,value:a.translate(e?Math.PI-Math.atan2(g,h):Math.sqrt(Math.pow(g,2)+Math.pow(h,2)),!0)})}):d=a.call(this,b),d})}()}(Highcharts);