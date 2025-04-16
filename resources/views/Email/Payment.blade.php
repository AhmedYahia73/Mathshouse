<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            color: #333;
        }

            .payment-request {
                background-color: #f9f9f9;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .highlight {
                color: green;
                font-weight: bold;
            }

    </style>
</head>
<body>
    <main>
        <section class="payment-request">
            <h1>Payment Request</h1>
            <p>
                Student 
                <span class="highlight">
                    (
                        {{$user_data->f_name}}
                        {{$user_data->l_name}}
                    )
                    {{$user_data->nick_name}}
                </span> 
                has sent a payment request on 
                <span class="highlight">{{$now}}</span>.
            </p>
        </section>
    </main>
</body>
</html>
