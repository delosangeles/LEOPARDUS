@extends('layouts.auth')

@section('content')
<div class="user-login-5" style="">
    <div class="row bs-reset">
        <div class="col-md-6 bs-reset mt-login-5-bsfix">
            <div class="login-bg" style="background-image:url({{ asset('assets/img/login/bg1.jpg') }})">
                <a href="{{ url('/') }}"><img class="login-logo" src="{{ asset('assets/img/login/logo.png') }}" /></a>
            </div>
        </div>
        <div class="col-md-6 login-container bs-reset mt-login-5-bsfix">
            <div class="login-content" style="margin-top: 20%;">
                <h1>Identificate 
                    @if( isset($settings->enable_register) && $settings->enable_register ) o 
                    <a href="{{ route('register') }}" style="text-decoration: none;">Registraté</a>
                    @endif
                </h1>
                <p> Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy et nibh euismod aliquam erat volutpat. Lorem ipsum dolor sit amet, coectetuer adipiscing. </p>
                <form class="login-form" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <button class="close" data-close="alert"></button>
                                <span>
                                    <ul class="no-margin">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </span>
                            </div>
                            <br>
                        @endif

                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            <span><i>Completa todos los campos primero</i>.</span>
                        </div>

                        <div class="row" style="margin-bottom: 30px">
                            <div class="form-group no-margin">
                                <div class="col-xs-6">
                                        <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" value="{{ old('email') }}" placeholder="example@correo.com" name="email" required style="margin-bottom: 0px;" />                           
                                </div>
                            </div>    
                                
                            <div class="form-group no-margin">
                                <div class="col-xs-6">          
                                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="*******" name="password" required style="margin-bottom: 0px;" /> 
                                </div>
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="rem-password">
                                    <label class="rememberme mt-checkbox mt-checkbox-outline">
                                        <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }} /> Recordarme
                                        <span></span>
                                    </label>    
                                </div>
                            </div>
                            
                            <div class="col-sm-8 text-right">
                                <div class="forgot-password">
                                    <a href="javascript:;" id="forget-password" class="forget-password">¿Olvido su contraseña?</a>
                                </div>
                                <button class="btn green" type="submit">Acceder</button>
                            </div>
                        </div>
                </form>
                <!-- BEGIN FORGOT PASSWORD FORM -->
                <form class="forget-form" action="javascript:;" method="post">
                    <h3 class="font-green">¿Olvido su contraseña?</h3>
                    <p> Introduzca su dirección de correo para poder recuperar su contraseña. </p>
                    <div class="form-group">
                        <input class="form-control placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
                    <div class="form-actions">
                        <button type="button" id="back-btn" class="btn green btn-outline">Regresar</button>
                        <button type="submit" class="btn btn-success uppercase pull-right">Enviar</button>
                    </div>
                </form>
                <!-- END FORGOT PASSWORD FORM -->
                @if( isset($settings->enable_auth_fb) && $settings->enable_auth_fb 
                	|| isset($settings->enable_auth_tw) && $settings->enable_auth_tw 
                	|| isset($settings->enable_auth_google) && $settings->enable_auth_google )
                <h3>Identificate con tus redes sociales</h3>
                    @if( $settings->enable_auth_fb )
                    <a href="{{ route('social.oauth', 'facebook') }}" 
                        class="socicon-btn socicon-btn-circle socicon-lg socicon-solid bg-blue bg-hover-grey-salsa font-white bg-hover-white socicon-facebook tooltips" 
                        data-original-title="Facebook" style="margin-right: 10px"></a>
                    @endif

                    @if( $settings->enable_auth_tw )
                    <a href="{{ route('social.oauth', 'twitter') }}" 
                        class="socicon-btn socicon-btn-circle socicon-lg socicon-solid bg-green bg-hover-grey-salsa font-white bg-hover-white socicon-twitter tooltips" 
                        data-original-title="Twitter" style="margin-right: 10px"></a>
                    @endif
                    @if( $settings->enable_auth_google )
                    <a href="{{ route('social.oauth', 'google') }}" 
                        class="socicon-btn socicon-btn-circle socicon-lg socicon-solid bg-red bg-hover-grey-salsa font-white bg-hover-white socicon-google tooltips" 
                        data-original-title="Google" style="margin-right: 10px"></a>
                    @endif
                @endif
            </div>
            <div class="login-footer">
                <div class="row bs-reset">
                    <div class="col-xs-12 bs-reset">
                        <div class="login-copyright text-right">
                            <p>Copyright &copy; {{ $settings->name }} {{ Date('Y') }} Powerby <a target="_blank" href="https://leopardus.net">Leopardus</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection