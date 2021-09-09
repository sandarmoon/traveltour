@extends('frontendnew')
@section('main-content')
<livewire:wizard :cars="$cars" :pickup="$pickup" :drop="$drop" :sdate="$s_date" :edate="$e_date" />

@endsection