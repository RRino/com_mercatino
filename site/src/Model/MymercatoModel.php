<?php
/**
 * @package     Mymercatos.Site
 * @subpackage  com_mymercatos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace J4xdemos\Component\Mymercatos\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Model\ItemModel;

/**
 * Mymercato Component Mymercato Model
 *
 * @since  1.5
 */
class MymercatoModel extends ItemModel
{
	/**
	 * Model context string.
	 *
	 * @var        string
	 */
	protected $_context = 'com_mymercatos.mymercato';

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @since   1.6
	 *
	 * @return void
	 */
	protected function populateState()
	{
		$app = Factory::getApplication();

		// Load state from the request.
		$pk = $app->input->getInt('id');
		$this->setState('mymercato.id', $pk);

		$offset = $app->input->getUInt('limitstart');
		$this->setState('list.offset', $offset);

		// Load the parameters.
		$params = $app->getParams();
		$this->setState('params', $params);
	}

	/**
	 * Method to get mercato data.
	 *
	 * @param   integer  $pk  The id of the mercato.
	 *
	 * @return  object|boolean  Menu item data object on success, boolean false
	 */
	public function getItem($pk = null)
	{
		$pk = (!empty($pk)) ? $pk : (int) $this->getState('mymercato.id');

			try
			{
				$db = $this->getDbo();
				$query = $db->getQuery(true)
					->select(
						$this->getState(
							'item.select', 'a.*'
						)
					);
				$query->from('#__mymercatos AS a')
					->where('a.id = ' . (int) $pk);

				$db->setQuery($query);

				$data = $db->loadObject();

				if (empty($data))
				{
					throw new \Exception(Text::_('COM_MYMERCATOS_ERROR_MERCATO_NOT_FOUND'), 404);
				}
			}
			catch (\Exception $e)
			{
				if ($e->getCode() == 404)
				{
					// Need to go through the error handler to allow Redirect to work.
					throw new \Exception($e->getMessage(), 404);
				}
				else
				{
					$this->setError($e);
					$this->_item[$pk] = false;
				}
			}

		return $data;
	}
	/**
	 * Method to get mercato visit data.
	 *
	 * @param   integer  $pk  The id of the mercato.
	 *
	 * @return  object|boolean  Menu item data object on success, boolean false
	 */
	public function getReports($pk = null)
	{
		$pk = (!empty($pk)) ? $pk : (int) $this->getState('mymercato.id');

		try
		{
			$db = $this->getDbo();
			$query = $db->getQuery(true)
			->select('b.*');
			$query->from('#__mymercato_dates AS b')
			->where('b.mercato_id = ' . (int) $pk);
			$query->order('`date` DESC');

			$db->setQuery($query);

			$data = $db->loadObjectList();

			// It is OK to have a mercato without visit data - handle it the view.
		}
		catch (\Exception $e)
		{
			if ($e->getCode() == 404)
			{
				// Need to go through the error handler to allow Redirect to work.
				throw new \Exception($e->getMessage(), 404);
			}
			else
			{
				$this->setError($e);
				$this->_item[$pk] = false;
			}
		}

		return $data;
	}
}
