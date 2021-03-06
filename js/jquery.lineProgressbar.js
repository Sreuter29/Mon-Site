(function($) {

  $.fn.LineProgressbar = function(options) {
    options = $.extend(
      {
        percentage: 100,
        ShowProgressCount: true,
        duration: 1000,
        unit: '%',
        animation: true,

        // Styling Options
        fillBackgroundColor: '#3498db',
        backgroundColor: '#fff',
        radius: '0px',
        height: '10px',
        width: '100%'
      },
      options
    )

    $.options = options
    return this.each(function(index, el) {
      // Markup
      $(el).html(
        '<div class="progressbar"><div class="proggress"></div><div class="percentCount"></div></div>'
      )
      var lineProgressBarInit = function() {
        var progressFill = $(el).find('.proggress')
        var progressBar = $(el).find('.progressbar')

        progressFill.css({
          backgroundColor: options.fillBackgroundColor,
          height: options.height,
          borderRadius: options.radius,
        })
        progressBar.css({
          width: options.width,
          backgroundColor: options.backgroundColor,
          borderRadius: options.radius,
        })
        progressFill.animate(
          {
            width: options.percentage + '%',
          },
          {
            step: function(x) {
              if (options.ShowProgressCount) {
                $(el)
                .find('.percentCount')
                .text(Math.round(x) + options.unit)
              }
            },
            duration: options.duration,
          }
        )
      }
      $(this).waypoint(lineProgressBarInit, { offset: '100%', triggerOnce: true });
    })
  }
})(jQuery)
