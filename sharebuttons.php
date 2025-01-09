<?php
$uri = $_SERVER['REQUEST_URI'];
$actual_link = 'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$s4yssURL = urlencode($actual_link);
$s4yssTitle = str_replace( ' ', '%20',str_replace( '&', '%26',$title));
$twitterURL = 'https://twitter.com/intent/tweet?text='.$s4yssTitle.'&amp;url='.$s4yssURL.'&amp;via=sarkaribank';
$facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$s4yssURL;
$whatsappURL = 'whatsapp://send?text=%2A'.$s4yssTitle .'%2A%0A%0A%2AGet%20details%20here%2A%0A%F0%9F%91%87%F0%9F%91%87%F0%9F%91%87%F0%9F%91%87%F0%9F%91%87%0A'. $s4yssURL.'%3Futm_source%3DWhatsApp%0A%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%2B%0AShare%20this%20message%20with%20your%20friends';
$linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$s4yssURL.'&amp;title='.$s4yssTitle;

function shareone(){global $twitterURL, $facebookURL, $whatsappURL, $linkedInURL, $s4yssURL, $uri;
	
	echo "<div class='s4yss-social'>
<h5>Share it for your friends:</h5><a class='s4yss-link s4yss-facebook' href='".$facebookURL."' target='_blank' rel='noreferrer' aria-label='SarkariBank_share'><i class='icon-facebook2'></i></a>
<a class='s4yss-link s4yss-whatsapp' href='".$whatsappURL."' target='_blank' rel='noreferrer' aria-label='SarkariBank_share'><i class='icon-whatsapp'></i></a>
<a class='s4yss-link s4yss-twitter' href='". $twitterURL ."' target='_blank' rel='noreferrer' aria-label='SarkariBank_share'><i class='icon-twitter'></i></a>
<a class='s4yss-link s4yss-linkedin' href='".$linkedInURL."' target='_blank' rel='noreferrer' aria-label='SarkariBank_share'><i class='icon-linkedin'></i></a>
 </div>";}
function share2(){global $twitterURL, $facebookURL, $whatsappURL, $linkedInURL, $s4yssURL, $uri;
	
echo "<div class='s4yss-social'>
<a class='s4yss-link s4yss-facebook' href='".$facebookURL."' target='_blank' rel='noreferrer' aria-label='SarkariBank_share'><i class='icon-facebook2'></i></a>
<a class='s4yss-link s4yss-whatsapp' href='".$whatsappURL."' target='_blank' rel='noreferrer' aria-label='SarkariBank_share'><i class='icon-whatsapp'></i></a>
<a class='s4yss-link s4yss-twitter' href='". $twitterURL ."' target='_blank' rel='noreferrer' aria-label='SarkariBank_share'><i class='icon-twitter'></i></a>
<a class='s4yss-link s4yss-linkedin' href='".$linkedInURL."' target='_blank' rel='noreferrer' aria-label='SarkariBank_share'><i class='icon-linkedin'></i></a>
</div>";
}
?>
