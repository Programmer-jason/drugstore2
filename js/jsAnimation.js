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

  $(".lastchild").click(function () {
    $(".checkout").slideDown("slow");
  });

  $("#btn-close").click(function () {
    $(".checkout").slideUp("fast");
  });

  $(".btn-add-stock").click(function () {
    $(".add-product-content").fadeIn("3000");
  });

  $(".btn-damage").click(function () {
    $(".add-product-content").fadeIn("3000");
  });

  $(".cancel").click(function () {
    $(".add-product-content").fadeOut("3000");
  });


});
