chrome.tabs.query({currentWindow: true, active: true}, function(tabs){
    console.log(tabs[0].url);
    document.getElementById('iframe').src = "https://api.zeneg.de/v1/projects/zeneg/extension/server/?url=" + encodeURIComponent(tabs[0].url)
});





