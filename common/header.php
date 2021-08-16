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
        queue_css_file(array('style', 'fontawesome.min'));
        queue_css_url("https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css");
        queue_css_url("https://fonts.googleapis.com/css?family=Montserrat:300,300italic,400,400italic,700,700italic,900,900italic|Roboto+Slab:300,300italic,400,400italic,700,700italic,900,900italic|Open+Sans:300,300italic,400,400italic,700,700italic,900,900italic|Lato:300,300italic,400,400italic,700,700italic,900,900italic&amp;subset=latin,latin-ext");
        echo head_css();
    ?>

    <!-- JavaScripts -->
    <?php
        queue_js_file(array('globals'));
        queue_js_url('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js');
        queue_js_url('https://cdn.jsdelivr.net/npm/citation-js');
        echo head_js();
    ?>

</head>

<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass.' ab-body')); ?>

    <a href="#content" id="skipnav"><?php echo __('Skip to main content'); ?></a>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>

    <header class="ab-header sticky-top container-fluid">
        <div class="ab-header-logo">
            <div class="row">
                <div class="col-sm-3">
                    <?php echo link_to_home_page(theme_logo()); ?>
                </div>
                <div class="col-sm-9">
                    <nav id="top-nav" role="navigation">
                        <?php if(!current_user()): ?>
                          <ul class="ab-nav">
                            <li><a href="<?php echo url('users/login'); ?>">Login</a></li>
                          </ul>
                        <?php endif; ?>
                        <?php echo public_nav_main()->setUlClass('ab-nav'); ?>
                    </nav>
                </div>
            </div>
        </div>
    </header>
