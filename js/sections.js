jQuery(function($) {
  class SectionButton {
    constructor(button, order) {
      this.button = button
      this.order = order
      this.block = null
    }
    //start load or open block
    doThings() {
      this.block = document.querySelector(`.sectionSelect__blocksHidden:nth-child(${this.order})`)
      if (this.block.children.length > 0) {
        this.makeClasses()
        this.showBlock()
      }
      else {
        this.load(this.block, this.button)
      }
    }
    //load posts
    async load(block, button) {
      
      let all = document.querySelector('.sectionSelect > div > div:first-child')
  
      let data = {
        'action': 'sectionSelect',
        'cat': this.button.dataset.select,
      };
      
      new Promise(function(resolve, reject) {
        $.ajax({
          url:sectionSelect_params.ajaxurl,
          data:data,
          type:'POST',
  
          beforeSend: function () {
            all.classList.add('loading')
          },
          success:function(data){
            if( data ) {
              $(block).append(data);
              resolve('done')
            }
            else {
              reject('нет постов')
            }
          },
          complete: function () {
            all.classList.remove('loading')
          }
        })
      })
        .then(() => {
          this.makeClasses()
          this.showBlock()
        },
        (error) => {
          console.log(error)
          button.remove()
        }
      )

    }
    //block with selected category
    showBlock() {
      let all = document.querySelectorAll(`.sectionSelect__blocksHidden`)
      
      for (let item of all) {
        item.classList.remove('active')
      }
      
      this.block.classList.add('active')
      
    }
    //line with clicked category
    makeClasses() {
      let all = document.querySelectorAll(`.sectionSelect__sectionsLine`)
      
      for (let item of all) {
        item.classList.remove('active')
      }
      
      this.button.classList.add('active')
    }
    //add response from click on category
    listen() {
      this.button.addEventListener('click', this.doThings.bind(this))
    }
  }
  
  let sectionButtons = document.querySelectorAll('.sectionSelect__sectionsLine')
  sectionButtons.forEach((item, index) => {
    let bb = new SectionButton(item, index + 1)
    bb.listen()
  })
});