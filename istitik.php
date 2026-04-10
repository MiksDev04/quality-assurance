<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>QAMS – Quality Assurance Management | PLSP</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
:root {
  --navy: #0d1b2a;
  --navy-2: #1b2e42;
  --gold: #c9a84c;
  --gold-light: #e8c96a;
  --cream: #f5f0e8;
  --white: #ffffff;
  --green: #2e7d52;
  --green-light: #e8f5ee;
  --red-light: #fdf0ef;
  --red: #c0392b;
  --text-muted: #6c7a8a;
  --border: #dde2ea;
  --sidebar-w: 250px;
}
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'DM Sans', sans-serif; background: #f0f3f7; color: var(--navy); min-height: 100vh; }

/* SIDEBAR */
#sidebar {
  position: fixed; top: 0; left: 0; width: var(--sidebar-w);
  height: 100vh; background: var(--navy); display: flex;
  flex-direction: column; z-index: 100; transition: transform .3s;
}
.sidebar-brand {
  padding: 24px 20px 18px;
  border-bottom: 1px solid rgba(255,255,255,.1);
}
.sidebar-brand .badge-pill {
  background: var(--gold); color: var(--navy);
  font-size: 10px; font-weight: 700; padding: 3px 8px;
  border-radius: 20px; text-transform: uppercase; letter-spacing: 1px;
}
.sidebar-brand h5 {
  font-family: 'DM Serif Display', serif;
  color: var(--white); font-size: 17px; margin-top: 6px; line-height: 1.3;
}
.sidebar-brand small { color: var(--gold); font-size: 11px; font-weight: 500; }

.nav-section-label {
  color: rgba(255,255,255,.35); font-size: 10px; font-weight: 600;
  letter-spacing: 1.5px; text-transform: uppercase;
  padding: 20px 20px 6px;
}
.sidebar-nav { flex: 1; overflow-y: auto; padding-bottom: 20px; }
.sidebar-nav a {
  display: flex; align-items: center; gap: 12px;
  padding: 11px 20px; color: rgba(255,255,255,.65);
  text-decoration: none; font-size: 14px; font-weight: 500;
  border-left: 3px solid transparent; transition: all .2s;
}
.sidebar-nav a:hover { color: var(--white); background: rgba(255,255,255,.06); }
.sidebar-nav a.active {
  color: var(--white); background: rgba(201,168,76,.12);
  border-left-color: var(--gold);
}
.sidebar-nav a i { width: 18px; text-align: center; font-size: 15px; }
.sidebar-footer {
  padding: 14px 20px;
  border-top: 1px solid rgba(255,255,255,.08);
  color: rgba(255,255,255,.4); font-size: 12px;
}

/* MAIN */
#main { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }
.topbar {
  background: var(--white); border-bottom: 1px solid var(--border);
  padding: 14px 28px; display: flex; align-items: center;
  justify-content: space-between; position: sticky; top: 0; z-index: 50;
}
.topbar-title { font-family: 'DM Serif Display', serif; font-size: 20px; color: var(--navy); }
.topbar-subtitle { font-size: 12px; color: var(--text-muted); margin-top: 1px; }
.topbar-right { display: flex; align-items: center; gap: 12px; }
.school-badge {
  background: var(--cream); border: 1px solid var(--border);
  border-radius: 20px; padding: 5px 14px;
  font-size: 12px; font-weight: 600; color: var(--navy);
}
.mobile-menu-btn {
  display: none;
  width: 38px;
  height: 38px;
  border: 1px solid var(--border);
  border-radius: 8px;
  background: var(--white);
  color: var(--navy);
  align-items: center;
  justify-content: center;
  font-size: 16px;
}
#page-content { padding: 28px; flex: 1; }

/* CARDS */
.stat-card {
  background: var(--white); border-radius: 12px;
  padding: 22px 24px; border: 1px solid var(--border);
  transition: box-shadow .2s;
}
.stat-card:hover { box-shadow: 0 4px 20px rgba(13,27,42,.08); }
.stat-card .icon {
  width: 44px; height: 44px; border-radius: 10px;
  display: flex; align-items: center; justify-content: center; font-size: 18px;
  margin-bottom: 14px;
}
.stat-card .value { font-size: 28px; font-weight: 700; line-height: 1; }
.stat-card .label { font-size: 12px; color: var(--text-muted); margin-top: 4px; font-weight: 500; }

