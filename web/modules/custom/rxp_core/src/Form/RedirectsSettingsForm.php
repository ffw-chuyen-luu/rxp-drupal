<?php

namespace Drupal\rxp_core\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configures Netlify redirects settings for the site.
 */
class RedirectsSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'rxp_core_netlify_redirects_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['rxp_core.redirects_settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $config = $this->config('rxp_core.redirects_settings');

    $form['redirects'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Wildcard redirects'),
      '#description' => $this->t('Each redirect rule must be listed on a separate line, with the original path followed by the new path or URL. More information <a href=":link">here</a>.', [
        ':link' => 'https://docs.netlify.com/routing/redirects/#syntax-for-the-redirects-file',
      ]),
      '#default_value' => $config->get('redirects'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $config = $this->config('rxp_core.redirects_settings');
    $config->set('redirects', $form_state->getValue('redirects'));
    $config->save();
  }

}
