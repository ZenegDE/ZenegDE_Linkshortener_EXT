
document.getElementById('submit').addEventListener("click", function(){
    var link = document.getElementById('link').value

    var url = "https://api.ysenay.de/v1/projects/zeneg/linkshort/index.php";

    var xhr = new XMLHttpRequest();
    xhr.open("POST", url);

    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("Access-Control-Allow-Origin", "https://api.ysenay.de")

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            console.log(xhr.status);
            console.log(xhr.responseText);
            document.getElementById('result').innerText = xhr.responseText
        }};

    // var data = '{"url":"' + link + '"}';
    var data = '{"url":"google.com"}';
    console.log(data)

    xhr.send(data);
})

function short(){


}
