FROM php:8.2-cli

# 必要最低限の PHP 拡張（Laravelが標準で使うPDO系）
RUN apt-get update \
 && apt-get install -y --no-install-recommends libpq-dev libzip-dev libsqlite3-dev unzip git \
 && docker-php-ext-install pdo_mysql pdo_pgsql pdo_sqlite \
 && rm -rf /var/lib/apt/lists/*

WORKDIR /app

# vendor はホストからマウントする想定のためコピーしない
CMD ["php", "-v"]
