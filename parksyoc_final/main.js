
// var seconds = 3;
// const timeOut = setTimeout(hiddenText, seconds * 3000);

// function hiddenText(){
//   document.getElementById("loginSuccess").style.display = "none";
// };


function showFee(x){
  if(x == 2){
    return document.getElementById("customerFee").style.display='block';
  } else{
    return document.getElementById("customerFee").style.display='none';
  }
};


// Get the modal
var modal = document.getElementById('id01');


// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


// Data tables
$(document).ready(function() {
  $('#datatableid').DataTable();
} );




// Membership expiration countdown
const daysEl = document.getElementById("days");
const hoursEl = document.getElementById("hours");
const minutesEl = document.getElementById("minutes");
const secondsEl = document.getElementById("seconds");


const schoolYear = "15 August 2022";

function countdown(){
  const schoolYearsDate = new Date(schoolYear);
  const currentDate = new Date();

  const totalSeconds = (schoolYearsDate - currentDate) / 1000;

  const days = Math.floor(totalSeconds / 3600 / 24);
  const hours = Math.floor(totalSeconds / 3600 % 24);
  const minutes = Math.floor(totalSeconds / 60) % 60;
  const seconds = Math.floor(totalSeconds) % 60;

  console.log(days, hours, minutes, seconds);

  daysEl.innerHTML = days;
  hoursEl.innerHTML = formatTime(hours);
  minutesEl.innerHTML = formatTime(minutes);
  secondsEl.innerHTML = formatTime(seconds);

}

// initial call
countdown();

setInterval(countdown, 1000);

function formatTime(time){
  return time < 10 ? `0${time}` : time;
}



