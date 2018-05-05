<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Milhas</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <script type="text/javascript" src="{{ PagSeguro::getUrl()['javascript'] }}"></script>
        <script>
            PagSeguroDirectPayment.setSessionId('{{ PagSeguro::startSession() }}');
        </script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="text-center">
                    Pagamentos com PagSeguro
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/" method="post" id="form">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input class="form-control" type="text" name="nome" id="nome">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input class="form-control" type="text" name="phone" id="phone">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="text" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input class="form-control" type="text" name="cpf" id="cpf">
                    </div>
                    <div class="form-group">
                        <label for="valor">Valor</label>
                        <input class="form-control" type="number" name="valor" id="valor">
                    </div>
                    <div class="form-group">
                        <label for="$paymentMethod">Metodo de Pagamento</label>
                        <select class="form-control" type="text" name="paymentMethod" id="paymentMethod">
                            <option value="boleto">Boleto</option>
                            {{--<option value="online_debit">Débito</option>--}}
                            {{--<option value="credit_card">Crédito</option>--}}
                        </select>
                    </div>
                    <input type="hidden" id="hash" name="hash">
                    <button type="button" onclick="submitForm()" class="btn btn-success">Avançar</button>
                    {{--<button type="button" onclick="pagar()" class="btn btn-success">Pagar</button>--}}
                </form>
            </div>
        </div>
        {{--$pagseguro->paymentLink--}}
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script type="text/javascript"
                src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js">
        </script>
        <script type="text/javascript">

            function submitForm() {
                $('#hash').val(PagSeguroDirectPayment.getSenderHash());
                $('#form').submit();
            }
            // var body = document.getElementsByTagName('body')[0];
            // body.addEventListener('load', alterarBotao, true);
            //
            // function alterarBotao(){
            //     $('.btn.finalize').html('Pagar');
            // }
            function pagar() {
                PagSeguroLightbox(PagSeguroDirectPayment.getSenderHash());
            }
        </script>
    </body>
</html>
