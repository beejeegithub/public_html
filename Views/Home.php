<div style="padding-left: 50px; padding-right: 50px;">
			<br />
			<h3 align="center">Task менеджер</h3>
			<br />
			<div align="left" style="margin-bottom: 5px;">
				<a href="/authorization">Вход в панель управления</a>
			</div>
			<div align="right" style="margin-bottom: 5px;">
				<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Добавить</button>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th class="order_by_name order asc" value="name" style="cursor: pointer;">Имя пользователя</th>
							<th class="order_by_email order asc" value="email" style="cursor: pointer;">Email</th>
							<th>Описание задачи</th>
							<th class="order_by_success order asc" value="success" style="cursor: pointer;">Статус</th>
							<th>Отредактировано администратором</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	    <?php
	    $db = mysqli_connect("localhost","cm50155_0","SVNZH42C", "cm50155_0");
	    $page_limit = 3;
	    $res = mysqli_query($db, "SELECT COUNT(*) FROM records");
	    $row = mysqli_fetch_row($res);
	    $total_text = $row[0];
	    $page = ceil($total_text / $page_limit);

	    echo '<div class="text-center">';
	    for ($i = 1; $i <= $page; $i++){
	    echo '<ul class="pagination">
        <li><span class="page" value="'.$i.'" style="cursor: pointer;">'.$i.'</span></li>
        </ul>';
	    }
	    echo '</div>';
	    ?>
<div id="apicrudModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="api_crud_form">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Добавить</h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="form-group">
			        	<label>Введите логин</label>
			        	<input type="text" name="name_user" id="name_user" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>Введите email</label>
			        	<input type="email" name="text_email" id="text_email" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>Описание задачи</label>
			        	<textarea name="text_description" id="text_description" class="form-control" /></textarea>
			        </div>
			    </div>
			    <div class="modal-footer">
			    	<input type="hidden" name="hidden_id" id="hidden_id" />
			    	<input type="hidden" name="action" id="action" value="insert" />
			    	<input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Insert" />
			    	<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
	      		</div>
			</form>
		</div>
  	</div>
</div>

<script>
$(document).ready(function(){

	$.fn.toggleAttr = function(name, value1, value2) {
		this.attr(name, this.attr(name) == value1 ? value2 : value1);
		return this;
	};

	$(document).on("click", ".order_by_name", function() {
		$(this).toggleAttr('order', 'ASC', 'DESC')
		$(this).toggleClass("asc");
		$(this).toggleClass("desc");
	}
	);

	$(document).on("click", ".order_by_email", function() {
		$(this).toggleAttr('order', 'ASC', 'DESC')
		$(this).toggleClass("asc");
		$(this).toggleClass("desc");
	}
	);

	$(document).on("click", ".order_by_success", function() {
		$(this).toggleAttr('order', 'ASC', 'DESC')
		$(this).toggleClass("asc");
		$(this).toggleClass("desc");
	}
	);

	function fetch_data()
	{
		$.ajax({
				url: "/task/fetchuser.php",
				success: function(data) {
					$('tbody').html(data);
				}
		}
		);

		$(document).on("click", ".order_by_name", function() {
		var order_by_name = $(this).attr("value");
		var order_by_name_asc_or_desc = $(this).attr("order");
		$(this).addClass("active");
		$(".order_by_email").removeClass("active");
		$(".order_by_success").removeClass("active");

		var action = "fetch";
			$.ajax({
				url: "/task/fetchuser.php",
				method: "POST",
				data: {order_by_name: order_by_name, order_by_name_asc_or_desc: order_by_name_asc_or_desc, action: action},
				success: function(data) {
					$('tbody').html(data);
				}
			}
			);
		}
		);

		$(document).on("click", ".order_by_email", function() {
		var order_by_email = $(this).attr("value");
		var order_by_email_asc_or_desc = $(this).attr("order");
		$(this).addClass("active");
		$(".order_by_name").removeClass("active");
		$(".order_by_success").removeClass("active");

		var action = "fetch";
			$.ajax({
				url: "/task/fetchuser.php",
				method: "POST",
				data: {order_by_email: order_by_email, order_by_email_asc_or_desc: order_by_email_asc_or_desc, action: action},
				success: function(data) {
					$('tbody').html(data);
				}
			}
			);
		}
		);

		$(document).on("click", ".order_by_success", function() {
		var order_by_success = $(this).attr("value");
		var order_by_success_asc_or_desc = $(this).attr("order");
		$(this).addClass("active");
		$(".order_by_email").removeClass("active");
		$(".order_by_name").removeClass("active");

		var action = "fetch";
			$.ajax({
				url: "/task/fetchuser.php",
				method: "POST",
				data: {order_by_success: order_by_success, order_by_success_asc_or_desc: order_by_success_asc_or_desc, action: action},
				success: function(data) {
					$('tbody').html(data);
				}
			}
			);
		}
		);

		$(document).on("click", ".page", function() {
		var page = $(this).attr("value");
		var action = "page";
		var order_by_name;
		var order_by_name_asc_or_desc;
		var order_by_email;
		var order_by_email_asc_or_desc;
		var order_by_success;
		var order_by_success_asc_or_desc;

		if ($(".order_by_name").hasClass("active")) {
		order_by_name = $(".order_by_name").attr("value");
		order_by_name_asc_or_desc = $(".order_by_name").attr("order");
	    }
	    if ($(".order_by_email").hasClass("active")) {
		order_by_email = $(".order_by_email").attr("value");
		order_by_email_asc_or_desc = $(".order_by_email").attr("order");
	    }
	    if ($(".order_by_success").hasClass("active")) {
		order_by_success = $(".order_by_success").attr("value");
		order_by_success_asc_or_desc = $(".order_by_success").attr("order");
	    }
			$.ajax({
				url: "/task/fetchuser.php",
				method: "POST",
				data: {page: page, order_by_name: order_by_name, order_by_name_asc_or_desc: order_by_name_asc_or_desc, order_by_email: order_by_email, order_by_email_asc_or_desc: order_by_email_asc_or_desc, order_by_success: order_by_success, order_by_success_asc_or_desc: order_by_success_asc_or_desc, action: action},
				success: function(data) {
					$('tbody').html(data);
				}
			}
			);
		}
		);
	}

	fetch_data();
	
	$('#add_button').click(function(){
		$('#name_user').val('');
		$('#text_email').val('');
		$('#text_description').val('');
		$('#action').val('insert');
		$('#button_action').val('Добавить');
		$('.modal-title').text('Добавить задачу');
		$('#apicrudModal').modal('show');
	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#name_user').val() == '')
		{
			alert("Введите логин");
		}
		else if($('#text_email').val() == '')
		{
			alert("Введите email");
		}
		else if($('#text_description').val() == '')
		{
			alert("Введите описание задачи");
		}
		else
		{
			var form_data = $(this).serialize();
			$.ajax({
				url: "/task/action.php",
				method: "POST",
				data: form_data,
				success: function(data)
				{
					location.reload();
					fetch_data();
					$('#api_crud_form')[0].reset();
					$('#apicrudModal').modal('hide');
					alert("Задача изменена");
				}
			});
		}
	});
}
);
</script>