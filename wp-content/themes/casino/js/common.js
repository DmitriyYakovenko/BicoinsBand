$(document).ready(function() {

    $('#top-cas-list, #top-tradings-list, #top-gambling-list, #top-teasers-list').css('display','none');

    /**
     * Top casinos hover
     */

    var casLinkHovered = false;
    var casZoneHovered = false;
    $('#cas-list-show').mouseenter(function(){
        casLinkHovered = true;
        $('#top-cas-list').slideDown('slow');
    });
    $('#cas-list-show').mouseleave(function(){
        casLinkHovered = false;
        setTimeout(function(){if(casZoneHovered == false) {
            $('#top-cas-list').slideUp('slow');
        }}, 100);
    });
    $('#top-cas-list').mouseenter(function(){
        casZoneHovered = true;
    });
    $('#top-cas-list').mouseleave(function(){
        casZoneHovered = false;
        setTimeout(function(){if(casLinkHovered == false) {
            $('#top-cas-list').slideUp('slow');
        }}, 100);
    });

    /**
     * Top gamblings hover
     */

    var gamblLinkHovered = false;
    var gamblZoneHovered = false;
    $('#gambl-list-show').mouseenter(function(){
        gamblLinkHovered = true;
        $('#top-gambling-list').slideDown('slow');
    });
    $('#gambl-list-show').mouseleave(function(){
        gamblLinkHovered = false;
        setTimeout(function(){if(gamblZoneHovered == false) {
            $('#top-gambling-list').slideUp('slow');
        }}, 100);
    });
    $('#top-gambling-list').mouseenter(function(){
        gamblZoneHovered = true;
    });
    $('#top-gambling-list').mouseleave(function(){
        gamblZoneHovered = false;
    setTimeout(function(){if(gamblLinkHovered == false) {
           $('#top-gambling-list').slideUp('slow');
       }}, 100);
    });

    /**
     * Top tradings hover
     */
    var tradLinkHovered = false;
    var tradZoneHovered = false;
    $('#trading-list-show').mouseenter(function(){
        tradLinkHovered = true;
        $('#top-tradings-list').slideDown('slow');
    });
    $('#trading-list-show').mouseleave(function(){
        tradLinkHovered = false;
        setTimeout(function(){if(tradZoneHovered == false) {
            $('#top-tradings-list').slideUp('slow');
        }}, 100);
    });
    $('#top-tradings-list').mouseenter(function(){
        tradZoneHovered = true;
    });
    $('#top-tradings-list').mouseleave(function(){
        tradZoneHovered = false;
        setTimeout(function(){if(tradLinkHovered == false) {
            $('#top-tradings-list').slideUp('slow');
        }}, 100);
    });

    /**
     * Top teasers hover
     */

    var teaserLinkHovered = false;
    var teaserZoneHovered = false;
    $('#teasers-list-show').mouseenter(function(){
        teaserLinkHovered = true;
        $('#top-teasers-list').slideDown('slow');
    });
    $('#teasers-list-show').mouseleave(function(){
        teaserLinkHovered = false;
        setTimeout(function(){if(teaserZoneHovered == false) {
            $('#top-teasers-list').slideUp('slow');
        }}, 100);
    });
    $('#top-teasers-list').mouseenter(function(){
        teaserZoneHovered = true;
    });
    $('#top-teasers-list').mouseleave(function(){
        teaserZoneHovered = false;
        setTimeout(function(){if(teaserLinkHovered == false) {
            $('#top-teasers-list').slideUp('slow');
        }}, 100);
    });

    

    jQuery('form#client-request').validate({
        submitHandler: function () {
            //jQuery('#scfs').click(function () {

            var name = jQuery('#input-31').val();
            var email = jQuery('#input-32').val();
            var subject = jQuery('#input-33').val();
            var website = jQuery('#input-34').val();
            var message = jQuery('#input-35').val();

            jQuery.ajax({
                url: sendform.ajax_url,
                type: 'post',
                data: {
                    action: 'sendform_ajax',
                    subject: subject,
                    name: name,
                    website: website,
                    email: email,
                    message: message
                },
                success: function (response) {
                    jQuery('.response').html('<div class="alert alert-success">'+response+'</div>');
                }

            });
            return false;
            //});
        },
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            name: {
                required: "<div class='alert alert-danger'>Question required.</div>"
            },
            email: {
                required: "<div class='alert alert-danger'>E-mail required.</div>",
                email: "<div class='alert alert-danger'>Please enter valid E-mail.</div>"
            }
        }
    });
    


     jQuery('form#client-request2').validate({
        submitHandler: function () {
            //jQuery('#scfs').click(function () {

            var name = jQuery('#input-31').val();
            var email = jQuery('#input-32').val();
            var subject = jQuery('#input-33').val();
            var website = jQuery('#input-34').val();
            var message = jQuery('#input-35').val();

            jQuery.ajax({
                url: sendform.ajax_url,
                type: 'post',
                data: {
                    advertising: 'yes',
                    action: 'sendform_ajax',
                    subject: subject,
                    name: name,
                    website: website,
                    email: email,
                    message: message
                },
                success: function (response) {
                    jQuery('.response').html('<div class="alert alert-success">'+response+'</div>');
                }

            });
            return false;
            //});
        },
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            name: {
                required: "<div class='alert alert-danger'>Question required.</div>"
            },
            email: {
                required: "<div class='alert alert-danger'>E-mail required.</div>",
                email: "<div class='alert alert-danger'>Please enter valid E-mail.</div>"
            }
        }
    });










      $("#owl-demo").owlCarousel({
     
          navigation : true, // Show next and prev buttons
          slideSpeed : 300,
          paginationSpeed : 400,
          singleItem:true,
        navigation:false,
      autoPlay : 5000
          // "singleItem:true" is a shortcut for:
          // items : 1, 
          // itemsDesktop : false,
          // itemsDesktopSmall : false,
          // itemsTablet: false,
          // itemsMobile : false
     
      });
     
    });
