<?php
	//var_dump($pageData); // http://picsee.net/upload/2018-02-16/56d96274e3f7.png
	//7
	//var_dump($pageData); // http://picsee.net/upload/2018-02-16/671fca136453.png
	// 9
	//var_dump($pageData); // http://imagizer.imageshack.com/img921/6843/z0YS2Q.jpg
?>
<!DOCTYPE html>
<!-- <html lang="en"> -->
<html lang="ru">

<head>

    <meta charset="utf-8">
	<base href="/cabinet/products/">
	<!-- <base href="/mvc/cabinet/cabinet/products/"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo $pageData['title']; ?></title>

    <!-- Bootstrap Core CSS -->
   <!-- <link href="/mvc/cabinet/Assets/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="/Assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <!-- <link href="/mvc/cabinet/Assets/css/admin/metisMenu.min.css" rel="stylesheet"> -->
    <link href="/Assets/css/admin/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <!-- <link href="/mvc/cabinet/Assets/css/admin/sb-admin-2.css" rel="stylesheet"> -->
    <link href="/Assets/css/admin/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <!-- <link href="/mvc/cabinet/Assets/css/admin/morris.css" rel="stylesheet"> -->
    <link href="/Assets/css/admin/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
   <!-- <link href="/mvc/cabinet/Assets/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
    <link href="/Assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                        <li><a href="/cabinet/profile"><i class="fa fa-user fa-fw"></i> Профиль</a></li>
						<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="/cabinet/logout"><i class="fa fa-sign-out fa-fw"></i> Выйти</a></li>
                        <!-- <li><a href="/mvc/cabinet/cabinet/logout"><i class="fa fa-sign-out fa-fw"></i> Выйти</a></li> -->
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
                            <!-- <a href="/mvc/cabinet/cabinet"><i class="fa fa-area-chart"></i> Статистика</a> -->
                        </li>
						<li>
                            <a href="tables.html"><i class="fa fa-money"></i> Заказы</a>
                        </li>
                        <li>
                            <a href="/cabinet/products"><i class="fa fa-cart-plus"></i> Товары</a>
                            <!-- <a href="/mvc/cabinet/cabinet/products"><i class="fa fa-cart-plus"></i> Товары</a> -->
                        </li>
                        <li>
                            <a href="/cabinet/users"><i class="fa fa-user-o"></i> Пользователи</a>
                            <!-- <a href="/mvc/cabinet/cabinet/users"><i class="fa fa-user-o"></i> Пользователи</a> -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- <div id="page-wrapper"> -->
        <div id="page-wrapper" data-ng-app="products" data-ng-controller="productsController">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Товары</h1>
					<!-- {{myData}}  // http://imagizer.imageshack.com/img923/6500/Whhe2L.jpg -->
					<a href="add" data-ng-click="addProduct()" class="btn btn-success back"><i class="fa fa-plus"></i> Добавить товар</a><br><br>
                </div>
                <!-- /.col-lg-12 -->
				
				<div class="col-lg-12" data-ng-view></div>
				
            </div>
            <!-- /.row -->
<!--             <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
										<?php //echo $pageData['ordersCount']; ?>
                                    </div>
                                    <div>заказов</div>
                                </div>
                            </div>
                        </div>
						<a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-cart-plus fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
										<?php //echo $pageData['productsCount']; ?>
                                    </div>
                                    <div>товаров</div>
                                </div>
                            </div>
                        </div>
						<a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
										<?php //echo $pageData['usersCount']; ?>
                                    </div>
                                    <div>пользователей</div>
                                </div>
                            </div>
                        </div>
						<a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div> -->
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Товары
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
							<!-- <a href="add" data-ng-click="addProduct()" class="btn btn-success back"><i class="fa fa-plus"></i> Добавить товар</a><br><br> -->
			
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>id товара</th>
                                                    <th>Наименование товара</th>
                                                    <th>Цена</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!--<tr>
													<td>1</td>
													<td>110000</td>
													<td>Абзалов Камиль</td>
													<td>mail@kamil-abzalov.ru</td>
												</tr>
												<tr>
													<td>2</td>
													<td>30000</td>
													<td>Иван Иванов</td>
													<td>mail@kamil-abzalov.ru</td>
												</tr>-->
												<?php /* foreach ($pageData['orders'] as $key => $value) {
                                                	echo "<tr>";
                                                		echo "<td>" . $value['id'] . "</td>";
                                                		echo "<td>" . $value['total'] . "</td>";
                                                		echo "<td>" . $value['fullName'] . "</td>";
                                                		echo "<td>" . $value['email'] . "</td>";
                                                	echo "</tr>";
                                                } */
                                                ?>
												<?php
                                                    //foreach ($pageData['products'] as $key => $value) { 
                                                    foreach ($pageData['productsOnPage'] as $key => $value) { 
													?>
                                                        <tr>
                                                            <td><?php echo $value['id']; ?></td>
                                                            <!-- <td><a href="<?php //echo $value['id']; ?>"><?php //echo $value['name']; ?></a></td> -->
															<td><a data-ng-click="getInfoByProductId(<?php echo $value['id']; ?>)" href="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></td>
                                                            <td><?php echo $value['price']; ?></td>
                                                        </tr>
                                                    <?php } ?>
											</tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
							
							<div class="row">
								<div class="col-md-12 text-center">
									<?php echo $pageData['pagination']; ?>
								</div>
							</div>
							
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
            </div>
            <!-- /.row -->
			
			<div class="row">
                <div class="col-lg-12">
                    <h2>Загрузить CSV файл с товарами</h2>
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
                        <label for="exampleInputFile">Загрузите CSV файл</label>
                        <input type="file" name="csv">
                        <button class="btn btn-default">Загрузить</button>
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
    <script src="/Assets/js/angular-route.js"></script>  
    <script src="/Assets/js/angular-ui-router.js"></script>  
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/1.0.20/angular-ui-router.js"></script> -->  
    <!-- <script src="/mvc/cabinet/Assets/js/angular.min.js"></script>  
    <script src="/mvc/cabinet/Assets/js/angular-route.js"></script> -->

    <script src="/Assets/js/admin/app.js"></script>  
    <!-- <script src="/mvc/cabinet/Assets/js/admin/app.js"></script> -->  
	
    <!-- Metis Menu Plugin JavaScript -->
	<script src="/Assets/js/admin/metisMenu.js"></script>
    <!-- <script src="/mvc/cabinet/Assets/js/admin/metisMenu.js"></script> -->

    <!-- Custom Theme JavaScript -->
	<script src="/Assets/js/admin/sb-admin-2.js"></script>
    <!-- <script src="/mvc/cabinet/Assets/js/admin/sb-admin-2.js"></script> -->

</body>

</html>