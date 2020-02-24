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

$(document).ready(function () {
  
  $('#arrow-right').click(function(){
    $('.carousel').carousel('next');
  });
  
  $('#arrow-left').click(function(){
    $('.carousel').carousel('prev');
  });
  
  $(document).keydown(function(e) {
    var carousel = document.getElementsByClassName('carousel-inner')[0];
    if(e.keyCode == "37"){
      $('.carousel').carousel('prev');
    }
    else {
      if(e.keyCode == "39"){
        $('.carousel').carousel('next');
      }
      else {
        if(e.keyCode == "122"){

        }
        else {
          if(e.keyCode == "33"){
            $('.carousel').carousel('next');
          }
          else {
            if(e.keyCode == "34"){
              $('.carousel').carousel('prev');
            }
            else {
              if(e.keyCode == "13"){
                if (carousel.requestFullscreen) {
                  carousel.requestFullscreen();
                } else if (carousel.mozRequestFullScreen) {
                  carousel.mozRequestFullScreen();
                } else if (carousel.webkitRequestFullscreen) {
                  carousel.webkitRequestFullscreen();
                } else if (carousel.msRequestFullscreen) {
                  carousel.msRequestFullscreen();
                }
              }
            }
          }
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

function AddSlideToView(emplacement, file) {
  var carrouselItem = document.createElement('div');
  carrouselItem.classList.add("carousel-item");

  var img = document.createElement('img');
  img.classList.add("d-block", "w-100", "image");
  img.src = base_url + emplacement + "/" + file;

  carrouselItem.appendChild(img);
  
  var carouselInner = document.getElementsByClassName("carousel-inner")[0];
  carouselInner.appendChild(carrouselItem);
};

function AddFirstSlideToView(emplacement, file){
  var carrouselItem = document.createElement('div');
  carrouselItem.classList.add("carousel-item", "active");

  var img = document.createElement('img');
  img.classList.add("d-block", "w-100", "image");
  img.src = base_url + emplacement + "/" + file;

  carrouselItem.appendChild(img);
  
  var carouselInner = document.getElementsByClassName("carousel-inner")[0];
  carouselInner.appendChild(carrouselItem);
}

$(document).ready(function(){
  $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
    if (!$(this).next().hasClass('show')) {
      $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
    }
    var $subMenu = $(this).next(".dropdown-menu");
    $subMenu.toggleClass('show');
  
  
    $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
      $('.dropdown-submenu .show').removeClass("show");
    });
  
    return false;
  });
});

function AddSummary(element){
  var li = document.createElement('li');

  var a = document.createElement('a');
  a.id = element[1];
  a.innerHTML = element[0];

  a.classList.add('dropdown-item');
  a.classList.add('chapitre');
  a.setAttribute('data-target', '.carousel');
  a.setAttribute('data-slide-to', a.id-1);
  a.href="#";

  li.appendChild(a);

  var menu = document.getElementById('sommaire');
  menu.appendChild(li);
}

function AddThumbnailsToModal(emplacement, thumbnailsSrc, i){
  var a = document.createElement('a');
  a.id = i;
  a.href = "#";
  a.setAttribute('data-slide-to', i);
  a.setAttribute('onclick', 'NavigateToSlide(this);');

  var thumbnails = document.createElement('img');
  thumbnails.classList.add('thumbnails');
  thumbnails.src = base_url + emplacement + "/" + thumbnailsSrc;

  a.appendChild(thumbnails);
  
  var modalContent = document.getElementsByClassName('modal-content')[0];
  modalContent.appendChild(a);
}

function NavigateToSlide(element){
  var id = element.id;
  $('#modalThumbnails').modal('hide');
   $('.carousel').carousel(parseInt(id));
}