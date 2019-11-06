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
        echo head_css();
    ?>

    <!-- JavaScripts -->
    <?php
        queue_js_file(array('globals'));
        queue_js_url('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js');
        echo head_js();
    ?>

        <!-- Matomo -->
    <script type="text/javascript">
      var _paq = _paq || [];
      /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u="//upenndigitalscholarship.org/piwik/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', '45']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
      })();
    </script>
    <!-- End Matomo Code -->

</head>

<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass.' ab-body')); ?>

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
                    <?php if (get_theme_option('Help Link')): ?>
                        <a href="<?php echo url(get_theme_option('Help Link')); ?>"><button type="button" class="btn btn-info btn-sm ab-header-button">Help</button></a>
                    <?php endif; ?>
                    <?php if(current_user()): ?>
                        <a href="<?php echo url('users/logout'); ?>"><button type="button" class="btn btn-secondary btn-sm ab-header-button">Logoff</button></a>
                    <?php else: ?>
                        <a href="<?php echo url('users/login'); ?>"><button type="button" class="btn btn-secondary btn-sm ab-header-button">Login</button></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="container-fluid ab-header-tabs">
            <div class="row">
                <div class="col-sm-12">
                    <?php echo public_nav_main()->setUlClass('ab-nav'); ?>
                </div>
            </div>
        </div>
    </header>
