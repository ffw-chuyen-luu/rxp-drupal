<?php

namespace Drupal\rxp_core\Entity;

use Drupal\node\Entity\Node as CoreNode;

/**
 * Provides a class to extend the node class.
 */
class Node extends CoreNode {

  use ContentEntityBaseTrait;

  /**
   * The list additional fields exclude export to data.
   *
   * @var array
   */
  protected array $additionalExcludes = [
    'field_tags',
  ];

  /**
   * {@inheritdoc}
   */
  public function toArray() {
    return $this->toArrayData();
  }

}
