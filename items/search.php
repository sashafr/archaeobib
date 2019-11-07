<?php
$pageTitle = __('Search Records');
echo head(array('title' => $pageTitle,
           'bodyclass' => 'items advanced-search'));
?>

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <p class="ab-index-title">
                <strong><?php echo $pageTitle; ?></strong>
            </p>
        </div>
    </div>

    <div class="row mt-4 mx-5">
        <div class="col-12">
            <?php if (!empty($_GET['element_filter'])): ?>
                <div class="card bg-light">
                    <div class="card-body">
                        <?php echo $this->partial('items/element.php'); ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-12">
                        <nav class="items-nav navigation secondary-nav">
                            <?php echo public_nav_items(); ?>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-light">
                            <div class="card-body">
                                <?php echo $this->partial('items/search-form.php',
                                    array('formAttributes' =>
                                        array('id' => 'advanced-search-form'))); ?>
                            </div>
                        </div>
                    </div>                    
                </div>
            <?php endif; ?>

        </div>
    </div>

</div>



<?php echo foot(); ?>
