#!/bin/bash
set -e

echo "Running init.sh script..."

# 環境変数が設定されていることを確認
if [ -z "$MYSQL_DATABASE" ] || [ -z "$MYSQL_USER" ] || [ -z "$MYSQL_PASSWORD" ]; then
    echo "Environment variables MYSQL_DATABASE, MYSQL_USER, and MYSQL_PASSWORD must be set"
    exit 1
fi

echo "MYSQL_DATABASE: $MYSQL_DATABASE"
echo "MYSQL_USER: $MYSQL_USER"
echo "MYSQL_PASSWORD: $MYSQL_PASSWORD"

cat <<EOF > /docker-entrypoint-initdb.d/init.sql
CREATE DATABASE IF NOT EXISTS \`${MYSQL_DATABASE}\`;

GRANT ALL PRIVILEGES ON \`${MYSQL_DATABASE}\`.* TO '${MYSQL_USER}'@'%' IDENTIFIED BY '${MYSQL_PASSWORD}';
GRANT ALL PRIVILEGES ON \`${MYSQL_DATABASE}\`.* TO '${MYSQL_USER}'@'localhost' IDENTIFIED BY '${MYSQL_PASSWORD}';

FLUSH PRIVILEGES;
EOF

# デバッグのために生成されたファイルの内容を表示
cat /docker-entrypoint-initdb.d/init.sql

echo "init.sh script completed."
