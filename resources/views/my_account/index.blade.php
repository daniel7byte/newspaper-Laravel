@extends('../layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('alerts.success')
                @include('alerts.warning')
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $user->first_name }}</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('my_account_update', ['user' => $user]) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="image" class="col-md-4 control-label">Image</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control" name="image" accept="image/*">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-md-4 control-label">First Name</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control" name="first_name" value="{{ $user->first_name or old('first_name') }}" required autofocus>

                                    @if ($errors->has('first_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name" class="col-md-4 control-label">Last Name</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control" name="last_name" value="{{ $user->last_name or old('last_name') }}" required>

                                    @if ($errors->has('last_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('grade') ? ' has-error' : '' }}">
                                <label for="last_name" class="col-md-4 control-label">Grade</label>

                                <div class="col-md-6">
                                    <select class="form-control" id="grade" name="grade" required>
                                        @foreach( $grades as $grade )
                                            @if($grade->title == $user->grade or old('grade'))
                                                <option value="{{ $grade->title }}" selected>{{ $grade->title }}</option>
                                            @else
                                                <option value="{{ $grade->title }}">{{ $grade->title }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @if ($errors->has('grade'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('grade') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('identification_document') ? ' has-error' : '' }}">
                                <label for="identification_document" class="col-md-4 control-label">Identification Document</label>

                                <div class="col-md-6">
                                    <input id="identification_document" type="number" class="form-control" name="identification_document" value="{{ $user->identification_document or old('identification_document') }}">

                                    @if ($errors->has('identification_document'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('identification_document') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('telephone') ? ' has-error' : '' }}">
                                <label for="telephone" class="col-md-4 control-label">Telephone</label>

                                <div class="col-md-6">
                                    <input id="telephone" type="number" class="form-control" name="telephone" value="{{ $user->telephone or old('telephone') }}">

                                    @if ($errors->has('telephone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label for="address" class="col-md-4 control-label">Address</label>

                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address" value="{{ $user->address or old('address') }}">

                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
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

