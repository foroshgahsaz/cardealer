# WP CarDealer (سفارشی freezonescar)

نسخهٔ به‌روز افزونهٔ WP CarDealer با تمام تغییرات سفارشی پروژه (مخزن قبلی `deal`)، از PR #1 تا #18:

- تبدیل قیمت دلار → تومان (BrsApi / Navasan)
- هزینه واردات (دلار)، هزینه کل، تگ‌های Elementor
- تاکسونومی موقعیت و لینک آرشیو
- رنگ‌شدگی بدنه (SVG)
- بهینه‌سازی سرعت صفحهٔ اول (اسلایدر قیمت، سقف فیلتر، بدون cron/API در فرانت)
- سنجش سرعت از ادمین

## نصب

محتوای این مخزن را در `wp-content/plugins/wp-cardealer/` کپی کنید (شامل `wp-cardealer.php`، `templates/`، `includes/`، …).

بعد از نصب: **تنظیمات → پیوندهای یکتا → ذخیره** و کش سایت را پاک کنید.

مارکر دیپلوی در سورس: `wpcd-navasan-20261011-import-fee`

## تست

```bash
php tests/test-listing-fees.php
php tests/test-navasan.php
```

## منبع تغییرات

این شاخه از `main` مخزن [foroshgahsaz/deal](https://github.com/foroshgahsaz/deal) (تا merge PR #18) روی پایهٔ [foroshgahsaz/cardealer](https://github.com/foroshgahsaz/cardealer) اعمال شده است. فایل‌هایی که فقط در `cardealer` به‌روز بودند (مثلاً `includes/class-user-meta.php`) دست‌نخورده مانده‌اند.
