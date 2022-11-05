<?php
$pageTitle = __('Browse Keywords');
echo head(array('title' => $pageTitle, 'bodyclass' => 'items tags'));

$textSortUrl = url('items/tags?sort_field=name');
$countSortUrl = url('items/tags?sort_field=count');

if (isset($_GET['sort_field'])) {
    $sort = $_GET['sort_field'];
} else {
    $sort = '';
}
if (isset($_GET['sort_dir'])) {
    $sort_dir = $_GET['sort_dir'];
} else {
    $sort_dir = '';
}

if ($sort_dir == 'a') {
    $textSortUrl = $textSortUrl . "&sort_dir=d";
    $countSortUrl = $countSortUrl . "&sort_dir=d";
} else if ($sort_dir == 'd') {
    $textSortUrl = $textSortUrl . "&sort_dir=a";
    $countSortUrl = $countSortUrl . "&sort_dir=a";
} else {
    $textSortUrl = $textSortUrl . "&sort_dir=a";
    $countSortUrl = $countSortUrl . "&sort_dir=d";
}

?>

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <p class="ab-index-title">
                <strong>Lookup</strong>
            </p>
            <?php if (get_theme_option('Keywords Text')): ?>
                <div class="ab-header-text">
                    <?php echo get_theme_option('Keywords Text'); ?>
                </div>
                <hr />
            <? endif; ?>
        </div>
    </div>

    <?php if (isset($_GET['letter'])) {
            $letter = $_GET['letter'];
        } else {
            $letter = "";
        }
        if ($letter != "") {
            foreach ($tags as $key => $tag) {
                if (!(strpos(strtolower($tag['name']), strtolower($letter)) === 0)) {
                    unset($tags[$key]);
                }
            }

            $textSortUrl = $textSortUrl . "&letter=" . $letter;
            $countSortUrl = $countSortUrl . "&letter=" . $letter;
        }

    ?>

    <div class="row justify-content-between">
        <div class="col-md-12">
            <div class="row justify-content-end no-gutters">
              <div class="col-md-auto">
                <span class="sort-label"><?php echo __('Sort by: '); ?></span>
              </div>
              <div class="col-md-auto">
                  <ul id="sort-links-list">
                      <li<?php if ($sort === 'name'): ?> class="sorting<?php if ($sort_dir === 'a'): ?> asc<?php elseif ($sort_dir === 'd'): ?> desc<?php endif; ?>"<?php endif;?>>
                          <a href="<?php echo $textSortUrl; ?>">Text</a>
                      </li>
                      <li<?php if ($sort === 'count'): ?> class="sorting<?php if ($sort_dir === 'a'): ?> asc<?php elseif ($sort_dir === 'd'): ?> desc<?php endif; ?>"<?php endif;?>>
                          <a href="<?php echo $countSortUrl; ?>">Count</a>
                      </li>
                  </ul>
              </div>
            </div>
        </div>
    </div>

    <div class="row mt-4 mx-5">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body ab-tags">
                    <?php echo tag_cloud($tags, 'items/browse', 5, true, 'before'); ?>
                </div>
            </div>
        </div>
    </div>

</div>

<?php echo foot(); ?>
