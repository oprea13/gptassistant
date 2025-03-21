<?php

/**
 *
 * GPT Assistant Core Functionality.
 *
 * @copyright (c) 2025, Oprea Cristian, https://itandwebsolutions.ro
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace iws\gptassistant\core;

class assistant
{
    /** @var \phpbb\cache\service */
    protected $cache;

    /** @var \phpbb\db\driver\driver_interface */
    protected $db;

    /** @var \phpbb\config\config */
    protected $config;

    /** @var \phpbb\user */
    protected $user;

    /** @var \phpbb\language\language */
    protected $language;

    /** @var \phpbb\template\template */
    protected $template;

    /**
     * Constructor.
     *
     * @param \phpbb\cache\service $cache Cache object
     * @param \phpbb\db\driver\driver_interface $db Database object
     * @param \phpbb\config\config $config Config object
     * @param \phpbb\user $user User object
     * @param \phpbb\language\language $language Language object
     * @param \phpbb\template\template $template Template object
     */
    public function __construct(
        \phpbb\cache\service $cache,
        \phpbb\db\driver\driver_interface $db,
        \phpbb\config\config $config,
        \phpbb\user $user,
        \phpbb\language\language $language,
        \phpbb\template\template $template
    ) {
        $this->cache = $cache;
        $this->db = $db;
        $this->config = $config;
        $this->user = $user;
        $this->language = $language;
        $this->template = $template;
    }

    /**
     * Verifică dacă GPT Assistant este activat
     *
     * @return bool
     */
    public function is_active()
    {
        return (bool) $this->config['gptassistant_active'];
    }

    /**
     * Obține cheia API OpenAI din configurare
     *
     * @return string
     */
    public function get_api_key()
    {
        return trim($this->config['gptassistant_api_key']);
    }
}
