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

/* Portfolio suodattimet */
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const portfolioCards = document.querySelectorAll('.portfolio-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Poista active-luokka kaikista painikkeista
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Lisää active-luokka klikattuun painikkeeseen
            this.classList.add('active');

            const category = this.getAttribute('data-category');

            portfolioCards.forEach(card => {
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = 'block';
                    // Animaatio näyttämiselle
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'scale(1)';
                    }, 50);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.8)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        });
    });

    // Lisää transition-tyylit portfolio-korteille
    portfolioCards.forEach(card => {
        card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
    });
});
