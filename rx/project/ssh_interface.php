<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSH Web Interface</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(14, 13, 13);
            text-align: center;
            margin: 50px;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            width: 50%;
        }

        textarea {
            width: 90%;
            height: 100px;
            margin-bottom: 10px;
            padding: 10px;
        }

        button {
            background: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }

        .output {
            background: #000;
            color: #0f0;
            padding: 10px;
            text-align: left;
            margin-top: 10px;
            overflow: auto;
            max-height: 300px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Interface SSH Web</h1>
        <form id="ssh-form">
            <textarea id="command" placeholder="Entrer une commande SSH..."></textarea>
            <br>
            <button type="submit">Exécuter</button>
        </form>
        <div class="output" id="output"></div>
    </div>

    <script>
        document.getElementById("ssh-form").addEventListener("submit", function(e) {
            e.preventDefault();
            var command = document.getElementById("command").value;
            var outputDiv = document.getElementById("output");

            fetch("ssh_connect.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "command=" + encodeURIComponent(command)
            })
            .then(response => response.text())
            .then(data => outputDiv.innerHTML = "<pre>" + data + "</pre>");
        });
    </script>

</body>
</html>
