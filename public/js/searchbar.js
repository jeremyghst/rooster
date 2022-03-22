"use strict"

const workstations_array = Array.from(document.getElementsByClassName("workstation"));

const searchBarInput = document.getElementById("searchBarInput");
if(searchBarInput){
searchBarInput.addEventListener("input", search);
}

function search(){
    const workstations_td_array = Array.from(document.getElementsByClassName("cell"));
            
    workstations_td_array.forEach(td => {
        td.classList.remove('fadeout');
    })

    workstations_array.forEach(workstation => {
        if(!workstation.innerText.toLowerCase().includes(searchBarInput.value.toLowerCase())){
            workstation.style.display = "none";
            
        } else {
            workstation.style.display = "flex"

            const workstations_td_array = Array.from(workstation.getElementsByClassName("cell"));
            
            workstations_td_array.forEach(td => {
                if(!td.innerText.toLowerCase().includes(searchBarInput.value.toLowerCase())){
                    td.classList.add('fadeout');
                }
            })
        }
    })
}