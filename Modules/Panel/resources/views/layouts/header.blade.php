<header id="topnav">

    <!-- Topbar Start -->
    <div class="navbar-custom">
        <div class="container-fluid">
            <ul class="list-unstyled topnav-menu float-right mb-0">

                <li class="dropdown notification-list">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle nav-link">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        @if (auth()->user()->pic)
                            <img src="{{ route('user.avatarShow', [auth()->user()->pic, 'userAvatar']) }}"
                                alt="تصویر کاربر" class="rounded-circle">
                        @else
                            <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="تصویر کاربر"
                                class="rounded-circle">
                        @endif
                        <span class="pro-user-name ml-1">
                            {{ auth()->user()->name }} <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">خوش اومدی!</h6>
                        </div>

                        <!-- item-->
                        <a href="{{ route('panel.user.profile') }}" class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>حساب کاربری</span>
                        </a>

                        <a href="{{ route('panel.ticket.tickets') }}" class="dropdown-item notify-item">
                            <i class="fe-message-circle"></i>
                            <span>پیام ها</span>
                            @if ($unSeenCount)
                                <div class="float-right"><span
                                        class="badge badge-danger badge-pill">{{ $unSeenCount }}</span></div>
                            @endif
                        </a>

                        <!-- item-->
                        <a href="{{ route('auth.logout') }}" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>خروج</span>
                        </a>

                    </div>
                </li>

                {{--                <li class="dropdown notification-list"> --}}
                {{--                    <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect"> --}}
                {{--                        <i class="fe-settings noti-icon"></i> --}}
                {{--                    </a> --}}
                {{--                </li> --}}

            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="{{ route('home') }}" class="logo text-center">
                    <img src="{{ asset('assets-front/img/fav.png') }}" alt="تصویر" height="45">
                </a>
            </div>

        </div> <!-- end container-fluid-->
    </div>
    <!-- end Topbar -->

    <div class="topbar-menu">
        <div class="container-fluid">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu position-relative">

                    <li class="has-submenu">
                        <a href="{{ route('panel') }}">
                            <i class="mdi mdi-view-dashboard"></i>
                            <span> پیشخوان </span>
                        </a>
                    </li>

                    @if(auth()->user()->can('UserPermission')
                    || auth()->user()->can('RolePermission')
                    || auth()->user()->can('CategoryPermission')
                    || auth()->user()->can('CommentPermission'))
                        <li class="has-submenu">
                            <a href="#">
                                <i class="mdi mdi-settings-box"></i>
                                <span>مدیریت <div class="arrow-down"></div></span>
                            </a>
                            <ul class="submenu">
                                @can('UserPermission')
                                <li>
                                    <a href="{{ route('panel.user.users') }}">
                                        <i class="mdi mdi-account-multiple"></i>
                                        <span>کاربران</span>
                                    </a>
                                </li>
                                @endcan
                                    @can('RolePermission')
                                        <li>
                                            <a href="{{ route('panel.role.roles') }}">
                                                <i class="mdi mdi-shield-key"></i>
                                                <span>نقش ها</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('CategoryPermission')
                                        <li>
                                            <a href="{{ route('panel.category.categories') }}">
                                                <i class="mdi mdi-puzzle"></i>
                                                <span>دسته بندی</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('CommentPermission')
                                        <li>
                                            <a href="{{ route('panel.comment.comments') }}">
                                                <i class="mdi mdi-comment"></i>
                                                <span>نظرات</span>
                                            </a>
                                        </li>
                                    @endcan
                            </ul>
                        </li>
                    @endif

                    <li class="has-submenu">
                        <a href="#">
                            <i class="mdi mdi-briefcase-search"></i>
                            <span> کاریابی <div class="arrow-down"></div></span>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('panel.request.requests') }}">
                                    <i class="mdi mdi-briefcase-search"></i>
                                    <span> درخواست های شغلی </span>
                                </a>
                            </li>
                            @if (auth()->user()->companies->count() || auth()->user()->can('AnnouncementPermission'))
                                <li>
                                    <a href="{{ route('panel.company.companies') }}">
                                        <i class="mdi mdi-office-building"></i>
                                        <span>شرکت ها</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('panel.announcement.announcements') }}">
                                        <i class="mdi mdi-bugle"></i>
                                        <span>آگهی ها</span>
                                    </a>
                                </li>
                            @elseif(auth()->user()->employer)
                                <li>
                                    <a href="{{ route('panel.company.companiesCreate') }}">
                                        <i class="mdi mdi-office-building"></i>
                                        <span>ثبت شرکت و آگهی</span>
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->announcements->count() || auth()->user()->can('RequestPermission'))
                                <li>
                                    <a href="{{ route('panel.request.allRequests') }}">
                                        <i class="mdi mdi-briefcase-search-outline"></i>
                                        <span>درخواست ها</span>
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('panel.resume.resume') }}">
                                    <i class="mdi mdi-account-badge"></i>
                                    <span>رزومه ساز</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                        <li>
                            <a href="{{ route('panel.counselor.counselorsPanel') }}">
                                <i class="mdi mdi-account-supervisor"></i>
                                <span>مشاوره</span>
                            </a>
                        </li>

                    @if(auth()->user()->universities->count() || auth()->user()->can('UniversityPermission'))
                    <li class="has-submenu">
                        <a href="#">
                            <i class="mdi mdi-school"></i>
                            <span> دانشگاه <div class="arrow-down"></div></span>
                        </a>
                        <ul class="submenu">
                                <li>
                                    <a href="{{ route('panel.university.universities') }}">
                                        <i class="mdi mdi-book-open-page-variant"></i>
                                        <span>لیست دانشگاه ها</span>
                                    </a>
                                </li>
                            <li>
                                <a href="{{ route('panel.visit.visits') }}">
                                    <i class="mdi mdi-movie-outline"></i>
                                    <span>بازدید های صنعتی</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('panel.post.posts') }}">
                                    <i class="mdi mdi-clipboard-text-outline"></i>
                                    <span>مطالب</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('panel.intership.interships') }}">
                                    <i class="mdi mdi-worker"></i>
                                    <span>کارآموزی</span>
                                </a>
                            </li>
                            </ul>
                        </li>
                    @endif
                    @if(auth()->user()->announcements->count())
                        <li>
                            <a href="{{ route('panel.intership.interships') }}">
                                <i class="mdi mdi-worker"></i>
                                <span>کارآموزی دانشگاهی</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('panel.incentive.incentives') }}">
                            <i class="mdi mdi-shield"></i>
                            <span>مشوق های خدمتی</span>
                        </a>
                    </li>

                    @if (auth()->user()->courses->count() || auth()->user()->hasRole('teacher') || auth()->user()->teachers->count() || auth()->user()->universities->count() || auth()->user()->can('CoursePermission'))
                        <li>
                            <a href="{{ route('panel.course.courses') }}">
                                <i class="mdi mdi-youtube-tv"></i>
                                <span>دوره ها</span>
                            </a>
                        </li>
                    @endif

                    <li class="has-submenu">
                        <a href="#">
                            <i class="mdi mdi-wallet"></i>
                            <span>کیف پول
                                <div class="arrow-down"></div>
                            </span>
                        </a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('panel.wallet.wallet') }}">
                                    <i class="mdi mdi-wallet"></i>
                                    <span>کیف پول</span>
                                </a>
                            </li>
                            @can('CardPermission')
                            <li>
                                <a href="{{ route('panel.card.cards') }}">
                                    <i class="mdi mdi-cards"></i>
                                    <span>کارت های بانکی</span>
                                </a>
                            </li>
                            @endcan
                            @can('WithdrawPermission')
                            <li>
                                <a href="{{ route('panel.withdraw.withdraws') }}">
                                    <i class="mdi mdi-clipboard-arrow-down"></i>
                                    <span>برداشت ها</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>


                </ul>
                <!-- End navigation menu -->

                <div class="clearfix"></div>
            </div>
            <div class="my-wallet">
                <span> <i class="fas fa-wallet"></i>کیف پول من</span>
                <span>اعتبار: {{ (auth()->user()->wallet) ? number_format(auth()->user()->wallet->balance) : 0; }} تومان</span>
            </div>
            <!-- end #navigation -->
        </div>
        <!-- end container -->
    </div>
    <!-- end navbar-custom -->

</header>
