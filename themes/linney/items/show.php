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
    <div id="nav-container">
        <a class="homer" style="margin-left:15px;font-size:1.6em;line-height:1.5em;text-shadow:0.5px 0.5px 0.5px #333333;color:#333;"
            href="/exhibits/show/romulus-linney/">Home</a>
        <?php set_exhibit_pages_for_loop_by_exhibit(); ?>
        <?php if (has_loop_records('exhibit_page')): ?>
        <nav id="exhibit-pages">
            <ul id="exhibit-page-nav">
                <?php foreach (loop('exhibit_page') as $exhibitPage): ?>
                    <?php echo exhibit_builder_page_summary($exhibitPage); ?>
                <?php endforeach; ?>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
   </div> <!-- end #secondary -->

<?php echo foot(); ?>
