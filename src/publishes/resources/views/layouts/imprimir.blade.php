<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ config('sistema.titulo') }}</title>
    <link href="{{ asset('css/imprimir.css') }}" rel="stylesheet" type="text/css"/>
    @yield('style')
</head>
<body>

<table cellspacing="0" cellpadding="0" class="sem-borda" width="100%">
    <tbody>
    <tr>
        <td style="text-align: left">
            {{--<img src="{{ URL::asset('img/sestexto.png') }}" width="150">--}}
        </td>
        <td>
            <span><strong style="font-size: 14px;">Sistema</strong></span>
            <br>
            <span>{{ config('sistema.titulo') }}</span>
            <br><br>
            EMITIDO EM {{ date('d/m/Y H:i:s') }}
        </td>
        <td style="text-align: right;">
            {{--<img style="margin-top: 15px;" src="{{ URL::asset('img/governotexto.png') }}" width="150">--}}
        </td>
    </tr>
    </tbody>
</table>
<hr/>

@if (isset($titulo))
    <p style="text-align: center;font-size: 16px;">
        <strong> {{ $titulo }}</strong>
    </p>
@endif

<div class="row">
    @yield('conteudo')
    <footer>
        <table cellspacing="0" cellpadding="0" class="sem-borda" width="100%">
            <tbody>
            <tr>
                <td style="text-align: left">
                    @if ($tipo !== 'xls' && $tipo !== 'pdf')
                        <div>
                            <button onclick="history.go(-1);" class="btn btn-primary nao_imprimir">
                                <i class="fa fa-arrow-left"> </i> Voltar
                            </button>
                        </div>
                        <br>
                    @endif
                </td>
                <td>
                    <p class="page">Fonte: {{ Request::root() }} - {{ date('d/m/Y') }} {{ date('H:i:s') }}</p>
                </td>
                <td style="text-align: right">
                    @if ($tipo !== 'xls' && $tipo !== 'pdf')
                        <div>
                            <button onclick="window.print();" class="btn btn-primary nao_imprimir">
                                <i class="fa fa-print"> </i> Imprimir
                            </button>
                        </div>
                        <br>
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
    </footer>
</div>

<script>
    window.print();
</script>

</body>
</html>