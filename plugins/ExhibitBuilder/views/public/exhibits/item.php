<?php
$title = html_escape(__('Item #%s', $item->id));
head(array('title' => $title, 'bodyid' => 'exhibit', 'bodyclass' => 'exhibit-item-show'));
?>
<div id="primary">

	<h1 class="item-title"><?php echo item('Dublin Core', 'Title'); ?></h1>
	<div id="itemfiles">
		<?php echo display_files_for_item(); ?>
	</div>
	<?php //echo show_item_metadata(); ?>
	<br />
	<h2>Title</h2>
	<p><?php echo item('Dublin Core', 'Title'); ?></p>

	<h2>Description</h2>
	<p><?php echo item('Dublin Core', 'Description'); ?></p>

	<h2>Source</h2>
	<p><?php echo item('Dublin Core', 'Source'); ?></p>

	<h2>Date</h2>
	<p><?php echo item('Dublin Core', 'Date'); ?></p>

	<?php if ( item_belongs_to_collection() ): ?>
        <div id="collection" class="field">
            <h2><?php echo __('Collection'); ?></h2>
            <div class="field-value"><p><?php echo link_to_collection_for_item(); ?></p></div>
        </div>
    <?php endif; ?>
    
	<?php if (item_has_tags()): ?>
	<div class="tags">
		<h2><?php echo __('Tags'); ?></h2>
	   <?php echo item_tags_as_string(); ?>	
	</div>
	<?php endif;?>
	
	<div id="citation" class="field">
    	<h2><?php echo __('Citation'); ?></h2>
    	<p id="citation-value" class="field-value"><?php echo item_citation(); ?></p>
	</div>
	
</div>
<div id="secondary">
<div id="nav-container">
       <a class="homer" style="margin-left:25px;font-size:1.6em;line-height:1.5em;text-decoration:none;text-shadow:0.5px 0.5px 0.5px #333333;color:#333;" href="/exhibits/show/romulus-linney/">Home</a>
       <?php echo exhibit_builder_nested_nav();?>
	<?php /* echo exhibit_builder_section_nav();?>
	<?php echo exhibit_builder_page_nav();*/?>
</div>

<?php foot(); ?>
