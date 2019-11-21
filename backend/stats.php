<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>void</title>
    
    
    <style>
        body {
            text-align: center;
            background: #242424;
            color: white;
        },
        img {
            cursor: pointer
        }
    </style>

    <script type="text/javascript">
        const img = document.getElemementByTagName('img')[0];
        const iframe = document.getElementByTagName('iframe')[0];
        
        iframe.width = img.width;
        iframe.height = img.height;
    </script>
</head>
<body>
    <h1>Not yet...</h1>
    <img src="https://i.pinimg.com/originals/cc/80/a2/cc80a21ea8cc7e993632d81a697097a2.gif">
    <iframe 
        style= 'display:block'
        src="https://www.youtube.com/embed/Hmp4ayc_BXc?autoplay=1" 
        frameborder="0" 
        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" 
        allowfullscreen
        >
    </iframe>
</body>
</html>