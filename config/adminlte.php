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

    'use_ico_only' => true,
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
        'allowed' => false,
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

    'logo' => '<b>' . env('APP_NAME') . '</b>',
    'logo_img' => 'kitasehat/logokitasehat-lingkar.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'SIMRS Logo',

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
        'enabled' => true,
        'img' => [
            'path' => 'kitasehat/logokitasehat-lingkar.png',
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
            'path' => 'kitasehat/logokitasehat-lingkar.png',
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
    'layout_fixed_sidebar' => true,
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

    'classes_body' => 'text-sm',
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
    'sidebar_collapse' => true,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => false,
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
            'text'        => 'Landing Page',
            'url'         => '',
            'icon'        => 'fas fa-globe',
        ],
        [
            'text' => 'Home',
            'url' => 'home',
            'icon' => 'fas fa-home',
        ],
        [
            'text' => 'Dashboard',
            'url' => 'dashboard',
            'icon' => 'fas fa-chart-line',
        ],
        [
            'text'    => 'Pelayanan Rawat Jalan',
            'icon'    => 'fas fa-hand-holding-medical',
            'submenu' => [
                [
                    'text' => 'Anjungan Antrian',
                    'url' => 'anjunganantrian',
                    'icon' => 'fas fa-desktop',
                    'shift'   => 'ml-2',
                    'can' => 'pendaftaran',
                ],
                [
                    'text' => 'Display Antrian',
                    'url' => 'displayantrian',
                    'icon' => 'fas fa-desktop',
                    'shift'   => 'ml-2',
                    'can' => 'pendaftaran',
                ],
                [
                    'text' => 'Display Antrian Farmasi',
                    'url' => 'displayantrianfarmasi',
                    'icon' => 'fas fa-desktop',
                    'shift'   => 'ml-2',
                    'can' => ['pendaftaran', 'farmasi', 'apoteker'],
                ],
                [
                    'text' => 'Pendaftaran',
                    'url' => 'pendaftaran/rajal',
                    'icon' => 'fas fa-user-plus',
                    'shift'   => 'ml-2',
                    'can' => 'pendaftaran',
                    'active'  => ['pendaftaran/rajal', 'pendaftaran/rajal/*'],
                ],
                [
                    'text' => 'Pemeriksaan Perawat',
                    'url' => 'pemeriksaan/perawat/rajal',
                    'icon' => 'fas fa-user-nurse',
                    'shift'   => 'ml-2',
                    'can' => 'perawat',
                    'active'  => ['pemeriksaan/perawat/rajal', 'pemeriksaan/perawat/rajal*'],
                ],
                [
                    'text' => 'Pemeriksaan Dokter',
                    'url' => 'pemeriksaan/dokter/rajal',
                    'icon' => 'fas fa-user-md',
                    'shift'   => 'ml-2',
                    'can' => 'dokter',
                    'active'  => ['pemeriksaan/dokter/rajal', 'pemeriksaan/dokter/rajal*'],
                ],
                [
                    'text' => 'Pengambilan Resep Obat',
                    'url' => 'farmasi/pengambilan_resep',
                    'icon' => 'fas fa-pills',
                    'shift'   => 'ml-2',
                    'can' => 'farmasi',
                ],
                [
                    'text' => 'Kasir Pembayaran',
                    'url' => 'kasir-pembayaran',
                    'icon' => 'fas fa-cash-register',
                    'shift'   => 'ml-2',
                    'can' => 'kasir',
                ],
                [
                    'text' => 'Rekam Medis Rawat Jalan',
                    'url' => 'rekammedis/rajal',
                    'active' => ['rekammedis/rajal', 'rekammedis/rajal/edit/*'],
                    'icon' => 'fas fa-laptop-medical',
                    'shift'   => 'ml-2',
                    'can' => 'rekam-medis',
                ],
            ]
        ],
        [
            'text'    => 'Pelayanan IGD',
            'icon'    => 'fas fa-ambulance',
            'submenu' => [
                [
                    'text' => 'Pendaftaran IGD',
                    'url' => 'pendaftaran/igd',
                    'icon' => 'fas fa-users',
                    'shift'   => 'ml-2',
                    'can' => ['pendaftaran', 'igd', 'pendaftaran-ranap'],
                    'active'  => ['pendaftaran/igd', 'pendaftaran/igd/proses'],
                ],
            ]
        ],
        [
            'text'    => 'Pelayanan Rawat Inap',
            'icon'    => 'fas fa-procedures',
            'submenu' => [
                [
                    'text' => 'Pendaftaran Ranap',
                    'url' => 'pendaftaran/ranap',
                    'icon' => 'fas fa-users',
                    'shift'   => 'ml-2',
                    'can' => ['pendaftaran', 'igd', 'pendaftaran-ranap'],
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
                    'can' => 'laboratorium',
                    // 'active'  => ['user', 'user/create', 'user/edit/*'],
                ],
                [
                    'text' => 'Radiologi',
                    'url' => 'aplication',
                    'icon' => 'fas fa-users',
                    'shift'   => 'ml-2',
                    'can' => 'radiologi',
                    // 'active'  => ['user', 'user/create', 'user/edit/*'],
                ],
                [
                    'text' => 'Kemoterapi',
                    'url' => 'aplication',
                    'icon' => 'fas fa-users',
                    'shift'   => 'ml-2',
                    'can' => 'kemoterapi',
                    // 'active'  => ['user', 'user/create', 'user/edit/*'],
                ],
                [
                    'text' => 'Bank Darah',
                    'url' => 'aplication',
                    'icon' => 'fas fa-users',
                    'shift'   => 'ml-2',
                    'can' => 'bank-darah',
                    // 'active'  => ['user', 'user/create', 'user/edit/*'],
                ],
            ]
        ],
        [
            'text'    => 'Pengelolaan',
            'icon'    => 'fas fa-database',
            'submenu' => [
                [
                    'text' => 'Pasien',
                    'url' => 'pasien',
                    'icon' => 'fas fa-user-injured',
                    'can' => ['manajemen-pelayanan', 'pendaftaran'],
                    'active'  => ['pasien', 'pasien/create', 'pasien/edit/*'],
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Pegawai',
                    'url' => 'pegawai',
                    'can' => 'pegawai',
                    'icon' => 'fas fa-user-tie',
                    'active'  => ['pegawai', 'pegawai/create', 'pegawai/edit/*'],
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Dokter',
                    'url' => 'dokter',
                    'icon' => 'fas fa-user-md',
                    'can' => ['manajemen-pelayanan', 'pendaftaran'],
                    'active'  => ['dokter', 'dokter/create', 'dokter/edit/*'],
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Perawat',
                    'url' => 'perawat',
                    'icon' => 'fas fa-user-nurse',
                    'can' => 'manajemen-pelayanan',
                    'active'  => ['perawat', 'perawat/create', 'perawat/edit/*'],
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Unit',
                    'url' => 'unit',
                    'icon' => 'fas fa-clinic-medical',
                    'can' => ['manajemen-pelayanan', 'pendaftaran'],
                    'active'  => ['unit', 'unit/create', 'unit/edit/*'],
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Kamar & Bed',
                    'url' => 'kamar-bed',
                    'icon' => 'fas fa-bed',
                    'active'  => ['kamar-bed', 'kamar-bed/create', 'kamar-bed/edit/*'],
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Jadwal Dokter Rajal',
                    'url' => 'jadwaldokter',
                    'icon' => 'fas fa-calendar-alt',
                    'can' => ['manajemen-pelayanan', 'pendaftaran'],
                    'active'  => ['jadwaldokter', 'jadwaldokter/create', 'jadwaldokter/edit/*'],
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Obat',
                    'url' => 'obat',
                    'icon' => 'fas fa-pills',
                    'can' => 'manajemen-farmasi',
                    'active'  => ['obat', 'obat/create', 'obat/edit/*'],
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Tindakan',
                    'url' => 'tindakan',
                    'icon' => 'fas fa-hand-holding-medical',
                    'can' => 'manajemen-pelayanan',
                    'active'  => ['tindakan', 'tindakan/create', 'tindakan/edit/*'],
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Jaminan',
                    'url' => 'jaminan',
                    'icon' => 'fas fa-id-card',
                    'can' => 'manajemen-pelayanan',
                    'active'  => ['jaminan', 'jaminan/create', 'jaminan/edit/*'],
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Diagnosa',
                    'url' => 'diagnosa',
                    'icon' => 'fas fa-diagnoses',
                    'can' => ['rekam-medis', 'dokter', 'perawat'],
                    'active'  => ['diagnosa', 'diagnosa/create', 'diagnosa/edit/*'],
                    'shift'   => 'ml-2',
                ],
            ],
        ],
        // ANTRIAN BPJS
        [
            'text'    => 'Integrasi Antrian BPJS',
            'icon'    => 'fas fa-project-diagram',
            'can' => 'antrian-bpjs',
            'submenu' => [
                [
                    'text' => 'Poliklinik',
                    'icon'    => 'fas fa-clinic-medical',
                    'url'  => 'bpjs/antrian/refpoliklinik',
                    'shift'   => 'ml-2',
                    'can' => 'antrian-bpjs',
                ],
                [
                    'text' => 'Dokter',
                    'icon'    => 'fas fa-user-md',
                    'url'  => 'bpjs/antrian/refdokter',
                    'shift'   => 'ml-2',
                    'can' => 'antrian-bpjs',
                ],
                [
                    'text' => 'Jadwal Dokter',
                    'icon'    => 'fas fa-calendar-alt',
                    'url'  => 'bpjs/antrian/refjadwaldokter',
                    'shift'   => 'ml-2',
                    'can' => 'antrian-bpjs',
                ],
                [
                    'text' => 'Poliklinik Fingerprint',
                    'icon'    => 'fas fa-clinic-medical',
                    'url'  => 'bpjs/antrian/refpoliklinik-fingerprint',
                    'shift'   => 'ml-2',
                    'can' => 'antrian-bpjs',
                ],
                [
                    'text' => 'Peserta Fingerprint',
                    'icon'    => 'fas fa-fingerprint',
                    'url'  => 'bpjs/antrian/refpeserta-fingerprint',
                    'shift'   => 'ml-2',
                    'can' => 'antrian-bpjs',
                ],
                // [
                //     'text' => 'Anjungan Antrian',
                //     'icon'    => 'fas fa-desktop',
                //     'url'  => 'anjunganantrian',
                //     'shift'   => 'ml-2',
                // ],
                // [
                //     'text' => 'Antrian',
                //     'icon'    => 'fas fa-hospital-user',
                //     'url'  => 'antrianBpjs',
                //     'shift'   => 'ml-2',
                // ],
                [
                    'text' => 'List Taskid',
                    'icon'    => 'fas fa-user-clock',
                    'url'  => 'bpjs/antrian/listtaskid',
                    'shift'   => 'ml-2',
                    'can' => 'antrian-bpjs',
                ],
                [
                    'text' => 'Dasboard Tanggal',
                    'icon'    => 'fas fa-calendar-day',
                    'url'  => 'bpjs/antrian/dashboardtanggal',
                    'shift'   => 'ml-2',
                    'can' => 'antrian-bpjs',
                ],
                [
                    'text' => 'Dashboard Bulan',
                    'icon'    => 'fas fa-calendar-week',
                    'url'  => 'bpjs/antrian/dashboardbulan',
                    'shift'   => 'ml-2',
                    'can' => 'antrian-bpjs',
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
                    'url'  => 'bpjs/antrian/antreantanggal',
                    'shift'   => 'ml-2',
                    'can' => 'antrian-bpjs',
                ],
                [
                    'text' => 'Antrian Per Kodebooking',
                    'icon'    => 'fas fa-calendar-day',
                    'url'  => 'bpjs/antrian/antreankodebooking/*',
                    'active'  => ['bpjs/antrian/antreankodebooking/*'],
                    'shift'   => 'ml-2',
                    'can' => 'antrian-bpjs',
                ],
                [
                    'text' => 'Antrian Belum  Dilayani',
                    'icon'    => 'fas fa-calendar-day',
                    'url'  => 'bpjs/antrian/antreanbelumlayani',
                    'shift'   => 'ml-2',
                    'can' => 'antrian-bpjs',
                ],
                [
                    'text' => 'Antrian Per Dokter',
                    'icon'    => 'fas fa-calendar-day',
                    'url'  => 'bpjs/antrian/antreandokter',
                    'shift'   => 'ml-2',
                    'can' => 'antrian-bpjs',
                ],

            ],
        ],
        // VCLAIM BPJS
        [
            'text'    => 'Integrasi VClaim BPJS',
            'icon'    => 'fas fa-project-diagram',
            'can' => 'vclaim-bpjs',
            'submenu' => [
                [
                    'text' => 'Lembar Pengajuan Klaim',
                    'icon'    => 'fas fa-file-contract',
                    'url'  => 'lpk',
                    'can' => 'vclaim-bpjs',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Data Kunjungan',
                    'icon' => 'fas fa-chart-bar',
                    'url' => 'bpjs/vclaim/monitoring-data-kunjungan',
                    'can' => 'vclaim-bpjs',
                    'shift' => 'ml-2',
                ],
                [
                    'text' => 'Data Klaim',
                    'icon' => 'fas fa-chart-bar',
                    'url' => 'bpjs/vclaim/monitoring-data-klaim',
                    'can' => 'vclaim-bpjs',
                    'shift' => 'ml-2',
                ],
                [
                    'text' => 'Data Pelayanan Peserta',
                    'icon' => 'fas fa-id-card',
                    'url' => 'bpjs/vclaim/monitoring-pelayanan-peserta',
                    'shift' => 'ml-2',
                    'can' => 'vclaim-bpjs',
                ],
                [
                    'text' => 'Data Klaim Jasa Raharja',
                    'icon' => 'fas fa-chart-bar',
                    'url' => 'bpjs/vclaim/monitoring-klaim-jasa-raharja',
                    'can' => 'vclaim-bpjs',
                    'shift' => 'ml-2',
                ],
                [
                    'text' => 'Peserta BPJS',
                    'icon' => 'fas fa-id-card',
                    'url' => 'bpjs/vclaim/peserta-bpjs',
                    'shift' => 'ml-2',
                    'can' => 'vclaim-bpjs',
                ],
                [
                    'text' => 'PRB',
                    'icon'    => 'fas fa-first-aid',
                    'url'  => 'vclaim/prb',
                    'can' => 'vclaim-bpjs',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Referensi',
                    'icon'    => 'fas fa-info-circle',
                    'url'  => 'bpjs/vclaim/referensi',
                    'can' => 'vclaim-bpjs',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Surat Kontrol',
                    'icon'    => 'fas fa-file-medical',
                    'url'  => 'bpjs/vclaim/surat-kontrol',
                    'shift'   => 'ml-2',
                    'can' => 'vclaim-bpjs',
                ],
                [
                    'text' => 'Rujukan',
                    'icon'    => 'fas fa-comment-medical',
                    'url'  => 'bpjs/vclaim/rujukan',
                    'shift'   => 'ml-2',
                    'can' => 'vclaim-bpjs',
                ],
                [
                    'text' => 'SEP',
                    'icon'    => 'fas fa-file-medical',
                    'url'  => 'bpjs/vclaim/sep',
                    'shift'   => 'ml-2',
                    'can' => 'vclaim-bpjs',
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
            'url' => 'aplikasi',
            'icon' => 'fas fa-users',
            'can' => 'admin',
            // 'active'  => ['user', 'user/create', 'user/edit/*'],
        ],
        [
            'text' => 'Intergrasi',
            'url' => 'integration',
            'can' => 'admin',
            'icon' => 'fas fa-cloud-upload-alt',
            'active'  => ['integration', 'integration/create', 'integration/edit/*'],
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
        'Flatpicker' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/flatpickr/flatpickr.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/flatpickr/flatpickr.min.css',
                ],
            ],
        ],
        'TempusDominusBs4' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/moment/moment.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
                ],
            ],
        ],
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'DatatablesPlugins' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/dataTables.buttons.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.html5.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/js/buttons.print.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/jszip/jszip.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/pdfmake.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/pdfmake/vfs_fonts.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/buttons/css/buttons.bootstrap4.min.css',
                ],
            ],
        ],
        'DatatablesFixedColumns' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/fixedcolumns/js/dataTables.fixedColumns.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables-plugins/fixedcolumns/css/fixedColumns.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/select2/js/select2.full.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2/css/select2.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/chart.js/Chart.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/chart.js/Chart.min.css',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/sweetalert2/sweetalert2.all.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
                ],
            ],
        ],
        'BootstrapSwitch' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bootstrap-switch/js/bootstrap-switch.min.js',
                ],
            ],
        ],
        'Pace' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/pace-progress/themes/blue/pace-theme-flat-top.css'
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/pace-progress/pace.min.js'
                ],
            ],
        ],
        'DateRangePicker' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' =>  'vendor/moment/moment.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/daterangepicker/daterangepicker.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/daterangepicker/daterangepicker.css',
                ],
            ],
        ],
        'EkkoLightBox' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' =>  'vendor/ekko-lightbox/ekko-lightbox.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' =>  'vendor/ekko-lightbox/ekko-lightbox.css',
                ],
            ],
        ],
        'InputMask' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/inputmask/inputmask.min.js',
                ],
            ],
        ],
        'BsCustomFileInput' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/bs-custom-file-input/bs-custom-file-input.min.js',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/chart.js/Chart.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/chart.js/Chart.min.css',
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
