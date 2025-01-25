@extends('layouts.app')

@section('title', trans('litebans::messages.navigation.mutes'))

@section('content')
<div class="container content">
  @include('litebans::elements.navbar')

  <table class="table table-striped table-hover mt-4">
    <thead>
      <tr>
        <th scope="col">{{ trans('litebans::messages.username') }}</th>
        <th scope="col">UUID</th>
        <th scope="col">{{ trans('messages.fields.action') }}</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($history as $player)
      <tr class="text-nowrap">
        <td>
          <a href="{{ route('litebans.history', $player->name) }}">
            <img src="https://mc-heads.net/avatar/{{ $player->name }}/25" alt="{{ $player->name }}">
            {{ $player->name }}
          </a>
        </td>
        <td>{{ $player->uuid }}</td>
        <td><a class="btn btn-outline-primary btn-block" href="{{ route('litebans.history', $player->name) }}">Voir</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $history->withQueryString()->links() }}
</div>
@endsection
