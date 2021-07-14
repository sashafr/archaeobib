<?php
if (!empty($formActionUri)):
    $formAttributes['action'] = $formActionUri;
else:
    $formAttributes['action'] = url(array('controller' => 'items',
                                          'action' => 'browse'));
endif;
$formAttributes['method'] = 'GET';

// adjusting field drop down to show the alternate names for fields
$renamed_fields = array(
        'Creator' => 'Authors',
        'Description' => 'Notes'
);
$ab_fields = get_table_options('Element', null, array(
    'record_types' => array('Item', 'All'),
    'sort' => 'orderBySet')
);
// $field_count = count($ab_fields);
foreach ($ab_fields as $key => $val) {
    // if (in_array($ab_fields[$i], $hidden_fields)) {
    //     unset($ab_fields[$i]);
    // }
    if (array_key_exists($val, $renamed_fields)) {
        $ab_fields[$key] = $renamed_fields[$val];
    }
}
?>

<form <?php echo tag_attributes($formAttributes); ?>>
    <div id="search-keywords" class="ab-index-hide">
        <?php echo $this->formLabel('keyword-search', __('Search for Keywords')); ?>
        <div class="inputs">
        <?php
            echo $this->formText(
                'search',
                @$_REQUEST['search'],
                array('id' => 'keyword-search', 'size' => '40')
            );
        ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div id="search-narrow-by-fields" class="field">
                <label><?php echo __('Narrow by Specific Fields'); ?></label>
                <div class="inputs">
                <?php
                // If the form has been submitted, retain the number of search
                // fields used and rebuild the form
                if (!empty($_GET['advanced'])) {
                    $search = $_GET['advanced'];
                } else {
                    $search = array(array('field' => '', 'type' => '', 'value' => ''));
                }

                //Here is where we actually build the search form
                foreach ($search as $i => $rows): ?>
                    <div class="search-entry">
                        <?php
                        //The POST looks like =>
                        // advanced[0] =>
                        //[field] = 'description'
                        //[type] = 'contains'
                        //[terms] = 'foobar'
                        //etc
                        echo $this->formSelect(
                            "advanced[$i][joiner]",
                            @$rows['joiner'],
                            array(
                                'title' => __("Search Joiner"),
                                'id' => null,
                                'class' => 'advanced-search-joiner'
                            ),
                            array(
                                'and' => __('AND'),
                                'or' => __('OR'),
                            )
                        );
                        if (is_current_url(url('/')) and get_theme_option('Asearch Fields') != "") {
                        	// $bibElementSet= get_record('ElementSet',array('name'=>"Item Type Metadata"));
                        	$asearch_fields = get_theme_option('Asearch Fields');
                        	$fields_array = array_map('trim', explode(',', $asearch_fields));
                        	$db = get_db();
                        	$bibElements=array();
                        	foreach ($fields_array as $afield){
                            $bibElementSet = $db->getTable('Element')->fetchObjects("SELECT * FROM {$db->prefix}elements e WHERE e.name = '{$afield}'");
                            foreach($bibElementSet as $element) {
                                if ($ab_fields[$element->id]){
                                    $bibElements[$element->id]=$ab_fields[$element->id];
                                } else {
                                    $bibElements[$element->id]=$element->name;
                                }
                            }
                        	}
                          echo $this->formSelect(
                              "advanced[$i][element_id]",
                              @$rows['element_id'],
                              array(
                                  'title' => __("Search Field"),
                                  'id' => null,
                                  'class' => 'advanced-search-element'
                              ),
                              $bibElements
                          );
                        } else {
                            echo $this->formSelect(
                                "advanced[$i][element_id]",
                                @$rows['element_id'],
                                array(
                                    'title' => __("Search Field"),
                                    'id' => null,
                                    'class' => 'advanced-search-element'
                                ),
                                $ab_fields
                            );
                        }
                        echo $this->formSelect(
                            "advanced[$i][type]",
                            @$rows['type'],
                            array(
                                'title' => __("Search Type"),
                                'id' => null,
                                'class' => 'advanced-search-type'
                            ),
                            array(
                                'contains' => __('contains'),
                                'does not contain' => __('does not contain'),
                                'is exactly' => __('is exactly'),
                                'is empty' => __('is empty'),
                                'is not empty' => __('is not empty'),
                                'starts with' => __('starts with'),
                                'ends with' => __('ends with'))
                        );
                        echo $this->formText(
                            "advanced[$i][terms]",
                            @$rows['terms'],
                            array(
                                'size' => '20',
                                'title' => __("Search Terms"),
                                'id' => null,
                                'class' => 'advanced-search-terms'
                            )
                        );
                        ?>
                        <button type="button" class="remove_search" disabled="disabled" style="display: none;"><?php echo __('Remove field'); ?></button>
                    </div>
                <?php endforeach; ?>
                </div>
                <button type="button" class="add_search btn btn-light"><?php echo __('Add a Field'); ?></button>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="field">
                <?php echo $this->formLabel('item-type-search', __('Search By Type')); ?>
                <div class="inputs">
                <?php
                    echo $this->formSelect(
                        'type',
                        @$_REQUEST['type'],
                        array('id' => 'item-type-search'),
                        get_table_options('ItemType')
                    );
                ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="field">
                <?php echo $this->formLabel('tag-search', __('Search By Keywords')); ?>
                <div class="inputs">
                <?php
                    echo $this->formText('tags', @$_REQUEST['tags'],
                        array('size' => '40', 'id' => 'tag-search')
                    );
                ?>
                    <p><small><a href="http://pennds.org/archaeobib/keywords">View Keyword List</a></small></p>
                </div>
            </div>
        </div>
    </div>

    <div id="search-by-range" class="field ab-index-hide">
        <?php echo $this->formLabel('range', __('Search by a range of ID#s (example: 1-4, 156, 79)')); ?>
        <div class="inputs">
        <?php
            echo $this->formText('range', @$_GET['range'],
                array('size' => '40')
            );
        ?>
        </div>
    </div>

    <div class="field ab-index-hide">
        <?php echo $this->formLabel('collection-search', __('Search By Collection')); ?>
        <div class="inputs">
        <?php
            echo $this->formSelect(
                'collection',
                @$_REQUEST['collection'],
                array('id' => 'collection-search'),
                get_table_options('Collection', null, array('include_no_collection' => true))
            );
        ?>
        </div>
    </div>

    <?php if (is_allowed('Users', 'browse')): ?>
    <div class="field ab-index-hide">
    <?php
        echo $this->formLabel('user-search', __('Search By User'));?>
        <div class="inputs">
        <?php
            echo $this->formSelect(
                'user',
                @$_REQUEST['user'],
                array('id' => 'user-search'),
                get_table_options('User')
            );
        ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (is_allowed('Items', 'showNotPublic')): ?>
    <div class="field ab-index-hide">
        <?php echo $this->formLabel('public', __('Public/Non-Public')); ?>
        <div class="inputs">
        <?php
            echo $this->formSelect(
                'public',
                @$_REQUEST['public'],
                array(),
                label_table_options(array(
                    '1' => __('Only Public Items'),
                    '0' => __('Only Non-Public Items')
                ))
            );
        ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="field ab-index-hide">
        <?php echo $this->formLabel('featured', __('Featured/Non-Featured')); ?>
        <div class="inputs">
        <?php
            echo $this->formSelect(
                'featured',
                @$_REQUEST['featured'],
                array(),
                label_table_options(array(
                    '1' => __('Only Featured Items'),
                    '0' => __('Only Non-Featured Items')
                ))
            );
        ?>
        </div>
    </div>
    <?php if (!isset($buttonText)) {
        $buttonText = __('Search for items');
    } ?>
    <input type="submit" class="submit btn btn-primary" name="submit_search" id="submit_search_advanced" value="<?php echo $buttonText ?>">

    <?php if (!is_current_url(url('/'))): ?>
        <?php fire_plugin_hook('public_items_search', array('view' => $this)); ?>
    <?php endif ?>
</form>

<?php echo js_tag('items-search'); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        Omeka.Search.activateSearchButtons();
    });
</script>
