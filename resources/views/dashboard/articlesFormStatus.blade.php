@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="media">
                            <div class="media-body">
                                <h4 class="media-heading">Articles</h4>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <table class="table table-striped table-hover" id="articles">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>User</th>
                                        <th>Created at</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articles as $article)
                                        <tr>
                                            <td>{{ $article->id }}</td>
                                            <td>{{ $article->title }}</td>
                                            <td>{{ $article->user->first_name }}</td>
                                            <td>{{ Carbon\Carbon::parse($article->created_at)->diffForHumans() }}</td>
                                            <td>
                                                @if($article->active == 1)
                                                    <button id="{{ $article->id }}" class="btn btn-success btn-sm" onclick="changeStatus({{ $article->id }})"><i class="fa fa-check-circle" aria-hidden="true"></i></button>
                                                @else
                                                    <button id="{{ $article->id }}" class="btn btn-danger btn-sm" onclick="changeStatus({{ $article->id }})"><i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#articles').DataTable();
        });
    </script>
    <script>
        function changeStatus(id) {
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'articlesChangeStatus/'+id,
                beforeSend: function () {
                    $("#"+id).removeClass("btn-danger");
                    $("#"+id).removeClass("btn-success");
                    $("#"+id).addClass("btn-default");
                    $("#"+id).html('<i class="fa fa-refresh fa-spin"></i>');
                },
                success: function(result){
                    if(result == true){
                        $("#"+id).removeClass("btn-danger");
                        $("#"+id).addClass("btn-success");
                        $("#"+id).html('<i class="fa fa-check-circle" aria-hidden="true"></i>');
                    }else if(result == false){
                        $("#"+id).removeClass("btn-success");
                        $("#"+id).addClass("btn-danger");
                        $("#"+id).html('<i class="fa fa-times-circle" aria-hidden="true"></i>');
                    }else{
                        console.log(result)
                    }
                }
            });
        }
    </script>
@endsection