# はじめに

[bokumin.org](https://bokumin.org) で使っている自分用のWordPressテーマです。

## 前提条件
このテーマは、WordPressを `ドメイン名/blog` のようなサブディレクトリで運用し、
サイト全体の共通パーツ(ヘッダーやCSSなど)をドメイン直下に置く構成を前提にしています。
そのため、テーマ単体では動作せず、以下のファイルをドメインのドキュメントルート側に
別途用意する必要があります。

### 1. `/header.php`

`$_SERVER['DOCUMENT_ROOT'] . '/header.php'` という形で読み込んでいる、
サイト共通のヘッダー(グローバルナビなど)です。ドメイン直下に配置してください。

```php
<?php $currentPage = 'blog'; include $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>
```

`$currentPage` の値でどのページを表示中かを共通ヘッダー側に伝えているので、
共通ヘッダー側でこの変数を使ってナビの出し分けなどをしている想定です。

### 2. `/css/tailwind.min.css`

テーマ側では `wp_enqueue_style` でこのパスのCSSを読み込んでいるだけで、
ビルド済みのTailwind CSS自体はテーマに含まれていません。
ドメイン直下の `/css/tailwind.min.css` に配置してください。

```php
wp_enqueue_style('tailwindcss', '/css/tailwind.min.css', array(), '1.0');
```

## その他

- 各テンプレート(`404.php` / `category.php` / `search.php` / `single.php` / `tag.php` など)はTailwind CSSのクラスを直接HTMLに書くスタイルになっています。
- `functions.php` にて、REST APIの `/wp/v2/users` エンドポイントを未ログイン時に制限しているなど、簡易的なセキュリティ対応も含まれています。
- 画像アップロード時にJPEG品質を落としたり、PNGを再圧縮したりする処理も入っています。

自分用テーマのため、汎用性やドキュメント整備は最低限です。
利用する場合は上記の前提ファイルを各自の環境に合わせて用意してください。

デザインなどは以下を参考にしてください  
[bokumin.org](https://bokumin.org)  
