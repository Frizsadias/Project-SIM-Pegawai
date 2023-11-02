@extends('layouts.master')
@section('content')
    <link href="{{ asset('orgchart/orgchart.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('orgchart/orgchart.js') }}"></script>

    <style>
        /* Style untuk halaman strukturpetajabatan */
        .page-title {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: 600;
        }

        .breadcrumb {
            margin-bottom: 20px;
            font-size: 14px;
        }

        #tree-view {
            margin-top: 20px;
            height: 500px;
        }

        /* Style untuk plugin orgchart.js */
        .orgchart {
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            font-size: 14px;
            line-height: 1.5;
            text-align: center;
            width: 100%;
        }

        .orgchart .node {
            background-color: #fff;
            border: 1px solid #ccc;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 10px;
            position: relative;
            text-align: center;
            width: 200px;
        }

        .orgchart .node .title {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .orgchart .node .content {
            margin-bottom: 10px;
        }

        .orgchart .node .children {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 10px;
        }

        .orgchart .node .children .node {
            margin: 10px;
            width: auto;
        }

        .orgchart .node .edge {
            background-color: #ccc;
            height: 1px;
            left: 50%;
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 100%;
        }

        .orgchart .node .edge:first-child {
            display: none;
        }

        .orgchart .node .edge:last-child {
            display: none;
        }
    </style>

    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title"> Struktur Peta Jabatan</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Peta Jabatan</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="chart-container" style="height: 1200px; background-color: #f6f6f6"></div>

            <script>
                var chart;
                var data = [{
                        id: 1,
                        name: "John Doe",
                        positionName: "CEO",
                        imageUrl: "https://imageurl.com",
                        _directSubordinates: 5,
                        _totalSubordinates: 50,
                    },
                    {
                        id: 2,
                        name: "Jane Smith",
                        positionName: "VP Marketing",
                        imageUrl: "https://imageurl.com",
                        _directSubordinates: 3,
                        _totalSubordinates: 20,
                    },
                    {
                        id: 3,
                        name: "Bob Johnson",
                        positionName: "VP Sales",
                        imageUrl: "https://imageurl.com",
                        _directSubordinates: 4,
                        _totalSubordinates: 30,
                    }
                ];


                chart = new OrgChart()
                    .container('.chart-container')
                    .data(dataFlattened)
                    .nodeWidth((d) => 250)
                    .initialZoom(0.7)
                    .nodeHeight((d) => 175)
                    .childrenMargin((d) => 40)
                    .compactMarginBetween((d) => 15)
                    .compactMarginPair((d) => 80)
                    .nodeContent(function(d, i, arr, state) {
                        return `
                            <!-- Konten node disesuaikan dengan kebutuhan Anda -->
                        `;
                    })
                    .render();
            </script>
        </div>
    </div>
@endsection
