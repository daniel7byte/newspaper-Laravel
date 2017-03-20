@extends('../layouts.app')

@section('head')
    <link rel="stylesheet" href="/trumbowyg/ui/trumbowyg.min.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include('alerts.success')
                @include('alerts.warning')
                <div class="panel panel-default">
                    <div class="panel-heading">Edit article</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('articles.update', ['article' => $article]) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PUT">

                            @if(Auth::user()->role == "ADMIN")
                                <div class="form-group has-warning">
                                    <label class="col-md-4 control-label">by</label>
                                    
                                    <div class="col-md-6">
                                        <p class="form-control">{{ $article->user->first_name }} {{ $article->user->last_name }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            <hr>

                            <div class="form-group">
                                <label for="image" class="col-md-4 control-label">Image</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control" name="image" accept="image/*">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ $article->title or old('title') }}" required autofocus>

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="text" class="form-control" name="description">
                                        {!! $article->description or old('description') !!}
                                    </textarea>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('category_ref') ? ' has-error' : '' }}">
                                <label for="category_ref" class="col-md-4 control-label">Category</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="category_ref" name="category_ref">
                                        @foreach( $categories as $category )
                                            @if($category->title == $article->category_ref or $category->title == old('category_ref'))
                                                <option value="{{ $category->title }}" selected>{{ $category->title }}</option>
                                            @else
                                                <option value="{{ $category->title }}">{{ $category->title }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @if ($errors->has('category_ref'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('category_ref') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('grade_ref') ? ' has-error' : '' }}">
                                <label for="grade_ref" class="col-md-4 control-label">Grade</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="grade_ref" name="grade_ref">
                                        @foreach( $grades as $grade )
                                            @if($grade->title == $article->grade_ref or $grade->title == old('grade_ref'))
                                                <option value="{{ $grade->title }}" selected>{{ $grade->title }}</option>
                                            @else
                                                <option value="{{ $grade->title }}">{{ $grade->title }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @if ($errors->has('grade_ref'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('grade_ref') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('institution_ref') ? ' has-error' : '' }}">
                                <label for="institution_ref" class="col-md-4 control-label">Institution</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="institution_ref" name="institution_ref">
                                        @foreach( $institutions as $institution )
                                            @if($institution->title == $article->institution_ref or $institution->title == old('institution_ref'))
                                                <option value="{{ $institution->title }}" selected>{{ $institution->title }}</option>
                                            @else
                                                <option value="{{ $institution->title }}">{{ $institution->title }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @if ($errors->has('institution_ref'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('institution_ref') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="well well-sm">
                                        <div class="col-md-2">
                                            <i class="fa fa-warning fa-3x" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-md-10">
                                            The item will not be displayed until it is enabled by an administrator
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="fa fa-pencil" aria-hidden="true"></span> Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="/trumbowyg/trumbowyg.min.js"></script>
    <script src="/trumbowyg/langs/es.min.js"></script>
    <script>
        $('textarea').trumbowyg({
            lang: 'es',
            btns: [
                // ['viewHTML'],
                ['formatting'],
                'btnGrp-semantic',
                // ['superscript', 'subscript'],
                ['link'],
                // ['insertImage'],
                'btnGrp-justify',
                'btnGrp-lists',
                ['horizontalRule'],
                // ['removeformat'],
                // ['fullscreen']
            ]
        });
    </script>
@endsection