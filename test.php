<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

if (empty($_SESSION)) {
    header("HTTP/1.1 403 Forbidden" );
    die;
}

if (!empty($_GET["name"])) {
	$path = './tests/'.$_GET['name'];
		if (file_exists($path)) {
			$tests = file_get_contents($path);
			$tests = json_decode($tests,true);
		} else {
			header("HTTP/1.0 404 Not Found");
			exit(1);
		}
}

$_SESSION['tests'] = $tests;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Пройди тест!</title>
</head>
<html>
<body>
	<h3><?php echo(stristr($_GET['name'],'.',true)) ?></h3>
	<form action="result.php" method="POST">
	<?php  foreach ($tests as $test) {?>
		<fieldset>
		<legend><?php echo $test['question'];?></legend>
		<?php foreach ($test['answers'] as $key => $answer ){ ?>
			<label><input type="radio" name="<?php echo $test['title'];?>" value="<?php echo $key;?>"><?php echo $answer['text']; ?></label>
		<?php } ?>
		</fieldset>
		<?php } ?>	
		<input type="submit" value="Результат">
		<input type="hidden" name="testname" value="<?php echo(stristr($_GET['name'],'.',true)) ?>">
	</form>
	<div><a href="index.php">На главную</a></div>
	<div><a href="list.php">К списку тестов</a></div>
</body>
</html>




