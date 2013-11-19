<?php echo js_tag('themes'); ?>
<?php echo flash(); ?>
    <h2><?php echo __('Theme: %s', $theme->title); ?></h2>
    <p><?php echo __('Configurations apply to this theme only.'); ?></p>
    <form id="theme-form">
    <?php echo $form; ?>
    </form>
</div>
