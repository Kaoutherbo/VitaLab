(function ($) {
    $(function () {
  
      $(window).on('scroll', function () {
        fnOnScroll();
      });
  
      $(window).on('resize', function () {
        fnOnResize();
      });
  
      let agTimeline = $('.process_donate'),
        agTimelineLine = $('.process_donate_line'),
        agTimelineLineProgress = $('.line-progress'),
        agTimelinePoint = $('.point_box'),
        agTimelineItem = $('.process_donate_item'),
        agOuterHeight = $(window).outerHeight(),
        agHeight = $(window).height(),
        f = -1,
        agFlag = false;
  
      function fnOnScroll() {
        agPosY = $(window).scrollTop();
  
        fnUpdateFrame();
      }
  
      function fnOnResize() {
        agPosY = $(window).scrollTop();
        agHeight = $(window).height();
  
        fnUpdateFrame();
      }
  
      function fnUpdateWindow() {
        agFlag = false;
  
        agTimelineLine.css({
          top: agTimelineItem.first().find(agTimelinePoint).offset().top - agTimelineItem.first().offset().top,
          bottom: agTimeline.offset().top + agTimeline.outerHeight() - agTimelineItem.last().find(agTimelinePoint).offset().top
        });
  
        f !== agPosY && (f = agPosY, agHeight, fnUpdateProgress());
      }
  
      function fnUpdateProgress() {
        let agTop = agTimelineItem.last().find(agTimelinePoint).offset().top;
  
        i = agTop + agPosY - $(window).scrollTop();
        a = agTimelineLineProgress.offset().top + agPosY - $(window).scrollTop();
        n = agPosY - a + agOuterHeight / 2;
        i <= agPosY + agOuterHeight / 2 && (n = i - a);
        agTimelineLineProgress.css({height: n + "px"});
  
        agTimelineItem.each(function () {
          let agTop = $(this).find(agTimelinePoint).offset().top;
  
          (agTop + agPosY - $(window).scrollTop()) < agPosY + .5 * agOuterHeight ? $(this).addClass('js-ag-active') : $(this).removeClass('js-ag-active');
        })
      }
  
      function fnUpdateFrame() {
        agFlag || requestAnimationFrame(fnUpdateWindow);
        agFlag = true;
      }
  
    });
  })(jQuery);
  

  /*
  document.addEventListener('DOMContentLoaded', function () {
    let agTimeline = document.querySelector('.process_donate'),
        agTimelineLine = document.querySelector('.process_donate_line'),
        agTimelineLineProgress = document.querySelector('.line-progress'),
        agTimelineItems = document.querySelectorAll('.process_donate_item'),
        agOuterHeight = window.outerHeight,
        agHeight = window.innerHeight,
        agPosY = -1;

    let observer = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('js-ag-active');
            } else {
                entry.target.classList.remove('js-ag-active');
            }
        });
    }, { threshold: 0.5 });

    agTimelineItems.forEach((item) => {
        observer.observe(item);
    });

    function fnUpdateProgress() {
      let agTop = agTimelineItems[agTimelineItems.length - 1].querySelector('.card_point').offsetTop,
          i = agTop + agPosY - window.scrollY,
          a = agTimelineLineProgress.offsetTop + agPosY - window.scrollY,
          n = agPosY - a + agOuterHeight / 2;
  
      if (i <= agPosY + agOuterHeight / 2) {
          n = i - a;
      }
  
      agTimelineLineProgress.style.height = n + 'px';
  
      let firstTimelinePoint = agTimelineItems[0].querySelector('.card_point'),
          lastTimelinePoint = agTimelineItems[agTimelineItems.length - 1].querySelector('.card_point'),
          lineTop = firstTimelinePoint.offsetTop - agTimelineItems[0].offsetTop,
          lineBottom = agTimeline.offsetTop + agTimeline.offsetHeight - lastTimelinePoint.offsetTop;
  
      agTimelineLine.style.top = lineTop + 'px';
      agTimelineLine.style.bottom = lineBottom + 'px';
  }

  

    window.addEventListener('scroll', function () {
        agPosY = window.scrollY;
        fnUpdateProgress();
    });
});
*/
