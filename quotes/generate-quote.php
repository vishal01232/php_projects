<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <blockquote>
        <p></p>
    </blockquote>
</head>

<body>
    <div id="container">
        <h2>Random Quote Generator</h2>

        <div id="buttonContainer">
            <button type="button" id="quoteButton">Generate Quote</button>
        </div>
        <!--end buttonContainer-->
        <div id="quoteContainer"></div>
        <!--end quoteContainer-->
        <p id="quoteAuthor"></p>
    </div>
    <!--end Container-->
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        $("button").click(function() {
            $.ajax({
                type: 'POST',
                data: ({
                    tag: 'love'
                }),
                url: 'get-quote.php',
                success: function(data) {
                    var obj = JSON.parse(data)
                    $("#quoteContainer").html(obj.quote);
                    $("#quoteAuthor").html(obj.author);

                }
            });
        });
    });
</script>