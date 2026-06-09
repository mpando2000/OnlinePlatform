<style>
.teacher-page { background: #f5f7fb; min-height: 100vh; }
.page-shell { padding: 18px; }
.form-shell { max-width: 920px; }
.page-panel, .panel-card, .stat-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
}
.page-panel {
    align-items: center;
    display: flex;
    gap: 14px;
    justify-content: space-between;
    margin-bottom: 14px;
    padding: 16px 18px;
}
.page-panel h1 { color: #172033; font-size: 22px; font-weight: 800; margin: 0; }
.page-panel h1 i { color: #123d35; margin-right: 8px; }
.page-panel p { color: #6b7280; margin: 4px 0 0; }
.page-actions, .row-actions { display: flex; flex-wrap: wrap; gap: 8px; }
.row-actions { justify-content: flex-end; }
.row-actions form { margin: 0; }
.text-right { text-align: right; }
.ui-btn, .icon-btn {
    align-items: center;
    border: 0;
    border-radius: 6px;
    display: inline-flex;
    font-weight: 800;
    gap: 7px;
    min-height: 34px;
    padding: 8px 12px;
}
.ui-btn:hover, .icon-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.ui-btn-light, .ui-btn-soft { background: #eef2f7; color: #374151; }
.ui-btn-light:hover, .ui-btn-soft:hover { background: #e2e8f0; color: #172033; }
.icon-btn { background: #eef2f7; color: #374151; justify-content: center; min-width: 34px; padding: 8px; }
.icon-btn:hover { background: #e2e8f0; color: #172033; }
.icon-btn.danger { color: #b91c1c; }
.stats-grid { display: grid; gap: 14px; grid-template-columns: repeat(4, minmax(0, 1fr)); margin-bottom: 14px; }
.stat-card { align-items: center; display: flex; gap: 12px; min-height: 82px; padding: 14px; }
.stat-card i, .item-card > i, .list-card > i { align-items: center; background: #ecfdf5; border-radius: 8px; color: #047857; display: flex; height: 42px; justify-content: center; width: 42px; }
.stat-card strong { color: #172033; display: block; font-size: 22px; line-height: 1.1; }
.stat-card span { color: #6b7280; font-size: 12px; font-weight: 800; text-transform: uppercase; }
.panel-title, .card-heading { align-items: center; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; padding: 13px 16px; }
.panel-title strong, .card-heading h2 { color: #172033; font-size: 15px; font-weight: 800; margin: 0; }
.panel-title span { color: #6b7280; font-size: 12px; font-weight: 800; }
.table-responsive { overflow-x: auto; }
.clean-table { margin: 0; width: 100%; }
.clean-table th { background: #f8fafc; color: #4b5563; font-size: 12px; padding: 12px 16px; text-transform: uppercase; }
.clean-table td { border-top: 1px solid #eef2f7; color: #172033; padding: 13px 16px; vertical-align: middle; }
.clean-table th:last-child, .clean-table td:last-child { text-align: right; white-space: nowrap; }
.clean-table td span { color: #6b7280; display: block; font-size: 12px; margin-top: 3px; }
.clean-table .status-pill { background: #ecfdf5; border-radius: 999px; color: #047857; display: inline-block; font-weight: 800; margin: 0; padding: 5px 9px; }
.empty-cell { color: #6b7280 !important; text-align: center; }
.item-grid { display: grid; gap: 10px; grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); padding: 16px; }
.item-list, .message-list { display: grid; gap: 10px; padding: 16px; }
.item-card, .list-card {
    align-items: center;
    background: #f8fafc;
    border: 1px solid #eef2f7;
    border-radius: 8px;
    color: #172033;
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    padding: 12px;
}
.item-card:hover { border-color: #123d35; color: #172033; text-decoration: none; }
.item-card > div:not(.item-icon):not(.item-actions) { flex: 1 1 180px; min-width: 0; }
.item-card strong, .list-card strong, .item-card h3 { color: #172033; display: block; font-size: 15px; font-weight: 800; margin: 0; }
.item-card span, .list-card span, .item-card p { color: #6b7280; display: block; font-size: 12px; margin: 3px 0 0; }
.item-card .ui-btn { flex: 0 0 auto; margin-left: auto; white-space: nowrap; }
.item-icon { align-items: center; background: #ecfdf5; border-radius: 8px; color: #047857; display: flex; flex: 0 0 42px; height: 42px; justify-content: center; width: 42px; }
.item-actions { display: flex; gap: 6px; margin-left: auto; }
.item-actions form { margin: 0; }
.form-card { padding: 18px; }
.form-grid { display: grid; gap: 14px; grid-template-columns: repeat(2, minmax(0, 1fr)); }
.field-wide { grid-column: 1 / -1; }
.field { margin-bottom: 14px; }
.field label { color: #374151; display: block; font-weight: 800; margin-bottom: 7px; }
.field input, .field select, .field textarea { border: 1px solid #d7dde6; border-radius: 6px; min-height: 40px; padding: 9px 11px; width: 100%; }
.field textarea { resize: vertical; }
.field input:focus, .field select:focus, .field textarea:focus { border-color: #123d35; box-shadow: 0 0 0 3px rgba(18, 61, 53, .12); outline: 0; }
.form-actions { display: flex; gap: 8px; margin-top: 18px; }
.password-field { position: relative; }
.password-field .password-toggle { bottom: 3px; position: absolute; right: 4px; }
.password-field input { padding-right: 48px; }
.empty-state { color: #6b7280; padding: 20px; text-align: center; }
.count-pill, .role-pill { background: #ecfdf5; border-radius: 999px; color: #047857; display: inline-block; font-size: 12px; font-weight: 800; padding: 6px 10px; }
.detail-list { display: grid; gap: 10px; }
.detail-row { align-items: center; background: #f8fafc; border: 1px solid #eef2f7; border-radius: 8px; display: flex; gap: 14px; justify-content: space-between; padding: 12px; }
.detail-row span { color: #6b7280; font-size: 12px; font-weight: 800; text-transform: uppercase; }
.detail-row strong { color: #172033; text-align: right; }
.detail-row input { border: 1px solid #d7dde6; border-radius: 6px; min-height: 38px; padding: 8px 10px; width: min(100%, 520px); }
.profile-layout { display: grid; gap: 14px; grid-template-columns: 320px minmax(0, 1fr); margin-bottom: 14px; }
.profile-summary { align-items: center; display: flex; flex-direction: column; justify-content: center; min-height: 280px; padding: 20px; text-align: center; }
.profile-avatar { align-items: center; background: #123d35; border-radius: 50%; color: #fff; display: flex; font-size: 32px; font-weight: 900; height: 96px; justify-content: center; margin-bottom: 14px; width: 96px; }
.profile-summary h2 { color: #172033; font-size: 20px; font-weight: 900; margin: 0 0 8px; }
.profile-meta { border-top: 1px solid #eef2f7; display: grid; gap: 8px; margin-top: 18px; padding-top: 14px; width: 100%; }
.profile-meta span { color: #6b7280; font-size: 12px; }
.profile-meta i { color: #123d35; margin-right: 6px; }
.profile-section { margin-top: 14px; }
.blog-layout { display: grid; gap: 14px; grid-template-columns: minmax(0, 1fr) 360px; }
.message-list { max-height: 620px; overflow: auto; }
.message-item { align-items: flex-start; display: flex; gap: 10px; }
.message-item.mine { flex-direction: row-reverse; }
.avatar { align-items: center; background: #123d35; border-radius: 50%; color: #fff; display: flex; flex: 0 0 38px; font-size: 13px; font-weight: 800; height: 38px; justify-content: center; width: 38px; }
.message-body { background: #f8fafc; border: 1px solid #eef2f7; border-radius: 8px; max-width: 720px; padding: 10px 12px; }
.message-item.mine .message-body { background: #ecfdf5; border-color: #d1fae5; }
.message-meta { display: flex; flex-wrap: wrap; gap: 8px; justify-content: space-between; margin-bottom: 4px; }
.message-meta strong { color: #172033; }
.message-meta span { color: #6b7280; font-size: 12px; }
.message-body p, .message-item p { color: #172033; margin: 0; white-space: pre-wrap; }
.composer-card { align-self: start; }
.message-form { display: flex; gap: 8px; }
.message-form input { border: 1px solid #d7dde6; border-radius: 6px; flex: 1; min-height: 40px; padding: 9px 11px; }
.composer-card form { padding: 16px; }
.panel-alert { border-radius: 8px; margin-bottom: 14px; }
.live-status { color: #047857; font-size: 12px; font-weight: 800; margin-top: 10px; }
@media (max-width: 1050px) { .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } .blog-layout, .profile-layout { grid-template-columns: 1fr; } }
@media (max-width: 780px) { .page-panel { align-items: flex-start; flex-direction: column; } .stats-grid, .form-grid { grid-template-columns: 1fr; } .list-card, .item-card, .detail-row, .message-form { align-items: flex-start; flex-direction: column; } .item-card .ui-btn, .item-actions { margin-left: 0; } .row-actions { justify-content: flex-start; } .clean-table th:last-child, .clean-table td:last-child { text-align: left; } .detail-row strong { text-align: left; } }
</style>
<script>
const teacherFooterYear = document.getElementById("currentYear");
if (teacherFooterYear) teacherFooterYear.textContent = new Date().getFullYear();
</script>
