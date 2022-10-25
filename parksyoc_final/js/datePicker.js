// No weekends date picker jQueryUI

// $( ".datepicker" ).datepicker({
//   beforeShowDay: $.datepicker.noWeekends,
//   minDate: 0
// });

// $(document).ready(function(){
//   $("#datepicker").datepicker({
//   minDate: 0
//   });
// });

// Date picker JS disable past dates


// $('.datepicker').datepicker({
//   minDate: 0
// });

$(document).ready(function(){
  $(function(){
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();

    if(month < 10){
      month = '0' + month.toString();
    }
    if(day < 10){
      day = '0' + day.toString();
    }

    var maxDate = year + '-' + month + '-' + day;

    $('#dateControl').attr('min', maxDate);
  });
});

