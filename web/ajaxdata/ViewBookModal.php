<?php
session_start();
//error_reporting(0);
define("IN_RULE", TRUE);
include_once('../engine/autoload.php');
$bid 		= filter_input(INPUT_POST, 'bid', FILTER_SANITIZE_NUMBER_INT);			
if ($bid == FALSE) 	{$message =  "Ошибка выбора книги";}

function getBook($bid, $dblink) {
	global $bookname, $author_id, $bookpreview, $bookdate, $bid;

    if ($stm = $dblink->prepare("SELECT * FROM books WHERE id=?")) {
			$stm->execute(array($bid)); $row = $stm->fetch();  $stm = NULL; 
	}
	$out['name'] 		= $row['name'];
	$out['author'] 		= getAuthorById($row['author_id'], $dblink);
	$out['preview'] 	= $row['preview'];
	$out['date'] 		= $row['date'];
	$out['date_create'] 	= $row['date_create'];
	$out['date_update'] 	= $row['date_update'];

	return $out;
}
function getAuthorById($author_id, $dblink) {
	if ($stm = $dblink->prepare("SELECT firstname, lastname FROM authors WHERE id=?")) {
		$stm->execute(array($author_id)); $row = $stm->fetch(); $stm = NULL;
		$author	= $row['firstname']." ".$row['lastname']; 
	}
	return $author;	
}

$book = getBook($bid, $pdo);

?>

<?php if (!empty($message)) : ?> <div class="alert alert-warning"><?php echo $message; ?></div><?php endif; ?>

<div class="col-md-4">
	<div class="modal-body next">
		<img draggable="false" title="Фантомы" src="<?php echo $book['preview']; ?>" class="img-responsive" alt="preview">
	</div>
</div>
<div class="col-md-8">
	<div class="modal-body next" style="padding-left:50px;">
		<b>Название:</b> 				<?php echo $book['name']; ?> </br>
		<b>Автор:</b> 					<?php echo $book['author']; ?> </br>
		<b>Дата издания:</b> 			<?php echo $book['date']; ?> </br>
		<b>Добавлено (дата):</b> 		<?php echo $book['date_create']; ?> </br>
		<b>Отредактировано:</b> 		<?php echo $book['date_update']; ?> </br>
	</div>
</div>