.icon-navy { background: rgba(13,27,42,.08); color: var(--navy); }
.icon-gold { background: rgba(201,168,76,.15); color: var(--gold); }
.icon-green { background: var(--green-light); color: var(--green); }
.icon-blue { background: rgba(52,132,210,.12); color: #3484d2; }

.card-panel {
  background: var(--white); border: 1px solid var(--border);
  border-radius: 12px; overflow: hidden;
}
.card-panel .panel-header {
  padding: 18px 22px; border-bottom: 1px solid var(--border);
  display: flex; align-items: center; justify-content: space-between;
}
.card-panel .panel-header h6 {
  font-weight: 700; font-size: 14px; margin: 0; color: var(--navy);
}
.card-panel .panel-body { padding: 0; }

/* TABLE */
.table-custom { margin: 0; }
.table-custom th {
  background: #f7f9fc; font-size: 11px; font-weight: 700;
  text-transform: uppercase; letter-spacing: .8px; color: var(--text-muted);
  border-bottom: 1px solid var(--border) !important; padding: 12px 16px;
}
.table-custom td { padding: 13px 16px; font-size: 13.5px; vertical-align: middle; border-bottom: 1px solid #f0f3f7; }
.table-custom tr:last-child td { border-bottom: none; }
.table-custom tbody tr:hover { background: #fafbfc; }

/* BADGES */
.badge-status {
  display: inline-flex; align-items: center; gap: 5px;
  padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600;
}
.badge-met { background: var(--green-light); color: var(--green); }
.badge-unmet { background: var(--red-light); color: var(--red); }
.badge-no-data { background: #f0f3f7; color: var(--text-muted); }

/* PROGRESS */
.progress-bar-custom {
  height: 6px; border-radius: 4px; background: var(--border);
  overflow: hidden; margin-top: 4px;
}
.progress-bar-custom .bar {
  height: 100%; border-radius: 4px; background: var(--gold);
  transition: width .4s;
}
.progress-bar-custom .bar.met { background: var(--green); }
.progress-bar-custom .bar.over { background: var(--green); }

/* BUTTONS */
.btn-gold {
  background: var(--gold); border: none; color: var(--navy);
  font-weight: 600; font-size: 13px; padding: 8px 18px; border-radius: 8px;
  transition: background .2s;
}
.btn-gold:hover { background: var(--gold-light); color: var(--navy); }
.btn-navy {
  background: var(--navy); border: none; color: var(--white);
  font-weight: 600; font-size: 13px; padding: 8px 18px; border-radius: 8px;
}
.btn-outline-navy {
  border: 1.5px solid var(--navy); color: var(--navy); background: none;
  font-weight: 600; font-size: 13px; padding: 7px 16px; border-radius: 8px;
}

/* FORM */
.form-label { font-size: 13px; font-weight: 600; color: var(--navy); margin-bottom: 5px; }
.form-control, .form-select {
  font-size: 13.5px; border: 1.5px solid var(--border); border-radius: 8px;
  padding: 9px 13px; color: var(--navy);
}
.form-control:focus, .form-select:focus {
  border-color: var(--gold); box-shadow: 0 0 0 3px rgba(201,168,76,.15); outline: none;
}

/* MODAL */
.modal-content { border-radius: 14px; border: none; }
.modal-header {
  background: var(--navy); color: var(--white);
  border-radius: 14px 14px 0 0; padding: 18px 22px;
}
.modal-header .modal-title { font-family: 'DM Serif Display', serif; font-size: 18px; }
.modal-header .btn-close { filter: invert(1) brightness(2); }
.modal-footer { border-top: 1px solid var(--border); padding: 14px 22px; }

/* TOAST */
#toast-container { position: fixed; top: 20px; right: 20px; z-index: 9999; }
.toast-msg {
  min-width: 280px; padding: 14px 18px; border-radius: 10px;
  font-size: 13.5px; font-weight: 500; margin-bottom: 10px;
  display: flex; align-items: center; gap: 10px;
  box-shadow: 0 4px 20px rgba(0,0,0,.12); animation: slideIn .3s ease;
}
@keyframes slideIn { from { opacity:0; transform: translateX(40px); } to { opacity:1; transform: translateX(0); } }
.toast-success { background: var(--green); color: #fff; }
.toast-error { background: var(--red); color: #fff; }
.toast-info { background: var(--navy); color: #fff; }

/* STARS */
.stars { color: var(--gold); font-size: 13px; }
.star-empty { color: var(--border); }

/* SECTION TITLE */
.section-title {
  font-family: 'DM Serif Display', serif; font-size: 22px;
  color: var(--navy); margin-bottom: 4px;
}
.section-subtitle { font-size: 13px; color: var(--text-muted); margin-bottom: 22px; }

/* Empty state */
.empty-state {
  text-align: center; padding: 48px 20px; color: var(--text-muted);
}
.empty-state i { font-size: 36px; margin-bottom: 12px; opacity: .4; display: block; }
.empty-state p { font-size: 14px; margin: 0; }

/* Search box */
.search-box { position: relative; }
.search-box i { position: absolute; left: 11px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 13px; }
.search-box input { padding-left: 32px; }

.page-head {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
}

.page-actions {
  display: flex;
  gap: 8px;
  flex-wrap: wrap;
}

.table-wrap {
  overflow-x: auto;
}

/* Inline edit action btns */
.act-btn {
  border: none; background: none; padding: 4px 7px;
  border-radius: 6px; font-size: 13px; cursor: pointer; transition: background .15s;
}
.act-btn:hover { background: #f0f3f7; }
.act-btn.edit { color: var(--navy); }
.act-btn.del { color: var(--red); }

/* Chart container */
.chart-wrap { padding: 16px 20px; }

/* Rating badge */
.rating-pill {
  display: inline-flex; align-items: center; gap: 4px;
  background: rgba(201,168,76,.12); color: var(--gold);
  border-radius: 20px; padding: 3px 9px; font-size: 12px; font-weight: 700;
}

#sidebar-overlay {
  position: fixed;
  inset: 0;
  background: rgba(13, 27, 42, 0.35);
  opacity: 0;
  visibility: hidden;
  transition: opacity .2s ease;
  z-index: 90;
}

@media (max-width: 991.98px) {
  #sidebar {
    transform: translateX(-100%);
    z-index: 110;
  }
  #sidebar.open { transform: translateX(0); }

  #sidebar-overlay.open {
    opacity: 1;
    visibility: visible;
  }

  #main { margin-left: 0; }

  .mobile-menu-btn {
    display: inline-flex;
    margin-right: 10px;
  }

  .topbar {
    padding: 12px 16px;
  }

  .topbar-title { font-size: 18px; }
  .topbar-subtitle { font-size: 11px; }

  #page-content { padding: 16px; }

  .section-title { font-size: 20px; }
  .section-subtitle { margin-bottom: 14px; }

  .table-custom th,
  .table-custom td {
    white-space: nowrap;
  }

  .panel-header {
    flex-wrap: wrap;
    gap: 10px;
  }

  .panel-header .search-box {
    width: 100%;
  }

  .panel-header .search-box input {
    width: 100% !important;
  }
}

@media (max-width: 575.98px) {
  .topbar-right .school-badge {
    display: none;
  }

  .stat-card {
    padding: 18px;
  }

  .card-panel .panel-header {
    padding: 14px 16px;
  }

  .page-actions {
    width: 100%;
  }

  .page-actions .btn {
    flex: 1;
    min-width: 120px;
  }
}

@media print {
  body { background: #fff !important; }
  body * { visibility: hidden !important; }
  #report-content, #report-content * { visibility: visible !important; }
  #report-content {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
  }
}
</style>
</head>
<body>

<!-- SIDEBAR -->
<div id="sidebar">
  <div class="sidebar-brand">
    <span class="badge-pill">PLSP</span>
    <h5>Quality Assurance<br>Management System</h5>
    <small>Byte Bandits</small>
  </div>
  <nav class="sidebar-nav">
    <div class="nav-section-label">Overview</div>
    <a href="#" data-page="dashboard" class="active">
      <i class="fa-solid fa-chart-pie"></i> Dashboard
    </a>
    <div class="nav-section-label">QA Indicators</div>
    <a href="#" data-page="indicators">
      <i class="fa-solid fa-bullseye"></i> KPI Indicators
    </a>
    <a href="#" data-page="records">
      <i class="fa-solid fa-clipboard-list"></i> Performance Records
    </a>
    <div class="nav-section-label">Surveys</div>
    <a href="#" data-page="surveys">
      <i class="fa-solid fa-poll"></i> Surveys
    </a>
    <a href="#" data-page="responses">
      <i class="fa-solid fa-comments"></i> Survey Responses
    </a>
    <div class="nav-section-label">Reports</div>
    <a href="#" data-page="report">
      <i class="fa-solid fa-file-chart-column"></i> QA Report
    </a>
  </nav>
  <div class="sidebar-footer">
    <i class="fa-solid fa-circle" style="color:var(--green);font-size:8px"></i>&nbsp; System Online
  </div>
</div>
<div id="sidebar-overlay"></div>

<!-- MAIN -->
<div id="main">
  <div class="topbar">
    <div class="d-flex align-items-center">
      <button class="mobile-menu-btn" id="menuToggleBtn" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars"></i>
      </button>
      <div>
        <div class="topbar-title" id="page-title">Dashboard</div>
        <div class="topbar-subtitle d-none d-sm-block" id="page-subtitle">Quality Assurance Management System</div>
      </div>
    </div>
    <div class="topbar-right">
      <span class="school-badge"><i class="fa-solid fa-university me-1"></i> PLSP</span>
    </div>
  </div>
  <div id="page-content"></div>
</div>

<!-- TOAST -->
<div id="toast-container"></div>

<!-- MODALS -->
<!-- Indicator Modal -->
<div class="modal fade" id="indicatorModal" tabindex="-1">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="indicatorModalTitle">Add KPI Indicator</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <input type="hidden" id="ind_id">
        <div class="mb-3">
          <label class="form-label">Indicator Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="ind_name" placeholder="e.g. Graduation Rate">
        </div>
        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea class="form-control" id="ind_desc" rows="3" placeholder="Describe this KPI..."></textarea>
        </div>
        <div class="mb-1">
          <label class="form-label">Target Value (%) <span class="text-danger">*</span></label>
          <input type="number" class="form-control" id="ind_target" placeholder="e.g. 85" min="0" step="0.01">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-gold" id="saveIndicatorBtn">Save Indicator</button>
      </div>
    </div>
  </div>
</div>

<!-- Record Modal -->
<div class="modal fade" id="recordModal" tabindex="-1">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="recordModalTitle">Add Performance Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <input type="hidden" id="rec_id">
        <div class="mb-3">
          <label class="form-label">KPI Indicator <span class="text-danger">*</span></label>
          <select class="form-select" id="rec_indicator"></select>
        </div>
        <div class="mb-3">
          <label class="form-label">Year <span class="text-danger">*</span></label>
          <input type="number" class="form-control" id="rec_year" placeholder="e.g. 2024" min="2000" max="2100">
        </div>
        <div class="mb-1">
          <label class="form-label">Actual Value (%) <span class="text-danger">*</span></label>
          <input type="number" class="form-control" id="rec_value" placeholder="e.g. 78.5" step="0.01">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-gold" id="saveRecordBtn">Save Record</button>
      </div>
    </div>
  </div>
</div>

<!-- Survey Modal -->
<div class="modal fade" id="surveyModal" tabindex="-1">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="surveyModalTitle">Add Survey</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <input type="hidden" id="srv_id">
        <div class="mb-3">
          <label class="form-label">Survey Title <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="srv_title" placeholder="e.g. Student Satisfaction Survey 2024">
        </div>
        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea class="form-control" id="srv_desc" rows="3" placeholder="Brief description of the survey..."></textarea>
        </div>
        <div class="mb-1">
          <label class="form-label">Date Created</label>
          <input type="date" class="form-control" id="srv_date">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-gold" id="saveSurveyBtn">Save Survey</button>
      </div>
    </div>
  </div>
</div>

<!-- Response Modal -->
<div class="modal fade" id="responseModal" tabindex="-1">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="responseModalTitle">Add Survey Response</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <input type="hidden" id="resp_id">
        <div class="mb-3">
          <label class="form-label">Survey <span class="text-danger">*</span></label>
          <select class="form-select" id="resp_survey"></select>
        </div>
        <div class="mb-3">
          <label class="form-label">Respondent Role <span class="text-danger">*</span></label>
          <select class="form-select" id="resp_role">
            <option value="">Select role...</option>
            <option>Student</option>
            <option>Employee</option>
            <option>Faculty</option>
            <option>Employer</option>
            <option>Alumni</option>
            <option>Administrator</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label">Question <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="resp_question" placeholder="e.g. How satisfied are you with the course?">
        </div>
        <div class="mb-3">
          <label class="form-label">Answer <span class="text-danger">*</span></label>
          <textarea class="form-control" id="resp_answer" rows="2" placeholder="Respondent's answer..."></textarea>
        </div>
        <div class="row">
          <div class="col-12 col-md-6">
            <label class="form-label">Rating (1–5)</label>
            <select class="form-select" id="resp_rating">
              <option value="">N/A</option>
              <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
            </select>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label">Response Date</label>
            <input type="date" class="form-control" id="resp_date">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-gold" id="saveResponseBtn">Save Response</button>
      </div>
    </div>
  </div>
</div>

<!-- Confirm Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="background:#c0392b;">
        <h5 class="modal-title">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body p-4">
        <p id="deleteMsg" class="mb-0 text-center" style="font-size:14px;"></p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-danger btn-sm" id="confirmDeleteBtn">Delete</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
const API = 'api/';
let deleteCallback = null;
let dashChart = null, ratingsChart = null;
let reportExportData = null;

// ===== TOAST =====
function toast(msg, type='success') {
  const icons = { success:'fa-check-circle', error:'fa-times-circle', info:'fa-info-circle' };
  const el = $(`<div class="toast-msg toast-${type}"><i class="fa-solid ${icons[type]}"></i> ${msg}</div>`);
  $('#toast-container').append(el);
  setTimeout(() => el.fadeOut(300, () => el.remove()), 3200);
}

// ===== AJAX HELPER =====
function api(method, endpoint, data, cb) {
  $.ajax({
    url: API + endpoint,
    method: method,
    contentType: 'application/json',
    data: data ? JSON.stringify(data) : null,
    success: res => {
      if (res.success === false) { toast(res.message, 'error'); return; }
      if (cb) cb(res.data, res.message);
    },
    error: xhr => {
      let msg = 'Request failed';
      try { msg = JSON.parse(xhr.responseText).message || msg; } catch(e) {}
      toast(msg, 'error');
    }
  });
}
function apiGet(endpoint, cb) { api('GET', endpoint, null, cb); }
function apiPost(endpoint, data, cb) { api('POST', endpoint, data, cb); }
function apiPut(endpoint, data, cb) { api('PUT', endpoint, data, cb); }
function apiDelete(endpoint, cb) { api('DELETE', endpoint, null, cb); }

// ===== STARS =====
function stars(r) {
  if (!r) return '<span class="text-muted">—</span>';
  r = parseFloat(r);
  let s = '';
  for (let i=1;i<=5;i++) s += `<i class="fa-solid fa-star${i<=r?'':'-half-stroke'} ${i<=r?'stars':'star-empty'}"></i>`;
  return s;
}

// ===== STATUS BADGE =====
function statusBadge(actual, target) {
  if (actual === null || actual === undefined || actual === '') return '<span class="badge-status badge-no-data"><i class="fa-solid fa-minus"></i> No Data</span>';
  const pct = parseFloat(actual), tgt = parseFloat(target);
  if (pct >= tgt) return '<span class="badge-status badge-met"><i class="fa-solid fa-check"></i> Met</span>';
  return '<span class="badge-status badge-unmet"><i class="fa-solid fa-xmark"></i> Below Target</span>';
}

function progressBar(actual, target) {
  if (!actual || !target) return '';
  const pct = Math.min((parseFloat(actual)/parseFloat(target))*100, 120);
  const cls = pct >= 100 ? 'met' : '';
  return `<div class="progress-bar-custom"><div class="bar ${cls}" style="width:${Math.min(pct,100)}%"></div></div>`;
}

function reportStatusText(actual, target) {
  if (actual === null || actual === undefined || actual === '') return 'No Data';
  const pct = parseFloat(actual), tgt = parseFloat(target);
  return pct >= tgt ? 'Met' : 'Below Target';
}

function csvEscape(value) {
  const str = String(value ?? '');
  return `"${str.replace(/"/g, '""')}"`;
}

function downloadTextFile(filename, content, mimeType) {
  const blob = new Blob([content], { type: mimeType });
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = filename;
  document.body.appendChild(a);
  a.click();
  a.remove();
  URL.revokeObjectURL(url);
}

function exportReportCsv() {
  if (!reportExportData) { toast('Report is still loading', 'info'); return; }
  const { indicators, surveys, generatedAt } = reportExportData;

  const summary = [
    ['Generated At', generatedAt],
    ['Total KPIs', indicators.length],
    ['Targets Met', indicators.filter(i => reportStatusText(i.latest_value, i.target_value) === 'Met').length],
    ['Below Target', indicators.filter(i => reportStatusText(i.latest_value, i.target_value) === 'Below Target').length],
    ['No Data', indicators.filter(i => reportStatusText(i.latest_value, i.target_value) === 'No Data').length]
  ];

  const lines = [];
  lines.push('"QA Report Summary"');
  summary.forEach(row => lines.push(`${csvEscape(row[0])},${csvEscape(row[1])}`));
  lines.push('');

  lines.push('"KPI Performance Summary"');
  lines.push(['Indicator','Description','Target (%)','Latest Actual (%)','Year','Status'].map(csvEscape).join(','));
  indicators.forEach(i => {
    lines.push([
      i.name,
      i.description || '',
      parseFloat(i.target_value).toFixed(2),
      i.latest_value ? parseFloat(i.latest_value).toFixed(2) : '',
      i.latest_year || '',
      reportStatusText(i.latest_value, i.target_value)
    ].map(csvEscape).join(','));
  });
  lines.push('');

  lines.push('"Surveys Overview"');
  lines.push(['Survey Title','Date','Responses'].map(csvEscape).join(','));
  surveys.forEach(s => {
    lines.push([
      s.title,
      s.created_date || '',
      s.response_count
    ].map(csvEscape).join(','));
  });

  const content = lines.join('\r\n');
  downloadTextFile('qa-report.csv', content, 'text/csv;charset=utf-8;');
}

function exportReportPdf() {
  const reportNode = document.getElementById('report-content');
  if (!reportNode || !reportNode.innerHTML.trim()) { toast('Report is still loading', 'info'); return; }

  const printWindow = window.open('', '_blank');
  if (!printWindow) { toast('Unable to open print window. Please allow pop-ups.', 'error'); return; }

  printWindow.document.write(`
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>QA Report</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
      <style>
        body { font-family: 'DM Sans', sans-serif; background: #fff; color: #0d1b2a; padding: 16px; }
        .card-panel { border: 1px solid #dde2ea; border-radius: 12px; }
        .table th, .table td { font-size: 12px; }
        .badge-status { padding: 4px 8px; border-radius: 999px; font-size: 11px; }
      </style>
    </head>
    <body>
      ${reportNode.innerHTML}
    </body>
    </html>
  `);
  printWindow.document.close();
  printWindow.focus();
  setTimeout(() => {
    printWindow.print();
    printWindow.close();
  }, 300);
}

// ===== PAGES =====
const pages = {
  dashboard: { title: 'Dashboard', subtitle: 'Quality Assurance Overview' },
  indicators: { title: 'KPI Indicators', subtitle: 'Manage performance indicators' },
  records: { title: 'Performance Records', subtitle: 'Track actual vs target values' },
  surveys: { title: 'Surveys', subtitle: 'Manage QA surveys' },
  responses: { title: 'Survey Responses', subtitle: 'Manage survey responses' },
  report: { title: 'QA Report', subtitle: 'Summary report for accreditation' }
};

function loadPage(page) {
  $('.sidebar-nav a').removeClass('active');
  $(`.sidebar-nav a[data-page="${page}"]`).addClass('active');
  $('#page-title').text(pages[page].title);
  $('#page-subtitle').text(pages[page].subtitle);
  if (dashChart) { dashChart.destroy(); dashChart = null; }
  if (ratingsChart) { ratingsChart.destroy(); ratingsChart = null; }
  window['render_'+page]();
}

$('.sidebar-nav a').on('click', function(e) {
  e.preventDefault();
  if (window.innerWidth < 992) {
    $('#sidebar').removeClass('open');
    $('#sidebar-overlay').removeClass('open');
    $('body').css('overflow', '');
  }
  loadPage($(this).data('page'));
});

$('#menuToggleBtn').on('click', function() {
  const isOpen = $('#sidebar').hasClass('open');
  $('#sidebar').toggleClass('open', !isOpen);
  $('#sidebar-overlay').toggleClass('open', !isOpen);
  $('body').css('overflow', isOpen ? '' : 'hidden');
});

$('#sidebar-overlay').on('click', function() {
  $('#sidebar').removeClass('open');
  $('#sidebar-overlay').removeClass('open');
  $('body').css('overflow', '');
});

$(window).on('resize', function() {
  if (window.innerWidth >= 992) {
    $('#sidebar').removeClass('open');
    $('#sidebar-overlay').removeClass('open');
    $('body').css('overflow', '');
  }
});

// ===== DASHBOARD =====
function render_dashboard() {
  $('#page-content').html(`
    <div class="row g-3 mb-4" id="stat-cards">
      ${[1,2,3,4].map(()=>`<div class="col-6 col-lg-3"><div class="stat-card"><div class="placeholder-glow"><span class="placeholder col-8"></span></div></div></div>`).join('')}
    </div>
    <div class="row g-3">
      <div class="col-lg-7">
        <div class="card-panel">
          <div class="panel-header"><h6><i class="fa-solid fa-chart-bar me-2 text-muted"></i>KPI Performance vs Targets</h6></div>
          <div class="chart-wrap"><canvas id="kpiChart" height="220"></canvas></div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card-panel h-100">
          <div class="panel-header"><h6><i class="fa-solid fa-star me-2 text-muted"></i>Survey Ratings</h6></div>
          <div class="chart-wrap"><canvas id="ratingsChart" height="220"></canvas></div>
        </div>
      </div>
    </div>
    <div class="row g-3 mt-1">
      <div class="col-12">
        <div class="card-panel">
          <div class="panel-header"><h6><i class="fa-solid fa-clock-rotate-left me-2 text-muted"></i>Recent Performance Records</h6></div>
          <div class="panel-body"><div id="recent-records-tbl"></div></div>
        </div>
      </div>
    </div>
  `);
  apiGet('dashboard.php', data => {
    $('#stat-cards').html(`
      <div class="col-6 col-lg-3"><div class="stat-card">
        <div class="icon icon-navy"><i class="fa-solid fa-bullseye"></i></div>
        <div class="value">${data.total_indicators}</div>
        <div class="label">KPI Indicators</div>
      </div></div>
      <div class="col-6 col-lg-3"><div class="stat-card">
        <div class="icon icon-gold"><i class="fa-solid fa-clipboard-check"></i></div>
        <div class="value">${data.total_records}</div>
        <div class="label">Performance Records</div>
      </div></div>
      <div class="col-6 col-lg-3"><div class="stat-card">
        <div class="icon icon-blue"><i class="fa-solid fa-poll"></i></div>
        <div class="value">${data.total_surveys}</div>
        <div class="label">Surveys</div>
      </div></div>
      <div class="col-6 col-lg-3"><div class="stat-card">
        <div class="icon icon-green"><i class="fa-solid fa-circle-check"></i></div>
        <div class="value">${data.indicators_meeting_target}</div>
        <div class="label">Targets Met</div>
      </div></div>
    `);

    // KPI Chart
    if (data.chart_data && data.chart_data.length) {
      const ctx = document.getElementById('kpiChart').getContext('2d');
      dashChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: data.chart_data.map(d => d.name.length>18 ? d.name.substring(0,18)+'…' : d.name),
          datasets: [
            { label: 'Actual', data: data.chart_data.map(d => d.actual_value || 0), backgroundColor: 'rgba(201,168,76,0.8)', borderRadius: 4 },
            { label: 'Target', data: data.chart_data.map(d => d.target_value), backgroundColor: 'rgba(13,27,42,0.15)', borderRadius: 4 }
          ]
        },
        options: {
          responsive: true, maintainAspectRatio: false,
          plugins: { legend: { position: 'top', labels: { font: { family:'DM Sans', size:12 } } } },
          scales: {
            y: { beginAtZero: true, grid: { color:'rgba(0,0,0,.05)' }, ticks: { font:{family:'DM Sans'} } },
            x: { grid: { display: false }, ticks: { font:{family:'DM Sans',size:11} } }
          }
        }
      });
    } else {
      $('#kpiChart').replaceWith('<div class="empty-state"><i class="fa-solid fa-chart-bar"></i><p>No indicator data yet</p></div>');
    }

    // Ratings Chart
    if (data.survey_ratings && data.survey_ratings.length) {
      const ctx2 = document.getElementById('ratingsChart').getContext('2d');
      ratingsChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
          labels: data.survey_ratings.map(d => d.title.length>20 ? d.title.substring(0,20)+'…' : d.title),
          datasets: [{ data: data.survey_ratings.map(d => parseFloat(d.avg_rating).toFixed(1)),
            backgroundColor: ['#c9a84c','#0d1b2a','#2e7d52','#3484d2','#e8c96a'], borderWidth: 0 }]
        },
        options: {
          responsive: true, maintainAspectRatio: false,
          plugins: { legend: { position: 'bottom', labels: { font:{family:'DM Sans',size:11}, padding:12 } } }
        }
      });
    } else {
      $('#ratingsChart').replaceWith('<div class="empty-state"><i class="fa-solid fa-star"></i><p>No survey ratings yet</p></div>');
    }

    // Recent records
    if (data.recent_records && data.recent_records.length) {
      let rows = data.recent_records.map(r => `
        <tr>
          <td>${r.indicator_name}</td>
          <td>${r.year}</td>
          <td>${parseFloat(r.actual_value).toFixed(2)}%</td>
          <td>${parseFloat(r.target_value).toFixed(2)}%</td>
          <td>${statusBadge(r.actual_value, r.target_value)}</td>
        </tr>`).join('');
      $('#recent-records-tbl').html(`
        <div class="table-wrap">
          <table class="table table-custom">
            <thead><tr><th>Indicator</th><th>Year</th><th>Actual</th><th>Target</th><th>Status</th></tr></thead>
            <tbody>${rows}</tbody>
          </table>
        </div>`);
    } else {
      $('#recent-records-tbl').html('<div class="empty-state"><i class="fa-solid fa-inbox"></i><p>No performance records yet</p></div>');
    }
  });
}

