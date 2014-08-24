<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>" class="<?php echo get_theme_option('Style Sheet'); ?>">
<head>
    <meta charset="utf-8">
    <?php if ($description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>">
    <?php endif; ?>

    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>



<script type="text/javascript" src="http://lion.library.appstate.edu/jquery-a.js"></script>
<script>
$(document).ready(function(){
	$('#wrap1').click(function(){
		window.location.href="http://lion.library.appstate.edu:8092/exhibits/show/romulus-linney/";
	});
	$('#exhibit-pages > ul > li > a').removeAttr('href').mouseenter(function() { $(this).css("color", "black"); });
});
</script>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>

    <!-- Stylesheets -->
    <?php
    queue_css_file('style');
    echo head_css();
    ?>

    <!-- JavaScripts -->
    <?php echo head_js(); ?>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>

<div id="wrap"><div id="wrap1" style="height:274px;position:absolute;top:0px;z-index:10;width:960px;"></div>
    <div id="header">
            <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
        <div id="site-title">
            <?php echo rhythm_display_tagline(); ?>
        </div> <!-- end #site-title -->

        <div id="searchwrap">
    	</div> <!-- end #searchwrap -->

    </div>  <!-- end #header -->

    <div id="primary-nav">
    </div>  <!-- end #primary-nav -->

    <div id="content">
        <?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>

