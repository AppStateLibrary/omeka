<?php echo head(array('title' =>  metadata('item', array('Dublin Core', 'Title')),'bodyid'=>'items','bodyclass' => 'show')); ?>


   <div id="primary" class="exhibit-show">
        <h1><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h1>

        <div class="item hentry">
             <div class="item-meta">
             <?php
                echo files_for_item(array());
             ?>

             <?php echo all_element_texts($item,
                 array(
                     'show_empty_elements' => false,
                     'show_element_sets' => 'Dublin Core, Document Item Type Metadata',
                     'show_element_set_headings' => false
                 ));
             ?>

             </div>  <!-- end item-meta -->
        </div><!-- end item hentry -->

		<?php //fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>
<!--
		<ul class="item-pagination navigation">
		<li id="previous-item" class="previous">
			<?php echo link_to_previous_item_show(); ?>
		</li>
		<li id="next-item" class="next">
			<?php echo link_to_next_item_show(); ?>
		</li>
		</ul>
-->
   </div>
         <!-- end #primary-->

   <div id="secondary">
<!--
        <div id="show-sidebar">
	         <dl>
             <dt id="publisher"><?php echo __('Date Added'); ?></dt>
	         <dd><?php echo rhythm_display_date_added(); ?></dd>
	         <?php if (item_belongs_to_collection()): ?>
             <dt id="creator"><?php echo __('Collection'); ?></dt>
	         <dd><?php echo link_to_collection_for_item(); ?></dd>
	         <?php endif; ?>

	         <?php if (item_has_type()): ?>
             <dt id="source"><?php echo __('Item Type'); ?></dt>
	         <dd><?php echo item('Item Type Name'); ?></dd>
	         <?php endif; ?>

	         <?php if(item_has_tags()): ?>
            <dt><?php echo __('Tags'); ?></dt>
			<dd><?php echo item_tags_as_string(); ?></dd>
			<?php endif;?>
             <dt id="subject"><?php echo __('Citation'); ?></dt>
	         <dd><?php echo item_citation(); ?></dd>
             <dt id="files"><?php echo __('Files'); ?></dt>
	         <!-- The following returns all of the files associated with an item. -->
			 <dd>
				<?php $hasShownFile = false; ?>

	 		  	<?php while(loop_files_for_item()): ?>

	     		    <?php
	     		        $file = get_current_file();
	     		        if (!$file->hasThumbnail()):
	     		          echo display_file($file);
	     		          $hasShownFile = true;
	     		        endif;
	     		    ?>

	     		<?php endwhile; ?>

	     		<?php if (!$hasShownFile): ?>
                    <?php echo __('No files are associated with this item.'); ?>
	 		    <?php endif; ?>
	         </dd>
	         </dl>
        </div> <!-- end show-sidebar -->
-->
   </div> <!-- end #secondary -->

<?php echo foot(); ?>
