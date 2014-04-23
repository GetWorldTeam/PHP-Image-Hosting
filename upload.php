<?php

$uploaddir = 'uploadimages/'; // это папка, в которую будет загружаться картинка
$blacklist = array(".php", ".phtml", ".php3", ".php4");     //Здесь код на проверку расширения
 foreach ($blacklist as $item) {
  if(preg_match("/$item\$/i", $_FILES['userfile']['name'])) {
   $a=false;
   exit;
   };}; 
   
if (file_exists('counter.txt')) {$counter=file_get_contents('counter.txt');  // Грузим счетчик изображений
$counter++; }; //Увеличиваем значение на 1

$f_counter=fopen('counter.txt', "w");
fwrite($f_counter,$counter);  //Записываем полученное значение
fclose($f_counter);
$apend=$counter.'.jpg'; // это имя, которое будет присвоенно изображению	

$uploadfile = "$uploaddir$apend"; // в переменную $uploadfile будет входить папка и имя изображения
if($_FILES['userfile']['size'] != 0 and $_FILES['userfile']['size']<=1024000) { // Здесь мы проверяем размер если он более 1 МБ
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) { // Здесь идет процесс загрузки изображения
$size = getimagesize($uploadfile); // с помощью этой функции мы можем получить размер пикселей изображения
if ($size[0] < 601 && $size[1]<5001) { // если размер изображения не более 600 пикселей по ширине и не более 5000 по высоте
echo '<meta http-equiv="refresh" content="0"; url=./?id='.$counter.'">';//Редерикт на страницу с изображением
//Cоздание Превью
if (!isset($q)) $q = 100;
$f=$uploaddir.$apend; //Имя файла из которого создается превью
$src = imagecreatefromjpeg($f); 
$w_src = imagesx($src); 
$h_src = imagesy($src);
$h = 128; // пропорциональная шириной 128 
//Вычисление попорций
$ratio = $h_src/$h; 
$w_dest = round($w_src/$ratio); 
$h_dest = round($h_src/$ratio); 
$dest = imagecreatetruecolor($w_dest,$h_dest); 
       $img_mini = 'uploadimages/'.$counter.'_2.jpg'; 
imagecopyresized($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src); 
imageJpeg($dest, $img_mini);

//Конец создания превью

}else {echo "Размер пикселей превышает допустимые нормы (ширина не более - 600 пикселей, высота не более 5000)";
unlink($uploadfile); // удаление файла
}
} else {echo "Файл не загружен, верьнитель и попробуйте еще раз";}
}else { echo "Размер файла не должен превышать 1000Кб";}


?>
