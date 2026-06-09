<style>
.student-page { background: #f5f7fb; min-height: 100vh; }
.page-shell { padding: 18px; }
.form-shell { max-width: 860px; }
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
.ui-btn {
    align-items: center;
    border: 0;
    border-radius: 6px;
    display: inline-flex;
    font-weight: 800;
    gap: 7px;
    min-height: 36px;
    padding: 8px 12px;
}
.ui-btn:hover { text-decoration: none; }
.ui-btn-primary { background: #123d35; color: #fff; }
.ui-btn-primary:hover { background: #1f6f5b; color: #fff; }
.ui-btn-light { background: #eef2f7; color: #374151; }
.ui-btn-light:hover { background: #e2e8f0; color: #172033; }
.count-pill { background: #ecfdf5; border-radius: 999px; color: #047857; font-size: 12px; font-weight: 800; padding: 6px 10px; }
.stats-grid { display: grid; gap: 14px; grid-template-columns: repeat(4, minmax(0, 1fr)); margin-bottom: 14px; }
.stat-card { align-items: center; display: flex; gap: 12px; min-height: 82px; padding: 14px; }
.stat-card i, .item-card i, .list-card > i {
    align-items: center;
    background: #ecfdf5;
    border-radius: 8px;
    color: #047857;
    display: flex;
    height: 42px;
    justify-content: center;
    width: 42px;
}
.stat-card strong { color: #172033; display: block; font-size: 21px; line-height: 1.1; }
.stat-card span { color: #6b7280; font-size: 12px; font-weight: 800; text-transform: uppercase; }
.panel-title { align-items: center; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; padding: 13px 16px; }
.panel-title strong { color: #172033; }
.panel-title span { color: #6b7280; font-size: 12px; font-weight: 800; }
.item-grid { display: grid; gap: 10px; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); padding: 16px; }
.item-card, .list-card {
    align-items: center;
    background: #f8fafc;
    border: 1px solid #eef2f7;
    border-radius: 8px;
    color: #172033;
    display: flex;
    gap: 12px;
    padding: 12px;
}
.item-card:hover { border-color: #123d35; color: #172033; text-decoration: none; }
.item-card strong, .list-card strong { color: #172033; display: block; }
.item-card span, .list-card span { color: #6b7280; display: block; font-size: 12px; margin-top: 3px; }
.item-list { display: grid; gap: 10px; padding: 16px; }
.list-card { justify-content: space-between; }
.row-actions { display: flex; flex-wrap: wrap; gap: 8px; margin-left: auto; }
.assignment-row { align-items: center; }
.list-main { flex: 1 1 260px; min-width: 0; }
.assignment-meta { align-items: flex-end; display: flex; flex-direction: column; gap: 5px; margin-left: auto; }
.assignment-meta small { color: #6b7280; font-size: 12px; font-weight: 800; }
.status-pill { background: #ecfdf5; border-radius: 999px; color: #047857; display: inline-block; font-size: 12px; font-weight: 800; padding: 5px 9px; }
.status-pill.warning { background: #fffbeb; color: #b45309; }
.status-pill.danger { background: #fef2f2; color: #b91c1c; }
.form-card { padding: 18px; }
.detail-layout { display: grid; gap: 14px; grid-template-columns: minmax(0, .9fr) minmax(0, 1.1fr); }
.detail-list { display: grid; gap: 10px; }
.detail-row { align-items: center; background: #f8fafc; border: 1px solid #eef2f7; border-radius: 8px; display: flex; gap: 14px; justify-content: space-between; padding: 12px; }
.detail-row span { color: #6b7280; font-size: 12px; font-weight: 800; text-transform: uppercase; }
.detail-row strong { color: #172033; text-align: right; }
.description-box { color: #374151; line-height: 1.6; padding: 16px 0 4px; }
.field { margin-bottom: 14px; position: relative; }
.field label { color: #374151; display: block; font-weight: 800; margin-bottom: 7px; }
.field input, .field textarea {
    border: 1px solid #d7dde6;
    border-radius: 6px;
    min-height: 40px;
    padding: 9px 11px;
    width: 100%;
}
.field textarea { resize: vertical; }
.field input:focus, .field textarea:focus { border-color: #123d35; box-shadow: 0 0 0 3px rgba(18, 61, 53, .12); outline: 0; }
.field-help { color: #6b7280; display: block; font-size: 12px; margin-top: 6px; }
.password-field input { padding-right: 44px; }
.password-field button { background: transparent; border: 0; bottom: 6px; color: #6b7280; position: absolute; right: 8px; width: 32px; }
.form-actions { display: flex; gap: 8px; margin-top: 18px; }
.blog-layout { display: grid; gap: 14px; grid-template-columns: minmax(0, 1fr) 340px; }
.message-list { display: grid; gap: 10px; max-height: 620px; overflow: auto; padding: 16px; }
.message-item { align-items: flex-start; display: flex; gap: 10px; }
.message-item.mine { flex-direction: row-reverse; }
.avatar { align-items: center; background: #123d35; border-radius: 50%; color: #fff; display: flex; flex: 0 0 38px; font-size: 13px; font-weight: 800; height: 38px; justify-content: center; width: 38px; }
.message-body { background: #f8fafc; border: 1px solid #eef2f7; border-radius: 8px; max-width: 720px; padding: 10px 12px; }
.message-item.mine .message-body { background: #ecfdf5; border-color: #d1fae5; }
.message-meta { display: flex; flex-wrap: wrap; gap: 8px; justify-content: space-between; margin-bottom: 4px; }
.message-meta strong { color: #172033; }
.message-meta span { color: #6b7280; font-size: 12px; }
.message-body p { color: #172033; margin: 0; white-space: pre-wrap; }
.composer-card form { padding: 16px; }
.live-status { color: #047857; font-size: 12px; font-weight: 800; margin-top: 10px; }
.panel-alert { border-radius: 8px; margin-bottom: 14px; }
.empty-state { color: #6b7280; padding: 20px; text-align: center; }
.empty-state h3 { color: #172033; font-size: 17px; font-weight: 800; margin: 8px 0 4px; }
@media (max-width: 1050px) { .stats-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); } .blog-layout, .detail-layout { grid-template-columns: 1fr; } }
@media (max-width: 780px) {
    .page-panel { align-items: flex-start; flex-direction: column; }
    .stats-grid { grid-template-columns: 1fr; }
    .list-card, .detail-row { align-items: flex-start; flex-direction: column; }
    .row-actions, .assignment-meta { align-items: flex-start; margin-left: 0; }
    .detail-row strong { text-align: left; }
}
</style>
<script>
const studentFooterYear = document.getElementById("currentYear");
if (studentFooterYear) studentFooterYear.textContent = new Date().getFullYear();
</script>
