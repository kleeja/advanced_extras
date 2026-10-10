<?php
// Kleeja Plugin
// advanced_extras
// Version: 1.1
// Developer: Kleeja team

// Prevent illegal run
if (!defined('IN_PLUGINS_SYSTEM')) {
    exit();
}

// Plugin Basic Information
$kleeja_plugin['advanced_extras']['information'] = [
    // The casual name of this plugin, anything can a human being understands
    'plugin_title' => [
        'en' => 'Advanced Extras',
        'ar' => 'هيدر وفوتر إضافي متقدم',
    ],
    // Who wrote this plugin?
    'plugin_developer' => 'Kleeja.net',
    // This plugin version
    'plugin_version' => '1.1',
    // Explain what is this plugin, why should I use it?
    'plugin_description' => [
        'en' => 'An extra header and footer for each page of the site, besides the ones shown on all pages',
        'ar' => 'هيدر وفوتر إضافيان لكل صفحة من صفحات الموقع، إلى جانب ما يظهر في جميع الصفحات',
    ],
    //settings page, if there is one (what after ? like cp=j_plugins)
    'settings_page' => 'cp=n_extra',
    // Min version of Kleeja that's requiered to run this plugin
    'plugin_kleeja_version_min' => '4.0.0',
    // Max version of Kleeja that support this plugin, use 0 for unlimited
    'plugin_kleeja_version_max' => '4.9',
    // Should this plugin run before others?, 0 is normal, and higher number has high priority
    'plugin_priority' => 0,
];

//after installation message, you can remove it, it's not requiered
$kleeja_plugin['advanced_extras']['first_run']['ar'] = "
أضاف هذا البرنامج المساعد إلى صفحة «هيدر وفوتر إضافي» مربعًا لكل صفحة من صفحات الموقع،
فيصبح لكل صفحة هيدر وفوتر إضافيان خاصان بها، يظهران بعد ما يظهر في جميع الصفحات.
<br>
<a href='./index.php?cp=n_extra'>هيدر وفوتر إضافي</a> -
<a href='https://github.com/kleeja/advanced-extras/issues' target='_blank' rel='noopener'>الإبلاغ عن مشكلة</a>
";

$kleeja_plugin['advanced_extras']['first_run']['en'] = "
This plugin added a box for each page of the site to the Extra Templates page,
so every page can have its own extra header and footer, shown after the ones of all pages.
<br>
<a href='./index.php?cp=n_extra'>Extra Templates</a> -
<a href='https://github.com/kleeja/advanced-extras/issues' target='_blank' rel='noopener'>Report a problem</a>
";

// Plugin Installation function
$kleeja_plugin['advanced_extras']['install'] = function ($plg_id) {
    foreach (advanced_extras_translations() as $lang_id => $words) {
        add_olang($words, $lang_id, $plg_id);
    }
};

// the words are written again, so a new version brings its new words (1.1 rewrote all of them),
// with queries of its own: add_olang(), delete_olang() and delete_cache() run hooks, and the plugins are still loading
$kleeja_plugin['advanced_extras']['update'] = function ($old_version, $new_version) {
    global $SQL, $dbprefix;

    $result = $SQL->build([
        'SELECT' => 'plg_id',
        'FROM' => "{$dbprefix}plugins",
        'WHERE' => 'plg_name = :name',
        'BIND' => ['name' => 'advanced_extras'],
    ]);

    $row = $SQL->fetch_array($result);
    $plg_id = (int) ($row['plg_id'] ?? 0);
    $SQL->freeresult($result);

    //a plg_id of 0 would delete the words of the core and of every plugin
    if ($plg_id > 0) {
        $SQL->build([
            'DELETE' => "{$dbprefix}lang",
            'WHERE' => 'plg_id = :plg_id',
            'BIND' => ['plg_id' => $plg_id],
        ]);

        foreach (advanced_extras_translations() as $lang_id => $words) {
            foreach ($words as $word => $trans) {
                $SQL->build([
                    'INSERT' => 'word, trans, lang_id, plg_id',
                    'INTO' => "{$dbprefix}lang",
                    'VALUES' => ':word, :trans, :lang_id, :plg_id',
                    'BIND' => ['word' => $word, 'trans' => $trans, 'lang_id' => $lang_id, 'plg_id' => $plg_id],
                ]);
            }
        }
    }

    // the cached words, and the compiled page of the control panel, which is a Bootstrap 5 one since 1.1;
    // an update doesn't delete the compiled templates, the page is compiled again when it is opened
    $cached = array_merge(
        glob(PATH . 'cache/data_lang*.php') ?: [],
        glob(PATH . 'cache/tpl_admin_adv_extras*.php') ?: [],
    );

    foreach ($cached as $file) {
        @unlink($file);
    }
};

