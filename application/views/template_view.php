<?php
$lang = parse_ini_file("application/lang/".$language.".ini");
if(isset($_SESSION['login'])) echo "Здравствуйте, ".$_SESSION['login']."<a href='/".$language."/main/logout'><br/>".$lang['OUT']."</a>";	
?>
<!DOCTYPE html>
<html lang="<?=$language?>" xml:lang="<?=$language?>" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php if(!empty($data[0]['title'])){echo $data[0]['title'];}else{echo ('Шана-М');}?></title>
	<meta charset="UTF-8"/>	
	<meta name="keywords" content="shana-m, shana, шана-м, шана, окна, пластиковые окна винница, wds, вдс, окна производство, фабрика окон, профиль пвх окон"/>   
	
	<link rel="stylesheet" type="text/css" href="/css/main.css"/>
	<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css'/>	-->


	<link rel="stylesheet" type="text/css" href="/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="/css/text.css"/>
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery.easing.1.3.js"></script>	 	

	<script type="text/javascript" src="/js/jquery.eislideshow.js"></script> 
	<script type="text/javascript" src="/js/jquery.contentcarousel.js"></script>
	<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="/js/animate_window.js"></script>

	<script type="text/javascript"> 
		imageDir = "http://mvcreative.ru/example/6/2/snow/"; 
		sflakesMax = 200; 
		sflakesMaxActive = 200; 
		svMaxX = 2; 
		svMaxY = 1; 
		ssnowStick = 0; 
		ssnowCollect = 0; 
		sfollowMouse = 1; 
		sflakeBottom = 0; 
		susePNG = 1; 
		sflakeTypes = 5; 
		sflakeWidth = 15; 
		sflakeHeight = 15; 
	</script> 
	<script type="text/javascript" src="http://mvcreative.ru/example/6/2/snow.js"></script>
	<script type="text/javascript">
		$(function() {
			$('#ei-slider').eislideshow({
				animation			: 'center',
				autoplay			: true,
				slideshow_interval	: 3000,
				titlesFactor		: 0
			});
		});		
		$(document).ready(function() {

		$("#owl-example").owlCarousel();

		});
		function sel_all(){
		   if( !document.form_name1.cheks ) return;
		   if( !document.form_name1.cheks.length )
			  document.form_name1.cheks.checked = document.form_name1.cheks.checked ? false : true;
		   else
			  for(var i=0; i<document.form_name1.cheks.length; i++)
				 document.form_name1.cheks[i].checked = document.form_name1.cheks[i].checked ? false : true;
		}
		
		function diplay_hide (hidden_content) 
		{ 
			if ($(hidden_content).css('display') == 'none') 
				{ 
					$(hidden_content).animate({height: 'show'}, 500); 
				} 
			else 
				{     
					$(hidden_content).animate({height: 'hide'}, 500); 
				} 
		} 
	var active_img = 0;
  function changeSizeOneImage(im, bigsize, smallsize) {

	
    if (active_img == im) {
      active_img.width = smallsize;
      active_img = 0;
      return;
    }
    if (active_img != 0) active_img.width = smallsize;
    active_img = im;
    im.width = bigsize;
  }
</script>

	<!-- Google Tag Manager -->
	<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KGKVDH"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-KGKVDH');</script>
	<!-- End Google Tag Manager -->
	

</head>
<body>	
	<?php include 'application/inc/animate_window.php'?>
	<div class="main">		
		<?php include 'application/inc/header.php'?>
		<?php include 'application/inc/menu.php'?>
		<div class="content">
			<?php include 'application/views/'.$content_view?>
		</div>
		<?php include 'application/inc/footer.php'?>		
	</div>
	
	<script type="text/javascript">
		$('#ca-container').contentcarousel();		
		CKEDITOR.replace( 'messageFF');			
	</script>
</body>
</html>
