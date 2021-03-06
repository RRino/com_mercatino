<?php
/**
 * @package     Mymercatos.Administrator
 * @subpackage  com_mymercatos
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use J4xdemos\Component\Mymercatos\Administrator\Helper\MymercatosHelper;

HTMLHelper::_('behavior.multiselect');
//HTMLHelper::_('behavior.tabstate');

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$states = array (
		'0' => Text::_('JUNPUBLISHED'),
		'1' => Text::_('JPUBLISHED'),
		'2' => Text::_('JARCHIVED'),
		'-2' => Text::_('JTRASHED')
);
$editIcon = '<span class="fa fa-pen-square me-2" aria-hidden="true"></span>';
$title = MymercatosHelper::getMercatoTitle($this->state->get('mercato_id'))->title;
$mercato_id = $this->state->get('mercato_id')
?>
<h3><?php echo Text::_('COM_MYMERCATOS_MYMERCATO_DATES_PAGE_TOP') . ' ' . $mercato_id . ': ' . $title; ?></h3>
<form action="<?php echo Route::_('index.php?option=com_mymercatos&view=mymercato_dates'); ?>" method="post" name="adminForm" id="adminForm">
	<div class="row">
		<div class="col-md-12">
			<div id="j-main-container" class="j-main-container">
				<?php echo LayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
				<?php if (empty($this->items)) : ?>
					<div class="alert alert-info">
						<span class="fa fa-info-circle" aria-hidden="true"></span><span class="sr-only"><?php echo Text::_('INFO'); ?></span>
						<?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
					</div>
				<?php else : ?>
					<table class="table" id="mymercatosList">
						<caption id="captionTable">
							<?php echo Text::_('COM_MYMERCATOS_MYMERCATO_DATES_TABLE_CAPTION'); ?>, <?php echo Text::_('JGLOBAL_SORTED_BY'); ?>
						</caption>
						<thead>
							<tr>
								<td style="width:1%" class="text-center">
									<?php echo HTMLHelper::_('grid.checkall'); ?>
								</td>
								<th scope="col" style="width:1%; min-width:85px" class="text-center">
									<?php echo HTMLHelper::_('searchtools.sort', 'JSTATUS', 'a.published', $listDirn, $listOrder); ?>
								</th>
								<th scope="col" style="width:10%;">
									<?php echo HTMLHelper::_('searchtools.sort', 'COM_MYMERCATOS_MYMERCATO_DATES_LABEL_VISIT_DATE', 'a.published', $listDirn, $listOrder); ?>
								</th>
								<th scope="col" style="width:50%;">
									<?php echo HTMLHelper::_('searchtools.sort', 'COM_MYMERCATOS_MYMERCATO_DATES_LABEL_WEATHER_REPORT', 'a.published', $listDirn, $listOrder); ?>
								</th>
								<th scope="col" style="width:5%" class="d-none d-md-table-cell">
									<?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
								</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$n = count($this->items);
						foreach ($this->items as $i => $item) :
							?>
							<tr class="row<?php echo $i % 2; ?>">
								<td class="text-center">
									<?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
								</td>
								<td>
									<?php echo $states[$item->state]; ?>
								</td>
								<td>
									<a href="index.php?option=com_mymercatos&task=mymercato_date.edit&id=<?php echo $item->id; ?>">
									<?php echo $editIcon; ?><?php echo $item->date; ?></a>
								</td>
								<td>
									<?php echo $item->weather; ?>
								</td>
								<td>
									<?php echo $item->id; ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>

					<?php // load the pagination. ?>
					<?php echo $this->pagination->getListFooter(); ?>

				<?php endif; ?>
				<input type="hidden" name="task" value="">
				<input type="hidden" name="boxchecked" value="0">
				<input type="hidden" name="mercato_id" value="<?php echo $mercato_id; ?>">
				<?php echo HTMLHelper::_('form.token'); ?>
			</div>
		</div>
	</div>
</form>

<a href="<?php echo Route::_('index.php?option=com_mymercatos'); ?>">Back to list of mercatos</a>
