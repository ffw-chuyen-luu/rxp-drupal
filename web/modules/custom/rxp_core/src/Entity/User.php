<?php

namespace Drupal\rxp_core\Entity;

use Drupal\user\Entity\User as CoreUser;

/**
 * Provides a class to extend the user class.
 */
class User extends CoreUser {

  /**
   * {@inheritdoc}
   */
  public function toArray() {
    // Only public data.
    return [
      'uid' => $this->id(),
      'uuid' => $this->uuid(),
      'displayName' => $this->getDisplayName(),
    ];
  }

}
