
<html lang="en">
	<head>
        <style>
            
            @media only screen and (orientation: portrait) {
  #the-canvas{
      height: 50%!important;
  }
}
            </style>
    <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>

<div style = "position:fixed; margin-top:50px;">
  <button id="prev">Previous</button>
  <button id="next">Next</button>
  &nbsp; &nbsp;
  <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
</div> 
<button id="fullscreen" style ="margin-top:100px;">fullscreen</button>

<canvas id="the-canvas" style = "height:100%; width:100%;"></canvas>
<script>
    var url = "<?php echo base_url();?>" + "uploads/images/m.pdf";


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
    console.log(viewport);
    console.log(window.innerWidth/window.innerHeight);
    console.log( window.innerWidth/ viewport.width);
    scale = window.innerWidth/0.2/ (viewport.width);
    console.log(scale)
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
  document.getElementById('page_num').textContent = num;
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
}
document.getElementById('next').addEventListener('click', onNextPage);

/**
 * Asynchronously downloads PDF.
 */
pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
  pdfDoc = pdfDoc_;
  document.getElementById('page_count').textContent = pdfDoc.numPages;

  // Initial/first page rendering
  renderPage(pageNum);
});

button = document.getElementById('fullscreen');
canvas = document.getElementById('the-canvas');
button.addEventListener('click', function(){
    if (button.requestFullscreen) {
    canvas.requestFullscreen();
    }
});

// window.addEventListener("orientationchange", function(){
//     if(window.screen.orientation.type === "landscape-primary"){
//         canvas
//     }
//     else if (window.screen.orientation.type === "portrait-primary"){
//         canvas = document.getElementById('the-canvas');
//         canvas.height.height*2;
        
//     }
// })

    </script>
	</body>
</html>
