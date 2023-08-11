$(document).ready(function () {
  // INVENTORY
  $("form").slideDown("slow");

  $(".btn-primary").click(function () {
    $("form").slideUp("slow");
    $(".modal").fadeOut("slow");
  });

  $("#notifShow").click(function () {
    $(".notifContent").slideToggle("slow");
  });

  $(".buy-btn").click(function () {
    $(".checkout").slideDown("slow");
  });


});
