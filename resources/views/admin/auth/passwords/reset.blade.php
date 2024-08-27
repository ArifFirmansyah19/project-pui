<form method="POST" action="{{ route('admin.password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="email" name="email" placeholder="Masukkan email Anda" required>
    <input type="password" name="password" placeholder="Masukkan password baru" required>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi password baru" required>
    <button type="submit">Reset Password</button>
</form>
