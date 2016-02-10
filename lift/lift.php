<?php
$a = array(1,1);
$b = 0;
for($i=0; $i<count($a); $i++){
	$z[] = $b;
	if($a[$i] == 1){
		$b++;
	}else $b--;
	$z[] = $b;
}
$result = (max($z)+1)-min($z);
echo "В вашем доме ".$result." этажей";