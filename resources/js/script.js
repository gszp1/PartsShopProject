function goToPage(pageName) {
    var url = pageName;
    window.location.href=url;
}

// // Get the navbar
// var navbar = document.getElementById("navbar");

// // Get the offset position of the navbar
// var sticky = navbar.offsetTop;

// // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
// function stickyNavbar() {
//     if (window.pageYOffset >= sticky) {
//         navbar.classList.add("sticky");
//     } else {
//         navbar.classList.remove("sticky");
//     }
// }

// // When the user scrolls, run the stickyNavbar function
// window.onscroll = function() {
//     stickyNavbar();
// };