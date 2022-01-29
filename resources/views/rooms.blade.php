@extends('base.layout')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/roomsstyle.css') }}" >
@endpush
@section('content')
    <article id="main_article">
        <div class="content">
            <div id="heading_bar">
                <h2>Lokalen Beheren</h2>
                <div id="button_bar">
                    <button id="manageTrackBtn" type="button" data-toggle="modal" data-target="#trackModal" class="btn">Trajectenbeheer <i class="fas fa-th-list icon"></i></button>
                    <a href="#" id="manageMedientBtn">Mediëntenbeheer <i class="fas fa-external-link-alt icon"></i></a>
                </div>
            </div>
            <button id="newRoomBtn" type="button" data-toggle="modal" data-target="#roomModal" class="btn btn_squar btn_blue"><i class="fas fa-plus icon"></i>Nieuw Lokaal</button>

            <table id="rooms" class="no-spacing">
                <thead>
                    <tr>
                        <th>NR.</th>
                        <th>Lokaal</th>
                        <th>AFKORTING</th>
                        <th>TRAJECT</th>
                        <th>WERKPLEKKEN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                        
                            <tr class="rowclick">
                                <td onclick="window.location='room/{{ $room->id }}';">{{ $room->number }}</td>
                                <td onclick="window.location='room/{{ $room->id }}';">{{ $room->name }}</td>
                                <td onclick="window.location='room/{{ $room->id }}';">{{ $room->abbreviation }}</td>
                                <td onclick="window.location='room/{{ $room->id }}';">{{ $room->track->name }}</td>
                                <td onclick="window.location='room/{{ $room->id }}';">{{ $room->workstations->count() }}</td>
                                <td><button onclick="fillModifyModal({{ $room }})" type="button" data-toggle="modal" data-target="#room2Modal" class="btn btn_squar btn_yellow"><i class="fas fa-pen"></i></button></td>
                                <td><button onclick="fillDeleteModal({{ $room->id }})" type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn_squar btn_red"><i class="fas fa-trash-alt"></i></button></td>
                            </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </article>
    
    {{-- modal voor nieuw lokaal --}}
    <div class="modal fade" id="roomModal" tabindex="-1" role="dialog" aria-labelledby="roomModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roomModalLabel">Nieuw lokaal toevoegen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="lokaalnummer" class="col-form-label">Lokaalnummer</label>
                            <input type="text" class="form-control" id="lokaalnummer">
                            <span class="errorMsg" id="lokaalnummerError"></span>
                        </div>
                        <div class="form-group">
                            <label for="lokaalnaam" class="col-form-label">Lokaalnaam</label>
                            <input type="text" class="form-control" id="lokaalnaam">
                            <span class="errorMsg" id="lokaalnaamError"></span>
                        </div>
                        <div class="form-group">
                            <label for="afkorting" class="col-form-label">Afkorting</label>
                            <input type="text" class="form-control" id="afkorting">
                            <span class="errorMsg" id="lokaalafkortingError"></span>
                        </div>
                        <div class="form-group">
                            <label for="traject" class="col-form-label">Traject</label>
                            <select class="form-select" aria-label="traject" id="traject">
                                @foreach($tracks as $track)
                                <option value="{{ $track->id }}">{{ $track->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn_squar btn_red" data-dismiss="modal"><i class="fas fa-times"></i></button>
                    <button onclick="makeRoom()" type="button" class="btn btn_squar btn_blue"><i class="fas fa-check icon"></i> Toevoegen</button>
                </div>
            </div>
        </div>
    </div>
    {{-- einde modal voor nieuw lokaal --}}

    {{-- modal voor aanpassen lokaal --}}
    <div class="modal fade" id="room2Modal" tabindex="-1" role="dialog" aria-labelledby="room2ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="room2ModalLabel">Lokaal aanpassen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="modalId" value="">
                        <div class="form-group">
                            <label for="lokaalnummer2" class="col-form-label">Lokaalnummer</label>
                            <input type="text" class="form-control" id="lokaalnummer2">
                            <span class="errorMsg" id="lokaalnummerError2"></span>
                        </div>
                        <div class="form-group">
                            <label for="lokaalnaam2" class="col-form-label">Lokaalnaam</label>
                            <input type="text" class="form-control" id="lokaalnaam2">
                            <span class="errorMsg" id="lokaalnaamError2"></span>
                        </div>
                        <div class="form-group">
                            <label for="afkorting2" class="col-form-label">Afkorting</label>
                            <input type="text" class="form-control" id="afkorting2">
                            <span class="errorMsg" id="lokaalafkortingError2"></span>
                        </div>
                        <div class="form-group">
                            <label for="traject2" class="col-form-label">Traject</label>
                            <select class="form-select" aria-label="traject2" id="traject2">
                                <option id="currentOption" value=""></option>
                                @foreach($tracks as $track)
                                <option value="{{ $track->id }}">{{ $track->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn_squar btn_red" data-dismiss="modal"><i class="fas fa-times"></i></button>
                    <button onclick="modifyRoom()" type="button" class="btn btn_squar btn_blue"><i class="fas fa-check"></i> Aanpassen</button>
                </div>
            </div>
        </div>
    </div>
    {{-- einde modal voor aanpassen lokaal --}}

    {{-- modal voor verwijderen --}}
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
              <p>Weet je zeker dat je dit lokaal wil verwijderen?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn_squar btn_yellow" data-dismiss="modal">Close</button>
              <button onclick="deleteRoom()" type="button" class="btn btn_red btn_squar">Verwijderen</button>
            </div>
          </div>
        </div>
    </div>
    {{-- einde modal voor verwijderen --}}

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
                        <button onclick="fillDeleteTrackModal('{{ $track->id }}')" type="button" data-dismiss="modal" data-toggle="modal" data-target="#deleteTrackModal" class="btn btn_squar"><i class="fas fa-trash-alt"></i></button>
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
    {{--Modal voor verwijderen track--}}
    <div class="modal fade" id="deleteTrackModal" tabindex="-1" role="dialog" aria-labelledby="deleteTrackModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Verwijder</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="deleteTrackModalId">
              <p>Weet je zeker dat je de track: <span id="deleteTrackModalName"></span> met al zijn lokalen en werkplekken voorgoed wilt verwijderen?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn_squar btn_yellow" data-dismiss="modal">Close</button>
              <button onclick="deleteTrack()" type="button" class="btn btn_squar btn_red">Verwijderen</button>
            </div>
          </div>
        </div>
    </div>      
    {{-- einde modal voor aanmaken track --}}
    <script>
        let all_tracks = @json($tracks);
    </script>
@endsection

@push('scripts')
    <script src="js/rooms.js"></script>
    <script src="js/trackmng.js"></script>
    <script src="js/switch_daypart_schedule.js"></script>
@endpush