// ===== INDICATORS =====
function render_indicators() {
  $('#page-content').html(`
    <div class="page-head mb-3">
      <div>
        <div class="section-title">KPI Indicators</div>
        <div class="section-subtitle">Define quality performance indicators and their targets</div>
      </div>
      <div class="page-actions">
        <button class="btn btn-gold" id="addIndicatorBtn"><i class="fa-solid fa-plus me-2"></i>Add Indicator</button>
      </div>
    </div>
    <div class="card-panel">
      <div class="panel-header">
        <h6><i class="fa-solid fa-list me-2 text-muted"></i>All Indicators</h6>
        <div class="search-box">
          <i class="fa-solid fa-search"></i>
          <input type="text" class="form-control form-control-sm" id="indSearch" placeholder="Search..." style="width:200px;">
        </div>
      </div>
      <div class="panel-body"><div id="ind-table-wrap"></div></div>
    </div>
  `);
  loadIndicators();
  $('#addIndicatorBtn').on('click', () => openIndicatorModal());
  $('#indSearch').on('keyup', function() {
    const q = $(this).val().toLowerCase();
    $('#ind-table-wrap tbody tr').each(function() {
      $(this).toggle($(this).text().toLowerCase().includes(q));
    });
  });
}

function loadIndicators() {
  $('#ind-table-wrap').html('<div class="p-4 text-center text-muted"><i class="fa-solid fa-spinner fa-spin"></i></div>');
  apiGet('indicators.php', data => {
    if (!data || !data.length) {
      $('#ind-table-wrap').html('<div class="empty-state"><i class="fa-solid fa-bullseye"></i><p>No indicators yet. Add your first KPI.</p></div>');
      return;
    }
    let rows = data.map(d => `
      <tr>
        <td><strong>${d.name}</strong><br><small class="text-muted">${d.description || '—'}</small></td>
        <td>${parseFloat(d.target_value).toFixed(2)}%</td>
        <td>${d.latest_value !== null ? parseFloat(d.latest_value).toFixed(2)+'%' : '<span class="text-muted">—</span>'}</td>
        <td>${d.latest_year || '<span class="text-muted">—</span>'}</td>
        <td>${statusBadge(d.latest_value, d.target_value)}</td>
        <td>
          <button class="act-btn edit" onclick="editIndicator(${d.indicator_id})"><i class="fa-solid fa-pen"></i></button>
          <button class="act-btn del" onclick="deleteItem('indicator', ${d.indicator_id}, '${d.name.replace(/'/g,"\\'")}')"><i class="fa-solid fa-trash"></i></button>
        </td>
      </tr>`).join('');
    $('#ind-table-wrap').html(`
      <div class="table-wrap">
        <table class="table table-custom">
          <thead><tr><th>Indicator</th><th>Target</th><th>Latest Actual</th><th>Year</th><th>Status</th><th>Actions</th></tr></thead>
          <tbody>${rows}</tbody>
        </table>
      </div>`);
  });
}

