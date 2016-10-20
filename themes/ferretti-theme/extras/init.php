<?php

$extra_includes = [
	'extras/settings.php',
	'extras/utils.php',
	'extras/scripts.php',
	'extras/styles.php',
	'extras/api.php'
];

foreach ($extra_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);