@extends('layouts.app')

@section('title', 'Bans')

@section('content')
<div class="container content">
    @include('litebans::elements.navbar')

    <table class="table table-striped table-hover mt-4">
        <thead>
            <tr>
                <th scope="col">{{ trans('litebans::messages.username') }}</th>
                <th scope="col">{{ trans('litebans::messages.staff_ban') }}</th>
                <th scope="col" class="d-lg-table-cell d-none">{{ trans('litebans::messages.reason') }}</th>
                <th scope="col">{{ trans('messages.fields.date') }}</th>
                <th scope="col" class="d-lg-table-cell d-none">{{ trans('litebans::messages.expires_at') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bansList as $bans)
            @php
            $time = gettimeofday();
            $nowtime = $time["sec"] * 1000;
            @endphp
            <tr class="text-nowrap">
                <td><a href="/litebans/history?uuid={{ $bans->uuid }}"><img
                            src="https://minotar.net/avatar/{{ Azuriom\Plugin\Litebans\Models\History::getName($bans->uuid) }}/25"
                            alt="">
                        {{ Azuriom\Plugin\Litebans\Models\History::getName($bans->uuid) }}</a></td>
                <td><a
                        href="/litebans/history?uuid={{ $bans->banned_by_uuid }}&issued=true">{{ $bans->banned_by_name }}</a>
                </td>
                <td class="d-lg-table-cell d-none">{{ $bans->reason }}</td>
                <td>{{ \Carbon\Carbon::createFromTimestampMs($bans->time)->format('d/m/Y à H:i') }}
                </td>
                @if(isset($bans->removed_by_name))
                <td class="d-lg-table-cell d-none">Débanni</td>
                @elseif($bans->until == "-1")
                <td class="d-lg-table-cell d-none">Définitif</td>
                @elseif($nowtime > $bans->until) <td class="d-lg-table-cell d-none">Expiré</td>
                @else
                <td class="d-lg-table-cell d-none">
                    {{ \Carbon\Carbon::createFromTimestampMs($bans->until)->format('d/m/Y à H:i') }}</td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">{{ trans('litebans::messages.no_punishments_found') }}</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $bansList->appends($_GET)->links() }}
</div>
@endsection