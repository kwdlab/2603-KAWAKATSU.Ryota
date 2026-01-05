<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>CVE-2024-13918</title>
    <style>
        .page { margin: 0 auto; padding: 28px 80px; font-size: 14px; line-height: 1.6; }
        .page h1 { text-align: center; font-size: 30px; margin: 0 0 12px; }
        .page .desc { text-align: center; color: #000; margin: 0 0 28px; font-size: 14px; }
        .section { margin-top: 45px; }
        .section h2 { margin: 0 0 10px; font-size: 18px; position: relative; padding-left: 12px; }
        .section h2::before { content: ""; position: absolute; left: 0; top: 6px; width: 5px; height: 16px; background: #000; border-radius: 0; }
        .section ol, .section ul { margin: 6px 0 0 18px; padding-left: 12px; }
        .section li { margin: 4px 0; }
        .code-block { background: #3a3a3a; color: #e5e7eb; padding: 10px 12px; border-radius: 6px; overflow-x: auto; font-size: 12px; display: inline-block; max-width: 100%; }
        .section code { background: #ececec; padding: 1px 4px; }
        .notice { background: #e7f1fb; border-left: 4px solid #0d6efd; padding: 10px 12px; font-size: 13px; color: #0d3b78; margin-top: 10px; }
        .danger { background: #fdecea; border-left: 4px solid #d9534f; padding: 10px 12px; font-size: 13px; color: #842029; margin-top: 10px; }
        details { margin-top: 10px; }
        details summary { cursor: pointer; font-weight: 600; }
        details pre { background: #f8f9fa; padding: 8px 10px; border-radius: 6px; overflow-x: auto; font-size: 12px; margin-top: 6px; }
        .vulnerable-label { color: #d9534f; font-weight: bold; margin-right: 8px; font-size: 23px; }
        .fixed-label { color: #0d6efd; font-weight: bold; margin-right: 8px; font-size: 23px; }
    </style>
</head>
<body>
    <div class="page">
        <header>
            <h1 style="line-height: 1.3;">
                <div><span class="fixed-label">修正版（Laravel 12.31.1）</span></div>
                <div>CVE-2024-13918</div>
            </h1>
            <p class="desc">
                APP_DEBUG=true でも例外ページの <code>q</code> はエスケープ表示され、
                <code>&lt;script&gt;</code> が実行されないことを確認する。
            </p>
        </header>

        <section class="section">
            <h2>ポイント</h2>
            <ul>
                <li>脆弱版と同じ <code>/test</code> で例外を発生させる。</li>
                <li>クエリ <code>?q=</code> は文字列として表示され、スクリプトは実行されない。</li>
                <li>アラートが出なければ修正が有効。</li>
            </ul>
            <div class="notice">
                例外ページに <code>&lt;script&gt;</code> が表示されても、実行されなければ防御成功。
            </div>
        </section>

        <section class="section">
            <h2>手順</h2>
            <ol>
                <li>ブラウザで以下の URL にアクセスする。</li>
                <li>例外ページでアラートが出ないことを確認する。</li>
            </ol>
            <div class="code-block">
                http://localhost:8012/test?q=%3Cscript%3Ealert('攻撃成功')%3C/script%3E
            </div>
        </section>

        <section class="section">
            <h2>判定</h2>
            <p><strong>防御成功（期待される挙動）</strong></p>
            <ul>
                <li>アラートは実行されない。</li>
                <li>例外ページにはエスケープされた文字列が表示される。</li>
            </ul>

            <p><strong>防御失敗（想定外）</strong></p>
            <ul>
                <li>アラートが実行される。</li>
                <li>例外ページに <code>&lt;script&gt;</code> が未エスケープで出力される。</li>
            </ul>

            <div class="danger">
                もしアラートが出る場合は修正が効いていない可能性があるため要確認。
            </div>
        </section>

        <section class="section">
            <h2>参考</h2>
            <p>アクセス例（再掲）：</p>
            <div class="code-block">
                http://localhost:8012/test?q=%3Cscript%3Ealert('攻撃成功')%3C/script%3E
            </div>
        </section>
    </div>
</body>
</html>
