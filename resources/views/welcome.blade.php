<!DOCTYPE html>
<html>

<head>
    <title>XTake - Talent is Everywhere!</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta author="xtake">
    <meta description="Xtake is a new platform created with you in mind. Offers its services to help recruiters find staff that can meet their needs and allows the public to be found while showing their talents">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/main.css') }}">
</head>

<body>
    

    <!-- Muestra la alerta para la autentificacion-->
    @if(Session::has('status')) 
    <div class="alert alert-danger">
      {{ Session::get('status')}}
    </div>
    @endif
    @if(Session::has('suc')) 
    <div class="alert alert-success">
      {{ Session::get('suc')}}
    </div>
    @endif
    <!-- fin alerta -->

    <div class="container-fluid">

        <!-- Begin Page -->

        <!-- Logo and moto section -->

        <div class="row">
            
            <div class="col-md-7">

                <div class="row">
                    <div class="col-md-2" style="margin-top:7%;">
                        <img src="/img/logo.jpg" class="img-logo-orig img-logo-to-rigth">
                    </div>
                    <div class="col-md-5 besides-letters-to-right">
                        <div class="row">
                            <div class="col-md-12" style="line-height: 0.5;"><p id="pmoto" class="logomoto letraextragrande" style="width:100%;margin: 0 !important;color:#31859C;font-family:Calibri,sans-serif;"><b style="padding-bottom: 0px !important;">Skautin</b></p></div>
                            <div class="col-md-12 letragrande" style="width:100%;font-family:Calibri,sans-serif;">
                                <b style="color: #686868;">Talent is Everywhere</b>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5"></div>
                </div>
                <img src="/img/portrait.png" style="width: 300px; margin-left: 25%; margin-right: auto;" class="img-fluid">
            </div>
            <div class="col-md-3" style="margin-top: 3%;">

                <section class="box-sign" style="border-color:#A6A6A6;border-width:1px;">

                    <div class="container boxmdl" style="padding-left:8%;padding-right:8%;border-color:#A6A6A6;">
                            <h2 class="text-bienvenida letraextragrande"><b>Welcome,</b></h2>
                            <p class="midcent letrachica texttotop" >Sign up to show your</p>
                            <p class="midcent letrachica texttotop">skills, make connections,</p>
                            <p class="midcent letrachica texttotop">post and apply to jobs.</p>
                            <p class="midcent letrachica texttotop" style="padding-top: 4px;">Sign up as:</p>
                            <div class="row btnalignation">
                                <div class="col-lg-6">
                                    <a href="{{ url('/new-talent-registration') }}" class="btn btn-primary" style="width:80%;height:33px;background-color:#31859C !important;font-family:Calibri,sans-serif;font-size:1em;font-weight:bold;margin-left: 22%;border-color:#31859C;">Talent</a>
                                </div>
                                <div class="col-lg-6">
                                    <a href="{{ url('/new-recruiter-registration') }}" class="btn btn-default" style="font-family:Calibri,sans-serif;font-size:1em;font-weight:bold;color:#31859C;">Recruiter</a>
                                </div>
                            </div>
                            <!-- Static content -->
                            <p class="midcent" style="margin-bottom:0px;font-family:Calibri,sans-serif;font-size:1em;color:#686868;">By signing up, your agree to our</p>
                            <p class="midcent" style="padding-top:0px;font-family:Calibri,sans-serif;font-size:1em;font-weight:bold;color:#686868;"><b>Terms &amp; Privacy policy</b></p>       
                    </div>

                </section>  

                <section class="box-secsign" style="border-color:#A6A6A6;border-width:1px;">

                {{ Form::open(array('action' => 'HomeController@iniciarSesion', 'method' => 'POST')) }}
                
                    <div class="container boxmdl" style="padding-left:8%;padding-right:8%;">
                                                
                    <p class="midcent" style="font-family:Calibri,sans-serif;font-size:1.2em;color:#686868;">Already has an account?</p>
                    <input id="email" type="email" name="username" placeholder="example@mail.com" class="form-control">
                    <input id="ps" type="password" name="password" placeholder="·································" class="form-control">
                    <button id="btnlog" type="submit" class="btn btn-primary btn-sm btnalignation">Log In</button>
                    <p class="midcent" style="font-family:Calibri,sans-serif;font-size:1em;color:#31859C;">Forgot your password?</p>        
                    </div>

                {{ Form::close() }}


                    <!--</form>-->

                </section>  

                <section>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4" style="padding-left:0px;padding-right:0px;"><a href="https://play.google.com/store?hl=en"><img src="img/google_play.png" class="playstoreimagen"></a></div>
                        <div class="col-md-4 appstorelogos"><a href="https://www.apple.com/ios/app-store/"><img src="img/app-store.png" class="appapple"></a></div>
                        <div class="col-md-2"></div>
                    </div>
                    
                </section>
        
            </div>
            <div class="col-md-2"></div>

        </div>

        <footer style="margin-top: 5%;margin-bottom:5%;">

            <div class="fcont">
                <a href="{{url('/about')}}" style="font-family:Calibri,sans-serif;font-size:1em;font-weight:bold;color:#686868;">ABOUT US</a>
                <a href="{{url('/terms')}}" style="font-family:Calibri,sans-serif;font-size:1em;font-weight:bold;color:#686868;">TERMS OF USE &amp; PRIVACY</a>
                <a href="{{url('/language')}}" style="font-family:Calibri,sans-serif;font-size:1em;font-weight:bold;color:#686868;">LANGUAGE</a>
                <a href="{{url('/contact')}}" style="font-family:Calibri,sans-serif;font-size:1em;font-weight:bold;color:#686868;">CONTACT US</a>
                <span style="margin-top:2rem;font-family:Calibri,sans-serif;font-size:0.8em;color:#909090;">xtake&copy;2018</span>
            </div>

        </footer>

        <!-- Image -->

        <!-- End Page -->
    </div>
    
    <script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script>

</body>

</html>