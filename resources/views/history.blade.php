@extends('layouts.app')

@section('title', 'Historique')

@section('content')
<style>
   .btn-outline-primary {
      font-size: 12px;
   }
</style>
<div class="container content">

   @include('litebans::elements.navbar')

   @php
   $time = gettimeofday();
   $nowtime = $time["sec"] * 1000;
   @endphp

   <div class="row">
      <div class="col-md-3">
         <div class="user-info border rounded mt-4 d-flex flex-column align-items-center p-3">
            <h5 class="text-center mb-4"><b>Historique du joueur</b></h5>
            <img
               src="https://minotar.net/avatar/{{ Azuriom\Plugin\Litebans\Models\History::getName(request()->input('uuid')) }}/100"
               alt="" style="max-width: 140px;" class="rounded">
            <h5 class="text-center">{{ Azuriom\Plugin\Litebans\Models\History::getName(request()->input('uuid')) }}
            </h5>
            <div class="buttons">
               <div class="btn-bans btn btn-outline-primary btn-block" data-toggle="collapse" data-target="#bans"
                  aria-expanded="true" aria-controls="bans">{{ trans('litebans::messages.navigation.bans') }}
                  ({{ count($historyList['bans']) }})</div>
               <div class="btn-mutes btn btn-outline-primary btn-block" data-toggle="collapse" data-target="#mutes"
                  aria-expanded="true" aria-controls="mutes">{{ trans('litebans::messages.navigation.mutes') }}
                  ({{ count($historyList['mutes']) }})</div>
               <div class="btn-kicks btn btn-outline-primary btn-block" data-toggle="collapse" data-target="#kicks"
                  aria-expanded="true" aria-controls="kicks">{{ trans('litebans::messages.navigation.kicks') }}
                  ({{ count($historyList['kicks']) }})</div>
               <div class="btn-mutes btn btn-outline-primary btn-block" data-toggle="collapse" data-target="#warns"
                  aria-expanded="true" aria-controls="warns">{{ trans('litebans::messages.navigation.warns') }}
                  ({{ count($historyList['warnings']) }})</div>
            </div>
         </div>
      </div>
      <div class="col-md-9 parent">
         @if (request()->input('issued') == 'true')
         <h3 class="mt-3 d-flex align-items-center">Sanctions données <span
               class="badge badge-success ml-2">StAFF</span>
         </h3>
         @else
         <h3 class="mt-3">Sanctions reçus</h3>
         @endif
         <div class="bans collapse show" id="bans" data-parent=".parent">
            <table class="table table-striped table-hover mt-4">
               <thead>
                  <tr>
                     <th scope="col">Type</th>
                     @if (request()->input('issued') == 'true')
                     <th scope="col">{{ trans('litebans::messages.username') }}</th>
                     @else
                     <th scope="col">{{ trans('litebans::messages.staff_ban') }}</th>
                     @endif
                     <th scope="col" class="d-lg-table-cell d-none">{{ trans('litebans::messages.reason') }}</th>
                     <th scope="col">{{ trans('messages.fields.date') }}</th>
                     <th scope="col" class="d-lg-table-cell d-none">{{ trans('litebans::messages.expires_at') }}</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($historyList['bans'] as $item)
                  <tr class="text-nowrap">
                     <td>
                        <span class="badge badge-danger">BAN</span>
                     </td>
                     @if (request()->input('issued') == 'true')
                     <td><img
                           src="https://minotar.net/avatar/{{ Azuriom\Plugin\Litebans\Models\History::getName($item->uuid) }}/25"
                           alt="" class="mr-2">{{ Azuriom\Plugin\Litebans\Models\History::getName($item->uuid) }}</td>
                     @else
                     <td><img
                           src="https://minotar.net/avatar/{{ Azuriom\Plugin\Litebans\Models\History::getName($item->banned_by_uuid) }}/25"
                           alt="" class="mr-2">{{ $item->banned_by_name }}</td>
                     @endif
                     <td class="d-lg-table-cell d-none">{{ $item->reason }}</td>
                     <td>{{ \Carbon\Carbon::createFromTimestampMs($item->time)->format('d/m/Y à H:i') }}</td>
                     @if(isset($item->removed_by_name))
                     <td class="d-lg-table-cell d-none">Débanni</td>
                     @elseif($item->until == "-1")
                     <td class="d-lg-table-cell d-none">Définitif</td>
                     @elseif($nowtime > $item->until) <td class="d-lg-table-cell d-none">Expiré</td>
                     @else
                     <td class="d-lg-table-cell d-none">
                        {{ \Carbon\Carbon::createFromTimestampMs($item->until)->format('d/m/Y à H:i') }}</td>
                     @endif
                  </tr>
                  @empty
                  <tr>
                     <td colspan="7" class="text-center">{{ trans('litebans::messages.no_punishments_found') }}</td>
                  </tr>
                  @endforelse
               </tbody>
            </table>

            {{ $historyList['bans']->appends($_GET)->links() }}
         </div>

         <div class="mutes collapse" id="mutes" data-parent=".parent">
            <table class="table table-striped table-hover mt-4">
               <thead>
                  <tr>
                     <th scope="col">Type</th>
                     @if (request()->input('issued') == 'true')
                     <th scope="col">{{ trans('litebans::messages.username') }}</th>
                     @else
                     <th scope="col">{{ trans('litebans::messages.staff_mute') }}</th>
                     @endif
                     <th scope="col" class="d-lg-table-cell d-none">{{ trans('litebans::messages.reason') }}</th>
                     <th scope="col">{{ trans('messages.fields.date') }}</th>
                     <th scope="col" class="d-lg-table-cell d-none">{{ trans('litebans::messages.expires_at') }}</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($historyList['mutes'] as $item)
                  <tr class="text-nowrap">
                     <td><span class="badge badge-warning">MUTE</span></td>
                     @if (request()->input('issued') == 'true')
                     <td><img
                           src="https://minotar.net/avatar/{{ Azuriom\Plugin\Litebans\Models\History::getName($item->uuid) }}/25"
                           alt="" class="mr-2">{{ Azuriom\Plugin\Litebans\Models\History::getName($item->uuid) }}</td>
                     @else
                     <td><img
                           src="https://minotar.net/avatar/{{ Azuriom\Plugin\Litebans\Models\History::getName($item->banned_by_uuid) }}/25"
                           alt="" class="mr-2">{{ $item->banned_by_name }}</td>
                     @endif
                     <td class="d-lg-table-cell d-none">{{ $item->reason }}</td>
                     <td>{{ \Carbon\Carbon::createFromTimestampMs($item->time)->format('d/m/Y à H:i') }}</td>
                     @if(isset($item->removed_by_name))
                     <td class="d-lg-table-cell d-none">Débanni</td>
                     @elseif($item->until == "-1")
                     <td class="d-lg-table-cell d-none">Définitif</td>
                     @elseif($nowtime > $item->until) <td class="d-lg-table-cell d-none">Expiré</td>
                     @else
                     <td class="d-lg-table-cell d-none">
                        {{ \Carbon\Carbon::createFromTimestampMs($item->until)->format('d/m/Y à H:i') }}</td>
                     @endif
                  </tr>
                  @empty
                  <tr>
                     <td colspan="7" class="text-center">{{ trans('litebans::messages.no_punishments_found') }}</td>
                  </tr>
                  @endforelse
               </tbody>
            </table>

            {{ $historyList['mutes']->appends($_GET)->links() }}
         </div>

         <div class="kicks collapse" id="kicks" data-parent=".parent">
            <table class="table table-striped table-hover mt-4">
               <thead>
                  <tr>
                     <th scope="col">Type</th>
                     @if (request()->input('issued') == 'true')
                     <th scope="col">{{ trans('litebans::messages.username') }}</th>
                     @else
                     <th scope="col">{{ trans('litebans::messages.staff_kick') }}</th>
                     @endif
                     <th scope="col" class="d-lg-table-cell d-none">{{ trans('litebans::messages.reason') }}</th>
                     <th scope="col">{{ trans('messages.fields.date') }}</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($historyList['kicks'] as $item)
                  <tr class="text-nowrap">
                     <td><span class="badge badge-info">KICK</span></td>
                     @if (request()->input('issued') == 'true')
                     <td><img
                           src="https://minotar.net/avatar/{{ Azuriom\Plugin\Litebans\Models\History::getName($item->uuid) }}/25"
                           alt="" class="mr-2">{{ Azuriom\Plugin\Litebans\Models\History::getName($item->uuid) }}</td>
                     @else
                     <td><img
                           src="https://minotar.net/avatar/{{ Azuriom\Plugin\Litebans\Models\History::getName($item->banned_by_uuid) }}/25"
                           alt="" class="mr-2">{{ $item->banned_by_name }}</td>
                     @endif
                     <td class="d-lg-table-cell d-none">{{ $item->reason }}</td>
                     <td>{{ \Carbon\Carbon::createFromTimestampMs($item->time)->format('d/m/Y à H:i') }}</td>
                  </tr>
                  @empty
                  <tr>
                     <td colspan="7" class="text-center">{{ trans('litebans::messages.no_punishments_found') }}</td>
                  </tr>
                  @endforelse
               </tbody>
            </table>

            {{ $historyList['kicks']->appends($_GET)->links() }}
         </div>

         <div class="warns collapse" id="warns" data-parent=".parent">
            <table class="table table-striped table-hover mt-4">
               <thead>
                  <tr>
                     <th scope="col">Type</th>
                     @if (request()->input('issued') == 'true')
                     <th scope="col">{{ trans('litebans::messages.username') }}</th>
                     @else
                     <th scope="col">{{ trans('litebans::messages.staff_warn') }}</th>
                     @endif
                     <th scope="col" class="d-lg-table-cell d-none">{{ trans('litebans::messages.reason') }}</th>
                     <th scope="col">{{ trans('messages.fields.date') }}</th>
                     <th scope="col" class="d-lg-table-cell d-none">{{ trans('litebans::messages.expires_at') }}</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse ($historyList['warnings'] as $item)
                  <tr class="text-nowrap">
                     <td><span class="badge badge-info">WARN</span></td>
                     @if (request()->input('issued') == 'true')
                     <td><img
                           src="https://minotar.net/avatar/{{ Azuriom\Plugin\Litebans\Models\History::getName($item->uuid) }}/25"
                           alt="" class="mr-2">{{ Azuriom\Plugin\Litebans\Models\History::getName($item->uuid) }}</td>
                     @else
                     <td><img
                           src="https://minotar.net/avatar/{{ Azuriom\Plugin\Litebans\Models\History::getName($item->banned_by_uuid) }}/25"
                           alt="" class="mr-2">{{ $item->banned_by_name }}</td>
                     @endif
                     <td class="d-lg-table-cell d-none">{{ $item->reason }}</td>
                     <td>{{ \Carbon\Carbon::createFromTimestampMs($item->time)->format('d/m/Y à H:i') }}</td>
                     @if(isset($item->removed_by_name))
                     <td class="d-lg-table-cell d-none">Débanni</td>
                     @elseif($item->until == "-1")
                     <td class="d-lg-table-cell d-none">Définitif</td>
                     @elseif($nowtime > $item->until) <td class="d-lg-table-cell d-none">Expiré</td>
                     @else
                     <td class="d-lg-table-cell d-none">
                        {{ \Carbon\Carbon::createFromTimestampMs($item->until)->format('d/m/Y à H:i') }}</td>
                     @endif
                  </tr>
                  @empty
                  <tr>
                     <td colspan="7" class="text-center">{{ trans('litebans::messages.no_punishments_found') }}</td>
                  </tr>
                  @endforelse
               </tbody>
            </table>

            {{ $historyList['warnings']->appends($_GET)->links() }}
         </div>
      </div>
   </div>

</div>
@endsection