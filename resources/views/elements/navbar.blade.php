<h2>{{ trans('litebans::messages.title') }}</h2>

<nav class="navbar navbar-expand-lg navbar-light bg-white border rounded">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item {{ request()->routeIs('litebans.index') ? 'active' : ''}}">
          <a class="nav-link" href="{{ route('litebans.index') }}">{{ trans('litebans::messages.navigation.bans') }}
            ({{ count(Azuriom\Plugin\Litebans\Models\Bans::all()) }})</a>
        </li>
        <li class="nav-item {{ request()->routeIs('litebans.mute') ? 'active' : ''}}">
          <a class="nav-link" href="{{ route('litebans.mute') }}">{{ trans('litebans::messages.navigation.mutes') }}
            ({{ count(Azuriom\Plugin\Litebans\Models\Mutes::all()) }})</a>
        </li>
        <li class="nav-item {{ request()->routeIs('litebans.kick') ? 'active' : ''}}">
          <a class="nav-link" href="{{ route('litebans.kick') }}">{{ trans('litebans::messages.navigation.kicks') }}
            ({{ count(Azuriom\Plugin\Litebans\Models\Kicks::all()) }})</a>
        </li>
        <li class="nav-item {{ request()->routeIs('litebans.warn') ? 'active' : ''}}">
          <a class="nav-link" href="{{ route('litebans.warn') }}">{{ trans('litebans::messages.navigation.warns') }}
            ({{ count(Azuriom\Plugin\Litebans\Models\Warnings::all()) }})</a>
        </li>
      </ul>
      @php
      /*<form class="form-inline my-2 my-lg-0" action="{{URL::to('/litebans/history')}}" method="GET" role="search">
        <input class="form-control mr-sm-2" type="search"
          placeholder="{{ trans('litebans::messages.navigation.search') }}" aria-label="Search" name="uuid">
        <button class="btn btn-primary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
      </form>*/
      @endphp
    </div>
</nav>