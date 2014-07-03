<div class="container">
	<div class="row">
		<div class="span4 offset4 well">
			<legend>Требуется авторизация</legend>
			<div class="alert alert-error" style="display:{ERROR}">
				<a class="close" data-dismiss="alert" href="#">×</a>Неверное имя пользователя или пароль !
			</div>
			<form method="post" action="/auth" accept-charset="UTF-8">
				<input type="text" id="username" class="span4" name="username" placeholder="Имя пользователя">
				<input type="password" id="password" class="span4" name="password" placeholder="Пароль">
				<button type="submit" name="submit" class="btn btn-info btn-block">Войти</button>
			</form>
		</div>
    </div>
</div>
