Timeline.OverviewEventPainter=function(a){this._params=a;this._onSelectListeners=[];this._highlightMatcher=this._filterMatcher=null};Timeline.OverviewEventPainter.prototype.initialize=function(a,b){this._band=a;this._timeline=b;this._highlightLayer=this._eventLayer=null};Timeline.OverviewEventPainter.prototype.getType=function(){return"overview"};Timeline.OverviewEventPainter.prototype.addOnSelectListener=function(a){this._onSelectListeners.push(a)};
Timeline.OverviewEventPainter.prototype.removeOnSelectListener=function(a){for(var b=0;b<this._onSelectListeners.length;b++)if(this._onSelectListeners[b]==a){this._onSelectListeners.splice(b,1);break}};Timeline.OverviewEventPainter.prototype.getFilterMatcher=function(){return this._filterMatcher};Timeline.OverviewEventPainter.prototype.setFilterMatcher=function(a){this._filterMatcher=a};Timeline.OverviewEventPainter.prototype.getHighlightMatcher=function(){return this._highlightMatcher};
Timeline.OverviewEventPainter.prototype.setHighlightMatcher=function(a){this._highlightMatcher=a};
Timeline.OverviewEventPainter.prototype.paint=function(){var a=this._band.getEventSource();if(a!=null){this._prepareForPainting();for(var b=this._params.theme.event,b={trackOffset:b.overviewTrack.offset,trackHeight:b.overviewTrack.height,trackGap:b.overviewTrack.gap,trackIncrement:b.overviewTrack.height+b.overviewTrack.gap},c=this._band.getMinDate(),d=this._band.getMaxDate(),f=this._filterMatcher!=null?this._filterMatcher:function(){return!0},e=this._highlightMatcher!=null?this._highlightMatcher:
function(){return-1},a=a.getEventReverseIterator(c,d);a.hasNext();)c=a.next(),f(c)&&this.paintEvent(c,b,this._params.theme,e(c));this._highlightLayer.style.display="block";this._eventLayer.style.display="block";this._band.updateEventTrackInfo(this._tracks.length,b.trackIncrement)}};Timeline.OverviewEventPainter.prototype.softPaint=function(){};
Timeline.OverviewEventPainter.prototype._prepareForPainting=function(){var a=this._band;this._tracks=[];this._highlightLayer!=null&&a.removeLayerDiv(this._highlightLayer);this._highlightLayer=a.createLayerDiv(105,"timeline-band-highlights");this._highlightLayer.style.display="none";this._eventLayer!=null&&a.removeLayerDiv(this._eventLayer);this._eventLayer=a.createLayerDiv(110,"timeline-band-events");this._eventLayer.style.display="none"};
Timeline.OverviewEventPainter.prototype.paintEvent=function(a,b,c,d){a.isInstant()?this.paintInstantEvent(a,b,c,d):this.paintDurationEvent(a,b,c,d)};Timeline.OverviewEventPainter.prototype.paintInstantEvent=function(a,b,c,d){var f=a.getStart(),f=Math.round(this._band.dateToPixelOffset(f)),e=a.getColor(),e=a.getClassName()?null:e!=null?e:c.event.duration.color,a=this._paintEventTick(a,f,e,100,b,c);this._createHighlightDiv(d,a,c)};
Timeline.OverviewEventPainter.prototype.paintDurationEvent=function(a,b,c,d){for(var f=a.getLatestStart(),e=a.getEarliestEnd(),f=Math.round(this._band.dateToPixelOffset(f)),e=Math.round(this._band.dateToPixelOffset(e)),g=0;g<this._tracks.length;g++)if(e<this._tracks[g])break;this._tracks[g]=e;var h=a.getColor(),i=a.getClassName(),h=i?null:h!=null?h:c.event.duration.color,a=this._paintEventTape(a,g,f,e,h,100,b,c,i);this._createHighlightDiv(d,a,c)};
Timeline.OverviewEventPainter.prototype._paintEventTape=function(a,b,c,d,f,e,g,h,i){a=g.trackOffset+b*g.trackIncrement;d-=c;g=g.trackHeight;b=this._timeline.getDocument().createElement("div");b.className="timeline-small-event-tape";i&&(b.className+=" small-"+i);b.style.left=c+"px";b.style.width=d+"px";b.style.top=a+"px";b.style.height=g+"px";if(f)b.style.backgroundColor=f;e<100&&SimileAjax.Graphics.setOpacity(b,e);this._eventLayer.appendChild(b);return{left:c,top:a,width:d,height:g,elmt:b}};
Timeline.OverviewEventPainter.prototype._paintEventTick=function(a,b,c,d,f,e){c=e.event.overviewTrack.tickHeight;f=f.trackOffset-c;e=this._timeline.getDocument().createElement("div");e.className="timeline-small-event-icon";e.style.left=b+"px";e.style.top=f+"px";(a=a.getClassName())&&(e.className+=" small-"+a);d<100&&SimileAjax.Graphics.setOpacity(e,d);this._eventLayer.appendChild(e);return{left:b,top:f,width:1,height:c,elmt:e}};
Timeline.OverviewEventPainter.prototype._createHighlightDiv=function(a,b,c){if(a>=0){var d=this._timeline.getDocument(),c=c.event,a=c.highlightColors[Math.min(a,c.highlightColors.length-1)],d=d.createElement("div");d.style.position="absolute";d.style.overflow="hidden";d.style.left=b.left-1+"px";d.style.width=b.width+2+"px";d.style.top=b.top-1+"px";d.style.height=b.height+2+"px";d.style.background=a;this._highlightLayer.appendChild(d)}};Timeline.OverviewEventPainter.prototype.showBubble=function(){};
