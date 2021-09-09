@extends('frontendnew') @section('header')

<x-searchingnew :cities="$cities"></x-searchingnew>

@endsection @section('main-content')
<!-- Header-->

@if (session()->has('message'))
<div class="alert alert-success">
    {{ session("message") }}
</div>
@endif

<div class="d-none">
    <div class="container mt-0 my-3">
        <div class="row">
            @foreach($rooms as $room) @php
            $photos=json_decode($room->photos,true); $s=0; @endphp
            <div class="col-md-4">
                <div class="card">
                    <div
                        id="carouselExampleSlidesOnly"
                        class="carousel slide"
                        data-bs-ride="carousel"
                    >
                        <div class="carousel-inner">
                            @foreach($photos as $k=>$p)
                            <div
                                class="carousel-item {{
                                    $s == $k ? 'active' : ''
                                }}"
                            >
                                <img src="{{ asset("storage/$p") }}"
                                class="d-block w-100" alt="...">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0">
                            {{$room->type->name}},
                            {{($room->single == null) ?  '':$room->single." Single"}}
                            {{($room->double == null) ?  '':$room->double." Double"}}
                            {{($room->king == null) ?  '':$room->king." King"}}
                            {{($room->queen == null) ?  '':$room->queen." Queen"}}
                            Beds, Non Smoking
                        </h6>
                        <p class="small text-muted">{{$room->wide}}Sqft</p>
                        {{-- accordian start --}}
                        <ul class="list-unstyled">
                            <li>
                                <i class="fas fa-user-friends"></i>
                                Sleep{{$room->ppl}}
                            </li>
                            <li>
                                <i class="fas fa-bed"></i>
                                {{($room->single == null) ?  '':$room->single." Single"}}
                                {{($room->double == null) ?  '':$room->double." Double"}}
                                {{($room->king == null) ?  '':$room->king." King"}}
                                {{($room->queen == null) ?  '':$room->queen." Queen"}}
                                Bed
                            </li>
                            <li>
                                <i class="fas fa-check"></i> Reserve Now,Pay
                                Later
                            </li>
                            <li>
                                <a
                                    href="{{route('room.show',$room->id)}}"
                                    class="text-decoration-none"
                                    >More Details ></a
                                >
                            </li>
                        </ul>
                        <hr class="mx-2" />
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0">${{$room->pricepernight}}</h4>
                                <span class="price-desc small mb-2 text-muted"
                                    >per night</span
                                >
                                <span class="total-desc small mb-2 text-dark"
                                    >{{$room->pricepernight+ 10}} total</span
                                ><br />

                                <span class="fee-include small mb-2 text-dark"
                                    >includes tax and fees</span
                                >
                            </div>
                            <div>
                                <span class="left-msg small mb-2 text-danger"
                                    >We have 4 left!</span
                                >
                                <a href="#" class="btn btn-primary mt-3"
                                    >Reserve Now!</a
                                >
                            </div>
                        </div>
                        {{-- accordian end --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- popular packages --}}

