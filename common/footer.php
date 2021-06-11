<footer class="ab-footer">

    <div id="footer-text">
        <?php echo get_theme_option('Footer Text'); ?>
    </div>

    <?php fire_plugin_hook('public_footer', array('view'=>$this)); ?>

</footer>

<script>

jQuery(document).ready(function() {

    Omeka.showAdvancedForm();
    Omeka.skipNav();
});
</script>
</body>
</html>
