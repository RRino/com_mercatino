<?php
/**
 * Joomla! Content Management System
 *
 * @copyright  Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace J4xdemos\Component\Mymercatos\Site\Service;

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\Rules\RulesInterface;

/**
 * Rule to process URLs without a menu item
 *
 * @since  3.4
 */
class MymercatosNomenuRules implements RulesInterface
{
	/**
	 * Router this rule belongs to
	 *
	 * @var RouterView
	 * @since 3.4
	 */
	protected $router;

	/**
	 * Class constructor.
	 *
	 * @param   RouterView  $router  Router this rule belongs to
	 *
	 * @since   3.4
	 */
	public function __construct(RouterView $router)
	{
		$this->router = $router;
	}

	/**
	 * Dummymethod to fullfill the interface requirements
	 *
	 * @param   array  &$query  The query array to process
	 *
	 * @return  void
	 *
	 * @since   3.4
	 * @codeCoverageIgnore
	 */
	public function preprocess(&$query)
	{
		$test = 'Test';
	}

	/**
	 * Parse a menu-less URL
	 *
	 * @param   array  &$segments  The URL segments to parse
	 * @param   array  &$vars      The vars that result from the segments
	 *
	 * @return  void
	 *
	 * @since   3.4
	 */
	public function parse(&$segments, &$vars)
	{
		//with this url: http://localhost/j4x/my-mercatos/mymercato-n/mercato-title.html
		// segments: [[0] => mymercato-n, [1] => mercato-title]
		// vars: [[option] => com_mymercatos, [view] => mymercatos, [id] => 0]

		$vars['view'] = 'mymercato';
		$vars['id'] = substr($segments[0], strpos($segments[0], '-') + 1);
		array_shift($segments);
		array_shift($segments);
		return;
	}

	/**
	 * Build a menu-less URL
	 *
	 * @param   array  &$query     The vars that should be converted
	 * @param   array  &$segments  The URL segments to create
	 *
	 * @return  void
	 *
	 * @since   3.4
	 */
	public function build(&$query, &$segments)
	{
		// content of $query ($segments is empty or [[0] => mymercato-3])
		// when called by the menu: [[option] => com_mymercatos, [Itemid] => 126]
		// when called by the component: [[option] => com_mymercatos, [view] => mymercato, [id] => 1, [Itemid] => 126]
		// when called from a module: [[option] => com_mymercatos, [view] => mymercatos, [format] => html, [Itemid] => 126]
		// when called from breadcrumbs: [[option] => com_mymercatos, [view] => mymercatos, [Itemid] => 126]

		// the url should look like this: /site-root/mymercatos/mercato-n/mercato-title.html

		// if the view is not mymercato - the single mercato view
		if (!isset($query['view']) || (isset($query['view']) && $query['view'] !== 'mymercato') || isset($query['format']))
		{
			return;
		}
		$segments[] = $query['view'] . '-' . $query['id'];
		$segments[] = $query['slug'];
		unset($query['view']);
		unset($query['id']);
		unset($query['slug']);
	}
}

