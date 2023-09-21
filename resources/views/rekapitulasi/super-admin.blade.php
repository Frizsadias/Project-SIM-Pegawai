@extends('layouts.master')
@section('content')

    <!doctype html>
    <html lang="en">
    <div class="page-wrapper">
        <div class="content container-fluid">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport"
                    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Rekapitulasi</title>
                <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
            </head>

            <body class="h-screen bg-gray-100">

                <div class="container px-4 mx-auto">

                    <div class="p-6 m-20 bg-white rounded shadow">
                        {!! $chart->container() !!}
                    </div>
                    <div class="p-6 m-20 bg-white rounded shadow">
                        {!! $grafikAgama->container() !!}
                    </div>
                    <div class="p-6 m-20 bg-white rounded shadow">
                        {!! $grafikJenisKelamin->container() !!}
                    </div>
                    <div class="p-6 m-20 bg-white rounded shadow">
                        {!! $grafikPangkat->container() !!}
                    </div>

                </div>

                <script src="{{ $chart->cdn() }}"></script>
                <script src="{{ $grafikAgama->cdn() }}"></script>
                <script src="{{ $grafikJenisKelamin->cdn() }}"></script>
                <script src="{{ $grafikPangkat->cdn() }}"></script>

                {{ $chart->script() }}
                {{ $grafikAgama->script() }}
                {{ $grafikJenisKelamin->script() }}
                {{ $grafikPangkat->script() }}
            </body>
        </div>


    </div>

    </html>
