<?php echo head(array(
    'title' => metadata('exhibit_page', 'title') . ' &middot; ' . metadata('exhibit', 'title'),
    'bodyid'=>'exhibit', 'bodyclass' => 'exhibits show'));
?>

<div id="primary" class="exhibit-show">
	<h1><?php echo metadata('exhibit_page', 'title'); ?></h1>

	<?php exhibit_builder_render_exhibit_page(); ?>

    <?php if (count(exhibit_builder_child_pages()) > 0): ?>
    <nav id="exhibit-page-navigation" class="secondary-nav"><!-- id="exhibit-child-pages"  -->
        <?php echo exhibit_builder_child_page_nav(); ?>
    </nav>
    <?php endif; ?>


	<div id="exhibit-page-navigation">
	    <?php echo exhibit_builder_link_to_previous_page(); ?>
    	    <?php echo exhibit_builder_link_to_next_page(); ?>
	</div>

</div>

<div id="secondary">
    <div id="nav-container">
        <a class="homer" style="margin-left:15px;font-size:1.6em;line-height:1.5em;text-shadow:0.5px 0.5px 0.5px #333333;color:#333;"
            href="/exhibits/show/romulus-linney/">Home</a>
        <?php set_exhibit_pages_for_loop_by_exhibit(); ?>
        <?php if (has_loop_records('exhibit_page')): ?>
        <nav id="exhibit-pages">
            <ul>
                <?php foreach (loop('exhibit_page') as $exhibitPage): ?>
                    <?php echo exhibit_builder_page_summary($exhibitPage); ?>
                <?php endforeach; ?>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
</div>

<?php echo foot(); ?>
