<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin page</title>
</head>
<body>
	<?php include('header.php')?>
	<div class="content">
		<?php 
			if(isset($_GET['page'])){
				$page = $_GET['page'];
				$chunk = explode('_', $page);
				if($chunk[1] == 'serials'){
					$display = 'Serial/'.$page.'.php';
					include($display);
					
				}else if($chunk[1] == 'apps'){
					$display = 'App/'.$page.'.php';
					include($display);
					
				}else if($chunk[1] == 'student'){
					$display = 'Student/'.$page.'.php';
					include($display);
					
				}else if($chunk[1] == 'schedule'){
					$display = 'Student/'.$page.'.php';
					include($display);
					
				}else if($chunk[1] == 'sales'){
					$display = 'Student/'.$page.'.php';
					include($display);
				}else if($chunk[1] == 'score'){
					$display = 'Student/'.$page.'.php';
					include($display);
					
				}


			}else{
				$display = 'home.php';
				include($display);
			}
		?>
	</div>
  
</body>

</html>