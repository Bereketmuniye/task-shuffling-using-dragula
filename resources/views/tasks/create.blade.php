<form action="{{ url('tasks') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Name" required>
    <button type="submit">Create tasks</button>
</form>