<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alterar senha proxy</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        html,body{
            margin: 0;
            padding-top: 15px;
        }
        #logo-empresa{
            margin-top: 10px;
            height:60px;
        }
        #form-container{
            margin: 0 auto;
            background: #d9edf7;
            padding: 10px;
            border-radius: 5px;
            max-width: 450px;
        }
        label{
            margin-bottom: 0;
            font-size: 12px;
        }
        .title{
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            color: darkblue;
        }
        .form-group{
            margin-bottom: 5px;
        }
        .help-block-validator{
            margin-top: 0;
            margin-bottom: 2px;
            font-size: 11px;
        }
        #form-result{
            position: relative;
            text-align: center;
            height: 35px;
            margin-bottom: 10px;
            width: 100%;
        }
        .alert{
            padding: 5px;
            max-width: 450px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-xs-12" id="form-result">

            <?php
            ini_set('display_errors',1);
            if(isset($_POST['usuario']) && isset($_POST['senhaantiga']) && isset($_POST['novasenha']) && isset($_POST['novasenharepeat'])){

                $shellscript = "./alterpasswd.sh";

                $cmd="$shellscript " . $_POST['usuario'] . " " . $_POST['senhaantiga'] . " " . $_POST['novasenha'];

                exec($cmd, $output, $status);
                $result = $output[0];

                if($result=='true'){
                    echo '<div class="alert alert-success" role="alert"><strong>Senha alterada com sucesso!</strong></div>';
                }else{
                    echo '<div class="alert alert-danger" role="alert"><strong>Usuário ou senha inválido!</strong></div>';
                }
            }
            ?>
            </div>
            <div class="col-xs-12">
                <div id="form-container">
                    <form action="<?=$_SERVER['PHP_SELF']?>" method="post" id="form-changepassword">
                        <p class="title">Alteraçao de senha do proxy</p>
                        <div class="form-group">
                            <label for="usuario">Usuário</label>
                            <input type="text" name="usuario" id="usuario" class="form-control input-sm"/>
                        </div>

                        <div class="form-group">
                            <label for="senhaantiga">Senha antiga</label>
                            <input type="password" name="senhaantiga" id="senhaantiga" class="form-control input-sm"/>
                        </div>

                        <div class="form-group">
                            <label for="novasenha">Nova senha</label>
                            <input type="password" name="novasenha" id="novasenha" class="form-control input-sm"/>
                        </div>

                        <div class="form-group">
                            <label for="novasenharepeat">Repita a nova senha</label>
                            <input type="password" name="novasenharepeat" id="novasenharepeat" class="form-control input-sm"/>
                        </div>
                        <button type="submit" class="btn btn-primary center-block">Enviar</button>
                    </form>
                </div>
            </div>
            <div class="col-xs-12 text-center">
                <img src="#" alt="logo_empresa" class="img-responsive center-block" id="logo-empresa">

            </div>
        </div>

    </div>

    <script src="js/jquery.2.1.1.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>

    <script>
        $.validator.setDefaults({
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block help-block-validator',
            focusInvalid: true
        });
        $.extend( $.validator.messages, {
            required: "Campo obrigatório!",
            equalTo: "Senha não conferem",
	    minlength: "Quantidade minima {0} caracteres",
        });

        $('#form-changepassword').validate({
            rules: {
                usuario: {
                    required: true
                },
                senhaantiga:{
                    required:true
                },
                novasenha:{
                    required:true,
		    minlength:4
                },
                novasenharepeat:{
                    required:true,
                    equalTo:"#novasenha"
                }
            }
        });

    </script>
</body>
</html>
