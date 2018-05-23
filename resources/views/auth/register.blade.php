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
	            <h1>Registraté o 
	                <a href="{{ route('login') }}" style="text-decoration: none">Identificate</a>
	            </h1>
	            <p> Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy et nibh euismod aliquam erat volutpat. Lorem ipsum dolor sit amet, coectetuer adipiscing. </p>
	            <form class="login-form" method="POST" action="{{ route('register') }}">
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

                    <div class="row">

                        <div class="form-group">
                            <div class="col-xs-6">
                                <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Nombre" name="name" value="{{ old('name') }}" required/> 
                            </div>
                        
                            <div class="col-xs-6">
                                <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}" required/>
                            </div>
                        </div>    

                        <div class="form-group">
                            <div class="col-xs-6">
                                <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Contraseña" name="password" required/>
                            </div>     

                            <div class="col-xs-6">
                                <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Confirme su Contraseña" name="password_confirmation" required/> 
                            </div>
                        </div> 
                    </div>

                    <input type="hidden" name="referred_id" value="{{ request()->referred_id }}"/> 

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="rem-password">
                                <label class="rememberme mt-checkbox mt-checkbox-outline">
                                    <input type="checkbox" id="terms" name="terms" {{ old('terms') ? 'checked' : '' }}/> Acepto los terminos y condiciones
                                    <span></span>
                                </label>    
                            </div>
                        </div>
                        <div class="col-sm-6 text-right">
                            <button class="btn green" type="submit">Registrarme</button>
                        </div>
                    </div>                                                          
                </form>
                
                @if( isset($settings->enable_auth_fb) && $settings->enable_auth_fb 
                || isset($settings->enable_auth_tw) && $settings->enable_auth_tw 
                || isset($settings->enable_auth_google) && $settings->enable_auth_google )
	            <h3>Registrate con tus redes sociales</h3>
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
