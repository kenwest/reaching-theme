<?php

/**
 * @file
 * This template is used to print a single grouping in the reaching.city City to Activity view.
 *
 * Variables available:
 * - $view: The view object
 * - $grouping: The grouping instruction.
 * - $grouping_level: Integer indicating the hierarchical level of the grouping.
 * - $rows: The rows contained in this grouping.
 * - $title: The title of this grouping.
 * - $content: The processed content output that will normally be used.
 */
?>
<div class="view-grouping <?php print strtolower(drupal_clean_css_identifier(filter_var($title, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH))); ?>">
  <div class="view-grouping-header"><?php print $title; ?></div>
  <div class="view-grouping-content">
    <?php print $content; ?>
  </div>
</div>
