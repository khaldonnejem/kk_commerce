<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.0/css/bootstrap.min.css">
    <style>
        .invoice-head td {
            padding: 0 8px;
        }

        .container {
            padding-top: 30px;
        }

        .invoice-body {
            background-color: transparent;
        }

        .invoice-thank {
            margin-top: 60px;
            padding: 5px;
        }

        address {
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <!-- <h1>Theres an a new file</h1> -->

    <div class="container">
        <div class="row">
            <div class="span4">

                {{-- {!! QrCode::size(150)->generate('Khaldon Nejem Buy Mercides Car From Us'); !!} --}}
                {{-- {!! QrCode::format('png')->size(150)->generate('Khaldon Nejem Buy Mercides Car From Us'); !!} --}}
                <img
                    src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(100)->generate("Thanks Maysam for your purchase an Laptop From Us")) }}" />
                    {{-- src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(100)->generate('Thanks ('. $this->order->user->name.') For you purchase and ('. $this->order->id .')')) }}" /> --}}

                <address>
                    <strong>Khaldon Web services Kha. Ltd.</strong><br>

                    35, {{ $order->user->name }}<br>
                    Palestine, Gaza-122001 (Gaza)
                </address>
            </div>
            <div class="span4 well">
                <table class="invoice-head">
                    <tbody>
                        <tr>
                            <td class="pull-right"><strong>Customer #</strong></td>
                            <td>{{ $order->user_id }}</td>
                        </tr>
                        <tr>
                            <td class="pull-right"><strong>Invoice #</strong></td>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <td class="pull-right"><strong>Date</strong></td>
                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="span8">
                <h2>Invoice</h2>
            </div>
        </div>
        <div class="row">
            <div class="span8 well invoice-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->order_items as $item)

                        <tr>
                            <td>{{ $item->product->trans_name }}</td>
                            <td>${{ $item->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ $item->quantity * $item->price }}</td>
                        </tr>

                        @endforeach
                        <tr>
                            <td colspan="4"></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                            <td><strong>Total</strong></td>
                            <td><strong>${{ $order->total }}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="span8 well invoice-thank">
                <h5 style="text-align:center;">Thank You!</h5>
            </div>
        </div>
        <div class="row">
            <div class="span3">
                <strong>Phone:</strong>+970597068306
            </div>
            <div class="span3">
                <strong>Email:</strong> <a href="khaldon.r.n.n@gmail.com">khaldon.r.n.n@gmail.com</a>
            </div>
            <div class="span3">
                <strong>Website:</strong> <a href="http://webivorous.com">http://webivorous.com</a>
            </div>
        </div>
    </div>


</body>

</html>
