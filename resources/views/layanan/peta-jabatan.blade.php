@extends('layouts.master')
@section('content')

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="tutorial-boostrap-merubaha-warna">
        <meta name="author" content="ilmu-detil.blogspot.com">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <link href="orgchart/orgchart.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="orgchart/orgchart.js"></script>

        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
        <link href="{{ asset('orgchart/orgchart.css') }}" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="{{ asset('orgchart/orgchart.js') }}"></script>


        <style type="text/css">
            .navbar-default .navbar-nav>li.clr1 a {
                color: #ffffff;
            }

            .navbar-default .navbar-nav>li.clr2 a {
                color: #FFEB3B;
                ;
            }

            .navbar-default .navbar-nav>li.clr3 a {
                color: #5EC64D;
            }

            .navbar-default .navbar-nav>li.clr4 a {
                color: #29AAE2;
            }

            .navbar-default .navbar-nav>li.clr1 a:hover,
            .navbar-default .navbar-nav>li.clr1.active a {
                color: #fff;
                background: #F55;
            }

            .navbar-default .navbar-nav>li.clr2 a:hover,
            .navbar-default .navbar-nav>li.clr2.active a {
                color: #fff;
                background: #973CB6;
            }

            .navbar-default .navbar-nav>li.clr3 a:hover,
            .navbar-default .navbar-nav>li.clr3.active a {
                color: #fff;
                background: #5EC64D;
            }

            .navbar-default .navbar-nav>li.clr4 a:hover,
            .navbar-default .navbar-nav>li.clr4.active a {
                color: #fff;
                background: #29AAE2;
            }

            .navbar-default {
                background-color: #3b5998;
                font-size: 18px;
            }

            .navbar-default .navbar-brand {
                color: #ffffff;
                font-weight: bold;
            }

            .navbar-default .navbar-text {
                color: #ffffff;
            }

            a {
                color: #FFC107;
                text-decoration: none;
            }
        </style>
    </head>
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title"> Struktur Peta Jabatan Aplikasi</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Peta Jabatan Aplikasi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card dash-widget">
                <div class="card-body">
                    <div class="dash-widget-info">
                        <center><span style="font-size: 20px; font-weight: 600; font-family: Poppins;">Peta Jabatan
                                PDF</span></center>
                    </div>
                </div>
            </div>
        </div>
        @foreach ( $result_peta_jabatan as $peta_jabatan)
            <iframe src="{{ asset('assets/PetaJabatan/' . $peta_jabatan->pdf_peta) }}" width="100%"
            height="600"></iframe>
        @endforeach
        
        <br>
        <div class="col-md-12">
            <div class="card dash-widget">
                <div class="card-body">
                    <div class="dash-widget-info">
                        <center><span style="font-size: 20px; font-weight: 600; font-family: Poppins;">Peta Jabatan
                                Animasi</span></center>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--- Bagian Konten-->

    <body>


        <script src="https://d3js.org/d3.v7.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/d3-org-chart@2"></script>
        <script src="https://cdn.jsdelivr.net/npm/d3-flextree@2.1.2/build/d3-flextree.js"></script>
        <div class="chart-container" style="height: 1200px; background-color: #f6f6f6"></div>

        <script>
            var chart;
            d3.csv(
                '{{ asset('assets/PetaJabatan/Animasi/org.csv') }}'
            ).then((dataFlattened) => {
                chart = new d3.OrgChart()
                    .container('.chart-container')
                    .data(dataFlattened)
                    .nodeWidth((d) => 350)
                    .initialZoom(0.7)
                    .nodeHeight((d) => 175)
                    .childrenMargin((d) => 40)
                    .compactMarginBetween((d) => 15)
                    .compactMarginPair((d) => 80)
                    .nodeContent(function(d, i, arr, state) {
                        return `
            <div style="padding-top:30px;background-color:none;margin-left:1px;height:${
              d.height
            }px;border-radius:2px;overflow:visible">
              <div style="height:${
                d.height - 32
              }px;padding-top:0px;background-color:white;border:1px solid lightgray;">

                <img src=" ${
                  d.data.imageUrl
                }" style="margin-top:-30px;margin-left:${d.width / 2 - 30}px;border-radius:100px;width:60px;height:60px;" />

               <div style="margin-right:10px;margin-top:15px;float:right">${
                 d.data.id
               }</div>
               
               <div style="margin-top:-30px;background-color:#3AB6E3;height:10px;width:${
                 d.width - 2
               }px;border-radius:1px"></div>

               <div style="padding:20px; padding-top:35px;text-align:center">
                   <div style="color:#111672;font-size:16px;font-weight:bold"> ${
                     d.data.name
                   } </div>
                   <div style="color:#404040;font-size:16px;margin-top:4px"> ${
                     d.data.positionName
                   } </div>
               </div> 
               <div style="display:flex;justify-content:space-between;padding-left:15px;padding-right:15px;">
                 <div > Sub Bagian:  ${d.data._directSubordinates} 👤</div>  
               </div>
              </div>     
      </div>
  `;
                    })
                    .render();
            });
        </script>
    </body>
    <script src="https://storage.ko-fi.com/cdn/scripts/overlay-widget.js"></script>
    </div>

    </html>
@endsection
