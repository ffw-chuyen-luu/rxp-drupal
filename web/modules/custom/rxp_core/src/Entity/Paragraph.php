<?php

namespace Drupal\rxp_core\Entity;

use Drupal\paragraphs\Entity\Paragraph as EntityParagraph;

/**
 * Provides a class to extend the paragraph class.
 */
class Paragraph extends EntityParagraph {

  use ContentEntityBaseTrait;

  /**
   * {@inheritdoc}
   */
  public function toArray() {
    return $this->toArrayData();
  }

}
