<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_wcatalog_banner
 *
 * @copyright   Copyright (C) 2012 - 2016 WhiteOf, Corp. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="banner">
	<img src="<?php echo JURI::base() . '/images/slide01.jpg' ?>" id="banner-bg" />
	<div class="bar">
		<div class="bottom-bar">
			<div class="container">
				<div class="banner-menu">
					<h2>Комфорт и безопасность Вашего автомобиля!</h2>
					<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
								<div class="banner-menu-item">
									<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$items[0]->id); ?>">
										<div class="banner-menu-item-image-container">
											<img class="img-responsive" src="<?php echo JURI::base() . '/images/menu/menu'.$items[0]->id.'.jpg' ?>" />
										</div>
										<p><?php echo $items[0]->title ?></p>
									</a>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
								<div class="banner-menu-item">
									<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$items[1]->id); ?>">
										<div class="banner-menu-item-image-container">
											<img class="img-responsive" src="<?php echo JURI::base() . '/images/menu/menu'.$items[1]->id.'.jpg' ?>" />
										</div>
										<p><?php echo $items[1]->title ?></p>
									</a>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
								<div class="banner-menu-item">
									<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$items[2]->id); ?>">
										<div class="banner-menu-item-image-container">
											<img class="img-responsive" src="<?php echo JURI::base() . '/images/menu/menu'.$items[2]->id.'.jpg' ?>" />
										</div>
										<p><?php echo $items[2]->title ?></p>
									</a>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
								<div class="banner-menu-item">
									<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$items[3]->id); ?>">
										<div class="banner-menu-item-image-container">
											<img class="img-responsive" src="<?php echo JURI::base() . '/images/menu/menu'.$items[3]->id.'.jpg' ?>" />
										</div>
										<p><?php echo $items[3]->title ?></p>
									</a>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
								<div class="banner-menu-item">
									<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$items[4]->id); ?>">
										<div class="banner-menu-item-image-container">
											<img class="img-responsive" src="<?php echo JURI::base() . '/images/menu/menu'.$items[4]->id.'.jpg' ?>" />
										</div>
										<p><?php echo $items[4]->title ?></p>
									</a>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-4 col-xs-6">
								<div class="banner-menu-item">
									<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$items[5]->id); ?>">
										<div class="banner-menu-item-image-container">
											<img class="img-responsive" src="<?php echo JURI::base() . '/images/menu/menu'.$items[5]->id.'.jpg' ?>" />
										</div>
										<p><?php echo $items[5]->title ?></p>
									</a>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
								<div class="banner-menu-item">
									<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$items[6]->id); ?>">
										<div class="banner-menu-item-image-container">
											<img class="img-responsive" src="<?php echo JURI::base() . '/images/menu/menu'.$items[6]->id.'.jpg' ?>" />
										</div>
										<p><?php echo $items[6]->title ?></p>
									</a>
								</div>
							</div>							
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
