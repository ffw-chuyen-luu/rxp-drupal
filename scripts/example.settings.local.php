<?php

/**
 * Trusted host configuration.
 */
$settings['trusted_host_patterns'] = [
  '^.+\.lndo\.site$',
];

$dir = basename(__DIR__);
$explodes = @explode('.', $dir);
$site = 'drupal10';
if (is_array($explodes)) {
  $explodes = array_reverse($explodes);
  $site = $explodes['1'] ?? 'drupal10';
}

$databases['default']['default'] = [
  'database' => "db{$site}",
  'username' => 'drupal10',
  'password' => 'drupal10',
  'prefix' => '',
  'host' => "db{$site}",
  'port' => '3306',
  'isolation_level' => 'READ COMMITTED',
  'namespace' => 'Drupal\\mysql\\Driver\\Database\\mysql',
  'driver' => 'mysql',
  'autoload' => 'core/modules/mysql/src/Driver/Database/mysql/',
];

$settings['hash_salt'] = '40DHhhP7qkGvxy48eRkVF7aDRL5pkK1l6f7CB7f8p4ZAn8iOd_g87XCBjFyh4Z8Nd4hmVRtODQ';
