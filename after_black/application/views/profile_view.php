<div class="form_registration">
	<img class="photo" src='/files/<?=$_SESSION['profile']['file']?>' width='200px'>
	<table class="profile">
		<tr>
			<td colspan='2'><h2><img src='/images/<?=$_SESSION['profile']['sex']?>.png' width='5%'><?=$_SESSION['profile']['surname'].' '.$_SESSION['profile']['name'].' '.$_SESSION['profile']['secondname']?></h2></td>			
		</tr>
		<tr>
			<td><?=$lang["BIRTHDAY"]?></td>
			<td><?=$_SESSION['profile']['birthday'].'.'.$_SESSION['profile']['birthmonth'].'.'.$_SESSION['profile']['birthyear']?></td>
		</tr>
		<tr>
			<td><?=$lang["ADRESS"]?></td>
			<td><?=$_SESSION['profile']['adress']?></td>
		</tr>
		<tr>
			<td><?=$lang["TEL"]?></td>
			<td><?=$_SESSION['profile']['tel']?></td>
		</tr>
	</table>
	
		<a href='/<?=$language?>/logout'><div class="sub_out"><?=$lang["OUT"]?></div></a>	
</div>