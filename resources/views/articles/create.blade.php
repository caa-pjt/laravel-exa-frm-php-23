@extends('layouts.app')

@section('content')
<h1>New article</h1>
<div class="row justify-content-between">
    <div class="col-4">
        <form action="{{ route('articles.store') }}" method="POST">
            @method('POST')
            @csrf

            @include('layouts.form')

        </form>
    </div>
</div>
@endsection