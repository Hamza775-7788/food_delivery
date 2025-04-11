<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رمز التحقق - {{ config('app.name') }}</title>
</head>

<body style="background-color: #f3f4f6; margin: 0; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; padding: 30px;">
        <!-- Header -->
        {{-- <div style="text-align: center; margin-bottom: 25px;">
            <img src="{{ asset('images/logo.png') }}" alt="الشعار" style="max-height: 60px;">
            <h1 style="font-size: 24px; color: #1f2937; margin-top: 15px;">رمز التحقق الآمن</h1>
        </div> --}}

        <!-- Content -->
        <div style="color: #4b5563; line-height: 1.6;">
            <p style="font-size: 18px;">مرحبًا عميلنا العزيز،</p>

            <div
                style="background-color: #eff6ff; border: 1px solid #93c5fd; border-radius: 6px; padding: 20px; margin: 20px 0;">
                <p style="margin-bottom: 15px;">الرجاء استخدام رمز التحقق التالي:</p>
                <div style="background-color: #ffffff; padding: 15px; border-radius: 4px; text-align: center;">
                    <span style="font-size: 28px; color: #2563eb; letter-spacing: 2px;">{{ $code }}</span>
                </div>
                <p style="font-size: 14px; color: #6b7280; margin-top: 10px;">صالح لمدة 10 دقائق</p>
            </div>

            <!-- Security Alert -->
            <div
                style="background-color: #fef2f2; border: 1px solid #fca5a5; border-radius: 6px; padding: 15px; margin-top: 25px;">
                <div style="display: flex; align-items: start;">
                    <div style="margin-left: 10px;">
                        <h3 style="color: #dc2626; margin: 0;">تنبيه أمان</h3>
                        <p style="color: #ef4444; margin: 5px 0 0 0; font-size: 14px;">
                            لا تشارك هذا الرمز مع أي شخص
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div style="text-align: center; color: #6b7280; font-size: 14px; margin-top: 30px;">
            <p>للتواصل: <a href="mailto:support@example.com" style="color: #3b82f6;">support@example.com</a></p>
            <p style="margin-top: 10px;">&copy; {{ date('Y') }} {{ config('app.name') }}</p>
        </div>
    </div>
</body>

</html>
