@extends('layouts.app')

@section('title', trans('litebans::messages.navigation.kicks'))

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
      @forelse ($kicks as $kick)
      <tr class="text-nowrap">
        <td>
          <a href="{{ route('litebans.history', $kick->name) }}">
            <img src="https://mc-heads.net/avatar/{{ $kick->name }}/25" alt="{{ $kick->name }}">
            {{ $kick->name }}
          </a>
        </td>
        <td>
          <a href="{{ route('litebans.history.issued', $kick->banned_by_name) }}">
            <img src="https://mc-heads.net/avatar/{{ $kick->banned_by_name }}/25" alt="{{ $kick->banned_by_name }}">
            {{ $kick->banned_by_name }}
          </a>
        </td>
        <td class="d-lg-table-cell d-none">{{ $kick->reason }}</td>
        <td>{{ format_date($kick->time) }}</td>
      </tr>
      @empty
      <tr>
        <td colspan="7" class="text-center">{{ trans('litebans::messages.no_punishments_found') }}</td>
      </tr>
      @endforelse
    </tbody>
  </table>

  {{ $kicks->withQueryString()->links() }}
</div>
@endsection
