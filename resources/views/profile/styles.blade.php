<style>
.profile-page { background: #f3f6fa; min-height: 100vh; }
.profile-shell { margin: 0 auto; max-width: 1500px; padding: 20px; }
.profile-header, .profile-card { background: #fff; border: 1px solid #e4e9f0; border-radius: 14px; }
.profile-header { align-items: center; display: flex; gap: 18px; justify-content: space-between; margin-bottom: 14px; padding: 16px 18px; }
.profile-header h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.profile-header h1 i, .profile-card h3 i { color: #123d35; margin-right: 7px; }
.profile-header p { color: #6b7280; margin: 4px 0 0; }
.profile-actions { display: flex; flex-wrap: wrap; gap: 8px; }
.profile-btn { align-items: center; border: 0; border-radius: 6px; display: inline-flex; font-weight: 800; gap: 7px; min-height: 38px; padding: 8px 13px; }
.profile-btn:hover { text-decoration: none; }
.profile-btn-primary { background: #123d35; color: #fff; }
.profile-btn-primary:hover { background: #1f6f5b; color: #fff; }
.profile-btn-light { background: #eef2f7; color: #374151; }
.profile-card { padding: 20px; }
.profile-card h3 { color: #172033; font-size: 16px; font-weight: 800; margin: 0 0 18px; }
.details-grid { display: grid; gap: 18px; grid-template-columns: repeat(2, minmax(0, 1fr)); }
.details-grid strong { color: #172033; display: block; margin-top: 4px; overflow-wrap: anywhere; }
.profile-hero { align-items: center; background: #fff; border: 1px solid #e4e9f0; border-radius: 16px; box-shadow: 0 8px 24px rgba(23,32,51,.07); color: #172033; display: flex; gap: 22px; margin-bottom: 16px; min-height: 220px; overflow: hidden; padding: 30px 34px; position: relative; }
.profile-hero::before { background: #165a4d; content: ""; height: 6px; left: 0; position: absolute; right: 0; top: 0; }
.hero-pattern { display: none; }
.profile-avatar { border: 3px solid #e5e7eb; border-radius: 50%; height: 116px; object-fit: cover; width: 116px; }
.profile-hero-avatar { border: 5px solid #dceae6; box-shadow: 0 10px 25px rgba(23,32,51,.12); flex: 0 0 auto; height: 138px; position: relative; width: 138px; z-index: 1; }
.hero-identity { min-width: 0; position: relative; z-index: 1; }
.hero-label { color: #16806b; font-size: 11px; font-weight: 900; letter-spacing: .12em; margin-bottom: 5px; text-transform: uppercase; }
.hero-identity h2 { font-size: 30px; font-weight: 900; letter-spacing: -.02em; margin: 0 0 6px; }
.hero-identity p { color: #667085; margin: 0; overflow-wrap: anywhere; }
.hero-identity p i { margin-right: 6px; }
.hero-badges { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 17px; }
.hero-badge { background: #f3f6f8; border: 1px solid #e4e9f0; border-radius: 20px; color: #344054; font-size: 12px; font-weight: 800; padding: 6px 10px; }
.hero-badge-status { background: #ecfdf5; border-color: #d1fae5; color: #047857; }
.hero-badge-status i { color: #22a06b; font-size: 8px; margin-right: 4px; }
.hero-badge-inactive i { color: #ff9c9c; }
.hero-edit { align-items: center; background: #165a4d; border-radius: 9px; color: #fff; display: inline-flex; font-weight: 900; gap: 7px; margin-left: auto; padding: 10px 14px; position: relative; z-index: 1; }
.hero-edit:hover { background: #1f6f5b; color: #fff; text-decoration: none; transform: translateY(-1px); }
.profile-stats { display: grid; gap: 13px; grid-template-columns: repeat(4, minmax(0, 1fr)); margin-bottom: 16px; }
.profile-stat { align-items: center; background: #fff; border: 1px solid #e4e9f0; border-radius: 13px; display: flex; gap: 13px; min-height: 98px; padding: 15px; }
.profile-stat .stat-icon { align-items: center; background: #e9f6f2; border-radius: 11px; color: #13715d; display: flex; flex: 0 0 auto; font-size: 18px; height: 48px; justify-content: center; width: 48px; }
.profile-stat-class .stat-icon { background: #eaf1ff; color: #3569c8; }
.profile-stat-status .stat-icon { background: #f0ecff; color: #7251c8; }
.profile-stat-member .stat-icon { background: #fff2e5; color: #c66d1a; }
.profile-stat span { color: #788496; display: block; font-size: 11px; font-weight: 800; margin-bottom: 3px; text-transform: uppercase; }
.profile-stat strong { color: #182236; display: -webkit-box; font-size: 14px; font-weight: 900; line-height: 1.35; overflow: hidden; overflow-wrap: anywhere; -webkit-box-orient: vertical; -webkit-line-clamp: 2; }
.profile-content-grid { display: grid; gap: 16px; grid-template-columns: repeat(2, minmax(0, 1fr)); margin: 0 !important; padding: 0 !important; }
.profile-info-card { min-width: 0; padding: 0; }
.card-heading { align-items: center; border-bottom: 1px solid #edf0f4; display: flex; gap: 12px; padding: 18px 20px; }
.card-heading-icon { align-items: center; background: #e9f6f2; border-radius: 10px; color: #13715d; display: flex; flex: 0 0 auto; height: 42px; justify-content: center; width: 42px; }
.card-icon-blue { background: #eaf1ff; color: #3569c8; }
.card-icon-purple { background: #f0ecff; color: #7251c8; }
.card-icon-orange { background: #fff2e5; color: #c66d1a; }
.card-heading h3 { font-size: 15px; margin: 0; }
.card-heading p { color: #8a94a5; font-size: 12px; margin: 3px 0 0; }
.info-list { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); padding: 8px 20px 15px; }
.info-line { border-bottom: 1px solid #f0f2f5; min-width: 0; padding: 12px 5px 12px 0; }
.info-line:nth-last-child(-n+2) { border-bottom: 0; }
.info-line span { color: #7c8798; display: block; font-size: 11px; font-weight: 800; margin-bottom: 4px; text-transform: uppercase; }
.info-line strong { color: #1d2939; display: block; font-size: 13px; overflow-wrap: anywhere; }
.text-status { color: #16815f !important; }
.text-status i { font-size: 7px; margin-right: 4px; }
.text-status-inactive { color: #bd3c3c !important; }
.activity-list { padding: 10px 20px 17px; }
.activity-item { align-items: center; display: flex; gap: 12px; padding: 9px 0; }
.activity-item + .activity-item { border-top: 1px solid #f0f2f5; }
.activity-dot { align-items: center; background: #f1f3f6; border-radius: 9px; color: #687386; display: flex; flex: 0 0 auto; height: 35px; justify-content: center; width: 35px; }
.activity-dot-green { background: #e9f6f2; color: #16815f; }
.activity-dot-blue { background: #eaf1ff; color: #3569c8; }
.activity-item strong, .activity-item span { display: block; }
.activity-item strong { color: #253044; font-size: 13px; }
.activity-item span { color: #8993a3; font-size: 12px; margin-top: 2px; }
.profile-form { max-width: 1000px; }
.image-editor { align-items: center; border-bottom: 1px solid #e5e7eb; display: flex; gap: 18px; margin-bottom: 18px; padding-bottom: 18px; }
.image-editor label, .field label { color: #374151; display: block; font-size: 12px; font-weight: 800; margin-bottom: 6px; }
.image-editor small { color: #6b7280; display: block; margin-top: 5px; }
.form-grid { display: grid; gap: 14px; grid-template-columns: repeat(3, minmax(0, 1fr)); }
.field-wide { grid-column: span 2; }
.field input, .field select { border: 1px solid #d1d5db; border-radius: 6px; color: #172033; height: 40px; padding: 8px 10px; width: 100%; }
.field input:focus, .field select:focus { border-color: #123d35; box-shadow: 0 0 0 3px rgba(18,61,53,.12); outline: 0; }
.assignment-note { align-items: center; background: #f8fafc; border: 1px solid #e5e7eb; border-radius: 7px; display: flex; gap: 12px; margin-top: 18px; padding: 13px; }
.assignment-note i { color: #6b7280; }
.assignment-note strong, .assignment-note span { display: block; }
.assignment-note span { color: #6b7280; font-size: 13px; margin-top: 2px; }
.form-actions { margin-top: 18px; }
@media (max-width: 1100px) { .profile-stats { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
@media (max-width: 800px) { .profile-header, .image-editor { align-items: flex-start; flex-direction: column; } .profile-hero { align-items: flex-start; flex-direction: column; padding: 25px; } .hero-edit { margin-left: 0; } .profile-content-grid, .form-grid, .details-grid { grid-template-columns: 1fr; } .field-wide { grid-column: auto; } }
@media (max-width: 520px) { .profile-shell { padding: 12px; } .profile-stats, .info-list { grid-template-columns: 1fr; } .info-line:nth-last-child(-n+2) { border-bottom: 1px solid #f0f2f5; } .info-line:last-child { border-bottom: 0; } .profile-hero-avatar { height: 112px; width: 112px; } .hero-identity h2 { font-size: 24px; } }
</style>
