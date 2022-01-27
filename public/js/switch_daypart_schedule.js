"use strict"

const morning_schedule = document.getElementById('ochtend');
const afternoon_schedule = document.getElementById('middag');
morning_schedule.classList.add('visible');

const button_left = document.getElementById('switch_daypart_left_button');
const button_right = document.getElementById('switch_daypart_right_button');
button_right.classList.add('visible');

const switch_daypart_buttons = Array.from(document.getElementsByClassName('switch_daypart_button'));
switch_daypart_buttons.forEach(button => {
    button.addEventListener('click', switch_daypart_schedule);
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
        afternoon_schedule.classList.remove('visible');
    } else if (Number(value) === 1){
        button_left.classList.add('visible');
        button_right.classList.remove('visible');

        afternoon_schedule.classList.add('visible');
        morning_schedule.classList.remove('visible');
    }
}