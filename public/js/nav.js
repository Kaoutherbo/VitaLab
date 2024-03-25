
// Get references to the necessary elements
const menuIcon = document.querySelector('.hamburger');
const closeIcon = document.querySelector('.closeIcone');
const ulMenu = document.querySelector('.ulMenu');


// Function to show the navigation sidebar
function showNavSidebar() {
    ulMenu.classList.add("show");
    closeIcon.style.display = 'block'; 
    menuIcon.style.display = 'none'; 
}

// Function to hide the navigation sidebar
function hideNavSidebar() {
    ulMenu.classList.remove("show");
    closeIcon.style.display = 'none'; 
    menuIcon.style.display = 'block'; 
}

menuIcon.addEventListener('click', () => {
  showNavSidebar();
});

closeIcon.addEventListener('click', () => {
  hideNavSidebar();
});