@extends('layouts.master')
@section('title')
Восстановление пароля
@endsection
@section('styles')

@endsection
@section('content')
    <section class="page-header">
        <div class="page-header__bg"
            style="background-image: url({{ asset('/images/backgrounds/bg1.jpg') }});"></div>
        <!-- /.page-header__bg -->
        <div class="container">
            <h2> Личный кабинет </h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('index') }}">Главная</a></li>
                <li>/</li>
                <li><span>Забыли пароль?</span></li>
            </ul><!-- /.thm-breadcrumb list-unstyled -->
        </div><!-- /.container -->
    </section><!-- /.page-header -->


    <div class="login-register-area pt-95 pb-100 mt-60 mb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto gray-border-all pl-30 pr-30">

                    <h4 class="mt-30"> Восстановление пароля </h4>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email">
                                Email
                            </label>

                            <input class="" id="email" type="email" name="email" required="required"
                                autofocus="autofocus" value="{{ old('email') }}">
                        </div>

                        <div class="button-box mt-50">
                            <button type="submit" class="thm-btn">Продолжить</button>
                        </div>
                    </form>
                    <div class="title-horizontal-line mt-30">
                        <span>
                            Новый пользователь?
                        </span>
                    </div>
                    <div class="button-box mt-30 mb-40">
                        <button onclick="window.location.href='{{ route('register') }}'" type="submit"
                            class="thm-btn">Зарегистрироваться</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

@endsection
