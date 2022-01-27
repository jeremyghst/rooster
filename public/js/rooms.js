/**
 * Saves room and reloads page or returns errors in json.
 */
function makeRoom()
{
    let number = document.getElementById('lokaalnummer').value;
    let name = document.getElementById('lokaalnaam').value;
    let abb = document.getElementById('afkorting').value;
    let track = $('#traject').val();
    axios({
        method: 'post',
        url: '/rooms',
        data: {
          number: number,
          name: name,
          abbreviation: abb,
          track_id: track
        }
      }).then(function (response) {
        
        if(response.data.errors)
        {
            //lokaalnummer error
            if(response.data.errors.number){
                setSpanText('lokaalnummerError', response.data.errors.number);
            } else {
                setSpanText('lokaalnummerError', null);
            }
            //lokaalnaam error
            if(response.data.errors.name){
                setSpanText('lokaalnaamError', response.data.errors.name);
            } else {
                setSpanText('lokaalnaamError', null);
            }
            //afkorting error
            if(response.data.errors.abbreviation){
                setSpanText('lokaalafkortingError', response.data.errors.abbreviation);
            } else {
                setSpanText('lokaalafkortingError', null);
            }
        }
        if(response.data.success)
        {
            location.reload(true);
            //met het argument true wordt de pagina niet uit cache herladen en is het formulier weer leeg
        }        
        
      }); //end of then
}
/**
 * Sets text of the specified span.
 */
function setSpanText(field, errorArray)
{
    let span = document.getElementById(field);
    if(errorArray == null){
        span.textContent = null;
    } else {
        span.textContent = errorArray[0];
    }
}
/**
 * Sets text of modify modal fields. 
 */
function fillModifyModal(room)
{
    document.getElementById('modalId').value = room.id;
    document.getElementById('lokaalnummer2').value = room.number;
    document.getElementById('lokaalnaam2').value = room.name;
    document.getElementById('afkorting2').value = room.abbreviation;
    document.getElementById('currentOption').value = room.track_id;
    document.getElementById('currentOption').text = room.track.name + " - huidig";
    document.getElementById('traject2').selectedIndex = 0;
}

//stuurt de waarden uit de modifymodal naar de server
function modifyRoom()
{
    let number = document.getElementById('lokaalnummer2').value;
    let name = document.getElementById('lokaalnaam2').value;
    let abb = document.getElementById('afkorting2').value;
    let track = $('#traject2').val();
    let id = document.getElementById('modalId').value;

    axios({
        method: 'put',
        url: '/rooms',
        data: {
          id: id,
          number: number,
          name: name,
          abbreviation: abb,
          track_id: track
        }
      }).then(function (response) {
        //console.log(response.data);
        //console.log(response.status);
        if(response.data.errors)
        {
            //lokaalnummer error
            if(response.data.errors.number){
                setSpanText('lokaalnummerError2', response.data.errors.number);
            } else {
                setSpanText('lokaalnummerError2', null);
            }
            //lokaalnaam error
            if(response.data.errors.name){
                setSpanText('lokaalnaamError2', response.data.errors.name);
            } else {
                setSpanText('lokaalnaamError2', null);
            }
            //afkorting error
            if(response.data.errors.abbreviation){
                setSpanText('lokaalafkortingError2', response.data.errors.abbreviation);
            } else {
                setSpanText('lokaalafkortingError2', null);
            }
        }
        if(response.data.success)
        {
            location.reload(true);
            //met het argument true wordt de pagina niet uit cache herladen en is het formulier weer leeg
        }        
        
      }); //end of then
}

function fillDeleteModal(id)
{
    document.getElementById('deleteModalId').value = id;
}

function deleteRoom()
{
    let id = document.getElementById('deleteModalId').value;
    axios({
        method: 'delete',
        url: '/room/' + id
      }).then(function (response) {
        if(response.data.success)
        {
            location.reload(true);
        }        
      });
}
