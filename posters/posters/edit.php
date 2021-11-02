<?php
    $posterName = html_escape(get_option('poster_page_title'));
    $pageTitle = 'Edit ' . $posterName . ': &quot;' . html_escape($poster->title) . '&quot;';
    echo queue_js_file('poster');
    echo queue_js_file('vendor/tinymce/tinymce.min');
    echo queue_css_file('jquery-ui');
    echo queue_css_file('poster');
    echo head(array('title'=>$pageTitle, 'bodyclass' => 'posters edit'));
?>
<script type="text/javascript">
    // Set the initial Item Count
    Omeka.Poster.itemCount = <?php echo count($poster->Items); ?>;

    jQuery(window).load(Omeka.Poster.init);
</script>

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <p class="ab-index-title">
                <strong><?php echo $pageTitle; ?></strong>
            </p>
            <div class="ab-header-text">
                <ul class="poster-actions">
                    <li><a href="<?php echo html_escape(url(array('action'=>'help'), get_option('poster_page_path'))); ?>" class="help-link">Help</a></li>
                    <!-- <li><a href="<?php echo html_escape(url(array('action'=>'share'), get_option('poster_page_path'))); ?>" class="share-link">Share <?php echo $posterName; ?></a></li> -->
                    <li><a href="<?php echo html_escape(url(array('action'=>'print'), get_option('poster_page_path'))); ?>" class="print" media="print" >Download</a></li>
                 </ul>
            </div>
            <hr />
        </div>
    </div>
    <div class="row" id="poster">
        <div class="col-md-12" id="poster-info">
              <form action="<?php echo html_escape(url(array('action'=>'save', 'id'=>$poster->id), get_option('poster_page_path'))); ?>" method="post" accept-charset="utf-8" id="poster-form">
                  <div class="field">
                      <label for="title">Title of <?php echo $posterName; ?> Collection</label>
                      <div class="inputs">
                      <?php echo $this->formText('title', $poster->title, array('id'=>'title')); ?>
                      </div>
                  </div>
                  <div class="field">
                      <label for="description">Description</label>
                      <div class="inputs">
                          <?php echo $this->formTextarea('description', $poster->description,
                          array('id'=>'description', 'rows'=>'8', 'cols'=>'20')); ?>
                      </div>
                  </div>

                  <p class="ab-index-title" id="poster-items-title">
                      <strong><?php echo $posterName; ?> Items</strong>
                  </p>

                  <?php $noItems = (count($poster->Items) < 1) ? 'class="no-items"' : ''; ?>

                  <p id="poster-no-items-yet" <?php echo $noItems; ?>>You have not added any items to this collection yet.</p>

                  <div id="submit-poster">
                      <input style="color:#fff;background-color:#f15d2f;" type="submit" name="save_poster" value="Save" > or
                      <?php if (is_admin_theme()): ?>
                          <a href="<?php echo html_escape(url(array('action'=>'discard'), get_option('poster_page_path'))); ?>">Discard Changes and Return to <?php echo $posterName; ?> Administration</a>
                      <?php else: ?>
                          <a href="<?php echo html_escape(url(array('action'=> 'discard'), get_option('poster_page_path'))); ?>">Discard Changes and Return to the Dashboard</a>
                      <?php endif ?>
                      <input type="hidden" name="itemCount" value="<?php echo count($poster->Items); ?>" id="itemCount"/>
                  </div>

                  <div id="poster-canvas" <?php echo $noItems; ?>>
                      <table class="table table-striped-ab" id="poster-items">
                          <thead class="thead-ab">
                              <tr>
                                  <th scope="col" id="poster-item-title-col">Citation</th>
                                  <th scope="col" id="poster-item-caption-col">Notes</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php foreach ($poster->Items as $posterItem){
                                      $posterItem->posterId = $poster->id;
                                      echo common('spot', array('posterItem'=>$posterItem),'posters' );
                                  }
                              ?>
                          </tbody>
                      </table>
                  </div>

                  <div id="poster-additem">
                  <?php if (count($items)): ?>
                      <button type="button" id="add-item-button">Add an Item</button>
                  <?php else: ?>
                      <button type="button" id="add-item-button" disabled="disabled">Add an item &rarr;</button>
                          <p>You have to add notes or tags to an item before adding them to a list</p>
                  <?php endif; ?>
                  </div>

              </form>
              <!-- pop-up -->
              <div id="additem-modal" >
                  <div id="item-form">
                      <button type="button" id="revert-selected-item"><?php echo __('Revert to Selected Item'); ?></button>
                      <button type="button" id="show-or-hide-search" class="show-form blue">
                          <span class="show-search-label"><?php echo __('Show Search Form'); ?></span>
                          <span class="hide-search-label"><?php echo __('Hide Search Form'); ?></span>
                      </button>
                      <a href="<?php echo url(get_option('poster_page_path') . '/items/browse'); ?>" id="view-all-items" class="green button"><?php echo __('View All Items'); ?></a>
                      <div id="page-search-form" class="container-twelve">
                          <?php
                              $action = url(array(
                                      'module' => 'posters',
                                      'controller' => 'items',
                                      'action' =>'browse'),
                              'default', array(), true);
                              echo items_search_form(array('id' => 'search'), $action);
                          ?>
                      </div>
                      <div id="item-select"></div>
                  </div>
              </div>
              <!-- end pop-up -->
        </div> <!-- end poster-info div -->
    </div> <!-- end poster div -->

</div>

<script type="text/javascript" charset="utf-8">
                //<![CDATA[

    jQuery(document).ready(function(){
        Omeka.Poster.setUpItemsSelect(<?php echo js_escape(url(get_option('poster_page_path').'/add-poster-item'));?>);
        Omeka.Poster.wysiwyg();
    });

//]]>
</script>
<?php echo foot(); ?>
