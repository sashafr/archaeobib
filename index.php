<?php echo head(); ?>

<div class="container-fluid">

    <div class="row justify-content-between align-items-center">
        <div class="col-sm-3">
            <img class="ab-header-image" src="<?php echo WEB_ROOT . '/files/theme_uploads/' . get_theme_option('Banner Image'); ?>" />
        </div>
        <div class="col-sm-6" id="ab-title-header">
            <h2 id="site-title">Welcome to the <?php echo option('site_title'); ?></h2>
            <?php if (get_theme_option('Guest Index')): ?>
                <div id="ab-index-welcome">
                    <?php echo get_theme_option('Guest Index'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if(!current_user()): ?>

        <div class="ab-row row justify-content-between">
                <div class="col-sm-4">
                    <?php if (get_theme_option('Home Img 1')): ?>
                        <img class="rounded-circle" src="<?php echo WEB_ROOT . '/files/theme_uploads/' . get_theme_option('Home Img 1'); ?>" />
                    <?php endif; ?>
                    <a href="<?php echo url('users/login'); ?>"><h3>Login</h3></a>
                    <p>
                        For registered users.
                    </p>
                </div>
            <div class="col-sm-4">
                <?php if (get_theme_option('Home Img 2')): ?>
                    <img class="rounded-circle" src="<?php echo WEB_ROOT . '/files/theme_uploads/' . get_theme_option('Home Img 2'); ?>" />
                <?php endif; ?>
                <a href="<?php echo url('guest-user/user/register'); ?>"><h3>Register</h3></a>
                <p>
                    Full functionality is only available to registered users.
                </p>
            </div>
            <div class="col-sm-4">
                <?php if (get_theme_option('Home Img 3')): ?>
                    <img class="rounded-circle" src="<?php echo WEB_ROOT . '/files/theme_uploads/' . get_theme_option('Home Img 3'); ?>" />
                <?php endif; ?>
                <a href="<?php echo url('items/search'); ?>"><h3>Search as Guest</h3></a>
                <p>
                    Limited functionality
                </p>
            </div>
        </div>

    <?php else: ?>

        <div class="row">
            <div class="col-sm-12">
                <p class="ab-index-title">&nbsp;</p>
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="col-sm-6">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="ab-index-subtitle"><strong>Advanced Search</strong></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php echo $this->partial('items/search-form.php', array('formAttributes' => array('id' => 'advanced-search-form', 'class' => 'ab-advanced-search-form'))); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (get_theme_option('Asearch Text')): ?>
                <div class="col-sm-6 ab-mobile-hide">
                    <?php echo get_theme_option('Asearch Text'); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <p class="ab-index-title">&nbsp;</p>
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="col-sm-6">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="ab-index-subtitle"><strong>Lookup</strong></p>
                            <p><a href="<?php echo url('items/browse?added_since='.date("Ymd", strtotime("-1 week"))); ?>">Entered within the Past Week</a>
                            <br />
                            <a href="<?php echo url('items/browse?added_since='.date("Ymd", strtotime("-1 month"))); ?>">Entered within the Past Month</a>
                            <br />
                            <a href="<?php echo url('items/browse?added_since='.date("Ymd", strtotime("-1 year"))); ?>">Entered within the Past Year</a></p>
                            <p><a href="<?php echo url('items/search?element_filter=date'); ?>">Years (All)</a>
                            <br />
                            <a href="<?php echo url('items/search?element_filter=publisher'); ?>">Publishers (All)</a>
                            <br />
                            <a href="<?php echo url('items/search?element_filter=type'); ?>">Reference Types (All)</a>
                            <br />
                            <a href="<?php echo url('items/browse'); ?>">All Records</a></p>
                            <?php if ($user = current_user()): ?>
                                <p>
                                    <?php set_loop_records('collections', get_records('Collection')); ?>
                                    <?php foreach (loop('collections') as $collection): ?>
                                        <a href="<?php echo url('items/browse?collection='.$collection->id); ?>"><?php echo metadata('collection', 'display_title'); ?></a>
                                    <?php endforeach ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (get_theme_option('Lookup Text')): ?>
                <div class="col-sm-6 ab-mobile-hide">
                    <div class="container">
                        <div class="row ab-lookup-text">
                            <div class="col-sm-12">
                                <?php echo get_theme_option('Lookup Text'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="ab-index-filters"><a href="<?php echo url('items/tags'); ?>">Keywords</a></p>
                                <p class="ab-index-filters">
                                    <?php foreach(range('A', 'Z') as $letter): ?>
                                        <a class="ab-index-letters" href="<?php echo url('items/tags?letter=' . $letter); ?>"><?php echo $letter; ?></a>
                                    <?php endforeach; ?>
                                </p>
                            </div>
                            <div class="col-sm-4">
                                <p class="ab-index-filters">
                                    <a href="<?php echo url('items/search?element_filter=' . get_theme_option('Filter1')); ?>">
                                        <?php
                                            if (get_theme_option('Filter1title') != "") {
                                                echo get_theme_option('Filter1title');
                                            } else {
                                                echo get_theme_option('Filter1');
                                            }
                                        ?>
                                    </a>
                                </p>
                                <p class="ab-index-filters">
                                    <?php foreach(range('A', 'Z') as $letter): ?>
                                        <a class="ab-index-letters" href="<?php echo url('items/search?element_filter=' . get_theme_option('Filter1') . '&letter=' . $letter); ?>"><?php echo $letter; ?></a>
                                    <?php endforeach; ?>
                                </p>
                            </div>
                            <div class="col-sm-4">
                                <p class="ab-index-filters">
                                    <a href="<?php echo url('items/search?element_filter=' . get_theme_option('Filter2')); ?>">
                                        <?php
                                            if (get_theme_option('Filter2title') != "") {
                                                echo get_theme_option('Filter2title');
                                            } else {
                                                echo get_theme_option('Filter2');
                                            }
                                        ?>
                                    </a>
                                </p>                                <p class="ab-index-filters">
                                    <?php foreach(range('A', 'Z') as $letter): ?>
                                        <a class="ab-index-letters" href="<?php echo url('items/search?element_filter=' . get_theme_option('Filter2') . '&letter=' . $letter); ?>"><?php echo $letter; ?></a>
                                    <?php endforeach; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<?php echo foot(); ?>
