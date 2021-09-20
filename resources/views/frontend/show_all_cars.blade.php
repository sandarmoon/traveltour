@extends('frontendnew')
@section('main-content')
<!-- Header-->
<x-searching left=700 :packages="$packages"></x-searching>

<!-- Section for card-->
@include('layouts.foot')
@endsection
@section('script')
<script>

</script>
@endsection
