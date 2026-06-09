<x-layout />

@include('components.nav')

<style>
/* Enhanced Sidebar Styling with Collapse Support */
.main-sidebar {
    background: linear-gradient(180deg, #1e3c72 0%, #2a5298 100%) !important;
    box-shadow: 0 0 25px rgba(0, 0, 0, 0.15) !important;
    transition: all 0.3s ease !important;
    height: 100vh !important;
    position: fixed !important;
    overflow: visible !important;
    z-index: 1050 !important;
    top: 0 !important;
    left: 0 !important;
}

/* Brand Link Styling */
.brand-link {
    background: rgba(255, 255, 255, 0.1) !important;
    border-bottom: 2px solid rgba(255, 255, 255, 0.15);
    padding: 15px !important;
    transition: all 0.3s ease !important;
    display: flex !important;
    align-items: center !important;
}

.brand-link:hover {
    background: rgba(255, 255, 255, 0.15) !important;
    text-decoration: none !important;
}

.brand-image {
    width: 35px !important;
    height: 35px !important;
    border: 2px solid rgba(255, 255, 255, 0.8) !important;
    transition: all 0.3s ease !important;
    opacity: 1 !important;
}

.brand-text {
    font-size: 1rem !important;
    font-weight: 600 !important;
    color: #fff !important;
    margin-left: 10px !important;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease !important;
}

/* Sidebar Content */
.sidebar {
    background: transparent !important;
    padding-top: 10px !important;
    height: calc(100vh - 70px) !important;
    overflow-y: auto !important;
    overflow-x: visible !important;
    position: relative !important;
    z-index: 1051 !important;
}

/* User Panel */
.user-panel {
    background: rgba(255, 255, 255, 0.08) !important;
    border-radius: 12px !important;
    margin: 10px !important;
    padding: 15px 10px !important;
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease !important;
}

.user-panel:hover {
    background: rgba(255, 255, 255, 0.12) !important;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.user-panel .image img {
    width: 40px !important;
    height: 40px !important;
    border: 2px solid rgba(255, 255, 255, 0.8) !important;
    transition: all 0.3s ease !important;
}

.user-panel .info a {
    color: #fff !important;
    font-weight: 500 !important;
    text-decoration: none !important;
    font-size: 0.9rem;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}

/* Search Form */
.form-inline {
    margin: 10px !important;
}

.input-group[data-widget="sidebar-search"] {
    border-radius: 20px !important;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.form-control-sidebar {
    background: rgba(255, 255, 255, 0.9) !important;
    border: none !important;
    color: #333 !important;
    font-size: 0.85rem;
}

.btn-sidebar {
    background: #28a745 !important;
    border: none !important;
    color: white !important;
    transition: all 0.3s ease !important;
}

.btn-sidebar:hover {
    background: #20c997 !important;
}

/* Navigation Items */
.nav-sidebar .nav-item {
    margin: 5px 8px !important;
}

.nav-sidebar .nav-link {
    background: rgba(255, 255, 255, 0.06) !important;
    color: rgba(255, 255, 255, 0.9) !important;
    padding: 12px 15px !important;
    border-radius: 10px !important;
    margin: 0 !important;
    transition: all 0.3s ease !important;
    border: 1px solid rgba(255, 255, 255, 0.05);
    display: flex !important;
    align-items: center !important;
}

.nav-sidebar .nav-link:hover:not(.active) {
    background: rgba(40, 167, 69, 0.2) !important;
    color: #fff !important;
    transform: translateX(5px);
    border-color: rgba(40, 167, 69, 0.4);
    box-shadow: 0 3px 10px rgba(40, 167, 69, 0.2);
    text-decoration: none !important;
}

.nav-sidebar .nav-link.active:hover {
    transform: translateX(8px) !important;
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.6), 0 4px 12px rgba(40, 167, 69, 0.4) !important;
}

.nav-sidebar .nav-link.active {
    background: linear-gradient(135deg, #28a745, #20c997) !important;
    color: #fff !important;
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.5), 0 2px 8px rgba(40, 167, 69, 0.3) !important;
    border: 2px solid rgba(255, 255, 255, 0.3) !important;
    border-left: 4px solid #ffffff !important;
    position: relative !important;
    overflow: hidden !important;
    transform: translateX(8px) !important;
    font-weight: 700 !important;
    z-index: 10 !important;
}

.nav-sidebar .nav-link.active::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.08));
    z-index: 1;
    pointer-events: none;
    animation: activeGlow 2s ease-in-out infinite alternate;
}

@keyframes activeGlow {
    0% {
        background: linear-gradient(45deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    }
    100% {
        background: linear-gradient(45deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
    }
}

.nav-sidebar .nav-link.active .nav-icon,
.nav-sidebar .nav-link.active p {
    position: relative;
    z-index: 2;
}

.nav-sidebar .nav-icon {
    width: 20px !important;
    text-align: center !important;
    margin-right: 12px !important;
    font-size: 1rem !important;
    transition: all 0.3s ease !important;
    color: rgba(255, 255, 255, 0.9) !important;
}

.nav-sidebar .nav-link:hover:not(.active) .nav-icon {
    color: #28a745 !important;
    transform: scale(1.1);
}

.nav-sidebar .nav-link.active .nav-icon {
    color: #ffffff !important;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
    font-size: 1.1rem !important;
    transform: scale(1.1) !important;
    filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.3));
}

.nav-sidebar .nav-link.active p {
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.4) !important;
    font-weight: 700 !important;
    letter-spacing: 0.3px !important;
}

.nav-sidebar .nav-link p {
    margin: 0 !important;
    font-weight: 500 !important;
    font-size: 0.85rem !important;
    transition: all 0.3s ease !important;
}

/* Desktop Collapsed Sidebar Styles */
.sidebar-collapse .brand-text {
    display: none !important;
}

.sidebar-collapse .user-panel .info {
    display: none !important;
}

.sidebar-collapse .form-inline {
    display: none !important;
}

.sidebar-collapse .nav-sidebar .nav-link p {
    display: none !important;
}

.sidebar-collapse .nav-sidebar .nav-link {
    padding: 0 !important;
    justify-content: center !important;
    margin: 3px auto !important;
    position: relative !important;
    width: 48px !important;
    height: 48px !important;
    display: flex !important;
    align-items: center !important;
    border-radius: 12px !important;
    overflow: visible !important;
    z-index: 1053 !important;
}

.sidebar-collapse .nav-sidebar .nav-icon {
    margin: 0 !important;
    font-size: 1.1rem !important;
    color: rgba(255, 255, 255, 0.9) !important;
    transition: all 0.3s ease !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 100% !important;
    height: 100% !important;
}

.sidebar-collapse .nav-sidebar .nav-link:hover .nav-icon {
    color: #28a745 !important;
    transform: scale(1.1) !important;
}

.sidebar-collapse .nav-sidebar .nav-link.active {
    background: linear-gradient(135deg, #28a745, #20c997) !important;
    border: 3px solid rgba(255, 255, 255, 0.4) !important;
    box-shadow: 0 0 20px rgba(40, 167, 69, 0.7), 0 0 40px rgba(40, 167, 69, 0.3) !important;
    transform: scale(1.05) !important;
    position: relative !important;
    animation: activePulse 2s ease-in-out infinite alternate;
}

@keyframes activePulse {
    0% {
        box-shadow: 0 0 20px rgba(40, 167, 69, 0.7), 0 0 40px rgba(40, 167, 69, 0.3);
        transform: scale(1.05);
    }
    100% {
        box-shadow: 0 0 25px rgba(40, 167, 69, 0.8), 0 0 50px rgba(40, 167, 69, 0.4);
        transform: scale(1.08);
    }
}

.sidebar-collapse .nav-sidebar .nav-link.active .nav-icon {
    color: #ffffff !important;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4) !important;
    font-size: 1.3rem !important;
    transform: none !important;
    filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.4));
    animation: iconGlow 2s ease-in-out infinite alternate;
}

@keyframes iconGlow {
    0% {
        filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.4));
    }
    100% {
        filter: drop-shadow(0 0 12px rgba(255, 255, 255, 0.6));
    }
}

.sidebar-collapse .user-panel {
    padding: 8px !important;
    justify-content: center !important;
    margin: 10px 5px !important;
}

/* Enhanced desktop collapsed state */
.sidebar-collapse .main-sidebar {
    width: 60px !important;
    transition: width 0.3s ease !important;
    overflow: visible !important;
    z-index: 1050 !important;
    position: fixed !important;
}

.sidebar-collapse .sidebar {
    overflow-x: visible !important;
    overflow-y: auto !important;
    padding: 5px 0 !important;
    height: calc(100vh - 70px) !important;
    display: flex !important;
    flex-direction: column !important;
    position: relative !important;
    z-index: 1051 !important;
}

.sidebar-collapse .nav-sidebar {
    overflow: visible !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: flex-start !important;
    flex: 1 !important;
    align-items: center !important;
    padding: 0 6px !important;
    position: relative !important;
    z-index: 1052 !important;
}

.sidebar-collapse .brand-link {
    justify-content: center !important;
    padding: 15px 5px !important;
    height: 70px !important;
    display: flex !important;
    align-items: center !important;
}

