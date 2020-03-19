<?php

/**
 * @file bloch.theme
 * Custom PHP code used by the Bloch theme.
 * EHESS 2020 - David N. Brett / Richard Legrand
 */

/** 
 * Theme settings page
 * Can be used to customize the template from the backoffice.
 * (disabled if not used)
 */
/*
function bloch_form_system_theme_settings_alter(&$form, \Drupal\Core\Form\FormStateInterface $form_state, $form_id = NULL) {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }

  $form['bloch_example'] = array(
    '#type'          => 'textfield',
    '#title'         => t('Widget'),
    '#default_value' => theme_get_setting('bloch_example'),
    '#description'   => t("Place this text in the widget spot on your site."),
  );
}
*/

/**
 * If the curent taxonomy vocabulary page uses a custom layout,
 * we must suggest Drupal to use a specific tempate file.
 *
 * e.g. : vocabulary "rubriques_principales" (machine name)
 *        can use "page--taxonomy--rubriques-principales.html.twig"
 *
 * Notice the "_" to "-" conversion, specific to Drupal 8.
 */

// Define the namespace so Drupal knows the functions we are calling
use Drupal\taxonomy\Entity\Term;

function bloch_theme_suggestions_page_alter(
    &$suggestions, 
    &$vars) 
{
  if (  \Drupal::routeMatch()->getRouteName() == 'entity.taxonomy_term.canonical' 
        && $tid = \Drupal::routeMatch()->getRawParameter('taxonomy_term')   ) 
  {
    $term = Term::load($tid);
    $suggestions[] = 'page__taxonomy__' . $term->getVocabularyId();
  }
}
