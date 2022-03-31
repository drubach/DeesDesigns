/**
* PHP Email Form Validation - v3.2
* URL: https://bootstrapmade.com/php-email-form/
* Author: BootstrapMade.com
*/
(function () {
  "use strict";

  let forms = document.querySelectorAll('.php-email-form');

  forms.forEach( function(e) {
    e.addEventListener('submit', function(event) {
      event.preventDefault();

      let thisForm = this;

      let action = thisForm.getAttribute('action');
      let recaptcha = thisForm.getAttribute('data-recaptcha-site-key');
      
      if( ! action ) {
        displayError(thisForm, 'The form action property is not set!')
        return;
  ***REMOVED***
      thisForm.querySelector('.loading').classList.add('d-block');
      thisForm.querySelector('.error-message').classList.remove('d-block');
      thisForm.querySelector('.sent-message').classList.remove('d-block');

      let formData = new FormData( thisForm );

      if ( recaptcha ) {
        if(typeof grecaptcha !== "undefined" ) {
          grecaptcha.ready(function() {
            try {
              grecaptcha.execute(recaptcha, {action: 'php_email_form_submit'})
              .then(token => {
                formData.set('recaptcha-response', token);
                php_email_form_submit(thisForm, action, formData);
          ***REMOVED***)
        ***REMOVED*** catch(error) {
              displayError(thisForm, error)
        ***REMOVED***
      ***REMOVED***);
    ***REMOVED*** else {
          displayError(thisForm, 'The reCaptcha javascript API url is not loaded!')
    ***REMOVED***
  ***REMOVED*** else {
        php_email_form_submit(thisForm, action, formData);
  ***REMOVED***
***REMOVED***);
  });

  function php_email_form_submit(thisForm, action, formData) {
    fetch(action, {
      method: 'POST',
      body: formData,
      headers: {'X-Requested-With': 'XMLHttpRequest'}
***REMOVED***)
    .then(response => {
      if( response.ok ) {
        return response.text()
  ***REMOVED*** else {
        throw new Error(`${response.status} ${response.statusText} ${response.url}`); 
  ***REMOVED***
***REMOVED***)
    .then(data => {
      thisForm.querySelector('.loading').classList.remove('d-block');
      if (data.trim() == 'OK') {
        thisForm.querySelector('.sent-message').classList.add('d-block');
        thisForm.reset(); 
  ***REMOVED*** else {
        throw new Error(data ? data : 'Form submission failed and no error message returned from: ' + action); 
  ***REMOVED***
***REMOVED***)
    .catch((error) => {
      displayError(thisForm, error);
***REMOVED***);
  }

  function displayError(thisForm, error) {
    thisForm.querySelector('.loading').classList.remove('d-block');
    thisForm.querySelector('.error-message').innerHTML = error;
    thisForm.querySelector('.error-message').classList.add('d-block');
  }

})();
