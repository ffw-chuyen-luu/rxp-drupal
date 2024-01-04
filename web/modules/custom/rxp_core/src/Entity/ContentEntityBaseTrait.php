<?php

namespace Drupal\rxp_core\Entity;

use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\datetime\Plugin\Field\FieldType\DateTimeItemInterface;

/**
 * Provides a trait for entities.
 */
trait ContentEntityBaseTrait {

  /**
   * The list fields exclude export to data.
   *
   * @var array
   */
  protected array $excludes = [
    'default_langcode',
    'revision_created',
    'revision_default',
    'revision_id',
    'revision_log',
    'revision_log_message',
    'revision_timestamp',
    'revision_translation_affected',
    'revision_uid',
    'revision_user',
  ];

  /**
   * {@inheritdoc}
   */
  public function toArrayData() : array {
    $value = [];
    $excludes = property_exists($this, 'additionalExcludes') ? array_merge($this->additionalExcludes, $this->excludes) : $this->excludes;
    foreach ($this->getFields() as $field => $property) {
      if (in_array($field, $excludes)) {
        continue;
      }
      $short_field = \str_replace('field_', '', $field);
      $value[$short_field] = $this->propertyData($property);
    }

    return $value;
  }

  /**
   * Get property data of entity.
   *
   * @param \Drupal\Core\Field\FieldItemListInterface $property
   *   The entity property.
   *
   * @return array|string
   *   The property data as array or string.
   */
  private function propertyData(FieldItemListInterface $property) : array|string {
    $field_definition = $property->getFieldDefinition();
    $cardinality = $field_definition->getFieldStorageDefinition()->getCardinality();
    $data = [];
    switch ($field_definition->getType()) {
      case 'integer':
      case 'uuid':
      case 'language':
      case 'boolean':
      case 'string':
      case 'string_long':
      case 'string':
        foreach ($property as $item) {
          $data[] = $item->value;
        }
        break;

      case 'entity_reference':
      case 'entity_reference_revisions':
        foreach ($property as $item) {
          if ($entity = $item->entity) {
            $data[] = $entity->toArray();
          }
        }
        break;

      case 'timestamp':
      case 'created':
      case 'changed':
        foreach ($property as $item) {
          $data[] = DrupalDateTime::createFromTimestamp($item->value)
            ->format(DateTimeItemInterface::DATETIME_STORAGE_FORMAT);
        }
        break;

      case 'image':
        foreach ($property as $item) {
          if ($file = $item->entity) {
            /** @var \Drupal\file\FileInterface $file */
            $data[] = $item->getValue() + [
              'url' => $file->createFileUrl(),
            ];
          }
        }
        break;

      case 'metatag':
        break;

      default:
        $data = $property->getValue();
        break;
    }

    return $cardinality == 1 ? reset($data) : $data;
  }

}
