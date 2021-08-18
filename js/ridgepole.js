function editBackgroundImage() {
  let blc = document.querySelector('.ridgepole__top')
  let set = blc.dataset.srcSet.split(',')
  let desk =  set[0]
  let mob = set[1]
  let width = document.documentElement.clientWidth
  
  if (width >= 577) {
    blc.style.backgroundImage = `url('${desk}')`
  } else {
    blc.style.backgroundImage = `url('${mob}')`
  }
  makeHeight()
}

function makeHeight() {
  let blc2 = document.querySelector('.ridgepole__container')
  let width = document.documentElement.clientWidth;
  if(!blc2.classList.contains('collapsed')) {
    let heightOfImg;
    if (width >= 577) {
      if(!blc2.classList.contains('collapsed')) {
        // heightOfImg = Math.ceil((width / 2000) * 220);
        heightOfImg = (width / 2000) * 220 - 1;
      }
    } else {
      if(!blc2.classList.contains('collapsed')) {
        // heightOfImg = Math.ceil((width / 576) * 100);
        heightOfImg = (width / 576) * 100 - 1;
      }
    }
    // blc2.style.transition = `height 0.2s backgroundImage 0s`

    blc2.style.height = `${heightOfImg}px`
    // setTimeout(() => blc2.style.transition = `all 0s`, 500)
  }
}

editBackgroundImage()

window.addEventListener("orientationchange", function () {
  setTimeout(editBackgroundImage, 100)
});