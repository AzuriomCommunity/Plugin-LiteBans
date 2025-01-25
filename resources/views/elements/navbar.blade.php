<h2>{{ trans('litebans::messages.title') }}</h2>

<nav class="navbar navbar-expand-lg border rounded mb-4">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto">
            <li class="nav-item {{ request()->routeIs('litebans.index') ? 'active' : ''}}"><a class="nav-link" href="{{ route('litebans.index') }}">{{ trans('litebans::messages.navigation.bans') }} ({{ $bansCount }})</a></li>
            @if(setting('litebans.mutes_enabled', true))
            <li class="nav-item {{ request()->routeIs('litebans.mute') ? 'active' : ''}}"><a class="nav-link" href="{{ route('litebans.mute') }}">{{ trans('litebans::messages.navigation.mutes') }} ({{ $mutesCount }})</a></li>
            @endif
            @if(setting('litebans.kicks_enabled', true))
            <li class="nav-item {{ request()->routeIs('litebans.kick') ? 'active' : ''}}"><a class="nav-link" href="{{ route('litebans.kick') }}">{{ trans('litebans::messages.navigation.kicks') }} ({{ $kicksCount }})</a></li>
            @endif
            @if(setting('litebans.warns_enabled', true))
            <li class="nav-item {{ request()->routeIs('litebans.warn') ? 'active' : ''}}"><a class="nav-link" href="{{ route('litebans.warn') }}">{{ trans('litebans::messages.navigation.warns') }} ({{ $warnsCount }})</a></li>
            @endif
        </ul>
        <form action="{{ route('litebans.search') }}" class="d-flex" role="search">
            <input class="form-control me-2" type="search" name="search">
            <button class="btn btn-outline-primary btn-block" type="submit">Rechercher</button>
        </form>
    </div>
  </div>
</nav>

@if(session()->has('error-search'))
<div class="alert alert-danger alert-search alert-dismissible fade show mt-3" role="alert">
    <i class="bi bi-exclamation-circle-fill"></i>
    {{ session()->get('error-search') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
