const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});


// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})

const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function() {
    if (this.checked) {
        document.body.classList.add('dark');
    } else {
        document.body.classList.remove('dark');
    }
});


// Add click event listener to the profile picture
const settingsLink = document.getElementById('settingsLink');
const profilePicture = document.getElementById('profilePicture');
const accountSection = document.getElementById('accountSection');
const closeBtn = document.getElementById('closeBtn');

profilePicture.addEventListener('click', function() {
    accountSection.style.display = 'grid';
});
settingsLink.addEventListener('click', function() {
    accountSection.style.display = 'grid';
});

closeBtn.addEventListener('click', function() {
    accountSection.style.display = 'none';
});
