@extends('base.layout')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/roomstyle.css') }}" >
@endpush
@section('content')
    <article id="main_article">
        <div class="content">
            <div id="heading_bar">
                <h2><a href="/rooms">Lokalen Beheren</a>  > Werkplekbeheer</h2>
                <div id="button_bar">
                    <button id="manageTrackBtn" type="button" data-toggle="modal" data-target="#trackModal" class="btn">Trajectenbeheer <i class="fas fa-th-list icon"></i></button>
                    <a href="#" id="manageMedientBtn">Mediëntenbeheer <i class="fas fa-external-link-alt icon"></i></a>
                </div>
            </div>
            <button id="newRoomBtn" type="button" data-toggle="modal" data-target="#createModal" class="btn btn_squar btn_blue"><i class="fas fa-plus icon"></i>Nieuwe werkplek</button>
            <h3>{{ $room->name }}</h3>

            <table id="room">
                <thead>
                    <tr>
                        <th>NUMMER</th>
                        <th>OMSCHRIJVING</th>
                        <th>SYSTEEM</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($room->workstations as $workstation)
                        
                            <tr class="rowclick">
                                <td class="hidden">{{ $workstation->id }}</td>
                                <td>{{ $workstation->number }}</td>
                                <td>{{ $workstation->description }}</td>
                                <td>{{ $workstation->system }}</td>
                                <td><button onclick="fillModifyModal('{{ $workstation }}')"type="button" data-toggle="modal" data-target="#modifyModal" class="btn btn_squar btn_yellow"><i class="fas fa-pen"></i></button></td>
                                <td><button onclick="fillDeleteModal('{{ $workstation->id }}')" type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn_squar btn_red"><i class="fas fa-trash-alt"></i></button></td>
                            </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </article>

    {{-- modal voor nieuwe werkplek --}}
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Nieuwe werkplek toevoegen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="nummer" class="col-form-label">Nummer</label>
                            <input type="text" class="form-control" id="nummer">
                            <span class="errorMsg" id="nummerError"></span>
                        </div>
                        <div class="form-group">
                            <label for="omschrijving" class="col-form-label">Omschrijving</label>
                            <input type="text" class="form-control" id="omschrijving">
                            <span class="errorMsg" id="omschrijvingError"></span>
                        </div>
                        <div class="form-group">
                            <label for="systeem" class="col-form-label">Systeem</label>
                            <input type="text" class="form-control" id="systeem">
                            <span class="errorMsg" id="systeemError"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn_squar btn_red" data-dismiss="modal"><i class="fas fa-times"></i></button>
                    <button onclick="makeWorkstation()" type="button" class="btn btn_squar btn_blue"><i class="fas fa-check icon"></i> Toevoegen</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifyModalLabel">Werkplek aanpassen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="modalId" value="">
                        <div class="form-group">
                            <label for="nummer2" class="col-form-label">Nummer</label>
                            <input type="text" class="form-control" id="nummer2">
                            <span class="errorMsg" id="nummerError2"></span>
                        </div>
                        <div class="form-group">
                            <label for="omschrijving2" class="col-form-label">Omschrijving</label>
                            <input type="text" class="form-control" id="omschrijving2">
                            <span class="errorMsg" id="omschrijvingError2"></span>
                        </div>
                        <div class="form-group">
                            <label for="systeem2" class="col-form-label">Systeem</label>
                            <input type="text" class="form-control" id="systeem2">
                            <span class="errorMsg" id="systeemError2"></span>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn_squar btn_red" data-dismiss="modal"><i class="fas fa-times"></i></button>
                    <button onclick="modifyWorkstation()" type="button" class="btn btn_squar btn_blue"><i class="fas fa-check icon"></i> Aanpassen</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Verwijder</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="deleteModalId">
              <p>Weet je zeker dat je deze werkplek wil verwijderen?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn_squar btn_yellow" data-dismiss="modal">Close</button>
              <button onclick="deleteWorkstation()" type="button" class="btn btn_squar btn_red">Verwijderen</button>
            </div>
          </div>
        </div>
    </div>

    {{-- modal voor trajectenbeheer --}}
    <div class="modal fade" id="trackModal" tabindex="-1" role="dialog" aria-labelledby="trackModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="trackModalLabel">Verwijder</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <button class="btn btn_squar btn_green vert_margin" data-dismiss="modal" data-target="#newTrackModal" data-toggle="modal">Nieuwe Track</button>
                <div id="tracks">
                @foreach($tracks as $track)
                    <div class="form-check form-switch track_div">
                        <input class="form-check-input" type="checkbox" id="track-{{ $track->id }}" @if($track->isActive) checked @endif>
                        <label class="form-check-label" for="track-{{ $track->id }}">{{ $track->name }}</label>
                        <button onclick="deleteTrack('{{ $track->id }}')" type="button" data-toggle="modal" class="btn btn_squar"><i class="fas fa-trash-alt"></i></button>
                    </div>
                @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_squar btn_yellow" data-dismiss="modal">Close</button>
                <button onclick="activeTracks()" type="button" class="btn btn_squar btn_blue">Toepassen</button>
            </div>
          </div>
        </div>
    </div>      
    {{-- einde modal voor trajectenbeheer --}}
    {{-- modal voor aanmaken track --}}
    <div class="modal fade" id="newTrackModal" tabindex="-1" role="dialog" aria-labelledby="newTrackModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="newTrackModalLabel">Verwijder</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="trackName" class="col-form-label">Naam track</label>
                    <input type="text" class="form-control" id="trackName">
                    <span class="errorMsg" id="trackNameError"></span>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn_squar btn_yellow" data-dismiss="modal">Close</button>
              <button onclick="makeTrack()" type="button" class="btn btn_squar btn_blue">Opslaan</button>
            </div>
          </div>
        </div>
    </div>      
    {{-- einde modal voor aanmaken track --}}

    <script>
        let room_id = '{{ $room->id }}';
    </script>
@endsection

@push('scripts')
    <script src="{{ asset('js/room.js') }}"></script>
    <script src="{{ asset('js/trackmng.js') }}"></script>
@endpush


