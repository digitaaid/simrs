<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => env('APP_NAME'),
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Admin</b>LTE',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration. Currently, two
    | modes are supported: 'fullscreen' for a fullscreen preloader animation
    | and 'cwrapper' to attach the preloader animation into the content-wrapper
    | element and avoid overlapping it with the sidebars and the top navbar.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => false,
        'mode' => 'cwrapper',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => false,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => 'profil',

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type' => 'navbar-search',
            'text' => 'search',
            'topnav_right' => true,
        ],
        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        [
            'text' => 'blog',
            'url' => 'admin/blog',
            'can' => 'manage-blog',
        ],
        [
            'text' => 'Dashboard',
            'url' => 'home',
            'icon' => 'fas fa-home',
        ],
        [
            'text'    => 'Pelayanan IGD',
            'icon'    => 'fas fa-hand-holding-medical',
            'submenu' => [
                [
                    'text' => 'Pendaftaran',
                    'url' => 'aplication',
                    'icon' => 'fas fa-users',
                    'shift'   => 'ml-2',
                    // 'can' => 'admin',
                    // 'active'  => ['user', 'user/create', 'user/edit/*'],
                ],
            ]
        ],
        [
            'text'    => 'Pelayanan Rawat Jalan',
            'icon'    => 'fas fa-hand-holding-medical',
            'submenu' => [
                [
                    'text' => 'Pendaftaran',
                    'url' => 'aplication',
                    'icon' => 'fas fa-users',
                    'shift'   => 'ml-2',
                    // 'can' => 'admin',
                    // 'active'  => ['user', 'user/create', 'user/edit/*'],
                ],
                [
                    'text' => 'Pemeriksaan Awal',
                    'url' => 'aplication',
                    'icon' => 'fas fa-users',
                    'shift'   => 'ml-2',
                    // 'can' => 'admin',
                    // 'active'  => ['user', 'user/create', 'user/edit/*'],
                ],
                [
                    'text' => 'Pemeriksaan Dokter',
                    'url' => 'aplication',
                    'icon' => 'fas fa-users',
                    'shift'   => 'ml-2',
                    // 'can' => 'admin',
                    // 'active'  => ['user', 'user/create', 'user/edit/*'],
                ],
                [
                    'text' => 'Pengambilan Obat',
                    'url' => 'aplication',
                    'icon' => 'fas fa-users',
                    'shift'   => 'ml-2',
                    // 'can' => 'admin',
                    // 'active'  => ['user', 'user/create', 'user/edit/*'],
                ],
                [
                    'text' => 'Kasir Pembayaran',
                    'url' => 'aplication',
                    'icon' => 'fas fa-users',
                    'shift'   => 'ml-2',
                    // 'can' => 'admin',
                    // 'active'  => ['user', 'user/create', 'user/edit/*'],
                ],
            ]
        ],
        [
            'text'    => 'Pelayanan Rawat Inap',
            'icon'    => 'fas fa-hand-holding-medical',
            'submenu' => [
                [
                    'text' => 'Pendaftaran',
                    'url' => 'aplication',
                    'icon' => 'fas fa-users',
                    'shift'   => 'ml-2',
                    // 'can' => 'admin',
                    // 'active'  => ['user', 'user/create', 'user/edit/*'],
                ],
            ]
        ],
        [
            'text'    => 'Pelayanan Penunjang',
            'icon'    => 'fas fa-hand-holding-medical',
            'submenu' => [
                [
                    'text' => 'Laboratorium',
                    'url' => 'aplication',
                    'icon' => 'fas fa-users',
                    'shift'   => 'ml-2',
                    // 'can' => 'admin',
                    // 'active'  => ['user', 'user/create', 'user/edit/*'],
                ],
                [
                    'text' => 'Radiologi',
                    'url' => 'aplication',
                    'icon' => 'fas fa-users',
                    'shift'   => 'ml-2',
                    // 'can' => 'admin',
                    // 'active'  => ['user', 'user/create', 'user/edit/*'],
                ],
                [
                    'text' => 'Kemoterapi',
                    'url' => 'aplication',
                    'icon' => 'fas fa-users',
                    'shift'   => 'ml-2',
                    // 'can' => 'admin',
                    // 'active'  => ['user', 'user/create', 'user/edit/*'],
                ],
                [
                    'text' => 'Bank Darah',
                    'url' => 'aplication',
                    'icon' => 'fas fa-users',
                    'shift'   => 'ml-2',
                    // 'can' => 'admin',
                    // 'active'  => ['user', 'user/create', 'user/edit/*'],
                ],
            ]
        ],
        [
            'text' => 'Pasien',
            'url' => 'aplication',
            'icon' => 'fas fa-users',
            // 'can' => 'admin',
            // 'active'  => ['user', 'user/create', 'user/edit/*'],
        ],
        [
            'text' => 'Dokter',
            'url' => 'aplication',
            'icon' => 'fas fa-users',
            // 'can' => 'admin',
            // 'active'  => ['user', 'user/create', 'user/edit/*'],
        ],
        [
            'text' => 'Perawat',
            'url' => 'aplication',
            'icon' => 'fas fa-users',
            // 'can' => 'admin',
            // 'active'  => ['user', 'user/create', 'user/edit/*'],
        ],
        [
            'text' => 'Unit',
            'url' => 'aplication',
            'icon' => 'fas fa-users',
            // 'can' => 'admin',
            // 'active'  => ['user', 'user/create', 'user/edit/*'],
        ],
        [
            'text' => 'Jadwal Dokter',
            'url' => 'aplication',
            'icon' => 'fas fa-users',
            // 'can' => 'admin',
            // 'active'  => ['user', 'user/create', 'user/edit/*'],
        ],
        [
            'text' => 'Obat',
            'url' => 'aplication',
            'icon' => 'fas fa-users',
            // 'can' => 'admin',
            // 'active'  => ['user', 'user/create', 'user/edit/*'],
        ],
        [
            'text' => 'Layanan',
            'url' => 'aplication',
            'icon' => 'fas fa-users',
            // 'can' => 'admin',
            // 'active'  => ['user', 'user/create', 'user/edit/*'],
        ],
        [
            'text' => 'Jaminan',
            'url' => 'aplication',
            'icon' => 'fas fa-users',
            // 'can' => 'admin',
            // 'active'  => ['user', 'user/create', 'user/edit/*'],
        ],
        [
            'text' => 'Diagnosa',
            'url' => 'aplication',
            'icon' => 'fas fa-users',
            // 'can' => 'admin',
            // 'active'  => ['user', 'user/create', 'user/edit/*'],
        ],
        // ANTRIAN BPJS
        [
            'text'    => 'Integrasi Antrian BPJS',
            'icon'    => 'fas fa-project-diagram',
            'submenu' => [
                [
                    'text' => 'Status Bridging',
                    'icon'    => 'fas fa-info-circle',
                    'url'  => 'statusAntrianBpjs',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Poliklinik',
                    'icon'    => 'fas fa-clinic-medical',
                    'url'  => 'poliklikAntrianBpjs',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Dokter',
                    'icon'    => 'fas fa-user-md',
                    'url'  => 'dokterAntrianBpjs',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Jadwal Dokter',
                    'icon'    => 'fas fa-calendar-alt',
                    'url'  => 'jadwalDokterAntrianBpjs',
                    'shift'   => 'ml-2',
                    'can' =>  ['pendaftaran', 'bpjs', 'manajemen'],
                ],
                [
                    'text' => 'Cek Fingerprint Peserta',
                    'icon'    => 'fas fa-fingerprint',
                    'url'  => 'fingerprintPeserta',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Anjungan Antrian',
                    'icon'    => 'fas fa-desktop',
                    'url'  => 'anjunganantrian',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Antrian',
                    'icon'    => 'fas fa-hospital-user',
                    'url'  => 'antrianBpjs',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'List Task',
                    'icon'    => 'fas fa-user-clock',
                    'url'  => 'listTaskID',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Dasboard Tanggal',
                    'icon'    => 'fas fa-calendar-day',
                    'url'  => 'dashboardTanggalAntrian',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Dashboard Bulan',
                    'icon'    => 'fas fa-calendar-week',
                    'url'  => 'dashboardBulanAntrian',
                    'shift'   => 'ml-2',
                ],
                // [
                //     'text' => 'Jadwal Operasi',
                //     'icon'    => 'fas fa-calendar-alt',
                //     'url'  => 'jadwalOperasi',
                //     'shift'   => 'ml-2',
                // 'can' =>  ['bpjs', 'pendaftaran','manajemen'],
                // ],
                [
                    'text' => 'Antrian Per Tanggal',
                    'icon'    => 'fas fa-calendar-day',
                    'url'  => 'antrianPerTanggal',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Monitoring Antrian',
                    'icon'    => 'fas fa-calendar-day',
                    'url'  => 'monitoringAntrian',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Antrian Per Kodebooking',
                    'icon'    => 'fas fa-calendar-day',
                    'url'  => 'antrianPerKodebooking',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Antrian Belum  Dilayani',
                    'icon'    => 'fas fa-calendar-day',
                    'url'  => 'antrianBelumDilayani',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Antrian Per Dokter',
                    'icon'    => 'fas fa-calendar-day',
                    'url'  => 'antrianPerDokter',
                    'shift'   => 'ml-2',
                ],

            ],
        ],
        // VCLAIM BPJS
        [
            'text'    => 'Integrasi VClaim BPJS',
            'icon'    => 'fas fa-project-diagram',
            'submenu' => [
                [
                    'text' => 'Pelayanan Peserta',
                    'icon'    => 'fas fa-id-card',
                    'url'  => 'monitoringPelayananPeserta',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'SEP Rawat Jalan',
                    'icon'    => 'fas fa-file-medical',
                    'url'  => 'sep_rajal',
                    'shift'   => 'ml-2',
                    'can' => ['bpjs', 'vclaim', 'pendaftaran', 'manajemen'],
                ],
                [
                    'text' => 'SEP Rawat Inap',
                    'icon'    => 'fas fa-file-medical',
                    'url'  => 'sep_ranap',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Approval Penjaminan SEP',
                    'icon'    => 'fas fa-comment-medical',
                    'url'  => 'list_approval_sep',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Surat Kontrol',
                    'icon'    => 'fas fa-file-medical',
                    'url'  => 'suratkontrol',
                    'shift'   => 'ml-2',
                    'can' => ['bpjs', 'vclaim', 'pendaftaran', 'manajemen'],
                ],
                [
                    'text' => 'Rujukan Keluar',
                    'icon'    => 'fas fa-comment-medical',
                    'url'  => 'rujukan',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Rujukan Khusus',
                    'icon'    => 'fas fa-comment-medical',
                    'url'  => 'rujukankhusus',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'PRB',
                    'icon'    => 'fas fa-first-aid',
                    'url'  => 'vclaim/prb',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Lembar Pengajuan Klaim',
                    'icon'    => 'fas fa-file-contract',
                    'url'  => 'lpk',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Data Kunjungan',
                    'icon'    => 'fas fa-chart-bar',
                    'url'  => 'monitoringDataKunjungan',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Data Klaim',
                    'icon'    => 'fas fa-chart-bar',
                    'url'  => 'monitoringDataKlaim',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Data Klaim Jasa Raharja',
                    'icon'    => 'fas fa-chart-bar',
                    'url'  => 'monitoringKlaimJasaraharja',
                    'shift'   => 'ml-2',
                ],

                [
                    'text' => 'Referensi',
                    'icon'    => 'fas fa-info-circle',
                    'url'  => 'referensiVclaim',
                    'shift'   => 'ml-2',
                ],
            ],
        ],
        // SATU SEHAT
        [
            'text'    => 'Integrasi Satu Sehat',
            'icon'    => 'fas fa-project-diagram',
            'can' => ['satu-sehat'],
            'submenu' => [
                [
                    'text' => 'Token',
                    'icon'    => 'fas fa-user-injured',
                    'url'  => 'satusehat/token',
                    'shift'   => 'ml-2',
                    'can' => ['satu-sehat'],
                ],
                [
                    'text' => 'Patient',
                    'icon'    => 'fas fa-user-injured',
                    'url'  => 'satusehat/patient',
                    'shift'   => 'ml-2',
                    'can' => ['satu-sehat'],
                ],
                [
                    'text' => 'Practitioner',
                    'icon'    => 'fas fa-user-md',
                    'url'  => 'satusehat/practitioner',
                    'shift'   => 'ml-2',
                    'can' => ['satu-sehat'],
                ],
                [
                    'text' => 'Organization',
                    'icon'    => 'fas fa-hospital',
                    'url'  => 'satusehat/organization',
                    'shift'   => 'ml-2',
                    'can' => ['satu-sehat'],
                ],
                [
                    'text' => 'Location',
                    'icon'    => 'fas fa-hospital',
                    'url'  => 'satusehat/location',
                    'shift'   => 'ml-2',
                    'can' => ['satu-sehat'],
                ],
                [
                    'text' => 'Encouter',
                    'icon'    => 'fas fa-user',
                    'url'  => 'satusehat/encounter',
                    'shift'   => 'ml-2',
                    'can' => ['satu-sehat'],
                ],
                [
                    'text' => 'Condition',
                    'icon'    => 'fas fa-user',
                    'url'  => 'satusehat/condition',
                    'shift'   => 'ml-2',
                    'can' => ['satu-sehat'],
                ],
            ],
        ],
        ['header' => 'PENGATURAN'],
        [
            'text' => 'Aplikasi',
            'url' => 'aplication',
            'icon' => 'fas fa-users',
            'can' => 'admin',
            // 'active'  => ['user', 'user/create', 'user/edit/*'],
        ],
        [
            'text' => 'Intergrasi',
            'url' => 'integration',
            'can' => 'admin',
            'icon' => 'fas fa-users',
            // 'active'  => ['user', 'user/create', 'user/edit/*'],
        ],
        [
            'text' => 'User',
            'url' => 'user',
            'can' => 'admin',
            'icon' => 'fas fa-users',
            'active'  => ['user', 'user/create', 'user/edit/*'],
        ],
        [
            'text' => 'Role & Permission',
            'url' => 'role-permission',
            'can' => 'admin',
            'icon' => 'fas fa-users-cog',
            'active'  => ['role-permission', 'permission/create', 'role/create', 'permission/edit/*'],
        ],
        [
            'text' => 'Profil',
            'url' => 'profil',
            'icon' => 'fas fa-user',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => true,
];
