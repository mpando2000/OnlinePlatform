
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
    {{-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
    </a> --}}
    <div class="navbar-search-block">
        <form class="form-inline" action="{{ route('search') }}" method="GET">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" name="query" placeholder="Search" aria-label="Search" required>
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</li>

  

      <li class="nav-item">
        <button type="button" class="nav-link theme-toggle" id="theme-toggle" aria-label="Switch to dark theme" aria-pressed="false" title="Switch to dark theme">
          <i class="fas fa-moon theme-icon-moon" aria-hidden="true"></i>
          <i class="fas fa-sun theme-icon-sun" aria-hidden="true"></i>
          <span class="theme-toggle-label">Dark theme</span>
        </button>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link px-3" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i> 
        </a>
        <form id="logout-form" action="/logout" method="POST" style="display: none;">
            @csrf
        </form>
      </li>
    </ul>
</nav>

<script>
(function () {
    const toggle = document.getElementById('theme-toggle');
    if (!toggle) return;

    const label = toggle.querySelector('.theme-toggle-label');

    function syncThemeControl() {
        const darkMode = document.documentElement.classList.contains('theme-dark');
        const action = darkMode ? 'light' : 'dark';
        toggle.setAttribute('aria-pressed', darkMode ? 'true' : 'false');
        toggle.setAttribute('aria-label', 'Switch to ' + action + ' theme');
        toggle.setAttribute('title', 'Switch to ' + action + ' theme');
        if (label) label.textContent = darkMode ? 'Light theme' : 'Dark theme';
    }

    toggle.addEventListener('click', function () {
        const darkMode = document.documentElement.classList.toggle('theme-dark');
        try {
            localStorage.setItem('elearning-theme', darkMode ? 'dark' : 'light');
        } catch (error) {
            // The theme still works for this page even without browser storage.
        }
        syncThemeControl();
    });

    syncThemeControl();
})();
</script>
