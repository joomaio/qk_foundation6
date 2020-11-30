<?php defined( '_JEXEC' ) or die( 'Restricted access' );

//use Jaio\UI\foundation6;

$document = JFactory::getDocument();
$app  = JFactory::getApplication();

$templatePath = JPATH_ROOT.'/templates/'.$app->getTemplate();
JHtml::addIncludePath($templatePath.'/jhtml');

/**
 * Foundation6 implement
 */

$css = ['foundation', 'motion-ui', 'foundation-prototype', 'foundation-icons'];
$js  = ['core', 'util','abide','accordion','accordionMenu','drilldown',
		'dropdown','dropdownMenu','equalizer','interchange','smoothScroll',
		'magellan','offcanvas','orbit','responsiveMenu','responsiveToggle',
		'reveal','slider','sticky','tabs','toggler','responsiveAccordionTabs'
	];

foreach($css as $vendor){
	JHtml::_('stylesheet', "tpl_foundation6/$vendor.css", array('version' => 'auto', 'relative' => true));
}
foreach($js as $vendor){
	JHtml::_('script', "tpl_foundation6/plugin/foundation.$vendor.js", array('version' => 'auto', 'relative' => true));
}
//foundation6::generateAssetLinks();

$document = JFactory::getDocument();
$config = JFactory::getConfig();
$app    = JFactory::getApplication();

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" 
	xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <jdoc:include type="head"/>
        
        <?php 
			$document->addStyleSheet('templates/system/css/system.css');
			$document->addStyleSheet('templates/system/css/general.css');
			$document->addStyleSheet('templates/' . $this->template . '/css/template.css'); 
        ?>
		<!-- Compressed CSS -->
		<link href="<?php echo $this->baseurl.'/media/tpl_foundation6/css/foundation.min.css'; ?>" rel="stylesheet" />
		<!-- Compressed JavaScript -->
		<script src="<?php echo $this->baseurl.'/media/tpl_foundation6/js/foundation.min.js'; ?>"></script>
    </head>

	<body>
		<jdoc:include type="message" />
		<jdoc:include type="component" />
	</body>
</html>
