<?php
/**
*
* @package Breizh Shoutbox Extension
* 
* @copyright (c) 2018-2020 Sylver35  https://breizhcode.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

namespace sylver35\breizhshoutbox\acp;

class main_module
{
	/** @var string */
	public $u_action;

	/** @var string */
	public $tpl_name;

	/** @var string */
	public $page_title;

	/**
	 * @param int		$id
	 * @param string	$mode
	 *
	 * @return void
	 * @access public
	 */
	public function main($id, $mode)
	{
		global $phpbb_container, $phpbb_root_path;

		/** @type \phpbb\language\language $language Language object */
		$language = $phpbb_container->get('language');
		/** @type \phpbb\template\template $template Template object */
		$template = $phpbb_container->get('template');
		/** @type \sylver35\breizhshoutbox\controller\admin_controller $admin_controller */
		$admin_controller = $phpbb_container->get('sylver35.breizhshoutbox.admin.controller');
		/** @type \sylver35\breizhshoutbox\core\shoutbox $shoutbox */
		$shoutbox = $phpbb_container->get('sylver35.breizhshoutbox.shoutbox');
		// Make the $u_action url available in the admin controller
		$admin_controller->set_page_url($this->u_action);

		$this->tpl_name = 'breizhshoutbox_body';
		$this->page_title = 'ACP_SHOUT_' . strtoupper($mode) . '_T';
		$img_src = $phpbb_root_path . 'ext/sylver35/breizhshoutbox/images/';
		$meta = $shoutbox->get_version();

		switch ($mode)
		{
			case 'configs':
				$admin_controller->acp_shoutbox_configs();
			break;

			case 'rules':
				$admin_controller->acp_shoutbox_rules();
			break;

			case 'overview':
				$admin_controller->acp_shoutbox_overview();
			break;

			case 'config_gen':
				$admin_controller->acp_shoutbox_config_gen();
			break;

			case 'private':
				$admin_controller->acp_shoutbox_private();
			break;

			case 'config_priv':
				$admin_controller->acp_shoutbox_config_priv();
			break;

			case 'popup':
				$admin_controller->acp_shoutbox_popup();
			break;

			case 'panel':
				$admin_controller->acp_shoutbox_panel();
			break;

			case 'smilies':
				$admin_controller->acp_shoutbox_smilies();
			break;

			case 'robot':
				$admin_controller->acp_shoutbox_robot();
			break;

			default:
				trigger_error('NO_MODE', E_USER_ERROR);
			break;
		}

		$template->assign_vars(array(
			'S_IN_SHOUTBOX'		=> true,
			'U_ACTION'			=> $this->u_action,
			'TITLE'				=> $language->lang($this->page_title),
			'TITLE_EXPLAIN'		=> $language->lang('ACP_SHOUT_' . strtoupper($mode) . '_T_EXPLAIN'),
			'SHOUTBOX_VERSION'	=> $language->lang('SHOUTBOX_VERSION_ACP_COPY', $meta['homepage'], $meta['version']),
			'IMAGE_TITLE'		=> $img_src . $mode . '.png',
			'IMAGE_SUBMIT'		=> $img_src . 'submit.png',
			'IMAGE_MESSAGES'	=> $img_src . 'messages.png',
			'IMAGE_SETTINGS'	=> $img_src . 'reglages.png',
			'IMAGE_PURGE'		=> $img_src . 'burn.png',
			'IMAGE_STATS'		=> $img_src . 'numbers.png',
			'IMAGE_ALERT'		=> $img_src . 'alert.png',
		));
	}
}
