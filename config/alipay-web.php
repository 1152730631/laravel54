<?php
/**
 * Created by PhpStorm.
 * User: luojinyi
 * Date: 2017/6/26
 * Time: 下午5:21
 */

return [
    //应用ID,您的APPID。
    'app_id' => "2016080600182323",

    //商户私钥 不能用pkcs8.pem中的密钥！！！！！
    'merchant_private_key' => "MIIEogIBAAKCAQEAsoPn8hFYvWMjOddxVAmoHRuEn+XUVXH8cz6vX6t52yjSp/5QNRGh/hwgkV9QfMWcnifzbVWg7ay2oGpGDp6l8yk3DBqg8f1/cVrqHCTYeR0KVICx20IJVz0N+KycMP2D2+zXKEzuMFzQDFt/TU1ztxt+MiwqSKtaIOR+mlZlHBZ21q39jacfu/jqJx4PIKg/AZUJlsIJoSYnUbRuNyIxO9sAOIa/UPYOXO3uzDkxE1NpPe+eHUlUgaV8LoeqcRecNTjU3aFqN7yVDumoWwBij2Ie/MiWGZGHUXedHeRTtW1ZFCNeeaJhbG4Vteb+wuQqktCvA1Jc2ulKOgGZ8JzcjQIDAQABAoIBACCPstUSmO8ikCBSzdcYU9PLWyuXTl2vhu62dmKq8nUpQxNlbdfgOX4SP1aE3jeEDAdFHj/JKKtxn3YvLEwqX/a0g9fvW4AITyCsBpvPlLSyuVmkh8yIhQ+mkU/UnEDLXSvWTYCKV7/2jfRTFCtTf1Hc7+3S5HuQ1cW+J+Ga9KJkoHqewSvkF5s682nzg1bbsFov8vURLoB4OtQZEceGhkquTzUmRU+NQ7UV6G1rTUz8Q9+1zr5egosnyg5ohhXk4+/1ygHj8Bt1inrHy1cu8EbHcNFHJAEx92Xv//tcv28ji/r+/SVWU+6WmzzJhvWTdlNSptZPiTh+iGolMzchYIECgYEA4a8nVzCffdHrcUBD/NtZssmNTWLxZPirjH7uBu8zdivk+KUt3hZ91a9xKmZ42Opo3U+OxlP5SpRN6fliznisgm4EYFgn2CHxBrfoipGqW4Olr5X7lp8bdjXOiPzlIYwTCwn1n8CYdw4tHfQTkaGm2MhE/ukCjs0AE14QzPkxS/ECgYEAyn60Ax8GyWBA++bq60llhaAlQ5GniOlELoo4w7J9O51gKrVdtbdPKZf+mREqjKoPfcEy1TZ2LngQZzOBBUsPnht1hBNq4TTl2wANRxjo5/TpzTqDutA1jQUPBI1X4a9OgJyCzdXKHPmBC+aO8fevQG2J+KM75gn50C3XamfWpl0CgYASw6ZouHE6W97QjsBYYMCHffySp5xcgdR5nQAbcX384E9sYQd8RLB3uNuW4+g+WNcZN4kuckLy8Xu87XBKrHvjaFRS0mGVtdS9c0MRamUYsMxw2e6OKnJ1FKo0d5pxfJ0EuPJEMxY6J+KWb/nEjQU7VwNtkmAVEXRlJ9gLwthXcQKBgHvtkWP7oB6snvjL+WgoUk62lTfGM79x672D8HusiEJs7YcV2pU06+jr0fCB9gWCqtpu3BprK2cDKh7PAZ5ostUzvvcnHxlXU3l1jaq+jwQu+swUjLxPYwa8WtWRX4CK1sOVheRNfFXBSX4sC74AtSv8Hh2iYS1HW7FR7O19QXwtAoGAVyiBIhXHcxWAVjN7oFxnoV2uT9EqsHUZ13plMid65SQh0djM4MSue0VZPbbJAyxGC7REZJAcTrC7+SsultH6dIiuc1Z9efjjIt1yzUMGWGvjCzBPTt+p0qugLVJJvhh/KnWeq0u8QUvwo8fPtXDToqwRyc4oC6ryXeWcyLX6mH0=",

    //异步通知地址 post
    'notify_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",

    //同步跳转 get 支付完成后跳转回的地址
    'return_url' => "http://127.0.0.1:8888/",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type' => "RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAsoPn8hFYvWMjOddxVAmoHRuEn+XUVXH8cz6vX6t52yjSp/5QNRGh/hwgkV9QfMWcnifzbVWg7ay2oGpGDp6l8yk3DBqg8f1/cVrqHCTYeR0KVICx20IJVz0N+KycMP2D2+zXKEzuMFzQDFt/TU1ztxt+MiwqSKtaIOR+mlZlHBZ21q39jacfu/jqJx4PIKg/AZUJlsIJoSYnUbRuNyIxO9sAOIa/UPYOXO3uzDkxE1NpPe+eHUlUgaV8LoeqcRecNTjU3aFqN7yVDumoWwBij2Ie/MiWGZGHUXedHeRTtW1ZFCNeeaJhbG4Vteb+wuQqktCvA1Jc2ulKOgGZ8JzcjQIDAQAB",

    //支付时提交方式 true 为表单提交方式成功后跳转到return_url,
    //false 时为Curl方式 返回支付宝支付页面址址 自己跳转上去 支付成功不会跳转到return_url上， 我也不知道为什么，有人发现可以跳转请告诉 我一下 谢谢
    // email: 40281612@qq.com
    'trade_pay_type' => true,
];