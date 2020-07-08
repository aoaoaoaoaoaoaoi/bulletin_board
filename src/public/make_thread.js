var periodSettingRadioButton = document.getElementsByName('period');
periodSettingRadioButton.forEach(function(e) {
    e.addEventListener("click", function() {   
      var currentValue = e.value; 
      var priodSettings = document.getElementsByClassName('periodSetting');
      if (currentValue == "specifyPeriod"){
        Object.keys(priodSettings).forEach(function( key ) {
          this[key].style.display = 'flex';
        }, priodSettings);
      } else{
        Object.keys(priodSettings).forEach(function( key ) {
          this[key].style.display = 'none';
        }, priodSettings);
      }
    });
});