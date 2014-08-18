<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle, 'bodyclass'=>'items tags'));
?>

<h1><?php echo $pageTitle; ?></h1>

<nav class="tags-navigation">
    <?php echo public_nav_items(); ?>
</nav>
<br/><br/><br/><br/>
<?php echo tag_cloud($tags, 'items/browse'); ?>

<?php echo foot(); ?>
