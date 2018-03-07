#!/bin/bash
#
# Process the Less files

lessc less/style.less > css/style.css
yui-compressor css/style.css > css/style.min.css
drush -l reaching.city cc css-js
