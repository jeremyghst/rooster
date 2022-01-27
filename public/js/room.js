function makeWorkstation()
{
    let number = document.getElementById('nummer').value;
    let description = document.getElementById('omschrijving').value;
    let system = document.getElementById('systeem').value;
    axios({
        method: 'post',
        url: '/workstation',
        data: {
          room_id: room_id,
          number: number,
          description: description,
          system: system
        }
      }).then(function (response) {
        
        if(response.data.errors)
        {
            if(response.data.errors.number){
                setSpanText('nummerError', response.data.errors.number);
            } else {
                setSpanText('nummerError', null);
            }
            if(response.data.errors.description){
                setSpanText('omschrijvingError', response.data.errors.description);
            } else {
                setSpanText('omschrijvingError', null);
            }
            if(response.data.errors.system){
                setSpanText('systeemError', response.data.errors.system);
            } else {
                setSpanText('systeemError', null);
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

function fillModifyModal(workstation)
{
    document.getElementById('modalId').value = workstation.id;
    document.getElementById('nummer2').value = workstation.number;
    document.getElementById('omschrijving2').value = workstation.description;
    document.getElementById('systeem2').value = workstation.system;
}

function modifyWorkstation()
{
    let id = document.getElementById('modalId').value;
    let number = document.getElementById('nummer2').value;
    let description = document.getElementById('omschrijving2').value;
    let system = document.getElementById('systeem2').value;
    axios({
        method: 'put',
        url: '/workstation',
        data: {
          room_id: room_id,
          number: number,
          description: description,
          system: system,
          id: id
        }
      }).then(function (response) {
        
        if(response.data.errors)
        {
            if(response.data.errors.number){
                setSpanText('nummerError2', response.data.errors.number);
            } else {
                setSpanText('nummerError2', null);
            }
            if(response.data.errors.description){
                setSpanText('omschrijvingError2', response.data.errors.description);
            } else {
                setSpanText('omschrijvingError2', null);
            }
            if(response.data.errors.system){
                setSpanText('systeemError2', response.data.errors.system);
            } else {
                setSpanText('systeemError2', null);
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

function deleteWorkstation()
{
    let id = document.getElementById('deleteModalId').value;
    axios({
        method: 'delete',
        url: '/workstation/' + id
      }).then(function (response) {
        if(response.data.success)
        {
            location.reload(true);
        }        
      });
}
