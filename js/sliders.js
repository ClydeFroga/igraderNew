let sliders = [];

function slider() {
  sliders[1] = new Swiper("#sliderSingleTop", {
    spaceBetween: 18,
    grid: {
      rows: 1,
      fill: "row",
    },
    slidesPerView: 1.3,
    allowTouchMove: true,
    breakpoints: {
      768: {
        grid: {
          rows: 2,
        },
        slidesPerView: 3,
      },
      1024: {
        grid: {
          rows: 3,
        },
        slidesPerView: 2,
      },
    },
    scrollbar: {
      el: "#sliderSingleTop__scrollBar",
      draggable: false,
      hide: false,
    },
  });
  sliders[2] = new Swiper("#sliderSec1", {
    spaceBetween: 20,
    grid: {
      rows: 1,
      fill: "column",
    },
    slidesPerView: 1.3,
    allowTouchMove: true,

    breakpoints: {
      768: {
        grid: {
          rows: 1,
          fill: "row",
        },
        slidesPerView: 3,
      },
      1024: {
        allowTouchMove: false,
        grid: {
          rows: 1,
        },
        slidesPerView: 2,
      },
      1280: {
        allowTouchMove: true,
        grid: {
          rows: 1,
        },
        slidesPerView: 3,
      },
    },
    pagination: {
      el: "#sliderSec1__pagination",
      clickable: true,
    },
    navigation: {
      prevEl: "#sliderSec1__toLeft",
      nextEl: "#sliderSec1__toRight",
    },
    scrollbar: {
      el: "#sliderSec1__scrollBar",
      draggable: false,
      hide: false,
    },
  });
  sliders[3] = new Swiper("#sliderSec2", {
    spaceBetween: 0,
    slidesPerView: 1,
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
      clickable: true,
    },
    navigation: {
      prevEl: "#sliderSec2__toLeft",
      nextEl: "#sliderSec2__toRight",
    },
  });
  sliders[4] = new Swiper("#sliderSec3", {
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
      clickable: true,
    },
    navigation: {
      prevEl: "#sliderSec3__toLeft",
      nextEl: "#sliderSec3__toRight",
    },
  });
  sliders[5] = new Swiper("#sliderBot", {
    spaceBetween: 30,
    grid: {
      fill: "row",
    },
    slidesPerView: 1.3,

    breakpoints: {
      576: {
        slidesPerView: 3,
      },
      1024: {
        grid: {
          rows: 1,
        },
        slidesPerView: 4,
      },
    },
    pagination: {
      el: "#sliderBot__pagination",
      clickable: true,
    },
    navigation: {
      prevEl: "#sliderBot__toLeft",
      nextEl: "#sliderBot__toRight",
    },
    scrollbar: {
      el: "#sliderBot__scrollBar",
      draggable: false,
      hide: false,
    },
  });
  sliders[6] = new Swiper("#sliderLarge", {
    spaceBetween: 0,
    grid: {
      fill: "row",
    },
    allowTouchMove: false,
    slidesPerView: 1,
    effect: "fade",
    loop: true,
    fadeEffect: {
      crossFade: true,
    },
    navigation: {
      prevEl: ".sliderLarge__left",
      nextEl: ".sliderLarge__right",
    },
  });
  sliders[7] = new Swiper("#sliderDouble", {
    spaceBetween: 30,
    grid: {
      rows: 2,
      fill: "row",
    },
    allowTouchMove: true,

    slidesPerView: 3,

    pagination: {
      el: "#sliderDouble__pagination",
      clickable: true,
    },
    navigation: {
      prevEl: "#sliderDouble__toLeft",
      nextEl: "#sliderDouble__toRight",
    },
  });
}

function slider1() {
  sliders[0] = new Swiper("#sliderTop", {
    spaceBetween: 25,
    grid: {
      rows: 1,
      fill: "row",
    },

    slidesPerView: 1.3,
    allowTouchMove: true,

    breakpoints: {
      576: {
        slidesPerView: 2.2,
      },
      768: {
        grid: {
          rows: 2,
        },
        slidesPerView: 2,
      },
      1024: {
        grid: {
          rows: 1,
        },
        slidesPerView: 3,
      },
    },
    scrollbar: {
      el: "#sliderTop__scrollBar",
      draggable: false,
      hide: false,
    },
    pagination: {
      el: "#sliderTop__pagination",
      clickable: true,
    },
    navigation: {
      prevEl: "#sliderTop__toLeft",
      nextEl: "#sliderTop__toRight",
    },
  });
}

document.addEventListener("DOMContentLoaded", slider);

document.addEventListener("DOMContentLoaded", slider1);
