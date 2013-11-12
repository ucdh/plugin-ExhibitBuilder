<?php echo js_tag('themes'); ?>
<?php echo flash(); ?>
<div id="theme-form">
    <h2><?php echo __('Theme: %s', $theme->title); ?></h2>
    <p><?php echo __('Configurations apply to this theme only.'); ?></p>
    <?php echo $form; ?>
    <div id="save" class="panel">
        <?php echo $this->formSubmit('submit', __('Save Changes'), array('class'=>'submit big green button')); ?>
    </div>
</div>
