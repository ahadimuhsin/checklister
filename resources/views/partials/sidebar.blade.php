<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <ul class="c-sidebar-nav">
        @if(auth()->user()->is_admin)
        <li class="c-sidebar-nav-title">{{ __('Manage Checklists') }}</li>
        @foreach ($admin_menu as $group)
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown c-show">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle"
                href="{{ route('admin.checklist-groups.edit', $group->id) }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-folder-open') }}"></use>
                </svg> {{ $group->name }}</a>
            <ul class="c-sidebar-nav-dropdown-items">
                @foreach ($group->checklists as $checklist)
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" style="padding: .5rem .5rem .5rem 76px"
                        href="{{ route('admin.checklist-groups.checklists.edit', [$group, $checklist]) }}">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-list') }}"></use>
                        </svg>
                        {{ $checklist->name }}</a>
                </li>
                @endforeach

                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" style="padding: 1rem .5rem .5rem 76px"
                        href="{{ route('admin.checklist-groups.checklists.create', $group->id) }}">
                        <svg class="c-sidebar-nav-icon">
                            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-library-add') }}"></use>
                        </svg>
                        {{ __('New Checklist') }}</a>
                </li>
            </ul>
        </li>
        @endforeach
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link" href="{{ route('admin.checklist-groups.create') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-note-add') }}"></use>
                </svg>
                {{ __('New Checklist Group') }}</a>
        </li>

        <li class="c-sidebar-nav-title">{{ __('Pages') }}</li>
        @foreach (\App\Models\Page::all() as $page)
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link" href="{{ route('admin.pages.edit', $page) }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-puzzle') }}"></use>
                </svg> {{ $page->title }}
            </a>
            {{-- <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/breadcrumb.html"><span class="c-sidebar-nav-icon"></span> Breadcrumb</a></li>
                </ul> --}}
        </li>
        @endforeach

        <li class="c-sidebar-nav-title">{{ __('Manage Data') }}</li>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link" href="{{ route('admin.user.index') }}">
                <svg class="c-sidebar-nav-icon">
                    <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-puzzle') }}"></use>
                </svg> {{ __('Users') }}
            </a>
            {{-- <ul class="c-sidebar-nav-dropdown-items">
                    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="base/breadcrumb.html"><span class="c-sidebar-nav-icon"></span> Breadcrumb</a></li>
                </ul> --}}
        </li>
        @else
            @foreach ($user_menu as $group)
            <li class="c-sidebar-nav-title">{{ $group['name'] }}
                @if($group['is_new'])
                <span class="badge badge-info">NEW</span>
                @elseif ($group['is_updated'])
                <span class="badge badge-info">UPDATED</span>
                @endif
            </li>
                    @foreach ($group['checklists'] as $checklist)
                    <li class="c-sidebar-nav-item">
                        <a class="c-sidebar-nav-link"
                            href="{{ route('users.checklists.show', [$checklist['id']]) }}">
                            <svg class="c-sidebar-nav-icon">
                                <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-list') }}"></use>
                            </svg>
                            {{ $checklist['name']}}
                                @if($checklist['is_new'])
                                <span class="badge badge-info">NEW</span>
                                @elseif ($checklist['is_updated'])
                                <span class="badge badge-info">UPDATED</span>
                                @endif
                        </a>

                    </li>
                    @endforeach
            @endforeach
        @endif
        {{-- <li class="c-sidebar-nav-title">{{ __('Other') }}</li> --}}
        {{-- <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <svg class="c-sidebar-nav-icon">
            <use xlink:href="{{ asset('vendors/@coreui/icons/svg/free.svg#cil-speedometer') }}"></use>
        </svg> {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        </li> --}}
    </ul>
    <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
        data-class="c-sidebar-minimized"></button>
</div>
