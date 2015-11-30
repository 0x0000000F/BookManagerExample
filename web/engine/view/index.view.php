<?php if(!defined("IN_RULE")) die ("Oops"); ?>
<div class="masthead">
        <h3 class="text-muted">Books</h3>
        <nav>
          <ul class="nav nav-justified">
            <li class="active"><a href="/index.php">Список книг</a></li>
            <li ><a href="?p=newbook">Добавить книгу</a></li>
            <li ><a href="/exit.php">Выйти</a></li>
          </ul>
        </nav>
      </div>

<div id="featured">
	<div class="row">
	  <div class="col-md-10">
		<div class="row">
		  <div class="col-md-5">
		    <select class="form-control" id="search_author" name="search_author">
		    	<option>автор</option>
				<?php if (!empty($authors)) : ?>
				<?php foreach($authors as $ech) : ?>
			  		<option value="<?php echo $ech['id']; ?>"><?php echo $ech['firstname'].' '.$ech['lastname'] ; ?></option>			   
				<?php endforeach; ?>
				<?php endif; ?>
			</select>
		  </div>
		  <div class="col-md-5">
		  	<input type="text" class="form-control" id="search_name" name="search_name" placeholder="название книги">
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-2">Дата выхода книги: </div>
		  <div class="col-md-3"><input type="text" class="form-control" id="datetimepicker1" name="search_from"> </div>
		  <div class="col-md-2">до </div>
		  <div class="col-md-3"><input type="text" class="form-control" id="datetimepicker2" name="search_to"> </div>
		</div>
	  </div>
	  <div class="col-md-2">
	  	<button type="button" class="btn btn-default" onclick="SaveSearch();">искать</button>
	  </div>
	</div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Превью</th>
                <th>Автор</th>
                <th>Дата выхода книги</th>
                <th>Дата добавления</th>
                <th>Кнопки действий</th>
            </tr>
        </thead>
        <tbody>
			<?php if (!empty($books)) : ?>
			<?php foreach($books as $ech) : ?>
	            <tr>
	                <td><?php echo $ech['id']; ?></td>
	                <td><?php echo $ech['name']; ?></td>
	                <td>
						<div class="preview">
							<a href="<?php echo $ech['preview']; ?>" title="<?php echo $ech['name']; ?>" data-gallery>
								<img src="<?php echo $ech['preview']; ?>" class="img-responsive" alt="preview">
							</a>
						</div>
	                </td>
	                <td><?php echo $ech['author']; ?></td>
	                <td><?php echo $ech['date']; ?></td>
	                <td><?php echo $ech['date_create']; ?></td>
	                <td>
	                	<a href="?p=editbook&b=<?php echo $ech['id']; ?>"><button type="button" class="btn btn-default btn-xs">ред</button></a>
	                	<button type="button" class="btn btn-info btn-xs" onclick="ViewBookModal('<?php echo $ech['id']; ?>');">просм</button>
	                	<button type="button" class="btn btn-danger btn-xs" onclick="modal('delbook','<?php echo $ech['name']; ?>','<?php echo $ech['id']; ?>','delete');">удл</button>
	                </td>
	            </tr>		   
			<?php endforeach; ?>
			<?php endif; ?>


        </tbody>
    </table>

<!-- The Bootstrap Image Gallery lightbox, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body next"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left prev">
                        <i class="glyphicon glyphicon-chevron-left"></i>
                        Previous
                    </button>
                    <button type="button" class="btn btn-primary next">
                        Next
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clear"></div>
<div id="disabled_page"></div>
<div id="delete" class="featured_boxes boxes_fix form">
    <div >
	    <form method="post" action="">
		<h4>Подтвердите удаление книги</h4>
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-book" aria-hidden="true"></span></span>
		  <input type="text" class="form-control" id="delbook" aria-describedby="basic-addon1" disabled>
		  <input type="hidden" name="delbook" id="delbookid" >
		</div>
		<br><div class="clear"></div>
		<div> 
			<input type="button" value="Отменить удаление" class="btn btn-success" onclick="hideForm('delete');">
			<input type="submit" value="Удалить книгу" name="del" class="btn btn-danger">
		</div>
	    </form>
    </div>
</div>

<div id="desc" class="modal form">
    <div class="modal-mydialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-hidden="true" onclick="hideForm('desc');">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="row" id="view_desc">

            </div>
            
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<script src="js/bootstrap-image-gallery.min.js"></script>
<script type="text/javascript">
	$(function () {
	    $('#datetimepicker1').datetimepicker({format: 'YYYY-MM-DD',language: 'ru'}); 
	    $('#datetimepicker2').datetimepicker({format: 'YYYY-MM-DD',language: 'ru'});
	});
	getSavedSearch();
</script>