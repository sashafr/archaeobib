<?php
    $pageTitle = html_escape(get_option('poster_page_title'). ': Help');
    echo head(array('title' => $pageTitle));
?>

<div id="poster-help" class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <p class="ab-index-title">
                <strong><?php echo $pageTitle; ?></strong>
            </p>

            <?php echo __(get_option('poster_help')); ?>
        </div>
    </div>
</div>

<?php echo foot(); ?>
