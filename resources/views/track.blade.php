@extends('base.layout')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/trackstyle.css') }}" >
@endpush

@section('content')
    <header>
        <nav id="main_nav" class="nav">
            <div class="content">
                <ul>
                    @foreach ($tracks as $trk)
                    @if($trk->isActive)
                        <li>
                            <a href="/track/{{ $trk->id }}" class="@if ($trk->id == $track->id) active @endif clearSS">{{ $trk->name }}</a>    
                        </li>
                    @endif
                @endforeach
                </ul>    
            </div>
        </nav>
    </header>

    <article id="main_article">
        <div class="content">
            <div id="heading_bar">
                <h2>Weekrooster {{ $track->name }}</h2>

                {{-- <button type="button" data-toggle="modal" data-target="#printModal" class=" -primary"><i class="fas fa-print"></i> Print Rooster</button> --}}
                <button class="btn btn_blue btn_squar" onclick="CreatePDFfromHTML()">
                    <div>
                        <i class="fas fa-print icon"></i>
                    </div>
                    Print Rooster
                </button>
            </div>

            <div id="roosters">
                <div id="ochtend">
                    @foreach ($rooms as $room)
                        <table id="room-ochtend-{{ $room->id }}">
                        
                            <thead>
                                @if ($loop->first)
                                <tr>
                                    <th>Ochtend</th>
                                    <th>
                                        <div>
                                            Maandag
                                        </div>
                                    </th>
                                    <th>
                                        <div>
                                            Dinsdag
                                        </div>
                                    </th>
                                    <th>
                                        <div>
                                            Woensdag
                                        </div>
                                    </th>
                                    <th>
                                        <div>
                                            Donderdag
                                        </div>
                                    </th>
                                    <th>
                                        <div>
                                            Vrijdag
                                        </div>
                                    </th>
                                </tr>
                                @endif
                                <tr class="room_naam">
                                    <th>{{ $room->name }}</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($room->workstations as $workstation)
                                <tr id="workstation-ochtend-{{ $workstation->id }}">
                                    <td>{{ $room->abbreviation }}-{{ $workstation->number }}</td>
                                    <td><div id="ochtend-maandag-{{ $workstation->id }}"></div></td>
                                    <td><div id="ochtend-dinsdag-{{ $workstation->id }}"></div></td>
                                    <td><div id="ochtend-woensdag-{{ $workstation->id }}"></div></td>
                                    <td><div id="ochtend-donderdag-{{ $workstation->id }}"></div></td>
                                    <td><div id="ochtend-vrijdag-{{ $workstation->id }}"></div></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endforeach
                </div>
                <div id="middag">
                    @foreach($rooms as $room)
                        <table id="room-middag-{{ $room->id }}">
                            <thead>
                                @if ($loop->first)
                                <tr>
                                    <th>Middag</th>
                                    <th>
                                        <div>
                                            Maandag
                                        </div>
                                    </th>
                                    <th>
                                        <div>
                                            Dinsdag
                                        </div>
                                    </th>
                                    <th>
                                        <div>
                                            Woensdag
                                        </div>
                                    </th>
                                    <th>
                                        <div>
                                            Donderdag
                                        </div>
                                    </th>
                                    <th>
                                        <div>
                                            Vrijdag
                                        </div>
                                    </th>
                                </tr>
                                @endif
                                <tr class="room_naam">
                                    <th>{{ $room->name }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($room->workstations as $workstation)
                                <tr id="workstation-middag-{{ $workstation->id }}">
                                    <td>{{ $room->abbreviation }}-{{ $workstation->number }}</td>
                                    <td><div id="middag-maandag-{{ $workstation->id }}"></div></td>
                                    <td><div id="middag-dinsdag-{{ $workstation->id }}"></div></td>
                                    <td><div id="middag-woensdag-{{ $workstation->id }}"></div></td>
                                    <td><div id="middag-donderdag-{{ $workstation->id }}"></div></td>
                                    <td><div id="middag-vrijdag-{{ $workstation->id }}"></div></td>
                                </tr>
                                @endforeach
                            </tbody>
        
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
    </article>

    <div class="modal fade" id="trackModal" tabindex="-1" role="dialog" aria-labelledby="trackModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="trackModalLabel">Aanpassen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="medients" class="col-form-label">Selecteer een medient</label>
                    <select class="form-select" aria-label="medients" id="medients">
                        <option value="0">Vrij</option>
                        @foreach($medients as $medient)
                        <option value="{{ $medient->id }}">{{ $medient->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="startsLater">
                    <label class="form-check-label" for="startsLater">Start later</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="endsEarlier">
                    <label class="form-check-label" for="endsEarlier">Stopt eerder</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="reserved">
                    <label class="form-check-label" for="reserved">Reserveren</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="turnOff">
                    <label class="form-check-label" for="turnOff">Uitschakelen</label>
                </div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn_squar btn_red" data-dismiss="modal">Sluiten</button>
              <button onclick="sendData()" type="button" class="btn btn_squar btn_blue">Opslaan</button>
            </div>
          </div>
        </div>
    </div>
    <script>
        let workstations = @json($workstations);
        let rooms = @json($rooms);
        let medients = @json($medients);
    </script>
@endsection

@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script src="{{ asset('js/track.js') }}"></script>
@endpush
