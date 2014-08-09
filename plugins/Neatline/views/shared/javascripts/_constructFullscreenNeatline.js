/*
     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
*/
jQuery(document).ready(function(d){SimileAjax.History.enabled=!1;var a=d(".neatline-container");a.fullscreenpositioner({resize:function(){a.neatline("positionDivs")}});a.neatline({timelineeventclick:function(c,b){a.neatline("zoomMapToItemVectors",b.recordid);a.neatline("showItemDescription",b.recordid)},mapfeatureclick:function(c,b){a.neatline("zoomTimelineToEvent",b.recordid);a.neatline("showItemDescription",b.recordid)},itemclick:function(c,b){a.neatline("zoomMapToItemVectors",b.recordid);a.neatline("zoomTimelineToEvent",
b.recordid);a.neatline("showItemDescription",b.recordid)}})});
