// Circles

$('svg.radial-progress').each(function( index, value ) {
  $(this).find($('circle.complete')).removeAttr('style' );
});

$(window).scroll(function(){
  $('svg.radial-progress').each(function( index, value ) {
    // If svg.radial-progress is approximately 25% vertically into the window when scrolling from the top or the bottom
    if (
      $(window).scrollTop() > $(this).offset().top - ($(window).height() * 0.75) &&
      $(window).scrollTop() < $(this).offset().top + $(this).height() - ($(window).height() * 0.25)
    ) {
      // Get percentage of progress
      percent = $(value).data('percentage');
      // Get radius of the svg's circle.complete
      radius = $(this).find($('circle.complete')).attr('r');
      // Get circumference (2πr)
      circumference = 2 * Math.PI * radius;
      // Get stroke-dashoffset value based on the percentage of the circumference
      strokeDashOffset = circumference - ((percent * circumference) / 100);
      // Transition progress for 1.25 seconds
      $(this).find($('circle.complete')).animate({'stroke-dashoffset': strokeDashOffset}, 1250);
    }
  });
}).trigger('scroll');

//Progress bar
(function($) {

  $('#nodeJs').LineProgressbar({
    percentage: 50,
    fillBackgroundColor: '#1abc9c',
    duration: 1250,
    height:'2rem',
    width:'100%',
    display: 'inline-block',
    radius: '0.3rem'
  });

  $('#mySql').LineProgressbar({
    percentage: 80,
    fillBackgroundColor: '#2ecc71',
    duration: 1250,
    height:'2rem',
    width:'100%',
    radius: '0.3rem'
  });

  $('#less').LineProgressbar({
    percentage: 80,
    fillBackgroundColor: '#9b59b6',
    duration: 1250,
    height:'2rem',
    width:'100%',
    radius: '0.3rem'
  });

  $('#vueJs').LineProgressbar({
    percentage: 50,
    fillBackgroundColor: '#34495e',
    duration: 1250,
    height:'2rem',
    width:'100%',
    radius: '0.3rem'
  });
})(jQuery);
