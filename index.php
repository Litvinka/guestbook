<?php
	include "guestbook_message.php";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="styles/reset.css" type="text/css" rel="stylesheet">
<link href="styles/style.css" type="text/css" rel="stylesheet">
<title>Гостевая книга</title>
</head>

<body>
	<header>
		<h2>Гостевая книга</h2>
	</header>

	<article>
		<?php 
			$num=($step-1)*10; //количество записей на странице
			for($i=0;$i<10 && $num<$count;++$i) { ?>
				<section>
					<p>
						<span class="name"><?php echo $ms[$i]->guestName; ?></span>
						<span class="date"><?php echo $ms[$i]->messageDate;  ?></span>
					</p>
					<p class="message">
						<?php echo $ms[$i]->message; ?> 
					</p>
					<?php if(!empty($ms[$i]->image)){ ?>
						<img class="image" src="<?php echo $ms[$i]->image; ?>"/>
					<?php 
					} ?>
				</section>
		<?php
			$num++;}
		?>
		<section class="pageNav">
			<?php include "pageNav.inc.php"; ?>
		</section>
	</article>

	<form method="POST" enctype="multipart/form-data">
		<label>Имя<span class="star">*</span>  <span class="comment"> 
		<?php if(isset($_POST['guest'])){echo $com['guest'];} ?></span>
		</label>
		<p><input type="text" name="guest" value="<?php if(isset($_POST['guest'])){echo $guest;} ?>"></p>
		<p><label>Текст<span class="star">*</span>  <span class="comment">
			<?php if(isset($_POST['text'])){echo $com['text'];} ?>
		</span></label></p>
		<p><textarea rows="6" name="text" style="resize:none"><?php if(isset($_POST['text'])){echo $text;} ?></textarea>
		</p>
		<label>Изображение  <span class="comment">
			<?php if(isset($_POST['photo'])){echo $com['photo'];} ?>
		</span></label>
		<p><input type="file" name="photo" id="photo" accept="image/*,image/jpeg"></p>
		<input type="submit" name="submit" class="submit" value="добавить">
	</form>

	<footer>
	</footer>
<script>

</script>
</body>