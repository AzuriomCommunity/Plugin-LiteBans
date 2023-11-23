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

                <div class="mb-3">
                    <label for="prefix">{{ trans('litebans::admin.settings.prefix') }}</label>
                    <input class="form-control" id="prefix" name="prefix" type="prefix" value="{{ $prefix ?? 'litebans_' }}"
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
                    <input class="form-control" type="text" id="perpage" name="perpage" value="{{ $perpage }}" required="required">
                </div>
                {{ trans('litebans::admin.settings.features.title') }}
                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" id="mutes_enabled" name="mutes_enabled" {{ $mutes_enabled ? 'checked' : '' }}>
                    <label class="form-check-label" for="mutes_enabled">{{ trans('litebans::admin.settings.features.mutes') }}</label>
                </div>
                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" id="kicks_enabled" name="kicks_enabled" {{ $kicks_enabled ? 'checked' : '' }}>
                    <label class="form-check-label" for="kicks_enabled">{{ trans('litebans::admin.settings.features.kicks') }}</label>
                </div>
                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" id="warns_enabled" name="warns_enabled" {{ $warns_enabled ? 'checked' : '' }}>
                    <label class="form-check-label" for="warns_enabled">{{ trans('litebans::admin.settings.features.warns') }}</label>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ trans('messages.actions.save') }}
                </button>
            </div>
        </div>
    </form>
@endsection
