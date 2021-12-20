var valuesOld = new Array();
let num = 0;

function selected(pDiv,idTemplate) {
  webName = document.getElementById("targetName").value;

  if (webName.length > 0) {
    num = num + 1;
    valuesOld[num] = pDiv;

    // console.log(
    //   "Key=" + num + " Old=" + valuesOld[num] + " Current event=" + pDiv
    // );

    $("#div" + pDiv).css("border-left", " 10px solid rgb(133, 189, 147)");
    if (valuesOld[2] > 0 && valuesOld[1] > 0) {
      $("#div" + valuesOld[num - 1]).css(
        "border-left",
        "10px solid rgb(236, 179, 179)"
      );
    }

    if (pDiv == valuesOld[num]) {
      $("#div" + pDiv).css("border-left", " 10px solid rgb(133, 189, 147)");
    }

    document.getElementById("targetId").value = idTemplate;
    
  } else {
    alert("Web Name Empty");
  }
}

var nChecked = new Array(0x0, 0x0, 0x0);

function selectClick(val) {
  let getVal;
  if (val > 0x0) nChecked[1] = getVal = 1;
  else nChecked[1] = getVal = 0x0;
}

function selectChecked(val) {
  let getVal;
  if (val > 0x0 && val != undefined) nChecked[2] = getVal = 1;
  else nChecked[2] = getVal = 0x0;
  // console.log(getVal);
}

function countArrayObj(j) {
  return j.filter(obj => obj.id > 0).length;
}

function alphanumeric(inputtxt) {
  var letterNumber = /^[0-9a-zA-Z]+$/;

  if (inputtxt.match(letterNumber)) {
    return true;
  } else {
    return false;
  }
}