function openIndicatorModal(id) {
  $('#ind_id').val(''); $('#ind_name').val(''); $('#ind_desc').val(''); $('#ind_target').val('');
  $('#indicatorModalTitle').text(id ? 'Edit KPI Indicator' : 'Add KPI Indicator');
  if (id) {
    apiGet('indicators.php?id='+id, d => {
      $('#ind_id').val(d.indicator_id);
      $('#ind_name').val(d.name);
      $('#ind_desc').val(d.description);
      $('#ind_target').val(d.target_value);
      new bootstrap.Modal('#indicatorModal').show();
    });
  } else { new bootstrap.Modal('#indicatorModal').show(); }
}
function editIndicator(id) { openIndicatorModal(id); }

$('#saveIndicatorBtn').on('click', () => {
  const id = $('#ind_id').val();
  const data = { name: $('#ind_name').val().trim(), description: $('#ind_desc').val().trim(), target_value: $('#ind_target').val() };
  if (!data.name || !data.target_value) { toast('Name and target are required', 'error'); return; }
  if (id) {
    data.indicator_id = id;
    $.ajax({ url: API+'indicators.php?id='+id, method:'PUT', contentType:'application/json', data:JSON.stringify(data),
      success: r => { if(!r.success){toast(r.message,'error');return;} toast('Indicator updated!'); bootstrap.Modal.getInstance('#indicatorModal').hide(); loadIndicators(); },
      error: () => toast('Update failed','error')
    });
  } else {
    apiPost('indicators.php', data, () => { toast('Indicator created!'); bootstrap.Modal.getInstance('#indicatorModal').hide(); loadIndicators(); });
  }
});

