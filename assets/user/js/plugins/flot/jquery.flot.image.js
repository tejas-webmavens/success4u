!function(a){function c(a,b,c){var d=a.getPlotOffset();if(c.images&&c.images.show)for(var e=c.datapoints.points,f=c.datapoints.pointsize,g=0;g<e.length;g+=f){var o,h=e[g],i=e[g+1],j=e[g+2],k=e[g+3],l=e[g+4],m=c.xaxis,n=c.yaxis;if(!(!h||h.width<=0||h.height<=0||(i>k&&(o=k,k=i,i=o),j>l&&(o=l,l=j,j=o),"center"==c.images.anchor&&(o=.5*(k-i)/(h.width-1),i-=o,k+=o,o=.5*(l-j)/(h.height-1),j-=o,l+=o),i==k||j==l||i>=m.max||k<=m.min||j>=n.max||l<=n.min))){var p=0,q=0,r=h.width,s=h.height;i<m.min&&(p+=(r-p)*(m.min-i)/(k-i),i=m.min),k>m.max&&(r+=(r-p)*(m.max-k)/(k-i),k=m.max),j<n.min&&(s+=(q-s)*(n.min-j)/(l-j),j=n.min),l>n.max&&(q+=(q-s)*(n.max-l)/(l-j),l=n.max),i=m.p2c(i),k=m.p2c(k),j=n.p2c(j),l=n.p2c(l),i>k&&(o=k,k=i,i=o),j>l&&(o=l,l=j,j=o),o=b.globalAlpha,b.globalAlpha*=c.images.alpha,b.drawImage(h,p,q,r-p,s-q,i+d.left,j+d.top,k-i,l-j),b.globalAlpha=o}}}function d(a,b,c,d){b.images.show&&(d.format=[{required:!0},{x:!0,number:!0,required:!0},{y:!0,number:!0,required:!0},{x:!0,number:!0,required:!0},{y:!0,number:!0,required:!0}])}function e(a){a.hooks.processRawData.push(d),a.hooks.drawSeries.push(c)}var b={series:{images:{show:!1,alpha:1,anchor:"corner"}}};a.plot.image={},a.plot.image.loadDataImages=function(b,c,d){var e=[],f=[],g=c.series.images.show;a.each(b,function(b,c){(g||c.images.show)&&(c.data&&(c=c.data),a.each(c,function(a,b){"string"==typeof b[0]&&(e.push(b[0]),f.push(b))}))}),a.plot.image.load(e,function(b){a.each(f,function(a,c){var d=c[0];b[d]&&(c[0]=b[d])}),d()})},a.plot.image.load=function(b,c){var d=b.length,e={};0==d&&c({}),a.each(b,function(b,f){var g=function(){--d,e[f]=this,0==d&&c(e)};a("<img />").load(g).error(g).attr("src",f)})},a.plot.plugins.push({init:e,options:b,name:"image",version:"1.1"})}(jQuery);