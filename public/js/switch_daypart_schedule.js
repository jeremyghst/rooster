"use strict"

const morning_schedule = document.getElementById('ochtend');
const afternoon_schedule = document.getElementById('middag');

const button_left = document.getElementById('switch_daypart_button_middag');
const button_right = document.getElementById('switch_daypart_button_ochtend');

const switch_daypart_buttons = Array.from(document.getElementsByClassName('switch_daypart_button'));
switch_daypart_buttons.forEach(button => {
    button.addEventListener('click', switch_daypart_schedule);
})

//sessionStorage to remember last viewed daypart
if(!sessionStorage.getItem('daypart')){
    morning_schedule.classList.add('visible');
    button_right.classList.add('visible');
} else {
    document.getElementById(sessionStorage.getItem('daypart')).classList.add('visible');
    document.getElementById("switch_daypart_button_" + sessionStorage.getItem('daypart')).classList.add('visible');
}

//Empty sessionStorage when  navigation through the app
const clearSS_btn = Array.from(document.getElementsByClassName('clearSS'));
clearSS_btn.forEach(btn => {
    btn.addEventListener('click', function(){
        sessionStorage.clear();
    })
})

function switch_daypart_schedule(e){
    let value;

    if(e.target.tagName.toLowerCase() === "button"){
        value = e.target.value;
    } else if (e.target.tagName.toLowerCase() === "i"){
        value = e.target.parentNode.value;
    }
    
    if(Number(value) === 0){
        button_right.classList.add('visible');
        button_left.classList.remove('visible');

        morning_schedule.classList.add('visible');
        sessionStorage.setItem("daypart", "ochtend");

        afternoon_schedule.classList.remove('visible');
    } else if (Number(value) === 1){
        button_left.classList.add('visible');
        button_right.classList.remove('visible');

        afternoon_schedule.classList.add('visible');
        sessionStorage.setItem("daypart", "middag");

        morning_schedule.classList.remove('visible');
    }
}