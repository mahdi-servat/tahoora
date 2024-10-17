
<?php
$menu = [
    ['title' => 'زبان ها', 'icon' => 'fa fa-language ', 'permissions' => 'language-management', 'url' => route('languages.index')],

    ['title' => 'پیکربندی سایت', 'icon' => 'fa fa-cog ', 'permissions' => '', 'url' => '',
        'children' => [
            ['title' => 'شبکه های اجتماعی', 'icon' => 'fa fa-bars ', 'permissions' => '', 'url' => route('socialMedia.chooseLanguage')],
            ['title' => 'منوی سایت', 'icon' => 'fa fa-bars ', 'permissions' => '', 'url' => route('menu.index')],
//            ['title' => 'فوتر سایت', 'icon' => 'fa fa-bars ', 'permissions' => '', 'url' => route('footer.index')],
            ['title' => 'عنوان های ثابت', 'icon' => 'fa fa-bars ', 'permissions' => '', 'url' => route('pageSettingData.chooseLanguage')],
        ]
    ],
    ['title' => 'دسته بندی', 'icon' => 'fas fa-newspaper', 'permissions' => '', 'url' => '',
        'children' => [
            ['title' => 'خدمات', 'icon' => 'fa fa-bars ', 'permissions' => '', 'url' => route('category.index', 'search=category_type_id:3')],
            ['title' => 'اخبار', 'icon' => 'fa fa-bars ', 'permissions' => '', 'url' => route('category.index', 'search=category_type_id:1')],
            ['title' => 'مقالات', 'icon' => 'fa fa-bars ', 'permissions' => '', 'url' => route('category.index', 'search=category_type_id:2')],
            ['title' => 'پزشکان', 'icon' => 'fa fa-bars ', 'permissions' => '', 'url' => route('category.index', 'search=category_type_id:4')],
        ]
    ],
    ['title' => 'محتوای سایت', 'icon' => 'fas fa-newspaper', 'permissions' => '', 'url' => '',
        'children' => [
            ['title' => 'اخبار', 'icon' => 'fa fa-bars', 'permissions' => '', 'url' => route('news.index')],
            ['title' => 'مقالات', 'icon' => 'fa fa-bars', 'permissions' => '', 'url' => route('article.index')],
            ['title' => 'گالری', 'icon' => 'fa fa-bars', 'permissions' => '', 'url' => route('media.index')],
            ['title' => 'صفحات ایستا', 'icon' => 'fa fa-bars', 'permissions' => '', 'url' => route('page.index')],
            ['title' => 'پزشکان', 'icon' => 'fa fa-bars', 'permissions' => '', 'url' => route('artist.index')],
            ['title' => 'خدمات', 'icon' => 'fa fa-bars', 'permissions' => '', 'url' => route('museum.index')],
            ['title' => 'توصیفات', 'icon' => 'fa fa-bars', 'permissions' => '', 'url' => route('testimonial.index')],
            ['title' => 'اسلایدر', 'icon' => 'fa fa-bars', 'permissions' => '', 'url' => route('slider.index')],
        ]
    ],
    ['title' => 'مدیریت کاربران', 'icon' => 'fa fa-user', 'permissions' => '', 'url' => '',
        'children' => [
            ['title' => ' کاربران', 'icon' => 'fa fa-bars ', 'permissions' => '', 'url' => route('user.index')],
            ['title' => ' دسترسی ها/نقش ها', 'icon' => 'fa fa-bars ', 'permissions' => '', 'url' => route('role.index')],
        ]
    ],

    ['title' => 'آمار', 'icon' => 'fa fa-pie-chart', 'permissions' => '', 'url' => route('admin.insight')],
    ['title' => 'دیدگاه', 'icon' => 'fa fa-comment', 'permissions' => '', 'url' => route('comment.index')],
];
?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{env('APP_URL')}}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bold">
                {{env('APP_NAME')}}
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        @foreach($menu as $item)
                <?php
                $children = (!empty($item['children']) && (count($item['children']) > 0));
                $active = request()->fullUrl() == $item['url'];
                $open = false;
                if ($children) {
                    foreach ($item['children'] as $item2) {
                        if (request()->fullUrl() == $item2['url']) {
                            $open = true;
                        }
                    }
                }
                ?>
            <li class="menu-item {{$active ? 'active' : null}} {{$open ? 'open' : null}}">
                <a href="{{$children ? 'javascript:void(0);' : $item['url']}}"
                   class="menu-link {{$children? 'menu-toggle' : null}}">
                    <i class="menu-icon {{$item['icon']}}"></i>
                    <div class="ms-2">{{$item['title']}}</div>
                </a>
                @if($children)
                    <ul class="menu-sub">
                        @foreach($item['children'] as $item2)
                                <?php
                                $active2 = request()->fullUrl() == $item2['url'];
                                ?>
                            <li class="menu-item {{$active2? 'active' : null}}">
                                <a href="{{$item2['url']}}" class="menu-link">
                                    <div>{{$item2['title']}}</div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
    </ul>
</aside>
