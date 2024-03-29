<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <title>Floristerra Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CodedThemes">
    <meta name="keywords" content=" Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="CodedThemes">
    <!-- Favicon icon -->
    <link rel="icon" href="{{asset('assets/template/images/favicon.ico" type="image/x-icon')}}">
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/template/css/bootstrap/css/bootstrap.min.css') }}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/template/icon/themify-icons/themify-icons.css') }}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/template/icon/icofont/css/icofont.css') }}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/template/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/template/css/jquery.mCustomScrollbar.css') }}">
</head>

<body class="fix-menu">
    <!-- Pre-loader start -->
    <div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
        </div>
    </div>
</div>
    <!-- Pre-loader end -->
    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <form class="md-float-material" action="{{route('loginpost')}}" method="POST">
                            @csrf
                            <div class="text-center">
                                <img src="{{asset('assets/template/images/auth/logo-dark.png')}}" alt="logo.png">
                            </div>
                            <div class="auth-box" style="background-color: rgba(255, 255, 255, 0.738)">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary">Entrar</h3>
                                    </div>
                                </div>
                                <hr/>
                                <div class="input-group">
                                    <input type="email" class="form-control" placeholder="Seu email" name="email">
                                    <span class="md-line"></span>
                                </div>
                                <div class="input-group">
                                    <input type="password" class="form-control" placeholder="Senha" name="password">
                                    <span class="md-line"></span>
                                </div>
                                <div class="row m-t-25 text-left">
                                    <div class="col-sm-7 col-xs-12">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <input type="checkbox" value="">
                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Lembrar me</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Entrar</button>
                                    </div>
                                </div>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Agradecemos sua visita :)</p>
                                        <p class="text-inverse text-left"><b>Equipe Floristerra</b></p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="{{asset('assets/template/images/auth/Logo-small-bottom.png') }}" alt="small-logo.png">
                                    </div>
                                </div>

                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    <!-- Required Jquery -->
    <script type="text/javascript" src="{{asset('assets/template/js/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('assets/template/js/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('assets/template/js/popper.js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{asset('assets/template/js/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="{{asset('assets/template/js/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="{{asset('assets/template/js/modernizr/modernizr.js') }}"></script>
    <script type="text/javascript" src="{{asset('assets/template/js/modernizr/css-scrollbars.js') }}"></script>
    <!-- classie js -->
    <script type="text/javascript" src="{{asset('assets/template/js/classie/classie.js') }}"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="{{asset('assets/template/js/script.js') }}"></script>
    <script src="{{asset('assets/template/js/pcoded.min.js') }}"></script>
    <script src="{{asset('assets/template/js/demo-12.js') }}"></script>
    <script src="{{asset('assets/template/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
</body>

</html>
