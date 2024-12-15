<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.css">
</head>
<body>

    <div class="container mt-4">
        <h2>
            <a href="{{ url('tasks/create') }}" class="btn btn-primary">Create New Task</a>
        </h2>
        <table id="task-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>Task Name</th>
                    <th>Position</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    <tr class="draggable" data-id="{{ $task->id }}">
                        <td>{{ $task->name }}</td>
                        <td>{{$task->position}}</td>
                        <td>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">No tasks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
       document.addEventListener('DOMContentLoaded', function () {
    const drake = dragula([document.getElementById('task-table').querySelector('tbody')]);

    drake.on('drop', function (el, target, source, sibling) {
        let order = [];
        document.querySelectorAll('#task-table tbody tr').forEach((item) => {
            order.push(item.getAttribute('data-id'));
        });

        // Send the new order to the server
        $.ajax({
            url: '{{ route('tasks.updateOrder') }}', // Ensure this route is correct
            method: 'POST',
            data: {
                order: order,
                _token: '{{ csrf_token() }}' // Include CSRF token for security
            },
            success: function (response) {
                if (response.success) {
                    console.log('Order updated successfully!');
                }
            },
            error: function (xhr) {
                console.error('Error updating order:', xhr);
            }
        });
    });
});
    </script>
</body>
</html>