<?php if($page){?>
<!-- <form method="post" action="<?=base_url().$this->uri->segment(1)?>/exportPdf" target="_blank" id="export_pdf_form">
<textarea name="page" id="pdfcontainer" style="display: none;"></textarea>
</form>

<div class="center" style="min-height:400px; height:100%;" id="page_container">
	<div class="title-3"> <?=$page->title?> <i class="icon-pencil"></i>
	-->
	<!-- 
	<?php if(!$page->contact){?>
	<span onclick="javascript:exportPdf();" class="pdf_export_span"></span>
		<a class="face_share_a" href="#" 
  onclick="
    window.open(
      'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
      'facebook-share-dialog', 
      'width=626,height=436'); 
    return false;">
  </a>
	<?php }?>
	-->
			<div class="main-block empty-block PIE">
				<div class="main-block-title">
					<h1><?=$page->title?></h1>
				</div>
				<div class="main-block-body">
					<?=$page->content?>
				</div>
			</div>
	<?php }else{?>
	<div class="center" style="height:600px;">
		No page
	</div>
	<?php }?>
	
