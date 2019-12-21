<?php
echo queue_css_file('poster');

$pageTitle = html_escape(get_option('poster_page_title'));
echo head(array('title' => $pageTitle, 'bodyclass' => 'posters browse'));
$posters = $this->posters;
?>

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <p class="ab-index-title">
                <strong><?php echo 'View ' . $pageTitle; ?></strong>
            </p>
            <div class="ab-header-text">
                <?php if(current_user()): ?>
                    <?php if(count($posters) == 0): ?>
                        <?php echo __("There are no " . $pageTitle . " collections yet."); ?>
                    <?php endif; ?>
                    <a href="<?php echo public_url(array('controller'=> 'posters', 'action' => 'new')); ?>" class="button">Create a new <?php echo $pageTitle; ?> collection</a>
                <?php else: ?>
                    To create <?php echo $pageTitle; ?> collections, you must be <a href="<?php echo url('users/login'); ?>">logged in</a>. If you do not have an account, <a href="<?php echo url('guest-user/user/register'); ?>">click here to create one</a>.
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if(current_user()): ?>
        <div class="row">
            <table class="table table-striped-ab">
                <thead class="thead-ab">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col" id="poster-titles"><?php echo __('Title'); ?></th>
                        <th scope="col" id="poster-dates"><?php echo __('Date Added'); ?></th>
                        <th scope="col" id="poster-descriptions"><?php echo __('Description'); ?></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($posters as $poster): ?>
                        <tr>
                            <td></td>
                            <td>
                                <a href="<?php echo html_escape(url(array('action' => 'show','id'=>$poster->id), get_option('poster_page_path'))); ?>" class="view-poster-link"><?php echo html_escape($poster->title); ?></a>
                                <ul class="poster-actions">
                                <?php if($this->user) : ?>
                                    <li><a href="<?php echo html_escape(url(array('action'=>'edit','id' => $poster->id), get_option('poster_page_path'))); ?>">Edit</a></li>
                                    <li><a href="<?php echo html_escape(url(array('action' => 'delete-confirm', 'id' => $poster->id),  get_option('poster_page_path'))); ?>">Delete</a></li>
                                    <!---<li><a href="<?php echo html_escape(url(array('action'=>'share','id' => $poster->id), get_option('poster_page_path'))); ?>">Share <?php echo $pageTitle; ?></a></li> -->
                                <?php endif; ?>
                                    <li><a href="<?php echo html_escape(url(array('action'=>'print','id' => $poster->id), get_option('poster_page_path'))); ?>" class="print" media="print" >Download</a></li>
                                </ul>
                            </td>
                            <td><?php echo html_escape(format_date($poster->date_created)); ?></td>
                            <td><?php echo html_escape(snippet($poster->description,0, 200)); ?></td>
                            <td></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php echo foot(); ?>
