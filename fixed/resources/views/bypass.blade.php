<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>CVE-2025-27515</title>
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
        .form-field { margin-top: 10px; }
        .form-field label { display: block; margin-bottom: 6px; font-weight: 600; }
        .form-field input[type="text"],
        .form-field input[type="file"] { width: 100%; padding: 8px 10px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 14px; box-sizing: border-box; }
        .form-actions { margin-top: 12px; }
        .btn { border: 0; border-radius: 6px; padding: 8px 14px; font-size: 14px; cursor: pointer; color: #fff; background: #0d6efd; text-decoration: none; display: inline-block; }
        .download-actions { margin-top: 10px; }
    </style>
</head>
<body>
    <div class="page">
        <header>
            <h1 style="line-height: 1.3;">
                <div><span class="fixed-label">修正版（Laravel 12.1.1）</span></div>
                <div>CVE-2025-27515</div>
            </h1>
            <p class="desc">
                修正版では <code>files.*</code> のプレースホルダ処理が修正され、
                <code>.</code> キーでも <code>File</code> ルールが適用されることを確認する。
            </p>
        </header>

        <section class="section">
            <h2>ポイント</h2>
            <ul>
                <li>検証ルール: <code>files.*</code> + <code>File::types(['image/png'])</code></li>
                <li>キーが <code>.</code> でもバリデーションが有効。</li>
                <li>PNGのみ許可のため、ダミーJPGは <code>passes: false</code> でブロックされる。</li>
            </ul>
            <div class="notice">
                <code>passes: false</code> が返れば防御成功。
            </div>
        </section>

        <section class="section">
            <h2>手順</h2>
            <ol>
                <li>ダミーJPGを取得する。</li>
                <li>キーを <code>.</code> のままにしてファイルを選択。</li>
                <li>送信して <code>passes</code> の結果を確認する。</li>
            </ol>
            <div class="download-actions">
                <button class="btn btn-download" type="button">ダミーJPGを取得</button>
            </div>
        </section>

        <section class="section">
            <h2>判定</h2>
            <p><strong>防御成功（期待される挙動）</strong></p>
            <ul>
                <li>レスポンスに <code>passes: false</code> が返る。</li>
                <li>バリデーションエラーが表示される。</li>
            </ul>

            <p><strong>防御失敗（想定外）</strong></p>
            <ul>
                <li>レスポンスに <code>passes: true</code> が返る。</li>
                <li>ダミーJPGが許可されてしまう。</li>
            </ul>

            <div class="danger">
                もし <code>passes: true</code> が返る場合は修正が効いていない可能性がある。
            </div>
        </section>

        <section class="section">
            <h2>検証フォーム</h2>
            <form id="bypass-form" action="/bypass" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-field">
                    <label for="key-input">キー（例: . や 0）</label>
                    <input id="key-input" type="text" value=".">
                </div>

                <div class="form-field">
                    <label for="file-input">ファイル（ダミーJPGを選択）</label>
                    <input id="file-input" type="file" name="files[.]">
                </div>

                <div class="form-actions">
                    <button class="btn" type="submit">送信</button>
                </div>
            </form>
        </section>
    </div>

    <script>
        const keyInput = document.getElementById('key-input');
        const fileInput = document.getElementById('file-input');
        function updateName() {
            const key = keyInput.value || '';
            fileInput.name = `files[${key}]`;
        }
        keyInput.addEventListener('input', updateName);
        updateName();

        const downloadButton = document.querySelector('.btn-download');
        if (downloadButton) {
            downloadButton.addEventListener('click', () => {
                const link = document.createElement('a');
                link.href = '/bypass/sample';
                link.download = 'text_as_jpg.jpg';
                document.body.appendChild(link);
                link.click();
                link.remove();
            });
        }
    </script>
</body>
</html>
