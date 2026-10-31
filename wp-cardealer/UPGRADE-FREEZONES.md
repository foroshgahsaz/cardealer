# بعد از آپدیت zip رسمی Apus

Apus کل پوشه `wp-cardealer` را جایگزین می‌کند. این پروژه به **چند خط bridge** برای افزونه Freezones نیاز دارد. اگر بعد از آپدیت سایت خطای «class not found» یا قیمت/Navasan خاموش شد، diff زیر را دوباره اعمال کنید (یا از نسخهٔ commit‌شده در همین repo کپی کنید).

## 1. `wp-cardealer.php`

- بلافاصله بعد از `ABSPATH`: بارگذاری `../wp-cardealer-freezones/includes/require-proxy.php` و fallback تابع `wp_cardealer_freezones_require`.
- بعد از polylang: `do_action( 'wp_cardealer_after_core_3rdparty' );`
- بعد از بلوک taxonomies: `do_action( 'wp_cardealer_after_listing_taxonomies', $fields );`
- قبل از class-price: `do_action( 'wp_cardealer_before_price_includes' );` و `wp_cardealer_freezones_require( 'includes/class-price.php' );` به‌جای require مستقیم price
- برای فایل‌های override شده: `wp_cardealer_freezones_require( '…' );` — لیست دقیق در commit مخزن
- انتهای `includes()`: `do_action( 'wp_cardealer_includes_loaded' );`
- انتهای `libraries()`: `do_action( 'wp_cardealer_libraries_loaded' );`

## 2. `includes/sms/class-sms.php`

- بارگذاری OTP handler:

```php
wp_cardealer_freezones_require( 'includes/sms/class-otp-handler.php' );
```

## 3. بررسی

- هر دو افزونه فعال
- یک آگهی و فیلتر قیمت در staging

نسخهٔ مرجع bridge: همان `wp-cardealer.php` داخل این مخزن روی branch اصلی.
