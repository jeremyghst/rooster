//deze loop is voor het vullen van de tabelcellen met de juiste waarden en kleurtjes
    for(let i = 0; i < workstations.length; i++)
    {
        let ws = workstations[i];
        let wsid = ws.id;
        let workstationtr = document.getElementById('workstation-ochtend-' + wsid);
        //ochtend
        getName(workstationtr.children[1].children[0], ws, 'maandag', 'ochtend');
        getName(workstationtr.children[2].children[0], ws, 'dinsdag', 'ochtend');
        getName(workstationtr.children[3].children[0], ws, 'woensdag', 'ochtend');
        getName(workstationtr.children[4].children[0], ws, 'donderdag', 'ochtend');
        getName(workstationtr.children[5].children[0], ws, 'vrijdag', 'ochtend');

        workstationtr = document.getElementById('workstation-middag-' + wsid);
        //middag
        getName(workstationtr.children[1].children[0], ws, 'maandag', 'middag');
        getName(workstationtr.children[2].children[0], ws, 'dinsdag', 'middag');
        getName(workstationtr.children[3].children[0], ws, 'woensdag', 'middag');
        getName(workstationtr.children[4].children[0], ws, 'donderdag', 'middag');
        getName(workstationtr.children[5].children[0], ws, 'vrijdag', 'middag');

    }   

//functie voor het vullen van een tabelcel
function getName(td, workstation, day, dagdeel)
{
    
    let dd = workstation.days[day][dagdeel];
    let id = dd.id;
    if(dd.isActive == 1 && dd.id == 0)
    {
        td.classList.add('vrij');
        td.textContent = 'vrij';
        td.dataset.inactive = 0;
        td.dataset.user = 0;
        td.dataset.startsLater = 0;
        td.dataset.endsEarlier = 0;
        td.dataset.reserved = 0;


        return;
    }
    if(dd.isActive == 0)
    {
        td.classList.add('inactive');
        td.textContent = "+";
        td.dataset.inactive = 1;
        td.dataset.user = 0;
        td.dataset.startsLater = 0;
        td.dataset.endsEarlier = 0;
        td.dataset.reserved = 0;

        return; 
    }
    for(let i = 0; i < medients.length; i++)
    {
        if(medients[i].id == id)
        {
            td.classList.add('bezet');
            td.dataset.user = id;
            td.dataset.inactive = 0;
            td.dataset.startsLater = 0;
            td.dataset.endsEarlier = 0;
            td.dataset.reserved = 0;


            //first letter of lastname (and not of the prefix);
            // const lastname = medients[i].user_achter_naam.split(" ");
            // td.textContent = medients[i].user_voor_naam + " " + lastname[lastname.length - 1][0];

            td.textContent = medients[i].name;
            if(dd.isReserved == 1)
            {
                td.classList.add('reserved');
                td.dataset.reserved = 1;

                const icon = document.createElement('i');
                icon.classList.add('fas', 'fa-parking', 'icon');
                td.appendChild(icon);

                return;
            }
            if(dd.startsLater == 1 && dd.endsEarlier == 1)
            {
                const triangle1 = document.createElement('div');
                triangle1.classList.add('sl');
                td.dataset.startsLater = 1;
                
                const triangle2 = document.createElement('div');
                triangle2.classList.add('ee');
                td.dataset.endsEarlier = 1;

                td.append(triangle1, triangle2);
                return;
            }
            if(dd.startsLater == 1 && dd.endsEarlier == 0)
            {
                const triangle = document.createElement('div');
                triangle.classList.add('sl');
                td.dataset.startsLater = 1;

                td.appendChild(triangle);
                
                return;
            }
            if(dd.startsLater == 0 && dd.endsEarlier == 1)
            {
                const triangle = document.createElement('div');
                triangle.classList.add('ee');
                td.dataset.endsEarlier = 1;

                td.appendChild(triangle);
                return;
            }
            return;
        }
    }
    //als je hier uitkomt, dan heeft ie id niet gevonden
    //dan gaan we ervanuit dat de werkplek vrij is
    td.classList.add('vrij');
    td.textContent = 'vrij';
    return;
    
    
}


