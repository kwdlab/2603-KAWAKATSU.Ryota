# CVE-2025-27515 PoC

Laravel 12.0.0（脆弱版）と 12.1.1（修正版）で、`files.*` ワイルドカード検証のバイパス挙動を比較するPoC。

## 対象
- 脆弱版: 12.0.0
- 修正版: 12.1.1
- 事象: `files.*` のキーに `.` を含めると `File` ルールがすり抜ける

## 環境
- Docker / Docker Compose

## 起動
```bash
docker compose up --build
```

## 確認手順
1. http://localhost:8021/bypass を開き、`text_as_jpg.jpg` を取得（ボタン or `/bypass/sample`）
2. キーを `.` のままにして送信し、返るJSONを確認
3. http://localhost:8022/bypass でも同じ操作を行い、`passes` の差を比較

## 判定
- 脆弱版: `{"passes":true,"errors":[]}`（PNG以外が通るため、`files.*` 検証がバイパスされている）
- 修正版: `{"passes":false,"errors":{"files..":["The files.. field must be a file of type: image/png."]}}`（`.` キーでも検証が働き、PNG以外が拒否される）

