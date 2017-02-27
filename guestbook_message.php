<?php
	include_once "db.inc.php";

	$error=false;
	$path='C:/xampp/htdocs/guestbook/image/';
	$com=array(); //массив для комментариеы
	$requared=['guest','text']; //обязательные поля для заполнения
	if($_POST && isset($_POST['submit'])){//если данные были отправлены методом $_POST
		if(!empty($_POST['guest'])){//поле имени 
			$guest=htmlspecialchars(trim($_POST['guest']));
			$com['guest']="";
		}
		else{
			$guest="";
			$com['guest']="Введите имя!";
			$error=true;
		}

		if(!empty($_POST['text'])){//поле сообщения 
			$text=htmlspecialchars(trim($_POST['text']));
			$com['text']="";
		}
		else{
			$text="";
			$com['text']="Введите сообщение!";
			$error=true;
		}

		if(!empty($_FILES['photo']['name'])){//поле изображения
			if (!copy($_FILES['photo']['tmp_name'], $path.$_FILES['photo']['name'])){
				$com['photo']="Ошибки с загрузкой изображения!";
				$error=true;
			}
			else{
				$com['photo']='Изменения сохранены!';
				$url=substr($path,26). $_FILES['photo']['name'];
			}
		}
		else{
			$url="";
		}

		if(!$error){
			$sql = "INSERT INTO messages (GuestName, Message, Image) VALUES(:guest, :text, :photo)"; // если нет ошибок, данные добавляются в бд
			$stmt = $pdo->prepare($sql);                                
			$stmt->bindParam(':guest', $guest, PDO::PARAM_STR);       
			$stmt->bindParam(':text', $text, PDO::PARAM_STR);    
			$stmt->bindParam(':photo', $url, PDO::PARAM_STR);    
			$stmt->execute(); 
			$guest="";
			$text="";
			$url="";
		}

	}


	if(!$_GET){ //если данные не были отправлены методом GET
		$step=1;
	}
	else{
		$step=$_GET['step'];
	}
	$url='index.php';
	$sql='SELECT COUNT(ID) as count FROM messages';
	$count=$pdo->query($sql)->fetch();
	$count=$count['count'];
	$countNum=($count)/10; //количество записей

	class MESSAGE{ //класс для записей
		public $guestName;
		public $message;
		public $messageDate;
		public $image;

		//конструктор для класса MESSAGE
		function __construct($guestName, $message, $messageDate, $image){
			$this->guestName=$guestName;
			$this->message=$message;
			$this->messageDate=$messageDate;
			$this->image=$image;
		}
	}
	$inp=($step-1)*10; 
	$sql="SELECT * FROM messages ORDER BY MessageDate DESC LIMIT :start, 10 "; //запрос на получение записей для нужной страницы
	$STH = $pdo->prepare($sql);   
    $STH->bindParam(':start', $inp, PDO::PARAM_INT); 
    $STH->execute(); 
    $str=$STH->fetchAll(PDO::FETCH_ASSOC);
	for($i=0;$i<count($str);++$i){ //сохранение нужных записей в массив
		$ms[]=new MESSAGE($str[$i]['GuestName'],$str[$i]['Message'],$str[$i]['MessageDate'],$str[$i]['Image']);	
	}
?>