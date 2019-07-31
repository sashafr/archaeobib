<?php
$pageTitle = __('Browse Records');
echo head(array('title' => $pageTitle, 'bodyclass' => 'items browse'));

$sortLinks[__('Title')] = 'Dublin Core,Title';
$sortLinks[__('Authors')] = 'Dublin Core,Creator';
$sortLinks[__('Year')] = 'Dublin Core,Date';
$sortLinks[__('ID')] = 'id';
?>

<div class="container-fluid">
    <?php if (get_theme_option('Items Browse Text')): ?>
        <div>
            <?php echo get_theme_option('Items Browse Text'); ?>
        </div>
        <hr />
    <? endif; ?>
    <div class="row justify-content-between">
        <div class="col-md-3">
            <?php echo pagination_links(); ?>
        </div>
        <div class="col-md-9">
            <div class="row justify-content-end no-gutters">
              <div class="col-md-auto">
                <span class="sort-label"><?php echo __('Sort by: '); ?></span>
              </div>
              <div class="col-md-auto">
                  <?php echo browse_sort_links($sortLinks); ?>
              </div>
            </div>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Type</th>
                    <th scope="col">Mark</th>
                    <th scope="col">Year</th>
                    <th scope="col">Authors</th>
                    <th scope="col">Title</th>
                    <th scope="col">Source</th>
                    <th scope="col">Temp Cit</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (loop('items') as $item): ?>
                    <tr>
                        <th></th>
                        <th></th>
                        <th><?php echo metadata('item', array('Dublin Core', 'Date')); ?></th>
                        <th><?php echo metadata('item', array('Dublin Core', 'Creator')); ?></th>
                        <th><?php echo metadata('item', array('Dublin Core', 'Title')); ?></th>
                        <th>
                            <?php echo metadata('item', array('Dublin Core', 'Source')); ?>
                            <?php if (element_exists('Item Type Metadata', 'Book Title')): ?>
                                <p><?php echo metadata('item', array('Item Type Metadata', 'Book Title')); ?></p>
                            <?php endif; ?>
                            <?php if (element_exists('Item Type Metadata', 'Journal Title')): ?>
                                <p><?php echo metadata('item', array('Item Type Metadata', 'Journal Title')); ?></p>
                            <?php endif; ?>
                        </th>
                        <th></th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
