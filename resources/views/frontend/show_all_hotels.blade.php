@extends('frontendnew')
@section('main-content')
<!-- Header-->
<x-searchingnew :cities="$cities" :packages="$packages" />


<!-- Section for card-->
@include('layouts.foot')
@endsection
@section('script')
<script>

</script>
@endsection
