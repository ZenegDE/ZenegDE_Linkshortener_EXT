
    chrome.tabs.getSelected(null,function(tab) {
    var tablink = tab.url;
    document.getElementById('result').innerHTML = tablink
});