// ===== RECORDS =====
function render_records() {
  $('#page-content').html(`
    <div class="page-head mb-3">
      <div>
        <div class="section-title">Performance Records</div>
        <div class="section-subtitle">Log actual performance values per indicator and year</div>
      </div>
      <div class="page-actions">
        <button class="btn btn-gold" id="addRecordBtn"><i class="fa-solid fa-plus me-2"></i>Add Record</button>
      </div>
    </div>
    <div class="card-panel">
      <div class="panel-header">
        <h6><i class="fa-solid fa-table me-2 text-muted"></i>All Records</h6>
        <div class="search-box">
          <i class="fa-solid fa-search"></i>
          <input type="text" class="form-control form-control-sm" id="recSearch" placeholder="Search..." style="width:200px;">
        </div>
      </div>
      <div class="panel-body"><div id="rec-table-wrap"></div></div>
    </div>
  `);
  loadRecords();
  $('#addRecordBtn').on('click', () => openRecordModal());
  $('#recSearch').on('keyup', function() {
    const q = $(this).val().toLowerCase();
    $('#rec-table-wrap tbody tr').each(function() { $(this).toggle($(this).text().toLowerCase().includes(q)); });
  });
}

function loadRecords() {
  $('#rec-table-wrap').html('<div class="p-4 text-center text-muted"><i class="fa-solid fa-spinner fa-spin"></i></div>');
  apiGet('records.php', data => {
    if (!data || !data.length) {
      $('#rec-table-wrap').html('<div class="empty-state"><i class="fa-solid fa-clipboard-list"></i><p>No records yet.</p></div>');
      return;
    }
    let rows = data.map(d => {
      const pct = d.target_value ? ((parseFloat(d.actual_value)/parseFloat(d.target_value))*100).toFixed(1) : '—';
      return `<tr>
        <td><strong>${d.indicator_name}</strong></td>
        <td>${d.year}</td>
        <td>${parseFloat(d.actual_value).toFixed(2)}%</td>
        <td>${parseFloat(d.target_value).toFixed(2)}%</td>
        <td>
          ${statusBadge(d.actual_value, d.target_value)}
          ${progressBar(d.actual_value, d.target_value)}
        </td>
        <td>
          <button class="act-btn edit" onclick="editRecord(${d.record_id})"><i class="fa-solid fa-pen"></i></button>
          <button class="act-btn del" onclick="deleteItem('record', ${d.record_id}, '${d.indicator_name.replace(/'/g,"\\'")} (${d.year})')"><i class="fa-solid fa-trash"></i></button>
        </td>
      </tr>`;
    }).join('');
    $('#rec-table-wrap').html(`
      <div class="table-wrap">
        <table class="table table-custom">
          <thead><tr><th>Indicator</th><th>Year</th><th>Actual</th><th>Target</th><th>Status</th><th>Actions</th></tr></thead>
          <tbody>${rows}</tbody>
        </table>
      </div>`);
  });
}

