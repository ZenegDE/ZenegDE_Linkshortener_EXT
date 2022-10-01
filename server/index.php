<?php


if (isset($_POST['link'])){
    $link = $_POST['link'];

    $url = "https://api.ysenay.de/v1/projects/zeneg/linkshort/index.php";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Content-Type: application/json",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $data = '{"url":"' . $link . '"}';

    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    $re = json_decode($resp, true);

    if($re['success'] == "true"){
        echo "URL: <a target='_blank' href='" . $re['url'] . "'>" . $re['url'] . "</a>";
        echo "<br>Secret: " . $re['site_key'];
    }

}



?>

<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<div class="container mt-3" style="width: 450px;">
    <h2 class="text-center">ZenegDE URL Shortene</h2>
    <form method="post">
        <input value="<?= urldecode($_GET['url']) ?>" id="link" type="text" name="link" placeholder="URL">
        <button id="submit">Kürzen</button>
    </form>
    <span id="result"></span>
</div>

<!-- <script>document.getElementById('result').innerText = window.location</script> -->

</body>
</html>