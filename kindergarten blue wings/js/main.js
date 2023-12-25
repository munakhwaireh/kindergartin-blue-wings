(function ($) {
    "use strict";

    // Initiate the wowjs
    new WOW().init();


    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.sticky-top').addClass('shadow-sm').css('top', '0px');
        } else {
            $('.sticky-top').removeClass('shadow-sm').css('top', '-100px');
        }
    });


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Header carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        items: 1,
        dots: true,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>'
        ]
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 24,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-arrow-left"></i>',
            '<i class="bi bi-arrow-right"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            992:{
                items:2
            }
        }
    });

})(jQuery);

//
// // Your existing JavaScript code...
//
// // Additional JavaScript for Library page
// document.addEventListener('DOMContentLoaded', function () {
//     // Array to store books (replace this with your backend/database logic)
//     const books = [];
//
//     // Function to add a book
//     window.addBook = function () {
//         const bookCover = document.getElementById('bookCover').value;
//         const bookName = document.getElementById('bookName').value;
//         const suitableAge = document.getElementById('suitableAge').value;
//         const bookType = document.getElementById('bookType').value;
//
//         // Validate input (you can add more validation logic)
//         if (!bookCover || !bookName || !suitableAge || !bookType) {
//             alert('Please fill in all fields.');
//             return;
//         }
//
//         // Create a new book object
//         const newBook = {
//             cover: bookCover,
//             name: bookName,
//             age: suitableAge,
//             type: bookType,
//         };
//
//         // Add the book to the array
//         books.push(newBook);
//
//         // Clear the form fields
//         document.getElementById('bookCover').value = '';
//         document.getElementById('bookName').value = '';
//         document.getElementById('suitableAge').value = '';
//         document.getElementById('bookType').value = '';
//
//         // Refresh the book list
//         refreshBookList();
//     };
//
//     // Function to refresh the book list
//     function refreshBookList() {
//         const bookListContainer = document.getElementById('bookList');
//
//         // Clear the existing content
//         bookListContainer.innerHTML = '';
//
//         // Generate the book list HTML
//         const bookListHTML = books.map(book => `
//             <div class="card mb-3">
//                 <img src="${book.cover}" class="card-img-top" alt="${book.name}">
//                 <div class="card-body">
//                     <h5 class="card-title">${book.name}</h5>
//                     <p class="card-text">Suitable Age: ${book.age}</p>
//                     <p class="card-text">Type: ${book.type}</p>
//                 </div>
//             </div>
//         `).join('');
//
//         // Append the HTML to the container
//         bookListContainer.innerHTML = bookListHTML;
//     }
//
//     // Call the initial refresh
//     refreshBookList();
// });