// fields is voor het bijhouden van de geselecteerde velden
var fields = [];

//de 2 volgende eventlisteners zijn voor het selecteren van cellen
document.addEventListener('click', function (e) {
    let id = e.target.id;
    if (e.ctrlKey || e.metaKey) {
        if(id.startsWith('ochtend') || id.startsWith('middag')){
            fields.push(id);

            //Visualize select
            e.target.classList.add('selected');
        }
    return;
    } else {
        if(id.startsWith('ochtend') || id.startsWith('middag')){
            fields.push(id);

             //Visualize select
            e.target.classList.add('selected');
            fillTrackModal(e.target);
            $('#trackModal').modal('show');
        }
        return;
    }
});

document.addEventListener('keyup', function(e) {
    if(e.key == 'Control')
    {
        if(fields.length != 0){
            fillTrackModal(e.target);
            $('#trackModal').modal('show');
        }
        return;
    }
});

//Stops cntrl + click to select all text from table
$('#roosters').mousedown(function (event) {
    if (event.ctrlKey) {
        event.preventDefault();
    }
});

function fillTrackModal(target){
    if(target.tagName == "DIV"){
        document.getElementById('medients').value = Number(target.dataset.user);
        document.getElementById('startsLater').checked = Number(target.dataset.startsLater);
        document.getElementById('endsEarlier').checked = Number(target.dataset.endsEarlier);
        document.getElementById('reserved').checked = Number(target.dataset.reserved);
        document.getElementById('turnOff').checked = Number(target.dataset.inactive);
    } else {
        //preselects last selected cell in modal
        document.getElementById('medients').value = Number(document.getElementById(fields[fields.length - 1]).dataset.user);
        document.getElementById('startsLater').checked = Number(document.getElementById(fields[fields.length - 1]).dataset.startsLater);
        document.getElementById('endsEarlier').checked = Number(document.getElementById(fields[fields.length - 1]).dataset.endsEarlier);
        document.getElementById('reserved').checked = Number(document.getElementById(fields[fields.length - 1]).dataset.reserved);
        document.getElementById('turnOff').checked = Number(document.getElementById(fields[fields.length - 1]).dataset.inactive);
    }
}

//als de modal gesloten wordt, wordt de fields array weer leeggemaakt
$('#trackModal').on('hidden.bs.modal', function (e) {
    fields = [];

    //Removes the visualization of the selected cells
    const selected_cells = Array.from(document.getElementsByClassName('selected'));
    selected_cells.forEach(cell => {
        cell.classList.remove('selected');
    })

    //console.log('geleegd');
});

//data uit de modal en uit de fieldsarray wordt naar de server gestuurd
function sendData()
{
    //waardes ophalen
    const medientId = document.getElementById('medients').value;
    const startsLater = document.getElementById('startsLater').checked;
    let sL;
    startsLater ? sL = 1 : sL = 0;
    const endsEarlier = document.getElementById('endsEarlier').checked;
    let eE;
    endsEarlier ? eE = 1 : eE = 0;
    const reserved = document.getElementById('reserved').checked;
    let rs;
    reserved ? rs = 1 : rs = 0;
    const turnOff = document.getElementById('turnOff').checked;
    let tO;
    turnOff ? tO = 1 : tO = 0;
    //request maken
    axios({
        method: 'put',
        url: '/ws',
        data: {
          medientId: medientId,
          startsLater: sL,
          endsEarlier: eE,
          reserved: rs,
          turnOff: tO,
          fields: fields
        }
      }).then(function (response) {
            location.reload(true);
      });
}

//Create PDf from HTML...
function CreatePDFfromHTML() {
    let HTML_Width = $("#roosters").width();
    let HTML_Height = $("#roosters").height();
    let top_left_margin = 15;
    let PDF_Width = HTML_Width + (top_left_margin * 2);
    let PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    let canvas_image_width = HTML_Width;
    let canvas_image_height = HTML_Height;
    let totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($("#rooster")[0], {scale:2}).then(function (canvas) {
        let imgData = canvas.toDataURL("image/jpeg", 1.0);
        let pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (let i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("roosters.pdf");
    });
}
