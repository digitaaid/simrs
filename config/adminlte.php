<?php

use App\Models\Pengaturan;

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

    'title' => 'App Title',
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

    'logo' => 'App Name',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'App Name',
    'auth_img' => '',
    'anjungan_color' => 'purple',
    'anjungan_qr' => 'img/image-placeholder.jpg',
    'anjungan_img_info' => 'img/image-placeholder.jpg',
    'logo_karcis' =>  'vendor/adminlte/dist/img/AdminLTELogo.png',

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
            'alt' => 'App Preloader Image',
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

    'classes_body' => 'text-xs',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => 'text-xs',
    'classes_content_header' => 'text-xs',
    'classes_content' => 'text-xs',
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
            'text'        => 'Landing Page',
            'url'         => '',
            'icon'        => 'fas fa-globe',
        ],
        [
            'text' => 'Menu Utama',

        ],
        // DASHBOARD
        [
            'text'    => 'Dashboard',
            'icon'    => 'fas fa-window-restore',
            'submenu' => [
                [
                    'text' => 'Dashboard Utama',
                    'icon' => 'fas fa-home',
                    'shift'   => 'ml-2',
                    'url' => 'home',
                ],
            ],
        ],
        // ANTRIAN
        [
            'text'    => 'Antrian',
            'icon'    => 'fas fa-hospital-user',
            'submenu' => [
                [
                    'text' => 'Anjungan Antrian',
                    'url' => 'anjunganantrian',
                    'icon' => 'fas fa-desktop',
                    'shift'   => 'ml-2',
                    'can' => 'rajal-pendaftaran',
                ],
                [
                    'text' => 'Display Antrian',
                    'url' => 'displayantrian',
                    'icon' => 'fas fa-desktop',
                    'shift'   => 'ml-2',
                    'can' => 'rajal-pendaftaran',
                ],
                [
                    'text' => 'Display Antrian Farmasi',
                    'url' => 'displayantrianfarmasi',
                    'icon' => 'fas fa-desktop',
                    'shift'   => 'ml-2',
                    'can' => 'rajal-pendaftaran',
                ],
                [
                    'text' => 'Dashboard Rawat Jalan',
                    'url' => 'dashboard',
                    'shift'   => 'ml-2',
                    'icon' => 'fas fa-chart-line',
                    'can' => 'rajal-pendaftaran',
                ],
                [
                    'text' => 'Monitoring Antrian Bulan',
                    'icon'    => 'fas fa-calendar-alt',
                    'url'  => 'monitoring-rajal',
                    'shift'   => 'ml-2',
                    'can' => 'rajal-pendaftaran',
                ],
            ],
        ],
        // RAJAL
        [
            'text'    => 'Pelayanan Rawat Jalan',
            'icon'    => 'fas fa-hand-holding-medical',
            'submenu' => [
                [
                    'text' => 'Pendaftaran Rajal',
                    'url' => 'rajal/pendaftaran',
                    'icon' => 'fas fa-user-plus',
                    'shift'   => 'ml-2',
                    'active'  => ['rajal/pendaftaran', 'rajal/pendaftaran/proses/*'],
                    'can' => 'rajal-pendaftaran',
                ],
                [
                    'text' => 'Keperawatan Rajal',
                    'url' => 'rajal/keperawatan',
                    'icon' => 'fas fa-user-nurse',
                    'shift'   => 'ml-2',
                    'active'  => ['rajal/keperawatan', 'rajal/keperawatan/*'],
                    'can' => 'rajal-keperawatan',
                ],
                [
                    'text' => 'Pemeriksaan Rajal',
                    'url' => 'rajal/pemeriksaan',
                    'icon' => 'fas fa-user-md',
                    'shift'   => 'ml-2',
                    'active'  => ['rajal/pemeriksaan', 'rajal/pemeriksaan/proses/*'],
                    'can' => 'rajal-pemeriksaan',
                ],
                [
                    'text' => 'Farmasi Rajal',
                    'url' => 'rajal/farmasi',
                    'icon' => 'fas fa-pills',
                    'shift'   => 'ml-2',
                    'can' => 'rajal-farmasi',
                ],
                [
                    'text' => 'Kasir Rajal',
                    'url' => 'kasir-pembayaran',
                    'icon' => 'fas fa-cash-register',
                    'shift'   => 'ml-2',
                    'can' => 'rajal-kasir',
                ],
                [
                    'text' => 'Casemix Rajal',
                    'url' => 'rajal/casemix',
                    'icon' => 'fas fa-notes-medical',
                    'shift'   => 'ml-2',
                    // 'can' => 'rajal/casemix',
                ],
            ],
        ],
        // IGD
        [
            'text'    => 'Pelayanan Gawat Darurat',
            'icon'    => 'fas fa-ambulance',
            'submenu' => [
                [
                    'text' => 'Pendaftaran IGD',
                    'url' => 'igd/pendaftaran',
                    'icon' => 'fas fa-user-plus',
                    'shift'   => 'ml-2',
                    'active'  => ['igd/pendaftaran', 'igd/pendaftaran/proses/*'],
                    'can' => 'igd-pendaftaran',
                ],
                [
                    'text' => 'Keperawatan IGD',
                    'url' => 'igd/keperawatan',
                    'icon' => 'fas fa-user-nurse',
                    'shift'   => 'ml-2',
                    'active'  => ['igd/keperawatan', 'igd/keperawatan/proses/*'],
                    'can' => 'igd-keperawatan',
                ],
                [
                    'text' => 'Pemeriksaan IGD',
                    'url' => 'igd/pemeriksaan',
                    'icon' => 'fas fa-user-md',
                    'shift'   => 'ml-2',
                    'active'  => ['igd/pemeriksaan', 'igd/pemeriksaan/proses/*'],
                    'can' => 'igd-pemeriksaan',
                ],
                [
                    'text' => 'Farmasi IGD',
                    'url' => 'igd/farmasi',
                    'icon' => 'fas fa-pills',
                    'shift'   => 'ml-2',
                    'active'  => ['igd/farmasi', 'igd/farmasi/proses/*'],
                    'can' => 'igd-farmasi',
                ],
                [
                    'text' => 'Kasir IGD',
                    'url' => 'igd/kasir',
                    'icon' => 'fas fa-cash-register',
                    'shift'   => 'ml-2',
                    'active'  => ['igd/kasir', 'igd/kasir/proses'],
                    'can' => 'igd-kasir',
                ],
            ]
        ],
        // RAWAT INAP
        [
            'text'    => 'Pelayanan Rawat Inap',
            'icon'    => 'fas fa-procedures',
            'submenu' => [
                [
                    'text' => 'Display Ranap',
                    'url' => 'displayranap',
                    'icon' => 'fas fa-chart-line',
                    'shift'   => 'ml-2',
                    'can' => 'ranap-pendaftaran',
                ],
                [
                    'text' => 'Pendaftaran Ranap',
                    'url' => 'ranap/pendaftaran',
                    'icon' => 'fas fa-user-plus',
                    'shift'   => 'ml-2',
                    'active'  => ['ranap/pendaftaran', 'ranap/pendaftaran/proses/*'],
                    'can' => 'igd-pendaftaran',
                ],
                [
                    'text' => 'Keperawatan Ranap',
                    'url' => 'ranap/keperawatan',
                    'icon' => 'fas fa-user-nurse',
                    'shift'   => 'ml-2',
                    'active'  => ['ranap/keperawatan', 'ranap/keperawatan/proses/*'],
                    'can' => 'igd-keperawatan',
                ],
                [
                    'text' => 'Pemeriksaan Ranap',
                    'url' => 'ranap/pemeriksaan',
                    'icon' => 'fas fa-user-md',
                    'shift'   => 'ml-2',
                    'active'  => ['ranap/pemeriksaan', 'ranap/pemeriksaan/proses/*'],
                    'can' => 'igd-pemeriksaan',
                ],
                [
                    'text' => 'Farmasi Ranap',
                    'url' => 'ranap/farmasi',
                    'icon' => 'fas fa-pills',
                    'shift'   => 'ml-2',
                    'active'  => ['ranap/farmasi', 'ranap/farmasi/proses/*'],
                    'can' => 'igd-farmasi',
                ],
                [
                    'text' => 'Kasir Ranap',
                    'url' => 'ranap/kasir',
                    'icon' => 'fas fa-cash-register',
                    'shift'   => 'ml-2',
                    'active'  => ['ranap/kasir', 'ranap/kasir/proses'],
                    'can' => 'igd-kasir',
                ],
            ]
        ],
        // PELAYANAN PENUNJANG
        [
            'text'    => 'Pelayanan Penunjang',
            'icon'    => 'fas fa-diagnoses',
            'submenu' => [
                [
                    'text' => 'Laboratorium',
                    'url' => 'laboratorium',
                    'icon' => 'fas fa-vials',
                    'shift'   => 'ml-2',
                    'can' => 'laboratorium',
                ],
                [
                    'text' => 'Radiologi',
                    'url' => 'radiologi',
                    'icon' => 'fas fa-x-ray',
                    'shift'   => 'ml-2',
                    'can' => 'radiologi',
                    // 'active'  => ['user', 'user/create', 'user/edit/*'],
                ],
                [
                    'text' => 'Kemoterapi',
                    'url' => 'kemoterapi',
                    'icon' => 'fas fa-syringe',
                    'shift'   => 'ml-2',
                    'can' => 'kemoterapi',
                    // 'active'  => ['user', 'user/create', 'user/edit/*'],
                ],
                [
                    'text' => 'Bank Darah',
                    'url' => 'aplication',
                    'icon' => 'fas fa-medkit',
                    'shift'   => 'ml-2',
                    'can' => 'bank-darah',
                    // 'active'  => ['user', 'user/create', 'user/edit/*'],
                ],
            ]
        ],
        // FARMASI & APOTEK
        [
            'text'    => 'Farmasi & Apotek',
            'icon'    => 'fas fa-pills',
            'can' => ['farmasi', 'apotek'],
            'submenu' => [
                [
                    'text' => 'Penjualan Obat',
                    'url' => 'apotek/penjualan_obat',
                    'icon' => 'fas fa-pills',
                    'shift'   => 'ml-2',
                    'can' => ['farmasi', 'apotek'],
                ],

                [
                    'text' => 'Resep Obat IGD',
                    'url' => 'apotek/resep_obat_igd',
                    'icon' => 'fas fa-pills',
                    'shift'   => 'ml-2',
                    'can' => ['farmasi', 'apotek'],
                ],
                [
                    'text' => 'Resep Obat Rawat Inap',
                    'url' => 'apotek/resep_obat_ranap',
                    'icon' => 'fas fa-pills',
                    'shift'   => 'ml-2',
                    'can' => ['farmasi', 'apotek'],
                ],
                [
                    'text' => 'Satuan & Kemasan',
                    'url' => 'farmasi/satuan-kemasan',
                    'icon' => 'fas fa-box',
                    'can' => ['farmasi'],
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Supplier Obat',
                    'url' => 'farmasi/supplier-obat',
                    'icon' => 'fas fa-box',
                    'can' => ['farmasi'],
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Data Obat',
                    'url' => 'farmasi/obat',
                    'icon' => 'fas fa-pills',
                    'can' => ['farmasi', 'apotek'],
                    'active'  => ['obat', 'obat/create', 'obat/edit/*', 'stokobat'],
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Pemesanan Obat',
                    'url' => 'farmasi/pemesanan-obat',
                    'icon' => 'fas fa-box',
                    'can' => ['farmasi'],
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Stok Opname Obat',
                    'url' => 'stok-opname',
                    'icon' => 'fas fa-pills',
                    'can' => ['farmasi'],
                    'shift'   => 'ml-2',
                ],
            ],
        ],
        // REKAM MEDIS & CASEMIX
        [
            'text'    => 'Rekam Medis & Casemix',
            'icon'    => 'fas fa-file-medical',
            'submenu' => [
                [
                    'text' => 'Rekam Medis Rawat Jalan',
                    'url' => 'rekam-medis/rajal',
                    'active' => ['rekam-medis/rajal', 'rekam-medis/rajal/edit/*'],
                    'icon' => 'fas fa-laptop-medical',
                    'shift'   => 'ml-2',
                ],
            ],
        ],
        //  PASIEN
        [
            'text' => 'Pasien',
            'url' => 'pasien',
            'icon' => 'fas fa-user-injured',
            'submenu' => [
                [
                    'text' => 'Data Pasien',
                    'shift'   => 'ml-2',
                    'url' => 'pasien',
                    'icon' => 'fas fa-address-book',
                    'can' => 'data-pasien',
                    'active'  => ['pasien', 'pasien/create', 'pasien/edit/*'],
                ],
            ]
        ],
        // PEGAWAI
        [
            'text'    => 'Keuangan',
            'icon'    => 'fas fa-money-check-alt',
            'submenu' => [
                [
                    'text' => 'Data Tarif Tindakan',
                    'url' => 'tindakan',
                    'icon' => 'fas fa-hand-holding-medical',
                    'shift'   => 'ml-2',
                    'can' => 'data-tindakan',

                ],
                [
                    'text' => 'Data Jaminan',
                    'url' => 'jaminan',
                    'icon' => 'fas fa-id-card',
                    'shift'   => 'ml-2',
                    'can' => 'data-jaminan',
                ],
            ],
        ],
        // PEGAWAI
        [
            'text'    => 'Kepegawaian',
            'icon'    => 'fas fa-user-tie',
            'submenu' => [
                [
                    'text' => 'Data Pegawai',
                    'url' => 'pegawai',
                    'can' => 'data-pegawai',
                    'icon' => 'fas fa-user-tie',
                    'active'  => ['pegawai', 'pegawai/create', 'pegawai/edit/*'],
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Data Dokter',
                    'shift'   => 'ml-2',
                    'url' => 'dokter',
                    'icon' => 'fas fa-user-md',
                    'can' => ['data-dokter'],
                    'active'  => ['dokter', 'dokter/create', 'dokter/edit/*'],
                ],
                [
                    'text' => 'Data Perawat',
                    'url' => 'perawat',
                    'icon' => 'fas fa-user-nurse',
                    'can' => 'data-perawat',
                    'active'  => ['perawat', 'perawat/create', 'perawat/edit/*'],
                    'shift'   => 'ml-2',
                ],
            ],
        ],
        // ABSENSI
        [
            'text'    => 'Absensi',
            'icon'    => 'fas fa-user-clock',
            'submenu' => [
                [
                    'text' => 'Proses Absensi',
                    'icon'    => 'fas fa-street-view',
                    'url'  => 'absensi-proses',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Lokasi Saya',
                    'icon'    => 'fas fa-map-marked-alt',
                    'url'  => 'lokasi-saya',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Lokasi Absensi',
                    'icon'    => 'fas fa-map-marked-alt',
                    'url'  => 'lokasi-absensi',
                    'shift'   => 'ml-2',
                    'can'  => 'data-absensi',
                ],
                [
                    'text' => 'Jadwal Absensi',
                    'icon'    => 'fas fa-calendar-day',
                    'url'  => 'shift-absensi',
                    'shift'   => 'ml-2',
                    'can'  => 'data-absensi',
                ],
                [
                    'text' => 'Absensi Pegawai',
                    'icon'    => 'fas fa-user-clock',
                    'url'  => 'shift-pegawai',
                    'active'  => ['shift-pegawai', 'shift-pegawai-edit'],
                    'shift'   => 'ml-2',
                    'can'  => 'data-absensi',
                ],
                [
                    'text' => 'Laporan Absensi',
                    'icon' => 'fas fa-chart-line',
                    'url'  => 'laporan-absensi',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Lembur',
                    'icon'    => 'fas fa-business-time',
                    'url'  => 'lembur-index',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Lembur Pegawai',
                    'icon'    => 'fas fa-business-time',
                    'url'  => 'lokasi-pegawai',
                    'shift'   => 'ml-2',
                    'can'  => 'data-absensi',
                ],
                [
                    'text' => 'Cuti',
                    'icon'    => 'fas fa-calendar-times',
                    'url'  => 'lokasi-index',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Cuti Pegawai',
                    'icon' => 'fas fa-chart-line',
                    'url'  => 'lokasi-pegawai',
                    'shift'   => 'ml-2',
                    'can'  => 'data-absensi',
                ],

            ],
        ],
        // ANTRIAN BPJS
        [
            'text'    => 'Antrian BPJS',
            'icon'    => 'fas fa-project-diagram',
            'can' => 'bpjs-antrian',
            'submenu' => [
                [
                    'text' => 'Poliklinik',
                    'icon'    => 'fas fa-clinic-medical',
                    'url'  => 'bpjs/antrian/refpoliklinik',
                    'shift'   => 'ml-2',
                    'can' => 'bpjs-antrian',
                ],
                [
                    'text' => 'Dokter',
                    'icon'    => 'fas fa-user-md',
                    'url'  => 'bpjs/antrian/refdokter',
                    'shift'   => 'ml-2',
                    'can' => 'bpjs-antrian',
                ],
                [
                    'text' => 'Jadwal Dokter',
                    'icon'    => 'fas fa-calendar-alt',
                    'url'  => 'bpjs/antrian/refjadwaldokter',
                    'shift'   => 'ml-2',
                    'can' => 'bpjs-antrian',
                ],
                // [
                //     'text' => 'Update Jadwal Dokter',
                //     'icon'    => 'fas fa-calendar-alt',
                //     'url'  => 'bpjs/antrian/updatejadwaldokter',
                //     'shift'   => 'ml-2',
                //     'can' => 'bpjs-antrian',
                // ],
                [
                    'text' => 'Poliklinik Fingerprint',
                    'icon'    => 'fas fa-clinic-medical',
                    'url'  => 'bpjs/antrian/refpoliklinik-fingerprint',
                    'shift'   => 'ml-2',
                    'can' => 'bpjs-antrian',
                ],
                [
                    'text' => 'Peserta Fingerprint',
                    'icon'    => 'fas fa-fingerprint',
                    'url'  => 'bpjs/antrian/refpeserta-fingerprint',
                    'shift'   => 'ml-2',
                    'can' => 'bpjs-antrian',
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
                    'can' => 'bpjs-antrian',
                ],
                [
                    'text' => 'Dasboard Tanggal',
                    'icon'    => 'fas fa-calendar-day',
                    'url'  => 'bpjs/antrian/dashboardtanggal',
                    'shift'   => 'ml-2',
                    'can' => 'bpjs-antrian',
                ],
                [
                    'text' => 'Dashboard Bulan',
                    'icon'    => 'fas fa-calendar-week',
                    'url'  => 'bpjs/antrian/dashboardbulan',
                    'shift'   => 'ml-2',
                    'can' => 'bpjs-antrian',
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
                    'can' => 'bpjs-antrian',
                ],
                [
                    'text' => 'Antrian Per Kodebooking',
                    'icon'    => 'fas fa-calendar-day',
                    'url'  => 'bpjs/antrian/antreankodebooking/*',
                    'active'  => ['bpjs/antrian/antreankodebooking/*'],
                    'shift'   => 'ml-2',
                    'can' => 'bpjs-antrian',
                ],
                [
                    'text' => 'Antrian Belum  Dilayani',
                    'icon'    => 'fas fa-calendar-day',
                    'url'  => 'bpjs/antrian/antreanbelumlayani',
                    'shift'   => 'ml-2',
                    'can' => 'bpjs-antrian',
                ],
                [
                    'text' => 'Antrian Per Dokter',
                    'icon'    => 'fas fa-calendar-day',
                    'url'  => 'bpjs/antrian/antreandokter',
                    'shift'   => 'ml-2',
                    'can' => 'bpjs-antrian',
                ],

            ],
        ],
        // VCLAIM BPJS
        [
            'text'    => 'VClaim BPJS',
            'icon'    => 'fas fa-project-diagram',
            'can' => 'bpjs-vclaim',
            'submenu' => [
                [
                    'text' => 'Lembar Pengajuan Klaim',
                    'icon'    => 'fas fa-file-contract',
                    'url'  => 'lpk',
                    'can' => 'bpjs-vclaim',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Monitoring Data Kunjungan',
                    'icon' => 'fas fa-chart-bar',
                    'url' => 'bpjs/vclaim/monitoring-data-kunjungan',
                    'can' => 'bpjs-vclaim',
                    'shift' => 'ml-2',
                ],
                [
                    'text' => 'Monitoring Data Klaim',
                    'icon' => 'fas fa-chart-bar',
                    'url' => 'bpjs/vclaim/monitoring-data-klaim',
                    'can' => 'bpjs-vclaim',
                    'shift' => 'ml-2',
                ],
                [
                    'text' => 'Monitoring Pelayanan Peserta',
                    'icon' => 'fas fa-id-card',
                    'url' => 'bpjs/vclaim/monitoring-pelayanan-peserta',
                    'shift' => 'ml-2',
                    'can' => 'bpjs-vclaim',
                ],
                [
                    'text' => 'Monitoring Klaim Jasa Raharja',
                    'icon' => 'fas fa-chart-bar',
                    'url' => 'bpjs/vclaim/monitoring-klaim-jasa-raharja',
                    'can' => 'bpjs-vclaim',
                    'shift' => 'ml-2',
                ],
                [
                    'text' => 'Peserta BPJS',
                    'icon' => 'fas fa-id-card',
                    'url' => 'bpjs/vclaim/peserta-bpjs',
                    'shift' => 'ml-2',
                    'can' => 'bpjs-vclaim',
                ],
                [
                    'text' => 'PRB',
                    'icon'    => 'fas fa-first-aid',
                    'url'  => 'vclaim/prb',
                    'can' => 'bpjs-vclaim',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Referensi',
                    'icon'    => 'fas fa-info-circle',
                    'url'  => 'bpjs/vclaim/referensi',
                    'can' => 'bpjs-vclaim',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Surat Kontrol',
                    'icon'    => 'fas fa-file-medical',
                    'url'  => 'bpjs/vclaim/surat-kontrol',
                    'shift'   => 'ml-2',
                    'can' => 'bpjs-vclaim',
                ],
                [
                    'text' => 'Rujukan',
                    'icon'    => 'fas fa-comment-medical',
                    'url'  => 'bpjs/vclaim/rujukan',
                    'shift'   => 'ml-2',
                    'can' => 'bpjs-vclaim',
                ],
                [
                    'text' => 'SEP',
                    'icon'    => 'fas fa-file-medical',
                    'url'  => 'bpjs/vclaim/sep',
                    'shift'   => 'ml-2',
                    'can' => 'bpjs-vclaim',
                ],
            ],
        ],
        // INACBG
        [
            'text'    => 'INACBG',
            'icon'    => 'fas fa-project-diagram',
            'can' => ['inacbg'],
            'submenu' => [
                [
                    'text' => 'Token',
                    'icon'    => 'fas fa-key',
                    'url'  => 'satusehat/token',
                    'shift'   => 'ml-2',
                    'can' => ['inacbg'],
                ],
            ],
        ],
        // SATU SEHAT
        [
            'text'    => 'Satu Sehat',
            'icon'    => 'fas fa-project-diagram',
            'can' => ['satu-sehat'],
            'submenu' => [
                [
                    'text' => 'Token',
                    'icon'    => 'fas fa-key',
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
                    'icon'    => 'fas fa-hospital-user',
                    'url'  => 'satusehat/encounter',
                    'shift'   => 'ml-2',
                    'active'  => ['satusehat/encounter', 'satusehat/encounter/*'],
                    'can' => ['satu-sehat'],
                ],
                [
                    'text' => 'Condition',
                    'icon'    => 'fas fa-file-medical-alt',
                    'url'  => 'satusehat/condition',
                    'shift'   => 'ml-2',
                    'can' => ['satu-sehat'],
                ],
            ],
        ],
        // PENGATURAN
        [
            'text'    => 'Pengaturan',
            'icon' => 'fas fa-cogs',
            'submenu' => [
                [
                    'text' => 'Pengaturan Rawat Jalan',
                    'icon' => 'fas fa-hand-holding-medical',
                    'shift'   => 'ml-2',
                    'submenu' => [
                        [
                            'text' => 'Data Unit',
                            'shift'   => 'ml-3',
                            'url' => 'unit',
                            'icon' => 'fas fa-clinic-medical',
                            'can' => 'data-unit',

                        ],
                        [
                            'text' => 'Data Jadwal Dokter',
                            'url' => 'rajal/pendaftaran/jadwaldokter',
                            'icon' => 'fas fa-calendar',
                            'shift'   => 'ml-3',
                            'can' => 'data-jadwaldokter',
                        ],

                        [
                            'text' => 'Diagnosa',
                            'url' => 'diagnosa',
                            'icon' => 'fas fa-diagnoses',
                            'shift'   => 'ml-3',
                            'can' => 'data-diagnosa',
                        ],
                        [
                            'text' => 'Wilayah Indonesia',
                            'url' => 'wilayah-indonesia',
                            'icon' => 'fas fa-globe-asia',
                            'shift'   => 'ml-3',
                            'can' => 'data-wilayah-indonesia',
                        ],
                    ]
                ],
                [
                    'text' => 'Pengaturan Gawat Darurat',
                    'icon' => 'fas fa-ambulance',
                    'shift'   => 'ml-2',
                    'submenu' => []
                ],
                [
                    'text' => 'Pengaturan Rawat Inap',
                    'icon' => 'fas fa-procedures',
                    'shift'   => 'ml-2',
                    'submenu' => [
                        [
                            'text' => 'Kamar & Bed',
                            'url' => 'kamar-bed',
                            'icon' => 'fas fa-bed',
                            'shift'   => 'ml-3',
                            'can' => 'ranap-pendaftaran',
                        ],
                    ]
                ],
                [
                    'text' => 'Role & Permission',
                    'url' => 'role-permission',
                    'icon' => 'fas fa-users-cog',
                    'shift'   => 'ml-2',
                    'can' => 'data-role',
                ],
                [
                    'text' => 'User',
                    'url' => 'user',
                    'can' => 'data-pegawai',
                    'icon' => 'fas fa-users',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Intergrasi',
                    'url' => 'integration',
                    'icon' => 'fas fa-cloud-upload-alt',
                    'shift'   => 'ml-2',
                    'can' => 'data-pegawai',

                ],
                [
                    'text' => 'Pengaturan Antrian BPJS',
                    'url' => 'bpjs/antrian/pengaturan',
                    'can' => 'bpjs-antrian',
                    'icon' => 'fas fa-users',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Pengaturan Vclaim BPJS',
                    'url' => 'bpjs/vclaim/pengaturan',
                    'can' => 'bpjs-vclaim',
                    'icon' => 'fas fa-briefcase-medical',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Pengaturan Satu Sehat',
                    'url' => 'pengaturan-satusehat',
                    'icon' => 'fas fa-laptop-medical',
                    'shift'   => 'ml-2',
                    'can' => 'satusehat',
                ],
                [
                    'text' => 'Pengaturan Whatssapp',
                    'url' => 'pengaturan-whatsapp',
                    'icon' => 'fab fa-whatsapp',
                    'can' => 'data-whatsapp',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Pengaturan Aplikasi',
                    'url' => 'pengaturan-aplikasi',
                    'icon' => 'fas fa-cogs',
                    'shift'   => 'ml-2',
                    'can' => 'data-aplikasi',
                ],
                [
                    'text' => 'Log Aktifitas',
                    'url' => 'log-aktifitas',
                    'icon' => 'fas fa-history',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Log Developer',
                    'url' => 'log-viewer',
                    'icon' => 'fas fa-history',
                    'shift'   => 'ml-2',
                    'can' => 'data-aplikasi',
                ],
            ],
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