// Plugin Uninstallation, function to be called at unistalling
$kleeja_plugin['advanced_extras']['uninstall'] = function ($plg_id) {
    //a plg_id of 0 would delete the words of the core and of every plugin
    if ((int) $plg_id > 0) {
        foreach (array_keys(advanced_extras_translations()) as $lang_id) {
            delete_olang(null, $lang_id, (int) $plg_id);
        }
    }

    global $SQL, $dbprefix;
    $update_query = [
        'UPDATE' => "{$dbprefix}stats",
        'SET' => "ex_footer = '' , ex_header = '' ",
    ];

    $SQL->build($update_query);

    if ($SQL->affected()) {
        //delete cache ..
        delete_cache('data_extra');
    }
};

// Plugin functions
$kleeja_plugin['advanced_extras']['functions'] = [
    // the page of the extras in the control panel shows a box for every page instead of one for all of them
    'end_admin_page' => function ($args) {
        if ($args['go_to'] !== 'n_extra') {
            return;
        }

        global $lang;

        //the words of the plugin, in English for a language that has no translation of them
        $olang = (array) ($args['olang'] ?? []) + advanced_extras_translations()['en'];

        $current = $args['current_smt'] === 'fe' ? 'footer' : 'header';
        $values = advanced_extras_get_values($args['ex_' . $current] ?? '');

        $extra_pages = [];

        foreach (advanced_extras_pages() as $name => $lang_key) {
            $extra_pages[] = [
                'name' => $name,
                'title' => $lang[$lang_key] ?? $olang[$lang_key],
                // the code is shown as it is in the textarea, a </textarea> in it would end it
                'value' => htmlspecialchars($values[$name] ?? '', ENT_QUOTES),
            ];
        }

        $extra_field = 'ex_' . $current . '_x';
        $stylee = 'admin_adv_extras';
        $styleePath = __DIR__;

        return compact('stylee', 'styleePath', 'extra_pages', 'extra_field', 'olang');
    },

    // the boxes of the pages are joined in the field that the core page saves
    'require_admin_page_begin_n_extra' => function ($args) {
        if (!ip('submit')) {
            return;
        }

        foreach (['ex_header', 'ex_footer'] as $field) {
            if (!isset($_POST[$field . '_x']) || !is_array($_POST[$field . '_x'])) {
                continue;
            }

            $_POST[$field] = '';

            foreach (array_keys(advanced_extras_pages()) as $name) {
                $value = $_POST[$field . '_x'][$name] ?? '';

                if (is_string($value) && trim($value) !== '') {
                    $_POST[$field] .=
                        "\n!!! start advanced_extras {$name} !!!\n" .
                        $value .
                        "\n!!! end advanced_extras {$name} !!!\n";
                }
            }
        }
    },

    'Saaheader_links_func' => function ($args) {
        $extras = $args['extras'];
        $extras['header'] = advanced_extras_of_this_page($extras['header']);

        return compact('extras');
    },

    'Saafooter_func' => function ($args) {
        $extras = $args['extras'];
        $extras['footer'] = advanced_extras_of_this_page($extras['footer']);

        return compact('extras');
    },

    // the guide of the plugin on the help page of the control panel, its words are in language/help_{code}.php
    'admin_help_guides' => function ($args) {
        $help_guides = $args['help_guides'];
        $words = advanced_extras_help_words();

        // the name of the plugin is the key, so Kleeja knows that the plugin has its guide, and shows its icon.
        // The help button of Extra Templates opens the guide of Kleeja, the first one of that page,
        // so it has no 'page', and the guide of Kleeja links to it
        $help_guides['advanced_extras'] = [
            'group' => 'plugins',
            'title' => $words['ADVANCED_EXTRAS_HELP_TITLE'],
            'intro' => $words['ADVANCED_EXTRAS_HELP_INTRO'],
            'link' => './?cp=n_extra',
            // tips and warnings are shown beside the others on wide screens
            'sections' => [
                advanced_extras_help_section($words, 'features', 'FEATURE'),
                advanced_extras_help_section($words, 'steps', 'STEP'),
                advanced_extras_help_section($words, 'faq', 'FAQ'),
                advanced_extras_help_section($words, 'tips', 'TIP'),
                advanced_extras_help_section($words, 'warnings', 'WARNING'),
            ],
        ];

        if (isset($help_guides['extra'])) {
            $help_guides['extra']['sections'][] = ['type' => 'text', 'text' => $words['ADVANCED_EXTRAS_HELP_NOTE']];
        }

        return compact('help_guides');
    },
];

/**
 * special functions
 */

