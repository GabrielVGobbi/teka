<!doctype html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Cadastro Cliente</title>

    <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/jquery/dist/jquery.min.js"></script>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/checkout/">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/assets/css/bootstrapPage.css">
    <script>
        var BASE_URL_PAINEL = '<?php echo BASE_URL_PAINEL; ?>';
    </script>
</head>

<body class="bg-light">
    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="<?php echo BASE_URL; ?>app/assets/imagens/logo2.png" alt="" width="72" height="72">
            <h2>CONSULTORIA
                DE IMAGEM &
                ESTILO</h2>
            <p class="lead">Todas as etapas do processo tem como finalidade a criação de uma
                imagem que satisfaça os seus objetivos, respeitando suas características
                pessoais e mantendo sua identidade.</p>
        </div>
        <div class="row">

            <div class="col-md-12 order-md-1">
                <h4 class="mb-3">Entrevista</h4>
                <form class="needs-validation" novalidate action="<?php echo BASE_URL_PAINEL; ?>clientes/action/" method="POST">
                <input type="hidden"  class="form-control" name="id" id="id" value="<?php echo $tableInfo['id_client']; ?>">
                    
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="cli_nome">Nome</label>
                            <input type="text" class="form-control" name="cli_nome" id="cli_nome" placeholder="" value="<?php echo $tableInfo['cli_nome']; ?>" required>
                            <div class="invalid-feedback">
                                Nome Invalido.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="sobrenome">Sobrenome</label>
                            <input type="text" class="form-control" name="cli_sobrenome" id="sobrenome" placeholder="" value="<?php echo $tableInfo['cli_sobrenome']; ?>" required>
                            <div class="invalid-feedback">
                                Sobrenome Invalido.
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="cli_nascimento">Data de Nascimento</label>
                            <input type="text" class="form-control" name="cli_nascimento" id="cli_nascimento" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" value="<?php echo $tableInfo['cli_aniversario']; ?>" required>
                            <div class="invalid-feedback">
                                Data Invalida.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cli_profissao">Profissão (Opcional)</label>
                            <input type="text" class="form-control" name="cli_profissao" id="cli_profissao" placeholder="" value="<?php echo $tableInfo['cli_profissao']; ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control" name="cep" id="cep" placeholder="0000-000" size="10" value="<?php echo $tableInfo['cep']; ?>" maxlength="9" required onblur="pesquisacep(this.value);" data-inputmask="'mask': ['99999-999']" data-maskrequired>
                        <div class="invalid-feedback">
                            Coloque seu cep
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="rua">Rua</label>
                        <input type="text" class="form-control" name="rua" id="rua" placeholder="" value="<?php echo $tableInfo['rua']; ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="numero">Nº</label>
                            <input type="text" class="form-control" name="numero" id="numero" placeholder="" value="<?php echo $tableInfo['numero']; ?>" required>
                            <div class="invalid-feedback">
                                Precisamos saber o numero
                            </div>
                        </div>

                        <div class="col-md-9 mb-3">
                            <label for="complement0">Complemento</label>
                            <input type="text" class="form-control" name="complemento" id="complemento" value="<?php echo $tableInfo['complemento']; ?>" placeholder="">
                        </div>
                    </div>
                    <div class="mb-4"></div>
                    
                    <h4 class="mb-4">Perguntas</h4>

                    <div class="row">
                        <?php foreach ($perguntas as $per): ?>
                            <div class="col-md-12 mb-3">
                                <label for="<?php echo $per['clip_pergunta']; ?>"><?php echo $per['clip_pergunta']; ?></label>
                                <input type="text" class="form-control" name="entrevista[<?php echo $per['clip_pergunta']; ?>]" id="<?php echo $per['clip_pergunta']; ?>" placeholder="Resposta: " value="">
                                <div class="invalid-feedback">
                                    
                                </div>
                            </div>
                        <?php endforeach; ?>
                        
                    </div>

                    <hr class="mb-4 ">
                    <button class="col-md-3 btn btn-primary btn-lg btn-block float-left" type="submit">Criar</button>
                </form>
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2017-2019 Stephani Varella</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Sobre</a></li>
                <li class="list-inline-item"><a href="#">Termos</a></li>
                <li class="list-inline-item"><a href="#">Contato</a></li>
            </ul>
        </footer>
    </div>

    <script>
        (function() {
            'use strict'

            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation')

                // Loop over them and prevent submission
                Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault()
                            event.stopPropagation()

                        }
                        form.classList.add('was-validated')
                    }, false)
                })
            }, false)
        }())

        $(function() {

            $("#etapas_select").change(function(event) {
                $('.etps-price').empty();

                var id_etapas = $('#etapas_select').val();
                var html = '';
                var total = 0;

                if (id_etapas != '') {
                    $.ajax({

                        url: BASE_URL_PAINEL + 'ajax/getEtapasById',
                        type: 'POST',
                        data: {
                            id_etapa: id_etapas
                        },
                        dataType: 'json',
                        success: function(json) {

                            if (json.length != 0) {
                                for (var i = 0; i < json.length; i++) {

                                    var price = new Intl.NumberFormat('pt-BR', {
                                        style: 'currency',
                                        currency: 'BRL'
                                    }).format(json[i].etp_price)
                                    total += parseInt(json[i].etp_price);
                                    result = new Intl.NumberFormat('pt-BR', {
                                        style: 'currency',
                                        currency: 'BRL'
                                    }).format(total)

                                    html += '<li class="list-group-item d-flex justify-content-between lh-condensed ">'
                                    html += '   <div>'
                                    html += '       <h6 class="my-0">' + json[i].etp_nome + '</h6>'
                                    html += '       <small class="text-muted">DURAÇÃO ' + json[i].etp_hours + ' HORA</small>'
                                    html += '   </div>'
                                    html += '   <span class="text-muted">' + price + '</span>'
                                    html += '</li>'

                                }

                                html += '<li class="list-group-item d-flex justify-content-between lh-condensed ">'
                                html += '   <div>'
                                html += '       <h6 class="my-0">Total: ' + result + '</h6>'
                                html += '   </div>'
                                html += '</li>'

                                $('.etps-price').append(html);

                            }
                        },
                    });
                } else {
                    $('.etps-price').append(html);
                }

            });



        });

        function validateClienteDouble(nome, id) {
            var nome = $('#Login').val();

            $.ajax({
                url: BASE_URL_PAINEL + 'ajax/ValidateClienteDouble',
                type: 'POST',
                data: {
                    nome: nome
                },
                dataType: 'json',
                success: function(json) {
                    $(document).ready(reload(json));
                },
            });
        }

        function reload(data) {
            if (data == true) {
                alert('ja existe um login ');
                $('#Login').val('');

            } else {

            }
        }



        function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value = ("");

        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                //Atualiza os campos com os valores.
                document.getElementById('rua').value = (conteudo.logradouro);


            } //end if.
            else {
                //CEP não Encontrado.
                limpa_formulário_cep();
                toastr.error('cep não encontrado');
            }
        }

        function pesquisacep(valor) {

            //Nova variável "cep" somente com dígitos.
            var cep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    document.getElementById('rua').value = "consultando";

                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = '//viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);


                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    toastr.error('tem um numero a mais no cep');
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        };
    </script>

    <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/dist/js/adminlte.min.js"></script>
    <script src="<?php echo BASE_URL; ?>app/assets/css/AdminLTE-2.4.5/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="<?php echo BASE_URL; ?>app/assets/js/script.js"></script>
    <script src="<?php echo BASE_URL; ?>node_modules/toastr/build/toastr.min.js"></script>

</body>

</html>