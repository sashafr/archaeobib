<?php
$pageTitle = __('Browse Items');
echo head(array('title' => $pageTitle, 'bodyclass' => 'items tags'));
?>

<h1><?php echo $pageTitle; ?></h1>

<?php $letter = $_GET['letter'];
    if ($letter != "") {
        $db = get_db();
        $tags = $db->getTable('Tag')->fetchObjects("SELECT name FROM {$db->prefix}tags t WHERE t.name LIKE '$letter%' ORDER BY name");
    }
?>

<?php echo tag_cloud($tags, 'items/browse'); ?>

<?php echo foot(); ?>