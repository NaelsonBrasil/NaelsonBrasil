let click = 0;

$(function() {
  let turnClick = 0;

  $("#admin-click").click(function() {
    turnClick = turnClick + 1;
    console.log(turnClick);

    if (turnClick == 1) {
      if ($("#adm-open").css("width", "1px")) {
        $("#admin-icon-click").text("arrow_forward");
      }
    }

    if (turnClick == 2) {
      if ($("#adm-open").css("width", "75%")) {
        $("#admin-icon-click").text("arrow_back");
        turnClick = 0;
      }
    }
  });
});

//Exemple: 31,07,2019,"13:10:00"
//Add Index countDown(31,07,2019,"13:10:00");
function countDown(day, moth, year, hour) {
  //Jan,Feb,Mar,Apr,Jun,Jul,Aug,Sep,Oct,Nov,Dec
  var day = day;
  var month = moth;
  var year = year;
  var hour = hour;
  var nTime = "" + month + " " + day + ", " + year + " " + hour + "";
  var countDownDate = new Date(nTime).getTime();

  var dateCurrent = new Date();
  dateCurrent.setTime(countDownDate);

  // Update the count down every 1 second
  var x = setInterval(function() {
    // Get todays date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor(
      (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("demo").innerHTML =
      "<div class='countdown'><div class='title-countdown'></div><ul>" +
      "<li>" +
      days +
      "<div class='day'>Day</div></li>" +
      "<li>" +
      hours +
      "<div class='day'>Hour</div></li>" +
      "<li>" +
      minutes +
      "<div class='day'>Min</div></li>" +
      "<li>" +
      seconds +
      "<div class='day' style='top: -" +
      seconds +
      "px;color: rgba(255,255,255,0);'>sec</div></li>" +
      "</ul></div>";

    let current = new Date().getTime(); //Current

    if (current > countDownDate) {
      clearInterval(x);

      let element = document.getElementById("demo");
      element.style.display = "none";
      console.log("countDown Expired");
    }
  }, 1000);
}
