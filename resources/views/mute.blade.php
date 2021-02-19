@extends('layouts.app')

@section('title', trans('litebans::messages.navigation.mutes'))

@section('content')
<div class="container content">
  @include('litebans::elements.navbar')

  <table class="table table-striped table-hover mt-4">
    <thead>
      <tr>
        <th scope="col">{{ trans('litebans::messages.username') }}</th>
        <th scope="col">{{ trans('litebans::messages.staff_mute') }}</th>
        <th scope="col" class="d-lg-table-cell d-none">{{ trans('litebans::messages.reason') }}</th>
        <th scope="col">{{ trans('messages.fields.date') }}</th>
        <th scope="col" class="d-lg-table-cell d-none">{{ trans('litebans::messages.expires_at') }}</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($mutes as $mute)
      <tr class="text-nowrap">
        <td>
          <a href="{{ route('litebans.history', $mute->uuid) }}">
            <img src="https://minotar.net/avatar/{{ $mute->name }}/25" alt="{{ $mute->name }}">
            {{ $mute->name }}
          </a>
        </td>
        <td>
          <a href="{{ route('litebans.history.issued', $mute->banned_by_uuid) }}">
            {{ $mute->banned_by_name }}
          </a>
        </td>
        <td class="d-lg-table-cell d-none">{{ $mute->reason }}</td>
        <td>{{ format_date($mute->time) }}</td>
        @if(isset($mute->removed_by_name))
          <td class="d-lg-table-cell d-none">{{ trans('litebans::messages.unbanned') }}</td>
        @elseif($mute->until === null)
          <td class="d-lg-table-cell d-none">{{ trans('litebans::messages.permanent') }}</td>
        @elseif($mute->until->isPast())
          <td class="d-lg-table-cell d-none">{{ trans('litebans::messages.expired') }}</td>
        @else
          <td class="d-lg-table-cell d-none">{{ format_date($mute->until) }}</td>
        @endif
      </tr>
      @empty
      <tr>
        <td colspan="7" class="text-center">{{ trans('litebans::messages.no_punishments_found') }}</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  {{ $mutes->withQueryString()->links() }}
</div>
@endsection
