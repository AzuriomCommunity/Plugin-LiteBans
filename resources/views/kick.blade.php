@extends('layouts.app')

@section('title', 'Kicks')

@section('content')
<div class="container content">
  @include('litebans::elements.navbar')

  <table class="table table-striped table-hover mt-4">
    <thead>
      <tr>
        <th scope="col">{{ trans('litebans::messages.username') }}</th>
        <th scope="col">{{ trans('litebans::messages.staff_kick') }}</th>
        <th scope="col" class="d-lg-table-cell d-none">{{ trans('litebans::messages.reason') }}</th>
        <th scope="col">{{ trans('messages.fields.date') }}</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($kicksList as $kicks)
      @php
      $time = gettimeofday();
      $nowtime = $time["sec"] * 1000;
      @endphp
      <tr class="text-nowrap">
        <td><a href="/litebans/history?uuid={{ $kicks->uuid }}"><img
              src="https://minotar.net/avatar/{{ Azuriom\Plugin\Litebans\Models\History::getName($kicks->uuid) }}/25"
              alt="">
            {{ Azuriom\Plugin\Litebans\Models\History::getName($kicks->uuid) }}</a></td>
        <td><a href="/litebans/history?uuid={{ $kicks->banned_by_uuid }}&issued=true">{{ $kicks->banned_by_name }}</a>
        </td>
        <td class="d-lg-table-cell d-none">{{ $kicks->reason }}</td>
        <td>{{ \Carbon\Carbon::createFromTimestampMs($kicks->time)->format('d/m/Y à H:i') }}
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="7" class="text-center">{{ trans('litebans::messages.no_punishments_found') }}</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  {{ $kicksList->appends($_GET)->links() }}
</div>
@endsection