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
    // General GPT Assistant settings
    'ACP_GPTASSISTANT_TITLE'          => 'GPT Assistant',
    'ACP_GPTASSISTANT'                => 'Setări GPT Assistant',
    'GPT_ASSISTANT_SETTINGS'          => 'Setări GPT Assistant',

    'ACP_GPTASSISTANT_ACTIVE'         => 'Activează GPT Assistant',
    'ACP_GPTASSISTANT_API_KEY'        => 'Cheie API OpenAI',
    'ACP_GPTASSISTANT_API_KEY_EXPLAIN'=> 'Introdu aici cheia ta API de la OpenAI pentru a activa GPT Assistant.',
    'ACP_GPTASSISTANT_API_INFO'       => 'Obține cheia API de la OpenAI',
    'ACP_GPTASSISTANT_API_GET'        => 'Click aici pentru a obține o cheie API',

    'ACP_GPTASSISTANT_MODEL'          => 'Model ChatGPT',
    'ACP_GPTASSISTANT_MODEL_EXPLAIN'  => 'Selectează modelul ChatGPT care va fi utilizat pentru generarea răspunsurilor.',
    'ACP_GPTASSISTANT_USER'           => 'Utilizator GPT Assistant',
    'ACP_GPTASSISTANT_USER_EXPLAIN'   => 'Selectează utilizatorul care va posta răspunsurile generate de AI.',

    'ACP_GPTASSISTANT_TEMPERATURE'    => 'Nivel de creativitate (Temperatură)',
    'ACP_GPTASSISTANT_TEMPERATURE_EXPLAIN' => 'Setează cât de creativ să fie GPT Assistant. Valori mai mici (0.0) oferă răspunsuri mai factuale, iar valori mai mari (1.0) oferă răspunsuri mai creative.',

    'ACP_GPTASSISTANT_MAX_TOKENS'     => 'Lungime maximă a răspunsului',
    'ACP_GPTASSISTANT_MAX_TOKENS_EXPLAIN' => 'Setează numărul maxim de caractere pentru răspunsurile generate de AI.',

    'ACP_GPTASSISTANT_PRO_RECOMMENDATION' => 'Pentru răspunsuri mai avansate, recomandăm achiziționarea unui plan Pro pe ChatGPT.',

    'LOG_ACP_GPTASSISTANT_SETTINGS'   => '<strong>Setările GPT Assistant au fost actualizate</strong>',
    'ACP_GPTASSISTANT_SETTING_SAVED'  => 'Setările GPT Assistant au fost salvate cu succes.',

    // Activity settings
    'ACP_GPTASSISTANT_ACTIVITY_TITLE' => 'Setări Activitate GPT Assistant',
    'ACP_GPTASSISTANT_ACTIVITY_ENABLED' => 'Activează activitatea GPT Assistant',
    'ACP_GPTASSISTANT_ACTIVITY_ENABLED_DESC' => 'Permite activitatea automată a GPT Assistant pentru postările în forumuri selectate.',
    'ACP_GPTASSISTANT_ACTIVITY_FREQUENCY' => 'Frecvența postărilor (minute)',
    'ACP_GPTASSISTANT_ACTIVITY_FREQUENCY_DESC' => 'Setează frecvența (în minute) între postările GPT Assistant.',
    'ACP_GPTASSISTANT_ACTIVITY_LIMIT' => 'Limita postărilor pe zi',
    'ACP_GPTASSISTANT_ACTIVITY_LIMIT_DESC' => 'Setează numărul maxim de postări pe care GPT Assistant le poate face într-o zi.',
    'ACP_GPTASSISTANT_ACTIVITY_FORUMS' => 'Forumuri permise pentru postări',
    'ACP_GPTASSISTANT_ACTIVITY_FORUMS_DESC' => 'Selectează forumurile în care GPT Assistant poate posta activ.',
    'ACP_GPTASSISTANT_ACTIVITY_ENABLE_TAGS' => 'Permite adăugarea de taguri în topicuri',
    'ACP_GPTASSISTANT_ACTIVITY_ENABLE_TAGS_DESC' => 'Permite GPT Assistant să adauge taguri în topicurile postate. Acest lucru este disponibil doar dacă extensia "TopicTags" este activată.',
]);

