<?php
require_once 'functions.php';

if (empty($_SESSION)) {
    header("HTTP/1.1 403 Forbidden" );
    die;
}

$dir  = 'tests';
if(is_dir($dir)) { 
	$files = scandir($dir); 
	array_shift($files);
	array_shift($files);
	}

foreach($files as $file) {
	if (file_exists($dir.'/'.$file)) {
		if (isset($_GET['delete'])) {
			unlink($dir.'/'.$_GET['delete']);
		}
	}
	break;
}
 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Список тестов</title>
</head>
<body>
	<?php if (!empty($_SESSION['user'])) { ?>
		<h1>Добро пожаловать <?php  echo $_SESSION['user']['username']; ?></h1>
	<?php } else {?>
		<h1>Добро пожаловать <?php  echo $_SESSION['guest']; ?></h1>
	<?php } ?>
	<h2>Выберите тест</h2>
	<table cellspacing="2" border="1" cellpadding="5" width="600">
	<?php for($i=0; $i<sizeof($files); $i++) {      
		if (file_exists($dir.'/'.$files[$i])) { ?>
		<tr>
			<td><?php echo 'Тест № '.(string)($i+1);?></td>
			<td><a href="test.php?name=<?php echo $files[$i]; ?>" title="перейти к тесту"><?php echo $files[$i]; ?></a></td>
			<?php if (!empty($_SESSION['user'])) : ?>
			<td><a href="list.php?delete=<?php echo $files[$i]; ?>">Удалить тест</a></td>
		<?php endif; ?>
		</tr>
	<?php } } ?>
	</table>
	<?php if (!empty($_SESSION['user'])) : ?>
	<div><a href="admin.php">Добавить тест</a></div>
	<?php endif; ?>
	<div><a href="index.php">На главную</a></div>
	<div><a href="logout.php">Выход</a></div>
</body>
</html>
