document.getElementById('prependedtext').addEventListener("keyup", function(event) {
  // Cancel the default action, if needed
  event.preventDefault();
  // Number 13 is the "Enter" key on the keyboard
  if (event.keyCode === 13) {
  	var textoBusq = document.getElementById('prependedtext').value;
    // Trigger the button element with a click
    //document.location.replace('https://developer.mozilla.org/en-US/docs/Web/API/Location.reload');
      var getUrl = window.location;
      var baseUrl = getUrl .protocol + "//" + getUrl.host + "/";
    document.location.replace(baseUrl+'search?search_terms='+textoBusq);
  }
});