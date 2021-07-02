<?php
//"./youthClub.php"=>"Молодежный клуб РГО",
//"./general.php"=>"Общее собрание",

	$menu=array
	(
		"./news.php"=>"Новости",
		"./events.php"=>"События",
		"./expeditions.php"=>"Экспедиции",
		"./council.php"=>"Заседания Совета",
		"./grants.php"=>"Гранты",
		"./books.php"=>"Издания",
		"./photos.php"=>"Фото",
		"./suggestNews.php"=>"Предложения"
	);

	$width=900/count($menu);

	foreach($menu as $link=>$description)
	{
		?>
		<a href="<?php echo $link?>" style="float:left;width:<?php echo $width; ?>px"><div align="center" style="font-size:20px"><?php echo $description;?></div></a>
		<?php
	}
?>
<div style="clear:both"></div>
