<?php
if(!defined("IN_RULE")) die ("Oops");

$title 		= 'Books';
if (isset ($_POST['delbook']) ) 			{$message = delbook($pdo); }
$authors 	= getAuthorList($pdo);
$books 		= getBooksList($pdo);

function delbook($dblink) {
	$delid 		= filter_input(INPUT_POST, 'delbook', FILTER_SANITIZE_NUMBER_INT);
	if ($delid == FALSE) 	{$message =  "Не указана книга.";}

	if ($delid != FALSE ) {
		if ($stm = $dblink->prepare("DELETE FROM books WHERE id=?")) {
			$stm->execute(array($delid));
			$message =  "Книга удалена";
			$stm = NULL; 
		} 
	}
	return $message;
}

function makeSearchQuery() {
	$searchAuthor 	= filter_input(INPUT_COOKIE, 'searchAuthor', FILTER_VALIDATE_INT);
	$searchName 	= filter_input(INPUT_COOKIE, 'searchName', FILTER_SANITIZE_SPECIAL_CHARS);
	$searchFrom 	= filter::date($_COOKIE['searchFrom']);
	$searchTo 		= filter::date($_COOKIE['searchTo']);
	if ($searchFrom == FALSE) 	$searchFrom = '0000-00-00';
	if ($searchTo == FALSE) 	$searchTo = date('Y-m-d');

	if ($searchAuthor == FALSE) {
		$query = "SELECT * FROM books WHERE date>'$searchFrom' AND date<'$searchTo' AND name LIKE '%$searchName%' ORDER BY id ASC";
	} else {
		$query = "SELECT * FROM books WHERE date>'$searchFrom' AND date<'$searchTo' AND author_id='$searchAuthor'
				AND name LIKE '%$searchName%' ORDER BY id ASC";
	}

	//$query = "SELECT * FROM books WHERE name LIKE '%$searchName%'  ORDER BY id ASC";
	return $query;
}

function getBooksList($dblink) {
	$query = makeSearchQuery();
	if ($stm = $dblink->prepare($query)) {
	    $stm->execute(); 
	    $i=1; 
	    while($row = $stm->fetch()) { 
			$books[$i]['id'] 			= $row['id'];
			$books[$i]['name'] 			= $row['name'];
			$books[$i]['preview'] 		= $row['preview'];
			$books[$i]['author'] 		= getAuthorById($row['author_id'], $dblink);
			$books[$i]['date'] 			= date("d F Y", strtotime($row['date']));
			$books[$i]['date_create'] 	= user::cuteDate($row['date_create']);
			$i++;
	    }
	    $stm = NULL;
	}
	return $books;
}

function getAuthorList($dblink) {
	if ($stm = $dblink->prepare("SELECT * FROM authors ORDER BY id ASC")) {
	    $stm->execute(); 
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

function getAuthorById($author_id, $dblink) {
	if ($stm = $dblink->prepare("SELECT firstname, lastname FROM authors WHERE id=?")) {
		$stm->execute(array($author_id)); $row = $stm->fetch(); $stm = NULL;
		$author	= $row['firstname']." ".$row['lastname']; 
	}
	return $author;	
}




?>