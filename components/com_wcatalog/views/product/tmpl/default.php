<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_newsfeeds
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.caption');
?>
<div class="wcatalog">
	<div class="product-details">
		<div class="row">
			<div class="col-sm-5">
				<div class="product-details-image">
					<div class="bar">
						<img class="img-responsive" src="<?php echo JURI::base().'images/wcatalog/products_'.$this->item->parent_id.'/'.$this->item->image ?>" />
					</div>
				</div>
			</div>
			<div class="col-sm-7">
				<div class="product-details-content">
					<div class="product-details-title">
						<?php echo $this->item->title ?>
					</div>
					<div class="product-details-price">
						 Цена: <?php echo $this->item->price ?> руб.
					</div>
					<div class="product-details-buy">
						<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#buy-form">Заказать</button>
					</div>
					<!-- Modal -->
					<div class="modal fade" id="buy-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title buy-form-title" id="myModalLabel"><?php echo $this->item->title ?></h4>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-sm-5">
											<div class="product-details-model-image">
												<div class="bar">
													<img class="img-responsive" src="<?php echo JURI::base().'images/wcatalog/products_'.$this->item->parent_id.'/'.$this->item->image ?>" />
												</div>
											</div>
											<div class="product-details-price">
												 Цена: <?php echo $this->item->price ?> руб.
											</div>
										</div>
										<div class="col-sm-7">
											<div class="submit-initial">
												<form>
													<div class="form-group">
														<label for="full_name">Введите ваше имя</label>
														<input type="text" class="form-control" placeholder="Ф.И.О." name="full_name" id="full_name" />
													</div>
													<div class="form-group">
														<label for="phone">Телефон</label>
														<input type="text" class="form-control" placeholder="Телефон" name="phone" id="phone" />
													</div>
													<div class="form-group">
														<label for="email">Адрес электронной почты</label>
														<input type="email" class="form-control" placeholder="Email" name="email" id="email" />
													</div>
												</form>
											</div>
											<div class="submit-loading">
												<p class="submit-message">Обработка заказа...</p>
											</div>
											<div class="submit-result">
												<p class="submit-message bg-success">Ваш заказ принят! Мы свяжемся с Вами в ближайшее время по указанному Вами номеру телефона.</p>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<div class="submit-initial">
										<button type="button" class="btn btn-success send-request">
											Отправить заказ
										</button>
									</div>
									<div class="submit-result">
										<button type="button" class="btn btn-default" data-dismiss="modal">
											Закрыть
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Modal:end -->
				</div>
			</div>
		</div>
		<div class="product-details-description">
			<h4>Описание товара</h4>
			<?php echo $this->item->description ?>
		</div>
	</div>
	<div style="clear: both;"></div>
</div>