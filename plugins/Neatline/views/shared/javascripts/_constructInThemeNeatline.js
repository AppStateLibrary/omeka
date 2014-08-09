/*
     http://www.apache.org/licenses/LICENSE-2.0.html Apache 2 License
*/
jQuery(document).ready(function(d){SimileAjax.History.enabled=!1;var b=d(".neatline-container");b.neatline({timelineeventclick:function(c,a){b.neatline("zoomMapToItemVectors",a.recordid);b.neatline("showItemDescription",a.recordid)},mapfeatureclick:function(c,a){b.neatline("zoomTimelineToEvent",a.recordid);b.neatline("showItemDescription",a.recordid)},itemclick:function(c,a){b.neatline("zoomMapToItemVectors",a.recordid);b.neatline("zoomTimelineToEvent",a.recordid);b.neatline("showItemDescription",
a.recordid)}})});
