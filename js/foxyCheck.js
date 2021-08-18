let checkedFoxyes = null;

window.addEventListener('load', () => {
  let isBlockOn = document.querySelector('.foxyA a') == null;
  
  if(isBlockOn) {
    startPlugs()
  }
})

function startPlugs() {
  jQuery(function($) {
    class checkFoxy {
      constructor() {
        this.blockA = null;
        this.blocksB = null;
        this.blocksC = null;
        this.blocksD = null;
      }
      findAll() {
        this.blockA = document.querySelector('.foxyA');
        this.blocksB = document.querySelectorAll('.foxy');
        this.blocksC = document.querySelectorAll('.foxyLong');
        this.blocksD = document.querySelectorAll('.foxyFull');
        this.blocksF = document.querySelectorAll('.foxyF');
        this.addPlugsA()
        this.addPlugsB()
        this.addPlugsC()
        this.addPlugsD()
        this.addPlugsF()
      }
      loadNews() {
        this.blocksB = document.querySelectorAll('.foxy');
        this.blocksC = document.querySelectorAll('.foxyLong');
        this.addPlugsC()
        this.addPlugsB()
      }
      addPlugsA() {
        if(foxyFromWidgets.linkA !== '' && this.blockA.querySelector('a') === null) {
          this.blockA.id = ''
          this.blockA.insertAdjacentHTML('afterbegin', `<a href='${foxyFromWidgets.linkA}' style="background: rgba(0, 0, 0, 0) url('${foxyFromWidgets.imageA}') no-repeat scroll center center / contain; display: block; height: 500px; width: 300px;"></a>`)
        }
      }
      addPlugsB() {
        let i = 1;
        for (const foxy of this.blocksB) {
          if(foxy.querySelector('a') != null || foxyFromWidgets.linksB['B' + i] == '') {
            i++;
            if(i > 6) i = 1;
            continue;
          }
          foxy.id = ''
          foxy.insertAdjacentHTML('afterbegin', `<a href='${foxyFromWidgets.linksB['B' + i]}' style="background: rgba(0, 0, 0, 0) url('${foxyFromWidgets.imagesB['B' + i]}') no-repeat scroll center center / contain; display: block; height: 300px; width: 300px;"></a>`)
          i++;
          if(i > 6) i = 1;
        }
      }
      addPlugsC() {
        let i = 1;
        for (const foxy of this.blocksC) {
          if(foxy.querySelector('a') != null || foxyFromWidgets.linksC['C' + i] == '') {
            i++;
            if(i > 6) i = 1;
            continue;
          }
          foxy.id = ''
          foxy.insertAdjacentHTML('afterbegin', `<a href='${foxyFromWidgets.linksC['C' + i]}' style="background: rgba(0, 0, 0, 0) url('${foxyFromWidgets.imagesC['C' + i]}') no-repeat scroll center center / contain; display: block; height: 90px; width: 100%;"></a>`)
          i++;
          if(i > 6) i = 1;
        }
      }
      addPlugsD() {
        let i = 1;
        for (const foxy of this.blocksD) {
          if(foxy.querySelector('a') != null || foxyFromWidgets.linksD['D' + i] == '') {
            i++;
            if(i > 2) i = 1;
            continue;
          }
          foxy.id = ''
          foxy.insertAdjacentHTML('afterbegin', `<a href='${foxyFromWidgets.linksD['D' + i]}' style="background: rgba(0, 0, 0, 0) url('${foxyFromWidgets.imagesD['D' + i]}') no-repeat scroll center center / contain; display: block; height: 150px; width: 100%;"></a>`)
          i++;
          if(i > 2) i = 1;
        }
      }
      addPlugsF() {
        let i = 1;
        for (const foxy of this.blocksF) {
          if(foxy.querySelector('a') != null || foxyFromWidgets.linksF['F' + i] == '') {
            i++;
            if(i > 3) i = 1;
            continue;
          }
          foxy.id = ''
          foxy.insertAdjacentHTML('afterbegin', `<a href='${foxyFromWidgets.linksF['F' + i]}' style="background: rgba(0, 0, 0, 0) url('${foxyFromWidgets.imagesF['F' + i]}') no-repeat scroll center center / contain; display: block; height: 150px; width: 250px;"></a>`)
          i++;
          if(i > 3) i = 1;
        }
      }
      async load() {
        let data = {
          'action': 'plugsLoad',
        };
        
        new Promise(function(resolve, reject) {
          $.ajax({
            url: params.ajaxurl,
            data:data,
            type:'POST',
            
            success:function(data){
              if( data ) {
                $('footer').append(data)
                resolve('done')
              }
            },
          })
        })
          .then(() => {
              this.findAll()
            },
            (error) => {
              console.log(error)
            }
          )
        
      }
    }
    checkedFoxyes = new checkFoxy();
    checkedFoxyes.load();
  });
}