# Teste Promobit

## Descrição
Entrega do teste para a vaga Backend Júnior

## Setup
Como realizar o setup do projeto.

Iniciar o docker:

```bash
docker compose up -d
```

Executar o bash:

```bash
docker compose exec app bash
```

Instalar os pacotes

```bash
composer install
```

```bash
npm install
```

Gerar assets:

```bash
npm run prod
```

Executar migrations:

```bash
php artisan module:migrate
```

Executar os seeds:

```bash
php artisan module:seed
```

### Login : admin@admin.com
### Password : 123456

## SQL Relevance Report

```sql
SELECT
        tag_id,
        name,
        products_count
    FROM
        (
        SELECT
            tag_id,
            COUNT(product_id) AS products_count
        FROM
            `product_tag`
        GROUP BY
            tag_id
    ) AS temp
    RIGHT JOIN tag ON tag_id = id
```
