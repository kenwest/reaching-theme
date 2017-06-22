<?php

/**
 * @file
 * template.php
 */

/*
 * When viewing a node in 'full' mode, show contextual links. The navigation
 * tabs are hidden by CSS.
 */
function reaching_node_view_alter(&$build) {
  if ($build['#view_mode'] == 'full' && $build['#entity_type'] == 'node' && isset($build['#node']) && !empty($build['#node']->nid)) {
    $build['#contextual_links']['node'] = array('node', array($build['#node']->nid));
  }
}

/*
 * Limit the height of blocks
 */
function reaching_preprocess_page(&$variables) {
  $script = '
    jQuery(document).ready(function(){
      jQuery(".region-content, .region-sidebar-first, .region-sidebar-second").find(".block-views, .block-block").each(function() {
        if(jQuery(this).height() >= 400 && !jQuery(this).hasClass("unbounded")) {
          jQuery(this).toggleClass("bounded");
          jQuery("<div class=\"block-header\"></div>").prependTo(jQuery(this));
          jQuery("<div class=\"block-footer\"><i class=\"fa fa-fw fa-chevron-down\"></div>").appendTo(jQuery(this)).click(function() {
            jQuery(this).parent().toggleClass("open");
            jQuery(this).find("i").toggleClass("fa-rotate-180");
          });
        }
      });
    });';
  drupal_add_js($script, 'inline');
 }

/*
 * An implementation of theme_entity_property()
 */
function reaching_entity_property($variables) {
  return cbf_entity_property($variables);
}

