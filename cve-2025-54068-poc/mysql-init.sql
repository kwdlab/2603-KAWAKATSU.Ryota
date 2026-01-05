CREATE DATABASE IF NOT EXISTS wasbook CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE wasbook;

SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
    id   VARCHAR(191) PRIMARY KEY,
    pwd  VARCHAR(255),
    mail VARCHAR(255),
    name VARCHAR(255),
    addr VARCHAR(255),
    tel  VARCHAR(255)
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

INSERT INTO users (id, pwd, mail, name, addr, tel) VALUES
('yamada', 'pass1', 'yamada@example.jp', '山田太郎', '神奈川県川崎市', '046-123-4567'),
('sato',   'password', 'sato@example.net', '佐藤花子', '神奈川県横浜市', '045-123-4567'),
('tanaka', 'pass2', 'tanaka@example.com', '田中次郎', '東京都町田市', '044-123-4567');
