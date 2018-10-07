<!DOCTYPE html>
<html lang="ru" data-ng-app="profile">

<head>

    <meta charset="utf-8">
    <base href="/cabinet/products/">
	<!-- <base href="/mvc/cabinet/cabinet/products/"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $pageData['title']; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="/Assets/css/bootstrap.min.css" rel="stylesheet">
	<!-- <link href="/mvc/cabinet/Assets/css/bootstrap.min.css" rel="stylesheet"> -->

    <!-- MetisMenu CSS -->
    <link href="/Assets/css/admin/metisMenu.min.css" rel="stylesheet">
	<!-- <link href="/mvc/cabinet/Assets/css/admin/metisMenu.min.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <link href="/Assets/css/admin/sb-admin-2.css" rel="stylesheet">
	<!-- <link href="/mvc/cabinet/Assets/css/admin/sb-admin-2.css" rel="stylesheet"> -->

    <!-- Morris Charts CSS -->
    <link href="/Assets/css/admin/morris.css" rel="stylesheet">
	<!-- <link href="/mvc/cabinet/Assets/css/admin/morris.css" rel="stylesheet"> -->
	
    <!-- Custom Fonts -->
    <link href="/Assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- <link href="/mvc/cabinet/Assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Кабинет</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="/cabinet/profile"><i class="fa fa-user fa-fw"></i> Профиль</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="/cabinet/logout"><i class="fa fa-sign-out fa-fw"></i> Выйти</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a href="/cabinet"><i class="fa fa-area-chart"></i> Статистика</a>
                        </li>
                        <li>
                            <a href="/cabinet/products"><i class="fa fa-cart-plus"></i> Товары</a>
                        </li>
                        <li>
                            <a href="/cabinet/users"><i class="fa fa-user-o"></i> Пользователи</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper" data-ng-controller="profileController">
   			<div class="row">
   				<div class="col-md-12">
   					<h2><?php echo $pageData['title']; ?></h2>
					<?php //var_dump($pageData['userInfo']) // http://imagizer.imageshack.com/img921/513/JNMAri.jpg ?>
   					<form class="form-horizontal" method="post" data-ng-submit="saveProfileData()">
   						<input type="hidden" name="userId" id="userId" value="<?php echo $pageData['userInfo']['id']; ?>">
   						<fieldset>
   							<div class="form-group">
   								<label for="login" class="col-md-4 control-label">Логин</label>
   								<div class="col-md-4">
   									<input class="form-control input-md" required="true" type="text" id="login" name="login" value="<?php echo $pageData['userInfo']['login']; ?>">
   								</div>
   							</div>

   							<div class="form-group">
   								<label for="login" class="col-md-4 control-label">Email</label>
   								<div class="col-md-4">
   									<input class="form-control input-md" required="true" type="email" id="email" name="email" value="<?php echo $pageData['userInfo']['email']; ?>">
   								</div>
   							</div>

   							<div class="form-group">
   								<div class="col-md-offset-4 col-md-8">
   									<button id="save" name="save" class="btn btn-success">Сохранить</button>
   								</div>
   							</div>
   						</fieldset>
   					</form>
   				</div>
   			</div>

   			<div class="row">
   				<div class="col-md-12">
   					<h2>Сменить пароль</h2>
   					<form class="form-horizontal" method="post" data-ng-submit="updatePassword()">
   						<input type="hidden" name="userId" id="userId" value="<?php echo $pageData['userInfo']['id']; ?>">
   						<fieldset>
   							<div class="form-group">
   								<label for="newPass" class="col-md-4 control-label">Новый пароль</label>
   								<div class="col-md-4">
   									<input class="form-control input-md" data-ng-model="newpass" required="true" type="password" id="newpass" name="newpass" value="">
   								</div>
   							</div>

   							<div class="form-group">
   								<label for="repeatPass" class="col-md-4 control-label">Повторите пароль</label>
   								<div class="col-md-4">
   									<input class="form-control input-md" data-ng-model="repeatpass" required="true" type="password" id="repeatPass" name="repeatPass" value="">
   								</div>
   							</div>

   							<div class="form-group">
   								<div class="col-md-offset-4 col-md-8">
   									<button id="update" name="update" class="btn btn-success">Обновить</button>
   								</div>
   							</div>
   						</fieldset>
   					</form>
   				</div>
   			</div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/Assets/js/jquery-3.3.1.min.js"></script>
	<!-- <script src="/mvc/cabinet/Assets/js/jquery-3.3.1.min.js"></script> -->

    <!-- Bootstrap Core JavaScript -->
    <script src="/Assets/js/bootstrap.min.js"></script>
	<!-- <script src="/mvc/cabinet/Assets/js/bootstrap.min.js"></script> -->

	<!-- Angular framework -->
    <script src="/Assets/js/angular.min.js"></script>
	<!-- <script src="/mvc/cabinet/Assets/js/angular.min.js"></script>  --> 

    <script src="/Assets/js/admin/profile.js"></script>  
    <!-- <script src="/mvc/cabinet/Assets/js/admin/profile.js"></script> --> 

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/Assets/js/admin/metisMenu.js"></script>
	<!-- <script src="/mvc/cabinet/Assets/js/admin/metisMenu.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="/Assets/js/admin/sb-admin-2.js"></script>
	<!-- <script src="/mvc/cabinet/Assets/js/admin/sb-admin-2.js"></script> -->

</body>

</html>