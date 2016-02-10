<div class="text">
	<h1><?=$lang["SEARCH"]?></h1> 
	<p>
		<?php
			if(!empty($data)){
				foreach($data as $value){
					echo "<a href='/".$language."/".$value['controller']."'>".$value['title']."</a><br/>";
				}
			}else echo "<p>Поиск не дал результатов</p>";
		?>
	</p>
</div>