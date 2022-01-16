<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li>
            <a class="menu-item" href="#" data-i18n="nav.templates.vert.main"><i class="la la-user"></i>Users</a>
            <ul class="menu-content">
                <li><a class="menu-item" href="{{route('admin.index')}}" data-i18n="nav.templates.vert.classic_menu">Admins</a></li>
                <li><a class="menu-item" href="{{route('client.index')}}" data-i18n="nav.templates.vert.classic_menu">Students</a></li>
            </ul>
        </li>

        <li class=" nav-item"><a href="{{route('registraions.index')}}"><i class="la la-list"></i><span class="menu-title" data-i18n="nav.changelog.main">Registrations Froms</span></a></li>

        <li class=" nav-item"><a href="{{route('financial_titles.index')}}"><i class="la la-list"></i><span class="menu-title" data-i18n="nav.changelog.main">Receipts</span></a></li>

        <li class=" nav-item"><a href="{{route('financial.index')}}"><i class="la la-list"></i><span class="menu-title" data-i18n="nav.changelog.main">Participants</span></a></li>

        <li class=" nav-item"><a href="{{route('category.news.index')}}"><i class="la la-list"></i><span class="menu-title" data-i18n="nav.changelog.main">Our new categories</span></a></li>

        <li class=" nav-item"><a href="{{route('news.index')}}"><i class="la la-newspaper-o"></i><span class="menu-title" data-i18n="nav.changelog.main">Our news</span></a></li>

        <li class=" nav-item"><a href="{{route('social.index')}}"><i class="la la-forumbee"></i><span class="menu-title" data-i18n="nav.changelog.main">Social media</span></a></li>


        <li class=" nav-item"><a href="{{route('concat.index')}}"><i class="la la-envelope-o"></i><span class="menu-title" data-i18n="nav.changelog.main">Customers Messages</span></a></li>

      </ul>
    </div>
  </div>
