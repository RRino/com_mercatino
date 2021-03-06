<?php
/**
 * @package     Mymercatos.Site
 * @subpackage  com_mymercatos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

//use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

?>
<div class="page-header">
	<h1><?php echo $this->item->title; ?></h1>
</div>

<p><?php echo $this->item->description; ?>!</p>

<h2><?php echo Text::_('COM_MYMERCATOS_MERCATO_REPORTS'); ?></h2>

<div class="table-responsive">
  <table class="table table-striped">
  <caption><?php echo Text::_('COM_MYMERCATOS_MERCATO_REPORTS'); ?></caption>
  <thead>
    <tr>
 		<th scope="col"><?php echo Text::_('COM_MYMERCATOS_MERCATO_DATE'); ?></th>
		<th scope="col"><?php echo Text::_('COM_MYMERCATOS_MERCATO_WEATHER'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($this->reports as $id => $report) : ?>
	<tr>
		<td><?php echo $report->date; ?></td>
		<td><?php echo $report->weather; ?></td>
	</tr>
	<?php endforeach; ?><?php //endif; ?>
	</tbody>
  </table>
</div>
