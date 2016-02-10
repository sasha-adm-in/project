<div id="ei-slider" class="ei-slider">
	<ul class="ei-slider-large">
		<li>
			<a href="/<?=$language?>/press/topnews2"><img src="/images/news/<?=$lang['BANK']?>main.png"/></a>
			<div class="ei-title">
			</div>
		</li>
		<li>
			<img src="/images/large/wds8s.png" alt="image06"/>
			<div class="ei-title">
				<h2>WDS</h2>
				<h3>8 SERIES</h3>
			</div>
		</li>
		<li>
			<img src="/images/news/ny.jpg" alt="image06"/>
			<div class="ei-title">
			</div>
		</li>
		<li>
			<img src="/images/large/wds7s.png" alt="image01" />
			<div class="ei-title">
				<h2>WDS</h2>
				<h3>7 SERIES</h3>
			</div>
		</li>
		<li>
			<img src="/images/large/wds500.png" alt="image02" />
			<div class="ei-title">
				<h2>WDS</h2>
				<h3>500</h3>
			</div>
		</li>
		<li>
			<img src="/images/large/wds400.png" alt="image03"/>
			<div class="ei-title">
				<h2>WDS</h2>
				<h3>400</h3>
			</div>
		</li>
		<li>
			<img src="/images/large/galaxy.png" alt="image04"/>
			<div class="ei-title">
				<h2>эконом-класс</h2>
				<h3>galaxy</h3>
			</div>
		</li>                  
	</ul>
	<ul class="ei-slider-thumbs">
		<li class="ei-slider-element">Current</li>						
		<li><a href="#">Slide 1</a></li>
		<li><a href="#">Slide 1</a><img src="/images/small/1.jpg" alt="thumb01" /></li>
		<li><a href="#">Slide 1</a></li>
		<li><a href="#">Slide 2</a><img src="/images/small/2.jpg" alt="thumb02" /></li>
		<li><a href="#">Slide 3</a><img src="/images/small/3.jpg" alt="thumb03" /></li>
		<li><a href="#">Slide 4</a><img src="/images/small/4.jpg" alt="thumb04" /></li>
		<li><a href="#">Slide 5</a><img src="/images/small/5.jpg" alt="thumb05" /></li>                        
	</ul>
</div>
<div class="container">
<div id="ca-container" class="ca-container">
	<?=$data[4]['text']?>
</div>
</div>
<div class="cont">
	<div class="art">	
		<h4><?=$lang["ART"]?></h4>
		<ul>
		<li><p><a href="/<?=$language?>/press/art1">
		<?=$lang["ART1"]?>
		</a></p></li>
		<li><p><a href="/<?=$language?>/press/art2">
		<?=$lang["ART2"]?>
		</a></p></li>
		<li><p><a href="/<?=$language?>/press/art3">
		<?=$lang["ART3"]?>
		</a></p></li>
		<li><p><a href="/<?=$language?>/press/art4">
		<?=$lang["ART4"]?>
		</a></p></li>
		<li><p><a href="/<?=$language?>/press/art5">
		<?=$lang["ART5"]?>
		</a></p></li>
		<li><p><a href="/<?=$language?>/press/art6">
		<?=$lang["ART6"]?>
		</a></p></li>
		</ul>
	</div>
	<div class="top-news">
		<div class="top-news-view">
			<?=$data[1]['text']?>
			<a href="/<?=$language?>/press/topnews"><p><?=$lang["MORE"]?></p></a>			
		</div>			
	</div>
	
</div>
<div class="cont">
	<div class="diler">
	<?php
		if(isset($_SESSION['login'])){
			require_once('application/inc/diler_on.php');
		}else require_once('application/inc/diler_off.php');
	?>
	</div>
	<div class="partner">
		<ul>
			<li><a href="http://wds.ua/"><image src="/images/wds.png"/><a/></li>
			<li><a href="http://www.vorne.su/"><image src="/images/Vorne.png"/><a/></li>
			<li><a href="http://www.g-u.com/"><image src="/images/gu.png"/><a/></li>
			<li><a href="http://miroplast.com/"><image src="/images/miroplast.jpg"/><a/></li>

		</ul>
	</div>
</div>	
