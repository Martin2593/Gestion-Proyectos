<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Conocenos</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="brand">Restaurante "El Mexicanito"</div>
    <div class="address-bar">666 Hidalgo | Col. Independencia | Celaya Gto.</div>


    <!-- Navigation -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                <a class="navbar-brand" href="index.html">Business Casual</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                     <li>
                        <a href="index.php">Inicio</a>
                    </li>
                    <li>
                        <a href="about.php">Conocenos</a>
                    </li>
                    <li>
                        <a href="platillos.php">Productos</a>
                    </li>
                    <li>
                        <a href="reservacion.php">Reservaciones</a>
                    </li> 
                     <li>
                    <?php
                     // 1# INICIAR SESION
                     session_start();
                     if(isset($_SESSION['nombre']))
                        echo('<a href="login.php">Logout</a>');
                     else
                        echo('<a href="logout.php">Login</a>');
                    ?>                        
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Has tu reservación
                        <strong>ahora mismo</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-md-6">
                    <img class="img-responsive img-border-left" src="img/slide-6.jpg" alt="">
                </div>
                <div class="col-md-6">
                    <p>This is a great place to intro.</p>
                    <p>Lid est laborum dolo.</p>
                    <p>Sed ut perspiciatis.</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Realizar
                        <strong>Reservación</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-xs-6 col-md-4 col-md-offset-4">
                    <form role="form">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input type="email" class="form-control" id="exampleInputEmail1">
                      <br>
                      <label for="exampleInputPassword1">N&uacute;mero de Personas</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Ingresa el número de personas que vendrán">
                      <br>
                      <label for="exampleInputPassword1">Tel&eacute;fono</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" >
                      <br>


                  <div class="col-xs-6 col-md-4 col-md-offset-8">
                    <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                      Horario 8:00 hrs
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">9:00 hrs</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">10:00 hrs</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">11:00 hrs</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">12:00 hrs</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">13:00 hrs</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">14:00 hrs</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">15:00 hrs</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">16:00 hrs</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">17:00 hrs</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">18:00 hrs</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">19:00 hrs</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">20:00 hrs</a></li>
                      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">21:00 hrs</a></li>
                    </ul>
                  </div>  
                </div>
 
                    <button type="submit" class="btn btn-default">Hacer reservación</button>
                  </form>
                </div> 
                
                <div class="clearfix"></div>
            </div>
        </div>

    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
