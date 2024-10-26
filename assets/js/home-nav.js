window.onscroll = function() {
    var navbar = document.getElementById("navbar");
    console.log(window.scrollY); 
    alert("Scroll detected!");   
    if (window.scrollY > 50) {  
        navbar.classList.add("scrolled");
        console.log("Navbar berubah warna"); 
    } else {
        navbar.classList.remove("scrolled");
        console.log("Navbar kembali transparan"); 
    }
};
