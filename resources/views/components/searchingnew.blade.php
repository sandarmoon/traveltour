<section class="mt-7 py-0">
    <div
        class="bg-holder w-50 bg-right d-none d-lg-block searching-background"
    ></div>
    <!--/.bg-holder-->

    <div class="container">
        <div class="row">
            <div class="col-lg-6 py-5 py-xl-5 py-xxl-7">
                <h1 class="display-3 text-1000 fw-normal">
                    Plan Your Adventure Here!
                </h1>
                <h1 class="display-3 text-primary fw-bold">
                    Discover the beauty
                </h1>
                <p class="lead fw-normal text-dark-50 mb-0">
                    Take only memories, leave only footprints
                </p>
                <div class="pt-5 mt-2">
                    <nav>
                        <div
                            class="nav nav-tabs voyage-tabs"
                            id="nav-tab"
                            role="tablist"
                        >
                            <button
                                class="nav-link active"
                                id="nav-home-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#nav-home"
                                type="button"
                                role="tab"
                                aria-controls="nav-home"
                                aria-selected="true"
                                title="Car"
                            >
                                <i
                                    class="fas fa-car"
                                    style="font-size: 30px"
                                ></i>
                            </button>
                            <button
                                class="nav-link"
                                id="nav-profile-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#nav-profile"
                                type="button"
                                role="tab"
                                aria-controls="nav-profile"
                                aria-selected="false"
                                title="Hotel"
                            >
                                <i
                                    class="fas fa-hotel"
                                    style="font-size: 30px"
                                ></i>
                            </button>

                            <button
                                class="nav-link "
                                id="nav-contact-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#nav-contact"
                                type="button"
                                role="tab"
                                aria-controls="nav-contact"
                                aria-selected="false"
                                title="Packages"
                            >
                                <i
                                    class="fas fa-suitcase-rolling"
                                    style="font-size: 30px"
                                ></i>
                            </button>
                        </div>

                        <div class="tab-content" id="nav-tabContent">
                            {{-- search car --}}
                            <div
                                class="tab-pane fade show active"
                                id="nav-home"
                                role="tabpanel"
                                aria-labelledby="nav-home-tab"
                            >
                                <form
                                    class="row g-4 mt-4"
                                    action="{{ route('search.car') }}"
                                    method="post"
                                >
                                    @csrf
                                    <div class="col-sm-6 col-md-6 col-xl-5">
                                        <div class="input-group-icon">
                                            <label
                                                class="form-label text-800"
                                                for="inputAddress1"
                                                >Departure</label
                                            >

                                            <select
                                                class="form-control"
                                                name="p_city_id"
                                            >
                                                @foreach($cities as $c)
                                                <option value="{{$c->id}}">
                                                    {{$c->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-xl-5">
                                        <div class="input-group-icon">
                                            <label
                                                class="form-label text-800"
                                                for="inputAddress2"
                                                >Destination</label
                                            >
                                            <select
                                                class="form-control"
                                                name="d_city_id"
                                            >
                                                @foreach($cities as $c)
                                                <option value="{{$c->id}}">
                                                    {{$c->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-xl-5">
                                        <div class="input-group-icon">
                                            <label
                                                class="form-label text-800"
                                                for="inputAddress2"
                                                >Check In</label
                                            >
                                            <input
                                                class="
                                                    form-control
                                                    input-box
                                                    form-voyage-control
                                                "
                                                name="start_date"
                                                id="inputdateOne"
                                                type="date"
                                            /><span
                                                class="
                                                    nav-link-icon
                                                    text-800
                                                    fs--1
                                                    input-box-icon
                                                "
                                            ></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-xl-5">
                                        <div class="input-group-icon">
                                            <label
                                                class="form-label text-800"
                                                for="inputAddress2"
                                                >Check Out</label
                                            >

                                            <input
                                                class="
                                                    form-control
                                                    input-box
                                                    form-voyage-control
                                                "
                                                name="end_date"
                                                id="inputDateTwo"
                                                type="date"
                                            /><span
                                                class="
                                                    nav-link-icon
                                                    text-800
                                                    fs--1
                                                    input-box-icon
                                                "
                                            ></span>
                                        </div>
                                    </div>

                                    <div
                                        class="
                                            col-12 col-xl-10 col-lg-12
                                            d-grid
                                            mt-6
                                        "
                                    >
                                        <button
                                            class="btn btn-secondary"
                                            type="submit"
                                        >
                                            Search Car !
                                        </button>
                                    </div>
                                </form>
                            </div>

                            {{-- search hotel --}}
                            <div
                                class="tab-pane fade"
                                id="nav-profile"
                                role="tabpanel"
                                aria-labelledby="nav-profile-tab"
                            >
                                <form
                                    class="row g-4 mt-5"
                                    id="hotel-search-div"
                                    action="{{ route('search.hotel') }}"
                                    method="post"
                                >
                                    @csrf

                                    <div class="col-sm-10 col-md-10 col-xl-10">
                                        <div class="input-group-icon">
                                            <label
                                                class="form-label text-800"
                                                for="inputAddress2"
                                                >Destination
                                                @error('d_city_id')
                                                <span class="text-danger">required</span>
                                                @enderror
                                            </label >
                                            <select class="example_select2 from-control" style="width: 100%" name="d_city_id">
                                                @foreach($cities as $c)
                                                <option value="{{$c->id}}">
                                                    {{$c->name}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-xl-5">
                                        <div class="input-group-icon">
                                            <label
                                                class="form-label text-800"
                                                for="inputAddress2"
                                                >Check In
                                                @error('start_date')
                                                <span class="text-danger">required</span> 
                                                @enderror
                                            </label>
                                            <input
                                                class="
                                                    form-control
                                                    input-box
                                                    form-voyage-control
                                                "
                                                name="start_date"
                                                id="inputdateOne"
                                                type="date"
                                            /><span
                                                class="
                                                    nav-link-icon
                                                    text-800
                                                    fs--1
                                                    input-box-icon
                                                "
                                            ></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-xl-5">
                                        <div class="input-group-icon">
                                            <label
                                                class="form-label text-800"
                                                for="inputAddress2"
                                                >Check Out 
                                                @error('end_date')
                                                <span class="text-danger">required</span>
                                                @enderror
                                            </label>

                                            <input
                                                class="
                                                    form-control
                                                    input-box
                                                    form-voyage-control
                                                "
                                                name="end_date"
                                                id="inputDateTwo"
                                                type="date"
                                            /><span
                                                class="
                                                    nav-link-icon
                                                    text-800
                                                    fs--1
                                                    input-box-icon
                                                "
                                            ></span>
                                        </div>
                                    </div>

                                    <div class="col-10 d-grid mt-6">
                                        <input
                                            type="submit"
                                            class="
                                                btn
                                                btn-secondary
                                                btn-hotel-search
                                            "
                                            {{--
                                            id="inputPassword2"
                                            --}}
                                            value="Search Hotel !"
                                        />
                                        {{--
                                        <button
                                            class="
                                                btn
                                                btn-secondary
                                                btn-hotel-search
                                            "
                                            type="submit"
                                        >
                                            Search Hotel
                                        </button>
                                        --}}
                                    </div>
                                </form>
                            </div>

                            {{-- search packages --}}

                            <div
                                class="tab-pane fade"
                                id="nav-contact"
                                role="tabpanel"
                                aria-labelledby="nav-contact-tab"
                            >
                                <form class="row g-4 mt-2" id="package-search-div">
                                    <div class="col-sm-8 col-md-8 col-xl-8">
                                        <div class="input-group-icon">
                                            <label for="package-search-from">Pick Up Any Package for your Previous Time</label>
                                            <select name="" id="package-search-from" class="form-control 
                                                    input-box
                                                    form-voyage-control" id="">
                                                    @foreach($packages as $package)
                                                    <option value="{{$package->id}}">{{$package->name}}-{{$package->days}} Nights Trip</option>
                                                    @endforeach
                                                    
                                                </select>
                                            <span
                                                class="
                                                    nav-link-icon
                                                    text-800
                                                    fs--1
                                                    input-box-icon mt-3
                                                "
                                                ><i class="fas fa-suitcase-rolling"></i
                                            ></span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-10 d-grid mt-6 ">
                                        <button
                                            class="btn btn-secondary"
                                            type="submit"
                                        >
                                            View Package !
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

@push('script') @if(!empty(Session::get('error_code')) &&
Session::get('error_code') == 2)
<script>
    $(function () {
        $(".nav-tabs .active").removeClass("active");
        $(".tab-content .active").removeClass("active");
        $("#nav-profile-tab").addClass("active");
        $("#nav-profile").removeClass("fade");
        $("#nav-profile").addClass("active");
    });
</script>
@endif

<script>
    $(function () {
        $(".btn-hotel-search").click(function (e) {
            // console.log("data helelo");

            e.preventDefault();
            alert("heo");
            let city = $('#hotel-search-div select[name="d_city_id"]').val();
            let check_in = $(
                '#hotel-search-div input[name="start_date"]'
            ).val();
            let check_out = $('#hotel-search-div input[name="end_date"]').val();
            localStorage.clear();
            mycart(city, check_in, check_out, "mycounting");

            $("#hotel-search-div").submit();
        });
    });
    function mycart(desti, s_date, end_date, code) {
        // console.log(desti,s_date,end_date,s_type,c_type);

        let rooms = new Array();
        let exit = 0;
        let room = {
            rno: 1,
            r_id: 0,
            child: 0,
            adult: 1,
            total: 1,
        };

        rooms.push(room);

        let item = {
            codeno: code,
            desti: desti,
            start: s_date,
            end: end_date,
            r: rooms,
        };

        let mycart = localStorage.getItem(code);
        if (!mycart) {
            let cartobj = JSON.parse(mycart);
            cartobj = item;
            localStorage.setItem(code, JSON.stringify(cartobj));
            // alert("Your chosen item is added to cart!");
        } else {
            // alert("it is  no");
        }
    }
</script>

@endpush
