// Appel de showSlides une fois que la page est chargée
window.onload = function() {
  showSlides();
};

var slideIndex = 0;

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  
  // Reset display for all slides
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  
  // Increment slideIndex and ensure it stays within bounds
  slideIndex++;
  if (slideIndex >= slides.length) {
    slideIndex = 0;
  } 
  
  // Display the current slide
  slides[slideIndex].style.display = "block";  

  // Schedule the next slide change
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}

function plusSlides(n) {
  // Adjust slideIndex by n
  slideIndex += n;
  // Ensure slideIndex stays within bounds
  var slides = document.getElementsByClassName("mySlides");
  if (slideIndex >= slides.length) {
    slideIndex = 0;
  } else if (slideIndex < 0) {
    slideIndex = slides.length - 1;
  }
  // Show the slide
  showSlides();
}
