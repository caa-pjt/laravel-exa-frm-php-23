@extends('layouts.app')

@section('content')

<h1>Editer l'article</h1>
<div class="row justify-content-between">
    <div class="col-4">
        <form action="{{ route('articles.update', [$article]) }}" method="POST">
            @method('PATCH')
            @csrf

            @include('layouts.form')

        </form>
    </div>
</div>
@endsection