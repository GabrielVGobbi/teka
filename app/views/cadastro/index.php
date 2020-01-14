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

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app\assets\css\AdminLTE-2.4.5\bower_components\bootstrap-tour\build\css\bootstrap-tour.min.css">

    <script src="<?php echo BASE_URL; ?>app\assets\css\AdminLTE-2.4.5\bower_components\bootstrap-tour\build\js/bootstrap-tour.min.js"></script>

    <script src="<?php echo BASE_URL; ?>app\assets\css\AdminLTE-2.4.5\bower_components\bootstrap-tour\build\js/bootstrap-tour-standalone.js"></script>


    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app\assets\css\AdminLTE-2.4.5\bower_components\bootstrap-tour\build\css\bootstrap-tour-standalone.css">

   
   
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
        <form class="needs-validation" novalidate action="<?php echo BASE_URL; ?>cadastro/action/" method="POST">

            <div class="row">

                <div class="col-md-4 order-md-2 mb-4" id="tur1">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Etapas</span>
                        <span class="badge badge-secondary badge-pill"></span>
                    </h4>
                    <div class=" mb-4">
                        <select class="select2" style="width: 100%;" placeholder="selecione as etapas" id="etapas_select" name="etapas[]" multiple="multiple">
                            <?php foreach ($etapas as $etp) : ?>
                                <option value="<?php echo $etp['id_etapa']; ?>"><?php echo $etp['etp_nome']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <ul class="list-group mb-3 etps-price">
                    </ul>
                </div>
                <div class="col-md-8 order-md-1">
                    <h4 class="mb-3">Faça seu cadastro</h4>

                    <input type="hidden" name="client" value="true">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cli_nome">Nome</label>
                            <input type="text" class="form-control" name="cli_nome" id="cli_nome" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Nome Invalido.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sobrenome">Sobrenome</label>
                            <input type="text" class="form-control" name="cli_sobrenome" id="sobrenome" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Sobrenome Invalido.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="cli_nascimento">Nascimento</label>
                            <input type="text" class="form-control" name="cli_nascimento" id="cli_nascimento" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Data Invalida.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="cli_telefone">Telefone</label>
                            <input type="text" class="form-control" name="cli_telefone" id="cli_telefone" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Data Invalida.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="cli_profissao">Profissão (Opcional)</label>
                            <input type="text" class="form-control" name="cli_profissao" id="cli_profissao" placeholder="" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="Login">Login</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="text" onblur="validateClienteDouble(this)" class="form-control" name="cli_login" id="Login" placeholder="login" required>
                                <div class="invalid-feedback" style="width: 100%;">
                                    Seu Login é invalido.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="Senha">Senha</label>
                            <div class="input-group">

                                <input type="text" class="form-control" name="cli_senha" id="Senha" placeholder="senha" required>
                                <div class="invalid-feedback" style="width: 100%;">
                                    Senha é Obrigatorio.
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted"></span></label>
                        <input type="email" class="form-control" name="cli_email" id="email" placeholder="nome@exemplo.com" required>
                        <div class="invalid-feedback">

                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control" name="cep" id="cep" placeholder="0000-000" size="10" maxlength="9" required onblur="pesquisacep(this.value);" data-inputmask="'mask': ['99999-999']" data-maskrequired>
                        <div class="invalid-feedback">
                            Coloque seu cep
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="rua">Rua</label>
                        <input type="text" class="form-control" name="rua" id="rua" placeholder="" readonly>

                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="numero">Nº</label>
                            <input type="text" class="form-control" name="numero" id="numero" placeholder="" required>
                            <div class="invalid-feedback">
                                Precisamos saber o numero
                            </div>
                        </div>

                        <div class="col-md-9 mb-3">
                            <label for="complement0">Complemento</label>
                            <input type="text" class="form-control" name="complemento" id="complemento" placeholder="">
                        </div>
                    </div>





                    <!--
                            <hr class="mb-4">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="same-address">
                            <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="save-info">
                            <label class="custom-control-label" for="save-info">Save this information for next time</label>
                        </div>
                            <hr class="mb-4">
                            <h4 class="mb-3">Payment</h4>

                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                                    <label class="custom-control-label" for="credit">Credit card</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                                    <label class="custom-control-label" for="debit">Debit card</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                                    <label class="custom-control-label" for="paypal">PayPal</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cc-name">Name on card</label>
                                    <input type="text" class="form-control" id="cc-name" placeholder="" required>
                                    <small class="text-muted">Full name as displayed on card</small>
                                    <div class="invalid-feedback">
                                        Name on card é invalido
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cc-number">Credit card number</label>
                                    <input type="text" class="form-control" id="cc-number" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Credit card number é invalido
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="cc-expiration">Expiration</label>
                                    <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Expiration date required
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="cc-cvv">CVV</label>
                                    <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Security code required
                                    </div>
                                </div>
                            </div>

                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Coloração + Closet</h6>
                                <small class="text-muted">DURAÇÃO 3 HORAS</small>
                            </div>
                            <span class="text-muted">R$ 1.500,00</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Revitalização + Looks</h6>
                                <small class="text-muted">DURAÇÃO 6 HORAS</small>
                            </div>
                            <span class="text-muted">R$ 2.700,00</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Closet ou Looks</h6>
                                <small class="text-muted">DURAÇÃO 3 HORAS</small>
                            </div>
                            <span class="text-muted">R$ 1.500,00</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Análise + Questionário + Dossiê</h6>
                                <small class="text-muted">DURAÇÃO 6 HORAS</small>
                            </div>
                            <span class="text-muted">R$ 2.700,00</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Coloração + Revitalização + Closet</h6>
                                <small class="text-muted">DURAÇÃO 7 HORAS</small>
                            </div>
                            <span class="text-muted">R$ 3.300,00</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">Mala Inteligente</h6>
                                <small class="text-muted">DURAÇÃO 3 HORAS</small>
                            </div>
                            <span class="text-muted">R$ 1.500,00</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Cupom</h6>
                                <small>EXAMPLECODE</small>
                            </div>
                            <span class="text-success">-$5</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (R$)</span>
                            <strong>R$ 20.000,00</strong>
                        </li>
                    -->
                    <hr class="mb-4 ">
                    <button id="tur2" class="col-md-3 btn btn-primary btn-lg btn-block float-left" type="submit">Criar</button>

                </div>
        </form>
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

            var tour = new Tour({
                steps: [{
                        element: "#tur1",
                        title: "Tur1",
                        content: "FUNCIFOU"
                    },
                    {
                        element: "#tur2",
                        title: "TUR2",
                        content: "FUNCIFOU"
                    }
                ]
            });

            // Initialize the tour
            //tour.init();

            // Start the tour
            //tour.start();

            $("#etapas_select").change(function(event) {
                $('.etps-price').empty();

                var id_etapas = $('#etapas_select').val();
                var html = '';
                var total = 0;

                if (id_etapas != '') {
                    $.ajax({

                        url: BASE_URL_PAINEL + 'account/getEtapasById',
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
                url: BASE_URL_PAINEL + 'account/ValidateClienteDouble',
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