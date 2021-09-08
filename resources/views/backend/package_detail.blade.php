@extends('backendTemplate') @section('main')
<!-- Header-->
@if (session()->has('message'))
<div class="alert alert-success">
    {{ session("message") }}
</div>
@endif

<div class="card container mt-3 my-3 p-3">
    <div class="d-flex justify-content-between my-3 mx-2">
        <h5 class="description d-inline-block">Package Infromation</h5>
        <a href="{{url()->previous()}}" class="btn-close float-left"></a>
    </div>

    <div class="col-md-10 offset-1">
        <div class="row">
            <div class="col-md-5">
                <h4 class="mb-0">
                    {{$package->name}} -> {{$package->days}} Days Trip
                </h4>

                <p class="small text-muted">{{$package->days}} Days</p>
                {{-- accordian start --}}
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" style="font-size: 1.135rem">
                        <i class="fas fa-user-friends"></i>
                        {{$package->ppl}} Travellers
                    </li>
                    <li class="list-group-item" style="font-size: 1.135rem">
                        <i class="fas fa-hotel"></i>{{$package->hotel->name}}
                    </li>
                    <li class="list-group-item" style="font-size: 1.135rem">
                        <i class="fas fa-car"></i
                        >{{$package->car->name}} ({{$package->car->type->name



                        }}-{{$package->car->model


                        }}),{{$package->car->company->name}}
                    </li>
                    <li class="list-group-item" style="font-size: 1.135rem">
                        <i class="fas fa-check"></i> Reserve Now,Pay Later
                    </li>
                </ul>

                <h5 class="my-3">Room Amenities</h5>
                <ul class="list-group list-unstyled">
                    <li
                        class="
                            list-group-item
                            d-flex
                            justify-content-between
                            align-items-start
                        "
                    >
                        <div class="ms-2 me-auto">
                            <div class="fw-bold"></div>
                            <ul></ul>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="col-md-7">
                <div class="card">
                    <div
                        id="carouselExampleSlidesOnly"
                        class="carousel slide"
                        data-bs-ride="carousel"
                    >
                        <div class="carousel-inner"></div>
                    </div>
                </div>
                <h4 class="description mt-3">Package Option</h4>
                <div class="card mt-2">
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0">
                                    ${{$package->priceperperson}}
                                </h4>
                                <span class="price-desc small mb-2 text-muted"
                                    >per person</span
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection @section('script')
<script></script>
@endsection
