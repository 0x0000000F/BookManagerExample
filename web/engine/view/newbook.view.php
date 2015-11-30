<?php if(!defined("IN_RULE")) die ("Oops"); ?>

<?php if (!empty($message)) : ?> <div class="alert alert-warning"><?php echo $message; ?></div><?php endif; ?>

<div class="masthead">
        <h3 class="text-muted">Newbook</h3>
        <nav>
          <ul class="nav nav-justified">
            <li><a href="/index.php">Список книг</a></li>
            <li class="active"><a href="?p=newbook">Добавить книгу</a></li>
            <li ><a href="/exit.php">Выйти</a></li>
          </ul>
        </nav>
</div>

<form class="form-horizontal" role="form" method="post" action="?p=newbook">
  <div class="form-group">
    <label for="inputSelect" class="col-sm-2 control-label">Выберите автора</label>
    <div class="col-sm-10">
    		<select class="form-control" id="inputSelect" name="authorid">
				<?php if (!empty($authors)) : ?>
				<?php foreach($authors as $ech) : ?>
			  		<option value="<?php echo $ech['id']; ?>"><?php echo $ech['firstname'].' '.$ech['lastname'] ; ?></option>			   
				<?php endforeach; ?>
				<?php endif; ?>
			</select>
    </div>
  </div>
  <div class="form-group">
    <label for="name" class="col-sm-2 control-label">Название книги</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="name" name="name" placeholder="название книги">
    </div>
  </div>
  <div class="form-group">
    <label for="name" class="col-sm-2 control-label">Дата выхода книги</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="datetimepicker" name="dateto" data-format="y-m-d">
    </div>
  </div>
  <div class="form-group">
    <label for="preview" class="col-sm-2 control-label">Картинка превью</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="preview" name="preview" placeholder="путь к картинке">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" name="newbook">Добавить</button>
    </div>
  </div>
</form>

			  <script type="text/javascript">
			    $(function () {
			      $('#datetimepicker').datetimepicker({format: 'YYYY-MM-DD',language: 'ru'});
			    });
			  </script>



<div class="clear"></div>