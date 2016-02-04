<?php
	/**
	 * @package     Joomla.Site
	 * @subpackage  Templates.protostar
	 *
	 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
	 * @license     GNU General Public License version 2 or later; see LICENSE.txt
	 */
	
	defined('_JEXEC') or die;
	
	$app             = JFactory::getApplication();
	$doc             = JFactory::getDocument();
	$user            = JFactory::getUser();
	$this->language  = $doc->language;
	$this->direction = $doc->direction;
	
	// Getting params from template
	$params = $app->getTemplate(true)->params;
	
	// Detecting Active Variables
	$option   = $app->input->getCmd('option', '');
	$view     = $app->input->getCmd('view', '');
	$layout   = $app->input->getCmd('layout', '');
	$task     = $app->input->getCmd('task', '');
	$itemid   = $app->input->getCmd('Itemid', '');
	$sitename = $app->get('sitename');
	
	if($task == "edit" || $layout == "form" )
	{
		$fullWidth = 1;
	}
	else
	{
		$fullWidth = 0;
	}
	
	// Add JavaScript Frameworks
	$doc->addScript($this->baseurl . '/templates/' . $this->template . '/bootstrap-3.3.5/js/bootstrap.min.js');
	$doc->addScript($this->baseurl . '/templates/' . $this->template . '/javascript/offcanvas.js');
	$doc->addScript($this->baseurl . '/templates/' . $this->template . '/javascript/banner.js');
	$doc->addScript($this->baseurl . '/templates/' . $this->template . '/javascript/modal.js');
	$doc->addScript($this->baseurl . '/templates/' . $this->template . '/javascript/template.js');
	
	// Add Stylesheets
	$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/bootstrap-3.3.5/css/bootstrap.min.css');
	$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/offcanvas.css');
	$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/banner.css');
	$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template.css');
	
	// Load optional RTL Bootstrap CSS
	JHtml::_('bootstrap.loadCss', false, $this->direction);
	
	// Adjusting content width
	if ($this->countModules('position-7') && $this->countModules('position-8'))
	{
		$span = "span6";
	}
	elseif ($this->countModules('position-7') && !$this->countModules('position-8'))
	{
		$span = "span9";
	}
	elseif (!$this->countModules('position-7') && $this->countModules('position-8'))
	{
		$span = "span9";
	}
	else
	{
		$span = "span12";
	}
	
	// Logo file or site title param
	if ($this->params->get('logoFile'))
	{
		$logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
	}
	elseif ($this->params->get('sitetitle'))
	{
		$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle')) . '</span>';
	}
	else
	{
		$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
	}
	?>
	<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<jdoc:include type="head" />
		<!--[if lt IE 9]>
			<script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
		<![endif]-->
	</head>
	
	<body>
		<div class="header">
			<div class="container">
				<!-- Static navbar -->
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<div class="contacts" id="contacts-right">
								<img src="<?php echo $this->baseurl . '/templates/' . $this->template . '/images/icon-contact.png' ?>" width="30px" height="30px"/>&nbsp;+375&nbsp;29&nbsp;231&nbsp;77&nbsp;14					
							</div>
							<a class="navbar-brand logo" href="<?php echo $this->baseurl; ?>/">
								<img class="img-responsive" src="<?php echo $this->baseurl . '/templates/' . $this->template . '/images/logo.png' ?>">
							</a>
							<div class="contacts" id="contacts-middle">
								<img src="<?php echo $this->baseurl . '/templates/' . $this->template . '/images/icon-contact.png' ?>" width="30px" height="30px"/>&nbsp;+375&nbsp;29&nbsp;231&nbsp;77&nbsp;14					
							</div>
							
						</div>				
						<div class="contacts" id="contacts-top">
							<img src="<?php echo $this->baseurl . '/templates/' . $this->template . '/images/icon-contact.png' ?>" width="30px" height="30px"/>&nbsp;+375&nbsp;29&nbsp;231&nbsp;77&nbsp;14					
						</div>
						<div id="navbar" class="navbar-collapse collapse">
							<!-- Top Menu -->
							<?php if ($this->countModules('position-1')) : ?>
								<jdoc:include type="modules" name="position-1" style="none" />
							<?php endif; ?>
						</div><!--/.nav-collapse -->
						<div class="contacts" id="contacts-bottom">
							<img src="<?php echo $this->baseurl . '/templates/' . $this->template . '/images/icon-contact.png' ?>" width="30px" height="30px"/>&nbsp;+375&nbsp;29&nbsp;231&nbsp;77&nbsp;14					
						</div>
					</div><!--/.container-fluid -->
				</nav>
			</div> <!-- /container -->
		</div>
		
		<?php if ($this->countModules('position-3')) : ?>
			<jdoc:include type="modules" name="position-3" style="none" />
		<?php endif ?>
		
		<?php if ($this->countModules('position-3')) : ?>
			<div class="info">
				<div class="container">
					<h3>Мы будем рады Вам помочь сделать Ваш автомобиль <strong>безопасным!</strong></h3>
					<div class="row">
						<div class="col-sm-2 col">
							<img class="img-responsive" src="<?php echo $this->baseurl . '/templates/' . $this->template . '/images/icon_delivery.png'?>" />
						</div>
						<div class="col-sm-4 col">
							<h4>Доставка и оплата</h4>
							<p>
								Мы осуществляем бесплатную доставку по г. Гродно до двери. Оплата наличными.
							</p>
							<p>
								Платная доставка по Республике Беларусь, партнером является компания Globel24...
							</p>
							<p align="right" class="delivery-bottom">
								<a href="<?php echo JRoute::_('index.php/shipping'); ?>">&rarr; узнать подробности</a>
							</a>
						</div>
						<div class="col-sm-2 col">
							<img class="img-responsive" src="<?php echo $this->baseurl . '/templates/' . $this->template . '/images/icon_assembly.png'?>" />
						</div>
						<div class="col-sm-4 col">
							<h4>Установка</h4>
							<p>
								В нашем установочном центре Вас ждут следующие виды услуг:
							</p>
							<ul>
								<li>предварительная мойка двигателя паром;</li>
								<li>подбор и установка необходимого оборудования.</li>
							</ul>
							<p align="right">
								<a href="<?php echo JRoute::_('index.php/assembling'); ?>">&rarr; узнать подробности</a>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php endif ?>
		
		<?php if ($this->countModules('position-3')) : ?>
			<div class="about">
				<div class="container">
					<div class="about-img">
						<img class="img-responsive" src="<?php echo $this->baseurl . '/templates/' . $this->template . '/images/about_img.png'?>" />
					</div>
					<div class="about-img-clear"></div>
					<h3>Компания <strong>COMCAR</strong></h3>
					<h4>Мы специализируемся на оптово-розничных продажах дополнительного оборудования для автомобилей и квадроциклов.</h4>
					<p class="logos">
						<img src="<?php echo $this->baseurl . '/templates/' . $this->template . '/images/shadow-line.png'?>" /><br />
						<img width="370px" src="<?php echo $this->baseurl . '/templates/' . $this->template . '/images/logos.png'?>" />
					</p>
					<p align="right">
						<br />
						<a href="http://vk.com/comcar_bel" target="_blank">мы Вконтакте &rarr;</a>
					</a>
				</div>
			</div>
		<?php endif ?>
		
		<?php if ($this->countModules('position-6')) : ?>
			<?php 
				$app = JFactory::getApplication();
				$input = $app ->input;
				$componentName = $input ->get('option');
			?>
			<?php if($componentName != 'com_wcatalog'): ?>
				<div class="main-container">
					<div class="container">
						<p class="visible-xs">
							<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">&rarr; Каталог</button>
						</p>						
						<div class="row row-offcanvas row-offcanvas-left">
							<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
								<div class="list-group">
									<div class="sidebar-menu">
										<div class="side-bar-title">Каталог продукции</div>
										<jdoc:include type="modules" name="position-6" style="none" />
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-9">
								<div class="main-content">
									<main id="content" role="main" class="<?php echo $span; ?>">
										<!-- Begin Content -->
										<jdoc:include type="message" />
										<jdoc:include type="component" />
										<!-- End Content -->
									</main>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php else: ?>
				<div class="main-container">
					<div class="container">
						<div class="row row-offcanvas row-offcanvas-left">
							<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
								<div class="list-group">
									<div class="sidebar-menu">
										<div class="side-bar-title">Каталог продукции</div>
										<jdoc:include type="modules" name="position-6" style="none" />
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-9">
								<div class="wcatalog-content">
									<p class="visible-xs wcatalog-sidebar-button">
										<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">&rarr; Каталог</button>
									</p>						
									<main id="content" role="main" class="<?php echo $span; ?>">
										<!-- Begin Content -->
										<jdoc:include type="message" />
										<jdoc:include type="component" />
										<!-- End Content -->
									</main>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif ?>
		<?php endif ?>
		
		<div class="footer">
			<div class="container">
				<div class="row">
					<div class="col-sm-4 footer-left">
						<p><strong>Шоу-рум и установочный центр:</strong></p>
						<p>г. Гродно, ул. Дзержинского, 23</p>
						<p>
							+375 29 231 77 14<br />
							+375 44 470 01 95
						</p>
						<p><a href="mailto:info@comcar.by">info@comcar.by</a></p>
						<p>&copy; 2016, Все права защищены.</p>
					</div>
					<div class="col-sm-4 footer-middle">
						<?php if ($this->countModules('position-8')) : ?>
							<jdoc:include type="modules" name="position-8" style="none" />
						<?php endif ?>
					</div>
					<div class="col-sm-4 footer-right">
						<p>
							<a href="">
								<img class="logo-bw" src="<?php echo $this->baseurl . '/templates/' . $this->template . '/images/logo_bw.png'?>" />
							</a>
						</p>
						<?php if ($this->countModules('position-9')) : ?>
							<jdoc:include type="modules" name="position-9" style="none" />
						<?php endif; ?>
						<p>&nbsp;</p>
						<p>
							<a href="http://vk.com/comcar_bel" class="social-links" target="_blank">
								&rarr; мы Вконтакте
								<img src="<?php echo $this->baseurl . '/templates/' . $this->template . '/images/social_vk.png'?>" />
							</a>
						</p>
					</div>
				</div>
			
			
		</div>
	</body>
</html>