.sidebar-collapse .brand-image {
    margin: 0 !important;
    width: 30px !important;
    height: 30px !important;
}

/* Enhanced Tooltip for Collapsed Sidebar */
.sidebar-collapse .nav-sidebar .nav-link {
    overflow: visible !important;
    position: relative !important;
}

.sidebar-collapse .nav-sidebar .nav-link::after {
    content: attr(data-tooltip);
    position: fixed;
    left: var(--tooltip-left, 70px);
    top: var(--tooltip-top, 50%);
    transform: translateY(-50%);
    background: linear-gradient(135deg, #28a745, #20c997);
    color: white;
    padding: 12px 16px;
    border-radius: 8px;
    font-size: 0.9rem;
    font-weight: 600;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 10000 !important;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.35);
    pointer-events: none;
    min-width: max-content;
    letter-spacing: 0.3px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    max-width: 200px;
    word-wrap: break-word;
}

.sidebar-collapse .nav-sidebar .nav-link::before {
    content: '';
    position: fixed;
    left: var(--arrow-left, 62px);
    top: var(--arrow-top, 50%);
    transform: translateY(-50%);
    border: 8px solid transparent;
    border-right-color: #28a745;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 10000 !important;
    pointer-events: none;
}

.sidebar-collapse .nav-sidebar .nav-link:hover::after {
    opacity: 1;
    visibility: visible;
    transform: translateX(5px);
}

.sidebar-collapse .nav-sidebar .nav-link:hover::before {
    opacity: 1;
    visibility: visible;
    transform: translateX(5px);
}

/* Ensure main content doesn't interfere with tooltips */
.content-wrapper,
.main-content,
.content-header {
    position: relative !important;
    z-index: 999 !important;
}

/* Additional z-index fixes for AdminLTE elements */
.navbar,
.main-header {
    z-index: 1030 !important;
}

.sidebar-collapse .main-sidebar:hover {
    box-shadow: 0 0 35px rgba(0, 0, 0, 0.25) !important;
}

/* Force tooltip visibility above all content */
body.sidebar-collapse {
    overflow-x: visible !important;
}

.sidebar-collapse .nav-sidebar .nav-link:hover {
    z-index: 10001 !important;
    position: relative !important;
}

/* Ensure tooltips don't get clipped by parent containers */
.sidebar-collapse .sidebar,
.sidebar-collapse .main-sidebar,
.sidebar-collapse .nav-sidebar {
    contain: none !important;
}

/* Active item background highlight */
.nav-sidebar:has(.nav-link.active) {
    background: linear-gradient(135deg, 
        rgba(40, 167, 69, 0.05) 0%, 
        rgba(32, 201, 151, 0.05) 50%, 
        rgba(40, 167, 69, 0.05) 100%) !important;
    border-radius: 12px;
    margin: 5px;
    padding: 10px 5px;
    box-shadow: inset 0 0 20px rgba(40, 167, 69, 0.1);
}

/* Mobile Responsive Design */
@media (max-width: 768px) {
    .main-sidebar {
        position: fixed !important;
        z-index: 1040 !important;
        left: -250px !important;
        transition: left 0.3s ease !important;
        width: 250px !important;
        height: 100vh !important;
        overflow-y: auto !important;
    }
    
    .main-sidebar.sidebar-open {
        left: 0 !important;
    }
    
    /* Mobile overlay */
    body.sidebar-open::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1035;
        transition: opacity 0.3s ease;
    }
    
    /* Ensure tooltips don't show on mobile */
    .nav-sidebar .nav-link::after,
    .nav-sidebar .nav-link::before {
        display: none !important;
    }
    
    /* Mobile brand link adjustment */
    .brand-link {
        padding: 20px 15px !important;
    }
    
    /* Mobile navigation adjustments */
    .nav-sidebar .nav-link {
        padding: 15px 20px !important;
        margin: 2px 8px !important;
    }
    
    .nav-sidebar .nav-icon {
        margin-right: 15px !important;
        font-size: 1.1rem !important;
    }
}

/* Smooth Scrollbar */
.sidebar::-webkit-scrollbar {
    width: 5px;
}

.sidebar::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
}

.sidebar::-webkit-scrollbar-thumb {
    background: rgba(40, 167, 69, 0.6);
    border-radius: 3px;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: rgba(40, 167, 69, 0.8);
}

/* Remove excessive spacing */
.nav-sidebar .nav-item br {
    display: none !important;
}

