<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>NO AUTORIZADO - iRaffle TV</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,800;1,700&display=swap"
        rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            overflow: hiddden;
        }

        div {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
            font-family: "Poppins", sans-serif;
            color: #FFFFFF;
            font-size: 40px;
            user-select: none;
        }

        h1 {
            color: transparent;
            font-size: 25rem;
            margin: 0;
            -webkit-text-stroke: 2px white;
        }
    </style>
</head>

<body>
    <div>
        <h1>401</h1>
        <span>No Autorizado</span>
    </div>
    <!-- partial -->
    <script src="script.js"></script>
</body>
<script>
    const codes = document.querySelectorAll('h1');
    console.log(codes);
    for (let h1 of codes) {
        console.log(h1);
        let url;

        switch (h1.innerText) {
            case '400':
                url = 'https://media.giphy.com/media/l3q2K5jinAlChoCLS/source.gif';
                break;
            case '404':
                url = 'https://media.giphy.com/media/6uGhT1O4sxpi8/source.gif';
                break;
            case '401':
                url = 'https://media.giphy.com/media/kuf7g0KM5UMBW/source.gif';
                break;
            case '403':
                url = 'https://media.giphy.com/media/l2Je3CjIvDr0X2yn6/source.gif';
                break;
            case '500':
                url = 'https://media.giphy.com/media/zyclIRxMwlY40/source.gif';
                break;
            case '501':
                url = 'https://media.giphy.com/media/OSuaE6AknuRc7syZXp/giphy.gif';
                break;
            case '518':
                url = 'https://media.giphy.com/media/fWZvYFCh4oyl2/source.gif';
                break;
        }
        h1.parentElement.style.backgroundImage = `url(${url})`
    }
</script>

</html>