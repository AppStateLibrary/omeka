wysihtml5.dom.insert=function(b){return{after:function(a){a.parentNode.insertBefore(b,a.nextSibling)},before:function(a){a.parentNode.insertBefore(b,a)},into:function(a){a.appendChild(b)}}};
