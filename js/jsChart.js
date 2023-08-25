google.charts.load("current", { packages: ["corechart"] });
google.charts.setOnLoadCallback(userGenderChart);

function userGenderChart() {
  var data = google.visualization.arrayToDataTable([
    ["Total Users", "users"],
    ["Users", 67],
    ["Non Users", 87],
  ]);

  var options = {
    title: "Total Users",
    colors: ["#00b368", "#c72b2b"],
    width: 330,
    height: 230,
    backgroundColor: "transparent",
    // pieHole: 0.5,
  };
  var chart = new google.visualization.PieChart(
    document.getElementById("myChart")
  );
  chart.draw(data, options);
}

google.charts.load("current", { packages: ["corechart"] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ["Effort", "gender"],
    ["female", 35],
    ["Male", 45],
  ]);

  var options = {
    backgroundColor: "transparent",
    title: "User Gender",
    colors: ["#0A6EBD", "#E966A0"],
    width: 330,
    height: 230,
    // is3D: true,

    // chartArea: {
    //   left: "150",
    // },
  };
  var chart = new google.visualization.PieChart(
    document.getElementById("userGenderChart")
  );
  chart.draw(data, options);
}
