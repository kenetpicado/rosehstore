<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @livewireStyles

    <style>
        @media screen and (max-width: 800px) {

            tbody, tr, td {
                display: block;
            }

            thead {
                display: none;
            }

            tbody {
                float: left;
            }

            td:before {
                content: attr(data-title);
                margin-right: 0.5em;
                font-weight: bold;
            }

            tr {
                border-top: 1px solid #aaaa;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bolder" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="{{ route('shop') }}">{{ __('Tienda') }}</a>
                        </li>

                        <li class="nav-item dropdown mx-2">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Inventario
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('products') }}">Productos</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ route('hires') }}">Mobiliario</a></li>
                            </ul>
                        </li>

                        <li class="nav-item mx-2">
                            <a class="nav-link" href="{{ route('books') }}">{{ __('Contabilidad') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>
    </div>

    @livewireScripts
    <script>
        var amount = document.getElementById("amount");
        var price = document.getElementById("price");
        var discount = document.getElementById("discount");
        var total_price = document.getElementById("total_price");

        function setNewTotal() {
            total_price.value = (amount.value * price.value) - discount.value;
        }

        Livewire.on('closeModal', function() {
            document.getElementById("closeModal").click();
        });

        Livewire.on('openModal', function() {
            document.getElementById("openModal").click();
        });

        Livewire.on('openModalShop', function() {
            document.getElementById("openModal").click();
            setNewTotal();
        });

        amount.addEventListener("keyup", function() {
            setNewTotal();
        });

        amount.addEventListener("change", function() {
            setNewTotal();
        });

        price.addEventListener("keyup", function() {
            setNewTotal();
        });

        discount.addEventListener("keyup", function() {
            setNewTotal();
        });
    </script>
</body>

</html>
