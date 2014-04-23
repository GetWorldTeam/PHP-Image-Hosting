<?
if ($_GET['id']>0)
{
//Отображение изображений
$img_url1='uploadimages/'.$_GET['id'].'.jpg'; //URL 1-го 
$img_url2='uploadimages/'.$_GET['id'].'_2.jpg'; //URL  2-го
$content='<center>
<h2>Просмотр Изображения</h2>
<img src="'.$img_url1.'"><br>Cсылка на изображение: <input value="'.$img_url2.'"><br><br>	
<img src="'.$img_url2.'"><br>Cсылка на изображение: <input value="'.$img_url2.'"><br><br>	
</center>';

}else
    {
    $content='<form action="upload.php" method="post" ENCTYPE="multipart/form-data">
    <input name="userfile" type="file" >
    <input type="submit">
    ';	//Вывод формы
    };

include('template.php'); //Загружаем шаблон
?>
