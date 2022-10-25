
// If visitor, show the payment input
function showFee(x){
  if(x == 2){
    return document.getElementById("customerFee").style.display='block';
  } else{
    return document.getElementById("customerFee").style.display='none';
  }
};

function paymentReminder(y){
  if(y == 2){
    return document.getElementById("paymentReminder").style.display='block';
  } else if(y == 3){
    return document.getElementById("paymentReminder").style.display='block';
  } else if(y == 4){
    return document.getElementById("paymentReminder").style.display='block';
  } else{
    return document.getElementById("paymentReminder").style.display='none';
  }
};











