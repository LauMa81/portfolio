
    const mobileMenu = document.getElementById("mobile-menu");
    const navbar = document.querySelector(".navbar");

    mobileMenu.addEventListener("click", () => {
        navbar.classList.toggle("active");
    });

    document.querySelectorAll('.navbar a').forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add('active');
        }
    });