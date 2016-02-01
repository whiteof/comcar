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
			<div class="banner">
				<img src="<?php echo $this->baseurl . '/images/slide01.jpg' ?>" id="banner-bg" />
				<div class="bar">
					<div class="bottom-bar">
						<div class="container">
							<div class="banner-menu">
								<h2>Комфорт и безопасность Вашего автомобиля!</h2>
								<div class="row">
									<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
										<div class="banner-menu-item">
											<a href="#">
												<div class="banner-menu-item-image-container">
													<img class="img-responsive" src="<?php echo $this->baseurl . '/images/menu/menu01.jpg' ?>" />
												</div>
												<p>Стальные защиты</p>
											</a>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
										<div class="banner-menu-item">
											<a href="#">
												<div class="banner-menu-item-image-container">
													<img class="img-responsive" src="<?php echo $this->baseurl . '/images/menu/menu02.jpg' ?>" />
												</div>
												<p>Алюминиевые защиты</p>
											</a>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
										<div class="banner-menu-item">
											<a href="#">
												<div class="banner-menu-item-image-container">
													<img class="img-responsive" src="<?php echo $this->baseurl . '/images/menu/menu03.jpg' ?>" />
												</div>
												<p>Амортизаторы капота</p>
											</a>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
										<div class="banner-menu-item">
											<a href="#">
												<div class="banner-menu-item-image-container">
													<img class="img-responsive" src="<?php echo $this->baseurl . '/images/menu/menu04.jpg' ?>" />
												</div>
												<p>Навесное оборудование</p>
											</a>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
										<div class="banner-menu-item">
											<a href="#">
												<div class="banner-menu-item-image-container">
													<img class="img-responsive" src="<?php echo $this->baseurl . '/images/menu/menu06.jpg' ?>" />
												</div>
												<p>Порог-площадки</p>
											</a>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-4 col-xs-6">
										<div class="banner-menu-item">
											<a href="#">
												<div class="banner-menu-item-image-container">
													<img class="img-responsive" src="<?php echo $this->baseurl . '/images/menu/menu05.jpg' ?>" />
												</div>
												<p>Эксклюзив! 6мм алюминиевая зашита</p>
											</a>
										</div>
									</div>
									<div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
										<div class="banner-menu-item">
											<a href="#">
												<div class="banner-menu-item-image-container">
													<img class="img-responsive" src="<?php echo $this->baseurl . '/images/menu/menu07.jpg' ?>" />
												</div>
												<p>Аксессуары для квадрациклов</p>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif ?>
		
		<?php if ($this->countModules('position-4')) : ?>
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
								Алььынётё витюпэраторебуз квюо эи, лудуз пожтэа адвыржаряюм вим эю, вокябюч дэниквюы янвыняры ут квуй. Аэтырно аккузата ючю но, мэя йн ыёюз майыжтатйж ныглэгэнтур. Прё ад ажжюм мэнтётюм, квюод конвынёры эа шэа.
							</p>
							<p align="right" class="delivery-bottom">
								<a href="">&rarr; узнать подробности</a>
							</a>
						</div>
						<div class="col-sm-2 col">
							<img class="img-responsive" src="<?php echo $this->baseurl . '/templates/' . $this->template . '/images/icon_assembly.png'?>" />
						</div>
						<div class="col-sm-4 col">
							<h4>Установка</h4>
							<p>
								Ыт еюж мэльёуз видырэр дёзсэнтёаш. Ут шэа квюод конжюль патриоквюы, нам ат конгуы путант зальутанде, ку партым оффэндйт зыд. Про ырант вёртюты молыжтйаы эю. Ед жюмо декат инзтруктеор пэр.
							</p>
							<p align="right">
								<a href="">&rarr; узнать подробности</a>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php endif ?>
		
		<?php if ($this->countModules('position-5')) : ?>
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
						<a href="">мы Вконтакте &rarr;</a>
					</a>
				</div>
			</div>
		<?php endif ?>
		
		<?php if ($this->countModules('position-6')) : ?>
			<div class="main-container">
				<div class="container">
					<div class="row row-offcanvas row-offcanvas-left">
						<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
							<div class="list-group">
								<div class="sidebar-menu">
									<jdoc:include type="modules" name="position-6" style="none" />
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-9">
							<div class="main-content">
								<p class="pull-left visible-xs">
									<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
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
		
		<div class="footer">
			<div class="container">
				<div class="row">
					<div class="col-sm-4 footer-left">
						<p><strong>ЧУП «Саня и Компания»</strong></p>
						<p>
							Республика Беларусь, 230000, Гродно<br />
							ул. Будакашалева, 11
						</p>
						<p>
							+375 29 231 77 14<br />
							+375 44 470 01 95
						</p>
						<p><a href="">info@comcar.by</a></p>
						<p>&copy; 2016, Все права защищены.</p>
					</div>
					<div class="col-sm-4 footer-middle">
						<jdoc:include type="modules" name="position-6" style="none" />
					</div>
					<div class="col-sm-4 footer-right">
						<p>
							<a href="">
								<img class="logo-bw" src="<?php echo $this->baseurl . '/templates/' . $this->template . '/images/logo_bw.png'?>" />
							</a>
						</p>
						<ul>							
							<li><a href="">Доставка и оплата</a></li>
							<li><a href="">Установка</a></li>
							<li><a href="">О компании</a></li>
						</ul>
						<p>&nbsp;</p>
						<p>
							<a href="" class="social-links">
								&rarr; мы Вконтакте
								<img src="<?php echo $this->baseurl . '/templates/' . $this->template . '/images/social_vk.png'?>" />
							</a>
						</p>
					</div>
				</div>
			
			
		</div>
		
		
		
		<!-- Body -->
		<?php /*
		<div class="body">
			<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
				<!-- Header -->
				<header class="header" role="banner">
					<div class="header-inner clearfix">
						<a class="brand pull-left" href="<?php echo $this->baseurl; ?>/">
							<?php echo $logo; ?>
							<?php if ($this->params->get('sitedescription')) : ?>
								<?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription')) . '</div>'; ?>
							<?php endif; ?>
						</a>
						<div class="header-search pull-right">
							<jdoc:include type="modules" name="position-0" style="none" />
						</div>
					</div>
				</header>
				<?php if ($this->countModules('position-1')) : ?>
					<nav class="navigation" role="navigation">
						<div class="navbar pull-left">
							<a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</a>
						</div>
						<div class="nav-collapse">
							<jdoc:include type="modules" name="position-1" style="none" />
						</div>
					</nav>
				<?php endif; ?>
				<jdoc:include type="modules" name="banner" style="xhtml" />
				<div class="row-fluid">
					<?php if ($this->countModules('position-8')) : ?>
						<!-- Begin Sidebar -->
						<div id="sidebar" class="span3">
							<div class="sidebar-nav">
								<jdoc:include type="modules" name="position-8" style="xhtml" />
							</div>
						</div>
						<!-- End Sidebar -->
					<?php endif; ?>
					<main id="content" role="main" class="<?php echo $span; ?>">
						<!-- Begin Content -->
						<jdoc:include type="modules" name="position-3" style="xhtml" />
						<jdoc:include type="message" />
						<jdoc:include type="component" />
						<jdoc:include type="modules" name="position-2" style="none" />
						<!-- End Content -->
					</main>
					<?php if ($this->countModules('position-7')) : ?>
						<div id="aside" class="span3">
							<!-- Begin Right Sidebar -->
							<jdoc:include type="modules" name="position-7" style="well" />
							<!-- End Right Sidebar -->
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<!-- Footer -->
		<footer class="footer" role="contentinfo">
			<div class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
				<hr />
				<jdoc:include type="modules" name="footer" style="none" />
				<p class="pull-right">
					<a href="#top" id="back-top">
						<?php echo JText::_('TPL_PROTOSTAR_BACKTOTOP'); ?>
					</a>
				</p>
				<p>
					&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>
				</p>
			</div>
		</footer>
		<jdoc:include type="modules" name="debug" style="none" />
		*/?>
	</body>
</html>
