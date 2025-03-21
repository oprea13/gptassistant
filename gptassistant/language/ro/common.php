<?php

/**
 *
 * GPT Assistant. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2025, Oprea Cristian, https://itandwebsolutions.ro
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB')) {
    exit;
}

if (empty($lang) || !is_array($lang)) {
    $lang = [];
}

$lang = array_merge($lang, [
    'GPT_ASSISTANT_RESPONSE' => 'GPT Assistant a generat un răspuns:',
    'GPT_ASSISTANT_ERROR'    => 'Eroare la generarea răspunsului AI.',
    'GPT_ASSISTANT_BUTTON'   => 'Generează răspuns cu AI',
    'GPT_MODEL_DESC_gpt-4o-mini'   => 'Oferă răspunsuri mai rapid la majoritatea întrebărilor. (Disponibil gratuit)',
    'GPT_MODEL_DESC_gpt-4o'        => 'Excelent pentru majoritatea întrebărilor. (Necesită plan Plus pe ChatGPT)',
    'GPT_MODEL_DESC_gpt-4.5'       => 'Potrivit pentru sarcini de redactare și explorarea ideilor. (Necesită plan Plus pe ChatGPT, dacă este disponibil)',
    'GPT_MODEL_DESC_o3-mini'       => 'Raționare avansată rapidă. (Disponibil gratuit)',
    'GPT_MODEL_DESC_o3-mini-high'  => 'Excelent la activități de codare și logică. (Disponibil gratuit)',
]);
