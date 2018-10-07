$(document).ready(function(){

	$("#form-signin").submit(function(e){
		e.preventDefault(); // прибиваю по умолчанию сабмин..сабмин это перезагрузка страницы..запрещаем передачу данных

		var login = $.trim($("#login").val()); // берем данные с логина
		var password = $.trim($("#password").val());

		if(login == '' || password == '') {
			$("img.profile-img").attr("src", "/Assets/images/user-error.png");
			//$("img.profile-img").attr("src", "/mvc/cabinet/Assets/images/user-error.png"); // подменяем картинку..берем атрибут src и заменяем его на новый
		} else {
			$("img.profile-img").attr("src", "/Assets/images/user-ok.png");
			//$("img.profile-img").attr("src", "/mvc/cabinet/Assets/images/user-ok.png");
			$(this).unbind().submit(); // unbind() Открепление обработчиков событий от элементов..разрешаем передачу данных
		}

	});


});