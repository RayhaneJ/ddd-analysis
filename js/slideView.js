(function() {
  var button = document.getElementById('fullScreen');
  var carousel = document.getElementsByClassName('carousel-inner')[0];
  button.addEventListener("touchstart", function(){
    if (carousel.requestFullscreen) {
      carousel.requestFullscreen();
    } else if (carousel.mozRequestFullScreen) {
      carousel.mozRequestFullScreen();
    } else if (carousel.webkitRequestFullscreen) {
      carousel.webkitRequestFullscreen();
    } else if (carousel.msRequestFullscreen) {
      carousel.msRequestFullscreen();
    }
  });

  button.addEventListener("click", function(){
    if (carousel.requestFullscreen) {
      carousel.requestFullscreen();
    } else if (carousel.mozRequestFullScreen) {
      carousel.mozRequestFullScreen();
    } else if (carousel.webkitRequestFullscreen) {
      carousel.webkitRequestFullscreen();
    } else if (carousel.msRequestFullscreen) {
      carousel.msRequestFullscreen();
    }
});

})();

// const FsEvent = class {
//   called = false;

//   constructor() {}

//   fullScreenEvent(){
//     if(this.called == false){
//       var called = false;

//       var arrow_left = document.getElementById("arrow-left");
//       var arrow_right =document.getElementById("arrow-right");
//       var fsButton = document.getElementById("fullScreen");

//       arrow_left.parentElement.remove();
//       arrow_right.parentElement.remove();
//       fsButton.parentElement.remove();

//       this.called = true;
//     }
//     else {
//       var arrow_left = document.createElement('img');
//       var arrow_right = document.createElement('img');
//       var fsButton = document.createElement('img');

//       var a1 = document.createElement('a');
//       var a2 = document.createElement('a');
//       var a3 = document.createElement('a');

//       arrow_left.src = base_url + "css/arrow-left.png";
//       arrow_right.src = base_url + "css/arrow-right.png";
//       fsButton.src = base_url + "css/fs.png";
  
//       arrow_left.id = "arrow-left";
//       arrow_right.id = "arrow-right";
//       fsButton.id = "fullScreen";

//       a1.appendChild(arrow_left);
//       a2.appendChild(arrow_right);
//       a3.appendChild(fsButton);

//       var carrouselControls = document.getElementById('carouselExampleControls');
//       carrouselControls.appendChild(a1);
//       carrouselControls.appendChild(a2);

//       var container = document.getElementsByClassName("container-")[0];
//       container.appendChild(a3);

//       this.called = false;
//     }
//   }
// }

$(document).ready(function () {
  
  // let fsEvent = new FsEvent();
  $('#arrow-right').click(function(){
    $('.carousel').carousel('next');
  });
  
  $('#arrow-left').click(function(){
    $('.carousel').carousel('prev');
  });
  
  $(document).keydown(function(e) {
    if(e.keyCode == "37"){
      $("#arrow-left").click()
    }
    else {
      if(e.keyCode == "39"){
        $("#arrow-right").click()
      }
      else {
        if(e.keyCode == "122"){
          // fsEvent.fullScreenEvent();
        }
      }
    }
  });
});

document.addEventListener("fullscreenchange", function(){
    if(screen.width < 1024){
      screen.orientation.lock('landscape');
    }
  });

  console.log(screen.height);
    console.log(window.outerHeight);

// document.
//   if(screen.width === window.outerWidth && screen.height === window.outerHeight){
//     console.log('t');
//     console.log(screen.width);
//     console.log(window.outerWidth);
//   }
