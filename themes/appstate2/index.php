<?php echo head(array('bodyid'=>'home')); ?>

<div id="primary">
    <?php if ($homepageText = get_theme_option('Homepage Text')): ?>
        <!-- Homepage Text -->
        <?php echo $homepageText; ?>
    <?php endif; ?>

    <?php if (get_theme_option('Display Featured Item') !== '0'): ?>
    <!-- Featured Item -->
    <div id="featured-item">
        <?php echo random_featured_items(1, true); ?>
    </div><!--end featured-item-->
    <?php endif; ?>

    <div id="recent-items">
    <?php
    $recentItems = get_theme_option('Homepage Recent Items');
    if ($recentItems === null || $recentItems === ''):
        $recentItems = 3;
    else:
        $recentItems = (int) $recentItems;
    endif;
    if ($recentItems):
    ?>
    <div id="recent-items" class="items-list">
        <h2><?php echo __('Recently Added Items'); ?></h2>
        <?php
            set_loop_records('items', get_recent_items(4));
            foreach (loop('items') as $item):
        ?>
            <div class="item">
                <h3><?php echo link_to_item(); ?></h3>
                <?php if (metadata($item, 'has thumbnail')): ?>
                <div class="item-img">
                    <?php echo link_to_item(item_image('square_thumbnail')); ?>
                </div>
                <?php endif; ?>
                <?php if ($desc = metadata($item, array('Dublin Core', 'Description'), array('snippet'=>150))): ?>
                    <div class="item-description"><?php echo $desc; ?><p><?php echo link_to_item('see more',(array('class'=>'show'))) ?></p></div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <p class="view-items-link item">
            <a href="<?php echo html_escape(url('items')); ?>"><?php echo __('View All Items'); ?></a>
        </p>
    </div><!--end recent-items -->
    <?php endif; ?>

    <?php fire_plugin_hook('public_home', array('view' => $this)); ?>

    </div><!--end recent-items -->
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

  <!-- Contact Information -->
  <div class="quick">
      <h2>Contact Information</h2>
      <p>For questions about the ASU <br />Digital Collections, please contact Pam Mitchem.</p>
      <p><a href="mailto:pricemtchemp@appstate.edu">pricemtchemp@appstate.edu</a></p>
      <p>Phone: 828.262.7422</p>
      <p>&nbsp;</p>
  </div>

</div>

<?php echo foot();
