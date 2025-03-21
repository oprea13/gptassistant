<?php
/**
 *
 * GPT Assistant. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2025, Oprea Cristian, https://itandwebsolutions.ro
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace iws\gptassistant\acp;

/**
 * GPT Assistant ACP module info.
 */
class main_info
{
	public function module()
	{
		return [
			'filename'	=> '\iws\gptassistant\acp\main_module',
			'title'		=> 'ACP_GPTASSISTANT_TITLE',
			'modes'		=> [
				'settings'	=> [
					'title'	=> 'ACP_GPTASSISTANT',
					'auth'	=> 'ext_iws/gptassistant && acl_a_board',
					'cat'	=> ['ACP_GPTASSISTANT_TITLE'],
				],
			],
		];
	}
}
