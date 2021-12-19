chrome.storage.sync.get("name1", function (obj) { styleWhatsapp(obj); });
function styleWhatsapp(obj) {
  var lisClassName = document.querySelector("#pane-side > div > div > div > div").className;
  var arrayLi      = [];
  var l_first      = false;

setInterval(() => {

  var allDivs = document.querySelectorAll("." + lisClassName);
  for(var i = 0; i < allDivs.length; i++) {
      var prevClassName = allDivs[i].className.split(" ");
    if(prevClassName.length == 1 && l_first == true) {
      allDivs[i].className += " " + "devna" + i;
      let divStyle = document.querySelector("."+"devna" + i+" > div > div ");
      divStyle.style.opacity = "0.0";
      showMessageByName(divStyle,obj,i);
    }
    if (l_first == false) {
      allDivs[i].className += " " + "devna" + i;
      let divStyle = document.querySelector("."+"devna" + i+" > div > div ");
      divStyle.style.opacity = "0.0";
    }
    showMessageByName(document.querySelector("."+"devna" + i+" > div > div "),obj,i);
      arrayLi[i] = "devna" + i;
      l_first = true;
  }

}, 100);
}

function showMessageByName(cn,ObjectName,key) {
   if(cn != null) { 
    cn.id = "get-name" + key;
    let divs_get_name = document.querySelectorAll("#" + cn.id + "> div > div > div > span");
    let name_id = divs_get_name[1].id = "span-name" + key;
    let name = document.querySelector("#"+name_id + " > span").innerHTML;
    let nFilter = name.replace(/\s/g, "").toLowerCase();
    let n1 = ObjectName.name1.replace(/\s/g, "").toLowerCase();
    switch (nFilter) { 
    case n1: document.querySelector("."+"devna" + key+" > div > div ").style.opacity = "0.9"; console.log(nFilter); break;
    default: document.querySelector("."+"devna" + key+" > div > div ").style.opacity = "0.0"; break;
    }
  }
}