
// Add click event listener to the profile picture
const profilePicture = document.getElementById('profilePicture');
const accountSection = document.getElementById('accountSection');
const closeBtn = document.getElementById('closeBtn');

profilePicture.addEventListener('click', function() {
    accountSection.style.display = 'grid';
});

closeBtn.addEventListener('click', function() {
    accountSection.style.display = 'none';
});
