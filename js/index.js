document.addEventListener('DOMContentLoaded', function () {
    const track = document.getElementById('slider-track');
    const slides = track.querySelectorAll('.foto-slide');
    const prevBtn = document.getElementById('slider-prev');
    const nextBtn = document.getElementById('slider-next');
    let current = 0;

    function updateSlider() {
        const slideWidth = slides[0].getBoundingClientRect().width + 20; // 20 = gap
        track.scrollTo({
            left: current * slideWidth,
            behavior: 'smooth'
        });
    }

    prevBtn.addEventListener('click', function () {
        current = (current - 1 + slides.length) % slides.length;
        updateSlider();
    });

    nextBtn.addEventListener('click', function () {
        current = (current + 1) % slides.length;
        updateSlider();
    });

    // Swipe para móvil
    let startX = 0;
    track.addEventListener('touchstart', function (e) {
        startX = e.touches[0].clientX;
    });
    track.addEventListener('touchend', function (e) {
        let endX = e.changedTouches[0].clientX;
        if (endX - startX > 50) {
            current = (current - 1 + slides.length) % slides.length;
            updateSlider();
        } else if (startX - endX > 50) {
            current = (current + 1) % slides.length;
            updateSlider();
        }
    });

    // Ajustar slider al redimensionar ventana
    window.addEventListener('resize', updateSlider);

    // Inicializar posición
    updateSlider();
});

