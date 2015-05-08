<?php

function ssb_share_body()
	{
		global $post;
		
		$ssb_share_content_themes = get_option( 'ssb_share_content_themes' );
		$ssb_share_target_tab = get_option( 'ssb_share_target_tab' );
		$ssb_social_sites = get_option( 'ssb_social_sites' );		
		
		if($ssb_share_target_tab=='new')
			{$ssb_share_target_tab = "target='_blank'";}
		elseif($ssb_share_target_tab=='same')
			{$ssb_share_target_tab = "target='_parent'";}
		
		$ssb_post_sites = get_post_meta( $post->ID, 'ssb_post_sites', true );

		if(empty($ssb_post_sites['fb']))
			{$ssb_count_fb = "0";}
		else
			{$ssb_count_fb = $ssb_post_sites['fb'];}
		
		if(empty($ssb_post_sites['gplus']))
			{$ssb_count_gplus = "0";}
		else
			{$ssb_count_gplus = $ssb_post_sites['gplus'];}
		
		if(empty($ssb_post_sites['twitter']))
			{$ssb_count_twitter = "0";}
		else
			{$ssb_count_twitter = $ssb_post_sites['twitter'];}

		if(empty($ssb_post_sites['linkedin']))
			{$ssb_count_linkedin = "0";}
		else
			{$ssb_count_linkedin = $ssb_post_sites['linkedin'];}

		if(empty($ssb_post_sites['pinterest']))
			{ $ssb_count_pinterest = "0"; }
		else
			{ $ssb_count_pinterest = $ssb_post_sites['pinterest']; }
			
		if(empty($ssb_post_sites['reddit']))
			{ $ssb_count_reddit = "0"; }
		else
			{ $ssb_count_reddit = $ssb_post_sites['reddit']; }
			
		if(empty($ssb_post_sites['email']))
			{ $ssb_count_email = "0"; }
		else
			{ $ssb_count_email = $ssb_post_sites['email']; }			
			
			



		
		$ssb_share_icons = '';
		
		if($ssb_share_content_themes=='defualt')
			{
				
				
				if($ssb_social_sites['fb']=="fb")				
				$ssb_share_icons.= '<div class="defualt-button-fb">
<iframe src="//www.facebook.com/plugins/like.php?href='.ssb_share_get_url().'&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=743541755673761" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px;" allowTransparency="true"></iframe>
				</div>';

				if($ssb_social_sites['twitter']=="twitter")
				$ssb_share_icons.= '<div class="defualt-button-twitter">
				<a href="https://twitter.com/share" class="twitter-share-button" data-url="'.ssb_share_get_url().'">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document, "script", "twitter-wjs");</script>
					</div>';		
							
				if($ssb_social_sites['gplus']=="gplus")
				$ssb_share_icons.= '<div class="defualt-button-gplus">
				<script type="text/javascript" src="https://apis.google.com/js/platform.js"></script>
<div class="g-plusone" data-size="medium" data-href="'.ssb_share_get_url().'"></div>
					</div>';				
			
				if($ssb_social_sites['linkedin']=="linkedin")
				$ssb_share_icons.= '<div class="defualt-button-linkedin">
				<script src="//platform.linkedin.com/in.js" type="text/javascript">
  lang: en_US
</script>
<script type="IN/Share" data-url="'.ssb_share_get_url().'" data-counter="right"></script>
					</div>';			
			
			
				if($ssb_social_sites['pinterest']=="pinterest")
				$ssb_share_icons.= '<div class="defualt-button-pinterest">
<a href="//www.pinterest.com/pin/create/button/?url='.ssb_share_get_url().'&media='.ssb_share_get_image().'&description='.ssb_share_get_title().'" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" /></a>
<!-- Please call pinit.js only once per page -->
<script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>
					</div>';			
			
				if($ssb_social_sites['reddit']=="reddit")
				$ssb_share_icons.= '<div class="defualt-button-reddit">
					<script type="text/javascript" src="http://www.reddit.com/static/button/button1.js?i=1&styled=off&url='.ssb_share_get_url().'&newwindow=1&reddit_title='.ssb_share_get_title().'"></script>
					</div>';
	
				if($ssb_social_sites['email']=="email")
				$ssb_share_icons.= '<div class="defualt-button-email">
<a '.$ssb_share_target_tab.' class="email" href="mailto:?subject='.ssb_share_get_title().'&body='.ssb_share_get_url().'" ><span class="icon"></span>Email</a>
					</div>';					

	
			}
		if($ssb_share_content_themes=='defualt_box')
			{
			
				$ssb_share_icons.= '<div class="ssb-share" >';
				
				if($ssb_social_sites['fb']=="fb")				
				$ssb_share_icons.= '<div class="defualt-box-fb">
<iframe src="//www.facebook.com/plugins/like.php?href='.ssb_share_get_url().'&amp;width&amp;layout=box_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=65&amp;appId=743541755673761" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:65px;" allowTransparency="true"></iframe>
				</div>';
			

				if($ssb_social_sites['gplus']=="gplus")
				$ssb_share_icons.= '<div class="defualt-box-gplus">
				<script type="text/javascript" src="https://apis.google.com/js/platform.js"></script>
<div class="g-plusone" data-size="tall" data-href="'.ssb_share_get_url().'"></div>
					</div>';


				if($ssb_social_sites['twitter']=="twitter")
				$ssb_share_icons.= '<div class="defualt-box-twitter" >
				<a href="https://twitter.com/share" class="twitter-share-button" data-count="vertical" data-url="'.ssb_share_get_url().'">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document, "script", "twitter-wjs");</script>
					</div>';	

			
				if($ssb_social_sites['linkedin']=="linkedin")
				$ssb_share_icons.= '<div class="defualt-box-linkedin">
				<script src="//platform.linkedin.com/in.js" type="text/javascript">
  lang: en_US
