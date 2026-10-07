<?php
//
// advanced_extras, its guide on the help page of the control panel
// English
//
// The guide is built by the admin_help_guides hook in init.php, the texts here can have HTML.
//  - a list is numbered: ADVANCED_EXTRAS_HELP_TIP_1, ADVANCED_EXTRAS_HELP_TIP_2 ... it ends at the first missing number,
//    so an item can be added or removed without touching the code
//  - ADVANCED_EXTRAS_HELP_{LIST}_TITLE is the title of the list, a list without it takes the title that Kleeja gives its type
//  - questions and answers are ADVANCED_EXTRAS_HELP_FAQ_Q_1 and ADVANCED_EXTRAS_HELP_FAQ_A_1
//  - names in <strong> are written as the control panel shows them: the words of Kleeja are in lang/en/,
//    the words of the plugin in advanced_extras_translations() of init.php
//

return [
    'ADVANCED_EXTRAS_HELP_TITLE' => 'Advanced Extras',
    'ADVANCED_EXTRAS_HELP_INTRO' =>
        'Give each page of your site its own extra header and footer, besides the ones shown on all pages. The plugin splits the <strong>Extra Templates</strong> page into a box for each page.',

    //
    // what the plugin does
    //
    'ADVANCED_EXTRAS_HELP_FEATURE_1' =>
        'The <strong>Extra Header</strong> and <strong>Extra footer</strong> tabs of <strong>Extra Templates</strong> have a box for each page of your site.',
    'ADVANCED_EXTRAS_HELP_FEATURE_2' =>
        'The code in <strong>Shown on: All pages</strong> is shown on every page, like the extra header and footer of Kleeja without the plugin.',
    'ADVANCED_EXTRAS_HELP_FEATURE_3' =>
        'The code of a page, like <strong>Shown on: Download</strong>, is shown on that page only, after the code of all pages.',
    'ADVANCED_EXTRAS_HELP_FEATURE_4' =>
        'The extra header and footer that you wrote before installing the plugin are kept, in the box of all pages.',

    //
    // how to use it
    //
    'ADVANCED_EXTRAS_HELP_STEP_TITLE' => 'Add code to one page',
    'ADVANCED_EXTRAS_HELP_STEP_1' =>
        'Open <strong>Extra Templates</strong>, then the <strong>Extra Header</strong> or the <strong>Extra footer</strong> tab.',
    'ADVANCED_EXTRAS_HELP_STEP_2' =>
        'Open the box of the page, for example <strong>Shown on: Download</strong>, and paste your HTML code in it.',
    'ADVANCED_EXTRAS_HELP_STEP_3' =>
        'Click <strong>Update template</strong>. Each tab is saved on its own, so save before you open the other one.',
    'ADVANCED_EXTRAS_HELP_STEP_4' => 'Open that page of your site and check the result.',

    //
    // common questions
    //
    'ADVANCED_EXTRAS_HELP_FAQ_Q_1' => 'Which pages can have their own code?',
    'ADVANCED_EXTRAS_HELP_FAQ_A_1' =>
        'Homepage, Download, Terms, Allowed Extensions, Statistics, Report, Contact Us, Profile, Your folder, Login and Register. The other pages, like the pages that plugins add, show the code of all pages only.',
    'ADVANCED_EXTRAS_HELP_FAQ_Q_2' => 'Where is the code of the download page shown?',
    'ADVANCED_EXTRAS_HELP_FAQ_A_2' =>
        'On the download page of every file, the page that visitors open from the link of a file.',
    'ADVANCED_EXTRAS_HELP_FAQ_Q_3' => 'Why doesn\'t my code show on a page?',
    'ADVANCED_EXTRAS_HELP_FAQ_A_3' =>
        'Check that you clicked <strong>Update template</strong> on the tab that holds it, and that the plugin is enabled. A style that doesn\'t show the extra header and footer of Kleeja doesn\'t show this code either.',
    'ADVANCED_EXTRAS_HELP_FAQ_Q_4' => 'Does it change my style?',
    'ADVANCED_EXTRAS_HELP_FAQ_A_4' =>
        'No. The code is saved with the extra header and footer of Kleeja, so it stays when you update or change the style.',

    //
    // beside the guide
    //
    'ADVANCED_EXTRAS_HELP_TIP_1' =>
        'Put the code that every page needs, like an analytics script, in the box of all pages only. In the box of a page too, it would run twice on that page.',
    'ADVANCED_EXTRAS_HELP_TIP_2' => 'An empty box adds nothing to its page, and it isn\'t saved.',
    'ADVANCED_EXTRAS_HELP_TIP_3' =>
        'The advice of the <a href="#help-extra">Extra Templates</a> guide applies to every box.',

    'ADVANCED_EXTRAS_HELP_WARNING_1' =>
        'While the plugin is disabled, every page shows the code of all the boxes, with the lines that separate them. Enable it again, or delete it.',
    'ADVANCED_EXTRAS_HELP_WARNING_2' =>
        'Deleting the plugin empties the extra header and footer, the box of all pages too. Copy the code that you want to keep first.',

    //
    // in the guide of Extra Templates, the page that the plugin changes
    //
    'ADVANCED_EXTRAS_HELP_NOTE' =>
        'The <strong>Advanced Extras</strong> plugin gives this page a box for each page of your site. <a href="#help-advanced_extras">Read its guide</a>.',
];
