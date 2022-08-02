<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->

<html class="no-js"> <!--<![endif]-->
    <head>
        <title>Floristerra - Engenharia e Terraplenagem</title>

        <!-- meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- stylesheets -->
        <link rel="stylesheet" href="{{asset ('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{asset ('assets/font_icon/css/pe-icon-7-stroke.css') }}">
        <link rel="stylesheet" href="{{asset ('assets/font_icon/css/helper.css') }}">
        <link rel="stylesheet" href="{{asset ('assets/css/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{asset ('assets/css/owl.theme.css') }}">
        <link rel="stylesheet" href="{{asset ('assets/css/animate.css') }}">
        <link rel="stylesheet" href="{{asset ('assets/css/style.css') }}">

        <!-- google fonts -->
        <link href='http://fonts.googleapis.com/css?family=Dosis:200,300,400,500|Lato:300,400,700,900,300italic,400italic,700italic,900italic|Raleway:400,200,300,500,100|Titillium+Web:400,200,300italic,300,200italic' rel='stylesheet' type='text/css'>

        <script src="{{asset ('assets/js/modernizr.js') }}"></script>

    </head>
    <body id="body">
        <!--[if lt IE 7]>
                <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Header area -->
        <header id="header">
            <div class="center text-center">
                <h1 class="bigheadline">Floristerra</h1>
                <h4 class="subheadline">Engenharia e Terraplenagem</h4>
            </div>
            <div class="bottom">
                <a data-scroll href="#navigation" class="scrollDown animated pulse" id="scrollToContent"><i class="pe-7s-angle-down-circle pe-va"></i></a>
            </div>
        </header>

        <!-- Navigation area -->
        <section id="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="logo"><a data-scroll href="#body" class="logo-text">Floristerra</a></div>
                    </div>
                    <div class="col-xs-6">
                        <div class="nav">
                            <a href="#" data-placement="bottom" title="Menu" class="menu" data-toggle="dropdown"><i class="pe-7s-menu"></i></a>
                             <div class="dropdown-menu">
                                 <div class="arrow-up"></div>
                                 <ul>
                                     <li><a data-scroll href="#body">Inicio <i class="pe-7s-home"></i></a><span class="menu-effect"></span></li>
                                     <li><a data-scroll href="{{route('login')}}">Login <i class="pe-7s-help1"></i></a><span class="menu-effect"></span></li>
                                     <li><a data-scroll href="#services">Serviços <i class="pe-7s-config"></i></a><span class="menu-effect"></span></li>
                                     <li><a data-scroll href="#testimonial">Equipe <i class="pe-7s-comment"></i><span class="menu-effect"></span></a></li>
                                     <li><a data-scroll href="#contact">Contato <i class="pe-7s-help1"></i></a><span class="menu-effect"></span></li>
                                 </ul>
                             </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Content Area -->

        <!-- services section -->

        <section id="services" class="service-area">
            <div class="container">
                <h2 class="block_title">Serviços</h2>
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="services">
                            <div class="service-wrap">
                                <i class="pe-7s-tools pe-dj pe-va"></i>
                                <h3>Terraplenagem</h3>
                                <p>Escavação, Nivelamento, Remoção de terra, Espalhamento, Compactação de terra e dentre outros serviços.</p>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="services">
                            <div class="service-wrap">
                                <i class="pe-7s-way pe-dj pe-va"></i>
                                <h3>Direcionamento</h3>
                                <p>Equipe sempre bem direcionada e capacitada para realização dos serviços.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="services">
                            <div class="service-wrap">
                                <i class="pe-7s-safe pe-dj pe-va"></i>
                                <h3>Segurança</h3>
                                <p>Trabalhamos sempre com Segurança.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="services">
                            <div class="service-wrap">
                                <i class="pe-7s-call pe-dj pe-va"></i>
                                <h3>Suporte</h3>
                                <p>Equipe dedicada para melhor atendimento.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- services -->

        <!-- Portfolio Area -->

        <section id="portfolio" class="portfolio-area">
            <div class="container">
                <h2 class="block_title">Alguns de nossos Trabalhos</h2>
                <div class="row port cs-style-3">
                    <div class="col-md-4 col-sm-6 col-xs-12 item-space">
                        <figure>
                            <img src="assets/images/portfolio1.jpg" alt="img04">
                            <figcaption>
                                <h3>Retroescavadeira CAT</h3>
                                <span>Galpão empresa ACA, fernão dias.</span>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 item-space">
                        <figure>
                            <img src="{{asset ('assets/images/portfolio2.jpg') }}" alt="img01">
                            <figcaption>
                                <h3>Retroescavadeira</h3>
                                <span>Remoção de pedras - Obra ACA</span>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 item-space">
                        <figure>
                            <img src="{{asset ('assets/images/portfolio3.jpg') }}" alt="img02">
                            <figcaption>
                                <h3>Music</h3>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 item-space">
                        <figure>
                            <img src="{{asset ('assets/images/portfolio4.jpg') }}" alt="img04">
                            <figcaption>
                                <h3>Retroescavadeira</h3>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 item-space">
                        <figure>
                            <img src="{{asset ('assets/images/portfolio5.jpg') }}" alt="img01">
                            <figcaption>
                                <h3>Caminhão</h3>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 item-space">
                        <figure>
                            <img src="{{asset ('assets/images/portfolio6.jpg') }}" alt="img02">
                            <figcaption>
                                <h3>Rolo Compactador</h3>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div><!-- container -->
        </section><!-- portfolio -->

        <!-- Testimonial Area -->

        <section id="testimonial" class="testimonial-area">
            <div class="container">
                <h2 class="block_title">Quem Somos?</h2>
                <div class="row">
                    <div class="col-xs-12">
                    </div>
                    <div id="testimonial-container" class="col-xs-12">
                        <div class="testimonila-block">
                            <img src="{{asset ('assets/images/testimonial.jpeg') }}" alt="clients" class="selfshot">
                            <p></p>
                            <strong>Floriano Aparecido de Oliveira</strong>
                            <br>
                            <small>C.E.O</small>
                        </div>
                        <div class="testimonila-block">
                            <img src="{{asset ('assets/images/testimonial2.jpeg') }}" alt="clients" class="selfshot">
                            <p></p>
                            <strong>Bruna Mara de Oliveira</strong>
                            <br>
                            <small>Engenheira Civil</small>
                        </div>
                    </div>
                </div>
            </div><!-- container -->
        </section><!-- testimonial -->

        <!-- Contact Area -->

        <section id="contact" class="mapWrap">
            <div id="contact-area">
                <div class="container">
                    <h2 class="block_title">Informações</h2>
                    <div class="row">
                        <div class="col-xs-12">
                        </div>
                        <div class="col-sm-12">
                            <div class="moreDetails">
                                <h2 class="con-title">Mais sobre nós</h2>
                                <p>Floristerra Engenharia e Terraplenagem trabalha na área de obras na região de Extrema, Itapeva, Cambuí, Vargem, Monte-Verde entre outras regiões desde 2002. A companhia vem aumentando cada vez mais, sempre atendendo as necessidades de nossos clientes com excelência e profissionalismo!</p>
                                <ul class="address">
                                    <li><i class="pe-7s-map-marker"></i><span>Avenida Nicolau Cesarino - 3148,<br>Extrema, MG 47640-000,<br>Brasil</span></li>
                                    <li><i class="pe-7s-mail"></i><span>ffloristerra@yahoo.com</span></li>
                                    <li><i class="pe-7s-phone"></i><span>+55 (35) 9 9955-4338 (Bruna)</span></li>
                                    <li><i class="pe-7s-global"></i><span><a href="#">www.floristerra.com</a></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!-- container -->
            </div><!-- contact-area -->
        </section><!-- contact -->

        <!-- Footer Area -->

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <p class="copyright">© Copyright 2021 <a href="#" target="_blank">Floristerra Ltda.</a></p>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Necessery scripts -->
        <script src="{{asset ('assets/js/jquery-2.1.3.min.js') }}"></script>
        <script src="{{asset ('assets/js/bootstrap.min.js') }}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
        <script src="{{asset ('assets/js/jquery.actual.min.js') }}"></script>
        <script src="{{asset ('assets/js/smooth-scroll.js') }}"></script>
        <script src="{{asset ('assets/js/owl.carousel.js') }}"></script>
        <script src="{{asset ('assets/js/script.js') }}"></script>

    </body>
</html>

