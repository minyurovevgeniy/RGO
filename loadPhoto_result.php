<?php
	date_default_timezone_set('Asia/Yekaterinburg');
  $backURL='<a href="./createSquad.php">Попробовать ещё раз</a>';

  /*
  echo '<pre>';
  print_r($_FILES);
  echo '</pre>';
  */

  if ($_FILES['squad_icon']['type']!="image/jpeg")
  {
    echo $backURL;
    die("Формат файла должен быть JPEG!");
  }
  $fullFilePath=$_FILES['photo']['tmp_name'];


  include("./php/connect.php");

  $stmt=$pdo->prepare("SELECT `photo_src` FROM `photos` WHERE `photo_id`=?");
  $stmt->execute(array($squadId));
  $row=$stmt->fetch(PDO::FETCH_LAZY);
  $oldFilepath=$row['photo_src'];
  unlink($oldFilepath);

  $newFilename="./photos/".time().".jpeg";
  $newFilenameToDatabase="/photos/".time().".jpeg";

  $requiredWidth=100;
  $size=getimagesize($fullFilePath);

  /*
  echo '<pre>';
  print_r($size);
  echo '</pre>';
  */
  $scalingCoefficient=$requiredWidth/$size[0];
  $requiredHeight=$size[1]*$scalingCoefficient;


  $dst_x=0;
  $dst_y=0;
  $src_x=0;
  $src_y=0;
  $dst_w=(int)floor($requiredWidth);
  $dst_h=(int)floor($requiredHeight);
  $src_w=$size[0];
  $src_h=$size[1];


  //$newImage=imagecreate($dst_w,$dst_h);
  $newImage=imagecreatetruecolor($dst_w,$dst_h);


  //Другими словами, imagecopyresized() берет прямоугольный участок из src_image с шириной src_w и высотой src_h на координатах src_x,src_y и помещает его в прямоугольную область изображения dst_image с шириной dst_w и высотой dst_h на координатах dst_x,dst_y.

  $im = imagecreatefromjpeg($fullFilePath);
  imagecopyresized($newImage,$im,$dst_x,$dst_y,$src_x,$src_y,$dst_w,$dst_h,$src_w,$src_h);
  imagejpeg($newImage,$newFilename);



  $stmt=$pdo->prepare("INSERT photos SET `photo_public_link`=?, `photo_src`=? WHERE `photo_id`=?");
  $stmt->execute(array("http://rgo.xn--100-5cdnry0bhchmgqi5d.xn--p1ai.xn--100-5cdnry0bhchmgqi5d.xn--p1ai/".$newFilenameToDatabase,$newFilename));
  include("./php/disconnect.php");

  echo '<a href="./changeSquadIcon.php">Изменить ещё одну эмблему</a>';
  ?>
