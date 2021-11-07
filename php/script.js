



var bar = new ProgressBar.SemiCircle(con_temperature, {
    strokeWidth: 3,
    color: '#0CCFF',
    trailColor: '#eee',
    trailWidth: 1,
    easing: 'easeInOut',
    duration: 2400,
    svgStyle: null,
    text: {
      value: '',
      alignToBottom: false
    },
    from: {color: '#00CCFF'},
    to: {color: '#CC0000'},
    // Set default step function for all animate calls
    step: (state, bar) => {
      bar.path.setAttribute('stroke', state.color);
      var value = Math.round(bar.value() * 45);
      if (value === 0) {
        bar.setText('');
      } else {
        bar.setText(value+'°');
      }
  
      bar.text.style.color = state.color;
    }
  });
  bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
  bar.text.style.fontSize = '2rem';
  
  bar.animate(temperature/45);  // Number from 0.0 to 1.0
  var bar = new ProgressBar.SemiCircle(con_humidite, {
    strokeWidth: 3,
    color: '#0CCFF',
    trailColor: '#eee',
    trailWidth: 1,
    easing: 'easeInOut',
    duration: 2400,
    svgStyle: null,
    text: {
      value: '',
      alignToBottom: false
    },
    from: {color: '#00CCFF'},
    to: {color: '#0000FF'},
    // Set default step function for all animate calls
    step: (state, bar) => {
      bar.path.setAttribute('stroke', state.color);
      var value = Math.round(bar.value() * 100);
      if (value === 0) {
        bar.setText('');
      } else {
        bar.setText(value+'%');
      }
  
      bar.text.style.color = state.color;
    }
  });
  bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
  bar.text.style.fontSize = '2rem';
  
  bar.animate(humidite/100);  // Number from 0.0 to 1.0
