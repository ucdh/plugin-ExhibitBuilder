<?php
    if ($exhibitPage->title) {
        $exhibitPageTitle = $actionName . ' Page: "' . $exhibitPage->title . '"';
    } else {
        $exhibitPageTitle = $actionName . ' Page';
    }
?>
<?php head(array('title'=> html_escape($exhibitPageTitle), 'bodyclass'=>'exhibits')); ?>

<?php echo js('jquery'); ?>
<script type="text/javascript" charset="utf-8">
    jQuery.noConflict();
</script>
<?php echo '<link rel="stylesheet" media="screen" href="' . html_escape(css('jquery-ui/css/ui-lightness/jquery-ui-1.8.2.custom')) . '" /> '; ?>
<?php echo js('jquery-ui/js/jquery-ui-1.8.2.custom.min'); ?>
<style>
.ui-button-text {
    color:black;
}
</style>

<script type="text/javascript" charset="utf-8">
//<![CDATA[

    jQuery(document).ready(function(){

        var exhibitBuilder = new Omeka.ExhibitBuilder();        
		
		// Add styling
		exhibitBuilder.addStyling();
		
		// Set the exhibit item uri
		exhibitBuilder.itemContainerUri = <?php echo Zend_Json::encode(uri('exhibits/item-container')); ?>;
		
		// Set the paginated exhibit items uri
		exhibitBuilder.paginatedItemsUri = <?php echo Zend_Json::encode(uri('exhibits/items')); ?>;
		
		// Set the remove item background image uri
		exhibitBuilder.removeItemBackgroundImageUri = <?php echo Zend_Json::encode(img('delete.gif')); ?>;
		
		// Get the paginated items
		exhibitBuilder.getItems();

    	jQuery(document).bind('omeka:loaditems', function() {
   	        // Hide the page search form
    	    jQuery('#page-search-form').hide();

            jQuery('#show-or-hide-search').click( function(){
                var searchForm = jQuery('#page-search-form');
                if (searchForm.is(':visible')) {
                    searchForm.hide();
                } else {
                    searchForm.show();
                }
                
                var showHideLink = jQuery(this);
                showHideLink.toggleClass('show-form');
                if (showHideLink.hasClass('show-form')) {
                    showHideLink.text('Show Search Form');
                } else {
                    showHideLink.text('Hide Search Form');
                }
            });
    	});
    	
    	Omeka.ExhibitBuilder.wysiwyg;
    	
    	// Search Items Dialog Box
         jQuery('#search-items').dialog({
     		autoOpen: false,
     		width: 820,
     		height: 500,
     		title: 'Attach an Item',
     		modal: true,
     		buttons: {
     			"Attach Item": function() { 
                    exhibitBuilder.attachSelectedItem();
     				jQuery(this).dialog('close'); 
     			}, 
     			"Cancel": function() { 
     				jQuery(this).dialog('close'); 
     			} 
     		}
     	});
	}); 
//]]>    
</script>
<h1><?php echo html_escape($exhibitPageTitle); ?></h1>

<div id="primary">
<?php echo flash(); ?>

<div id="page-builder">
	<div id="exhibits-breadcrumb">
		<a href="<?php echo html_escape(uri('exhibits')); ?>">Exhibits</a> &gt; <a href="<?php echo html_escape(uri('exhibits/edit/' . $exhibit['id']));?>"><?php echo html_escape($exhibit['title']); ?></a>  &gt; <a href="<?php echo html_escape(uri('exhibits/edit-section/' . $exhibitSection['id']));?>"><?php echo html_escape($exhibitSection['title']); ?></a>  &gt; <?php echo html_escape($actionName . ' Page'); ?>
	</div>
    
    <?php //This item-select div must be outside the <form> tag for this page, b/c IE7 can't handle nested form tags. ?>
	<div id="search-items" style="display:none;">
		<div id="item-select"></div>
    </div>
    
    <form id="page-form" method="post" action="<?php echo html_escape(uri(array('module'=>'exhibit-builder', 'controller'=>'exhibits', 'action'=>'edit-page-content', 'id'=>$exhibitPage->id))); ?>">
        <div id="page-metadata-list">
        <h2>Page Metadata</h2>
            <p>Page Title: <?php echo html_escape($exhibitPage->title); ?></p>
        <?php 
            $imgFile = web_path_to(EXHIBIT_LAYOUTS_DIR_NAME ."/$exhibitPage->layout/layout.gif"); 
        	echo '<img src="'. html_escape($imgFile) .'" alt="' . html_escape($exhibitPage->layout) . '"/>';
        ?>
    <button id="page_metadata_form" name="page_metadata_form" type="submit">Edit Page Metadata</button>
        </div>
    
	<div id="layout-all">
	<div id="layout-form">
	<?php exhibit_builder_render_layout_form($exhibitPage->layout); ?>
	</div>

	</div>
    <fieldset>
		<p id="exhibit-builder-save-changes">
			<input id="section_form" name="section_form" type="submit" value="Save and Return to Section" /> or 
			<input id="page_form" name="page_form" type="submit" value="Save and Add Another Page" /> or <a href="<?php echo html_escape(uri(array('module'=>'exhibit-builder', 'controller'=>'exhibits', 'action'=>'edit-section', 'id'=>$exhibitPage->section_id))); ?>">Cancel</a>
		</p>
	</fieldset>
	<fieldset>
	<?php echo __v()->formHidden('slug', $exhibitPage->slug); // Put this here to fool the form into not overriding the slug. ?>	
	</fieldset>
	</form>
</div>
</div>
<?php foot(); ?>