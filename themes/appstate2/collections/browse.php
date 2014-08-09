<?php head(array('title'=>'Browse Collections','bodyid'=>'collections','bodyclass' => 'browse')); ?>
<div id="primary">
    <h1>Collections</h1><br />
    <?php if (has_collections_for_loop()): ?>
        <div class="pagination"><?php echo pagination_links(); ?></div>
    <?php while (loop_collections()): ?>
   

<br />
	<!--addition to show item from collection-->
	<div class="collection-items">
		<?php
			$items = get_items(array('collection'=>get_current_collection()->id), 1);
			//$items = find_random_item(array('withImage' => true, 'collection' => collection('id'));
			set_items_for_loop($items);
			while(loop_items()):
				if (item_has_thumbnail()): 
			   	   echo link_to_collection_for_item(item_square_thumbnail(),  array('class' => 'collection-img')); 
				endif; 
			endwhile; 
		?>	
	</div>	
	
       <div class="collection">
            <h2 class="coll_header"><?php echo link_to_collection(); ?></h2>
            <div class="element">
                <!--<h5>Description</h5>-->
            <div class="element-text coll_descript"><?php echo nls2p(collection('Description', array('snippet'=>150))); ?></div>
        </div>


	<?php if(collection_has_collectors()): ?>
       <!-- <div class="element">
            <h3>Collector(s)</h3>
            
            <div class="element-text">
                <p><?php echo collection('Collectors', array('delimiter'=>', ')); ?></p>
            </div>
           
        </div> --><?php endif; ?>
        <p class="view-items-link"><?php echo link_to_browse_items('View the items in ' . collection('Name'), array('collection' => collection('id'))); ?></p>

        <?php echo plugin_append_to_collections_browse_each(); ?>

        </div><!-- end class="collection" -->
    <?php endwhile; ?>
    <?php else: ?>
        <p>No collections to display.</p>
    <?php endif; ?>
        <?php echo plugin_append_to_collections_browse(); ?>
</div><!-- end primary -->
<div id="secondary">
    <div id="featured-collection" class="featured">
	<?php echo display_random_featured_collection_with_item(); ?>
        <?php /*echo display_random_featured_collection();*/ ?>
    </div><!-- end featured collection -->
</div>
<?php foot();
