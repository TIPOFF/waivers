@extends('support::amp')

@section('content')
    @include('waivers::confirmation.partials._identity_tag')

    {{-- Place holder content - safe to replace --}}
    <ul>
        <li>Location: {{ $location->name }}</li>
    </ul>
@endsection
