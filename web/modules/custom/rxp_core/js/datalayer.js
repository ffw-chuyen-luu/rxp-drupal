/**
 * @file
 * Data layer.
 */
(function ($, Drupal, drupalSettings, window, document) {

  'use strict';

  Drupal.behaviors.rxpDatalayer = {
    attach: function (context, settings) {
      if (context === document) {
        var entityData = drupalSettings?.rxpCore?.entityData || {};

        if (Object.keys(entityData).length) {
          window.onload = function () {
            window.dataLayer = window.dataLayer || [];
            dataLayer.push(entityData);

            // Use the data as needed
            console.log('Data layer:', window.dataLayer);
          };
        }
      }
    }
  };

})(jQuery, Drupal, drupalSettings, window, document);
