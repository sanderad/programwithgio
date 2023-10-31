<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .total-box {
            display: grid;
            grid-template-columns: 300px;
            row-gap: 1px;
        }
    
        .yes {
            margin-left: 12.2px;
        }

        .create-password-box {
            margin-top: 10px;
        }
        
    </style>
</head>
<body>
<div class="total-box">

    <form action="/new" method="post">
        <div class="create-password-box">
            <label>Create Password</label>
            <input class="yes" type="password" name="createPassword"></input>
        </div>
    </form>
</div>
    
</body>
</html>

