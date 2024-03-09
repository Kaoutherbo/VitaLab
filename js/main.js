
let swiperCards = new Swiper('.swiper-container', {
        loop: true,
        spaceBetween: 32,
        grabCursor: true,
        slidesPerView: 'auto',
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
