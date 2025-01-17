$(function () {
  'use strict'

  $('[data-toggle="offcanvas"]').on('click', function () {
    $('.offcanvas-collapse').toggleClass('open')
  })
  
  $('.navbar-nav>li>.nav-link').on('click', function(){
     $('.offcanvas-collapse').toggleClass('open')
  })
});




   // Optional: Toggle active class on click to highlight the selected date
   document.querySelectorAll('.date-item').forEach(item => {
    item.addEventListener('click', () => {
      document.querySelectorAll('.date-item').forEach(i => i.classList.remove('active'));
      item.classList.add('active');
    });
  });


