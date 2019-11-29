<!DOCTYPE html>
<html lang="pt" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
        <script>
        $( "#show" ).click(function() {
            $("#hidden").css("display","block");
        });

        $(function() {
                $(".btn-toggle").click(function(e) {
                        e.preventDefault();
                        el = $(this).data('element');
                        $(el).toggle();
                });
        });
        var basePath = 'checkout_busca_cliente.php'; // aqui eh a base da pagina
        window.onload = function(){
            document.getElementById('cliente').onchange = function(){
                window.location = basePath + '?sabor=' + this.value;
            }
        }
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
    </head>
    <style>
        html, body{
        height:100%;
        background: #fcfafa;
        }

        .container{
            display:table;
            height:100%;
        }
        
        .transacoes{
            
        }
        .container-inner{
            display:table-cell;
            vertical-align:middle;
        }

        .box-inner{
            max-width:365px;
            margin:0 auto;
            text-align:center;
        }

        header{
			background: #fff;
			color: #000 !important;
            padding-left: 40px !important;
            padding-right: 40px !important;
        }
        .centro{
            margin: 40px 15px 15px 30px;
            width: 350px;
        }
        .centro input{
            margin-top: 20px;
        }
        .hidden{
            display:none;
        }

        .reserva{
            margin-top: 40px;

        }

    </style>
    <body>
    <div class="container">
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <a class="navbar-brand text-dark fantasy" href="index.php">HOTELARIA</a>
       </div>