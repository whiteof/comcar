<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.comcar
 *
 * @copyright   Copyright (C) 2005 - 2015 WhiteOf, Corp. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

JText::script('TPL_COMCAR_ALTOPEN');
JText::script('TPL_COMCAR_ALTCLOSE');
JText::script('TPL_COMCAR_TEXTRIGHTOPEN');
JText::script('TPL_COMCAR_TEXTRIGHTCLOSE');
JText::script('TPL_COMCAR_FONTSIZE');
JText::script('TPL_COMCAR_BIGGER');
JText::script('TPL_COMCAR_RESET');
JText::script('TPL_COMCAR_SMALLER');
JText::script('TPL_COMCAR_INCREASE_SIZE');
JText::script('TPL_COMCAR_REVERT_STYLES_TO_DEFAULT');
JText::script('TPL_COMCAR_DECREASE_SIZE');
JText::script('TPL_COMCAR_OPENMENU');
JText::script('TPL_COMCAR_CLOSEMENU');
?>

<script type="text/javascript">
	var big = '<?php echo (int) $this->params->get('wrapperLarge');?>%';
	var small = '<?php echo (int) $this->params->get('wrapperSmall'); ?>%';
	var bildauf = '<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/plus.png';
	var bildzu = '<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/images/minus.png';
	var rightopen='<?php echo JText::_('TPL_COMCAR_TEXTRIGHTOPEN', true); ?>';
	var rightclose='<?php echo JText::_('TPL_COMCAR_TEXTRIGHTCLOSE', true); ?>';
	var altopen='<?php echo JText::_('TPL_COMCAR_ALTOPEN', true); ?>';
	var altclose='<?php echo JText::_('TPL_COMCAR_ALTCLOSE', true); ?>';
</script>
