<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        html{

        }
        #outer {
            border-radius: 1px;
            height: auto;
            display: inline-block;
            width: 100%;
            margin-left: 0px;
        }
        p {
            box-shadow: 0px 3px 3px black;
            padding: 5px;
            background-color: whitesmoke;
            margin: 5px;
            border-radius: 10px;
            }
        input[type=text] {
            box-shadow: 0px 3px 3px black;
            width: 80%;
            height: 26px;
            margin-top: 20px;
            border: 1px solid transparent;
            background-color: azure;
            font-size: 20px;
            display: inline-block;
            float: left;
        }
        input[type=text]:focus {
            border: 1px solid greenyellow;
            box-shadow: 0px 3px 3px black;
        }
        #submit {
            background-color: greenyellow;
            height: 30px;
            width: 15%;
            box-shadow: 0px 3px 3px black;
            border-radius: 1px;
            margin-top: 20px;
            float: right;
            border: 1px solid transparent;
            display: inline-block;
            padding-left: 20px;

        }
        #submit:hover {
            box-shadow: 0px 1px 1px black;
        }
        #text-container {
            height: 429px;
            overflow-y: scroll;
            background-color: transparent;
            box-shadow: 0px 3px 3px black;
            width: 107%;

        }
        #newLine {
            padding: 5px;
            margin: 5px;
            box-shadow: 0px 2px 2px black;
            border-radius: 3px;
            background-color: whitesmoke;

        }
    </style>

</head>
<body>

<div id="outer">
    <div id="text-container">
        <?php
            if(file_exists("log.html") && filesize("log.html") > 0){
                $handle = fopen("log.html", "r");
                $contents = fread($handle, filesize("log.html"));
                fclose($handle);

                echo $contents;
            }
        ?>
    </div>
    <form action="" name="form">
        <input type="text" name="input" id ="input" value="">
        <input type="button" id="submit" name="submit">
    </form>

</div>

    <script>
        $('#submit').click(function() {
            var message = $('#input').val();
            $.post("post.php", {text: message});
            $("#input").val(null);
            return false;
       });

        function load(){
            var oldScrollHeight = $("#text-container").attr("scrollHeight");
            $.ajax({
                url: "log.html",
                cache: false,
                success: function(html) {
                    $("#text-container").html(html);

                    var newScrollHeight = $("#text-container").attr("scrollHeight") - 20;
                    if (newScrollHeight > oldScrollHeight) {
                        $("#text-container").animate({ scrollTop: newScrollHeight }, 'normal');
                    }
                },
            });
        }
        setInterval(load, 1000);
    </script>

</body>



</html>
