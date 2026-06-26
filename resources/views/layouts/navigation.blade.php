<nav class="main-header navbar navbar-expand navbar-white navbar-light flex-column p-0">

    {{-- แถวบน --}}
    <div class="w-100 border-bottom px-4 py-2 d-flex justify-content-between align-items-center">

        <div class="font-weight-bold h5 mb-0">
            Ebook Library
        </div>

        <div class="d-flex align-items-center">

            <span class="mr-3 text-secondary">
                {{ Auth::user()->role_name }}
            </span>

            <a href="{{ route('profile.edit') }}"
               class="mr-3 text-dark">
                เปลี่ยนข้อมูล
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-link text-dark p-0">
                    ออกจากระบบ
                </button>
            </form>

        </div>

    </div>

    {{-- แถวล่าง --}}
    <div class="w-100 border-top px-4">

        <ul class="navbar-nav flex-row">

            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    หน้าหลัก
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('ebooks.index') }}" class="nav-link">
                    หนังสือ
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('borrows.index') }}" class="nav-link">
                    ยืม/คืน
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    Chatbot
                </a>
            </li>

            @can('admin')
            <li class="nav-item">
                <a href="#" class="nav-link">
                    จัดการ
                </a>
            </li>
            @endcan

        </ul>

    </div>

</nav>