// @author Rob W <http://stackoverflow.com/users/938089/rob-w>
// Demo: var serialized_html = DOMtoString(document);
/*
function DOMtoString(document_root) {
  var html = "", node = document_root.firstChild;
  while (node) {
    switch (node.nodeType) {
      case Node.ELEMENT_NODE: html += node.outerHTML;
        break;
      case Node.TEXT_NODE: html += node.nodeValue;
        break;
      case Node.CDATA_SECTION_NODE: html += "<![CDATA[" + node.nodeValue + "]]>";
        break;
      case Node.COMMENT_NODE:
        html += "<!--" + node.nodeValue + "-->";
        break;
      case Node.DOCUMENT_TYPE_NODE:
        // (X)HTML documents are identified by public identifiers
        html +=
          "<!DOCTYPE " + node.name + (node.publicId ? ' PUBLIC "' + node.publicId + '"' : "") +
          (!node.publicId && node.systemId ? " SYSTEM" : "") +
          (node.systemId ? ' "' + node.systemId + '"' : "") + ">\n";
        break;
    } node = node.nextSibling;
  }
  return html;
}

chrome.runtime.sendMessage({ action: "getSource", source: DOMtoString(document), });
*/
/*
var w = 800;
var h = 800;
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2); 
chrome.windows.create({'url': 'https://web.whatsapp.com/', 'type': 'popup', 'width': w, 'height': h, 'left': left, 'top': top} , function(window) {
  console.log(window);
});

chrome.browserAction.onClicked.addListener(function (tab) {
  chrome.tabs.executeScript({
    //code: 'var div=document.createElement("div"); document.body.appendChild(div); div.innerText="test123";'
    file: "whatsappStyle.js",
  });
});
*/
/*
chrome.browserAction.onClicked.addListener(function(tab) {
chrome.tabs.executeScript({
  file: "whatsappStyle.js"
});
});*/

/*
{
"name": "Append Test Text",
"description": "Add test123 to body",
"version": "1.0",
"permissions": [
  "activeTab"
],
"background": {
  "scripts": ["background.js"],
  "persistent": false
},
"browser_action": {
  "default_title": "Append Test Text"
},
"manifest_version": 2
}
*/


//external
/*
{
  "name": "Append Test Text",
  "description": "Add test123 to body",
  "version": "1.0",
  "permissions": [
    "activeTab"
  ],
  "content_scripts": [
    {
      "matches": ["http://*------[/*]----depois remove isto--"],
      "js": ["content-script.js"]
    }
  ],
  "browser_action": {
    "default_title": "Append Test Text",
    "default_popup": "popup.html"
  },
  "manifest_version": 2
}
*/