<section>
    <div class="container">
        <div class="row justify-content-center pb-4">
            <div
                class="
                    col-md-12
                    heading-section
                    text-center
                    ftco-animate
                    fadeInUp
                    ftco-animated
                "
            >
                <h2 class="mb-4">Popular Packages</h2>
            </div>
        </div>

        <div class="row">
            @foreach($packages as $package) @php $s=0; $tours=$package->tours;
            $photos=[]; foreach($tours as $t){ $places=
            json_decode($t->photo,true); foreach($places as $v){
            array_push($photos,$v); } } @endphp
            <div class="col-md-4 ftco-animate fadeInUp ftco-animated">
                <div class="project-wrap">
                    <!-- <a
                        href="#"
                        class="img"
                        style="background-image:url({{
                            url('frontnew/assets/img/file/myanmar.jpeg')
                        }})"
                    >
                        <span class="price">$550/person</span>
                    </a> -->
                    <div class="my-img">
                        <div
                            id="carouselExampleControls"
                            class="carousel slide"
                            data-bs-ride="carousel"
                        >
                            <div class="carousel-inner">
                                @foreach($photos as $k=>$p)
                                <div
                                    class="carousel-item {{
                                        $s == $k ? 'active' : ''
                                    }}"
                                >
                                    <img
                                        src="{{ asset('storage/'.$p) }}"
                                        class="d-block w-100"
                                        alt="..."
                                    />
                                </div>
                                @endforeach
                            </div>
                            <button
                                class="carousel-control-prev"
                                type="button"
                                data-bs-target="#carouselExampleControls"
                                data-bs-slide="prev"
                            >
                                <span
                                    class="carousel-control-prev-icon"
                                    aria-hidden="true"
                                ></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button
                                class="carousel-control-next"
                                type="button"
                                data-bs-target="#carouselExampleControls"
                                data-bs-slide="next"
                            >
                                <span
                                    class="carousel-control-next-icon"
                                    aria-hidden="true"
                                ></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <span class="packageprice"
                            >${{$package->priceperperson}}/person</span
                        >
                    </div>
                    <div class="text p-4">
                        <span class="days">{{$package->days}} Days Tour</span>
                        <h3><a href="#">{{$package->name}}</a></h3>
                        <p class="location">
                            <span class="fa fa-map-marker"></span>
                            @php $len=count($package->tours);
                             $lastindex=$len-1;
                            $places='';
                             
                             
                            foreach($package->tours  as $k=>$tours) {
                            if($k == $lastindex) 
                            $places.=$tours->title;
                            else 
                            $places.=$tours->title.',';
                            }
                            @endphp
                            {{$places}}
                        </p>
                        
                        <p><i class="fas fa-car fa_car_icon"></i> {{$package->car->type->name}} Type</p>
                        <p><i class="fas fa-hotel fa_hotel_icon"></i> {{$package->hotel->name}}</p>
                        <ul class="text-center">
                           
                            <li class="">
                                <a href="#"><span class="flaticon-mountains"></span>More info</a>
                            </li>
                        </ul>
                        <button class="btn btn-secondary form-control my-2">book Now</button>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</section>

