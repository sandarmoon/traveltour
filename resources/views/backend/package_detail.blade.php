@extends('backendTemplate') @section('main-content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-7">
    <div class="container-fluid">
        <div class="my-ct-page-title text-white">
            <h1 class="ct-title text-white d-inline-block" id="content">
                {{$package->name}} -> {{$package->days}} Days Trip
            </h1>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <a
                class="ct-example text-white float-right border-0"
                href="{{ route('package.index') }}"
            >
                <i class="ni ni-bold-left"></i>
                <span class="error-name">Back</span>
            </a>
        </div>
    </div>
</div>
<div class="container-fluid mt--8">
    <div class="my-card mb-3">
        <div class="card-body container p-0">
            <div class="row p-2 my-row-flex ">
                <div class="col-sm-6   order-2">
                    <div class="card  content">
                        <div class="card-header">Tour Introduction</div>
                        <div class="card-body">
                            <div class="card">
                                <div
                                    id="carouselExampleSlidesOnly"
                                    class="carousel slide"
                                    data-bs-ride="carousel"
                                >
                                    <div class="carousel-inner">
                                        @php $s=0;
                                        $tours=$package->tours;
                                        $photos=[];
                                        foreach($tours as $t){
                                           $places= json_decode($t->photo,true);
                                            foreach($places as $v){
                                                array_push($photos,$v);
                                            }
                                        }
                                        
                                        
                                        @endphp
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
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    {{$package->desc}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6    order-1">
                    <div class="card content">
                        <div class="card-header">
                            Package Detail @if($package->status ==1)
                            <span class="text-warning float-right">Valid</span>

                            @elseif($package->status==2)
                            <span class="text-success float-right"> full </span>

                            @else
                            <span class="text-danger float-right"
                                >Expire Package</span
                            >
                            @endif
                        </div>
                        <div class="card-body">
                            <div>
                                <table class="table table-hover dt-responsive">
                                    <tr>
                                        <td >Departure City</td>
                                        <td>
                                            {{$package->depart->name}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td >destination City</td>
                                        <td>{{$package->destination->name}}</td>
                                    </tr>
                                    <tr>
                                        <td >Departure Date</td>
                                        <td>{{$package->start}}</td>
                                    </tr>
                                    <tr>
                                        <td >Arrival Date</td>
                                        <td>{{$package->end}}</td>
                                    </tr>
                                    <tr>
                                        <td >Days</td>
                                        <td>{{$package->days}}</td>
                                    </tr>
                                    <tr>
                                        <td >Price per person</td>
                                        <td>{{$package->priceperperson}}</td>
                                    </tr>
                                    <tr>
                                        <td >Vehicle/Car</td>
                                        <td>
                                            {{$package->car->name



                                            }}({{$package->car->type->name



                                            }}-{{$package->car->model



                                            }})/{{$package->car->company->name}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td >Stay/Hotel</td>
                                        <td>
                                            {{$package->hotel->name}}
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="my-3 p-3">
                                <h4>Package Trip Planning</h4>
                                <ul>
                                    @php $i=1; @endphp @foreach($package->tours
                                    as $tour)
                                    <li>
                                        <p>{{$tour->title}}</p>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
            </div>
            

        </div>
    </div>
</div>
<x-footer-component/>

@endsection @section('script') @endsection
