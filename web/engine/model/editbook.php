<?php
if(!defined("IN_RULE")) die ("Oops");

$title = 'EditBook';
getBook($pdo); 
$authors = getAuthorList($author_id, $pdo);

if (isset ($_POST['editbook']) ) 			{$message = editbook($bid, $OkDomains, $pdo); }

function editbook($bid, $okdomains, $dblink) {
	$authorid 		= filter_input(INPUT_POST, 'authorid', FILTER_SANITIZE_NUMBER_INT);
	$name 			= filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
	$dateto 		= filter::date($_POST['dateto']);
	$preview 		= filter::allowedURL($_POST['preview'], $okdomains);	

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

			if ($stm = $dblink->prepare("UPDATE books SET date_update=NOW(), name=?, author_id=?, preview=?, date=? WHERE id=?")) {
				$stm->execute(array($name,$authorid,$preview,$dateto,$bid));
				$message =  "Книга отредактирована ";
				$stm = NULL; 
			} 
		} else $message =  "Такого автора не существует";
	}
	return $message;
}

function getBook($dblink) {
	global $bookname, $author_id, $bookpreview, $bookdate, $bid;
	$bid 		= filter_input(INPUT_GET, 'b', FILTER_SANITIZE_NUMBER_INT);
	if ($bid == FALSE) 	{$message =  "Не указана книга для редактирования";}
    if ($stm = $dblink->prepare("SELECT * FROM books WHERE id=?")) {
			$stm->execute(array($bid)); $row = $stm->fetch();  $stm = NULL; 
	}
	$bookname 		= $row['name'];
	$author_id 		= $row['author_id'];
	$bookpreview 	= $row['preview'];
	$bookdate 		= $row['date'];
	return $message;
}

function getAuthorList($author_id, $dblink) {
	if ($stm = $dblink->prepare("SELECT * FROM authors ORDER BY id ASC")) {
	    $stm->execute(array($uid)); 
	    $i=1; 
	    while($row = $stm->fetch()) { 
			$authors[$i]['id'] 			= $row['id'];
			$authors[$i]['author'] 		= $row['firstname'].' '.$row['lastname'] ;
			if ($author_id == $row['id']) $authors[$i]['selected'] 	= 'selected';
			$i++;
	    }
	    $stm = NULL;
	}
	return $authors;
}



?>