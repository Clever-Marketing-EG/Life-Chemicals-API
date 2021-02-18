<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        form {
            border: 3px solid #f1f1f1;
            width: 22%;
            margin: 15% auto 0;
            background-color: rgba(0, 0, 255, 0.075);
        }

        input[type=text],
        input[type=password] {
            width: 90%;
            padding: 12px 20px;
            margin: 8px 0;
            display: block;
            border: 1px solid #ccc;
            box-sizing: border-box;
            border-radius: 3px;

        }

        button {
            background-color: rgba(3, 3, 66, 0.404);
            color: #fff;
            padding: 14px 20px;
            border: none;
            cursor: pointer;
            width: 30%;
            align-items: center;
            border-radius: 3px;
            margin: 8px 0 8px 30%;

        }

        button:hover {
            opacity: 0.5;

        }


        .container {
            padding: 16px;
            margin-left : 18px ;
        }


        label {
            color: rgb(148, 147, 147);
        }

        h2 {
            text-align: center;
            color: rgb(148, 147, 147);
        }
    </style>
</head>

<body>
<form method="POST" action="{{route('password.update')}}">
    <h2>Reset Admin Password</h2>


        <div class="container">
            <input type="hidden" value="{{$token}}" name="token">
            <label>
                <b>Email</b>
                <input type="text" placeholder="Email" name="email" required>
            </label>
            <label>
                <b>Password</b>
                <input type="password" placeholder="New Password" name="password" required>
            </label>
            <label>
                <b>Re-enter Password</b>
                <input type="password" placeholder="Confirm New Password" name="password_confirmation" required>
            </label>

            <button type="submit">Reset</button>

        </div>


    </form>

</body>

</html>
