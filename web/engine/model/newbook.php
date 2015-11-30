<?php
if(!defined("IN_RULE")) die ("Oops");

$title = 'Newbook';
$authors = getAuthorList($pdo);

if (isset ($_POST['newbook']) ) 			{$message = newbook($pdo); }

function newbook($dblink) {
	$authorid 		= filter_input(INPUT_POST, 'authorid', FILTER_SANITIZE_NUMBER_INT);
	$name 			= filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
	$dateto 		= filter::date($_POST['dateto']);
	$preview 		= filter::allowedURL($_POST['preview'], array('www.litmir.co','litmir.co'));	

	if ($authorid == FALSE) 	{$message =  "Не выбран автор.";}
	if ($name == FALSE) 		{$message =  "Не указано название книги.";}
	if ($dateto == FALSE) 		{$message =  "Не указана дата издания.";}
	if ($preview == FALSE) 		{$message =  "Укажите полный путь к превью (с http://).";}



	if ($authorid != FALSE && $name != FALSE && $dateto != FALSE && $preview != FALSE ) {
	    if ($stm = $dblink->prepare("SELECT COUNT(id) AS cnt FROM authors WHERE id=?")) {
			$stm->execute(array($authorid)); $row = $stm->fetch();  $stm = NULL; 
			$countAuthors 	= $row['cnt'];
	    }
	    if ($countAuthors > 0) {

			if ($stm = $dblink->prepare("INSERT INTO books (name, author_id, preview, date, date_create) VALUES (?,?,?,?,NOW())")) {
				$stm->execute(array($name,$authorid,$preview,$dateto));
				$insert_id = $dblink->lastInsertId();
				$message =  "Книга добавлена, ее ID: ".$insert_id;

				$stm = NULL; 
			} 
		} else $message =  "Такого автора не существует";
	}
	return $message;
}

function getAuthorList($dblink) {
	if ($stm = $dblink->prepare("SELECT * FROM authors ORDER BY id ASC")) {
	    $stm->execute(array($uid)); 
	    $i=1; 
	    while($row = $stm->fetch()) { 
			$authors[$i]['id'] 			= $row['id'];
			$authors[$i]['firstname'] 	= $row['firstname'];
			$authors[$i]['lastname'] 	= $row['lastname'];
			$i++;
	    }
	    $stm = NULL;
	}
	return $authors;
}



?>