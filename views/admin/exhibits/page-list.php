<?php foreach( $section->Pages as $key => $page ): ?>
<li id="page_<?php echo $page->order; ?>" class="page">
	<div class="handle"><?php exhibit_layout($page->layout, false); ?></div>
	<div class="page-links">
	<span class="page-order"><?php echo text(array('name'=>"Pages[$key][order]",'size'=>2), $page->order); ?></span>
	<span><a href="<?php echo uri('exhibits/edit-page/'.$page->id); ?>">[Edit]</a></td>
	<span><a href="<?php echo uri('exhibits/delete-page/'.$page->id); ?>" class="delete-page">[Delete]</a>
	</div>
</li>
<?php endforeach; ?>