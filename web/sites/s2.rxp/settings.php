<?php

/**
 * Load services definition file.
 */
$settings['container_yamls'][] = __DIR__ . '/services.yml';

/**
 * Place the config directory outside of the Drupal root.
 */
$settings['config_sync_directory'] = '../config/default';

/**
 * Config settings.
 */
$config_settings = __DIR__ . "/settings.config.php";
if (file_exists($config_settings)) {
  include $config_settings;
}

/**
 * The default list of directories that will be ignored by Drupal's file API.
 *
 * By default ignore node_modules and bower_components folders to avoid issues
 * with common frontend tools and recursive scanning of directories looking for
 * extensions.
 *
 * @see file_scan_directory()
 * @see \Drupal\Core\Extension\ExtensionDiscovery::scanDirectory()
 */
$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components',
];

/**
 * The default number of entities to update in a batch process.
 *
 * This is used by update and post-update functions that need to go through and
 * change all the entities on a site, so it is useful to increase this number
 * if your hosting configuration (i.e. RAM allocation, CPU speed) allows for a
 * larger number of entities to be processed in a single batch run.
 */
$settings['entity_update_batch_size'] = 50;

/**
 * Include the Pantheon-specific settings file.
 */
$local_settings = __DIR__ . "/settings.pantheon.php";
if (file_exists($local_settings)) {
  include $local_settings;
}

/**
 * Load local development override configuration, if available.
 */
$local_settings = __DIR__ . "/settings.local.php";
if (file_exists($local_settings)) {
  include $local_settings;
}
