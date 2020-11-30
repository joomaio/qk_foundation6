<?php defined( '_JEXEC' ) or die( 'Restricted access' );

//use Jaio\UI\foundation6;

$document = JFactory::getDocument();
$app  = JFactory::getApplication();

/**
 * Foundation6 implement
 */

$css     = ['motion-ui.min', 'foundation-prototype.min', 'foundation-icons'];
$js      = ['motion-ui.min'];
$plugins = ['core', 'util','abide','accordion','accordionMenu','drilldown',
		'dropdown','dropdownMenu','equalizer','interchange','smoothScroll',
		'magellan','offcanvas','orbit','responsiveMenu','responsiveToggle',
		'reveal','slider','sticky','tabs','toggler','responsiveAccordionTabs'
	];

foreach($css as $vendor){
	JHtml::_('stylesheet', "tpl_foundation6/$vendor.css", array('version' => 'auto', 'relative' => true));
}
foreach($js as $vendor){
	JHtml::_('script', "tpl_foundation6/$vendor.js", array('version' => 'auto', 'relative' => true));
}
foreach($plugins as $vendor){
	JHtml::_('script', "tpl_foundation6/plugins/foundation.$vendor.js", array('version' => 'auto', 'relative' => true));
}

// JHtml::_('css', ['foundation-icons']);
// JHtml::_('css', ['foundation', 'motion-ui', 'foundation-prototype'], true);
// JHtml::_('js', [
// 	] // ,'tooltip'
// );

$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');
$structure = $this->params->get('selectstructure');

$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');

$menuactive = $app->getMenu()->getActive();
$input = $app->input;

//language
$lang = JFactory::getLanguage();
$lang->load('tpl_foundation6', JPATH_SITE, '', true);

// Output as HTML5
$this->setHtml5(true);

// Getting params from template
$tplparams = $app->getTemplate(true)->params;

// Logo file or site title param
if ($tplparams->get('logoFile'))
{
	$logo = '<img src="' . $this->baseurl . $tplparams->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($tplparams->get('sitename'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $tplparams->get('sitename') . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml" 
	xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<jdoc:include type="head" />
		<?php 
			$document->addStyleSheet($this->baseurl.'/templates/system/css/system.css');
			$document->addStyleSheet($this->baseurl.'/templates/' . $this->template . '/css/template.css'); 
		?>
		<!-- Compressed CSS -->
		<link href="<?php echo $this->baseurl.'/media/tpl_foundation6/css/foundation.min.css'; ?>" rel="stylesheet" />
		<!-- Compressed JavaScript -->
		<script src="<?php echo $this->baseurl.'/media/tpl_foundation6/js/foundation.min.js'; ?>"></script>
	</head>
	<body class="site <?php echo $option
		. ' view-' . $view
		. ($layout ? ' layout-' . $layout : ' no-layout')
		. ($task ? ' task-' . $task : ' no-task')
		. ($itemid ? ' itemid-' . $itemid : '')
		. ($this->direction === 'rtl' ? ' rtl' : '');
	?>">

		<?php
			switch($structure)
			{
				case 0:
					// load template style default
					require_once (JPATH_ROOT.'/templates/'.$app->getTemplate().'/structure/default.php');
					break;
				case 1:
					// load template style Left sidebar
					require_once (JPATH_ROOT.'/templates/'.$app->getTemplate().'/structure/manual.php');
					break;
				case 2:
					// load template style Multiple columns
					require_once (JPATH_ROOT.'/templates/'.$app->getTemplate().'/structure/multiple-columns.php');
					break;
				default:
					// load template style default
					require_once (JPATH_ROOT.'/templates/'.$app->getTemplate().'/structure/default.php');
					break;
			}
		?>

		<?php
			/**
			 * Add footer script
			 */
			//foundation6::addJsInline("jQuery(document).foundation();");
			//foundation6::generateJavascript();
		?>
		<script>
			jQuery(document).foundation();
		</script>

	</body>
</html>