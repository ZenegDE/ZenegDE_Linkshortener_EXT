
document.getElementById('submit').addEventListener("click", function(){
    console.log(document.getElementById("link"))
    var link = document.getElementById('link').value


    if(link === ""){
        return;
    }

    var url = "https://api.ysenay.de/v1/projects/zeneg/linkshort/index.php";

    var xhr = new XMLHttpRequest();
    xhr.open("POST", url);

    xhr.setRequestHeader("Content-Type", "application/json");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            console.log(xhr.status);
            console.log(xhr.responseText);
            document.getElementById('result').innerText = xhr.responseText
        }};

    var data = '{"url":"' + link + '"}';

    xhr.send(data);
})

function short(){


}
