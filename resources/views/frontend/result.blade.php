
@extends('frontendnew') @section('main-content')
<div class="container">
    <livewire:wizard
        :cars="$cars"
        :pickup="$pickup"
        :drop="$drop"
        :sdate="$s_date"
        :edate="$e_date"
    />
</div>
@endsection
