<?php

namespace Drupal\rxp_core\Entity;

use Drupal\taxonomy\Entity\Term as CoreTerm;

/**
 * Provides a class to extend the taxonomy term class.
 */
class Term extends CoreTerm {

  use ContentEntityBaseTrait;

  /**
   * {@inheritdoc}
   */
  public function toArray() {
    return $this->toArrayData();
  }

}
