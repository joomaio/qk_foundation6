<?php defined('_JEXEC') or die;

use Jaio\UI\foundation6;

$app  = JFactory::getApplication();
$user = JFactory::getUser();

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$format   = $app->input->getCmd('format', 'html');
$sitename = htmlspecialchars($app->get('sitename'), ENT_QUOTES, 'UTF-8');

if ($task === 'edit' || $layout === 'form')
{
	$fullWidth = 1;
}
else
{
	$fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('script', "tpl_foundation6/plugin/foundation.core.js", array('version' => 'auto', 'relative' => true));

// Logo file or site title param
if ($params->get('logoFile'))
{
	$logo = '<img src="' . JUri::root() . $params->get('logoFile') . '" alt="' . $sitename . '" />';
}
elseif ($params->get('sitetitle'))
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($params->get('sitetitle')) . '</span>';
}
else
{
	$logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta charset="utf-8" />
	<title><?php echo $this->title; ?> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php // Use of Google Font ?>
	<?php if ($params->get('googleFont')) : ?>
		<link href="https://fonts.googleapis.com/css?family=<?php echo $params->get('googleFontName'); ?>" rel="stylesheet" />
		<style>
			h1, h2, h3, h4, h5, h6, .site-title {
				font-family: '<?php echo str_replace('+', ' ', $params->get('googleFontName')); ?>', sans-serif;
			}
		</style>
	<?php endif; ?>
	<link href="<?php echo $this->baseurl.'/media/tpl_foundation6/css/foundation-icons.css'; ?>" rel="stylesheet" />
	<link href="<?php echo $this->baseurl.'/media/tpl_foundation6/css/motion-ui.min.css'; ?>" rel="stylesheet" />
	<link href="<?php echo $this->baseurl.'/media/tpl_foundation6/css/foundation.min.css'; ?>" rel="stylesheet" />
	<link href="<?php echo $this->baseurl.'/media/tpl_foundation6/css/foundation-prototype.min.css'; ?>" rel="stylesheet" />
	<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/error.css" rel="stylesheet" />
	
	<link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
	<script src="<?php echo $this->baseurl.'/media/tpl_foundation6/js/jquery.js'; ?>"></script>
	<script src="<?php echo $this->baseurl.'/media/tpl_foundation6/js/foundation.min.js'; ?>"></script>
	<script src="<?php echo $this->baseurl.'/media/tpl_foundation6/js/motion-ui.min.js'; ?>"></script>
	<!--[if lt IE 9]><script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script><![endif]-->
</head>
<body class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '')
	. ($params->get('fluidContainer') ? ' fluid' : '')
	. ($this->direction === 'rtl' ? ' rtl' : '');
?>">
<!-- Header -->
<div class="title-bar" data-responsive-toggle="top-bar-menu" data-hide-for="large">
	<div class="flex-container">
		<div class="small-title">
			<button class="menu-icon" type="button" data-toggle></button>
			<div class="title-bar-title"><a href="<?php echo JUri::base(); ?>"><?php echo $logo; ?></a></div>
		</div>
	</div>
</div>
<div class="top-bar" id="top-bar-menu" data-animate="hinge-in-from-top hinge-out-from-top">
	<div class="top-bar-left">
		<div class="menu-text float-left"><a href="<?php echo JUri::base(); ?>"><?php echo $logo; ?></a></div>
	</div>
	<div class="top-bar-right">
		<?php if (JModuleHelper::getModules('search')) : ?>
			<?php
				$modules = JModuleHelper::getModules( 'search' );
				$attribs['style'] = 'none';
				foreach ($modules AS $module ) {
					echo JModuleHelper::renderModule( $module, $attribs );
				}
			?>
		<?php endif; ?>
	</div>