function openRecordModal(id) {
  $('#rec_id').val(''); $('#rec_indicator').html(''); $('#rec_year').val(''); $('#rec_value').val('');
  $('#rec_year').val(new Date().getFullYear());
  $('#recordModalTitle').text(id ? 'Edit Record' : 'Add Performance Record');
  apiGet('indicators.php', inds => {
    const opts = inds.map(i => `<option value="${i.indicator_id}">${i.name}</option>`).join('');
    $('#rec_indicator').html('<option value="">Select indicator...</option>' + opts);
    if (id) {
      apiGet('records.php?id='+id, d => {
        $('#rec_id').val(d.record_id);
        $('#rec_indicator').val(d.indicator_id);
        $('#rec_year').val(d.year);
        $('#rec_value').val(d.actual_value);
        new bootstrap.Modal('#recordModal').show();
      });
    } else { new bootstrap.Modal('#recordModal').show(); }
  });
}
function editRecord(id) { openRecordModal(id); }

$('#saveRecordBtn').on('click', () => {
  const id = $('#rec_id').val();
  const data = { indicator_id: $('#rec_indicator').val(), year: $('#rec_year').val(), actual_value: $('#rec_value').val() };
  if (!data.indicator_id || !data.year || data.actual_value === '') { toast('All fields are required','error'); return; }
  if (id) {
    data.record_id = id;
    $.ajax({ url: API+'records.php?id='+id, method:'PUT', contentType:'application/json', data:JSON.stringify(data),
      success: r => { if(!r.success){toast(r.message,'error');return;} toast('Record updated!'); bootstrap.Modal.getInstance('#recordModal').hide(); loadRecords(); },
      error: () => toast('Update failed','error')
    });
  } else {
    apiPost('records.php', data, () => { toast('Record added!'); bootstrap.Modal.getInstance('#recordModal').hide(); loadRecords(); });
  }
});

// ===== SURVEYS =====
function render_surveys() {
  $('#page-content').html(`
    <div class="page-head mb-3">
      <div>
        <div class="section-title">Surveys</div>
        <div class="section-subtitle">Manage QA feedback surveys</div>
      </div>
      <div class="page-actions">
        <button class="btn btn-gold" id="addSurveyBtn"><i class="fa-solid fa-plus me-2"></i>Add Survey</button>
      </div>
    </div>
    <div class="card-panel">
      <div class="panel-header"><h6><i class="fa-solid fa-poll me-2 text-muted"></i>All Surveys</h6></div>
      <div class="panel-body"><div id="srv-table-wrap"></div></div>
    </div>
  `);
  loadSurveys();
  $('#addSurveyBtn').on('click', () => openSurveyModal());
}

