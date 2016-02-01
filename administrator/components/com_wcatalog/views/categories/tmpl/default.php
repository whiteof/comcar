<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_wcatalog
 *
 * @copyright   Copyright (C) 2012 - 2013 WhiteOf, Corp. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the component HTML helpers.
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$app		= JFactory::getApplication();
$user		= JFactory::getUser();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$archived	= $this->state->get('filter.published') == 2 ? true : false;
$trashed	= $this->state->get('filter.published') == -2 ? true : false;
$canOrder	= $user->authorise('core.edit.state', 'com_wcatalog.category');
$saveOrder	= $listOrder == 'a.ordering';
if ($saveOrder)
{
	$saveOrderingUrl = 'index.php?option=com_wcatalog&task=categories.saveOrderAjax&tmpl=component';
	JHtml::_('sortablelist.sortable', 'articleList', 'adminForm', strtolower($listDirn), $saveOrderingUrl);
}
$sortFields = $this->getSortFields();
$assoc		= isset($app->item_associations) ? $app->item_associations : 0;
?>
<script type="text/javascript">
	Joomla.orderTable = function()
	{
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		if (order != '<?php echo $listOrder; ?>')
		{
			dirn = 'asc';
		}
		else
		{
			dirn = direction.options[direction.selectedIndex].value;
		}
		Joomla.tableOrdering(order, dirn, '');
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_wcatalog&view=categories'); ?>" method="post" name="adminForm" id="adminForm">
<?php if (!empty( $this->sidebar)) : ?>
	<div id="j-sidebar-container" class="span2">
		<?php echo $this->sidebar; ?>
	</div>
	<div id="j-main-container" class="span10">
<?php else : ?>
	<div id="j-main-container">
<?php endif;?>

		<div class="clearfix"> </div>
		<table class="table table-striped" id="articleList">
			<thead>
				<tr>
					<th width="1%" class="hidden-phone">
						<input type="checkbox" name="checkall-toggle" value="" title="<?php echo JText::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
					</th>
					<th width="5%" class="nowrap center">
						<?php echo JText::_('JSTATUS'); ?>
					</th>
					<th class="title">
						<?php echo JText::_('JGLOBAL_TITLE'); ?>
					</th>
					<th class="nowrap hidden-phone">
						<?php echo JText::_('COM_WCATALOG_DESCRIPTION'); ?>
					</th>
					<th class="nowrap hidden-phone">
						<?php echo JText::_('COM_WCATALOG_PARENT'); ?>
					</th>
					<th class="nowrap hidden-phone">
						<?php echo JText::_('COM_WCATALOG_ORDER'); ?>
					</th>					
					<th class="nowrap hidden-phone">
						<?php echo JText::_('COM_WCATALOG_CREATED'); ?>
					</th>						
				</tr>
			</thead>
			<tbody>
			<?php foreach ($this->items as $i => $item) :
				$ordering   = ($listOrder == 'a.ordering');
				$canCreate  = true;
				$canEdit    = true;
				$canCheckin = true;
				$canChange  = true;
				?>
				<tr class="row<?php echo $i % 2; ?>" sortable-group-id="<?php echo $item->catid?>">
					<td class="center hidden-phone">
						<?php echo JHtml::_('grid.id', $i, $item->id); ?>
					</td>
					<td class="center">
						<?php echo JHtml::_('jgrid.published', $item->published, $i, 'categories.', $canChange, 'cb'); ?>
					</td>
					<td class="nowrap has-context">
						<div class="pull-left" style="padding-left: <?php echo $item->level*10?>px;">
							<span style="color: #ccc;"><?php for($l = 1; $l < $item->level; $l++) echo ' - ';?></span>
							<?php if ($canEdit) : ?>
								<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&task=category.edit&id='.(int) $item->id); ?>">
									<?php echo $this->escape($item->title); ?></a>
							<?php else : ?>
									<?php echo $this->escape($item->title); ?>
							<?php endif; ?>

						</div>
						<div class="pull-left">
							<?php
								// Create dropdown items
								JHtml::_('dropdown.edit', $item->id, 'category.');
								JHtml::_('dropdown.divider');
								if ($item->published) :
									JHtml::_('dropdown.unpublish', 'cb' . $i, 'categories.');
								else :
									JHtml::_('dropdown.publish', 'cb' . $i, 'categories.');
								endif;

								JHtml::_('dropdown.divider');

								if ($archived) :
									JHtml::_('dropdown.unarchive', 'cb' . $i, 'categories.');
								else :
									JHtml::_('dropdown.archive', 'cb' . $i, 'categories.');
								endif;

								if ($trashed) :
									JHtml::_('dropdown.untrash', 'cb' . $i, 'categories.');
								else :
									JHtml::_('dropdown.trash', 'cb' . $i, 'categories.');
								endif;

								// render dropdown list
								echo JHtml::_('dropdown.render');
								?>
						</div>

					</td>
					<td class="hidden-phone">
						<?php echo $this->escape($item->description); ?>
					</td>
					<td class="hidden-phone">
						<?php if ($item->parent_title) echo $this->escape($item->parent_title); else echo "- Top Level -";?>
					</td>
					<td class="hidden-phone" style="padding-left: <?php echo $item->level*10?>px;">
						<span style="color: #ccc;"><?php for($l = 1; $l < $item->level; $l++) echo ' - ';?></span>
						<?php echo $item->ordering; ?>
					</td>						
					<td class="hidden-phone">
						<?php echo $this->escape($item->created); ?>
					</td>						
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<?php //Load the batch processing form. ?>
		<?php echo $this->loadTemplate('batch'); ?>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>
