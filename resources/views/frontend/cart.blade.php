@extends('frontendnew')
@section('main')
<!-- Header-->
        <header class=" py-2 banner ">
            <div class="container px-4 px-lg-5 my-5  ">
               
                <!-- <div class="text-center ">
                    <h1 class="display-4 fw-bolder">Plan  Your Adventure  Here!</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Take only memories, leave only footprints</p>
                    <button class="btn btn-warning"> Start Now!</button>
                </div> -->
                <x-searching :cities="$cities" left=700 ></x-searching>

            </div>
        </header>
        <!-- Section for card-->
        
@endsection
@section('script')
<script>
    
</script>
@endsection