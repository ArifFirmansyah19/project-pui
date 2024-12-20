<form action="{{ route('password.email') }}" method="POST">
    @csrf
    <label for="email">Email:</label>
    <input type="email" name="email" required>
    <button type="submit">Send Reset Link</button>
</form>
