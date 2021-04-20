@extends('support::amp')

@section('content')
    @include('waivers::show.partials._identity_tag')

    {{-- Place holder content - safe to replace --}}
    <ul>
        <li>Location: {{ $location->name }}</li>
    </ul>
@endsection
