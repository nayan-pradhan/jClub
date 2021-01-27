//Jquery and javascript
//required for the scroll to work
$(function () {
    $('a[href*=]').on('click', function (e) {
        e.preventDefault();
        $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top }, 2000, 'linear');
    });
});

document.getElementById("LandingPage").scrollIntoView();

