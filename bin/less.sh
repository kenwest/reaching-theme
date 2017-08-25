#!/bin/bash
#
# Process the Less files

lessc less/style.less > css/style.css
drush -l reaching.city cc css-js
