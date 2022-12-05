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


    <link href="css/pace.min.css" rel="stylesheet">
    <script src="js/pace.min.js"></script>



</head>

<body>
    <div id="container" class="cls-container">

        <div id="bg-overlay" class="bg-img" style="background-image: url(img/bg-img-3.jpg)"></div>


        <br><br><br><br><br><br><br><br>
        <div class="cls-content">
            <div class="cls-content-sm panel">
                <div class="panel-body">
                    <div class="mar-ver pad-btm">
                        <h1 class="h3">Creative Corretora</h1>
                    </div>
                    <form action="#">
                        <div class="form-group">
                            <input id="login" type="text" class="form-control" placeholder="Login" autofocus>
                        </div>
                        <div class="form-group">
                            <input id="senha" type="password" class="form-control" placeholder="Senha">
                        </div>

                        <button class="btn btn-primary btn-lg btn-block doAuth" type="button">Acessar</button>
                    </form>
                    <div style='margin-top:15px;'>
                        
                        <a href="cadastrar.php">Cadastrar-me</a>
                    </div>
                </div>


            </div>
        </div>
        <!--===================================================-->



    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->

    <!--jQuery [ REQUIRED ]-->
    <script src="js/jquery.min.js"></script>
    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="js/bootstrap.min.js"></script>


    <!--Nifty Admin [ RECOMMENDED ]-->
    <script src="js/nifty.min.js"></script>

    <script>
        function validacaoEmail(field) {
            usuario = field.substring(0, field.indexOf("@"));
            dominio = field.substring(field.indexOf("@") + 1, field.length);

            if ((usuario.length >= 1) &&
                (dominio.length >= 3) &&
                (usuario.search("@") == -1) &&
                (dominio.search("@") == -1) &&
                (usuario.search(" ") == -1) &&
                (dominio.search(" ") == -1) &&
                (dominio.search(".") != -1) &&
                (dominio.indexOf(".") >= 1) &&
                (dominio.lastIndexOf(".") < dominio.length - 1)) {
                return true;
            } else {
                return false;
            }
        }

        function Login() {
            var login = $("#login").val()
            var senha = $("#senha").val()
            var erro = ""
            if (!login) {
                erro = "Digite seu Login";
            }
            else if(!validacaoEmail(login)) {
                erro = "Digite um e-mail valido";
            }
            else
            if (!senha) {
                erro = "Digite sua Senha";
            }


            if (erro) {
                $.niftyNoty({
                    type: 'warning',
                    icon: 'fa fa-check',
                    message: "<b>ERRO</b>: " + erro,
                    container: 'floating',
                    timer: 5000
                });
            } else {
                $.post("auth.php", {
                    login: login,
                    senha: senha
                }, function(data) {
                    if (data == "ok") {
                        $.niftyNoty({
                            type: 'success',
                            icon: 'fa fa-check',
                            message: "Autenticação OK... redirecionando...",
                            container: 'floating',
                            timer: 3000
                        });
                        setInterval(function() {
                            document.location.href = 'painel.php';
                        }, 2000)
                    } else {
                        $.niftyNoty({
                            type: 'danger',
                            icon: 'fa fa-check',
                            message: "<b>ERRO</b>: " + data,
                            container: 'floating',
                            timer: 5000
                        });
                    }
                })
            }
        }

        $(document).ready(function() {

            $('#senha').on("keypress", function(e) {
                if (e.keyCode == 13) {
                    Login();
                }
            });

            $(".doAuth").click(function() {
                console.log("Auth");

                Login();


            })
        })
    </script>

</body>

</html>