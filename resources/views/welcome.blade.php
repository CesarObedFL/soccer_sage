<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- flowbite stylesheets -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />

        <link rel="icon" href="{{ asset('images/app/soccer_sage_favicon.ico') }}">

        <link rel="stylesheet" href="{{ asset('assets/app/welcome_banner_style.css') }}">


    </head>
    <body class="bg-gray-100 flex flex-col min-h-screen font-sans antialiased dark:bg-black dark:text-white/50">

        
        <!-- navbar -->
        <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600 shadow-inner">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                    <img src="{{ asset('images/app/soccer_sage_logo.png') }}" class="h-8" alt="Soccer Sage Logo" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"><i>Soccer Sage</i></span>
                </a>
                <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
                <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    @if (Route::has('login'))
                        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Dashboard
                                </a>
                            @else
                                <li>
                                    <a href="{{ route('login') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Log in</a>
                                </li>

                                @if (Route::has('register'))
                                    <li>
                                        <a href="{{ route('register') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Register</a>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                    @endif  
                </div>
            </div>
        </nav>
        <!-- /. navbar -->

        <br><br><br><br><br>

        <div class="flex-1">
            <div class="py-15">
                <div class="max-w-9xl mx-auto my-30 sm:px-6 lg:px-8">
                    <div class="bg-slate-100 sm:px-2 lg:px-4 overflow-hidden shadow-xl sm:rounded-lg">

                        <br><br>
                        <section class="banner-section">
                            <article class="banner-article">
                                <figure class="banner-figure">
                                    <h2>@Xavisu</h2>
                                    <p>Hola, vengo a flotar. Front~end</p>
                                </figure>
                                <img class="banner-img" alt src='https://kaleidos.net/media/filer_public_thumbnails/filer_public/91/7c/917ca0ca-f069-455e-b25f-154db357d09a/xaviju2.jpg__300x300_q85_crop_subject_location-3257%2C1894_subsampling-2_upscale.jpg'/>
                            </article>
                            <article class="banner-article">
                                <figure class="banner-figure">
                                    <h2>@Kseso</h2>
                                    <p>Enredique Amanuense de CSS</p>
                                </figure>
                                <img class="banner-img" alt src='https://1.bp.blogspot.com/-8xv4oUIGGdo/WR3XHvAb5hI/AAAAAAAANjo/Pi2TSd9llSQBvuIgWWe4RY8l9msbOgcbgCK4B/s250-c/hrRtW6LJ.jpg'/>
                            </article>
                            <article class="banner-article">
                                <figure class="banner-figure">
                                    <h2>@abelsutilo</h2>
                                    <p>Diseño Productos Digitales. Formador en #UX #U</p>
                                </figure>
                                <img class="banner-img" alt src='http://abelsutilo.com/wp-content/uploads/2009/01/10850250_10152894635423684_7160074995457018570_n.jpg.pagespeed.ce.tgatamlOAJ.jpg'/>
                            </article>
                            <article class="banner-article">
                                <figure class="banner-figure">
                                    <h2>@Olgacarreras</h2>
                                    <p>Consultora freelance. Accesibilidad web y PDF</p>
                                </figure>
                                <img class="banner-img" alt src='https://www.usableyaccesible.com/images/olga_carreras_montoto.jpg' />
                            </article>
                            <article class="banner-article">
                                <figure class="banner-figure">
                                    <h2>@cristinafsanz<h2>
                                    <p>Front-end developer in learning mode</p>
                                </figure>
                                <img class="banner-img" alt src='https://cristinafsanz.github.io/images/avatar.png' />
                            </article>
                            <article class="banner-article">
                                <figure class="banner-figure">
                                    <h2>@lau_es</h2>
                                    <p>#OpenSource rocks! Making awesome things</p>
                                </figure>
                                <img class="banner-img" alt src='https://www.gravatar.com/avatar/73f55f92af57327a909da02fd88ac4d0?d=404&s=250' />
                            </article>
                            <article class="banner-article">
                                <figure class="banner-figure">
                                    <h2>@yoksel_en</h2>
                                    <p>CSS and SVG lover : ) In Russian</p>
                                </figure>
                                <img class="banner-img" alt src='https://avatars3.githubusercontent.com/u/2571308?s=400&v=4' />
                            </article>
                            <article class="banner-article">
                                <figure class="banner-figure">
                                    <h2>@jorgeATGU</h2>
                                    <p>front/design Pirineo</p>
                                </figure>
                                <img class="banner-img" alt src='https://avatars1.githubusercontent.com/u/2649175?s=400&v=4' />
                            </article>
                            <article class="banner-article">
                                <figure class="banner-figure">
                                    <h2>@SaraSoueidan</h2>
                                    <p>Freelance front-end Web developer & speaker</p>
                                </figure>
                                <img class="banner-img" alt src='http://www.webdirections.org/respond16/images/speakers/speaker-sara-soueidan.jpg' />
                            </article>
                            <article class="banner-article">
                                <figure class="banner-figure">
                                    <h2>@Furoya</h2>
                                    <p>La magia del puro JS y CSS en su mínima y expresión</p>
                                </figure>
                                <img class="banner-img" alt src='https://4.bp.blogspot.com/-oEYLUC8u3Jg/Ua55qLcPbtI/AAAAAAAAADc/H-X_ID0b5bo/s250-c/avatarFuroya.jpg' />
                            </article>
                            <article class="banner-article">
                                <figure class="banner-figure">
                                    <h2>@AmeliasBrain</h2>
                                    <p>Writer & Developer. SVG guru, policy nut, science nerd, & music fan</p>
                                </figure>
                                <img class="banner-img" alt src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/91525/profile/profile-512.jpg?3' />
                            </article>
                            <article class="banner-article">
                                <figure class="banner-figure">
                                    <h2>@lpez_elena</h2>
                                    <p>Tan a gusto en la cama, ocho de la mañana y suena el despertador… </p>
                                </figure>
                                <img class="banner-img" alt src='https://cdn-images-1.medium.com/fit/c/125/125/0*oNbktSWCpFc07xOj.jpg' />
                            </article>
                        </section>
                    
                        <svg width="0" height="0">
                            <defs>
                                <clipPath id="hexagono" clipPathUnits="objectBoundingBox">
                                    <polygon points=".25 0, .75 0, 1 .5, .75 1, .25 1, 0 .5" />
                                </clipPath>
                            </defs>
                        </svg>

                        <br><br>
                            
                    </div>
                </div>
            </div>
        </div>

        <br><br>
        
        <x-footer />

        <!-- flowbite scrypts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
 
    </body>
</html>
