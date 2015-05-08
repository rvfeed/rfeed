
jQuery(document).ready(function($)
	{

		// will be using for trace stats
		
		$(document).on('click', '.ssb-share a', function()
			{
				
				var ssb_site = $(this).attr('class');
				var post_id = $(this).parent().attr("post_id");
				
				var count = parseInt($(this).children('.count').text());
				
				


				$.ajax(
					{
					type:"POST",
					url:ssb_ajax.ssb_ajaxurl,
					data:{action:"ssb_ajax_form",ssb_site:ssb_site,post_id:post_id},
					success:function(data)
						{
							$('.ssb-share-'+post_id+' a.'+ssb_site).children('.count').text(count+1);
							$('.ssb-share-'+post_id+' a.'+ssb_site).prop('disabled',true);
							$('.ssb-share-'+post_id+' a.'+ssb_site).css('cursor','not-allowed');
						}
					})
		});
		
		

		
	
 		

	});	