{{-- feedback --}}
<section>
    <div class="container my-5">
        <div class="row my-5">
            <div class="col-md-12 justify-content-center">
                <h1 class="text-center">Feedbacks</h1>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-9 col-md-4 mb-3 mb-md-0 h-100">
                <div class="card card-span text-white h-100">
                    <img
                        class="img-card h-100"
                        src="{{
                            asset('frontnew/assets/img/file/myanmar.jpeg')
                        }}"
                        alt="..."
                    />
                    <div class="card-body px-xl-5 px-md-3 pt-0 pb-7">
                        <div
                            class="
                                d-flex
                                justify-content-between
                                align-items-center
                                bg-100
                                mt-n5
                                me-auto
                            "
                        >
                            <img
                                src="{{
                                    asset(
                                        'frontnew/assets/img/file/myanmar.jpeg'
                                    )
                                }}"
                                width="60"
                                alt="..."
                            />
                            <div class="d-flex flex-1 justify-content-around">
                                <span class="text-900 text-center"
                                    ><i class="fas fa-heart text-primary"></i
                                    ><span class="text-900 ms-2"
                                        >355</span
                                    ></span
                                ><span class="text-900 text-center"
                                    ><i class="fas fa-eye text-primary"></i
                                    ><span class="text-900 ms-2"
                                        >234</span
                                    ></span
                                ><span class="text-900 text-center"
                                    ><i class="fas fa-share text-primary"></i
                                    ><span class="text-900 ms-2">14</span></span
                                >
                            </div>
                        </div>
                        <h5 class="text-900 mt-3">
                            John Oliver.
                            <span class="fw-normal">5 mins Read. </span>
                        </h5>
                        <h3 class="fw-bold text-1000 mt-5 text-truncate">
                            15 Best Day Trips from Portland Oregon
                        </h3>
                        <p class="text-900 mt-3">
                            The structure of the trip blog is only a white
                            canvas to highlight the atmospheric and immersive.
                        </p>
                        <a
                            class="
                                btn btn-lg
                                text-900
                                fs-1
                                px-0
                                hvr-icon-forward
                            "
                            href="#!"
                            role="button"
                            >Read more
                            <svg
                                class="bi bi-arrow-right-short hover-icon"
                                xmlns="http://www.w3.org/2000/svg"
                                width="30"
                                height="30"
                                fill="currentColor"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"
                                ></path></svg
                        ></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 col-md-4 mb-3 mb-md-0 h-100">
                <div class="card card-span text-white h-100">
                    <img
                        class="img-card h-100"
                        src="{{
                            asset('frontnew/assets/img/file/myanmar.jpeg')
                        }}"
                        alt="..."
                    />
                    <div class="card-body px-xl-5 px-md-3 pt-0 pb-7">
                        <div
                            class="
                                d-flex
                                justify-content-between
                                align-items-center
                                bg-100
                                mt-n5
                                me-auto
                            "
                        >
                            <img
                                src="{{
                                    asset(
                                        'frontnew/assets/img/file/myanmar.jpeg'
                                    )
                                }}"
                                width="60"
                                alt="..."
                            />
                            <div class="d-flex flex-1 justify-content-around">
                                <span class="text-900 text-center"
                                    ><i class="fas fa-heart text-primary"></i
                                    ><span class="text-900 ms-2">35</span></span
                                ><span class="text-900 text-center"
                                    ><i class="fas fa-eye text-primary"></i
                                    ><span class="text-900 ms-2">23</span></span
                                ><span class="text-900 text-center"
                                    ><i class="fas fa-share text-primary"></i
                                    ><span class="text-900 ms-2">14</span></span
                                >
                            </div>
                        </div>
                        <h5 class="text-900 mt-3">
                            Haley Wilson .
                            <span class="fw-normal">5 mins Read. </span>
                        </h5>
                        <h3 class="fw-bold text-1000 mt-5 text-truncate">
                            Famous Roads for Great Drives in California
                        </h3>
                        <p class="text-900 mt-3">
                            I first discovered about famous road in california
                            when I flew with KLM to Europe in 2018.
                        </p>
                        <a
                            class="
                                btn btn-lg
                                text-900
                                fs-1
                                px-0
                                hvr-icon-forward
                            "
                            href="#!"
                            role="button"
                            >Read more
                            <svg
                                class="bi bi-arrow-right-short hover-icon"
                                xmlns="http://www.w3.org/2000/svg"
                                width="30"
                                height="30"
                                fill="currentColor"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"
                                ></path></svg
                        ></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 col-md-4 mb-3 mb-md-0 h-100">
                <div class="card card-span text-white h-100">
                    <img
                        class="img-card h-100"
                        src="{{
                            asset('frontnew/assets/img/file/myanmar.jpeg')
                        }}"
                        alt="..."
                    />
                    <div class="card-body px-xl-5 px-md-3 pt-0 pb-7">
                        <div
                            class="
                                d-flex
                                justify-content-between
                                align-items-center
                                bg-100
                                mt-n5
                                me-auto
                            "
                        >
                            <img
                                src="{{
                                    asset(
                                        'frontnew/assets/img/file/myanmar.jpeg'
                                    )
                                }}"
                                width="60"
                                alt="..."
                            />
                            <div class="d-flex flex-1 justify-content-around">
                                <span class="text-900 text-center"
                                    ><i class="fas fa-heart text-primary"></i
                                    ><span class="text-900 ms-2">35</span></span
                                ><span class="text-900 text-center"
                                    ><i class="fas fa-eye text-primary"></i
                                    ><span class="text-900 ms-2">23</span></span
                                ><span class="text-900 text-center"
                                    ><i class="fas fa-share text-primary"></i
                                    ><span class="text-900 ms-2">14</span></span
                                >
                            </div>
                        </div>
                        <h5 class="text-900 mt-3">
                            Jeff Baley.
                            <span class="fw-normal">5 mins Read. </span>
                        </h5>
                        <h3 class="fw-bold text-1000 mt-5 text-truncate">
                            7 of the Best Train Trips in Canada
                        </h3>
                        <p class="text-900 mt-3">
                            On this very stunning rail ride from Vancouver to
                            Calgary, take in the stunning vistas andspectacular.
                        </p>
                        <a
                            class="
                                btn btn-lg
                                text-900
                                fs-1
                                px-0
                                hvr-icon-forward
                            "
                            href="#!"
                            role="button"
                            >Read more
                            <svg
                                class="bi bi-arrow-right-short hover-icon"
                                xmlns="http://www.w3.org/2000/svg"
                                width="30"
                                height="30"
                                fill="currentColor"
                                viewBox="0 0 16 16"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"
                                ></path></svg
                        ></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



    @include('layouts.footer')
        

@endsection @section('script')
<script></script>

@endsection