</div>
<!-- Main content -->
<div class="error-content" id="error-content">
	<div class="row columns large-8">			
		<h1 class="margin-vertical-1"><?php echo JText::_('JERROR_LAYOUT_PAGE_NOT_FOUND'); ?></h1>
		<div class="callout secondary">
			<div class="row">
				<div class="columns medium-6">
					<p><strong><?php echo JText::_('JERROR_LAYOUT_ERROR_HAS_OCCURRED_WHILE_PROCESSING_YOUR_REQUEST'); ?></strong></p>
					<p class="margin-bottom-0"><?php echo JText::_('JERROR_LAYOUT_NOT_ABLE_TO_VISIT'); ?></p>
					<ul class="padding-left-1">
						<li><?php echo JText::_('JERROR_LAYOUT_AN_OUT_OF_DATE_BOOKMARK_FAVOURITE'); ?></li>
						<li><?php echo JText::_('JERROR_LAYOUT_MIS_TYPED_ADDRESS'); ?></li>
						<li><?php echo JText::_('JERROR_LAYOUT_SEARCH_ENGINE_OUT_OF_DATE_LISTING'); ?></li>
						<li><?php echo JText::_('JERROR_LAYOUT_YOU_HAVE_NO_ACCESS_TO_THIS_PAGE'); ?></li>
					</ul>
				</div>
				<div class="columns medium-6">
					<label class="margin-top-1"><?php echo JText::_('JERROR_LAYOUT_GO_TO_THE_HOME_PAGE'); ?></label>
					<p><a href="<?php echo $this->baseurl; ?>/index.php" class="btn btn-primary"><i class="fi-home" aria-hidden="true"></i> <?php echo JText::_('JERROR_LAYOUT_HOME_PAGE'); ?></a></p>
				</div>
			</div>
			<hr />
			<div class="row">
				<div class="columns">
					<p class="margin-bottom-0"><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?></p>
					<blockquote>
						<span class="badge badge-danger"><?php echo $this->error->getCode(); ?></span> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8');?>
						<?php if ($this->debug) : ?>
							<br/><?php echo htmlspecialchars($this->error->getFile(), ENT_QUOTES, 'UTF-8');?>:<?php echo $this->error->getLine(); ?>
						<?php endif; ?>
					</blockquote>
					<?php if ($this->debug) : ?>
						<div class="margin-top-4">
							<?php echo $this->renderBacktrace(); ?>
							<?php // Check if there are more Exceptions and render their data as well ?>
							<?php if ($this->error->getPrevious()) : ?>
								<?php $loop = true; ?>
								<?php // Reference $this->_error here and in the loop as setError() assigns errors to this property and we need this for the backtrace to work correctly ?>
								<?php // Make the first assignment to setError() outside the loop so the loop does not skip Exceptions ?>
								<?php $this->setError($this->_error->getPrevious()); ?>
								<?php while ($loop === true) : ?>
									<p><strong><?php echo JText::_('JERROR_LAYOUT_PREVIOUS_ERROR'); ?></strong></p>
									<p>
										<?php echo htmlspecialchars($this->_error->getMessage(), ENT_QUOTES, 'UTF-8'); ?>
										<br/><?php echo htmlspecialchars($this->_error->getFile(), ENT_QUOTES, 'UTF-8');?>:<?php echo $this->_error->getLine(); ?>
									</p>
									<?php echo $this->renderBacktrace(); ?>
									<?php $loop = $this->setError($this->_error->getPrevious()); ?>
								<?php endwhile; ?>
								<?php // Reset the main error object to the base error ?>
								<?php $this->setError($this->error); ?>
							<?php endif; ?>
						</div>
					<?php endif; ?>		
				</div>
			</div>	
		</div>
	</div>
</div>

<!-- Footer -->
<footer>
    <div class="row expanded">
        <div class="medium-6 columns">
            <ul class="menu">
				<?php if (JModuleHelper::getModules('menu2')) : ?>
					<?php
						$modules = JModuleHelper::getModules( 'menu2' );
						$attribs['style'] = 'none';
						foreach ($modules AS $module ) {
							echo JModuleHelper::renderModule( $module, $attribs );
						}
					?>
				<?php endif; ?>
            </ul>
        </div>
        <div class="medium-6 columns">
            <ul class="menu align-right">
                <li class="menu-text">&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?></li>
            </ul>
        </div>
    </div>
</footer>  
<script>jQuery(document).foundation();</script>
</body>
</html>
