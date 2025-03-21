<?php

/**
 *
 * GPT Assistant Installation Migration.
 *
 * @copyright (c) 2025, Oprea Cristian, https://itandwebsolutions.ro
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace iws\gptassistant\migrations;

class install_gptassistant extends \phpbb\db\migration\migration
{
    public function effectively_installed()
    {
        return isset($this->config['gptassistant_ver']) && version_compare($this->config['gptassistant_ver'], '1.0.0', '>=');
    }

    public static function depends_on()
    {
        return ['\phpbb\db\migration\data\v320\v320'];
    }

    public function update_data()
    {
        return [
            // Add general configuration settings for GPT Assistant
            ['config.add', ['gptassistant_active', 0]],  // Default to disabled
            ['config.add', ['gptassistant_api_key', '']],  // Empty API key by default
            ['config.add', ['gptassistant_model', 'gpt-4o-mini']], // Default model
            ['config.add', ['gptassistant_user', 0]],  // Default to no user selected
            ['config.add', ['gptassistant_temperature', 0.7]], // Default temperature
            ['config.add', ['gptassistant_max_tokens', 500]],  // Default max tokens
            ['config.add', ['gptassistant_ver', '1.0.0']], // Version info for GPT Assistant

            // Add configuration settings for GPT Assistant activity
            ['config.add', ['gptassistant_activity_enabled', 1]],  // Default to enabled
            ['config.add', ['gptassistant_activity_frequency', 7]], // Default to 7 days frequency
            ['config.add', ['gptassistant_activity_limit', 10]],    // Default to 10 activities
            ['config.add', ['gptassistant_activity_enable_tags', 0]], // Default to disabled
            ['config.add', ['gptassistant_activity_ver', '1.0.0']], // Version for activity settings

            // Add configuration for the allowed forums for GPT Assistant
            ['config.add', ['gptassistant_selected_forums', '']],  // Default to no forums selected

            // Add ACP modules
            ['module.add', [
                'acp',
                'ACP_CAT_DOT_MODS',
                'ACP_GPTASSISTANT_TITLE'
            ]],
            ['module.add', [
                'acp',
                'ACP_GPTASSISTANT_TITLE',
                [
                    'module_basename' => '\iws\gptassistant\acp\main_module',
                    'modes' => ['settings'],
                ],
            ]],

            // Add ACP module for GPT Assistant activity settings
            ['module.add', [
                'acp',
                'ACP_GPTASSISTANT_TITLE',
                [
                    'module_basename' => '\iws\gptassistant\acp\main_module',
                    'modes' => ['activity_settings'],
                ],
            ]],
        ];
    }

    public function revert_data()
    {
        return [
            // Remove configuration settings for GPT Assistant
            ['config.remove', ['gptassistant_active']],
            ['config.remove', ['gptassistant_api_key']],
            ['config.remove', ['gptassistant_model']],
            ['config.remove', ['gptassistant_user']],
            ['config.remove', ['gptassistant_temperature']],
            ['config.remove', ['gptassistant_max_tokens']],
            ['config.remove', ['gptassistant_ver']],

            // Remove configuration settings for GPT Assistant activity
            ['config.remove', ['gptassistant_activity_enabled']],
            ['config.remove', ['gptassistant_activity_frequency']],
            ['config.remove', ['gptassistant_activity_limit']],
            ['config.remove', ['gptassistant_activity_enable_tags']],
            ['config.remove', ['gptassistant_activity_ver']],

            // Remove configuration for the allowed forums for GPT Assistant
            ['config.remove', ['gptassistant_selected_forums']],

            // Remove ACP modules
            ['module.remove', [
                'acp',
                'ACP_GPTASSISTANT_TITLE',
                [
                    'module_basename' => '\iws\gptassistant\acp\main_module',
                    'modes' => ['settings'],
                ],
            ]],
            ['module.remove', [
                'acp',
                'ACP_GPTASSISTANT_TITLE',
                [
                    'module_basename' => '\iws\gptassistant\acp\main_module',
                    'modes' => ['activity_settings'],
                ],
            ]],

            // Remove the GPT Assistant category
            ['module.remove', [
                'acp',
                'ACP_CAT_DOT_MODS',
                'ACP_GPTASSISTANT_TITLE'
            ]],
        ];
    }
}
