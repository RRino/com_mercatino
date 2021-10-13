<?php
/**
 * @package     Mymercatos.Administrator
 * @subpackage  com_mymercatos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace J4xdemos\Component\Mymercatos\Administrator\Helper;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

/**
 * Mymercatos component helper.
 *
 * @since  4.0
 */
class MymercatosHelper
{
	public static function getMercatoTitle($id)
	{
		if (empty($id))
		{
			// throw an error or ...
			return false;
		}
		$db = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select('title');
		$query->from('#__mymercatos');
		$query->where('id = ' . $id);
		$db->setQuery($query);
		return $db->loadObject();
	}
}