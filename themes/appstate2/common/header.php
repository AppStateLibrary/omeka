<!DOCTYPE html>
<html lang="en-us">
<head>
<?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
?>
<title><?php echo implode(' &middot; ', $titleParts); ?></title>
<link rel="shortcut icon" href="/themes/appstate2/images/favicon.ico" type="image/x-icon" />

<!-- Meta -->
<meta charset="utf-8" />
<?php if ( $description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
<?php endif; ?>

<?php echo auto_discovery_link_tags(); ?>

<!-- Plugin Stuff -->
<?php fire_plugin_hook('public_head', array('view'=>$this)); ?>

<!-- Stylesheets -->
<?php
queue_css_file(array('style'));
echo head_css();
?>

<!-- JavaScripts -->
<?php queue_js_file('vendor/jquery'); ?>
<script type="text/javascript">
jQuery.noConflict();
    jQuery(document).ready(function () {
	jQuery("#submit_search").val("Search Digital Collections");
});
</script>
<?php echo head_js(); ?>
</head>

<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>

<?php fire_plugin_hook('public_body', array('view'=>$this)); ?>

<div id="wrap">
	<div id="header">
		<?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
		<div id="search-wrap">
			<?php echo search_form(); ?><br/>
			<a href="http://omeka.library.appstate.edu/contact">Report a problem</a>
		</div><!-- end search -->

		<div id="site-title">
			<h1 id="head1"><a href="http://omeka.library.appstate.edu/">Digital Collections</a></h1>
			<h2 id="head2"><a href="http://www.library.appstate.edu">Appalachian State University</a></h2>
		</div>
	</div><!-- end header -->

	<div id="primary-nav"><div id="primary-nav2">
		<ul class="navigation">
		<?php
			$navArray = array();
			$navArray[] = array('label'=>'Home', 'uri'=>url(''));
			$navArray[] = array('label'=>'Collections', 'uri'=>url('collections?sort_field=Dublin+Core%2CTitle'));
			$navArray[] = array('label'=>'About', 'uri'=>url('about'));
			$navArray[] = array('label'=>'Exhibits', 'uri'=>url('exhibits'));

			echo nav($navArray);
		?>
		</ul>
	</div></div><!-- end primary-nav -->

	<div id="content">
		<?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
