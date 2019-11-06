<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')), 'bodyclass' => 'items show')); ?>

<div class="row mt-4 mx-5">
    <div class="col-12">

        <div class="card bg-light">

            <div class="card-body">

                <?php if ((get_theme_option('Item FileGallery') == 0) && metadata('item', 'has files')): ?>
                <?php echo files_for_item(array('imageSize' => 'fullsize')); ?>
                <?php endif; ?>

                <table class="table table-borderless ab-table">
                    <tbody>
                        <?php foreach (all_element_texts($item, array('return_type' => 'array')) as $elementset => $elements): ?>
                            <?php foreach ($elements as $element => $elementtexts): ?>
                                <tr>
                                    <th scope="row"><?php echo $element ?>:</td>
                                    <td>
                                        <?php foreach ($elementtexts as $elementtext): ?>
                                            <?php if ($element == "External Link"): ?>
                                                <?php echo '<a href="' . $elementtext . '">' . $elementtext . '</a>' ?>
                                            <?php else: ?>
                                                <?php echo '<a href="' . url('items/browse?search=&advanced%5B0%5D%5Bjoiner%5D=and&advanced%5B0%5D%5Belement_id%5D='. $elementtext->element_id . '&advanced%5B0%5D%5Btype%5D=is+exactly&advanced%5B0%5D%5Bterms%5D=' . $elementtext) . '">' . $elementtext . '</a>'; ?></br>
                                            <?php endif; ?>
                                        <?php endforeach ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- The following returns all of the files associated with an item. -->
                <?php if ((get_theme_option('Item FileGallery') == 1) && metadata('item', 'has files')): ?>
                <div id="itemfiles" class="element">
                    <h3><?php echo __('Files'); ?></h3>
                    <div class="element-text"><?php echo files_for_item(); ?></div>
                </div>
                <?php endif; ?>

                <!-- If the item belongs to a collection, the following creates a link to that collection. -->
                <?php if (metadata('item', 'Collection Name')): ?>
                <div id="collection" class="element">
                    <h3><?php echo __('Collection'); ?></h3>
                    <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
                </div>
                <?php endif; ?>

                <!-- The following prints a list of all tags associated with the item -->
                <?php if (metadata('item', 'has tags')): ?>
                <div id="item-tags" class="element">
                    <h3><?php echo __('Tags'); ?></h3>
                    <div class="element-text"><?php echo tag_string('item'); ?></div>
                </div>
                <?php endif;?>

                <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>

            </div>

        </div>

    </div>
</div>

<nav>
<ul class="item-pagination navigation">
    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
</ul>
</nav>

<?php echo foot(); ?>
