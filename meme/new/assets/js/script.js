$(function () {
    'use strict'
  
    $('[data-toggle="offcanvas"]').on('click', function () {
      $('.offcanvas-collapse').toggleClass('open')
    })
    
    $('.navbar-nav>li>.nav-link').on('click', function(){
       $('.offcanvas-collapse').toggleClass('open')
    })
  })