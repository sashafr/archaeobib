<footer role="contentinfo">

    <div id="footer-text">
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
