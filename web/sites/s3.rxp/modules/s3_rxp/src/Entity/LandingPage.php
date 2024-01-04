<?php

namespace Drupal\s3_rxp\Entity;

use Drupal\rxp_core\Entity\Node;

/**
 * Provides a class to extend the node class.
 */
class LandingPage extends Node {

  /**
   * {@inheritdoc}
   */
  protected array $additionalExcludes = [];

}
