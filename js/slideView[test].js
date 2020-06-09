var url = base_url + "uploads/images/m.pdf";

// Loaded via <script> tag, create shortcut to access PDF.js exports.
var pdfjsLib = window['pdfjs-dist/build/pdf'];

// The workerSrc property shall be specified.
pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

var pdfDoc = null,
    pageNum = 1,
    pageRendering = false,
    pageNumPending = null,
    canvas = document.getElementById('the-canvas'),
    scale = 2.0,
    ctx = canvas.getContext('2d');

/**
 * Get page info from document, resize canvas accordingly, and render page.
 * @param num Page number.
 */
function renderPage(num) {
    pageRendering = true;
    // Using promise to fetch the page
    pdfDoc.getPage(num).then(function(page) {
    var viewport = page.getViewport({scale : scale});
    scale = window.innerWidth/0.2/ (viewport.width);
    viewport = page.getViewport({scale : scale});
    canvas.height = viewport.height;
    canvas.width = viewport.width;
    
    // Render PDF page into canvas context
    var renderContext = {
      canvasContext: ctx,
      viewport: viewport
    };
    var renderTask = page.render(renderContext);

    // Wait for rendering to finish
    renderTask.promise.then(function() {
      pageRendering = false;
      if (pageNumPending !== null) {
        // New page rendering is pending
        renderPage(pageNumPending);
        pageNumPending = null;
      }
    });
  });

  // Update page counters
  //document.getElementById('page_num').textContent = num;
}

/**
 * If another page rendering in progress, waits until the rendering is
 * finised. Otherwise, executes rendering immediately.
 */
function queueRenderPage(num) {
  if (pageRendering) {
    pageNumPending = num;
  } else {
    renderPage(num);
  }
}

/**
 * Displays previous page.
 */
function onPrevPage() {
  if (pageNum <= 1) {
    return;
  }
  pageNum--;
  queueRenderPage(pageNum);
  console.log('next');
}

document.getElementById('prev').addEventListener('click', onPrevPage);

/**
 * Displays next page.
 */
function onNextPage() {
  if (pageNum >= pdfDoc.numPages) {
    return;
  }
  pageNum++;
  queueRenderPage(pageNum);
  console.log('prev');
}

document.getElementById('next').addEventListener('click', onNextPage);

/**
 * Asynchronously downloads PDF.
 */
pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
  pdfDoc = pdfDoc_;

  // Initial/first page rendering
  renderPage(pageNum);
});

(function() {
  button = document.getElementById('fullscreen');
  canvas = document.getElementById('the-canvas');
  button.addEventListener('click', function(){
      if (button.requestFullscreen) {
      canvas.requestFullscreen();
      }
  });

})();

window.addEventListener("keydown", function(event){
  var canvas = document.getElementById('the-canvas');
  if(event.keyCode == '39') {
    onNextPage();
  }
  else {
    if(event.keyCode == '37'){
      onPrevPage();
    }
    else {
      if(event.keyCode == '122') {
        console.log('test');
        if(canvas.requestFullscreen){
        }
      }
    }
  }
});



/*------- Smooth Scroll -------*/

// $('a[href^="#"]').on('click', function(event) {

//     var target = $( $(this).attr('href') );

//     if( target.length ) {
//         event.preventDefault();
//         $('html, body').animate({
//             scrollTop: target.offset().top
//         }, 1000);
//     }

// });

