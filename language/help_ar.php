<?php
//
// advanced_extras, its guide on the help page of the control panel
// Arabic
//
// The guide is built by the admin_help_guides hook in init.php, the texts here can have HTML.
// The keys are the ones of help_en.php, a key that is missing here is shown in English.
//  - names in <strong> are written as the control panel shows them: the words of Kleeja are in lang/ar/,
//    the words of the plugin in advanced_extras_translations() of init.php
//

return [
    'ADVANCED_EXTRAS_HELP_TITLE' => 'هيدر وفوتر إضافي متقدم',
    'ADVANCED_EXTRAS_HELP_INTRO' =>
        'اجعل لكل صفحة من صفحات موقعك هيدرًا وفوترًا إضافيين خاصين بها، إلى جانب ما يظهر في جميع الصفحات. تقسم الإضافة صفحة <strong>هيدر وفوتر إضافي</strong> إلى مربع لكل صفحة.',

    //
    // what the plugin does
    //
    'ADVANCED_EXTRAS_HELP_FEATURE_1' =>
        'في تبويبي <strong>هيدر إضافي</strong> و<strong>فوتر إضافي</strong> من صفحة <strong>هيدر وفوتر إضافي</strong> مربع لكل صفحة من صفحات موقعك.',
    'ADVANCED_EXTRAS_HELP_FEATURE_2' =>
        'الكود الذي في <strong>يظهر في: جميع الصفحات</strong> يظهر في كل الصفحات، كما يظهر الهيدر والفوتر الإضافي في كليجا من دون الإضافة.',
    'ADVANCED_EXTRAS_HELP_FEATURE_3' =>
        'كود الصفحة، مثل <strong>يظهر في: تحميل</strong>، يظهر في تلك الصفحة وحدها، بعد كود جميع الصفحات.',
    'ADVANCED_EXTRAS_HELP_FEATURE_4' =>
        'يبقى الهيدر والفوتر الإضافي اللذان كتبتهما قبل تثبيت الإضافة، في مربع جميع الصفحات.',

    //
    // how to use it
    //
    'ADVANCED_EXTRAS_HELP_STEP_TITLE' => 'أضف كودًا إلى صفحة واحدة',
    'ADVANCED_EXTRAS_HELP_STEP_1' =>
        'افتح <strong>هيدر وفوتر إضافي</strong>، ثم تبويب <strong>هيدر إضافي</strong> أو <strong>فوتر إضافي</strong>.',
    'ADVANCED_EXTRAS_HELP_STEP_2' => 'افتح مربع الصفحة، مثل <strong>يظهر في: تحميل</strong>، والصق فيه كود HTML.',
    'ADVANCED_EXTRAS_HELP_STEP_3' =>
        'اضغط <strong>تحديث الإضافات القوالبية</strong>. يُحفظ كل تبويب وحده، فاحفظ قبل أن تفتح التبويب الآخر.',
    'ADVANCED_EXTRAS_HELP_STEP_4' => 'افتح تلك الصفحة من موقعك وتأكد من النتيجة.',

    //
    // common questions
    //
    'ADVANCED_EXTRAS_HELP_FAQ_Q_1' => 'ما الصفحات التي يمكن أن يكون لها كود خاص بها؟',
    'ADVANCED_EXTRAS_HELP_FAQ_A_1' =>
        'الرئيسية، وتحميل، وشروط الخدمة، والملفات المسموحة، وإحصائيات المركز، وإبلاغ عن محتوى، واتصل بنا، وتعديل البيانات، ومجلدك الشخصي، ودخول، وتسجيل عضوية. أما بقية الصفحات، مثل الصفحات التي تضيفها الإضافات، فيظهر فيها كود جميع الصفحات فقط.',
    'ADVANCED_EXTRAS_HELP_FAQ_Q_2' => 'أين يظهر كود صفحة التحميل؟',
    'ADVANCED_EXTRAS_HELP_FAQ_A_2' => 'في صفحة تحميل كل ملف، وهي الصفحة التي يفتحها الزائر من رابط الملف.',
    'ADVANCED_EXTRAS_HELP_FAQ_Q_3' => 'لماذا لا يظهر الكود في إحدى الصفحات؟',
    'ADVANCED_EXTRAS_HELP_FAQ_A_3' =>
        'تأكد أنك ضغطت <strong>تحديث الإضافات القوالبية</strong> في التبويب الذي يحويه، وأن الإضافة مفعّلة. والستايل الذي لا يعرض الهيدر والفوتر الإضافي في كليجا لا يعرض هذا الكود أيضًا.',
    'ADVANCED_EXTRAS_HELP_FAQ_Q_4' => 'هل تغيّر الإضافة الستايل؟',
    'ADVANCED_EXTRAS_HELP_FAQ_A_4' =>
        'لا. يُحفظ الكود مع الهيدر والفوتر الإضافي في كليجا، فيبقى عند تحديث الستايل أو تغييره.',

    //
    // beside the guide
    //
    'ADVANCED_EXTRAS_HELP_TIP_1' =>
        'ضع الكود الذي تحتاجه كل الصفحات، مثل كود الإحصائيات، في مربع جميع الصفحات وحده. فإن وضعته في مربع صفحة أيضًا عمل مرتين في تلك الصفحة.',
    'ADVANCED_EXTRAS_HELP_TIP_2' => 'المربع الفارغ لا يضيف شيئًا إلى صفحته، ولا يُحفظ.',
    'ADVANCED_EXTRAS_HELP_TIP_3' => 'تنطبق نصائح دليل <a href="#help-extra">هيدر وفوتر إضافي</a> على كل المربعات.',

    'ADVANCED_EXTRAS_HELP_WARNING_1' =>
        'ما دامت الإضافة معطّلة، تعرض كل الصفحات كود جميع المربعات، مع الأسطر التي تفصل بينها. فعّلها من جديد، أو احذفها.',
    'ADVANCED_EXTRAS_HELP_WARNING_2' =>
        'حذف الإضافة يفرغ الهيدر والفوتر الإضافي، ومعهما مربع جميع الصفحات. انسخ الكود الذي تريد الاحتفاظ به أولًا.',

    //
    // in the guide of Extra Templates, the page that the plugin changes
    //
    'ADVANCED_EXTRAS_HELP_NOTE' =>
        'تجعل إضافة <strong>هيدر وفوتر إضافي متقدم</strong> في هذه الصفحة مربعًا لكل صفحة من صفحات موقعك. <a href="#help-advanced_extras">اقرأ دليلها</a>.',
];
