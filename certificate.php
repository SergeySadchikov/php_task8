<?php
session_start();
// Тип содержимого
header('Content-Type: image/png');
header('Content-Disposition: attachment; filename="certificate.png"');

if (!empty($_SESSION['user'])) {
		$nick = $_SESSION['user']['username'];
	} else {
		$nick = $_SESSION['guest'];
	}


// Создание изображения
$im = imagecreatefrompng("images/example.png");

// Замена пути к шрифту на пользовательский
$font = 'fonts/arial.ttf';

// Создание цветов
$black = imagecolorallocate($im, 0, 0, 0);

// Текст надписи 1
$text = $nick;

$tb = imagettfbbox(30, 0, $font, $text);

// координата X
$x =  imagesx($im) / 2 - round(($tb[2] - $tb[0]) / 2);

// координата Y
$y = (imagesy($im) / 3);

// Текст 1
imagettftext($im, 30, 0, $x, $y, $black, $font, $text);

// Текст надписи 2
$text = 'Благодарим за прохождение теста '.$_GET['testname'];

$tb = imagettfbbox(20, 0, $font, $text);

// координата X
$x =  imagesx($im) / 2 - round(($tb[2] - $tb[0]) / 2);

// координата Y
$y = (imagesy($im) / 2);

// Текст 2
imagettftext($im, 20, 0, $x, $y, $black, $font, $text);

// Текст надписи 3
$text = 'Ваша оценка: '.$_GET['result'];

$tb = imagettfbbox(20, 0, $font, $text);

// координата X
$x =  imagesx($im) / 2 - round(($tb[2] - $tb[0]) / 2);

// координата Y
$y = (imagesy($im) / 1.5);

// Текст 3
imagettftext($im, 20, 0, $x, $y, $black, $font, $text);

imagepng($im);
imagedestroy($im);

?>
