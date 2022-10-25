// Weekends disable - not allowed
const picker = document.getElementById('dateControl');
picker.addEventListener('input', function(e){
  var day = new Date(this.value).getUTCDay();
  if([6,0].includes(day)){
    e.preventDefault();
    this.value = '';
    alert('Weekends appointment is not allowed.');
  }
});