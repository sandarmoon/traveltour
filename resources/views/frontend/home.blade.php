@extends('frontendTemplate')
@section('main')
<!-- Header-->
 @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
        @include('layouts.slider')
        <x-searching :cities="$cities"  ></x-searching>
        
@endsection
@section('script')
<script>
    
</script>
@endsection