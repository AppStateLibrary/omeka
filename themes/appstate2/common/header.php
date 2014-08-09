<!DOCTYPE html>
<html lang="en-us">
<head>
<title><?php echo settings('site_title'); echo $title ? ' | ' . strip_formatting($title) : ''; ?></title>
<link rel="shortcut icon" href="/themes/appstate2/images/favicon.ico" type="image/x-icon" />

<!-- Meta -->
<meta charset="utf-8" />
<meta name="description" content="<?php echo settings('description'); ?>" />

<?php echo auto_discovery_link_tag(); ?>

<!-- Plugin Stuff -->
<?php plugin_header(); ?>

<!-- Stylesheets -->
<?php
queue_css(array('style'), 'screen');
display_css();
?>

<!-- JavaScripts -->
<?php echo js('jquery'); ?>
<script type="text/javascript">
jQuery.noConflict();
    jQuery(document).ready(function () {
	jQuery("#submit_search").val("Search Digital Collections");
});
</script>

</head>

<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>

<?php plugin_body(); ?>

<div id="wrap">

	<div id="header">
		<?php plugin_page_header(); ?>	
		<div id="search-wrap">
			<?php echo simple_search(); ?>
			<?php echo link_to_advanced_search('advanced search'); ?>
			<br /><a href="http://omeka.library.appstate.edu/contact">Report a problem</a>
		</div><!-- end search -->
	    
		<div id="site-title"><h1 id="head1"><a href="http://omeka.library.appstate.edu/">Digital Collections</a></h1>
					<h2 id="head2"><a href="http://www.library.appstate.edu">Appalachian State University</a></h2></div>
		
	</div><!-- end header -->
	
	<div id="primary-nav"><div id="primary-nav2">
		<ul class="navigation">
		<?php 
			//echo public_nav_main(array('Home' => uri(''), 'Browse Items' => uri('items'), 'Browse Collections'=>uri('collections'), 'Exhibits'=>uri('exhibits')));
			echo nav(
				array(
					'Home' => uri(''),
					
					'Collections' => uri('collections?sort_field=name'),
					'About' => uri('about'),
					'Exhibits'=> uri('exhibits')
					)
				); 
		?>
		</ul>
	</div></div><!-- end primary-nav -->

<div id="content">
<?php plugin_page_content(); ?>