/* Active Menu Indicator */
.nav-sidebar .nav-link.active::after {
    content: '';
    position: absolute;
    right: -2px;
    top: 50%;
    transform: translateY(-50%);
    width: 4px;
    height: 60%;
    background: linear-gradient(to bottom, #ffffff, rgba(255, 255, 255, 0.7));
    border-radius: 2px;
    z-index: 3;
    animation: indicatorPulse 1.5s ease-in-out infinite alternate;
}

@keyframes indicatorPulse {
    0% {
        opacity: 0.8;
        width: 4px;
    }
    100% {
        opacity: 1;
        width: 5px;
    }
}

/* Collapsed sidebar active indicator */
.sidebar-collapse .nav-sidebar .nav-link.active::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 50%;
    transform: translateX(-50%);
    width: 60%;
    height: 3px;
    background: linear-gradient(to right, rgba(255, 255, 255, 0.7), #ffffff, rgba(255, 255, 255, 0.7));
    border-radius: 2px;
    z-index: 3;
}

/* Animation on load */
.nav-sidebar .nav-item {
    animation: slideInLeft 0.6s ease forwards;
    opacity: 0;
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Stagger animation delays */
.nav-sidebar .nav-item:nth-child(1) { animation-delay: 0.1s; }
.nav-sidebar .nav-item:nth-child(2) { animation-delay: 0.2s; }
.nav-sidebar .nav-item:nth-child(3) { animation-delay: 0.3s; }
.nav-sidebar .nav-item:nth-child(4) { animation-delay: 0.4s; }
.nav-sidebar .nav-item:nth-child(5) { animation-delay: 0.5s; }
.nav-sidebar .nav-item:nth-child(6) { animation-delay: 0.6s; }
.nav-sidebar .nav-item:nth-child(7) { animation-delay: 0.7s; }
.nav-sidebar .nav-item:nth-child(8) { animation-delay: 0.8s; }
.nav-sidebar .nav-item:nth-child(9) { animation-delay: 0.9s; }
.nav-sidebar .nav-item:nth-child(10) { animation-delay: 1.0s; }
.nav-sidebar .nav-item:nth-child(11) { animation-delay: 1.1s; }
.nav-sidebar .nav-item:nth-child(12) { animation-delay: 1.2s; }

/* Quiet sidebar refresh */
.main-sidebar {
    background: #143b32 !important;
    box-shadow: 6px 0 24px rgba(15, 23, 42, 0.12) !important;
}

.brand-link {
    background: #0f2f29 !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    min-height: 58px !important;
    padding: 12px 14px !important;
}

.brand-image {
    background: #fff !important;
    border: 1px solid rgba(255, 255, 255, 0.7) !important;
    height: 32px !important;
    width: 32px !important;
}

.brand-text {
    color: #f8fafc !important;
    font-size: 0.95rem !important;
    letter-spacing: 0 !important;
    text-shadow: none !important;
}

.sidebar {
    height: calc(100vh - 58px) !important;
    padding: 10px 8px !important;
}

.user-panel {
    background: rgba(255, 255, 255, 0.08) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    border-radius: 8px !important;
    margin: 8px 0 12px !important;
    padding: 10px !important;
}

.user-panel:hover {
    box-shadow: none !important;
    transform: none !important;
}

.form-inline {
    margin: 0 0 12px !important;
}

.input-group[data-widget="sidebar-search"] {
    border-radius: 8px !important;
    box-shadow: none !important;
}

.form-control-sidebar {
    background: rgba(255, 255, 255, 0.95) !important;
    border-radius: 8px 0 0 8px !important;
    font-size: 0.82rem !important;
}

.btn-sidebar {
    background: #22c55e !important;
    border-radius: 0 8px 8px 0 !important;
}

.nav-sidebar:has(.nav-link.active) {
    background: transparent !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    margin: 0 !important;
    padding: 0 !important;
}

.nav-sidebar .nav-item {
    animation: none !important;
    margin: 4px 0 !important;
    opacity: 1 !important;
}

.nav-sidebar .nav-link {
    background: transparent !important;
    border: 1px solid transparent !important;
    border-radius: 8px !important;
    color: rgba(255, 255, 255, 0.86) !important;
    min-height: 40px !important;
    padding: 9px 11px !important;
    transition: background-color 0.15s ease, color 0.15s ease !important;
}

.nav-sidebar .nav-link:hover:not(.active) {
    background: rgba(255, 255, 255, 0.09) !important;
    border-color: rgba(255, 255, 255, 0.08) !important;
    box-shadow: none !important;
    color: #fff !important;
    transform: none !important;
}

.nav-sidebar .nav-link.active,
.sidebar-collapse .nav-sidebar .nav-link.active {
    animation: none !important;
    background: #eaf8f1 !important;
    border: 0 !important;
    border-left: 4px solid #22c55e !important;
    box-shadow: none !important;
    color: #0f2f29 !important;
    font-weight: 800 !important;
    overflow: hidden !important;
    transform: none !important;
}

.nav-sidebar .nav-link.active::before,
.nav-sidebar .nav-link.active::after,
.sidebar-collapse .nav-sidebar .nav-link.active::after,
.sidebar-collapse .nav-sidebar .nav-link.active::before {
    animation: none !important;
    display: none !important;
}

.nav-sidebar .nav-icon {
    color: inherit !important;
    font-size: 0.95rem !important;
    margin-right: 10px !important;
    transform: none !important;
    transition: none !important;
}

.nav-sidebar .nav-link:hover:not(.active) .nav-icon,
.nav-sidebar .nav-link.active .nav-icon,
.sidebar-collapse .nav-sidebar .nav-link.active .nav-icon {
    color: inherit !important;
    filter: none !important;
    font-size: 0.95rem !important;
    text-shadow: none !important;
    transform: none !important;
}

.nav-sidebar .nav-link p,
.nav-sidebar .nav-link.active p {
    font-size: 0.82rem !important;
    font-weight: 650 !important;
    letter-spacing: 0 !important;
    text-shadow: none !important;
}

.sidebar-collapse .main-sidebar {
    background: #143b32 !important;
    width: 64px !important;
}

.sidebar-collapse .brand-link {
    height: 58px !important;
}

.sidebar-collapse .nav-sidebar .nav-link {
    height: 42px !important;
    width: 42px !important;
}

.sidebar-collapse .nav-sidebar .nav-link::after,
.sidebar-collapse .nav-sidebar .nav-link::before {
    display: none !important;
}

/* Expand the mini sidebar while the mouse is over it */
body.sidebar-collapse .main-sidebar:hover {
    width: 250px !important;
}

body.sidebar-collapse .main-sidebar:hover .brand-link {
    justify-content: flex-start !important;
    padding: 12px 14px !important;
}

body.sidebar-collapse .main-sidebar:hover .brand-text,
body.sidebar-collapse .main-sidebar:hover .user-panel .info,
body.sidebar-collapse .main-sidebar:hover .form-inline,
body.sidebar-collapse .main-sidebar:hover .nav-sidebar .nav-link p {
    display: block !important;
}

body.sidebar-collapse .main-sidebar:hover .sidebar {
    align-items: stretch !important;
    padding: 10px 8px !important;
}

body.sidebar-collapse .main-sidebar:hover .nav-sidebar {
    align-items: stretch !important;
    padding: 0 !important;
}

body.sidebar-collapse .main-sidebar:hover .nav-sidebar .nav-link {
    height: auto !important;
    justify-content: flex-start !important;
    min-height: 40px !important;
    padding: 9px 11px !important;
    width: 100% !important;
}

body.sidebar-collapse .main-sidebar:hover .nav-sidebar .nav-icon {
    height: auto !important;
    margin-right: 10px !important;
    width: 20px !important;
}

body.sidebar-collapse .main-sidebar:hover .user-panel {
    justify-content: flex-start !important;
    margin: 8px 0 12px !important;
    padding: 10px !important;
}

body.sidebar-collapse .main-sidebar:hover .brand-image {
    margin-right: 10px !important;
}

body.sidebar-collapse.sidebar-hover-open .content-wrapper,
body.sidebar-collapse.sidebar-hover-open .main-footer,
body.sidebar-collapse.sidebar-hover-open .main-header {
    margin-left: 250px !important;
}
</style>

    {{-- Enhanced sidebar --}}
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('images/elimu.png')}}" alt="Logo" class="brand-image img-circle elevation-3">
      <span class="brand-text">E-Learning LMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        @if (auth()->check() && auth()->user()->role === 'admin')
                                <!-- Sidebar user panel (optional) -->
                            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                                <div class="image">
                                    {{-- <img src="{{ asset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image"> --}}

                                    <img src="{{ auth()->user()->profile_image ? asset('uploads/profile_images/' . auth()->user()->profile_image . '?v=' . time()) : asset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">


                                </div>
                                <div class="info">
                                {{-- <a href="#" class="d-block">Administrator</a> --}}
                                <a href="#" class="d-block">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</a>
                                </div>
                            </div>

                            <!-- SidebarSearch Form -->
                            <div class="form-inline">
                                <div class="input-group" data-widget="sidebar-search">
                                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-sidebar">
                                    <i class="fas fa-search fa-fw"></i>
                                    </button>
                                </div>
                                </div>
                            </div>
                            <li class="nav-item">
                                <a class="nav-link" data-tooltip="Dashboard" href="{{ route('admin.dashboard') }}">
                                    <span class="nav-icon fas fa-tachometer-alt"></span>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-tooltip="User Management" href="{{route('admin.users')}}">
                                    <span class="nav-icon fas fa-users"></span>
                                    <p>User Management</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-tooltip="Schools" href="{{route('admin.schools.index')}}">
                                    <span class="nav-icon fas fa-school"></span>
                                    <p>Schools</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-tooltip="Classes" href="{{route('admin.classes')}}">
                                    <span class="nav-icon fas fa-door-open"></span>
                                    <p>Classes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-tooltip="Student Promotions" href="{{route('admin.promotions.index')}}">
                                    <span class="nav-icon fas fa-graduation-cap"></span>
                                    <p>Student Promotions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-tooltip="Quizzes" href="{{route('admin.quizzes.index')}}">
                                    <span class="nav-icon fas fa-question-circle"></span>
                                    <p>Quizzes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-tooltip="Live Sessions" href="{{ route('admin.onlineSessions') }}">
                                    <span class="nav-icon fas fa-video"></span>
                                    <p>Live Sessions</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-tooltip="Reports" href="{{route('admin.report')}}">
                                    <span class="nav-icon fas fa-chart-bar"></span>
                                    <p>Reports</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-tooltip="Sliders" href="{{route('admin.sliders.index')}}">
                                    <span class="nav-icon fas fa-images"></span>
                                    <p>Sliders</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-tooltip="Community Hub" href="/admin/blogs">
                                    <span class="nav-icon fas fa-comments"></span>
                                    <p>Blog</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-tooltip="To-Do List" href="/to-do-list">
                                    <span class="nav-icon fas fa-tasks"></span>
                                    <p>To-Do List</p>
                                </a>
                            </li>
                        @endif

                        @if (auth()->check() && auth()->user()->role === 'teacher')
                            <!-- Sidebar user panel (optional) -->
                            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                                <div class="image">
                                    {{-- <img src="{{ asset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image"> --}}

                                    <img src="{{ auth()->user()->profile_image ? asset('uploads/profile_images/' . auth()->user()->profile_image . '?v=' . time()) : asset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">



                                </div>
                                <div class="info">
                                <a href="#" class="d-block">{{ auth()->user()->firstname }}  {{auth()->user()->lastname}}</a>
                                </div>
                            </div>

                            <!-- SidebarSearch Form -->
                            <div class="form-inline">
                                <div class="input-group" data-widget="sidebar-search">
                                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-sidebar">
                                    <i class="fas fa-search fa-fw"></i>
                                    </button>
                                </div>
                                </div>
                            </div>
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page"
                                        href="{{ route('teacher.dashboard') }}">
                                        <span class="nav-icon fa fa-tachometer "></span>
                                        <p>Dashboard</p>
                                    </a>
                                </li><br>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{route('teacher.users')}}">
                                        <span class="nav-icon fa fa-users"></span>
                                        <p>User-Management</p>
                                    </a>
                                </li><br>

                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{route('teacher.classes')}}">
                                        <span class="nav-icon fa fa-school"></span>
                                        <p>Classes</p>
                                    </a>
                                </li><br>
                                <li class="nav-item">
                                    <a class="nav-link "
                                        href="{{route('teacher.assignments')}}">
                                        <span class="nav-icon fa fa-clipboard"></span>
                                        <p>Assignments</p>
                                    </a>
                                </li><br>
                                <li class="nav-item">
                                    <a class="nav-link "
                                        href="{{route('teacher.assignments.submissions')}}">

                                        <span class="nav-icon fa fa-upload "></span>
                                        <p>Submissions</p>
                                    </a>
                                </li><br>
                                <li class="nav-item">
                                    <a class="nav-link "
                                        href="{{route('quizzes.index')}}">
                                        <span class="nav-icon fa ion-clipboard"></span>
                                        <p>Quizzes</p>
                                    </a>

                                </li><br>
                                <li class="nav-item">
                                <a class="nav-link "
                                    href="{{route('teacher.change.password')}}">
                                    <span class="nav-icon fa fa-key "></span>
                                    <p>Change Password</p>
                                </a>
                                </li><br>

                                </li>
                               

                                <li class="nav-item">
                                    <a class="nav-link "
                                        href="{{ route('teacher.onlineSessions') }}">
                                        <span class="nav-icon fa fa-chalkboard-teacher"></span>
                                        <p>Live Session</p>
                                    </a>
                                </li><br>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{route('teacher.report')}}">
                                        <span class="nav-icon fa fa-bar-chart "></span>
                                        <p>Reports</p>
                                    </a>
                                </li>
                                 <li class="nav-item">
                                    <a class="nav-link "
                                        href="/teacher/blogs">
                                        <span class="nav-icon fa fa-comments"></span>
                                        <p>Blog</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link "
                                        href="/to-do-list">
                                        <span class="nav-icon fa ion-clipboard"></span>
                                        <p>To_do_List</p>
                                    </a>
                                </li>
                    @endif


                        @if (auth()->check() && auth()->user()->role === 'student')
                            <!-- Sidebar user panel (optional) -->
                            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                            <div class="image">
                                {{-- <img src="{{ asset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image"> --}}

                                <img src="{{ auth()->user()->profile_image ? asset('uploads/profile_images/' . auth()->user()->profile_image . '?v=' . time()) : asset('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">


                            </div>
                            <div class="info">
                                <a href="#" class="d-block">{{ auth()->user()->firstname }} {{auth()->user()->lastname}}</a>
                                </div>
                            </div>

                        <!-- SidebarSearch Form -->
                        <div class="form-inline">
                             <div class="input-group" data-widget="sidebar-search">
                            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                             <div class="input-group-append">
                                 <button class="btn btn-sidebar">
                                 <i class="fas fa-search fa-fw"></i>
                                 </button>
                             </div>
                             </div>
                         </div>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page"
                                href="{{ route('student.dashboard') }}">
                                <span class="nav-icon fa fa-tachometer"></span>
                                <p>Dashboard</p>
                            </a>
                        </li><br>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('student.class') }}">
                                    <span class="fa fa-school"></span>
                                    <p>Class</p>
                                </a>
                            </li><br>
                            <li class="nav-item">
                                <a class="nav-link "
                                    href="{{route('student.assignments')}}">
                                    <span class="nav-icon fa fa-file-text"></span>
                                    <p>Assignments</p>
                                </a>
                            </li><br>
                            <li class="nav-item">
                                <a class="nav-link "
                                    href="{{route('student.quizzes')}}">
                                    <span class="nav-icon fa fa-file-text "></span>
                                    <p>Quizzes</p>
                                </a>
                            </li><br>
                            <li class="nav-item">
                                <a class="nav-link "
                                    href="{{route('change.password')}}">
                                    <span class="nav-icon fa fa-key "></span>
                                    <p>Change Password</p>
                                </a>
                            </li><br>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('student.onlineSessions') }}">
                                    <span class="nav-icon fa fa-chalkboard-teacher"></span>
                                    <p>Live Session</p>
                                </a>
                            </li><br>
                              <li class="nav-item">
                                <a class="nav-link"
                                    href="/student/blogs">
                                    <span class="nav-icon fa fa-comments"></span>
                                    <p>Blog</p>
                                </a>
                            </li><br>
                            <li class="nav-item">
                                <a class="nav-link "
                                    href="/to-do-list">
                                    <span class="nav-icon fa ion-clipboard"></span>
                                    <p>To_do_List</p>
                                </a>
                            </li>
                        @endif


                    </ul>
                </div>
        </aside>

                @yield('body')


        </div>
    </div>

