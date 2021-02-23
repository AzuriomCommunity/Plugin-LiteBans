@extends('layouts.app')

@section('title', trans('litebans::messages.history'))

@section('content')
<style>
    .btn-outline-primary {
        font-size: 12px;
    }
</style>
<div class="container content">

    @include('litebans::elements.navbar')

    <div class="row">
        <div class="col-md-3">
            <div class="user-info border rounded mt-4 d-flex flex-column align-items-center p-3">
                <h4 class="text-center mb-3">
                    {{ trans('litebans::messages.history') }}
                </h4>

                <img src="https://cravatar.eu/avatar/{{ $name }}/100" alt="{{ $name }}" style="max-width: 140px;"
                    class="rounded">

                <h5 class="text-center">{{ $name }}</h5>

                <div class="buttons">
                    <div class="btn-bans btn btn-outline-primary btn-block" data-toggle="collapse" data-target="#bans"
                        aria-expanded="true" aria-controls="bans">{{ trans('litebans::messages.navigation.bans') }}
                        ({{ $bans->count() }})
                    </div>
                    <div class="btn-mutes btn btn-outline-primary btn-block" data-toggle="collapse" data-target="#mutes"
                        aria-expanded="true" aria-controls="mutes">{{ trans('litebans::messages.navigation.mutes') }}
                        ({{ $mutes->count() }})
                    </div>
                    <div class="btn-kicks btn btn-outline-primary btn-block" data-toggle="collapse" data-target="#kicks"
                        aria-expanded="true" aria-controls="kicks">{{ trans('litebans::messages.navigation.kicks') }}
                        ({{ $kicks->count() }})
                    </div>
                    <div class="btn-mutes btn btn-outline-primary btn-block" data-toggle="collapse" data-target="#warns"
                        aria-expanded="true" aria-controls="warns">{{ trans('litebans::messages.navigation.warns') }}
                        ({{ $warnings->count() }})
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9 parent">
            @if ($issued)
            <h3 class="mt-3 d-flex align-items-center">
                {{ trans('litebans::messages.given_punishments') }}
                <span class="badge badge-success ml-2 text-uppercase">
                    {{ trans('litebans::messages.staff') }}
                </span>
            </h3>
            @else
            <h3 class="mt-3">
                {{ trans('litebans::messages.title') }}
            </h3>
            @endif
            <div class="bans collapse show" id="bans" data-parent=".parent">
                <table class="table table-striped table-hover mt-4">
                    <thead>
                        <tr>
                            <th scope="col">{{ trans('messages.fields.type') }}</th>
                            @if ($issued)
                            <th scope="col">{{ trans('litebans::messages.username') }}</th>
                            @else
                            <th scope="col">{{ trans('litebans::messages.staff_ban') }}</th>
                            @endif
                            <th scope="col" class="d-lg-table-cell">{{ trans('litebans::messages.reason') }}</th>
                            <th scope="col">{{ trans('messages.fields.date') }}</th>
                            <th scope="col" class="d-lg-table-cell">{{ trans('litebans::messages.expires_at') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bans as $item)
                        <tr class="text-nowrap">
                            <td>
                                <span class="badge badge-danger text-uppercase">Ban</span>
                            </td>
                            @if ($issued)
                            <td>
                                <img src="https://cravatar.eu/avatar/{{ $item->name }}/25" alt="{{ $item->name }}">
                                {{ $item->name }}
                            </td>
                            @else
                            <td>
                                <img src="https://cravatar.eu/avatar/{{ $item->banned_by_name }}/25"
                                    alt="{{ $item->banned_by_name }}">
                                {{ $item->banned_by_name }}
                            </td>
                            @endif
                            <td class="d-lg-table-cell">{{ $item->reason }}</td>
                            <td>{{ format_date($item->time) }}</td>
                            @if(isset($item->removed_by_name))
                            <td class="d-lg-table-cell">{{ trans('litebans::messages.unbanned') }}</td>
                            @elseif($item->until === null)
                            <td class="d-lg-table-cell">{{ trans('litebans::messages.permanent') }}</td>
                            @elseif($item->until->isPast())
                            <td class="d-lg-table-cell">{{ trans('litebans::messages.expired') }}</td>
                            @else
                            <td class="d-lg-table-cell">{{ format_date($item->until) }}</td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">{{ trans('litebans::messages.no_punishments_found') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $bans->withQueryString()->links() }}
            </div>

            <div class="mutes collapse" id="mutes" data-parent=".parent">
                <table class="table table-striped table-hover mt-4">
                    <thead>
                        <tr>
                            <th scope="col">Type</th>
                            @if ($issued)
                            <th scope="col">{{ trans('litebans::messages.username') }}</th>
                            @else
                            <th scope="col">{{ trans('litebans::messages.staff_mute') }}</th>
                            @endif
                            <th scope="col" class="d-lg-table-cell">{{ trans('litebans::messages.reason') }}</th>
                            <th scope="col">{{ trans('messages.fields.date') }}</th>
                            <th scope="col" class="d-lg-table-cell">{{ trans('litebans::messages.expires_at') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mutes as $item)
                        <tr class="text-nowrap">
                            <td><span class="badge badge-warning text-uppercase">Mute</span></td>
                            @if ($issued)
                            <td>
                                <img src="https://cravatar.eu/avatar/{{ $item->name }}/25" alt="{{ $item->name }}">
                                {{ $item->name }}
                            </td>
                            @else
                            <td>
                                <img src="https://cravatar.eu/avatar/{{ $item->banned_by_name }}/25"
                                    alt="{{ $item->banned_by_name }}">
                                {{ $item->banned_by_name }}
                            </td>
                            @endif
                            <td class="d-lg-table-cell">{{ $item->reason }}</td>
                            <td>{{ format_date($item->time) }}</td>
                            @if(isset($item->removed_by_name))
                            <td class="d-lg-table-cell">{{ trans('litebans::messages.unbanned') }}</td>
                            @elseif($item->until === null)
                            <td class="d-lg-table-cell">{{ trans('litebans::messages.permanent') }}</td>
                            @elseif($item->until->isPast())
                            <td class="d-lg-table-cell">{{ trans('litebans::messages.expired') }}</td>
                            @else
                            <td class="d-lg-table-cell">
                                {{ format_date($item->until) }}</td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                {{ trans('litebans::messages.no_punishments_found') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $mutes->withQueryString()->links() }}
            </div>

            <div class="kicks collapse" id="kicks" data-parent=".parent">
                <table class="table table-striped table-hover mt-4">
                    <thead>
                        <tr>
                            <th scope="col">{{ trans('messages.fields.type') }}</th>
                            @if ($issued)
                            <th scope="col">{{ trans('litebans::messages.username') }}</th>
                            @else
                            <th scope="col">{{ trans('litebans::messages.staff_kick') }}</th>
                            @endif
                            <th scope="col" class="d-lg-table-cell">{{ trans('litebans::messages.reason') }}</th>
                            <th scope="col">{{ trans('messages.fields.date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kicks as $item)
                        <tr class="text-nowrap">
                            <td><span class="badge badge-info">Kick</span></td>
                            @if ($issued)
                            <td>
                                <img src="https://cravatar.eu/avatar/{{ $item->name }}/25" alt="{{ $item->name }}">
                                {{ $item->name }}
                            </td>
                            @else
                            <td>
                                <img src="https://cravatar.eu/avatar/{{ $item->banned_by_name }}/25"
                                    alt="{{ $item->banned_by_name }}">
                                {{ $item->banned_by_name }}
                            </td>
                            @endif
                            <td class="d-lg-table-cell">{{ $item->reason }}</td>
                            <td>{{ format_date($item->time) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">{{ trans('litebans::messages.no_punishments_found') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $kicks->withQueryString()->links() }}
            </div>

            <div class="warns collapse" id="warns" data-parent=".parent">
                <table class="table table-striped table-hover mt-4">
                    <thead>
                        <tr>
                            <th scope="col">{{ trans('messages.fields.type') }}</th>
                            @if ($issued)
                            <th scope="col">{{ trans('litebans::messages.username') }}</th>
                            @else
                            <th scope="col">{{ trans('litebans::messages.staff_warn') }}</th>
                            @endif
                            <th scope="col" class="d-lg-table-cell">{{ trans('litebans::messages.reason') }}</th>
                            <th scope="col">{{ trans('messages.fields.date') }}</th>
                            <th scope="col" class="d-lg-table-cell">{{ trans('litebans::messages.expires_at') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($warnings as $item)
                        <tr class="text-nowrap">
                            <td><span class="badge badge-info text-uppercase">Warn</span></td>
                            @if ($issued)
                            <td>
                                <img src="https://cravatar.eu/avatar/{{ $item->name }}/25" alt="{{ $item->name }}">
                                {{ $item->name }}
                            </td>
                            @else
                            <td>
                                <img src="https://cravatar.eu/avatar/{{ $item->banned_by_name }}/25"
                                    alt="{{ $item->banned_by_name }}">
                                {{ $item->banned_by_name }}
                            </td>
                            @endif
                            <td class="d-lg-table-cell">{{ $item->reason }}</td>
                            <td>{{ format_date($item->time) }}</td>
                            @if(isset($item->removed_by_name))
                            <td class="d-lg-table-cell">{{ trans('litebans::messages.unbanned') }}</td>
                            @elseif($item->until === null)
                            <td class="d-lg-table-cell">{{ trans('litebans::messages.permanent') }}</td>
                            @elseif($item->until->isPast())
                            <td class="d-lg-table-cell">{{ trans('litebans::messages.expired') }}</td>
                            @else
                            <td class="d-lg-table-cell">
                                {{ format_date($item->until) }}
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                {{ trans('litebans::messages.no_punishments_found') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $warnings->withQueryString()->links() }}
            </div>
        </div>
    </div>

</div>
@endsection