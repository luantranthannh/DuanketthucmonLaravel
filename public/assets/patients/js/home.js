//Thay đổi màu khi nhấn vào thẻ a
document.querySelectorAll('.menu-1 a').forEach(function(element) {
    element.addEventListener('click', function() {
        this.style.color = '#1CBBD0';
    });
});

var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 5000);
}