<script>
// Enhanced Sidebar Menu Functionality for Both Desktop and Mobile
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.querySelector('[data-widget="pushmenu"]');
    const sidebar = document.querySelector('.main-sidebar');
    const body = document.body;
    
    // Initialize tooltips for all navigation links
    initializeTooltips();
    
    // Add active class detection
    detectActiveLinks();
    
    // Enhanced sidebar toggle functionality
    if (sidebarToggle) {
        // Remove any existing event listeners
        sidebarToggle.removeEventListener('click', handleSidebarToggle);
        
        // Add our custom event listener
        sidebarToggle.addEventListener('click', handleSidebarToggle);
    }
    
    function handleSidebarToggle(e) {
        e.preventDefault();
        e.stopPropagation();
        
        if (window.innerWidth <= 768) {
            // Mobile behavior
            sidebar.classList.toggle('sidebar-open');
            body.classList.toggle('sidebar-open');
            
            if (sidebar.classList.contains('sidebar-open')) {
                // Add overlay and close on outside click
                setTimeout(() => {
                    document.addEventListener('click', closeSidebarOnOutsideClick);
                }, 100);
            } else {
                document.removeEventListener('click', closeSidebarOnOutsideClick);
            }
        } else {
            // Desktop behavior - toggle collapse state
            body.classList.toggle('sidebar-collapse');
            
            // Store state in localStorage for persistence
            if (body.classList.contains('sidebar-collapse')) {
                localStorage.setItem('sidebar-collapsed', 'true');
            } else {
                localStorage.removeItem('sidebar-collapsed');
            }
            
            // Trigger resize event for content adjustment
            setTimeout(() => {
                window.dispatchEvent(new Event('resize'));
            }, 300);
        }
    }
    
    function closeSidebarOnOutsideClick(e) {
        const clickedElement = e.target;
        const isInsideSidebar = sidebar.contains(clickedElement);
        const isToggleButton = clickedElement.closest('[data-widget="pushmenu"]');
        
        if (!isInsideSidebar && !isToggleButton) {
            sidebar.classList.remove('sidebar-open');
            body.classList.remove('sidebar-open');
            document.removeEventListener('click', closeSidebarOnOutsideClick);
        }
    }
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            // Clean up mobile classes when switching to desktop
            sidebar.classList.remove('sidebar-open');
            body.classList.remove('sidebar-open');
            document.removeEventListener('click', closeSidebarOnOutsideClick);
            
            // Restore desktop collapsed state from localStorage
            const isCollapsed = localStorage.getItem('sidebar-collapsed');
            if (isCollapsed === 'true') {
                body.classList.add('sidebar-collapse');
            }
        } else {
            // On mobile, remove desktop collapse class
            body.classList.remove('sidebar-collapse');
        }
    });
    
    // Initialize on page load
    if (window.innerWidth > 768) {
        const isCollapsed = localStorage.getItem('sidebar-collapsed');
        if (isCollapsed === 'true') {
            body.classList.add('sidebar-collapse');
        }
    }

    if (sidebar) {
        sidebar.addEventListener('mouseenter', function() {
            if (window.innerWidth > 768 && body.classList.contains('sidebar-collapse')) {
                body.classList.add('sidebar-hover-open');
            }
        });

        sidebar.addEventListener('mouseleave', function() {
            body.classList.remove('sidebar-hover-open');
        });
    }
    
    function initializeTooltips() {
        const navLinks = document.querySelectorAll('.nav-sidebar .nav-link');
        navLinks.forEach((link, index) => {
            if (!link.hasAttribute('data-tooltip')) {
                const text = link.querySelector('p');
                if (text) {
                    link.setAttribute('data-tooltip', text.textContent.trim());
                }
            }
            
            // Dynamic tooltip positioning
            link.addEventListener('mouseenter', function(e) {
                if (body.classList.contains('sidebar-collapse')) {
                    const rect = link.getBoundingClientRect();
                    const viewportHeight = window.innerHeight;
                    const viewportWidth = window.innerWidth;
                    
                    // Calculate optimal positioning
                    let tooltipTop = rect.top + (rect.height / 2);
                    let tooltipLeft = rect.right + 15;
                    
                    // Prevent tooltip from going off-screen vertically
                    const tooltipHeight = 44; // Approximate tooltip height
                    if (tooltipTop + tooltipHeight/2 > viewportHeight) {
                        tooltipTop = viewportHeight - tooltipHeight/2 - 10;
                    }
                    if (tooltipTop - tooltipHeight/2 < 10) {
                        tooltipTop = tooltipHeight/2 + 10;
                    }
                    
                    // Prevent tooltip from going off-screen horizontally
                    const tooltipWidth = 200; // Max tooltip width
                    if (tooltipLeft + tooltipWidth > viewportWidth) {
                        tooltipLeft = viewportWidth - tooltipWidth - 10;
                    }
                    
                    // Set CSS custom properties for positioning
                    link.style.setProperty('--tooltip-top', tooltipTop + 'px');
                    link.style.setProperty('--tooltip-left', tooltipLeft + 'px');
                    link.style.setProperty('--arrow-top', tooltipTop + 'px');
                    link.style.setProperty('--arrow-left', (tooltipLeft - 8) + 'px');
                    
                    // Remove native browser tooltip
                    link.setAttribute('title', '');
                }
            });
            
            link.addEventListener('mouseleave', function(e) {
                if (body.classList.contains('sidebar-collapse')) {
                    link.removeAttribute('title');
                }
            });
        });
    }
    
    function detectActiveLinks() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-sidebar .nav-link');
        
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            link.classList.remove('active'); // Remove existing active classes
            
            if (href && href !== '#') {
                // Exact match or starts with the href path
                if (currentPath === href || 
                    (href.length > 1 && currentPath.startsWith(href) && 
                     (currentPath[href.length] === '/' || currentPath[href.length] === undefined))) {
                    link.classList.add('active');
                }
            }
        });
    }
    
    // Override AdminLTE's default pushmenu behavior if it exists
    if (window.$ && $.fn.pushMenu) {
        // Disable AdminLTE's default push menu to prevent conflicts
        $('[data-widget="pushmenu"]').off('click.lte.pushmenu');
    }
    
    // Add keyboard support (ESC to close on mobile)
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && window.innerWidth <= 768 && sidebar.classList.contains('sidebar-open')) {
            sidebar.classList.remove('sidebar-open');
            body.classList.remove('sidebar-open');
            document.removeEventListener('click', closeSidebarOnOutsideClick);
        }
    });
    
    console.log('Enhanced Sidebar Menu initialized successfully');
});
</script>
