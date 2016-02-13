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
	<?php if($this->view['view'] == 'categories'): ?>
		<ol class="breadcrumb">
			<li class="active"><?php echo $this->view['items'][0]->category ?></li>
		</ol>
		<h2 class="wcatalog-subcategory-title">
			Выберите марку автомобиля
		</h2>
		<div class="row">
			<?php foreach($this->view['items'] as $item): ?>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<a class="wcatalog-category" href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$item->id); ?>">
						<div class="make">
							<div class="make-logo">
								<img src="<?php echo JURI::base().'images/wcatalog/logos/'.strtolower(str_replace(' ', '', $item->title)).'.png' ?>" />
							</div>
							<div class="make-title">
								<?php echo $item->title ?>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach ?>
		</div>
	<?php endif  ?>
	<?php if($this->view['view'] == 'products'): ?>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$this->view['items'][0]->parent_id); ?>">
					<?php echo $this->view['items'][0]->category ?>
				</a>
			</li>
			<li class="active"><?php echo $this->view['items'][0]->subcategory ?></li>
		</ol>
		<div class="row">
			<?php $out_path = JPATH_BASE.'/cache/wcatalog/images/';?>
			<?php $out_url = JURI::base().'/cache/wcatalog/images/';?>
			<?php foreach($this->view['items'] as $item): ?>
				<div class="col-lg-3 col-md-4 col-sm-6">
					<a class="wcatalog-product" href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=product&id='.$item->id); ?>">
						<div class="product">
							<div class="product-image">
								<div class="bar">
									<?php
										$path = JPATH_BASE.'/images/wcatalog/products_'.$item->parent_id.'/'.$item->image;
										if(file_exists($path)){
											if(!file_exists($out_path.$item->id.'_out.jpg')) resize($path, $out_path.$item->id.'_out.jpg', 500, 500);
											$img_url = $out_url.$item->id.'_out.jpg';
										} else $img_url = JURI::base().'images/wcatalog/no_image.jpg';
									?>
									<img class="img-responsive" src="<?php echo $img_url ?>" />
								</div>
							</div>
							<div class="product-info">
								<p><?php echo ucfirst(trim($item->title)) ?></p>
								<div class="price">
									<?php if(!empty($item->price)): ?>
										<?php echo number_format($item->price, 0, '.', ' '); ?> руб.
									<?php else: ?>
										Цена по запросу
									<?php endif ?>
								</div>
								<p class="price-desc">
									<strong><?php echo $item->make ?></strong><br />
									<?php echo $item->model ?><br />
									<?php echo $item->year ?>
								</p>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach ?>
		</div>
	<?php endif  ?>
	
	
	
	
	
	<?php /*
	<div class="w_menu">
		<?php foreach($this->menu as $id => $val):?>
			<?php $menu = $this->getMenuItem($id); ?>
			<?php if($menu->published == 1): ?>
				<div id="<?php echo $id ?>" class="w_level" style="padding-left: <?php echo $menu->level ?>0px;">
					<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$id); ?>"><?php echo $menu->title ?></a>
				</div>
			<?php endif ?>
		<?php endforeach ?>		
	</div>
	
	<div class="w_content">
		<?php $cat_arr = array();?>
		<?php $category = $this->getMenuItem($this->category_id);?>
		<?php for($l = $category->level; $l >= 1; $l--):?>
			<?php $cat_arr[] = $category;?>
			<?php if ($category->parent_id != 0) $category = $this->getMenuItem($category->parent_id);?>
		<?php endfor ?>
		
		<div class="w_content_info">
			<?php for($l = (count($cat_arr)-1); $l >= 0; $l--):?>
				<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$cat_arr[$l]->id); ?>">
					<?php echo $cat_arr[$l]->title;?>
				</a>
				<?php if($l != 0) echo ' -> '; ?>
			<?php endfor ?>
		</div>
		<?php $j = 1;?>
		<table width="100%">
		<tbody>
			<?php $cat_arr = array(); ?>
		<?php foreach($this->items as $i => $item):?>
			<?php $cat_arr[$item->category_id] = $this->getMenuItem($item->category_id)->title; ?>
			<?php if (($i >= (($this->page-1)*9))and($i < ($this->page*9))): ?>
				<?php if($j == 1): ?>
					<tr>
				<?php endif ?>
				<td valign="top">
					<div class="w_product">
						<div class="w_product_img">
							<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=product&id='.$item->id); ?>">
								<img src="<?php echo JURI::base().'images/wcatalog/category_1/111.00802.1.jpg' ?>" width="200px" height="200px" />
							</a>
						</div>
						<div class="w_product_title">
							<a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=product&id='.$item->id); ?>"><?php echo $item->title ?></a>
						</div>
					</div>
				</td>
				<?php if($j == 3): ?>
					</tr>
					<?php $j = 0;?>
				<?php endif ?>
				<?php $j++ ?>
			<?php endif ?>
		<?php endforeach ?>
		</tbody>
		</table>
	</div>
	<div style="clear: both;"></div>
	<?php if(count($this->items) > 9):?>
	<?php
		$last_page = (int)(count($this->items)/9);
		if((count($this->items)%9) > 0) $last_page++;
		$next_page = $this->page + 1;
		if($next_page > $last_page) $next_page = $last_page;
		$prev_page = $this->page - 1;
		if($prev_page == 0) $prev_page = 1;
	?>
		<div class="pager">
			<div class="pager_but"><a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$this->category_id.'&page=1'); ?>"><<</a></div>
			<div class="pager_but"><a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$this->category_id.'&page='.$prev_page); ?>"><</a></div>
			<?php for($s = 1; $s <= $last_page; $s++): ?>
			<?php if ($s == $this->page):?>
				<div class="pager_but"><?php echo $s ?></div>
			<?php else: ?>
				<div class="pager_but"><a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$this->category_id.'&page='.$s); ?>"><?php echo $s ?></a></div>
			<?php endif ?>
			<?php endfor ?>
			<div class="pager_but"><a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$this->category_id.'&page='.$next_page); ?>">></a></div>
			<div class="pager_but"><a href="<?php echo JRoute::_('index.php?option=com_wcatalog&view=category&id='.$this->category_id.'&page='.$last_page); ?>">>></a></div>		
		</div>
	<?php endif ?>
	*/?>
</div>