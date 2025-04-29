const mobileMenu = document.getElementById("mobile-menu");
const navbar = document.querySelector(".navbar");

// Hampurilaisvalikon toiminnallisuus
mobileMenu.addEventListener("click", () => {
    navbar.classList.toggle("active");
});

document.querySelectorAll('.navbar a').forEach(link => {
    if (link.href === window.location.href) {
        link.classList.add('active');
    }
});


/* rakas päiväkirja*/
function openModal(modalId) {
    document.getElementById(modalId).style.display = "block";
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
}

// Sulje modaali, kun käyttäjä klikkaa ikkunan ulkopuolelle
window.onclick = function(event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
}
