$(function () {
  $(document).scroll(function () {
    var $nav = $(".navbar");
    $nav.toggleClass('scrolleo', $(this).scrollTop() > $nav.height());
  });
});