function stickyScrollWatch() {
  if (document.documentElement.clientWidth >= 768) {
    let foxy = document.querySelectorAll(".single__secondary .foxy");
    let newsBlock = document.querySelector(".single__secondary > .verticalBlock__bot");

    let list = [];
    foxy.forEach((item) => {
      if(item.children.length > 0) {
        list.push(item);
      }
    });
    list.push(document.querySelector(".foxyA"));

    let rand = Math.floor(Math.random() * 3);
    let sidebarHeight = document.querySelector(".single__secondaryEnd").offsetTop + 300;
    let chosenHeight = list[rand].clientHeight


    document.addEventListener("scroll", foxySticky);

    function foxySticky() {
      if (scrollY > sidebarHeight) {
        if (!list[rand].classList.contains("stickyFox")) {
          list[rand].classList.add("stickyFox");
          newsBlock.style.position = "sticky"
          newsBlock.style.top = `${chosenHeight + 50}px`
        }
      } else {
        if (list[rand].classList.contains("stickyFox")) {
          list[rand].classList.remove("stickyFox");
          newsBlock.style.position = ""
          newsBlock.style.top = ``
        }
      }
    }
  }
}
