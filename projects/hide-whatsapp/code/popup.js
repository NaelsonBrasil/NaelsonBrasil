document.addEventListener(
  "DOMContentLoaded",function () {
    var checkPageButton = document.getElementById("hidden-wts");
    checkPageButton.addEventListener("click", function (event) {
      active();
    });
  },
  false
);

function active() {
  var n1 = document.getElementById("name1").value;
  chrome.storage.sync.set({ name1: n1 }, function () {
    chrome.tabs.executeScript({
      file: "whatsappStyle.js",
    });
  });
}
