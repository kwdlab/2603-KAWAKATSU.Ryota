<form method="POST" action="/test">
  @csrf
  <label>Email:</label>
  <input type="text" name="user[email]" value="invalid-email">
  <button type="submit">送信</button>
</form>
