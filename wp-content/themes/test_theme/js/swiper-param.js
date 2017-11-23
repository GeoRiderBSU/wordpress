/*
Parameters for swiper slider
 */
var tileSlider = $('.swiper-container');
tileSlider.each(function(){
    var mySwiper = new Swiper(this, {
        slidesPerView: 4,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        spaceBetween: 5,
        loop: true
    });
});