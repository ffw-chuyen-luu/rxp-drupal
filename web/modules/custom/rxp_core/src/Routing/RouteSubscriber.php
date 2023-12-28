<?php

namespace Drupal\rxp_core\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    $routes = [
      'tome_static.main' => '/admin/static',
      'tome_static.generate' => '/admin/static/generate',
      'tome_static.download_page' => '/admin/static/download',
      'tome_static.preview_form' => '/admin/static/preview',
      'tome_static.deploy' => '/admin/static/deploy',
    ];

    foreach ($routes as $name => $new_path) {
      if ($route = $collection->get($name)) {
        $route->setPath($new_path);
      }
    }
  }

}
