<?php
  $title = __(get_option('my_omeka_page_title').' tags');
  head(array('title' => $title, 'bodyid' => get_option('my_omeka_page_title'),'bodyclass'=> 'tags'));
  
?>
<div id="primary">
    <h1><?php echo $title; ?></h1>
    <ul class="navigation exhibit-tags" id="secondary-nav">
    <?php echo nav(array(
        __('Browse All') => uri(get_option('my_omeka_page_path').'browse'),
        __('Browse by Tag') => uri(get_option('my_omeka_page_path').'tags')
    ));?>  
    </ul>
    
    <?php echo tag_cloud($tags,uri(get_option('my_omeka_page_path').'browse')); ?>
</div>

<?php foot(); ?>
