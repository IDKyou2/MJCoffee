<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/loader2.css">
</head>

<body>
    <div class="loader-wrapper">
        <div class="loader"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(window).on("load", function() {
            setTimeout(function() {
                $(".loader-wrapper").fadeOut("slow");
            }, 125);
        });
    </script>
</body>

</html>