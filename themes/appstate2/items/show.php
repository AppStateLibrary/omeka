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
            <form id="submit-cart-contents" action="http://library-cart.dev/store/requestcopy" method="post">
                <input type="hidden" name="item" value=""><input type="submit" value="Submit Order">
            </form>
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

    jQuery('#itemfiles .audio-mpeg').each(function(){
        var fileName=jQuery(this).find(".audio-file-div").text();
        var audio=jQuery(this).find(".download-file").attr("href");
        jQuery(this).find(".audio-file-div").text("");
        jQuery(this).find(".audio-file-div").html("<a href='"+audio+"'>Listen to Sound File</a>");

        jQuery(this).append('<div class="cart-controls"><button type="button" class="btn-add-to-cart" title="'+fileName+'">Request this item</button>');
        jQuery(this).append('<span class="add-to-cart-info" title="Click the Request this item button to add this sound file to your order and when finished selecting files to be included in your order, click the Submit Order button below to proceed to the shopping cart checkout process."><img id="info" src="/themes/appstate2/images/info.png" style="vertical-align:bottom" /></span></div>');

    });

    jQuery('#itemfiles .image-jpeg').each(function(){
        var fileName=jQuery(this).find(".download-file img").attr("title");

        jQuery(this).append('<div class="cart-controls"><button type="button" class="btn-add-to-cart" title="'+fileName+'">Request this item</button>');
        jQuery(this).append('<span class="add-to-cart-info" title="Click the Request this item button to add this photograph to your order and when finished selecting files to be included in your order, click the Submit Order button below to proceed to the shopping cart checkout process."><img id="info" src="/themes/appstate2/images/info.png" style="vertical-align:bottom" /></span></div>');

    });
    jQuery(".application-pdf .audio-file-div").text("Download PDF");

	jQuery('video').css('width','75%');
	jQuery('.element-text').each(function(){
		var chk = jQuery(this).text();
		if(chk=='None'){
			jQuery(this).parent().hide();
		}
	});

//JP code

    jQuery('btn-add-to-cart').click(function(){
        jQuery('btn-add-to-cart').append(" <b>file appended</b>.");
    });

    var citationText = jQuery('#citation').text();
	//var cartObject = {};
    //var itemsRequested = [];
    //cartObject.itemsRequested = itemsRequested;
    var cartObject = {
        citationText: citationText,
        itemsRequested: []
    };

    var fileName = "John";
    var fileFormat = "Smith";
    var item = {
            "fileName": fileName,
            "fileFormat": fileFormat
        }

    cartObject.itemsRequested.push(item);

    jQuery('#submit-cart-contents').submit(function(event) {
        jQuery('input[name="item"]').val(cartObject);
    });

        // Tooltip for order buttons
        jQuery('.add-to-cart-info').hover(function(){
            // Hover over code
            var title = $(this).attr('title');
            $(this).data('tipText', title).removeAttr('title');
            $('<p class="tooltip"></p>')
                .text(title)
                .appendTo('body')
                .fadeIn('');
        }, function() {
            // Hover out code
            $(this).attr('title', $(this).data('tipText'));
            $('.tooltip').remove();
        }).mousemove(function(e) {
            var mousex = e.pageX + 20; //Get X coordinates
            var mousey = e.pageY + 10; //Get Y coordinates
            $('.tooltip')
                .css({ top: mousey, left: mousex })
        });
});
</script>

<?php echo foot();
