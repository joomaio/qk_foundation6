<div class="main-wrapper">
    <div class="title-bar" data-responsive-toggle="top-bar-menu" data-hide-for="large">
        <div class="flex-container">
            <div class="small-title">
                <button class="menu-icon" type="button" data-toggle></button>
                <div class="title-bar-title"><?php echo JText::_('TPL_FOUNDATION6_MENU'); ?></div>
            </div>
            <div class="small-search">
                <jdoc:include type="modules" name="search"/>
            </div>
        </div>
    </div>

    <div class="top-bar" id="top-bar-menu" data-animate="hinge-in-from-top hinge-out-from-top">
        <div class="top-bar-left">
            <div class="menu-text float-left"><a href="<?php echo JUri::base(); ?>"><?php echo $logo; ?></a></div>
            <jdoc:include type="modules" name="menu1"/>
        </div>
        <div class="top-bar-right">
            <jdoc:include type="modules" name="search"/>
        </div>
    </div>

    <?php if (isset($menuactive)) : ?>
        <?php if ($menuactive->params->get('show_page_heading')) : ?>
            <div class="callout large primary main-banner">
                <div class="text-center">
                    <h1 itemprop="headline">
                        <?php 
                            echo $menuactive->params->get('page_heading').$this->getTitle(); 
                        ?>
                    </h1>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if($this->countModules("banner")): ?>
        <jdoc:include type="modules" name="banner"/>
    <?php endif; ?>

    <?php if($this->countModules("position-1")): ?>
        <jdoc:include type="modules" name="position-1"/>
    <?php endif; ?>

    <?php if($this->countModules("position-2")): ?>
        <div class="row">
            <jdoc:include type="modules" name="position-2"/>
        </div>
    <?php endif; ?>

    <?php if($this->countModules("position-3")): ?>
        <jdoc:include type="modules" name="position-3"/>
    <?php endif; ?>

    <!-- Main content -->
    <div class="main-content" id="content">
        <?php if($this->countModules("top")):?>
            <jdoc:include type="modules" name="top"/>
        <?php endif; ?>

        <div class="row columns"><jdoc:include type="message" /></div>
        <jdoc:include type="component"/>
        
        <?php if($this->countModules("bottom")):?>
            <jdoc:include type="modules" name="bottom"/>
        <?php endif; ?>
    </div>
    <!-- /Main content -->

    <?php if($this->countModules("position-0")): ?>
        <jdoc:include type="modules" name="position-0"/>
    <?php endif; ?>

    <?php if($this->countModules("position-7")): ?>
        <div class="row">
            <jdoc:include type="modules" name="position-7"/>
        </div>
    <?php endif; ?>
    <?php if($this->countModules("position-8") || $this->countModules("position-9") || $this->countModules("position-10")): ?>		
        <div class="callout large secondary">
            <div class="row">
                <div class="large-4 columns">					
                    <jdoc:include type="modules" name="position-8"/>
                </div>
                <div class="large-3 large-offset-2 columns">
                    <jdoc:include type="modules" name="position-9"/>
                </div>
                <div class="large-3 columns">
                    <jdoc:include type="modules" name="position-10"/>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<footer>
    <div class="row expanded">
        <div class="medium-6 columns">
            <ul class="menu">
                <jdoc:include type="modules" name="menu2"/>
            </ul>
        </div>
        <div class="medium-6 columns">
            <ul class="menu align-right">
                <li class="menu-text">&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?></li>
            </ul>
        </div>
    </div>
</footer>  