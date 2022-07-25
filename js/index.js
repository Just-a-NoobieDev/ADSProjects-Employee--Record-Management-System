const sidebar = document.getElementById("sidebar");
const  hamburger = document.getElementById("menu");

hamburger.addEventListener("click", function() {
  if ( sidebar.classList.contains("active") ) { 
     sidebar.classList.remove( "active" ); 
  } else { 
     sidebar.classList.add( "active" ); 
  }
})
