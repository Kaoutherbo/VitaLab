document.addEventListener("DOMContentLoaded", function() {
    const loginLink = document.getElementById("login-link");

    loginLink.addEventListener("click", function(event) {
        event.preventDefault();
        animateForm("left");
    });

    function animateForm(direction) {
        const container = document.querySelector(".container");
        container.classList.toggle("active");

        const signInSection = document.querySelector(".sign-in");
        const signUpSection = document.querySelector(".sign-up");

        if (direction === "left") {
            signInSection.classList.add("hidden");
            signUpSection.classList.remove("hidden");
        } else {
            signUpSection.classList.add("hidden");
            signInSection.classList.remove("hidden");
        }
    }
});
