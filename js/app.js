document.addEventListener('DOMContentLoaded', () => {
  
  let width = document.documentElement.clientWidth;
  
  function headerContainer() {
    function expand(toggle = true) {
      let block = document.querySelector('.ridgepole__container')
    
      if (block.classList.contains('collapsed')) {
        expandAgain()
        return;
      }
    
      if(!block.classList.contains('expanded') && toggle) {
        gsap.to(".ridgepole__containerHiddenBlock", {display: 'flex', opacity: 1, duration: .2})
      } else {
        let duration = 0.2;
        if(!toggle) {
          duration = 0;
        }
        gsap.to(".ridgepole__containerHiddenBlock", {display: 'none', opacity: 0, duration: duration})
      }
      if(toggle) {
        block.classList.toggle('expanded')
      }
    }
  
    let expandBut = document.querySelectorAll('.ridgepole .turnUp')
  
    if (expandBut.length > 0) {
      for (let item of expandBut) {
        item.addEventListener('click', expand)
      }
    }
  
    function collapse() {
      let block = document.querySelector('.ridgepole__container')
      
      block.classList.remove('expanded')
      expand(false)
      block.classList.add('collapsed')
      localStorage.setItem('topCollapsed', 'true')
      
    }
  
    let collapseBut = document.querySelectorAll('.ridgepole .close')
  
    if (collapseBut.length > 0) {
      for(let item of collapseBut) {
        item.addEventListener('click', collapse)
      }
    }
  
    function expandAgain() {
      let block = document.querySelector('.ridgepole__container')
      block.classList.remove('collapsed')
      localStorage.removeItem('topCollapsed')
      setTimeout(expand, 100)
    }
  }
  headerContainer()
  
  function menu() {
    function subMenu(e) {
      let menu = e.target.parentElement;
      let submenu = menu.querySelector('.sub-menu');
      menu.classList.toggle('open')
      if(menu != null) submenu.classList.toggle('expanded')
    }
  
    let subMenus = document.querySelectorAll('.menu-item-has-children > a')
    if(subMenus.length > 0) {
      for(let item of subMenus) {
        item.parentNode.addEventListener('click', subMenu)
      }
    }
  }
  menu()
  
  function search() {
    let searchBut = document.querySelector('.header .search')
    searchBut.addEventListener('click', (e) => {
      searchBut.classList.toggle('open')
      if(searchBut.classList.contains('open')) {
        document.querySelector('.header .search input').focus()
      }
      document.addEventListener('click', (e) => {
        if (e.target !== searchBut) {
          searchBut.classList.remove('open')
        }
      })
    })

  }
  
  if(width <= 1520) {
    search()
  }
  
  function modalWindow() {
    gsap.to('#modalContactForm', {opacity: 1, display: 'block'})
    document.querySelector('#modalContactForm #closeModal').addEventListener('click', () => {
      gsap.to('#modalContactForm', {opacity: 0, display: 'none'})
    })
  }
  function modalWindowSendpulse() {
    gsap.to('#modalSendpulse', {opacity: 1, display: 'block'})
    document.querySelector('#modalSendpulse #closeModal').addEventListener('click', () => {
      gsap.to('#modalSendpulse', {opacity: 0, display: 'none'})
    })
  }
  
  let modalButtons = document.querySelectorAll('#openModal')
  let openModalSendpulse = document.querySelectorAll('#openModalSendpulse')
  
  if(modalButtons) {
    for (let item of modalButtons) {
      item.addEventListener('click', modalWindow)
    }
  }
  if(openModalSendpulse) {
    for (let item of openModalSendpulse) {
      item.addEventListener('click', modalWindowSendpulse)
    }
  }
  
  class filter {
    constructor(block) {
      this.block = block
      this.motherBlock = null
      this.bot = null
    }
    addClassToButton(e) {
      e.target.classList.toggle('dark')
      let id = e.target.id
      let selected = this.motherBlock.querySelectorAll(`a.${id}`)
      this.check()
      this.addClassToBlocks(selected)
    }
    check() {
      let pressed = this.block.querySelector('.dark')

      if(pressed) {
        this.bot.classList.add('filterOn')
      } else {
        this.bot.classList.remove('filterOn')
      }
    }
    addListeners() {
      for(let item of this.block.children) {
        item.addEventListener('click', this.addClassToButton.bind(this))
      }
    }
    addClassToBlocks(selected) {
      for(let item of selected) {
        item.classList.toggle('filtered')
      }
    }
    setVals() {
      if(this.motherBlock == null) {
        this.motherBlock = this.block.parentElement.parentElement.parentElement;
        this.bot = this.motherBlock.querySelector('.verticalBlock__bot')
      }
      this.addListeners()
    }
    
  }
  
  let filterButtonsBlocks = document.querySelectorAll('.slider__top .dateAndViews')
  if(filterButtonsBlocks.length > 0) {
    for(let filterBlock of filterButtonsBlocks) {
      let cc = new filter(filterBlock)
      cc.setVals()
    }
  }
})