/*
     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
*/
Array.prototype.remove=function(b){for(var a=0;a<this.length;a++)if(this[a]===b){this.splice(a,1);this.remove(b);break}};Array.prototype.contains=function(b){for(var a=!1,c=0;c<this.length;c++)this[c]===b&&(a=!0);return a};Array.prototype.indexOf=function(b){for(var a=0;a<this.length;a++)if(this[a]==b)return a;return-1};
