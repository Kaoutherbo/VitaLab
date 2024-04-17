document.addEventListener('DOMContentLoaded', function() {
  // Define variables to reference elements
  const agTimeline = document.querySelector('.process_donate');
  const agTimelineLine = document.querySelector('.process_donate_line');
  const agTimelineLineProgress = document.querySelector('.line-progress');
  const agTimelineItems = document.querySelectorAll('.process_donate_item');
  const agTimelinePoints = document.querySelectorAll('.point_box');

  let agOuterHeight = window.outerHeight;
  let agHeight = window.innerHeight;
  let agFlag = false;

  let f = -1;

  // Event listener for scroll event
  window.addEventListener('scroll', fnOnScroll);

  // Event listener for resize event
  window.addEventListener('resize', fnOnResize);

  function fnOnScroll() {
      const agPosY = window.scrollY;
      fnUpdateFrame(agPosY);
  }

  function fnOnResize() {
      const agPosY = window.scrollY;
      agHeight = window.innerHeight;
      fnUpdateFrame(agPosY);
  }

  function fnUpdateWindow(agPosY) {
      agFlag = false;

      // Update the top and bottom positions of the line
      const firstPointTop = agTimelineItems[0].querySelector('.point_box').getBoundingClientRect().top + agPosY;
      const lastPointTop = agTimelineItems[agTimelineItems.length - 1].querySelector('.point_box').getBoundingClientRect().top + agPosY;
      
      const agTimelineTop = agTimeline.getBoundingClientRect().top + agPosY;

      agTimelineLine.style.top = `${firstPointTop - agTimelineTop}px`;
      agTimelineLine.style.bottom = `${agTimelineTop + agTimeline.offsetHeight - lastPointTop}px`;

      if (f !== agPosY) {
          f = agPosY;
          fnUpdateProgress(agPosY);
      }
  }

  function fnUpdateProgress(agPosY) {
      const lastPointTop = agTimelineItems[agTimelineItems.length - 1].querySelector('.point_box').getBoundingClientRect().top + agPosY;

      let i = lastPointTop + agPosY - window.scrollY;
      const a = agTimelineLineProgress.getBoundingClientRect().top + agPosY;
      let n = agPosY - a + agOuterHeight / 2;
      if (i <= agPosY + agOuterHeight / 2) {
          n = i - a;
      }
      agTimelineLineProgress.style.height = `${n}px`;

      // Update active state of timeline items
      agTimelineItems.forEach(item => {
          const agTop = item.querySelector('.point_box').getBoundingClientRect().top + agPosY;
          if ((agTop + agPosY - window.scrollY) < agPosY + (agOuterHeight / 2)) {
              item.classList.add('js-ag-active');
          } else {
              item.classList.remove('js-ag-active');
          }
      });
  }

  function fnUpdateFrame(agPosY) {
      if (!agFlag) {
          requestAnimationFrame(() => fnUpdateWindow(agPosY));
      }
      agFlag = true;
  }
});
