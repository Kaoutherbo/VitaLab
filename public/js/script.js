// Add event listener for when DOM content is loaded
document.addEventListener('DOMContentLoaded', function() {
    
    // Select various elements from the DOM
    const agTimeline = document.querySelector('.process_donate'); // Timeline container
    const agTimelineLine = document.querySelector('.process_donate_line'); // Timeline line
    const agTimelineLineProgress = document.querySelector('.line-progress'); // Progress bar
    const agTimelineItems = document.querySelectorAll('.process_donate_item'); // Timeline items
  

    let agOuterHeight = window.outerHeight; // Total height of the browser window
    let agFlag = false; // Flag to control update frequency
    let f = -1; // Variable for last scroll position
  
    // Event listener for scroll event
    window.addEventListener('scroll', fnOnScroll);
  
    // Event listener for resize event
    window.addEventListener('resize', fnOnResize);
  
    // Function called on scroll event
    function fnOnScroll() {
        const agPosY = window.scrollY; // Current vertical scroll position
        fnUpdateFrame(agPosY); // Update timeline based on scroll position
    }
  
    // Function called on resize event
    function fnOnResize() {
        const agPosY = window.scrollY; // Current vertical scroll position
        agHeight = window.innerHeight; // Height of the view (area inside the browser window)
        fnUpdateFrame(agPosY); // Update timeline based on scroll position and window size
    }
  
    // Function to update timeline elements based on scroll position
    function fnUpdateWindow(agPosY) {
        agFlag = false;
  
        // Update the top and bottom positions of the line
        const firstPointTop = agTimelineItems[0].querySelector('.point_box').getBoundingClientRect().top + agPosY;
        const lastPointTop = agTimelineItems[agTimelineItems.length - 1].querySelector('.point_box').getBoundingClientRect().top + agPosY;
        const agTimelineTop = agTimeline.getBoundingClientRect().top + agPosY;
  
        agTimelineLine.style.top = `${firstPointTop - agTimelineTop}px`; // Adjust top position of timeline line
        agTimelineLine.style.bottom = `${agTimelineTop + agTimeline.offsetHeight - lastPointTop}px`; // Adjust bottom position of timeline line
  
        // Update progress bar
        if (f !== agPosY) {
            f = agPosY;
            fnUpdateProgress(agPosY);
        }
    }
  
    // Function to update progress bar based on scroll position
    function fnUpdateProgress(agPosY) {
        const lastPointTop = agTimelineItems[agTimelineItems.length - 1].querySelector('.point_box').getBoundingClientRect().top + agPosY; // getBoundingClientRect() => retrieve the size of an element and its position relative to the viewport
  
        let i = lastPointTop + agPosY - window.scrollY;
        const a = agTimelineLineProgress.getBoundingClientRect().top + agPosY;
        let n = agPosY - a + agOuterHeight / 2;
        if (i <= agPosY + agOuterHeight / 2) {
            n = i - a;
        }
        agTimelineLineProgress.style.height = `${n}px`; // Adjust height of progress bar
  
        // Update active state of timeline items
        agTimelineItems.forEach(item => {
            const agTop = item.querySelector('.point_box').getBoundingClientRect().top + agPosY;
            if ((agTop + agPosY - window.scrollY) < agPosY + (agOuterHeight / 2)) {
                item.classList.add('js-ag-active'); // Add active class to timeline item if it's in view
            } else {
                item.classList.remove('js-ag-active'); // Remove active class if it's not in view
            }
        });
    }
  
    // Function to optimize performance by throttling updates
    function fnUpdateFrame(agPosY) {
        if (!agFlag) {
            requestAnimationFrame(() => fnUpdateWindow(agPosY)); // Use requestAnimationFrame to update timeline elements
        }
        agFlag = true;
    }
  });
  