@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Articles by {{ $user->first_name }}</div>

                <div class="panel-body">
                    @foreach ($articles as $article)
                        {{ $article->title }} |
                        {{ $article->user->first_name}}
                    @endforeach

                    {{ $articles->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