if (!function_exists('advanced_extras_get_values')) {
    /**
     * the words of the guide on the help page, in the language of the admin,
     * a word that the translation misses is shown in English
     * @return array
     */
    function advanced_extras_help_words()
    {
        global $config;

        $words = (array) require __DIR__ . '/language/help_en.php';
        $language = preg_replace('/[^a-z0-9_-]/i', '', (string) ($config['language'] ?? ''));
        $translation = __DIR__ . "/language/help_{$language}.php";

        if ($language !== '' && $language !== 'en' && file_exists($translation)) {
            // in its own line, Prettier drops the brackets of (require $translation) + $words
            $translated = require $translation;
            $words = (array) $translated + $words;
        }

        return $words;
    }

    /**
     * a section of the guide from its numbered words, like ADVANCED_EXTRAS_HELP_TIP_1, ADVANCED_EXTRAS_HELP_TIP_2 ..
     * its title, when it has its own, is ADVANCED_EXTRAS_HELP_TIP_TITLE
     * @param  array  $words
     * @param  string $type  how Kleeja shows it: features, steps, tips, warnings or faq
     * @param  string $name  the name of its words, ADVANCED_EXTRAS_HELP_{name}_1
     * @return array
     */
    function advanced_extras_help_section($words, $type, $name)
    {
        $prefix = 'ADVANCED_EXTRAS_HELP_' . $name;
        $section = ['type' => $type, 'title' => $words[$prefix . '_TITLE'] ?? '', 'items' => []];

        for ($n = 1; isset($words[$prefix . ($type === 'faq' ? '_Q_' : '_') . $n]); $n++) {
            $section['items'][] =
                $type === 'faq'
                    ? ['q' => $words[$prefix . '_Q_' . $n], 'a' => $words[$prefix . '_A_' . $n] ?? '']
                    : $words[$prefix . '_' . $n];
        }

        return $section;
    }

    /**
     * the words of the plugin, they are added to the language table when it is installed or updated
     * @return array
     */
    function advanced_extras_translations()
    {
        return [
            'en' => [
                'ADVANCED_EXTRAS_APPEAR_PAGE' => 'Shown on',
                'ADVANCED_EXTRAS_ALL_PAGES' => 'All pages',
                'ADVANCED_EXTRAS_HINT' =>
                    'The code of “All pages” is shown on every page, and the code of a page is added after it on that page only.',
            ],
            'ar' => [
                'ADVANCED_EXTRAS_APPEAR_PAGE' => 'يظهر في',
                'ADVANCED_EXTRAS_ALL_PAGES' => 'جميع الصفحات',
                'ADVANCED_EXTRAS_HINT' =>
                    'يظهر كود «جميع الصفحات» في كل الصفحات، ويُضاف كود كل صفحة بعده في تلك الصفحة وحدها.',
            ],
        ];
    }

    /**
     * the pages that have their own extras, the name marks their part of the saved extras,
     * and the value is the language key of their title, one of the core or one of the plugin
     * @return array
     */
    function advanced_extras_pages()
    {
        return [
            'all' => 'ADVANCED_EXTRAS_ALL_PAGES',
            'index' => 'INDEX',
            'download' => 'DOWNLOAD',
            'rules' => 'RULES',
            'guide' => 'GUIDE',
            'stats' => 'STATS',
            'reports' => 'REPORT',
            'call' => 'CALL',
            'profile' => 'PROFILE',
            'fileuser' => 'YOUR_FILEUSER',
            'login' => 'LOGIN',
            'register' => 'REGISTER',
        ];
    }

    /**
     * the parts of the saved extras, by page
     * @param  string|false $content
     * @return array
     */
    function advanced_extras_get_values($content)
    {
        $content = (string) $content;

        $re = '/!!! start advanced_extras ([a-zA-Z0-9_]+) !!!\n?(.*?)\n?!!! end advanced_extras \1 !!!/sm';

        preg_match_all($re, $content, $matches, PREG_SET_ORDER, 0);

        // extras that were saved by the core page, before this plugin, are for all the pages
        if (empty($matches)) {
            return trim($content) === '' ? [] : ['all' => $content];
        }

        $values = [];

        foreach ($matches as $match) {
            $values[$match[1]] = $match[2];
        }

        return $values;
    }

    /**
     * the extras of the current page: the part of all the pages, then the part of this page
     * @param  string|false $content
     * @return string|false
     */
    function advanced_extras_of_this_page($content)
    {
        if (empty($content)) {
            return $content;
        }

        $values = advanced_extras_get_values($content);

        $page = g('go', 'str', defined('IN_DOWNLOAD') ? 'download' : (defined('IN_REAL_INDEX') ? 'index' : ''));
        // go.php names the report page "report", and "exts" is another name of the guide
        $page = ['report' => 'reports', 'exts' => 'guide'][$page] ?? $page;

        $parts = [$values['all'] ?? ''];

        if ($page !== 'all' && isset($values[$page])) {
            $parts[] = $values[$page];
        }

        return implode(
            '<br>',
            array_filter($parts, function ($part) {
                return trim($part) !== '';
            }),
        );
    }
}
