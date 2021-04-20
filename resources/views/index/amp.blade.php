@extends('support::amp')

@section('content')
    @include('waivers::index.partials._identity_tag')

    {{-- Place holder content - safe to replace --}}
    <ul>
        @foreach($locations as $location)
            <li>Location: {{ $location->name }}</li>
        @endforeach
    </ul>
@endsection
