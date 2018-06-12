<?php
session_start(); 
if (empty($_SESSION['user'])) {
    header("HTTP/1.1 403 Forbidden" );
    die;
}

	if ((!empty($_FILES['testfile']['name'])) && array_key_exists('testfile', $_FILES)) {
		if ($_FILES['testfile']['type'] === 'application/json') {
			move_uploaded_file($_FILES['testfile']['tmp_name'], 'tests/'.basename($_FILES['testfile']['name']));
			header('Location: list.php');
		} else {
			echo "Данный формат файла не поддерживается !";
			echo '<div><a href="admin.php">Назад к загрузке</a></div>';
			exit;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Загрузка тестов</title>
</head>
<body>
<h2>Выбирите тест для загрузки</h2>
	<form action= "admin.php" method="POST" enctype="multipart/form-data">
		<div><input type=file name=testfile></div>
		<div><input type="submit" value="Загрузить тест"></div>
	</form>
	<hr>
	<div><a href="index.php">На главную</a></div>
	<div><a href="list.php">К списку тестов</a></div>

</body>
</html>
