@extends('frontend.master')
@section('content')
    <div class="container-fluid d-flex header-banner">
        <div class="align-self-center flex-fill justify-content-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb a_cb bg-transparent">
                <li class="breadcrumb-item"><a href="{{route('frontend.home')}}">Home</a></li>
                <li class="breadcrumb-item  shapla_brdcmp text-white-50 active" aria-current="page">Contact us</li>
                </ol>
            </nav>
            <h1 class="text-white text-center ">Contact us</h1>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-lg-3 mt-5">
                <div class="mt-5">
                    <div>
                        <h3 class="section__title">Contact Us</h3>
                    </div>
                    <div class="row mb-2">
                        <div class="col-2 text-white">
                                <i class="fas fa-map-marker-alt fas "></i>
                        </div>
                        <div class="col-10">
                            <h4 class="text-uppercase text-white">Address</h4>
                            <p class="text-uppercase text-white-50">80/5 Kakrail, VIP road, <br>Kakrail, Dhaka, <br>1200</p>
                        </div>
                    </div>
                    <div class=" row mb-2">
                            <div class="col-2 text-white"> 
                                <i class="fas fa-phone-square-alt  "></i>
                            </div>
                        <div class="col-10">
                            <h4 class="text-uppercase text-white">Phone</h4>
                            <p class="text-uppercase text-white-50">+0080122222289</p>
                            </div>
                    </div>
                    <div class="row mb-2">
                            <div class="col-2 text-white">
                                <i class="fas fa-envelope "></i>
                        </div>
                        <div class="col-10">
                            <h4 class="text-uppercase text-white">Email</h4>
                            <p class="text-uppercase text-white-50">shaplamedial@mail.net</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 mt-80">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3652.2881544795964!2d90.40905901429663!3d23.737101695202703!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b85fa3d43d3d%3A0x461bb0a75bde38b7!2sShapla%20Media!5e0!3m2!1sbn!2sbd!4v1621409887660!5m2!1sbn!2sbd" width="100%" height="480" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>
    </div>
@endsection
@push('extraCss')
    <style>

        .first_about{
            background-color: #56555514;
            padding: 20px;
        }
        .about_part{
            margin-top: 20px;
        }
        .a_cb{
            margin-top: 50px;
        }
        
        .shapla_brdcmp::before {
        display: inline-block;
        padding-right: .5rem;
        color: #dae0e4 !important;
        content: "/";
    }
        .header-banner {
            position: relative;
            height: 200px;
        }
        .header-banner:before {
            content: '';
            width: 100%;
            height: 100%;
            position: absolute;
            background: linear-gradient(45deg, rgb(111 85 9 / 36%) 0%,rgb(2 2 2 / 81%) 100%);
            left: -5%;
            width: 105%;
            height: 120%;
            z-index: -1;
        }
        .header-banner:after {
            content: '';
            height: 200px;
            background-image: url("{{asset('img/shapla/bd-img.jpg')}}");
            background-position: 50% 50%;
            position: absolute;
            width: 105%;
            height: 120%;
            left: -5%;
            filter: blur(5px);
            z-index: -2;
        }
    </style>
@endpush