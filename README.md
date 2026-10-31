# WP CarDealer + Freezones (freezonescar)

این مخزن **دو افزونه** دارد:

| پوشه | نقش |
|------|-----|
| [`wp-cardealer/`](wp-cardealer/) | هستهٔ رسمی **Apus 1.2.20** — از updater خودش به‌روز می‌شود |
| [`wp-cardealer-freezones/`](wp-cardealer-freezones/) | سفارشی‌های پروژه (Navasan، هزینه واردات، بدنه، موقعیت، Elementor، …) |

## نصب در وردپرس

هر دو پوشه را در `wp-content/plugins/` کپی کنید:

- `wp-content/plugins/wp-cardealer/`
- `wp-content/plugins/wp-cardealer-freezones/`

**هر دو** را فعال کنید (Freezones به WP CarDealer وابسته است).

بعد از نصب یا آپدیت هسته: **تنظیمات → پیوندهای یکتا → ذخیره** و کش را پاک کنید.

## به‌روزرسانی هسته (Apus)

1. نسخهٔ جدید را از پنل وردپرس یا zip رسمی نصب کنید (فقط پوشه `wp-cardealer`).
2. فایل [`wp-cardealer/UPGRADE-FREEZONES.md`](wp-cardealer/UPGRADE-FREEZONES.md) را بخوانید — چند خط کوچک در `wp-cardealer.php` و `includes/sms/class-sms.php` باید بعد از آپدیت دوباره اعمال شوند.
3. افزونه **Freezones** را لمس نکنید مگر در changelog breaking باشد.

## تست (افزونه Freezones)

```bash
cd wp-cardealer-freezones
php tests/test-navasan.php
php tests/test-listing-fees.php
```

## معماری

Freezones فایل‌های override را از مسیر خودش لود می‌کند (`wp_cardealer_freezones_require`). دادهٔ سایت (meta، option، cron) همان کلیدهای قبلی است؛ migration دیتابیس لازم نیست.