$(document).ready(function() {
    
        if (!String.prototype.trim) {
          (function() {
            var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
            String.prototype.trim = function() {
              return this.replace(rtrim, '');
            };
          })();
        }

        [].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
          if( inputEl.value.trim() !== '' ) {
            classie.add( inputEl.parentNode, 'input--filled' );
          }

          inputEl.addEventListener( 'focus', onInputFocus );
          inputEl.addEventListener( 'blur', onInputBlur );
        } );

        function onInputFocus( ev ) {
          classie.add( ev.target.parentNode, 'input--filled' );
        }

        function onInputBlur( ev ) {
          if( ev.target.value.trim() === '' ) {
            classie.remove( ev.target.parentNode, 'input--filled' );
          }
        }

      


/**
 * main.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2014, Codrops
 * http://www.codrops.com
 */
(function() {

  var bodyEl = document.body,
    content = document.querySelector( '.content-wrap' ),
    openbtn = document.getElementById( 'open-button' ),
    closebtn = document.getElementById( 'close-button' ),
    isOpen = false;

  function init() {
    initEvents();
  }

  function initEvents() {
    openbtn.addEventListener( 'click', toggleMenu );
    if( closebtn ) {
      closebtn.addEventListener( 'click', toggleMenu );
    }

    // close the menu element if the target it´s not the menu element or one of its descendants..
    content.addEventListener( 'click', function(ev) {
      var target = ev.target;
      if( isOpen && target !== openbtn ) {
        toggleMenu();
      }
    } );
  }

  function toggleMenu() {
    if( isOpen ) {
      classie.remove( bodyEl, 'show-menu' );
    }
    else {
      classie.add( bodyEl, 'show-menu' );
    }
    isOpen = !isOpen;
  }

  init();

})();
/*!
 * classie - class helper functions
 * from bonzo https://github.com/ded/bonzo
 * 
 * classie.has( elem, 'my-class' ) -> true/false
 * classie.add( elem, 'my-new-class' )
 * classie.remove( elem, 'my-unwanted-class' )
 * classie.toggle( elem, 'my-class' )
 */

/*jshint browser: true, strict: true, undef: true */
/*global define: false */

( function( window ) {

'use strict';

// class helper functions from bonzo https://github.com/ded/bonzo

function classReg( className ) {
  return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
}

// classList support for class management
// altho to be fair, the api sucks because it won't accept multiple classes at once
var hasClass, addClass, removeClass;

if ( 'classList' in document.documentElement ) {
  hasClass = function( elem, c ) {
    return elem.classList.contains( c );
  };
  addClass = function( elem, c ) {
    elem.classList.add( c );
  };
  removeClass = function( elem, c ) {
    elem.classList.remove( c );
  };
}
else {
  hasClass = function( elem, c ) {
    return classReg( c ).test( elem.className );
  };
  addClass = function( elem, c ) {
    if ( !hasClass( elem, c ) ) {
      elem.className = elem.className + ' ' + c;
    }
  };
  removeClass = function( elem, c ) {
    elem.className = elem.className.replace( classReg( c ), ' ' );
  };
}

function toggleClass( elem, c ) {
  var fn = hasClass( elem, c ) ? removeClass : addClass;
  fn( elem, c );
}

var classie = {
  // full names
  hasClass: hasClass,
  addClass: addClass,
  removeClass: removeClass,
  toggleClass: toggleClass,
  // short names
  has: hasClass,
  add: addClass,
  remove: removeClass,
  toggle: toggleClass
};

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( classie );
} else {
  // browser global
  window.classie = classie;
}

})( window );

  });
  
