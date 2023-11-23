@extends('layouts.app')

@section('title', trans('litebans::messages.navigation.warns'))

@section('content')
<div class="container content">
  @include('litebans::elements.navbar')

  <table class="table table-striped table-hover mt-4">
    <thead>
      <tr>
        <th scope="col">{{ trans('litebans::messages.username') }}</th>
        <th scope="col">{{ trans('litebans::messages.staff_warn') }}</th>
        <th scope="col" class="d-lg-table-cell">{{ trans('litebans::messages.reason') }}</th>
        <th scope="col">{{ trans('messages.fields.date') }}</th>
        <th scope="col" class="d-lg-table-cell">{{ trans('litebans::messages.expires_at') }}</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($warns as $warn)
      <tr class="text-nowrap">
        <td>
          <a href="{{ route('litebans.history', $warn->name) }}">
            <img src="https://mc-heads.net/avatar/{{ $warn->name }}/25" alt="{{ $warn->name }}">
            {{ $warn->name }}
          </a>
        </td>
        <td>
          <a href="{{ route('litebans.history.issued', $warn->banned_by_name) }}">
            <img src="https://mc-heads.net/avatar/{{ $warn->banned_by_name }}/25" alt="{{ $warn->banned_by_name }}">
            {{ $warn->banned_by_name }}
          </a>
        </td>
        <td class="d-lg-table-cell d-none">
          {{ $warn->reason }}
        </td>
        <td>{{ format_date($warn->time) }}</td>

        @if(isset($warn->removed_by_name))
        <td class="d-lg-table-cell d-none">{{ trans('litebans::messages.unbanned') }}</td>
        @elseif($warn->until === null)
        <td class="d-lg-table-cell d-none">{{ trans('litebans::messages.permanent') }}</td>
        @elseif($warn->until->isPast())
        <td class="d-lg-table-cell d-none">{{ trans('litebans::messages.expired') }}</td>
        @else
        <td class="d-lg-table-cell d-none">{{ format_date($warn->until) }}</td>
        @endif
      </tr>
      @empty
      <tr>
        <td colspan="7" class="text-center">{{ trans('litebans::messages.no_punishments_found') }}</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  {{ $warns->withQueryString()->links() }}
</div>
@endsection
