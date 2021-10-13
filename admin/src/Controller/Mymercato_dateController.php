<?php
/**
 * @package     Mymercatos.Administrator
 * @subpackage  com_mymercatos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace J4xdemos\Component\Mymercatos\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;

/**
 * Controller for a single mymercato
 *
 * @since  1.6
 */
class Mymercato_dateController extends FormController
{
	public function cancel($key = null) {
		$this->setRedirect('index.php?option=com_mymercatos&view=mymercato_dates');
	}
}
