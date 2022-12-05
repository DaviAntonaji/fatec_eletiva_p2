<?php
include("Conexao.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
	<link rel="manifest" href="site.webmanifest">
	<link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">


    <title>Creative Corretora</title>


    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">


    <link href="css/bootstrap.min.css" rel="stylesheet">


    <link href="css/nifty.min.css" rel="stylesheet">


    <link href="premium/icon-sets/icons/line-icons/premium-line-icons.min.css" rel="stylesheet">
    <link href="premium/icon-sets/icons/solid-icons/premium-solid-icons.min.css" rel="stylesheet">

    <link href="css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    
    <link href="css/pace.min.css" rel="stylesheet">
    <script src="js/pace.min.js"></script>



    <link href="css/demo/nifty-demo.min.css" rel="stylesheet">


        
    <link href="plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
	<link href="plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css" rel="stylesheet">            
        
</head>


<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        
        <header id="navbar">
            <div id="navbar-container" class="boxed">

                <div class="navbar-header">
                    <a href="index.html" class="navbar-brand">
                        <img src="img/logo.png" alt="Logo" class="brand-icon">
                    </a>
                </div>


                <div class="navbar-content clearfix">
                    <ul class="nav navbar-top-links">

                        <li class="tgl-menu-btn">
                            <a class="mainnav-toggle" href="#">
                                <i class="pli-list-view icon-lg"></i>
                            </a>
                        </li>




                    </ul>
                    <ul class="nav navbar-top-links">


                        


                        <li id="dropdown-user" class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                <span class="ic-user pull-right">
                                    <i class="pli-male"></i>
                                </span>
                            </a>


                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right panel-default">
                                <ul class="head-list">
                               
                                    <li>
                                        <a href="sair.php"><i class="pli-unlock icon-lg icon-fw"></i> Sair</a>
                                        <a href="alterar-senha.php"><i class="pli-password-field icon-lg icon-fw"></i> Alterar senha</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        
                    </ul>
                </div>

            </div>
        </header>