wysihtml5.dom.setStyles=function(a){return{on:function(b){b=b.style;if(typeof a==="string")b.cssText+=";"+a;else for(var c in a)c==="float"?(b.cssFloat=a[c],b.styleFloat=a[c]):b[c]=a[c]}}};
