<!-- resources/views/linked-list.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Priority Queue in Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Draggable Priority Queue</h2>
    <p>Drag and rearrange the rows to set priority:</p>
    <form action="{{ route('welcome.swap') }}" method="POST" id="swap-form">
        @csrf
        <table id="drag-elements" class="table">
            <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $index => $item)
                    <tr data-index="{{ $index }}">
                        <td>{{ $item['first_name'] }}</td>
                        <td>{{ $item['last_name'] }}</td>
                        <td>{{ $item['email'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <input type="hidden" name="order" id="order" value="">
        <button type="submit" class="btn btn-primary">Save Order</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const drake = dragula([document.getElementById('drag-elements').getElementsByTagName('tbody')[0]]);

        drake.on('drop', function () {
            let order = [];
            document.querySelectorAll('#drag-elements tbody tr').forEach((row) => {
                order.push(row.getAttribute('data-index'));
            });
            document.getElementById('order').value = order.join(',');
        });
    });
</script>

</body>
</html>