let sliders = []

function slider() {
  sliders[1] = new Swiper('#sliderSingleTop', {
        spaceBetween: 18,
        slidesPerColumnFill: 'row',
        slidesPerView: 1.3,
        allowTouchMove: true,
        slidesPerColumn: 1,
        
        breakpoints: {

            768: {
                slidesPerColumn: 2,
                slidesPerView: 3,
            },
            1024: {
                slidesPerColumn: 3,
                slidesPerView: 2,
            },
        },
        scrollbar: {
            el: '#sliderSingleTop__scrollBar',
            draggable: false,
            hide: false,
        },
    });
  sliders[2] = new Swiper('#sliderSec1', {
        spaceBetween: 20,
        slidesPerColumnFill: 'column',
        slidesPerView: 1.3,
        slidesPerColumn: 1,
        allowTouchMove: true,
        
        breakpoints: {
            768: {
                slidesPerColumnFill: 'row',
                slidesPerView: 3,
                slidesPerColumn: 1,
            },
            1024: {
                allowTouchMove: false,
                slidesPerColumn: 1,
                slidesPerView: 2,
            },
            1280: {
                allowTouchMove: true,
                slidesPerColumn: 1,
                slidesPerView: 3,
            },
        },
        pagination: {
            el: "#sliderSec1__pagination",
            clickable: true
        },
        navigation: {
            prevEl: '#sliderSec1__toLeft',
            nextEl: '#sliderSec1__toRight',
        },
        scrollbar: {
            el: '#sliderSec1__scrollBar',
            draggable: false,
            hide: false,
        },
    });
  sliders[3] = new Swiper('#sliderSec2', {
        spaceBetween: 0,
        slidesPerView: 1,
        // slidesPerColumn: 4,
        allowTouchMove: true,
        
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3.2,
            },
            1280: {
                slidesPerView: 4,
            },
        },
        pagination: {
            el: "#sliderSec2__pagination",
            clickable: true
        },
        navigation: {
            prevEl: '#sliderSec2__toLeft',
            nextEl: '#sliderSec2__toRight',
        },
    });
  sliders[4] = new Swiper('#sliderSec3', {
        spaceBetween: 0,
        slidesPerView: 1,
        allowTouchMove: true,
        
        breakpoints: {
            768: {
                slidesPerView: 2,
            },
            1280: {
                slidesPerView: 3,
            },
        },
        pagination: {
            el: "#sliderSec3__pagination",
            clickable: true
        },
        navigation: {
            prevEl: '#sliderSec3__toLeft',
            nextEl: '#sliderSec3__toRight',
        },
    });
  sliders[5] = new Swiper('#sliderBot', {
        spaceBetween: 30,
        slidesPerColumnFill: 'row',
        slidesPerView: 1.3,
        
        breakpoints: {
            576: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerColumn: 1,
                slidesPerView: 4,
            },
        },
         pagination: {
           el: "#sliderBot__pagination",
           clickable: true
         },
         navigation: {
           prevEl: '#sliderBot__toLeft',
           nextEl: '#sliderBot__toRight',
         },
        scrollbar: {
            el: '#sliderBot__scrollBar',
            draggable: false,
            hide: false,
        },
    });
  sliders[6] = new Swiper('#sliderLarge', {
        spaceBetween: 0,
        slidesPerColumnFill: 'row',
        allowTouchMove: false,
        slidesPerView: 1,
        effect: 'fade',
        loop: true,
        fadeEffect: {
            crossFade: true
        },
        navigation: {
            prevEl: '.sliderLarge__left',
            nextEl: '.sliderLarge__right',
        },
    });
  sliders[7] = new Swiper('#sliderDouble', {
        spaceBetween: 30,
        slidesPerColumnFill: 'row',
        allowTouchMove: true,
        slidesPerColumn: 2,
        slidesPerView: 3,


        pagination: {
            el: "#sliderDouble__pagination",
            clickable: true
        },
        navigation: {
            prevEl: '#sliderDouble__toLeft',
            nextEl: '#sliderDouble__toRight',
        },
    });
}

function slider1() {
  sliders[0] = new Swiper('#sliderTop', {
    spaceBetween: 25,
    slidesPerColumnFill: 'row',
    slidesPerView: 1.3,
    allowTouchMove: true,
    slidesPerColumn: 1,
    
    breakpoints: {
      576: {
        slidesPerView: 2.2,
      },
      768: {
        slidesPerView: 2,
        slidesPerColumn: 2,
      },
      1024: {
        slidesPerColumn: 1,
        slidesPerView: 3,
      },
    },
    scrollbar: {
      el: '#sliderTop__scrollBar',
      draggable: false,
      hide: false,
    },
    pagination: {
      el: "#sliderTop__pagination",
      clickable: true
    },
    navigation: {
      prevEl: '#sliderTop__toLeft',
      nextEl: '#sliderTop__toRight',
    },
  });
}

window.addEventListener('load', slider)

document.addEventListener('DOMContentLoaded', slider1)