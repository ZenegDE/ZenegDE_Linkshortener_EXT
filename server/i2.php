<?php

$run = false;

$geturl = urldecode($_GET['url']);

if($geturl == "chrome://newtab/"){
    $geturl = "";
}

if (isset($_POST['link'])) {
    $link = $_POST['link'];
    $blocked_urls = json_decode(file_get_contents("no_url.json"), true);



    if(array_search($blocked_urls, $link)){
        $link = "";
    }

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

    if ($re['success'] == "true") {
        $run = true;
        /*echo "URL: <a target='_blank' href='" . $re['url'] . "'>" . $re['url'] . "</a>";
        echo "<br>Secret: " . $re['site_key'];*/
    }



}


?>
<head>
    <link href="https://short.zeneg.de/css/app.dark.css" rel="stylesheet" id="app-css">
    <link href="hideScrollbar.css" rel="stylesheet" type="text/css">
    <style>
        ::placeholder {
            text-align: center;
        }
    </style>
    <title></title>
</head>

<body>
<div style="margin-left: 7%">

<?php

if(!$run){?>

    <div class="col-12 py-sm-5 row" style="zoom: 80%">
        <div class="col-12 col-lg-8">
            <div class="form-group mt-5" id="short-form-container">
                <form method="post" id="short-form">
                    <input type="hidden" name="_token" value="nlkHL6ytZaudXmAsLKs8BmG3Y8LbBNq54u3keVNo">
                    <div class="form-row">
                        <label for="inputfield"></label>
                            <input  id="inputfield" value="<?php echo $geturl ?: '' ?>" type="text" dir="ltr" autocomplete="off"
                                   autocapitalize="none" spellcheck="false" name="link"
                                   class="form-control form-control-lg font-size-lg"
                                   placeholder="Gib deinen zu k??rzenden Link ein" autofocus="" required


                        <br><br>
                        <!--<br>
                        <label for="redirect_delay_dropdown"><p>Weiterleitungsverz??gerung</p></label><br>
                        <select name="redirect_delay" id="redirect_delay_dropdown" class="dropdown" required>
                            <option value="0">Sofort</option>
                            <option value="1">1 Sek.</option>
                            <option value="2">2 Sek.</option>
                            <option value="3" selected>3 Sek.</option>
                            <option value="4">4 Sek.</option>
                            <option value="5">5 Sek.</option>
                        </select>
                        <br>-->
                        <div class="col-12 col-sm-auto">
                            <button class="btn btn-primary btn-lg btn-block font-size-lg mt-3 mt-sm-0" type="submit">
                                K??rzen
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}else{
    ?>
    <div class="col-12 py-sm-5 row">

        <div class="col-12 col-lg-8">
            <div class="form-group mt-5" id="short-form-container">
                <form method="post" id="short-form">
                    <input type="hidden" name="_token" value="nlkHL6ytZaudXmAsLKs8BmG3Y8LbBNq54u3keVNo">
                    <div class="form-row">
                        <a target="_blank" href="https://short.zeneg.de/result_ext.php?secret=<?= $re['site_key'] ?>&site=<?= $re['url'] ?>">In neuem Tab anzeigen</a>
                        <p>Gek??rzter Link: <a href="#" onclick="navigator.clipboard.writeText('<?= $re['url'] ?>')"><?= $re['url'] ?></a></p>
                        <p>Secret-Key: <?= $re['site_key'] ?></p>
                        <p>Kopiere dir den Link, er kann dir nicht nochmal hier angezeigt werden.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}?>

<script src="scrollToEndOfFile.js"></script>

</div>
</body>