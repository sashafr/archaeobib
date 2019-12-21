<?php
    $posterName = html_escape(get_option('poster_page_title'));
    $pageTitle = $posterName . ': &quot;' . html_escape($poster->title) . '&quot;';
    $pageLayout = get_option('poster_show_option');
    $defaultType = get_option('poster_default_file_type');
    echo queue_css_file('jquery.bxslider');
    echo queue_css_file('poster');
    echo queue_js_file('jquery.bxslider');
    echo head(array('title'=>$pageTitle));
?>

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <p class="ab-index-title">
                <strong><?php echo $pageTitle; ?></strong>
            </p>
            <div class="ab-header-text">
                <?php echo $poster->description; ?>
                <?php if ($this->currentUser): ?>
                    <div class="edit-link">
                        <a href="<?php echo html_escape(url(array('action' => 'edit','id' => $poster->id), get_option('poster_page_path'))); ?>" class="edit-poster-link">Edit</a> |
                        <a href="<?php echo html_escape(url(array('action'=>'print','id' => $poster->id), get_option('poster_page_path'))); ?>" class="print" media="print" >Download</a>
                    </div>
                <?php endif; ?>

            </div>
            <hr />
        </div>
    </div>

    <div class="row" id="poster">
        <table class="table table-striped-ab">
            <thead class="thead-ab">
                <tr>
                    <th scope="col">Type</th>
                    <th scope="col">Year</th>
                    <th scope="col">Authors</th>
                    <th scope="col">Title</th>
                    <th scope="col">Source</th>
                    <th scope="col">Notes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($poster->Items as $posterItem): ?>
                    <tr>
                        <td><?php echo $posterItem->getItemType()->name; ?></td>
                        <td><?php echo metadata($posterItem, array('Dublin Core', 'Date')); ?></td>
                        <td><?php echo metadata($posterItem, array('Dublin Core', 'Creator')); ?></td>
                        <td><?php echo link_to_item(metadata($posterItem, array('Dublin Core', 'Title')), null, 'show', $posterItem); ?></td>
                        <td>
                            <?php echo metadata($posterItem, array('Dublin Core', 'Source')); ?>
                            <?php if (element_exists('Item Type Metadata', 'Book Title')): ?>
                                <p><?php echo metadata($posterItem, array('Item Type Metadata', 'Book Title')); ?></p>
                            <?php endif; ?>
                            <?php if (element_exists('Item Type Metadata', 'Journal Title')): ?>
                                <p><?php echo metadata($posterItem, array('Item Type Metadata', 'Journal Title')); ?></p>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo $posterItem->caption; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
             $disclaimer = get_option('poster_disclaimer');
             if (!empty($disclaimer)):
        ?>
        <div id="poster-disclaimer">
            <h2 id="poster-disclaimer-title">Disclaimer</h2>
            <?php echo html_escape($disclaimer); ?>
        </div>
        <?php endif; ?>
    </div> <!-- end poster div -->
</div>
<script type="text/javascript">
    var n = jQuery('.poster-items li').length;
    var showOption = '<?php echo ($showOption = get_option('poster_show_option')) ? $showOption : 'carousel'; ?>';
    var fileSize = '<?php echo ($fileSize = get_option('poster_default_file_type')) ? $fileSize : 'fullsize'; ?>';
    if (n > 0 && showOption == 'carousel') {
       jQuery('.poster-items').bxSlider({
          auto: false,
          adaptiveHeight: true,
          mode: 'fade',
          captions: true,
          pager: n > 1,
       });
       <?php if ($defaultType == 'thumbnail'): ?>
       jQuery(window).load(function() {
           jQuery('.thumbnail .bx-caption').each(function() {
              var imageWidth = jQuery(this).prev().find('img').prop('width');
              var caption = jQuery(this);
              caption.css('left', imageWidth);
           });
        });
       <?php endif; ?>
    } else {
        jQuery('.poster-items').addClass('poster-items-grid');
        jQuery('.bx-caption').addClass('bx-caption-grid');
    }
</script>
<?php echo foot(); ?>
