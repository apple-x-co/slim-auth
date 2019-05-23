# slim-application

basic slim application

```bash
composer install
cp -ap config/.env.prod config/.env
```

local site

`http://localhost/`

導入にあたっての検討

* 認証に関する部分は自前で用意するしかない。クッキークラスのドキュメントがなかったり、セッション管理がなかったりで、あまり積極的でにあ可能性があるため、向いていない？