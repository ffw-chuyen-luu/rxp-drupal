<?php

namespace Drupal\rxp_core\Entity;

use Drupal\media\Entity\Media as CoreMedia;

/**
 * Provides a class to extend the media class.
 */
class Media extends CoreMedia {

  use ContentEntityBaseTrait;

  /**
   * {@inheritdoc}
   */
  public function toArray() {
    return $this->toArrayData();
  }

}
