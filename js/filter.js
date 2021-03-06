jQuery(function($) {
  document.addEventListener('DOMContentLoaded', () => {
    
    class filterCat {
      constructor(block) {
        this.filter = block;
        this.titles = null
        this.form = null
        this.mores = null
        
      }
      
      addListeners() {
        for (let item of this.titles) {
          item.addEventListener('click', this.open.bind(this))
        }
        for (let item of this.mores) {
          item.addEventListener('click', this.expand.bind(this))
        }
        for (let item of this.button) {
          item.addEventListener('click', this.send.bind(this))
        }
      }
      
      open(e) {
        e.target.nextElementSibling.classList.toggle('open');
      }
      
      async send(e) {
        e.preventDefault();
        this.form = this.filter.querySelector('form');
        let formData = new FormData(this.form);
        let categories = [];
        let tags = [];
        
        for (let [name, value] of formData) {
          if (name === 'category') {
            categories.push(value)
          }
          if (name === 'tags') {
            tags.push(value)
          }
        }
  
        let data = {
          'action': 'loadmore',
          'block': loadmore_params.block[num],
          'query': loadmore_params.posts[num],
          'offset': loadmore_params.offset[num],
          'perView': loadmore_params.perView[num],
          'horizontalBar': loadmore_params.horizontalBar[num],
          'verticalBar': loadmore_params.verticalBar[num],
          'nonce': loadmore_params.nonce
        };
  
        let insert = e.target.previousElementSibling;
  
        $.ajax({
          url:loadmore_params.ajaxurl,
          data:data,
          type:'POST',
          success:function(data){
            if( data ) {
              $(insert).after(data);
              e.target.textContent = 'Загрузить ещё ↓'
              loadmore_params.offset[num] += loadmore_params.perView[num];
            }
            else {
              e.target.textContent = 'Записи закончились'
              setTimeout(() => e.target.remove(), 5000)
            }
          },
        })
        
        
      }
      
      expand(e) {
        e.target.previousElementSibling.classList.toggle('full');
      }
      
      setVals() {
        if (this.titles == null) {
          this.titles = this.filter.querySelectorAll('.filterTitle');
          this.mores = this.filter.querySelectorAll('.filterMore');
          this.button = this.filter.querySelectorAll('button');
        }
        this.addListeners()
      }
    }
    
    let filterForm = document.querySelectorAll('.asideMenu .filter')
    if (filterForm.length > 0) {
      for (let filterBlock of filterForm) {
        let cc = new filterCat(filterBlock)
        cc.setVals()
      }
    }
  });
})