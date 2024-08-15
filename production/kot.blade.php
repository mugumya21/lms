<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>Posventor | Invoice Receipt</title>
    <script type="text/javascript">
        window.onload = function() {
            window.print();
            var is_chrome = function() {
                return Boolean(window.chrome);
            }
            if (is_chrome) {
                setTimeout(function() {
                    document.location.href = "/all/orders";
                }, 3000);
            } else {
                document.location.href = "/all/orders";
            }
        }
    </script>
</head>

<body>
    <table width="100%">
        <tr>
            <th width="15%"></th>
            <th width="70%">
                <strong
                    style="font-size: 21px;">{{ Auth::user()->business ? Auth::user()->business->name : '' }}</strong><br>
                <span
                    style="font-size: 15px;">{{ Auth::user()->business ? (Auth::user()->business->location ? Auth::user()->business->location : '') : '' }}</span><br>
                <span
                    style="font-size: 15px;">{{ Auth::user()->business ? (Auth::user()->business->contact1 ? Auth::user()->business->contact1 : '') : '' }} {{ Auth::user()->business ? (Auth::user()->business->contact2 ? ' / '.Auth::user()->business->contact2 : '') : '' }}</span><br>
                <span
                    style="font-size: 15px;">{{ Auth::user()->business ? (Auth::user()->business->email ? Auth::user()->business->email : '') : '' }}</span><br>
            </th>
            <th width="15%"></th>
        </tr>
    </table>
    <hr>
    <u>
        <center><strong style="font-size: 20px;">KOT</strong></center>
    </u>
    <table width="100%">
        <tr>
            <td>Date:</td>
            <td>{{ $data->created_at }}</td>
        </tr>
        <tr>
            <td>Ticket No:</td>
            <td><span style="color:red; text-decoration:underline;">#{{ date('ymdhms') }}</span></td>
        </tr>
    </table>
    <hr>
    <table width="100%" border="1" style="border-collapse: collapse;width: 100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Qty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->details as $item)
                @if ($item->product && $item->product->type == 1)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->product ? $item->product->product_name : '' }}</td>
                        <td>{{ $item->quantity }}{{ $item->unitx ? $item->unitx->unit->symbol : '' }}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    <hr>
    <span style="font-size: 20px;">Table: <strong><i>{{ $data->table ? $data->table->name : '' }}</i></strong></span>
    <hr>
    <center>
        <span>Waiter: <strong><i>{{ Auth::user()->name }}</i></strong></span>
        <p>Printed Via www.posventor.com</p>
    </center>
</body>

</html>