</script>
<script type="IN/Share" data-url="'.ssb_share_get_url().'" data-counter="top"></script>
					</div>';
					
				if($ssb_social_sites['pinterest']=="pinterest")
				$ssb_share_icons.= '<div class="defualt-box-pinterest">
<a href="//www.pinterest.com/pin/create/button/?url='.ssb_share_get_url().'&media='.ssb_share_get_image().'&description='.ssb_share_get_title().'" count-layout="vertical" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_20.png" /></a>
<!-- Please call pinit.js only once per page -->
<script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>
					</div>';	
					
			
				if($ssb_social_sites['reddit']=="reddit")
				$ssb_share_icons.= '<div class="defualt-box-reddit">
					<script type="text/javascript" src="http://www.reddit.com/static/button/button2.js?i=1&styled=off&url='.ssb_share_get_url().'&newwindow=1&reddit_title='.ssb_share_get_title().'"></script>
					</div>';


				if($ssb_social_sites['email']=="email")
				$ssb_share_icons.= '<div class="defualt-box-email">
<a '.$ssb_share_target_tab.' class="email" href="mailto:?subject='.ssb_share_get_title().'&body='.ssb_share_get_url().'" ><span class="icon"></span>Email</a>
					</div>';

			
				$ssb_share_icons.= '</div>';
			
			
			
			
			}
			
		else if($ssb_share_content_themes=='flat' || $ssb_share_content_themes=='round'|| $ssb_share_content_themes=='wide')
			{
				
				if($ssb_social_sites['fb']=="fb")
					{
						$ssb_share_icons.="<a ".$ssb_share_target_tab." class='fb' href='https://www.facebook.com/sharer/sharer.php?u=".ssb_share_get_url()."' ><span class='icon'></span><span class='count'>".$ssb_count_fb."</span></a>";
					}
				
				if($ssb_social_sites['gplus']=="gplus")
					{
					$ssb_share_icons.= "<a ".$ssb_share_target_tab." class='gplus' href='https://plus.google.com/share?url=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_gplus."</span></a>";
					}
				if($ssb_social_sites['twitter']=="twitter")
					{
					$ssb_share_icons.= "<a ".$ssb_share_target_tab." class='twitter' href='https://twitter.com/intent/tweet?url=".ssb_share_get_url()."&text=".ssb_share_get_title()."'><span class='icon'></span><span class='count'>".$ssb_count_twitter."</span></a>";
					}
					
				if($ssb_social_sites['linkedin']=="linkedin")
					{
					$ssb_share_icons.= "<a ".$ssb_share_target_tab." class='linkedin' href='https://www.linkedin.com/shareArticle?mini=true&url=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_linkedin."</span></a>";
					}
				if($ssb_social_sites['pinterest']=="pinterest")
					{
					$ssb_share_icons.= "<a ".$ssb_share_target_tab." class='pinterest' href='https://pinterest.com/pin/create/button/?url=".ssb_share_get_url()."&media=".ssb_share_get_image()."'><span class='icon'></span><span class='count'>".$ssb_count_pinterest."</span></a>";
					}

				if($ssb_social_sites['reddit']=="reddit")
					{
					$ssb_share_icons.= "<a ".$ssb_share_target_tab." class='reddit' href='http://www.reddit.com/submit?title=".ssb_share_get_title()."&url=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_reddit."</span></a>";
					}
					
				if($ssb_social_sites['email']=="email")
					{
					$ssb_share_icons.= "<a ".$ssb_share_target_tab." class='email' href='mailto:?subject=".ssb_share_get_title()."&body=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_email."</span></a>";
					}					
					

					
					
			}
		else if($ssb_share_content_themes=='bodyname')
			{

				$ssb_share_icons.="
					<a ".$ssb_share_target_tab." class='fb' href='https://www.facebook.com/sharer/sharer.php?u=".ssb_share_get_url()."' ><span class='icon'></span><span class='body'>Share</span><span class='count'>".$ssb_count_fb."</span></a>
					<a ".$ssb_share_target_tab." class='gplus' href='https://plus.google.com/share?url=".ssb_share_get_url()."'><span class='icon'></span><span class='body'>Plus</span><span class='count'>".$ssb_count_gplus."</span></a>
					<a ".$ssb_share_target_tab." class='twitter' href='https://twitter.com/intent/tweet?url=".ssb_share_get_url()."&text=".ssb_share_get_title()."'><span class='icon'></span><span class='body'>Tweet</span><span class='count'>".$ssb_count_twitter."</span></a>
					<a ".$ssb_share_target_tab." class='linkedin' href='https://www.linkedin.com/shareArticle?mini=true&url=".ssb_share_get_url()."'><span class='icon'></span><span class='body'>Share</span><span class='count'>".$ssb_count_linkedin."</span></a>
					<a ".$ssb_share_target_tab." class='pinterest' href='https://pinterest.com/pin/create/button/?url=".ssb_share_get_url()."&media=".ssb_share_get_image()."'><span class='icon'></span><span class='body'>PinIt!</span><span class='count'>".$ssb_count_pinterest."</span></a>
					<a ".$ssb_share_target_tab." class='reddit' href='http://www.reddit.com/submit?title=".ssb_share_get_title()."&url=".ssb_share_get_url()."'><span class='icon'></span><span class='body'>Reddit</span><span class='count'>".$ssb_count_reddit."</span></a>
					
					<a ".$ssb_share_target_tab." class='email' href='mailto:?subject=".ssb_share_get_title()."&body=".ssb_share_get_url()."'><span class='icon'></span><span class='body'>Email</span><span class='count'>".$ssb_count_email."</span></a>					
					
					
					";
					
					
			}
			
		else if($ssb_share_content_themes=='packslide')
			{

				$ssb_share_icons.="
					<a ".$ssb_share_target_tab." class='fb' href='https://www.facebook.com/sharer/sharer.php?u=".ssb_share_get_url()."' ><span class='icon'></span><span class='count'>".$ssb_count_fb."</span></a>
					<a ".$ssb_share_target_tab." class='gplus' href='https://plus.google.com/share?url=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_gplus."</span></a>
					<a class='twitter' href='https://twitter.com/intent/tweet?url=".ssb_share_get_url()."&text=".ssb_share_get_title()."'><span class='icon'></span><span class='count'>".$ssb_count_twitter."</span></a>
					<a ".$ssb_share_target_tab." class='linkedin' href='https://www.linkedin.com/shareArticle?mini=true&url=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_linkedin."</span></a>
					<a ".$ssb_share_target_tab." class='pinterest' href='https://pinterest.com/pin/create/button/?url=".ssb_share_get_url()."&media=".ssb_share_get_image()."'><span class='icon'></span><span class='count'>".$ssb_count_pinterest."</span></a>
					<a ".$ssb_share_target_tab." class='reddit' href='http://www.reddit.com/submit?title=".ssb_share_get_title()."&url=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_reddit."</span></a>
					
					<a ".$ssb_share_target_tab." class='email' href='mailto:?subject=".ssb_share_get_title()."&body=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_email."</span></a>					
					
					";
			}	
			
			
	
		else if($ssb_share_content_themes=='hexa')
			{
				$ssb_share_icons.="
					<a ".$ssb_share_target_tab." class='fb' href='https://www.facebook.com/sharer/sharer.php?u=".ssb_share_get_url()."' ><span class='icon'></span><span class='count'>".$ssb_count_fb."</span></a>
					<a ".$ssb_share_target_tab." class='gplus' href='https://plus.google.com/share?url=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_gplus."</span></a>
					<a ".$ssb_share_target_tab." class='twitter' href='https://twitter.com/intent/tweet?url=".ssb_share_get_url()."&text=".ssb_share_get_title()."'><span class='icon'></span><span class='count'>".$ssb_count_twitter."</span></a>
					<a ".$ssb_share_target_tab." class='linkedin' href='https://www.linkedin.com/shareArticle?mini=true&url=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_linkedin."</span></a>
					<a ".$ssb_share_target_tab." class='pinterest' href='https://pinterest.com/pin/create/button/?url=".ssb_share_get_url()."&media=".ssb_share_get_image()."'><span class='icon'></span><span class='count'>".$ssb_count_pinterest."</span></a>
					<a ".$ssb_share_target_tab." class='reddit' href='http://www.reddit.com/submit?title=".ssb_share_get_title()."&url=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_reddit."</span></a>
					
					<a ".$ssb_share_target_tab." class='email' href='mailto:?subject=".ssb_share_get_title()."&body=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_email."</span></a>					
					
					";
			}	
			
			
		else if($ssb_share_content_themes=='hover-left')
			{
				$ssb_share_icons.="
					<a ".$ssb_share_target_tab." class='fb' href='https://www.facebook.com/sharer/sharer.php?u=".ssb_share_get_url()."' ><span class='icon'></span><span class='count'>".$ssb_count_fb."</span></a><br />
					<a ".$ssb_share_target_tab." class='gplus' href='https://plus.google.com/share?url=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_gplus."</span></a><br />
					<a ".$ssb_share_target_tab." class='twitter' href='https://twitter.com/intent/tweet?url=".ssb_share_get_url()."&text=".ssb_share_get_title()."'><span class='icon'></span><span class='count'>".$ssb_count_twitter."</span></a><br />
					<a ".$ssb_share_target_tab." class='linkedin' href='https://www.linkedin.com/shareArticle?mini=true&url=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_linkedin."</span></a><br />
					<a ".$ssb_share_target_tab." class='pinterest' href='https://pinterest.com/pin/create/button/?url=".ssb_share_get_url()."&media=".ssb_share_get_image()."'><span class='icon'></span><span class='count'>".$ssb_count_pinterest."</span></a><br />
					<a ".$ssb_share_target_tab." class='reddit' href='http://www.reddit.com/submit?title=".ssb_share_get_title()."&url=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_reddit."</span></a><br />
					
					<a ".$ssb_share_target_tab." class='email' href='mailto:?subject=".ssb_share_get_title()."&body=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_email."</span></a><br />					
					
					";
			}
			
		else if($ssb_share_content_themes=='hover-right')
			{
				$ssb_share_icons.="
					<a ".$ssb_share_target_tab." class='fb' href='https://www.facebook.com/sharer/sharer.php?u=".ssb_share_get_url()."' ><span class='icon'></span><span class='count'>".$ssb_count_fb."</span></a><br />
					<a ".$ssb_share_target_tab." class='gplus' href='https://plus.google.com/share?url=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_gplus."</span></a><br />
					<a ".$ssb_share_target_tab." class='twitter' href='https://twitter.com/intent/tweet?url=".ssb_share_get_url()."&text=".ssb_share_get_title()."'><span class='icon'></span><span class='count'>".$ssb_count_twitter."</span></a><br />
					<a ".$ssb_share_target_tab." class='linkedin' href='https://www.linkedin.com/shareArticle?mini=true&url=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_linkedin."</span></a><br />
					<a ".$ssb_share_target_tab." class='pinterest' href='https://pinterest.com/pin/create/button/?url=".ssb_share_get_url()."&media=".ssb_share_get_image()."'><span class='icon'></span><span class='count'>".$ssb_count_pinterest."</span></a><br />
					<a ".$ssb_share_target_tab." class='reddit' href='http://www.reddit.com/submit?title=".ssb_share_get_title()."&url=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_reddit."</span></a><br />
					
					<a ".$ssb_share_target_tab." class='email' href='mailto:?subject=".ssb_share_get_title()."&body=".ssb_share_get_url()."'><span class='icon'></span><span class='count'>".$ssb_count_email."</span></a><br />					
					";
			}		
			
			

		return $ssb_share_icons;
	}
?>