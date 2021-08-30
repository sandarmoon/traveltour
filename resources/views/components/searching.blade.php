<div class="search-div">
    <div class="">
        <nav class="px-3">
            <div class="nav nav-tabs my-nav mp-3" id="nav-tab" role="tablist">
                <div
                    class="
                        search-item
                        active
                        col
                        bg-light
                        d-flex
                        justify-content-center
                        py-4
                    "
                    id="nav-home-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#nav-home"
                    type="button"
                    role="tab"
                    aria-controls="nav-home"
                    aria-selected="true"
                    style="border-top-left-radius: 90px"
                >
                    <span class="icon icon-hotel"></span>
                    <p class="label-text mt-2">Car</p>
                </div>

                <div
                    class="
                        search-item
                        col
                        bg-light
                        py-4
                        d-flex
                        justify-content-center
                    "
                    id="nav-profile-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#nav-profile"
                    type="button"
                    role="tab"
                    aria-controls="nav-profile"
                    aria-selected="false"
                >
                    <span class="icon icon-hotel"></span>
                    <p class="label-text mt-2">Hotel</p>
                </div>

                <div
                    class="
                        search-item
                        col
                        bg-light
                        py-4
                        d-flex
                        justify-content-center
                    "
                    id="nav-contact-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#nav-contact"
                    type="button"
                    role="tab"
                    aria-controls="nav-contact"
                    aria-selected="false"
                    style="border-top-right-radius: 90px"
                >
                    <span class="icon icon-jounery"></span>
                    <p class="label-text mt-2">Package</p>
                </div>
            </div>
        </nav>
        <div
            class="tab-content py-5 search-content"
            style="width: 100%"
            id="nav-tabContent"
        >
            <div
                class="tab-pane fade show active p-3"
                id="nav-home"
                role="tabpanel"
                aria-labelledby="nav-home-tab"
            >
                <form
                    action="{{ route('search.car') }}"
                    class="
                        mx-5
                        d-flex
                        flex-lg-row flex-column
                        justify-content-lg-between justify-content-center
                    "
                    method="post"
                >
                    @csrf
                    <!-- start here -->
                    <div
                        class="
                            mb-3
                            px-lg-3 px-md-3
                            flex-grow-1
                            px-sm-0 px-xs-0 px-0
                        "
                    >
                        <label for="inputPassword2" class="">Departure </label>

                        <select
                            class="example_select2"
                            name="p_city_id"
                            style="width: 100%; line-height: 26px"
                        >
                            @foreach($cities as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div
                        class="
                            mb-3
                            px-lg-3 px-md-3
                            flex-grow-1
                            px-sm-0 px-xs-0 px-0
                        "
                    >
                        <label for="inputPassword2" class=""
                            >Destination
                        </label>

                        <select
                            class="example_select2 from-control"
                            name="d_city_id"
                            style="width: 100%"
                        >
                            @foreach($cities as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 px-lg-3 px-md-3 px-sm-0 px-xs-0 px-0">
                        <label for="inputPassword2" class="">Check In</label>
                        <input
                            type="date"
                            class="form-control"
                            name="start_date"
                            id="inputPassword2"
                            placeholder=""
                        />
                    </div>
                    <div class="mb-3 px-lg-3 px-md-3 px-sm-0 px-xs-0 px-0">
                        <label for="inputPassword2" class="">Check Out</label>
                        <input
                            type="date"
                            class="form-control"
                            name="end_date"
                            id="inputPassword2"
                            placeholder=""
                        />
                    </div>
                    <div class="px-lg-3 px-md-3 px-sm-0 px-xs-0 px-0">
                        <label for="inputPassword2" class="visually-hidden"
                            >Submit</label
                        >
                        <input
                            type="submit"
                            class="btn btn-success form-control btn-submit"
                            id="inputPassword2"
                            value="Search ...!"
                        />
                    </div>
                    <!-- end here -->
                </form>
            </div>
            <div
                class="tab-pane fade"
                id="nav-profile"
                role="tabpanel"
                aria-labelledby="nav-profile-tab"
            >
                <form
                    id="hotel-search-div"
                    action="{{ route('search.hotel') }}"
                    class="
                        col-md-8
                        mx-auto mx-5
                        d-flex
                        flex-lg-row flex-column
                        justify-content-lg-between justify-content-center
                    "
                    method="post"
                >
                    @csrf
                    <!-- start here -->

                    <div
                        class="
                            mb-3
                            px-lg-3 px-md-3
                            flex-grow-1
                            px-sm-0 px-xs-0 px-0
                        "
                    >
                        <label for="inputPassword2" class=""
                            >Destination @error('d_city_id')
                            <span class="text-danger">required</span>
                            @enderror</label
                        >

                        <select
                            class="example_select2 from-control"
                            name="d_city_id"
                            style="width: 100%"
                        >
                            @foreach($cities as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 px-lg-3 px-md-3 px-sm-0 px-xs-0 px-0">
                        <label for="inputPassword2" class=""
                            >Check In @error('start_date')
                            <span class="text-danger">required</span> @enderror
                        </label>
                        <input
                            type="date"
                            class="form-control"
                            name="start_date"
                            id="inputPassword2"
                            placeholder=""
                        />
                    </div>
                    <div class="mb-3 px-lg-3 px-md-3 px-sm-0 px-xs-0 px-0">
                        <label for="inputPassword2" class=""
                            >Check Out @error('end_date')
                            <span class="text-danger">required</span>
                            @enderror</label
                        >
                        <input
                            type="date"
                            class="form-control"
                            name="end_date"
                            id="inputPassword2"
                            placeholder=""
                        />
                    </div>

                    <div class="px-lg-3 px-md-3 px-sm-0 px-xs-0 px-0">
                        <label for="inputPassword2" class="visually-hidden"
                            >Submit</label
                        >
                        <input
                            type="submit"
                            class="
                                btn btn-success
                                form-control
                                btn-submit btn-hotel-search
                            "
                            id="inputPassword2"
                            value="Search ...!"
                        />
                    </div>
                    <!-- end here -->
                </form>
            </div>
            <div
                class="tab-pane fade"
                id="nav-contact"
                role="tabpanel"
                aria-labelledby="nav-contact-tab"
            >
                ..k.
            </div>
        </div>
    </div>
</div>
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
