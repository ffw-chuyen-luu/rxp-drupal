<?php

namespace Drupal\rxp_core\Entity;

use Drupal\node\Entity\Node as CoreNode;

/**
 * Provides a class to extend the node class.
 */
class Node extends CoreNode {

  use ContentEntityBaseTrait;

  /**
   * {@inheritdoc}
   */
  public function toArray() {
    return $this->toArrayData();
  }

}
