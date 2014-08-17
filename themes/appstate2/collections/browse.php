<?php
    $pageTitle = __('Browse Collections');
    echo head(array('title'=>$pageTitle, 'bodyid' => 'collections', 'bodyclass' => 'browse'));
?>

<div id="primary">
    <h1><?php echo $pageTitle; ?> <?php echo __('(%s total)', $total_results); ?></h1>

    <?php foreach (loop('collections') as $collection): ?>

    <div class="collection collection-items">
        <?php if ($collectionImage = record_image('collection', 'square_thumbnail')): ?>
            <?php echo link_to_collection($collectionImage, array('class' => 'image collection-img')); ?>
        <?php endif; ?>

        <h1><?php echo link_to_collection(); ?></h1>

        <div class="collection-meta">
            <?php if (metadata('collection', array('Dublin Core', 'Description'))): ?>
            <div class="collection-description">
                <?php echo text_to_paragraphs(metadata('collection', array('Dublin Core', 'Description'), array('snippet'=>150))); ?>
            </div>
            <?php endif; ?>

            <p class="view-items-link">
                <?php echo link_to_items_browse(__('View the items in %s', metadata('collection', array('Dublin Core', 'Title'))),
                array('collection' => metadata('collection', 'id'))); ?>
            </p>

            <?php fire_plugin_hook('public_collections_browse_each', array('view' => $this, 'collection' => $collection)); ?>
        </div>

    </div><!-- end class="collection" -->
    <?php endforeach; ?>

    <div id="pagination">
        <?php echo pagination_links(); ?>
    </div>

    <?php fire_plugin_hook('public_collections_browse', array('collections'=>$collections, 'view' => $this)); ?>
</div>

<div id="secondary">
  <!-- Featured Collection -->
  <?php if (get_theme_option('Display Featured Collection')): ?>
  <div id="featured-collection" class="featured">
      <h2><?php echo __('Featured Collection'); ?></h2>
      <?php echo random_featured_collection(); ?>
  </div><!-- end featured collection -->
  <?php endif; ?>

  <!-- Featured Exhibit -->
  <?php if ((get_theme_option('Display Featured Exhibit')) && function_exists('exhibit_builder_display_random_featured_exhibit')): ?>
  <?php echo exhibit_builder_display_random_featured_exhibit(); ?>
  <?php endif; ?>
</div>

<?php echo foot(); ?>
