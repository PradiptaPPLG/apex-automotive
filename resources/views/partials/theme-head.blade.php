{{--
    Theme Head Partial — include in every page's <head> BEFORE closing </head>
    Provides:
     1. CSS variable definitions for dark + light themes
     2. FOUC-prevention: applies saved theme instantly from localStorage
     3. JS helper: toggleGlobalTheme(), updateThemeBtn()
--}}
<style>
    :root {
        /* Dark defaults */
        --bg-main:     #080810;
        --bg-surface:  rgba(12, 12, 20, 0.97);
        --bg-card:     rgba(17, 17, 28, 0.75);
        --bg-input:    rgba(255, 255, 255, 0.05);
        --bg-hover:    rgba(255, 255, 255, 0.04);
        --border:      rgba(255, 255, 255, 0.08);
        --border-soft: rgba(255, 255, 255, 0.05);
        --text-base:   #e5e7eb;
        --text-heading:#ffffff;
        --text-muted:  #9ca3af;
        --text-dim:    #6b7280;
        --text-dimmer: #4b5563;
    }
    html.light {
        --bg-main:     #f3f4f6;
        --bg-surface:  rgba(255, 255, 255, 0.97);
        --bg-card:     #ffffff;
        --bg-input:    #f9fafb;
        --bg-hover:    #f3f4f6;
        --border:      #e5e7eb;
        --border-soft: #e5e7eb;
        --text-base:   #1f2937;
        --text-heading:#111827;
        --text-muted:  #4b5563;
        --text-dim:    #6b7280;
        --text-dimmer: #9ca3af;
    }
    /* Smooth transitions */
    body, nav, aside, header, main, .admin-nav, .portal-nav, .nav, .card,
    .sidebar, .topbar, .main-wrapper, .content-body,
    .card-panel, .vip-card-box, .form-card, .inquiry-card,
    .pipeline-step, .stat-card, .messages-container, .chat-input-area,
    .chat-input, .sidebar-inner, .message-bubble, .status-select,
    .form-input, .form-select, input, select, textarea, table, thead, tbody, tr, td, th {
        transition: background-color 0.28s ease, color 0.28s ease, border-color 0.28s ease !important;
    }

    /* ── Theme toggle button used across all pages ── */
    .apex-theme-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 4px;
        border: 1px solid var(--border);
        background: var(--bg-input);
        color: var(--text-heading);
        font-family: 'Space Mono', monospace;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.1em;
        cursor: pointer;
        text-transform: uppercase;
        transition: all 0.2s ease;
        white-space: nowrap;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    }
    .apex-theme-btn:hover {
        border-color: #ef4444;
        background: var(--bg-hover);
    }
</style>
<script>
    /* Apply theme before first paint to avoid flash */
    (function () {
        var t = localStorage.getItem('apex_theme') || 'dark';
        var h = document.documentElement;
        if (t === 'light') {
            h.classList.add('light');
            h.classList.remove('dark');
        } else {
            h.classList.add('dark');
            h.classList.remove('light');
        }
    })();

    function toggleGlobalTheme() {
        var isLight = document.documentElement.classList.contains('light');
        var newTheme = isLight ? 'dark' : 'light';
        var h = document.documentElement;
        if (newTheme === 'light') {
            h.classList.add('light');
            h.classList.remove('dark');
        } else {
            h.classList.add('dark');
            h.classList.remove('light');
        }
        localStorage.setItem('apex_theme', newTheme);
        _syncThemeBtns(newTheme);
    }

    function _syncThemeBtns(theme) {
        var icon  = theme === 'light' ? 'fa-sun' : 'fa-moon';
        var label = theme === 'light' ? 'LIGHT' : 'DARK';
        var iconColor = theme === 'light' ? '#f59e0b' : '#818cf8';
        document.querySelectorAll('.apex-theme-btn').forEach(function (btn) {
            btn.innerHTML =
                '<i class="fa-solid ' + icon + '" style="color:' + iconColor + ';"></i> ' + label + ' MODE';
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        var saved = localStorage.getItem('apex_theme') || 'dark';
        _syncThemeBtns(saved);
    });
</script>
