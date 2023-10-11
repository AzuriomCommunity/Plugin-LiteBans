@extends('admin.layouts.admin')

@section('title', trans('litebans::admin.settings.title'))

@section('content')
    <form action="{{ route('litebans.admin.settings') }}" method="POST">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">{{ trans('litebans::admin.settings.database-connect') }}</h6>
            </div>
            <div class="card-body">

                <div class="mb-3">
                    <label for="host" class="form-label">{{ trans('litebans::admin.settings.host') }}</label>
                    <input class="form-control" id="host" name="host" value="{{ $host }}" required="required">
                </div>

                <div class="mb-3">
                    <label for="port" class="form-label">{{ trans('litebans::admin.settings.port') }}</label>
                    <input class="form-control" id="port" name="port" value="{{ $port }}" required="required">
                </div>

                <div class="mb-3">
                    <label for="database" class="form-label">{{ trans('litebans::admin.settings.database') }}</label>
                    <input class="form-control" id="database" name="database" value="{{ $database }}"
                           required="required">
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">{{ trans('litebans::admin.settings.username') }}</label>
                    <input class="form-control" id="username" name="username" value="{{ $username }}"
                           required="required">
                </div>

                <div class="mb-3">
                    <label for="password">{{ trans('litebans::admin.settings.password') }}</label>
                    <input class="form-control" id="password" name="password" type="password" value="{{ $password }}"
                           required="required">
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">{{ trans('litebans::admin.settings.other-settings') }}</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="perpage" class="form-label">{{ trans('litebans::admin.settings.perpage') }}</label>
                    <input class="form-control" id="perpage" name="perpage" value="{{ $perpage }}" required="required">
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ trans('messages.actions.save') }}
                </button>
            </div>
        </div>
    </form>
@endsection
