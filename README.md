# MyNumber

マイナンバー(個人番号)および法人番号の正当性を検証するためのライブラリです。
桁数・使用文字のチェックと、省令で定められた算式によるチェックデジット(検査用数字)の検証を行います。

[![CI](https://github.com/serima/MyNumber/actions/workflows/ci.yml/badge.svg?branch=master)](https://github.com/serima/MyNumber/actions/workflows/ci.yml)

## Requirements

PHP 8.2 以上

## Installation

```
composer require serima/mynumber
```

## Usage

```php
use Serima\MyNumber\MyNumber;

// 個人番号(12桁・末尾がチェックデジット)
MyNumber::verifyPersonal('123456789018'); // true
MyNumber::verifyPersonal('123456789019'); // false

// 先頭が 0 の場合は文字列で渡してください
MyNumber::verifyPersonal('023456789013'); // true

// 法人番号(13桁・先頭がチェックデジット)
MyNumber::verifyCompany('7000012050002'); // true(国税庁の法人番号)
MyNumber::verifyCompany('7000012050003'); // false
```

## 検証仕様

### 個人番号

11桁の基礎となる番号の**後ろ**に1桁の検査用数字(0〜9)を付した12桁の番号です。
検査用数字は `11 − (Σ Pn × Qn を11で除した余り)`(余りが1以下の場合は0)で算出されます。

- 番号利用法施行令 第8条・[平成26年総務省令第85号 第5条](https://laws.e-gov.go.jp/document?lawid=426M60000008085)

### 法人番号

12桁の基礎番号の**前**に1桁の検査用数字(1〜9)を付した13桁の番号です。
検査用数字は `9 − (Σ Pn × Qn を9で除した余り)` で算出されます。

- 番号利用法施行令 第35条・[法人番号の指定等に関する省令(平成26年財務省令第70号)第2条](https://laws.e-gov.go.jp/document?lawid=426M60000040070)

## License

MIT ライセンスです。

## 免責

利用者が当ライブラリによって被った損害、損失に対して、いかなる場合でも一切の責任を負いません。
