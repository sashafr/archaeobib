<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ( $description = option('description')): ?>
        <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>
    <?php 
        if (isset($title)) {
            $titleParts[] = strip_formatting($title);
        }
        $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>
    
    <?php echo auto_discovery_link_tags(); ?>
    
    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>
    
    <!-- Stylesheets -->
    <?php
        queue_css_file(array('style'));
        queue_css_url("https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css");
        echo head_css();
    ?>
    
    <!-- JavaScripts -->
    <?php 
        queue_js_file(array('globals'));
        queue_js_url('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js');
        echo head_js(); 
    ?>
    
</head>

<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>

    <a href="#content" id="skipnav"><?php echo __('Skip to main content'); ?></a>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
    
    <header>
        <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
        <div class="container-fluid">
            <div class="row" id="ab-title-header">
                <div class="col-sm-10">
                    <div id="site-title"><?php echo link_to_home_page(option('site_title')); ?></div>
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-secondary btn-sm ab-header-button">Logoff</button>
                </div>
            </div>
        </div>
    </header>