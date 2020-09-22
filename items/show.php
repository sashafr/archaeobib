<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')), 'bodyclass' => 'items show')); ?>

<?php if(current_user()): ?>
    <div class="row mt-4 mx-5 justify-content-end">
        <div class="col-md-2">
            <a href="<?php echo admin_url(); ?>"><button type="button" class="btn btn-info btn-sm ab-header-button">Edit</button></a>
        </div>
    </div>
<?php endif; ?>
<?php
    $elementRenames = array(
        "Description" => "Notes"
    );
    if ($item->getItemType()->name == 'Book (Edited)' || $item->getItemType()->name == 'Conference Proceeding') {
        $elementRenames["Creator"] = "Editors";
    } else {
        $elementRenames["Creator"] = "Authors";
    }
    $linkableElements = array(
        "Creator",
        "Date",
        "Editors",
        "Source",
        "Publisher",
        "Series Editor"
    );
?>

<div class="row mt-4 mx-5">
    <div class="col-12">

        <div class="card bg-light">

            <div class="card-body">

                <table class="table table-borderless ab-table">
                    <tbody>
                        <tr>
                            <th scope="row">
                                Ref ID:
                            </th>
                            <td>
                                <?php echo $item->id; ?>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Ref Type:
                            </th>
                            <td>
                                <?php echo link_to_items_browse($item->getItemType()->name, array('type' => $item->getItemType()->id)); ?>
                            </td>
                        </tr>
                        <?php foreach (all_element_texts($item, array('return_type' => 'array')) as $elementset => $elements): ?>
                            <?php foreach ($elements as $element => $elementtexts): ?>
                                <tr>
                                    <th scope="row"><?php if (array_key_exists($element, $elementRenames)): echo $elementRenames[$element]; else: echo $element; endif; ?>:</th>
                                    <td>
                                        <?php foreach ($elementtexts as $elementtext): ?>
                                            <?php if ($element == "External Link"): ?>
                                                <?php echo '<a href="' . $elementtext . '">' . $elementtext . '</a>' ?>
                                            <?php elseif (in_array($element, $linkableElements)): ?>
                                                <?php $elementLookup = get_record('Element', array('name' => $element)); ?>
                                                <?php echo '<a href="' . url('items/browse?search=&advanced%5B0%5D%5Bjoiner%5D=and&advanced%5B0%5D%5Belement_id%5D='. $elementLookup->id  . '&advanced%5B0%5D%5Btype%5D=is+exactly&advanced%5B0%5D%5Bterms%5D=' . $elementtext) . '">' . $elementtext . '</a>'; ?></br>
                                            <?php else: ?>
                                                <?php echo $elementtext; ?></br>
                                            <?php endif; ?>
                                        <?php endforeach ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- The following returns all of the files associated with an item. -->
                <div id="itemfiles" class="element ab-item-modules">
                    <div class="element-text"><?php echo files_for_item(); ?></div>
                </div>

                <!-- If the item belongs to a collection, the following creates a link to that collection. -->
                <?php if (metadata('item', 'Collection Name')): ?>
                <div id="collection" class="element ab-item-modules">
                    <h3><?php echo __('Collection'); ?></h3>
                    <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
                </div>
                <?php endif; ?>

                <!-- The following prints a list of all tags associated with the item -->
                <?php if (metadata('item', 'has tags')): ?>
                <div id="item-tags" class="element ab-item-modules">
                    <h3><?php echo __('Tags'); ?></h3>
                    <div class="element-text"><?php echo tag_string('item'); ?></div>
                </div>
                <?php endif;?>

                <div class="ab-item-modules">
                    <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>
                </div>

                <nav>
                <ul class="item-pagination navigation">
                    <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
                    <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
                </ul>
                </nav>


            </div>

        </div>

    </div>
</div>

<?php echo foot(); ?>
