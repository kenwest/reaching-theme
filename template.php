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


function reaching_preprocess_html(&$variables) {
  return cbf_preprocess_html($variables);
}


/*
 * Ensure that all elements that have their font-size set have a height which is a multiple of 20px (@line-height-computed)
 * Limit the height of blocks, unless they are "unbounded".
 * Collapse other navbar-collapse DIVs when a navbar-toggle is pressed.
 */
function reaching_preprocess_page(&$variables) {
  $script = '
    function cbfStandardiseHeight(elements) {
      elements.each( function() {
        var height = jQuery(this).outerHeight(false);
        var fraction = height % 20;
        if (jQuery(this).css("font-size") !== "14px" && fraction !== 0) {
          jQuery(this).css("min-height",  height - fraction + 20).addClass("cbf-standard-height");
        }
        else {
          cbfStandardiseHeight(jQuery(this).children().not("iframe, form"));
        }
      });
    };
    function cbfStandardiseHeights() {
      jQuery(".cbf-standard-height").css("min-height", "").removeClass("cbf-standard-height");
      cbfStandardiseHeight(jQuery(".main-container, .lead"));
    };
    jQuery(document).ready( function() {
      cbfStandardiseHeights();
      jQuery(".region-content, .region-sidebar-first, .region-sidebar-second, .region-content-second").find(".block-views, .block-block").each(function() {
        if (jQuery(this).height() >= 400 && !jQuery(this).hasClass("unbounded")) {
          jQuery(this).toggleClass("bounded");
          jQuery("<div class=\"block-header\"></div>").prependTo(jQuery(this));
          jQuery("<div class=\"block-footer\"><i class=\"fa fa-fw fa-chevron-down\"></div>").appendTo(jQuery(this)).click(function() {
            jQuery(this).parent().toggleClass("open");
            jQuery(this).find("i").toggleClass("fa-rotate-180");
          });
        }
      });
      jQuery(".navbar-toggle").click(function() {
        var target = jQuery(this).attr("data-target");
        jQuery(".navbar-toggle").each(function () {
          var other = jQuery(this).attr("data-target");
          if (other != target) {
            jQuery(this).toggleClass("collapsed", true);
            jQuery(this).attr("aria-expanded", "false")
            jQuery(other).toggleClass("in", false);
            jQuery(other).attr("aria-expanded", "false")
          }
        });
      });
    });
    jQuery(window).resize( function() {
      cbfStandardiseHeights();
    });
  ';
  drupal_add_js($script, 'inline');
}


/*
 * An implementation of theme_entity_property()
 */
function reaching_entity_property($variables) {
  return cbf_entity_property($variables);
}