function loadSurveys() {
  $('#srv-table-wrap').html('<div class="p-4 text-center text-muted"><i class="fa-solid fa-spinner fa-spin"></i></div>');
  apiGet('surveys.php', data => {
    if (!data || !data.length) {
      $('#srv-table-wrap').html('<div class="empty-state"><i class="fa-solid fa-poll"></i><p>No surveys yet.</p></div>');
      return;
    }
    let rows = data.map(d => `
      <tr>
        <td><strong>${d.title}</strong><br><small class="text-muted">${d.description || '—'}</small></td>
        <td>${d.created_date || '—'}</td>
        <td><span class="badge bg-light text-dark border">${d.response_count} responses</span></td>
        <td>
          <button class="act-btn edit" onclick="editSurvey(${d.survey_id})"><i class="fa-solid fa-pen"></i></button>
          <button class="act-btn del" onclick="deleteItem('survey', ${d.survey_id}, '${d.title.replace(/'/g,"\\'")}')"><i class="fa-solid fa-trash"></i></button>
        </td>
      </tr>`).join('');
    $('#srv-table-wrap').html(`
      <div class="table-wrap">
        <table class="table table-custom">
          <thead><tr><th>Survey</th><th>Date Created</th><th>Responses</th><th>Actions</th></tr></thead>
          <tbody>${rows}</tbody>
        </table>
      </div>`);
  });
}

function openSurveyModal(id) {
  $('#srv_id').val(''); $('#srv_title').val(''); $('#srv_desc').val('');
  $('#srv_date').val(new Date().toISOString().split('T')[0]);
  $('#surveyModalTitle').text(id ? 'Edit Survey' : 'Add Survey');
  if (id) {
    apiGet('surveys.php?id='+id, d => {
      $('#srv_id').val(d.survey_id); $('#srv_title').val(d.title);
      $('#srv_desc').val(d.description); $('#srv_date').val(d.created_date);
      new bootstrap.Modal('#surveyModal').show();
    });
  } else { new bootstrap.Modal('#surveyModal').show(); }
}
function editSurvey(id) { openSurveyModal(id); }

$('#saveSurveyBtn').on('click', () => {
  const id = $('#srv_id').val();
  const data = { title: $('#srv_title').val().trim(), description: $('#srv_desc').val().trim(), created_date: $('#srv_date').val() };
  if (!data.title) { toast('Title is required','error'); return; }
  if (id) {
    data.survey_id = id;
    $.ajax({ url: API+'surveys.php?id='+id, method:'PUT', contentType:'application/json', data:JSON.stringify(data),
      success: r => { if(!r.success){toast(r.message,'error');return;} toast('Survey updated!'); bootstrap.Modal.getInstance('#surveyModal').hide(); loadSurveys(); },
      error: () => toast('Update failed','error')
    });
  } else {
    apiPost('surveys.php', data, () => { toast('Survey created!'); bootstrap.Modal.getInstance('#surveyModal').hide(); loadSurveys(); });
  }
});

// ===== RESPONSES =====
function render_responses() {
  $('#page-content').html(`
    <div class="page-head mb-3">
      <div>
        <div class="section-title">Survey Responses</div>
        <div class="section-subtitle">Manage all survey responses and feedback</div>
      </div>
      <div class="page-actions">
        <button class="btn btn-gold" id="addRespBtn"><i class="fa-solid fa-plus me-2"></i>Add Response</button>
      </div>
    </div>
    <div class="card-panel">
      <div class="panel-header">
        <h6><i class="fa-solid fa-comments me-2 text-muted"></i>All Responses</h6>
        <div class="search-box">
          <i class="fa-solid fa-search"></i>
          <input type="text" class="form-control form-control-sm" id="respSearch" placeholder="Search..." style="width:200px;">
        </div>
      </div>
      <div class="panel-body"><div id="resp-table-wrap"></div></div>
    </div>
  `);
  loadResponses();
  $('#addRespBtn').on('click', () => openResponseModal());
  $('#respSearch').on('keyup', function() {
    const q = $(this).val().toLowerCase();
    $('#resp-table-wrap tbody tr').each(function() { $(this).toggle($(this).text().toLowerCase().includes(q)); });
  });
}

function loadResponses() {
  $('#resp-table-wrap').html('<div class="p-4 text-center text-muted"><i class="fa-solid fa-spinner fa-spin"></i></div>');
  apiGet('responses.php', data => {
    if (!data || !data.length) {
      $('#resp-table-wrap').html('<div class="empty-state"><i class="fa-solid fa-comments"></i><p>No responses yet.</p></div>');
      return;
    }
    let rows = data.map(d => `
      <tr>
        <td><strong>${d.survey_title}</strong></td>
        <td><span class="badge bg-light text-dark border">${d.respondent_role}</span></td>
        <td style="max-width:220px;">${d.question}</td>
        <td style="max-width:200px;"><small>${d.answer}</small></td>
        <td>${d.rating ? `<span class="rating-pill"><i class="fa-solid fa-star"></i> ${d.rating}/5</span>` : '<span class="text-muted">—</span>'}</td>
        <td><small>${d.response_date || '—'}</small></td>
        <td>
          <button class="act-btn edit" onclick="editResponse(${d.response_id})"><i class="fa-solid fa-pen"></i></button>
          <button class="act-btn del" onclick="deleteItem('response', ${d.response_id}, 'this response')"><i class="fa-solid fa-trash"></i></button>
        </td>
      </tr>`).join('');
    $('#resp-table-wrap').html(`
      <div class="table-wrap">
        <table class="table table-custom">
          <thead><tr><th>Survey</th><th>Role</th><th>Question</th><th>Answer</th><th>Rating</th><th>Date</th><th>Actions</th></tr></thead>
          <tbody>${rows}</tbody>
        </table>
      </div>`);
  });
}

function openResponseModal(id) {
  $('#resp_id').val(''); $('#resp_question').val(''); $('#resp_answer').val('');
  $('#resp_role').val(''); $('#resp_rating').val('');
  $('#resp_date').val(new Date().toISOString().split('T')[0]);
  $('#responseModalTitle').text(id ? 'Edit Response' : 'Add Survey Response');
  apiGet('surveys.php', srvs => {
    const opts = srvs.map(s => `<option value="${s.survey_id}">${s.title}</option>`).join('');
    $('#resp_survey').html('<option value="">Select survey...</option>' + opts);
    if (id) {
      apiGet('responses.php?id='+id, d => {
        $('#resp_id').val(d.response_id); $('#resp_survey').val(d.survey_id);
        $('#resp_role').val(d.respondent_role); $('#resp_question').val(d.question);
        $('#resp_answer').val(d.answer); $('#resp_rating').val(d.rating || '');
        $('#resp_date').val(d.response_date);
        new bootstrap.Modal('#responseModal').show();
      });
    } else { new bootstrap.Modal('#responseModal').show(); }
  });
}
function editResponse(id) { openResponseModal(id); }

