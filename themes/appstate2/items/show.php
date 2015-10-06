<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')), 'bodyid'=>'items','bodyclass' => 'show')); ?>

<div id="primary">

    <h1 style="margin-bottom:.75em;"><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h1>

    <?php echo all_element_texts($item,
        array(
            'show_empty_elements' => false,
            'show_element_sets' => 'Dublin Core, Document Item Type Metadata',
            'show_element_set_headings' => false
        ));
    ?>

    <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>

</div><!-- end primary -->

<div id="secondary">

    <!-- The following returns all of the files associated with an item. -->
    <div id="itemfiles" class="element">
        <h3>Files</h3>
        <div class="element-text">
        <?php
            echo files_for_item(array('showFilename'=>true, 'linkToFile'=>true, 'linkAttributes'=>array('rel'=>'lightbox'),
            'filenameAttributes'=>array('class'=>'audio-file-div'), 'imgAttributes'=>array('id'=>'foobar'),
            'icons' => array('audio/mpeg'=>img('3a.png'),'application/pdf'=>img('pdficon_large.png'))));
        ?>
        </div>
    </div>

    <!-- The following prints a list of all tags associated with the item -->
    <?php if (metadata($item, 'has tags')): ?>
    <div id="item-tags" class="element">
        <h3>Tags</h3>
        <div class="element-text tags"><?php echo tag_string('item'); ?></div>
    </div>
    <?php endif; ?>

    <!-- If the item belongs to a collection, the following creates a link to that collection. -->
    <?php if (get_collection_for_item()): ?>
        <div id="collection" class="element">
            <h3>Collection</h3>
            <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
        </div>
    <?php endif; ?>

    <!-- The following prints a citation for this item. -->
    <div id="item-citation" class="element">
        <h3>Citation</h3>
        <div id="citation" class="element-text"><?php echo html_entity_decode(metadata($item, 'citation')); ?></div>
        <!-- Custom code to submit a request and prepopulate duplication form -->
        <div class="element-text">
            <form id="cart-contents" action="https://cart.library.appstate.edu/store/externalorder" method="post">
                <input type="hidden" name="citation">
                <input type="hidden" name="metadata" id="meta-data">
                <input type="hidden" name="data" id="cart-data">
                <div id="cart-items">
                </div>
            <input type="submit" id="btn_cart-submit" value="Submit Order" style="display:none;cursor:pointer;background-color: #269abc;font-size: medium;color:#ffffff;padding: 10px;border-radius: 10%;">
            </form>
            <p id="cart-status" style="display:none;">Items in your cart = <span id="cart-count">0</span> </p>
        </div>

    </div>

</div><!-- end secondary -->

<ul class="item-pagination navigation">
    <li id="previous-item" class="previous">
        <?php echo link_to_previous_item_show(); ?>
    </li>
    <li id="next-item" class="next">
        <?php echo link_to_next_item_show(); ?>
    </li>
