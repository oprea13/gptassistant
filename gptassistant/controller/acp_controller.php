<?php

/**
 *
 * GPT Assistant ACP Controller.
 *
 * @copyright (c) 2025, Oprea Cristian, https://itandwebsolutions.ro
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace iws\gptassistant\controller;

class acp_controller
{
    /** @var \phpbb\config\config */
    protected $config;

    /** @var \phpbb\language\language */
    protected $language;

    /** @var \phpbb\log\log */
    protected $log;

    /** @var \phpbb\request\request */
    protected $request;

    /** @var \phpbb\template\template */
    protected $template;

    /** @var \phpbb\user */
    protected $user;

    /** @var \phpbb\db\driver\driver_interface */
    protected $db;

    /** @var string Custom form action */
    protected $u_action;

    /**
     * Constructor.
     */
    public function __construct(
        \phpbb\config\config $config,
        \phpbb\language\language $language,
        \phpbb\log\log $log,
        \phpbb\request\request $request,
        \phpbb\template\template $template,
        \phpbb\user $user,
        \phpbb\db\driver\driver_interface $db
    ) {
        $this->config = $config;
        $this->language = $language;
        $this->log = $log;
        $this->request = $request;
        $this->template = $template;
        $this->user = $user;
        $this->db = $db;
    }

    /**
     * Display the options in ACP.
     */
    public function display_options()
    {
        // Load language file
        $this->language->add_lang('common', 'iws/gptassistant');

        // Form security
        add_form_key('iws_gptassistant_acp');

        $errors = [];

        // Process form submission
        if ($this->request->is_set_post('submit')) {
            if (!check_form_key('iws_gptassistant_acp')) {
                $errors[] = $this->language->lang('FORM_INVALID');
            }

            if (empty($errors)) {
                // Save settings
                $this->set_configs();

                // Log changes
                $this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_ACP_GPTASSISTANT_SETTINGS');

                // Confirm success
                trigger_error($this->language->lang('ACP_GPTASSISTANT_SETTING_SAVED') . adm_back_link($this->u_action));
            }
        }

        $s_errors = !empty($errors);

        // Fetch all users for dropdown
        $users = $this->get_all_users();

        // Fetch all forums for selection list
        $forums = $this->get_all_forums();

        // Get selected forums from config
        $selected_forums = explode(',', (string)$this->config['gptassistant_selected_forums']);

        // Assign template variables
        $this->template->assign_vars([
            'S_ERROR'                => $s_errors,
            'ERROR_MSG'              => $s_errors ? implode('<br />', $errors) : '',

            'GPTASSISTANT_ACTIVE'    => (bool) $this->config['gptassistant_active'],
            'GPTASSISTANT_API_KEY'   => $this->config['gptassistant_api_key'],
            'GPTASSISTANT_MODEL'     => $this->config['gptassistant_model'],
            'GPTASSISTANT_USER'      => $this->config['gptassistant_user'],
            'GPTASSISTANT_TEMPERATURE' => $this->config['gptassistant_temperature'],
            'GPTASSISTANT_MAX_TOKENS'  => $this->config['gptassistant_max_tokens'],
            'GPTASSISTANT_USERS'     => $users,

            // Activity settings
            'GPTASSISTANT_ACTIVITY_ENABLED' => (bool) $this->config['gptassistant_activity_enabled'],
            'GPTASSISTANT_ACTIVITY_FREQUENCY' => $this->config['gptassistant_activity_frequency'],
            'GPTASSISTANT_ACTIVITY_LIMIT'  => $this->config['gptassistant_activity_limit'],
            'GPTASSISTANT_FORUMS' => $forums,
            'GPTASSISTANT_SELECTED_FORUMS' => $selected_forums,
            'GPTASSISTANT_ACTIVITY_ENABLE_TAGS' => (bool) $this->config['gptassistant_activity_enable_tags'], 

            'U_ACTION'               => $this->u_action,
        ]);
    }

    /**
     * Save settings to database.
     */
    protected function set_configs()
    {
        // Save general settings
        $this->config->set('gptassistant_active', $this->request->variable('gptassistant_active', 0));
        $this->config->set('gptassistant_api_key', $this->request->variable('gptassistant_api_key', '', true));
        $this->config->set('gptassistant_model', $this->request->variable('gptassistant_model', 'gpt-4o-mini'));
        $this->config->set('gptassistant_user', $this->request->variable('gptassistant_user', 0));
        $this->config->set('gptassistant_temperature', $this->request->variable('gptassistant_temperature', 0.7));
        $this->config->set('gptassistant_max_tokens', $this->request->variable('gptassistant_max_tokens', 500));

        // Save activity settings
        $this->config->set('gptassistant_activity_enabled', $this->request->variable('gptassistant_activity_enabled', 0));
        $this->config->set('gptassistant_activity_frequency', $this->request->variable('gptassistant_activity_frequency', 7));
        $this->config->set('gptassistant_activity_limit', $this->request->variable('gptassistant_activity_limit', 10));

        // Save selected forums for activity settings
        $selected_forums = $this->request->variable('gptassistant_forums', []);
        $this->config->set('gptassistant_selected_forums', implode(',', $selected_forums));

        // Save activity tags setting
        $this->config->set('gptassistant_activity_enable_tags', $this->request->variable('gptassistant_activity_enable_tags', 0));
    }

    /**
     * Fetch all users for dropdown list.
     */
    protected function get_all_users()
    {
        $users = [];
        $sql = 'SELECT user_id, username FROM ' . USERS_TABLE . ' WHERE user_type <> 2 ORDER BY username ASC';
        $result = $this->db->sql_query($sql);

        while ($row = $this->db->sql_fetchrow($result)) {
            $users[$row['user_id']] = $row['username'];
        }

        $this->db->sql_freeresult($result);
        return $users;
    }

    /**
     * Fetch all forums for selection list.
     */
    protected function get_all_forums()
    {
        $forums = [];
        $sql = 'SELECT forum_id, forum_name FROM ' . FORUMS_TABLE . ' WHERE forum_type = 1 ORDER BY forum_name ASC';
        $result = $this->db->sql_query($sql);

        while ($row = $this->db->sql_fetchrow($result)) {
            $forums[$row['forum_id']] = $row['forum_name'];
        }

        $this->db->sql_freeresult($result);
        return $forums;
    }

    /**
     * Set custom form action.
     */
    public function set_page_url($u_action)
    {
        $this->u_action = $u_action;
    }
}
