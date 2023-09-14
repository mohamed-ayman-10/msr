<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                        fill="#7367F0" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                        fill="#7367F0" />
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold">Vuexy</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Page -->
        <li class="menu-item @yield('dashboard')">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-dashboard"></i>
                <div data-i18n="Page 1">الرئيسية</div>
            </a>
        </li>
        <li class="menu-item @yield('home')">
            <a href="{{ route('home.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-home"></i>
                <div data-i18n="Page 1">الصفحة الرئيسية</div>
            </a>
        </li>
        <li class="menu-item @yield('menu') @yield('sub-menu')">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
                <div data-i18n="Layouts">القوائم</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item @yield('menu')">
                    <a href="{{ route('menu.index') }}" class="menu-link">
                        <div data-i18n="Collapsed menu">القوائم الرئيسية</div>
                    </a>
                </li>
                <li class="menu-item @yield('sub-menu')">
                    <a href="{{ route('sub-menu.index') }}" class="menu-link">
                        <div data-i18n="Collapsed menu">القوائم الفرعية والصفحات</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item @yield('objective') @yield('vision') @yield('plan') @yield('chart') @yield('committee') @yield('boss')">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
                <div data-i18n="Layouts">عن الجمعية</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item @yield('objective')">
                    <a href="{{ route('association.value.index') }}" class="menu-link">
                        <div data-i18n="Collapsed menu">الاهداف</div>
                    </a>
                </li>
                <li class="menu-item @yield('vision')">
                    <a href="{{ route('association.vision.index') }}" class="menu-link">
                        <div data-i18n="Collapsed menu">الرؤية والرسالة والقيم</div>
                    </a>
                </li>
                <li class="menu-item @yield('plan')">
                    <a href="{{ route('association.plan.index') }}" class="menu-link">
                        <div data-i18n="Collapsed menu">الخطط والأهداف التشغيلية</div>
                    </a>
                </li>
                <li class="menu-item @yield('chart')">
                    <a href="{{ route('association.chart.index') }}" class="menu-link">
                        <div data-i18n="Collapsed menu">الهيكل التنظيمي</div>
                    </a>
                </li>
                <li class="menu-item @yield('committee')">
                    <a href="{{ route('association.committee.index') }}" class="menu-link">
                        <div data-i18n="Collapsed menu">لجان الجمعية</div>
                    </a>
                </li>
                <li class="menu-item @yield('boss')">
                    <a href="{{ route('association.boss.index') }}" class="menu-link">
                        <div data-i18n="Collapsed menu">المدير التنفيذي</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item @yield('blog')">
            <a href="{{ route('blog.index') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-news"></i>
                <div data-i18n="Page 1">الاخبار</div>
            </a>
        </li>
    </ul>
</aside>
