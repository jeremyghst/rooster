"use strict"

const workstations_array = Array.from(document.getElementsByClassName("workstation"));

const searchBarInput = document.getElementById("searchBarInput");
if(searchBarInput){
searchBarInput.addEventListener("input", search);
}

function search(){
    workstations_array.forEach(workstation => {
        if(!workstation.innerText.toLowerCase().includes(searchBarInput.value.toLowerCase())){
            workstation.style.display = "none";
        } else {
            workstation.style.display = "flex"
        }
    })
}