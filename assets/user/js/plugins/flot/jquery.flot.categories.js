!function(a){function c(a,b,c,d){var e="categories"==b.xaxis.options.mode,f="categories"==b.yaxis.options.mode;if(e||f){var g=d.format;if(!g){var h=b;if(g=[],g.push({x:!0,number:!0,required:!0}),g.push({y:!0,number:!0,required:!0}),h.bars.show||h.lines.show&&h.lines.fill){var i=!!(h.bars.show&&h.bars.zero||h.lines.show&&h.lines.zero);g.push({y:!0,number:!0,required:!1,defaultValue:0,autoscale:i}),h.bars.horizontal&&(delete g[g.length-1].y,g[g.length-1].x=!0)}d.format=g}for(var j=0;j<g.length;++j)g[j].x&&e&&(g[j].number=!1),g[j].y&&f&&(g[j].number=!1)}}function d(a){var b=-1;for(var c in a)a[c]>b&&(b=a[c]);return b+1}function e(a){var b=[];for(var c in a.categories){var d=a.categories[c];d>=a.min&&d<=a.max&&b.push([d,c])}return b.sort(function(a,b){return a[0]-b[0]}),b}function f(b,c,d){if("categories"==b[c].options.mode){if(!b[c].categories){var f={},h=b[c].options.categories||{};if(a.isArray(h))for(var i=0;i<h.length;++i)f[h[i]]=i;else for(var j in h)f[j]=h[j];b[c].categories=f}b[c].options.ticks||(b[c].options.ticks=e),g(d,c,b[c].categories)}}function g(a,b,c){for(var e=a.points,f=a.pointsize,g=a.format,h=b.charAt(0),i=d(c),j=0;j<e.length;j+=f)if(null!=e[j])for(var k=0;k<f;++k){var l=e[j+k];null!=l&&g[k][h]&&(l in c||(c[l]=i,++i),e[j+k]=c[l])}}function h(a,b,c){f(b,"xaxis",c),f(b,"yaxis",c)}function i(a){a.hooks.processRawData.push(c),a.hooks.processDatapoints.push(h)}var b={xaxis:{categories:null},yaxis:{categories:null}};a.plot.plugins.push({init:i,options:b,name:"categories",version:"1.0"})}(jQuery);