$('#saveResponseBtn').on('click', () => {
  const id = $('#resp_id').val();
  const data = {
    survey_id: $('#resp_survey').val(), respondent_role: $('#resp_role').val(),
    question: $('#resp_question').val().trim(), answer: $('#resp_answer').val().trim(),
    rating: $('#resp_rating').val(), response_date: $('#resp_date').val()
  };
  if (!data.survey_id || !data.respondent_role || !data.question || !data.answer) { toast('Required fields missing','error'); return; }
  if (id) {
    data.response_id = id;
    $.ajax({ url: API+'responses.php?id='+id, method:'PUT', contentType:'application/json', data:JSON.stringify(data),
      success: r => { if(!r.success){toast(r.message,'error');return;} toast('Response updated!'); bootstrap.Modal.getInstance('#responseModal').hide(); loadResponses(); },
      error: () => toast('Update failed','error')
    });
  } else {
    apiPost('responses.php', data, () => { toast('Response added!'); bootstrap.Modal.getInstance('#responseModal').hide(); loadResponses(); });
  }
});

// ===== REPORT =====
function render_report() {
  $('#page-content').html(`
    <div class="page-head mb-3">
      <div>
        <div class="section-title">QA Report</div>
        <div class="section-subtitle">Comprehensive summary for accreditation and review</div>
      </div>
      <div class="page-actions">
        <button class="btn btn-outline-navy" onclick="exportReportCsv()"><i class="fa-solid fa-file-csv me-2"></i>CSV</button>
        <button class="btn btn-navy" onclick="exportReportPdf()"><i class="fa-solid fa-file-pdf me-2"></i>PDF</button>
      </div>
    </div>
    <div id="report-content"><div class="p-4 text-center text-muted"><i class="fa-solid fa-spinner fa-spin"></i></div></div>
  `);
  Promise.all([
    new Promise(r => apiGet('indicators.php', r)),
    new Promise(r => apiGet('records.php', r)),
    new Promise(r => apiGet('surveys.php', r)),
    new Promise(r => apiGet('dashboard.php', r))
  ]).then(([indicators, records, surveys, dash]) => {
    const generatedAt = new Date().toLocaleDateString('en-PH', {year:'numeric',month:'long',day:'numeric'});
    reportExportData = { indicators, surveys, generatedAt };
    const met = indicators.filter(i => i.latest_value !== null && parseFloat(i.latest_value) >= parseFloat(i.target_value)).length;
    const unmet = indicators.filter(i => i.latest_value !== null && parseFloat(i.latest_value) < parseFloat(i.target_value)).length;
    const noData = indicators.filter(i => i.latest_value === null || i.latest_value === '').length;
    let indRows = indicators.map(i => `
      <tr>
        <td>${i.name}</td>
        <td>${i.description || '—'}</td>
        <td>${parseFloat(i.target_value).toFixed(2)}%</td>
        <td>${i.latest_value ? parseFloat(i.latest_value).toFixed(2)+'%' : '—'}</td>
        <td>${i.latest_year || '—'}</td>
        <td>${statusBadge(i.latest_value, i.target_value)}</td>
      </tr>`).join('');
    let srvRows = surveys.map(s => `<tr><td>${s.title}</td><td>${s.created_date||'—'}</td><td>${s.response_count}</td></tr>`).join('');
    $('#report-content').html(`
      <div class="card-panel mb-3 p-4">
        <div style="text-align:center;border-bottom:2px solid var(--navy);padding-bottom:16px;margin-bottom:20px;">
          <h4 style="font-family:'DM Serif Display',serif;color:var(--navy);">Pamantasan ng Lungsod ng San Pablo</h4>
          <h6 style="color:var(--gold);">Quality Assurance Management System</h6>
          <small class="text-muted">Generated: ${generatedAt}</small>
        </div>
        <div class="row g-3 mb-4">
          <div class="col-6 col-md-3 text-center"><div style="font-size:28px;font-weight:700;color:var(--navy);">${indicators.length}</div><div style="font-size:12px;color:var(--text-muted);">Total KPIs</div></div>
          <div class="col-6 col-md-3 text-center"><div style="font-size:28px;font-weight:700;color:var(--green);">${met}</div><div style="font-size:12px;color:var(--text-muted);">Targets Met</div></div>
          <div class="col-6 col-md-3 text-center"><div style="font-size:28px;font-weight:700;color:var(--red);">${unmet}</div><div style="font-size:12px;color:var(--text-muted);">Below Target</div></div>
          <div class="col-6 col-md-3 text-center"><div style="font-size:28px;font-weight:700;color:var(--text-muted);">${noData}</div><div style="font-size:12px;color:var(--text-muted);">No Data</div></div>
        </div>
        <h6 style="font-weight:700;margin-bottom:12px;border-bottom:1px solid var(--border);padding-bottom:8px;">KPI Performance Summary</h6>
        <div class="table-wrap">
          <table class="table table-custom mb-4">
            <thead><tr><th>Indicator</th><th>Description</th><th>Target</th><th>Latest Actual</th><th>Year</th><th>Status</th></tr></thead>
            <tbody>${indRows || '<tr><td colspan="6" class="text-center text-muted">No indicators</td></tr>'}</tbody>
          </table>
        </div>
        <h6 style="font-weight:700;margin-bottom:12px;border-bottom:1px solid var(--border);padding-bottom:8px;">Surveys Overview</h6>
        <div class="table-wrap">
          <table class="table table-custom">
            <thead><tr><th>Survey Title</th><th>Date</th><th>Responses</th></tr></thead>
            <tbody>${srvRows || '<tr><td colspan="3" class="text-center text-muted">No surveys</td></tr>'}</tbody>
          </table>
        </div>
      </div>
    `);
  });
}

// ===== DELETE =====
function deleteItem(type, id, name) {
  $('#deleteMsg').text(`Are you sure you want to delete "${name}"? This action cannot be undone.`);
  const endpoints = { indicator:'indicators.php', record:'records.php', survey:'surveys.php', response:'responses.php' };
  const loaders = { indicator: loadIndicators, record: loadRecords, survey: loadSurveys, response: loadResponses };
  deleteCallback = () => {
    apiDelete(endpoints[type]+'?id='+id, () => {
      toast(`Deleted successfully`, 'success');
      bootstrap.Modal.getInstance('#deleteModal').hide();
      loaders[type]();
    });
  };
  new bootstrap.Modal('#deleteModal').show();
}

$('#confirmDeleteBtn').on('click', () => { if (deleteCallback) deleteCallback(); });

// ===== INIT =====
$(document).ready(() => loadPage('dashboard'));
</script>
</body>
</html>
