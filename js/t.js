(function() {
  var button = document.getElementById('fullscreen');
  var canvas = document.getElementsByClassName('carousel-inner')[0];
  button.addEventListener('click', function(){
      if (button.requestFullscreen) {
      canvas.requestFullscreen();
      }
  });

})();

const FsEvent = class {
  called = false;

  constructor() {}

  fullScreenEvent(){
    if(this.called == false){
      var called = false;
      var arrow_left = document.getElementById('arrow-left');
      var arrow_right = document.getElementById('arrow-right');
      var fsButton = document.getElementById('fullscreen');
  
      arrow_left.remove();
      arrow_right.remove();
      fsButton.remove();
      this.called = true;
    }
    else {
      var arrow_left = document.createElement('img');
      var arrow_right = document.createElement('img');
      var fsButton = document.createElement('img');

      arrow_left.src = base_url + "css/arrow-left.png";
      arrow_right.src = base_url + "css/arrow-right.png";
      fsButton.src = base_url + "css/fs.png";
  
      arrow_left.id = "arrow-left";
      arrow_right.id = "arrow-right";
      fsButton.id = "fullscreen";

      var carrouselControls = document.getElementById('carouselExampleControls');
      carrouselControls.appendChild(arrow_left);
      carrouselControls.appendChild(arrow_right);
      
      var container = document.getElementsByClassName('container-')[0];
      container.appendChild(fsButton);

      this.called = false;
    }
  }
}

$(document).ready(function () {
  let fsEvent = new FsEvent();
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
          fsEvent.fullScreenEvent();
        }
      }
    }
  });
});
