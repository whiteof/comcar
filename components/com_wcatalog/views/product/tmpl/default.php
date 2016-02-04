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
<?php
	function resize($source_image, $destination, $tn_w, $tn_h, $quality = 100, $wmsource = false)
	{
		$info = getimagesize($source_image);
		$imgtype = image_type_to_mime_type($info[2]);
		#assuming the mime type is correct
		switch ($imgtype) {
			case 'image/jpeg':
				$source = imagecreatefromjpeg($source_image);
				break;
			case 'image/gif':
				$source = imagecreatefromgif($source_image);
				break;
			case 'image/png':
				$source = imagecreatefrompng($source_image);
				break;
			default:
				die('Invalid image type.');
		}
	
		#Figure out the dimensions of the image and the dimensions of the desired thumbnail
		$src_w = imagesx($source);
		$src_h = imagesy($source);
	
	
		#Do some math to figure out which way we'll need to crop the image
		#to get it proportional to the new size, then crop or adjust as needed
	
		$x_ratio = $tn_w / $src_w;
		$y_ratio = $tn_h / $src_h;
	
		if (($src_w <= $tn_w) && ($src_h <= $tn_h)) {
			$new_w = $src_w;
			$new_h = $src_h;
		} elseif (($x_ratio * $src_h) < $tn_h) {
			$new_h = ceil($x_ratio * $src_h);
			$new_w = $tn_w;
		} else {
			$new_w = ceil($y_ratio * $src_w);
			$new_h = $tn_h;
		}
	
		$newpic = imagecreatetruecolor(round($new_w), round($new_h));
		imagecopyresampled($newpic, $source, 0, 0, 0, 0, $new_w, $new_h, $src_w, $src_h);
		$final = imagecreatetruecolor($tn_w, $tn_h);
		$backgroundColor = imagecolorallocate($final, 255, 255, 255);
		imagefill($final, 0, 0, $backgroundColor);
		//imagecopyresampled($final, $newpic, 0, 0, ($x_mid - ($tn_w / 2)), ($y_mid - ($tn_h / 2)), $tn_w, $tn_h, $tn_w, $tn_h);
		imagecopy($final, $newpic, (($tn_w - $new_w)/ 2), (($tn_h - $new_h) / 2), 0, 0, $new_w, $new_h);
	
		#if we need to add a watermark
		if ($wmsource) {
			#find out what type of image the watermark is
			$info    = getimagesize($wmsource);
			$imgtype = image_type_to_mime_type($info[2]);
	
			#assuming the mime type is correct
			switch ($imgtype) {
				case 'image/jpeg':
					$watermark = imagecreatefromjpeg($wmsource);
					break;
				case 'image/gif':
					$watermark = imagecreatefromgif($wmsource);
					break;
				case 'image/png':
					$watermark = imagecreatefrompng($wmsource);
					break;
				default:
					die('Invalid watermark type.');
			}
	
			#if we're adding a watermark, figure out the size of the watermark
			#and then place the watermark image on the bottom right of the image
			$wm_w = imagesx($watermark);
			$wm_h = imagesy($watermark);
			imagecopy($final, $watermark, $tn_w - $wm_w, $tn_h - $wm_h, 0, 0, $tn_w, $tn_h);
	
		}
		if (imagejpeg($final, $destination, $quality)) {
			return true;
		}
		return false;
	}

?>
<div class="wcatalog">
	<ol class="breadcrumb">
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$this->item->parent_id); ?>">
				<?php echo $this->item->category ?>
			</a>
		</li>
		<li>
			<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$this->item->category_id); ?>">
				<?php echo $this->item->subcategory ?>
			</a>
		</li>
		<li class="active"><?php echo $this->item->title ?></li>
	</ol>
	<div class="product-details">
		<div class="row">
			<div class="col-sm-5">
				<div class="product-details-image">
					<div class="bar">
						<?php 
							$path = JPATH_BASE.'/images/wcatalog/products_'.$this->item->parent_id.'/'.$this->item->image;
							$out_path = JPATH_BASE.'/cache/wcatalog/images/';
							$out_url = JURI::base().'/cache/wcatalog/images/';
							if(file_exists($path)){
								if(!file_exists($out_path.$this->item->id.'_out.jpg')) resize($path, $out_path.$this->item->id.'_out.jpg', 500, 500);
								$img_url = $out_url.$this->item->id.'_out.jpg';
							} else $img_url = JURI::base().'images/wcatalog/no_image.jpg';
						?>						
						<img class="img-responsive" src="<?php echo $img_url ?>" />
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
					<div class="product-details-shortdesc">
						 <p>
							<strong><?php echo $this->item->make ?></strong><br />
							<?php echo $this->item->model ?>
						</p>
						<p>
							Год выпуска: <?php echo $this->item->year ?>
						</p>
					</div>
					<p>&nbsp;</p>
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
													<img class="img-responsive" src="<?php echo $img_url ?>" />
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