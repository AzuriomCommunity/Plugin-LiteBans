@extends('layouts.app')

@section('title', trans('litebans::messages.history'))

@section('content')
<style>
    .btn-outline-primary {
        font-size: 12px;
    }

    .box-border {
        border: 1px solid #dee2e6 !important;
    }
</style>
<div class="container">

    @include('litebans::elements.navbar')

    <div class="row">
        <div class="col-md-3">
            <div class="user-info box-border rounded mb-4 d-flex flex-column align-items-center p-3">
                <h4 class="text-center mb-3">
                    {{ trans('litebans::messages.history') }}
                </h4>

                <img src="https://mc-heads.net/avatar/{{ $name }}/100" alt="{{ $name }}" style="max-width: 140px;" class="rounded">

                <h5 class="text-center">{{ $name }}</h5>

                <table>
                    @foreach([ "bans", "mutes", "kicks", "warns" ] as $section)
                    @if($section == "bans" || setting('litebans.' . $section . '_enabled', true))
                    <tr>
                        <td>{{ trans('litebans::messages.navigation.' . $section) }}</td>
                        <td>{{ $counts[$section] }}</td>
                    </tr>
                    @endif
                    @endforeach
                </table>
            </div>
        </div>

        <div class="col-md-9 parent">
            <ul class="nav nav-tabs">
                @foreach([ "bans", "mutes", "kicks", "warns" ] as $section)
                <li class="nav-item">
                    <a data-bs-toggle="tab" class="nav-link @if($section == $selected) active @endif" href="#{{ $section }}">{{ trans('litebans::messages.navigation.' . $section) }} ({{ $counts[$section] }})</a>
                </li>
                @endforeach
            </ul>
            @if ($issued)
                <div>
                    <h3>{{ trans('litebans::messages.given_punishments') }} <span class="badge bg-success text-uppercase float-end">
                        {{ trans('litebans::messages.staff') }}
                    </span></h3>

                </div>
            @else
                <h3 class="mt-3">
                    {{ trans('litebans::messages.title') }}
                </h3>
            @endif
            <div class="bans collapse @if($selected == 'bans')show @endif" id="bans" data-parent=".parent">
                <table class="table table-striped table-hover mt-4">
                    <thead>
                        <tr>
                            @if ($issued)
                            <th scope="col">Cible</th>
                            @else
                            <th scope="col">Par</th>
                            @endif
                            <th scope="col" class="d-lg-table-cell">{{ trans('litebans::messages.reason') }}</th>
                            <th scope="col">{{ trans('messages.fields.date') }}</th>
                            <th scope="col" class="d-lg-table-cell">{{ trans('litebans::messages.expires_at') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bans as $item)
                            <tr class="text-nowrap">
                                @if ($issued)
                                <td>
                                    <img src="https://mc-heads.net/avatar/{{ $item->name }}/25" alt="{{ $item->name }}">
                                    {{ $item->name }}
                                </td>
                                @else
                                <td>
                                    <img src="https://mc-heads.net/avatar/{{ $item->banned_by_name }}/25" alt="{{ $item->banned_by_name }}">
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
                                <td class="d-lg-table-cell">{{ format_date($item->until) . " (" .trans('litebans::messages.expired') . ")" }}</td>
                                @else
                                <td class="d-lg-table-cell">{{ format_date($item->until) }}</td>
                                @endif
                            </tr>
                        @empty
                            <tr class="text-nowrap">
                                <td colspan="4">{{ trans('messages.none') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mutes collapse @if($selected == 'mutes')show @endif" id="mutes" data-parent=".parent">
                <table class="table table-striped table-hover mt-4">
                    <thead>
                        <tr>
                            @if ($issued)
                            <th scope="col">Cible</th>
                            @else
                            <th scope="col">Par</th>
                            @endif
                            <th scope="col" class="d-lg-table-cell">{{ trans('litebans::messages.reason') }}</th>
                            <th scope="col">{{ trans('messages.fields.date') }}</th>
                            <th scope="col" class="d-lg-table-cell">{{ trans('litebans::messages.expires_at') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ((setting('litebans.mutes_enabled', true) ? $mutes : []) as $item)
                            <tr class="text-nowrap">
                                @if ($issued)
                                    <td>
                                        <img src="https://mc-heads.net/avatar/{{ $item->name }}/25" alt="{{ $item->name }}">
                                        {{ $item->name }}
                                    </td>
                                @else
                                    <td>
                                        <img src="https://mc-heads.net/avatar/{{ $item->banned_by_name }}/25"
                                             alt="{{ $item->banned_by_name }}">
                                        {{ $item->banned_by_name }}
                                    </td>
                                @endif
                                <td class="d-lg-table-cell">{{ $item->reason }}</td>
                                <td>{{ format_date($item->time) }}</td>
                                @if(isset($item->removed_by_name))
                                    <td class="d-lg-table-cell">{{ trans('litebans::messages.unmuted') }}</td>
                                @elseif($item->until === null)
                                    <td class="d-lg-table-cell">{{ trans('litebans::messages.permanent') }}</td>
                                @elseif($item->until->isPast())
                                    <td class="d-lg-table-cell">{{ format_date($item->until) . " (" .trans('litebans::messages.expired') . ")" }}</td>
                                @else
                                    <td class="d-lg-table-cell">
                                        {{ format_date($item->until) }}</td>
                                @endif
                            </tr>
                        @empty
                            <tr class="text-nowrap">
                                <td colspan="4">{{ trans('messages.none') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $mutes->withQueryString()->links() }}
            </div>

            <div class="kicks collapse @if($selected == 'kicks')show @endif" id="kicks" data-parent=".parent">
                <table class="table table-striped table-hover mt-4">
                    <thead>
                        <tr>
                            @if ($issued)
                            <th scope="col">Cible</th>
                            @else
                            <th scope="col">Par</th>
                            @endif
                            <th scope="col" class="d-lg-table-cell">{{ trans('litebans::messages.reason') }}</th>
                            <th scope="col">{{ trans('messages.fields.date') }}</th>
                            <th scope="col" class="d-lg-table-cell">{{ trans('litebans::messages.expires_at') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ((setting('litebans.kicks_enabled', true) ? $kicks : []) as $item)
                            <tr class="text-nowrap">
                                @if ($issued)
                                    <td>
                                        <img src="https://mc-heads.net/avatar/{{ $item->name }}/25" alt="{{ $item->name }}">
                                        {{ $item->name }}
                                    </td>
                                @else
                                    <td>
                                        <img src="https://mc-heads.net/avatar/{{ $item->banned_by_name }}/25"
                                             alt="{{ $item->banned_by_name }}">
                                        {{ $item->banned_by_name }}
                                    </td>
                                @endif
                                <td class="d-lg-table-cell">{{ $item->reason }}</td>
                                <td>{{ format_date($item->time) }}</td>
                            </tr>
                        @empty
                            <tr class="text-nowrap">
                                <td colspan="4">{{ trans('messages.none') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $kicks->withQueryString()->links() }}
            </div>

            <div class="warns collapse @if($selected == 'warns')show @endif" id="warns" data-parent=".parent">
                <table class="table table-striped table-hover mt-4">
                    <thead>
                        <tr>
                            @if ($issued)
                            <th scope="col">Cible</th>
                            @else
                            <th scope="col">Par</th>
                            @endif
                            <th scope="col" class="d-lg-table-cell">{{ trans('litebans::messages.reason') }}</th>
                            <th scope="col">{{ trans('messages.fields.date') }}</th>
                            <th scope="col" class="d-lg-table-cell">{{ trans('litebans::messages.expires_at') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ((setting('litebans.warns_enabled', true) ? $warnings : []) as $item)
                            <tr class="text-nowrap">
                                @if ($issued)
                                    <td>
                                        <img src="https://mc-heads.net/avatar/{{ $item->name }}/25" alt="{{ $item->name }}">
                                        {{ $item->name }}
                                    </td>
                                @else
                                    <td>
                                        <img src="https://mc-heads.net/avatar/{{ $item->banned_by_name }}/25"
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
                                    <td class="d-lg-table-cell">{{ format_date($item->until) . " (" .trans('litebans::messages.expired') . ")" }}</td>
                                @else
                                    <td class="d-lg-table-cell">
                                        {{ format_date($item->until) }}
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr class="text-nowrap">
                                <td colspan="4">{{ trans('messages.none') }}</td>
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
