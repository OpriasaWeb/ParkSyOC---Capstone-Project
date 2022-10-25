// Membership expiration countdown
const daysEl = document.getElementById("days");
const hoursEl = document.getElementById("hours");
const minutesEl = document.getElementById("minutes");
const secondsEl = document.getElementById("seconds");


const schoolYear = "18 July 2022";

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
