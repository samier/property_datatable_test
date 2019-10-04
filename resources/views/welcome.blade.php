<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" crossorigin="anonymous">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
            }
            table {
                width: 100%;
            }
            .sorting {
                background-image: url('{{ asset("images/sort_both.png") }}');
                max-width: 100%;
                background-repeat: no-repeat;
                background-position: center right;
                width: 20px;
                height: 20px;
                display: inline-block;
                position: absolute;
                right: 5px;
                top: 32%;
            }
            .sorting_asc {
                background-image: url('{{ asset("images/sort_asc.png") }}');
                max-width: 100%;
                background-repeat: no-repeat;
                background-position: center right;
                width: 20px;
                height: 20px;
                display: inline-block;
                position: absolute;
                right: 5px;
                top: 32%;
            }
            .sorting_desc {
                background-image: url('{{ asset("images/sort_desc.png") }}');
                max-width: 100%;
                background-repeat: no-repeat;
                background-position: center right;
                width: 20px;
                height: 20px;
                display: inline-block;
                position: absolute;
                right: 5px;
                top: 32%;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .float-right { float: right; }
            .m-b-md { margin-bottom: 20px; }
            .m-t-md { margin-top: 20px; }
            .m-r-5 { margin-right: 5px; }
            .m-l-5 { margin-right: 5px; }
            .paginate-separate {
                margin-right: 5px;
                margin-left: 5px;
                font-size: 20px;
            }
            .paginate {
                margin-right: 3px;
                color: white !important;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref m-b-md m-t-md">
            <div class="content">
                <div id="app">
                    <datatable-component></datatable-component>
                </div>
            </div>
        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
