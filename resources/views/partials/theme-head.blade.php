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
        var h = document.documentElement;
        var isLight = h.classList.contains('light');
        var newTheme = isLight ? 'dark' : 'light';
        
        var overlay = document.getElementById('pixel-transition-overlay');
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.id = 'pixel-transition-overlay';
            overlay.style.position = 'fixed';
            overlay.style.top = '0';
            overlay.style.left = '0';
            overlay.style.width = '100vw';
            overlay.style.height = '100vh';
            overlay.style.zIndex = '999999';
            overlay.style.pointerEvents = 'none';
            overlay.style.display = 'grid';
            overlay.style.gridTemplateColumns = 'repeat(12, 1fr)';
            overlay.style.gridTemplateRows = 'repeat(8, 1fr)';
            document.body.appendChild(overlay);
        }
        
        overlay.style.display = 'grid';
        if (overlay.classList) overlay.classList.remove('hidden');
        overlay.innerHTML = '';
        
        var cols = 12;
        var rows = 8;
        var totalTiles = cols * rows;
        var tileColor = newTheme === 'light' ? '#f5f5f5' : '#0a0a0a';
        var tileBorder = newTheme === 'light' ? 'rgba(0, 0, 0, 0.15)' : 'rgba(255, 255, 255, 0.15)';
        
        for (var i = 0; i < totalTiles; i++) {
            var tile = document.createElement('div');
            tile.style.backgroundColor = tileColor;
            tile.style.border = '1px solid ' + tileBorder;
            tile.style.opacity = '0';
            tile.style.transform = 'scale(0.5)';
            tile.style.transition = 'all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
            
            var col = i % cols;
            tile.style.transitionDelay = (col * 0.05) + 's';
            
            overlay.appendChild(tile);
        }
        
        // Trigger in animation
        setTimeout(function() {
            var tiles = overlay.children;
            for (var i = 0; i < tiles.length; i++) {
                tiles[i].style.opacity = '1';
                tiles[i].style.transform = 'scale(1.05)';
            }
        }, 10);
        
        // Toggle theme when screen is mostly covered
        setTimeout(function() {
            if (newTheme === 'light') {
                h.classList.add('light');
                h.classList.remove('dark');
            } else {
                h.classList.add('dark');
                h.classList.remove('light');
            }
            localStorage.setItem('apex_theme', newTheme);
            _syncThemeBtns(newTheme);
            
            // Re-sync thumb in dashboard if it exists
            var toggleThumb = document.getElementById('toggleThumb');
            if (toggleThumb) {
                toggleThumb.style.transform = newTheme === 'dark' ? 'translateX(32px)' : 'translateX(0)';
            }
        }, 600);
        
        // Trigger out animation
        setTimeout(function() {
            var tiles = overlay.children;
            for (var i = 0; i < tiles.length; i++) {
                tiles[i].style.opacity = '0';
                tiles[i].style.transform = 'scale(0)';
            }
        }, 700);
        
        // Cleanup
        setTimeout(function() {
            overlay.style.display = 'none';
            if (overlay.classList) overlay.classList.add('hidden');
            overlay.innerHTML = '';
        }, 1500);
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
