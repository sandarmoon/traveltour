@extends('frontendnew') @section('main-content')
<div class="container">
 <x-searchingnew :cities="$cities" :packages="$packages" />
 <livewire:wizard :cars="$cars" :pickup="$pickup" :drop="$drop" :sdate="$s_date" :edate="$e_date" />
</div>
@endsection
