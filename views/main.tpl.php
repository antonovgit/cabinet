<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $pageData['title']; ?></title>
	<!-- <meta name="vieport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="/mvc/cabinet/Assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/mvc/cabinet/Assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="/mvc/cabinet/Assets/css/style.css"> -->
	<link rel="stylesheet" href="/Assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="/Assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="/Assets/css/style.css">
</head>
<body>
	
	<header></header>

	<div id="content">
            <div class="container-fluid table-block">
                <div class="row table-cell-block">
                    <div class="col-sm-6 col-md-6">
                        <h1 class="text-center login-title">Вход</h1>
                        <div class="account-wall">
                            <img class="profile-img" src="/Assets/images/user-login.png" alt="">
                            <form method="post" class="form-signin" id="form-signin" name="form-signin">
                            <input type="hidden" name="action" value="login"> 
                                <?php if(!empty($pageData['loginError'])) :?>
                                    <p><?php echo $pageData['loginError']; ?></p>
                                <?php endif; ?>
                                <input type="text" name="login" class="form-control" id="login" placeholder="Логин" required autofocus>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Пароль" required>
                                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Вход"/>
                            </form>
                        </div> 
                        </div>
                        <div class="col-sm-6 col-md-6">
                        <h1 class="text-center login-title">Регистрация</h1>
                        <div class="account-wall">
                            <form method="post" class="form-signin" id="form-reg" name="form-reg">
                            <input type="hidden" name="action" value="register">
                                <?php if(!empty($pageData['registerMsg'])) :?>
                                    <p><?php echo $pageData['registerMsg']; ?></p>
                                <?php endif; ?>
                                <input type="text" name="fullName" class="form-control" id="regFullName" placeholder="ФИО" required>
                                <input type="text" name="login" class="form-control" id="regLogin" placeholder="Логин" required>
                                <input type="email" name="email" class="form-control" id="regEmail" placeholder="Email" required>
                                <input type="password" name="password" class="form-control" id="regPassword" placeholder="Пароль" required>
                                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Регистрация"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

	<footer>
		
	</footer>


	<!-- <script src="/mvc/cabinet/Assets/js/jquery-3.3.1.min.js"></script>
	<script src="/mvc/cabinet/Assets/js/bootstrap.min.js"></script>
	<script src="/mvc/cabinet/Assets/js/angular.min.js"></script>
	<script src="/mvc/cabinet/Assets/js/script.js"></script> -->
	<script src="/Assets/js/jquery-3.3.1.min.js"></script>
	<script src="/Assets/js/bootstrap.min.js"></script>
	<script src="/Assets/js/angular.min.js"></script>
	<script src="/Assets/js/script.js"></script>


</body>
</html>