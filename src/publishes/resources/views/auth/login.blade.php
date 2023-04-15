@extends('layouts.login_metronic')
@section('conteudo')
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" action="{{ route('login') }}" method="post" novalidate="novalidate">
        {{ csrf_field() }}
        <h3 class="form-title font-green">ENTRAR</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Informe seu login e senha. </span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off"
                   placeholder="Email" name="email"></div>
        @error('email')
        <span class="invalid-feedback alert-danger" role="alert">
                <strong>{{ $message }}</strong>
        </span>
        @enderror
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Senha</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off"
                   placeholder="Senha" name="password"></div>
        <div class="form-actions">
            <button type="submit" class="btn green uppercase">Login</button>
            <label class="rememberme check mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="remember">Lembrar
                <span></span>
            </label>
            <a href="javascript:;" id="forget-password" class="forget-password">Esqueceu a senha?</a>
        </div>

        <div class="create-account">
            {{--<p>
                <a href="{{route('register')}}" class="uppercase">Criar Conta</a>
            </p>--}}
        </div>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="{{route('password.email')}}" method="post" novalidate="novalidate">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <h3 class="font-green">Esqueceu a senha?</h3>
        <p> Entre com seu e-mail para resetar sua senha. </p>
        <div class="form-group">
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email"
                   name="email"></div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn green btn-outline">Voltar</button>
            <button type="submit" class="btn btn-success uppercase pull-right">Enviar</button>
        </div>
    </form>

    <!-- END FORGOT PASSWORD FORM -->



@endsection
