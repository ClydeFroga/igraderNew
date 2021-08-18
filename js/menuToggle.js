let width = document.documentElement.clientWidth;
let menu = document.querySelector('.wrapper')

document.addEventListener('DOMContentLoaded', () => {
  let asideMenu = document.querySelector('.asideMenu')
  let containers = document.querySelectorAll('.wrapper__content:not(.dark) > .container')
  let containerWidth = containers[0].clientWidth
  let containerWidthAfter = null
  let asideMenuWidth = asideMenu.clientWidth
  
  function menuToggle() {
    width = document.documentElement.clientWidth;
    if (width > 1023) {
      asideMenuWidth = asideMenu.clientWidth
      if (menu.classList.contains('leftDestroy')) {
        //Разворот
        
        menu.classList.toggle('leftDestroy')
        
        menu.classList.add('forOpener')
        
        if (menu.classList.contains('first')) {
          menu.classList.remove('first')
          asideMenu.style.gridArea = 'unset'
          asideMenu.style.display = 'block'
          asideMenuWidth = asideMenu.clientWidth
          for (let container of containers) {
            gsap.from(container, {x: -asideMenuWidth / 2, duration: 0.2})
          }
          setTimeout(() => asideMenu.style.gridArea = '', 300)
        } else {
          //если разрешение ниже полной вместимости
          if (containerWidth < 1310 || containerWidthAfter > containerWidth) {
            gsap.to(".wrapper__block", {marginLeft: 0, duration: 0.3})
          } else {
            for (let container of containers) {
              gsap.to(container, {x: asideMenuWidth / 2, duration: 0.3})
            }
          }
        }
        
        gsap.to(asideMenu, {display: 'block', right: 0, duration: 0.3, ease: "power1.out"})
        
        sessionStorage.removeItem('menuCollapsed')
        
        sliderLarge.update()
      }
      else {
        //Сворот
        gsap.to(asideMenu, {right: '100%', duration: 0.2})
        
        //если разрешение ниже полной вместимости
        if (containerWidth < 1310) {
          gsap.to(".wrapper__block", {marginLeft: -asideMenuWidth, duration: 0.3})
        } else {
          for (let container of containers) {
            gsap.to(container, {x: -asideMenuWidth / 2, duration: 0.3})
          }
        }
  
        menu.classList.remove('forOpener')
        
        setTimeout(() => {
          containerWidthAfter = containers[0].clientWidth
          menu.classList.toggle('leftDestroy')
          
          sliderLarge.update()
        }, 400)
        
        sessionStorage.setItem('menuCollapsed', 'true')
      }
    } else {
      asideMenu.classList.toggle('open')
      gsap.to(asideMenu, {display: 'block', left: 0, duration: 0.3})
    }
  }
  
  let togglers = document.querySelectorAll('#openMenu')
  
  document.querySelector('.asideMenu__close').addEventListener('click', () => {
    asideMenu.classList.toggle('open')
    gsap.to(asideMenu, {display: 'none', left: -270, duration: 0.3})
    // setTimeout(() => asideMenu.classList.toggle('open'), 400)
  })
  
  for (let item of togglers) {
    item.addEventListener('click', menuToggle)
  }
})

if (sessionStorage.getItem("menuCollapsed") === "true") {
  if (width > 1023) {
    menu.classList.add("leftDestroy", "first");
  }
}