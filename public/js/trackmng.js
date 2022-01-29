//functie voor het aan- en uitzetten van tracks
function activeTracks()
{
    const tracks = document.getElementById('tracks');
    const inputs = tracks.querySelectorAll('*[id^="track-"]');
    let trks = [];
    for(let i = 0; i < inputs.length; i++)
    {
        trks.push({"id":inputs[i].id, "checked": inputs[i].checked});

    }
    axios({
        method: 'put',
        url: '/tracks',
        data: {
          tracks: trks
        }
      }).then(function (response) {
        if(response.data.success)
        {
            //TODO: misschien de pagina niet herladen maar iets anders doen
            location.reload(true);
            //met het argument true wordt de pagina niet uit cache herladen en is het formulier weer leeg
        }        
        
    });
}

function makeTrack()
{
    const trackName = document.getElementById('trackName').value;
    axios({
        method: 'post',
        url: '/tracks',
        data: {
          trackName: trackName
        }
    }).then(function (response) {
        if(response.data.errors)
        {
            if(response.data.errors.trackName){
                setSpanText('trackNameError', response.data.errors.trackName);
            } else {
                setSpanText('trackNameError', null);
            }
        }
        if(response.data.success)
        {
            location.reload(true);
            //met het argument true wordt de pagina niet uit cache herladen en is het formulier weer leeg
        }        
        
    });
}

function fillDeleteTrackModal(id)
{
    let track_name;
    Array.from(all_tracks).forEach(track => {
        if(track.id == id){
            track_name = track.name;
        }
    })

    document.getElementById('deleteTrackModalId').value = id;
    document.getElementById('deleteTrackModalName').innerText = track_name;
}

function deleteTrack()
{
    let id = document.getElementById('deleteTrackModalId').value;
    let track_name = document.getElementById('deleteTrackModalName').innerText;
    Array.from(all_tracks).forEach(track => {
        if(track.id == id){
            track_name = track.name;
        }
    })
    if(confirm("Weet je zeker dat je de track: " + track_name + " met al zijn lokalen en werkplekken voorgoed wilt verwijderen?")){
        axios({
            method: 'delete',
            url: '/track/' + id
          }).then(function (response) {
            if(response.data.success)
            {
                location.reload(true);
            }        
          });
    }
}