<!DOCTYPE html>
<html lang="ja">
<head><meta charset="utf-8"><title>Nested File Rule Test</title></head>
<body>
  <h1>Nested File Rule Test</h1>
  <p>attachments[0][file] と attachments[1][file] にファイルを入れて送信</p>

  <form action="/test" method="POST" enctype="multipart/form-data">
    @csrf
    <div><label>attachments[0][file]:</label><input type="file" name="attachments[0][file]"></div>
    <div><label>attachments[1][file]:</label><input type="file" name="attachments[1][file]"></div>
    <button type="submit">送信</button>
  </form>
</body>
</html>