</ul>
<script type="text/javascript">
    jQuery(document).ready(function () {
	var histcheck = jQuery("#collection a").text();
	if(histcheck=="Appalachian State University Historical Photos"){
		jQuery("div[id*='historical-photo']").each(function(){jQuery(this).addClass("historical");});
	}
	var blacklist=[
		/** "dublin-core-date-created",
		"dublin-core-date-modified", **/
		"dublin-core-title" /**,
		"dublin-core-source",
		"dublin-core-type",
		"dublin-core-language",
		"dublin-core-rights",
		"dublin-core-publisher",
		"dublin-core-format" **/
		];
	var blacklist2=[
		"item-type-metadata-reference-url",
		"item-type-metadata-date-digitized",
		"item-type-metadata-digitized-by",
		"upload-date",
		"transcription-date",
		"transcribed-by",
		"scan-date",
		"scanned-by",
		"dimensions---original",
		"dimensions---digital",
		"classification-title",
		"contentdm-number",
		"contentdm-filename",
		"contentdm-filepath",
		"file-size",
		"dimensions-digital",
		"format-digital",
		"series",
		"format-original",
		"dimensions-original",
		"sponsors"
	];
	var blacklist3=[
		"item-type-metadata-file-name",
		"corporate-names",
		"personal-names",
		"place-names"
	];
	jQuery.each(blacklist,function (index,value){
		jQuery("#"+value).remove();
	});
	jQuery.each(blacklist3,function (index,value){
		var hcheck = jQuery("div[id*="+value+"]");
		if(!hcheck.hasClass('historical')){
			/** hcheck.remove(); **/
		}
	});
	jQuery.each(blacklist2,function (index,value){
		/** jQuery("div[id*="+value+"]").remove(); **/
	});

	var vidwidthcheck=0;
	var description = jQuery("#dublin-core-description");
	var subject = jQuery("#dublin-core-subject");
	var alt_title = jQuery("#dublin-core-alternative-title");
	if((description.length>0)&&(subject.length>0)){
		var desc = description;
		description.remove();
		desc.insertBefore(subject);
	}
	if (alt_title.length>0){
		var alt=alt_title;
		var newloc = alt_title.parent();
		alt_title.remove();
		alt.appendTo(newloc);
	}
	vidwidthcheck = jQuery(".video-quicktime object").width();
	if (vidwidthcheck>0){
		jQuery(".video-quicktime").css("margin-left","-75px");
		jQuery("#content").css("overflow","visible");
	}

    jQuery('#itemfiles .audio-mpeg').each(function(index){
        var fileName=jQuery(this).find(".audio-file-div").text();
        var id="audio-item-" + index;
        var audio=jQuery(this).find(".download-file").attr("href");
        jQuery(this).find(".audio-file-div").text("");
        jQuery(this).find(".audio-file-div").html("<a href='"+audio+"'>Listen to Sound File</a>");

        jQuery(this).append('<div class="cart-controls" id="'+id+'"><button type="button" style="cursor:pointer" class="btn-add-to-cart" id="btn_'+id+'" title="'+fileName+'">Add to cart</button></div>');
        jQuery("#"+id).append('<span class="add-to-cart-info" id="info_'+id+'" data-description="Please note that there is a charge to receive a copy of this item. Click &quot;Add to cart&quot; to add item to your basket. Click &quot;Submit Order&quot; at the bottom of this column to complete your shopping cart transaction. You will have the opportunity to review charges before payment."><img id="info" src="/themes/appstate2/images/info.png" style="vertical-align:bottom;cursor:pointer" /></span>');

    });

    jQuery('#itemfiles .image-jpeg').each(function(index){
        var fileName=jQuery(this).find(".download-file img").attr("title");
        var id="image-item-" + index;

        jQuery(this).append('<div class="cart-controls" id="'+id+'"><button type="button" style="cursor:pointer" class="btn-add-to-cart" id="btn_'+id+'" title="'+fileName+'">Add to cart</button></div>');
        jQuery("#"+id).append('<span class="add-to-cart-info" id="info_'+id+'" data-description="Please note that there is a charge to receive a copy of this item. Click &quot;Add to cart&quot; to add item to your basket. Click &quot;Submit Order&quot; at the bottom of this column to complete your shopping cart transaction. You will have the opportunity to review charges before payment."><img id="info" src="/themes/appstate2/images/info.png" style="vertical-align:bottom;cursor:pointer" /></span>');
    });

//    jQuery(".application-pdf .audio-file-div").text("Download PDF");

        jQuery('#itemfiles .application-pdf').each(function(index){
            var pdf=jQuery(this).find(".download-file").attr("href");
            var id="pdf-item-" + index;
            jQuery(this).find(".audio-file-div").text("");
            jQuery(this).find(".audio-file-div").html("<a href='"+pdf+"'>Download PDF</a>");

            jQuery(this).append('<div class="cart-controls" id="'+id+'"><button>Instructions for PDF--></button></div>');
            jQuery("#"+id).append('<span class="add-to-cart-info" id="info_'+id+'" data-description="To view a pdf document, left-click on the &quot;Download PDF&quot; link. The document will open in the pdf viewer. To save or print, right-click on the document after it is open and select either save or print."><img id="info" src="/themes/appstate2/images/info.png" style="vertical-align:bottom;cursor:pointer" " /></span>');
        });

	jQuery('video').css('width','75%');
	jQuery('.element-text').each(function(){
		var chk = jQuery(this).text();
		if(chk=='None'){
			jQuery(this).parent().hide();
		}
	});

//JP code

    // Tooltip for order buttons
        jQuery('.add-to-cart-info').on("click", "#info", function() {
            jQuery(this).tooltip(
                {
                    items: ".add-to-cart-info",
                    content: function(){
                        return jQuery(this).data('description');
                    },
                    close: function( event, ui ) {
                        var me = this;
                        ui.tooltip.hover(
                            function () {
                                jQuery(this).stop(true).fadeTo(400, 1);
                            },
                            function () {
                                jQuery(this).fadeOut("400", function(){
                                    jQuery(this).remove();
                                });
                            }
                        );
                        ui.tooltip.on("remove", function(){
                            jQuery(me).tooltip("destroy");
                        });
                    },
                }
            );
            jQuery(this).tooltip("open");
        });

   // Add and remove items to and from cart

        jQuery.fn.extend({
            cartcount: function () {
                var cartCount = jQuery("#cart-items input[id*='file_']").length;
                return cartCount;
            }
        });

        jQuery.fn.extend({
            togglesubmission: function () {
                var cartCount = jQuery().cartcount();
                if (cartCount > 0){
                    jQuery("#btn_cart-submit").show();
                    jQuery("#cart-count").text(cartCount);
                    jQuery("#cart-status").show();
                } else {
                    jQuery("#btn_cart-submit").hide();
                    jQuery("#cart-status").hide();
                }

            }
        });

  // Submit order to cart API
    jQuery('.cart-controls').on("click", ".btn-add-to-cart", function(){
        var fileName = jQuery(this).attr('title');
        var file = jQuery(this).attr('title').split(".");
        var buttonId = jQuery(this).attr('id');
        var divId = jQuery(this).attr('id').split("_");
        jQuery("#"+buttonId).hide();
        jQuery("#info_"+divId[1]).hide();
        jQuery("#"+divId[1]).append('<span class="cart-item-msg" id="msg_'+divId[1]+'"><img src="/themes/appstate2/images/greencheck.gif">file added <button class="btn-remove-from-cart" id="'+buttonId+'" title="'+fileName+'" style="cursor:pointer"><img src="/themes/appstate2/images/redx.gif"></span>');
        jQuery("#cart-items").append('<input type="hidden" name="files[]" id="file_'+divId[1]+'" value="'+fileName+'">');
        jQuery().togglesubmission();
    });

    jQuery('.cart-controls').on("click", ".btn-remove-from-cart", function(){
            var file = jQuery(this).attr('title').split(".");
            var buttonId = jQuery(this).attr('id');
            var divId = jQuery(this).attr('id').split("_");
            jQuery("#info_"+divId[1]).show();
            jQuery("#"+buttonId).show();
            jQuery("#msg_"+divId[1]).remove();
            jQuery("#file_"+divId[1]).remove();
            jQuery().togglesubmission();
    });


  jQuery('#cart-contents').submit(function(event) {
      var citation = jQuery("#citation").text().split(":");
      var citationInfo = citation[0] + citation[1];

      jQuery("input[name='citation']").val(citationInfo);
      var frmMetadata = JSON.stringify(jQuery("input[name='path'], input[name='citation']").serializeArray());
      var frmData = JSON.stringify(jQuery("input[name='files[]']").serializeArray());
      jQuery("#cart-data").val(frmData);
      jQuery("#meta-data").val(frmMetadata);
      jQuery("input[name='citation'], input[name='files[]']").remove();
  });
});
</script>

<?php echo foot();
