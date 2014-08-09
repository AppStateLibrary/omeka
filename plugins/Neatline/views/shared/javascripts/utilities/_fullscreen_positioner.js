/*
     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
*/
(function(a){a.widget("neatline.fullscreenpositioner",{options:{markup:{topbar:"#topbar"}},_create:function(){this._window=a(window);this._body=a("body");this.topbar=a(this.options.markup.topbar);this._measureWindow();this._listenForResize();this._position()},_measureWindow:function(){this._windowHeight=this._window.height();this._windowWidth=this._window.width();this._topbarHeight=this.topbar.height()},_listenForResize:function(){var a=this;this._window.bind({resize:function(){a._measureWindow();
a._position();a._trigger("resize")}})},_position:function(){this.element.css({height:this._windowHeight-this._topbarHeight,width:this._windowWidth,top:this._topbarHeight})}})})(jQuery);
