@extends('front-end/layouts/layouts')
@section('content')
    @include('front-end.home.partials.search_form')

    @include('front-end.home.partials.ads')

    @include('front-end.home.partials.top_deal')

    @include('front-end.home.partials.customer_rating')

    @include('front-end.home.partials.population_route')


    @include('front-end.home.partials.population_place')

@stop
