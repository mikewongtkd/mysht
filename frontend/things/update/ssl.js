function drawWebcamContinuous(){
  ctx.drawImage(video,0,0);
  requestAnimationFrame(drawWebcamContinuous);
}

// Camera setup function - returns a Promise so we have to call it in an async function
async function setupCamera() {
    // Find the video element on our HTML page
    video = document.getElementById('video');

    // Request the front-facing camera of the device
    const stream = await navigator.mediaDevices.getUserMedia({
        'audio': false,
        'video': {
          facingMode: 'environment',
          height: {ideal:1920},
          width: {ideal: 1920},
        },
      });
    video.srcObject = stream;

    // Handle the video stream once it loads.
    return new Promise((resolve) => {
        video.onloadedmetadata = () => {
            resolve(video);
        };
    });
}

function drawWebcamContinuous(){
    ctx.drawImage(video,0,0);
    requestAnimationFrame(drawWebcamContinuous);
}

var canvas;
var ctx;

async function main() {
    // Set up front-facing camera
    await setupCamera();
    video.play()

    // Set up canvas for livestreaming
    canvas = document.getElementById('canvas');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    ctx = canvas.getContext('2d');

    // Start continuous drawing function
    drawWebcamContinuous();

    $( '#take-picture' ).click( ev => {
      $( '#take-picture' ).hide();
      $( '#confirm-dialog' ).show();
    });

    $( '#picture-cancel' ).click( ev => {
      $( '#confirm-dialog' ).hide();
      $( '#take-picture' ).show();
    });

    $( '#picture-ok' ).click( ev => {
      $( '#confirm-dialog' ).hide();
      $( '#take-picture' ).show();
    });
}

// Delay the camera request by a bit, until the main body has loaded
document.addEventListener("DOMContentLoaded", main);
