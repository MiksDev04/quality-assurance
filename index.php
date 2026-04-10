<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quality Assurance Management System</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<style>
  body { padding: 0; margin: 0; }
  #main { display: flex; flex-direction: column; min-height: 100vh; }
  #page-content { flex: 1; padding: 20px; }
  .table-wrap { overflow-x: auto; }
  #sidebar-overlay { display: none; }
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <span class="d-none d-lg-inline">Quality Assurance Management System</span>
      <span class="d-lg-none">QA System</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="#" data-page="dashboard">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="#" data-page="indicators">KPI Indicators</a></li>
        <li class="nav-item"><a class="nav-link" href="#" data-page="records">Performance Records</a></li>
        <li class="nav-item"><a class="nav-link" href="#" data-page="surveys">Surveys</a></li>
        <li class="nav-item"><a class="nav-link" href="#" data-page="responses">Responses</a></li>
        <li class="nav-item"><a class="nav-link" href="#" data-page="report">Report</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- MAIN -->
<div id="main">
  <div id="page-content" class="container-fluid"></div>
</div>

<!-- TOAST CONTAINER -->
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 11">
  <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header" id="toastHeader">
      <i class="fa-solid fa-check-circle me-2"></i>
      <strong class="me-auto">Notification</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body" id="toastBody">
      Message here
    </div>
  </div>
</div>

<!-- MODALS -->
<!-- Indicator Modal -->
<div class="modal fade" id="indicatorModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="indicatorModalTitle">Add KPI Indicator</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="ind_errors" class="alert alert-danger d-none" role="alert"></div>
        <input type="hidden" id="ind_id">
        <div class="mb-3">
          <label class="form-label">Indicator Name <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="ind_name" placeholder="e.g. Graduation Rate">
        </div>
        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea class="form-control" id="ind_desc" rows="3" placeholder="Describe this KPI..."></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Target Value (%) <span class="text-danger">*</span></label>
          <input type="number" class="form-control" id="ind_target" placeholder="e.g. 85" min="0" step="0.01">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="saveIndicatorBtn">Save Indicator</button>
      </div>
    </div>
  </div>
</div>

<!-- Record Modal -->
<div class="modal fade" id="recordModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="recordModalTitle">Add Performance Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="rec_errors" class="alert alert-danger d-none" role="alert"></div>
        <input type="hidden" id="rec_id">
        <div class="mb-3">
          <label class="form-label">KPI Indicator <span class="text-danger">*</span></label>
          <select class="form-select" id="rec_indicator"></select>
        </div>
        <div class="mb-3">
          <label class="form-label">Year <span class="text-danger">*</span></label>
          <input type="number" class="form-control" id="rec_year" placeholder="e.g. 2024" min="2000" max="2100">
        </div>
        <div class="mb-3">
          <label class="form-label">Actual Value (%) <span class="text-danger">*</span></label>
          <input type="number" class="form-control" id="rec_value" placeholder="e.g. 78.5" step="0.01">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="saveRecordBtn">Save Record</button>
      </div>
    </div>
  </div>
</div>

<!-- Survey Modal -->
<div class="modal fade" id="surveyModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="surveyModalTitle">Add Survey</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="srv_errors" class="alert alert-danger d-none" role="alert"></div>
        <input type="hidden" id="srv_id">
        <div class="mb-3">
          <label class="form-label">Survey Title <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="srv_title" placeholder="e.g. Student Satisfaction Survey 2024">
        </div>
        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea class="form-control" id="srv_desc" rows="3" placeholder="Brief description of the survey..."></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label">Date Created</label>
          <input type="date" class="form-control" id="srv_date">
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="saveSurveyBtn">Save Survey</button>
      </div>
    </div>
  </div>
</div>

<!-- Response Modal -->
<div class="modal fade" id="responseModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="responseModalTitle">Add Survey Response</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="resp_errors" class="alert alert-danger d-none" role="alert"></div>
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
          <div class="col-md-6">
            <label class="form-label">Rating (1–5)</label>
            <select class="form-select" id="resp_rating">
              <option value="">N/A</option>
              <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Response Date</label>
            <input type="date" class="form-control" id="resp_date">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="saveResponseBtn">Save Response</button>
      </div>
    </div>
  </div>
</div>

<!-- Confirm Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirm Delete</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p id="deleteMsg" class="mb-0"></p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
const API = 'api/';
let deleteCallback = null;
let dashChart = null, ratingsChart = null;
let reportExportData = null;

// ===== TOAST =====
function toast(msg, type='success') {
  const icons = { success:'fa-check-circle', error:'fa-exclamation-circle', info:'fa-info-circle' };
  const headerBg = { success:'bg-success', error:'bg-danger', info:'bg-info' };
  const textColor = { success:'text-success', error:'text-danger', info:'text-info' };

  const $toast = $('#liveToast');
  const $header = $('#toastHeader');
  const $body = $('#toastBody');

  // Update toast styling
  $header.removeClass('bg-success bg-danger bg-info text-white').addClass(headerBg[type] + ' text-white');
  $header.html(`<i class="fa-solid ${icons[type]} me-2"></i><strong class="me-auto">Notification</strong><button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>`);
  $body.html(msg);

  // Show the toast
  const bsToast = new bootstrap.Toast($toast);
  bsToast.show();
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

// ===== PAGINATION STATE =====
const pagination = {
  indicators: { page: 1, perPage: 10, totalItems: 0 },
  records: { page: 1, perPage: 10, totalItems: 0 },
  surveys: { page: 1, perPage: 10, totalItems: 0 },
  responses: { page: 1, perPage: 10, totalItems: 0 }
};

function paginatedData(data, type) {
  if (!data || !data.length) return { items: [], total: 0 };
  const pag = pagination[type];
  pag.totalItems = data.length;
  const start = (pag.page - 1) * pag.perPage;
  const end = start + pag.perPage;
  return { items: data.slice(start, end), total: data.length };
}

function renderPagination(type, containerId) {
  const pag = pagination[type];
  if (pag.totalItems === 0) return;
  const totalPages = Math.ceil(pag.totalItems / pag.perPage);
  
  let html = `<div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center gap-3 mt-4 pt-3 border-top">
    <div class="d-flex align-items-center gap-2">
      <label class="text-muted small mb-0">Per page:</label>
      <select class="form-select form-select-sm" style="width:80px;" id="${type}-rpp">
        <option value="10" ${pag.perPage === 10 ? 'selected' : ''}>10</option>
        <option value="20" ${pag.perPage === 20 ? 'selected' : ''}>20</option>
        <option value="30" ${pag.perPage === 30 ? 'selected' : ''}>30</option>
        <option value="50" ${pag.perPage === 50 ? 'selected' : ''}>50</option>
      </select>
    </div>
    <div class="text-muted small text-center flex-grow-1">
      <span class="d-none d-md-inline">Showing </span>${(pag.page-1)*pag.perPage+1}–${Math.min(pag.page*pag.perPage, pag.totalItems)} of ${pag.totalItems}
    </div>
    <nav class="d-flex justify-content-center justify-content-md-end">
      <ul class="pagination pagination-sm mb-0">
        <li class="page-item ${pag.page === 1 ? 'disabled' : ''}">
          <a class="page-link" href="#" onclick="goPage('${type}', ${pag.page-1}); return false;">←</a>
        </li>`;
  for (let i = 1; i <= totalPages; i++) {
    if (i >= pag.page - 1 && i <= pag.page + 1) {
      html += `<li class="page-item ${i === pag.page ? 'active' : ''}">
        <a class="page-link" href="#" onclick="goPage('${type}', ${i}); return false;">${i}</a>
      </li>`;
    }
  }
  html += `<li class="page-item ${pag.page === totalPages ? 'disabled' : ''}">
    <a class="page-link" href="#" onclick="goPage('${type}', ${pag.page+1}); return false;">→</a>
  </li></ul></nav></div>`;
  
  $(`#${containerId}`).append(html);
  $(`#${type}-rpp`).on('change', function() {
    pagination[type].perPage = parseInt($(this).val());
    pagination[type].page = 1;
    $(`#${containerId}`).find('.pagination, .d-flex').remove();
    eval(`load${type.charAt(0).toUpperCase() + type.slice(1)}()`);
  });
}

function goPage(type, page) {
  pagination[type].page = page;
  eval(`load${type.charAt(0).toUpperCase() + type.slice(1)}()`);
}

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
  if (actual === null || actual === undefined || actual === '') return '<span class="badge bg-light text-dark"><i class="fa-solid fa-minus"></i> No Data</span>';
  const pct = parseFloat(actual), tgt = parseFloat(target);
  if (pct >= tgt) return '<span class="badge bg-success"><i class="fa-solid fa-check"></i> Met</span>';
  return '<span class="badge bg-danger"><i class="fa-solid fa-xmark"></i> Below Target</span>';
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
  const { indicators, surveys, responses, records, generatedAt } = reportExportData;

  // Calculate survey ratings
  const surveyRatings = {};
  responses.forEach(resp => {
    if (!surveyRatings[resp.survey_id]) {
      surveyRatings[resp.survey_id] = { ratings: [] };
    }
    if (resp.rating) surveyRatings[resp.survey_id].ratings.push(parseFloat(resp.rating));
  });

  // Calculate survey metrics
  const totalResponses = responses.length;
  const ratedResponses = responses.filter(r => r.rating).length;
  const avgRating = ratedResponses > 0
    ? (responses.filter(r => r.rating).reduce((sum, r) => sum + parseFloat(r.rating), 0) / ratedResponses).toFixed(2)
    : '—';

  const met = indicators.filter(i => {
    const indRecords = records.filter(r => r.indicator_id === i.indicator_id);
    if (indRecords.length === 0) return false;
    const latest = indRecords.reduce((prev, current) => (parseInt(current.year) > parseInt(prev.year)) ? current : prev);
    return parseFloat(latest.actual_value) >= parseFloat(i.target_value);
  }).length;
  const unmet = indicators.filter(i => {
    const indRecords = records.filter(r => r.indicator_id === i.indicator_id);
    if (indRecords.length === 0) return false;
    const latest = indRecords.reduce((prev, current) => (parseInt(current.year) > parseInt(prev.year)) ? current : prev);
    return parseFloat(latest.actual_value) < parseFloat(i.target_value);
  }).length;
  const noData = indicators.filter(i => {
    const indRecords = records.filter(r => r.indicator_id === i.indicator_id);
    return indRecords.length === 0;
  }).length;

  const lines = [];

  // Header
  lines.push('"QUALITY ASSURANCE MANAGEMENT SYSTEM REPORT"');
  lines.push(`"Generated: ${generatedAt}"`);
  lines.push('');

  // KPI Performance Overview
  lines.push('"KPI PERFORMANCE OVERVIEW"');
  lines.push(['Metric', 'Value'].map(csvEscape).join(','));
  lines.push([`Total KPIs`, indicators.length].map(csvEscape).join(','));
  lines.push([`Targets Met`, met].map(csvEscape).join(','));
  lines.push([`Below Target`, unmet].map(csvEscape).join(','));
  lines.push([`No Data`, noData].map(csvEscape).join(','));
  lines.push([`Achievement Rate`, indicators.length > 0 ? `${Math.round((met/indicators.length)*100)}%` : '0%'].map(csvEscape).join(','));
  lines.push('');

  // Survey & Feedback Overview
  lines.push('"SURVEY & FEEDBACK OVERVIEW"');
  lines.push(['Metric', 'Value'].map(csvEscape).join(','));
  lines.push([`Total Surveys`, surveys.length].map(csvEscape).join(','));
  lines.push([`Total Responses`, totalResponses].map(csvEscape).join(','));
  lines.push([`Rated Responses`, ratedResponses].map(csvEscape).join(','));
  lines.push([`Average Rating (out of 5)`, avgRating].map(csvEscape).join(','));
  lines.push('');

  // KPI Performance Summary - now using filtered records
  lines.push('"KPI PERFORMANCE SUMMARY"');
  lines.push(['Indicator','Description','Target (%)','Actual (%)','Year','Status'].map(csvEscape).join(','));
  records.forEach(r => {
    const indicator = indicators.find(i => i.indicator_id === r.indicator_id);
    if (indicator) {
      lines.push([
        indicator.name,
        indicator.description || '',
        parseFloat(indicator.target_value).toFixed(2),
        parseFloat(r.actual_value).toFixed(2),
        r.year,
        parseFloat(r.actual_value) >= parseFloat(indicator.target_value) ? 'Met' : 'Below Target'
      ].map(csvEscape).join(','));
    }
  });
  lines.push('');

  // Survey Responses & Ratings
  lines.push('"SURVEY RESPONSES & RATINGS"');
  lines.push(['Survey Title','Description','Date Created','Response Count','Average Rating','Rated Responses Count'].map(csvEscape).join(','));
  surveys.forEach(s => {
    const avgRating = surveyRatings[s.survey_id] && surveyRatings[s.survey_id].ratings.length > 0
      ? (surveyRatings[s.survey_id].ratings.reduce((a, b) => a + b) / surveyRatings[s.survey_id].ratings.length).toFixed(2)
      : '—';
    lines.push([
      s.title,
      s.description || '',
      s.created_date || '',
      s.response_count,
      avgRating,
      surveyRatings[s.survey_id] ? surveyRatings[s.survey_id].ratings.length : 0
    ].map(csvEscape).join(','));
  });
  lines.push('');

  // Report Summary
  lines.push('"REPORT SUMMARY"');
  lines.push([
    `This comprehensive Quality Assurance report presents key performance metrics across two dimensions: KPI achievement against institutional targets and stakeholder satisfaction through survey feedback. The KPI section shows ${indicators.length} total indicators with ${met} meeting targets (${indicators.length > 0 ? Math.round((met/indicators.length)*100) : 0}% achievement rate), while the survey section captures feedback from ${surveys.length} surveys with ${totalResponses} responses and an overall satisfaction rating of ${avgRating}/5.0.`
  ].map(csvEscape).join(','));

  const content = lines.join('\r\n');
  downloadTextFile('qa-report.csv', content, 'text/csv;charset=utf-8;');
  toast('✓ CSV report exported successfully!', 'success');
}

function exportReportPdf() {
  const reportNode = document.getElementById('report-content');
  if (!reportNode || !reportNode.innerHTML.trim()) { toast('Report is still loading', 'info'); return; }

  toast('Generating PDF report...', 'info');

  const element = document.createElement('div');
  element.innerHTML = reportNode.innerHTML;

  // Add formal styling for PDF
  const style = document.createElement('style');
  style.innerHTML = `
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    .card { page-break-inside: avoid; border: none; }
    h3, h5 { page-break-after: avoid; }
    table { page-break-inside: avoid; border-collapse: collapse; width: 100%; }
    thead { background-color: #f8f9fa !important; }
    tr { page-break-inside: avoid; }
    td, th { padding: 10px; border: 1px solid #dee2e6; }
    .row { page-break-inside: avoid; }
    .overflow-hidden { overflow: visible !important; }
    .table-responsive { page-break-inside: avoid; }
    div[style*="border-bottom"] { page-break-after: avoid; }
  `;
  element.appendChild(style);

  const opt = {
    margin: [15, 15, 15, 15],
    filename: 'qa-report.pdf',
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 2, useCORS: true, allowTaint: true },
    jsPDF: { orientation: 'portrait', unit: 'mm', format: 'a4' },
    pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
  };

  html2pdf().set(opt).from(element).output('blob').then(blob => {
    const url = URL.createObjectURL(blob);
    const newWindow = window.open(url, '_blank');
    if (newWindow) {
      setTimeout(() => newWindow.print(), 500);
      toast('✓ PDF opened for preview', 'success');
    } else {
      toast('Could not open print window. Please check if pop-ups are blocked.', 'error');
    }
  });
}

// ===== PAGES =====
const pages = {
  dashboard: { title: 'Dashboard' },
  indicators: { title: 'KPI Indicators' },
  records: { title: 'Performance Records' },
  surveys: { title: 'Surveys' },
  responses: { title: 'Survey Responses' },
  report: { title: 'QA Report' }
};

function loadPage(page) {
  $('.navbar-nav .nav-link').removeClass('active');
  $(`.navbar-nav [data-page="${page}"]`).addClass('active');
  window['render_'+page]();
}

$('.navbar-nav .nav-link').on('click', function(e) {
  e.preventDefault();
  const navbarCollapse = document.querySelector('.navbar-collapse');
  if (navbarCollapse.classList.contains('show')) {
    const bsCollapse = new bootstrap.Collapse(navbarCollapse, { toggle: true });
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
    <h2 class="mb-4">Dashboard</h2>
    <div class="row mb-4" id="stat-cards">
      ${[1,2,3,4].map(()=>`<div class="col-md-6 col-lg-3"><div class="card"><div class="card-body"><div class="placeholder-glow"><span class="placeholder col-8"></span></div></div></div></div>`).join('')}
    </div>
    <div class="row">
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-header">KPI Performance vs Targets</div>
          <div class="card-body"><canvas id="kpiChart" height="220"></canvas></div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-header">Survey Ratings</div>
          <div class="card-body"><canvas id="ratingsChart" height="220"></canvas></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">Recent Performance Records</div>
          <div class="card-body"><div id="recent-records-tbl"></div></div>
        </div>
      </div>
    </div>
  `);
  apiGet('dashboard.php', data => {
    $('#stat-cards').html(`
      <div class="col-md-6 col-lg-3"><div class="card"><div class="card-body">
        <div class="text-center"><h5>${data.total_indicators}</h5><p class="text-muted small mb-0">KPI Indicators</p></div>
      </div></div></div>
      <div class="col-md-6 col-lg-3"><div class="card"><div class="card-body">
        <div class="text-center"><h5>${data.total_records}</h5><p class="text-muted small mb-0">Performance Records</p></div>
      </div></div></div>
      <div class="col-md-6 col-lg-3"><div class="card"><div class="card-body">
        <div class="text-center"><h5>${data.total_surveys}</h5><p class="text-muted small mb-0">Surveys</p></div>
      </div></div></div>
      <div class="col-md-6 col-lg-3"><div class="card"><div class="card-body">
        <div class="text-center"><h5>${data.indicators_meeting_target}</h5><p class="text-muted small mb-0">Targets Met</p></div>
      </div></div></div>
    `);

    if (data.chart_data && data.chart_data.length) {
      const ctx = document.getElementById('kpiChart').getContext('2d');
      dashChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: data.chart_data.map(d => d.name.length>18 ? d.name.substring(0,18)+'…' : d.name),
          datasets: [
            { label: 'Actual', data: data.chart_data.map(d => d.actual_value || 0), backgroundColor: '#0d6efd' },
            { label: 'Target', data: data.chart_data.map(d => d.target_value), backgroundColor: '#6c757d' }
          ]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'top' } } }
      });
    } else {
      $('#kpiChart').replaceWith('<div class="text-center text-muted py-5"><i class="fa-solid fa-chart-bar"></i><p>No indicator data yet</p></div>');
    }

    if (data.survey_ratings && data.survey_ratings.length) {
      const ctx2 = document.getElementById('ratingsChart').getContext('2d');
      ratingsChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
          labels: data.survey_ratings.map(d => d.title.length>20 ? d.title.substring(0,20)+'…' : d.title),
          datasets: [{ data: data.survey_ratings.map(d => parseFloat(d.avg_rating).toFixed(1)), backgroundColor: ['#0d6efd','#6c757d','#198754','#0dcaf0','#fd7e14'] }]
        },
        options: { responsive: true, maintainAspectRatio: false }
      });
    } else {
      $('#ratingsChart').replaceWith('<div class="text-center text-muted py-5"><i class="fa-solid fa-star"></i><p>No survey ratings yet</p></div>');
    }

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
        <div class="table-responsive">
          <table class="table">
            <thead><tr><th>Indicator</th><th>Year</th><th>Actual</th><th>Target</th><th>Status</th></tr></thead>
            <tbody>${rows}</tbody>
          </table>
        </div>`);
    } else {
      $('#recent-records-tbl').html('<div class="text-center text-muted"><i class="fa-solid fa-inbox"></i><p>No performance records yet</p></div>');
    }
  });
}

// ===== INDICATORS =====
function render_indicators() {
  $('#page-content').html(`
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>KPI Indicators</h2>
      <button class="btn btn-primary" id="addIndicatorBtn"><i class="fa-solid fa-plus me-2"></i>Add Indicator</button>
    </div>
    <div class="card">
      <div class="card-header">
        <div class="mb-2">
          <span class="fw-semibold">All Indicators <span id="indCount" class="text-muted" style="font-size: 0.85rem;"></span></span>
        </div>
        <div class="row g-2 align-items-end">
          <div class="col-12 col-md-4">
            <input type="text" class="form-control form-control-sm" id="indSearch" placeholder="Search by name or description..." style="width:100%;">
          </div>
          <div class="col-6 col-md-2">
            <label class="form-label small text-muted mb-1">Target:</label>
            <input type="number" class="form-control form-control-sm" id="indFilterTarget" placeholder="%" min="0" max="100" step="0.1">
          </div>
          <div class="col-6 col-md-2">
            <label class="form-label small text-muted mb-1">Actual:</label>
            <input type="number" class="form-control form-control-sm" id="indFilterActual" placeholder="%" min="0" max="100" step="0.1">
          </div>
          <div class="col-6 col-md-1">
            <label class="form-label small text-muted mb-1">Year:</label>
            <input type="number" class="form-control form-control-sm" id="indFilterYear" placeholder="Yr" min="2000" max="2100">
          </div>
          <div class="col-6 col-md-1">
            <label class="form-label small text-muted mb-1">Status:</label>
            <select class="form-select form-select-sm" id="indFilterStatus">
              <option value="">All</option>
              <option value="met">Met</option>
              <option value="below">Below</option>
              <option value="nodata">No Data</option>
            </select>
          </div>
          <div class="col-12 col-md-2">
            <button class="btn btn-sm btn-outline-secondary w-100" id="indClearFilters">Clear</button>
          </div>
        </div>
      </div>
      <div class="card-body"><div id="ind-table-wrap"></div></div>
    </div>
  `);
  loadIndicators();
  $('#addIndicatorBtn').on('click', () => openIndicatorModal());
  
  function updateCount() {
    const visibleCount = $('#ind-table-wrap tbody tr:visible').length;
    $('#indCount').text(visibleCount);
  }
  
  function applyFilters() {
    const search = $('#indSearch').val().toLowerCase();
    const target = $('#indFilterTarget').val();
    const actual = $('#indFilterActual').val();
    const year = $('#indFilterYear').val();
    const status = $('#indFilterStatus').val();
    
    $('#ind-table-wrap tbody tr').each(function() {
      const $row = $(this);
      const text = $row.text().toLowerCase();
      const $cells = $row.find('td');
      
      let show = true;
      if (search && !text.includes(search)) show = false;
      if (target && !$cells.eq(1).text().includes(target)) show = false;
      if (actual && !$cells.eq(2).text().includes(actual)) show = false;
      if (year && !$cells.eq(3).text().includes(year)) show = false;
      if (status) {
        const statusText = $cells.eq(4).text().toLowerCase();
        if (status === 'met' && !statusText.includes('met')) show = false;
        else if (status === 'below' && !statusText.includes('below')) show = false;
        else if (status === 'nodata' && !statusText.includes('no data')) show = false;
      }
      
      $row.toggle(show);
    });
    updateCount();
  }
  
  $('#indSearch, #indFilterTarget, #indFilterActual, #indFilterYear, #indFilterStatus').on('change keyup', applyFilters);
  
  $('#indClearFilters').on('click', function() {
    $('#indSearch').val('');
    $('#indFilterTarget').val('');
    $('#indFilterActual').val('');
    $('#indFilterYear').val('');
    $('#indFilterStatus').val('');
    applyFilters();
  });
}

function loadIndicators() {
  $('#ind-table-wrap').html('<div class="text-center text-muted py-5"><i class="fa-solid fa-spinner fa-spin"></i></div>');
  apiGet('indicators.php', data => {
    if (!data || !data.length) {
      $('#ind-table-wrap').html('<div class="text-center text-muted py-5"><p>No indicators yet. Add your first KPI.</p></div>');
      return;
    }
    const paged = paginatedData(data, 'indicators');
    let rows = paged.items.map(d => `
      <tr>
        <td><strong>${d.name}</strong><br><small class="text-muted">${d.description || '—'}</small></td>
        <td>${parseFloat(d.target_value).toFixed(2)}%</td>
        <td>${d.latest_value !== null ? parseFloat(d.latest_value).toFixed(2)+'%' : '<span class="text-muted">—</span>'}</td>
        <td>${d.latest_year || '<span class="text-muted">—</span>'}</td>
        <td>${statusBadge(d.latest_value, d.target_value)}</td>
        <td>
          <button class="btn btn-sm btn-outline-primary" onclick="editIndicator(${d.indicator_id})"><i class="fa-solid fa-pen"></i></button>
          <button class="btn btn-sm btn-outline-danger" onclick="deleteItem('indicator', ${d.indicator_id}, '${d.name.replace(/'/g,"\\'")}')"><i class="fa-solid fa-trash"></i></button>
        </td>
      </tr>`).join('');
    $('#ind-table-wrap').html(`
      <div class="table-responsive">
        <table class="table">
          <thead><tr><th>Indicator</th><th>Target</th><th>Latest Actual</th><th>Year</th><th>Status</th><th>Actions</th></tr></thead>
          <tbody>${rows}</tbody>
        </table>
      </div>
      <div id="ind-pagination"></div>`);
    renderPagination('indicators', 'ind-pagination');
    $('#indCount').text('(' + paged.items.length + ')');
  });
}

function openIndicatorModal(id) {
  $('#ind_errors').addClass('d-none').html('');
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

// ===== FORM ERROR DISPLAY =====
function showFormErrors(containerId, errors) {
  const $container = $('#' + containerId);
  if (errors.length > 0) {
    const errorHTML = errors.map(err => `<div>• ${err}</div>`).join('');
    $container.html(errorHTML).removeClass('d-none');
  } else {
    $container.addClass('d-none').html('');
  }
  return errors.length === 0;
}

// ===== INDICATOR VALIDATION =====
function validateIndicator() {
  const errors = [];
  const name = $('#ind_name').val().trim();
  const target = $('#ind_target').val();

  if (!name) {
    errors.push('Indicator name is required');
  } else if (name.length > 255) {
    errors.push('Indicator name must be 255 characters or less');
  }

  if (!target) {
    errors.push('Target value is required');
  } else {
    const targetNum = parseFloat(target);
    if (isNaN(targetNum)) {
      errors.push('Target value must be a valid number');
    } else if (targetNum < 0 || targetNum > 100) {
      errors.push('Target value must be between 0 and 100');
    }
  }

  showFormErrors('ind_errors', errors);
  return errors;
}

$('#saveIndicatorBtn').on('click', () => {
  const errors = validateIndicator();
  if (errors.length > 0) return;

  const id = $('#ind_id').val();
  const data = {
    name: $('#ind_name').val().trim(),
    description: $('#ind_desc').val().trim(),
    target_value: $('#ind_target').val()
  };

  toast(id ? 'Updating indicator...' : 'Creating indicator...', 'info');

  if (id) {
    data.indicator_id = id;
    $.ajax({
      url: API+'indicators.php?id='+id,
      method:'PUT',
      contentType:'application/json',
      data:JSON.stringify(data),
      success: r => {
        if(!r.success){ toast(r.message || 'Update failed', 'error'); return; }
        toast('✓ Indicator updated successfully!', 'success');
        bootstrap.Modal.getInstance('#indicatorModal').hide();
        loadIndicators();
      },
      error: (xhr) => {
        let msg = 'Failed to update indicator';
        try { msg = JSON.parse(xhr.responseText).message || msg; } catch(e) {}
        toast(msg, 'error');
      }
    });
  } else {
    apiPost('indicators.php', data, (res, msg) => {
      toast('✓ Indicator created successfully!', 'success');
      bootstrap.Modal.getInstance('#indicatorModal').hide();
      loadIndicators();
    });
  }
});

// ===== RECORDS =====
function render_records() {
  $('#page-content').html(`
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Performance Records</h2>
      <button class="btn btn-primary" id="addRecordBtn"><i class="fa-solid fa-plus me-2"></i>Add Record</button>
    </div>
    <div class="card">
      <div class="card-header">
        <div class="mb-2">
          <span class="fw-semibold">All Records <span id="recCount" class="text-muted" style="font-size: 0.85rem;"></span></span>
        </div>
        <div class="row g-2 align-items-end">
          <div class="col-12 col-md-4">
            <input type="text" class="form-control form-control-sm" id="recSearch" placeholder="Search by indicator..." style="width:100%;">
          </div>
          <div class="col-6 col-md-2">
            <label class="form-label small text-muted mb-1">Target:</label>
            <input type="number" class="form-control form-control-sm" id="recFilterTarget" placeholder="%" min="0" max="100" step="0.1">
          </div>
          <div class="col-6 col-md-2">
            <label class="form-label small text-muted mb-1">Actual:</label>
            <input type="number" class="form-control form-control-sm" id="recFilterActual" placeholder="%" min="0" max="100" step="0.1">
          </div>
          <div class="col-6 col-md-1">
            <label class="form-label small text-muted mb-1">Year:</label>
            <input type="number" class="form-control form-control-sm" id="recFilterYear" placeholder="Yr" min="2000" max="2100">
          </div>
          <div class="col-6 col-md-1">
            <label class="form-label small text-muted mb-1">Status:</label>
            <select class="form-select form-select-sm" id="recFilterStatus">
              <option value="">All</option>
              <option value="met">Met</option>
              <option value="below">Below</option>
              <option value="nodata">No Data</option>
            </select>
          </div>
          <div class="col-12 col-md-2">
            <button class="btn btn-sm btn-outline-secondary w-100" id="recClearFilters">Clear</button>
          </div>
        </div>
      </div>
      <div class="card-body"><div id="rec-table-wrap"></div></div>
    </div>
  `);
  loadRecords();
  $('#addRecordBtn').on('click', () => openRecordModal());
  
  function updateCount() {
    const visibleCount = $('#rec-table-wrap tbody tr:visible').length;
    $('#recCount').text(visibleCount);
  }
  
  function applyFilters() {
    const search = $('#recSearch').val().toLowerCase();
    const target = $('#recFilterTarget').val();
    const actual = $('#recFilterActual').val();
    const year = $('#recFilterYear').val();
    const status = $('#recFilterStatus').val();
    
    $('#rec-table-wrap tbody tr').each(function() {
      const $row = $(this);
      const text = $row.text().toLowerCase();
      const $cells = $row.find('td');
      
      let show = true;
      if (search && !text.includes(search)) show = false;
      if (target && !$cells.eq(3).text().includes(target)) show = false;
      if (actual && !$cells.eq(2).text().includes(actual)) show = false;
      if (year && !$cells.eq(1).text().includes(year)) show = false;
      if (status) {
        const statusText = $cells.eq(4).text().toLowerCase();
        if (status === 'met' && !statusText.includes('met')) show = false;
        else if (status === 'below' && !statusText.includes('below')) show = false;
        else if (status === 'nodata' && !statusText.includes('no data')) show = false;
      }
      
      $row.toggle(show);
    });
    updateCount();
  }
  
  $('#recSearch, #recFilterTarget, #recFilterActual, #recFilterYear, #recFilterStatus').on('change keyup', applyFilters);
  
  $('#recClearFilters').on('click', function() {
    $('#recSearch').val('');
    $('#recFilterTarget').val('');
    $('#recFilterActual').val('');
    $('#recFilterYear').val('');
    $('#recFilterStatus').val('');
    applyFilters();
  });
}

function loadRecords() {
  $('#rec-table-wrap').html('<div class="text-center text-muted py-5"><i class="fa-solid fa-spinner fa-spin"></i></div>');
  apiGet('records.php', data => {
    if (!data || !data.length) {
      $('#rec-table-wrap').html('<div class="text-center text-muted py-5"><p>No records yet.</p></div>');
      return;
    }
    const paged = paginatedData(data, 'records');
    let rows = paged.items.map(d => `<tr>
      <td><strong>${d.indicator_name}</strong></td>
      <td>${d.year}</td>
      <td>${parseFloat(d.actual_value).toFixed(2)}%</td>
      <td>${parseFloat(d.target_value).toFixed(2)}%</td>
      <td>${statusBadge(d.actual_value, d.target_value)}</td>
      <td>
        <button class="btn btn-sm btn-outline-primary" onclick="editRecord(${d.record_id})"><i class="fa-solid fa-pen"></i></button>
        <button class="btn btn-sm btn-outline-danger" onclick="deleteItem('record', ${d.record_id}, '${d.indicator_name.replace(/'/g,"\\'")} (${d.year})')"><i class="fa-solid fa-trash"></i></button>
      </td>
    </tr>`).join('');
    $('#rec-table-wrap').html(`
      <div class="table-responsive">
        <table class="table">
          <thead><tr><th>Indicator</th><th>Year</th><th>Actual</th><th>Target</th><th>Status</th><th>Actions</th></tr></thead>
          <tbody>${rows}</tbody>
        </table>
      </div>
      <div id="rec-pagination"></div>`);
    renderPagination('records', 'rec-pagination');
    $('#recCount').text('(' + paged.items.length + ')');
  });
}

function openRecordModal(id) {
  $('#rec_errors').addClass('d-none').html('');
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

// ===== RECORD VALIDATION =====
function validateRecord() {
  const errors = [];
  const indicatorId = $('#rec_indicator').val();
  const year = $('#rec_year').val();
  const value = $('#rec_value').val();

  if (!indicatorId) {
    errors.push('Please select a KPI indicator');
  }

  if (!year) {
    errors.push('Year is required');
  } else {
    const yearNum = parseInt(year);
    if (isNaN(yearNum) || yearNum < 2000 || yearNum > 2100) {
      errors.push('Year must be between 2000 and 2100');
    }
  }

  if (value === '') {
    errors.push('Actual value is required');
  } else {
    const valueNum = parseFloat(value);
    if (isNaN(valueNum)) {
      errors.push('Actual value must be a valid number');
    } else if (valueNum < 0 || valueNum > 100) {
      errors.push('Actual value must be between 0 and 100');
    }
  }

  showFormErrors('rec_errors', errors);
  return errors;
}

$('#saveRecordBtn').on('click', () => {
  const errors = validateRecord();
  if (errors.length > 0) return;

  const id = $('#rec_id').val();
  const data = {
    indicator_id: $('#rec_indicator').val(),
    year: $('#rec_year').val(),
    actual_value: $('#rec_value').val()
  };

  toast(id ? 'Updating record...' : 'Adding record...', 'info');

  if (id) {
    data.record_id = id;
    $.ajax({
      url: API+'records.php?id='+id,
      method:'PUT',
      contentType:'application/json',
      data:JSON.stringify(data),
      success: r => {
        if(!r.success){ toast(r.message || 'Update failed', 'error'); return; }
        toast('✓ Record updated successfully!', 'success');
        bootstrap.Modal.getInstance('#recordModal').hide();
        loadRecords();
      },
      error: (xhr) => {
        let msg = 'Failed to update record';
        try { msg = JSON.parse(xhr.responseText).message || msg; } catch(e) {}
        toast(msg, 'error');
      }
    });
  } else {
    apiPost('records.php', data, (res, msg) => {
      toast('✓ Record added successfully!', 'success');
      bootstrap.Modal.getInstance('#recordModal').hide();
      loadRecords();
    });
  }
});

// ===== SURVEYS =====
function render_surveys() {
  $('#page-content').html(`
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Surveys</h2>
      <button class="btn btn-primary" id="addSurveyBtn"><i class="fa-solid fa-plus me-2"></i>Add Survey</button>
    </div>
    <div class="card">
      <div class="card-header">
        <div class="mb-2">
          <span class="fw-semibold">All Surveys <span id="srvCount" class="text-muted" style="font-size: 0.85rem;"></span></span>
        </div>
        <div class="row g-2 align-items-end">
          <div class="col-12 col-md-4">
            <input type="text" class="form-control form-control-sm" id="srvSearch" placeholder="Search by title or description..." style="width:100%;">
          </div>
          <div class="col-6 col-md-3">
            <label class="form-label small text-muted mb-1">From:</label>
            <input type="date" class="form-control form-control-sm" id="srvFilterFromDate" placeholder="From Date">
          </div>
          <div class="col-6 col-md-3">
            <label class="form-label small text-muted mb-1">To:</label>
            <input type="date" class="form-control form-control-sm" id="srvFilterToDate" placeholder="To Date">
          </div>
          <div class="col-12 col-md-2">
            <button class="btn btn-sm btn-outline-secondary w-100" id="srvClearFilters">Clear</button>
          </div>
        </div>
      </div>
      <div class="card-body"><div id="srv-table-wrap"></div></div>
    </div>
  `);
  loadSurveys();
  $('#addSurveyBtn').on('click', () => openSurveyModal());
  
  function updateCount() {
    const visibleCount = $('#srv-table-wrap tbody tr:visible').length;
    $('#srvCount').text(visibleCount);
  }
  
  function applyFilters() {
    const search = $('#srvSearch').val().toLowerCase();
    const fromDate = $('#srvFilterFromDate').val();
    const toDate = $('#srvFilterToDate').val();
    
    $('#srv-table-wrap tbody tr').each(function() {
      const $row = $(this);
      const text = $row.text().toLowerCase();
      const $cells = $row.find('td');
      const dateCell = $cells.eq(1).text();
      
      let show = true;
      if (search && !text.includes(search)) show = false;
      
      if (fromDate || toDate) {
        if (fromDate && dateCell < fromDate) show = false;
        if (toDate && dateCell > toDate) show = false;
      }
      
      $row.toggle(show);
    });
    updateCount();
  }
  
  $('#srvSearch, #srvFilterFromDate, #srvFilterToDate').on('change keyup', applyFilters);
  
  $('#srvClearFilters').on('click', function() {
    $('#srvSearch').val('');
    $('#srvFilterFromDate').val('');
    $('#srvFilterToDate').val('');
    applyFilters();
  });
}

function loadSurveys() {
  $('#srv-table-wrap').html('<div class="text-center text-muted py-5"><i class="fa-solid fa-spinner fa-spin"></i></div>');
  apiGet('surveys.php', data => {
    if (!data || !data.length) {
      $('#srv-table-wrap').html('<div class="text-center text-muted py-5"><p>No surveys yet.</p></div>');
      return;
    }
    const paged = paginatedData(data, 'surveys');
    let rows = paged.items.map(d => `
      <tr>
        <td><strong>${d.title}</strong><br><small class="text-muted">${d.description || '—'}</small></td>
        <td>${d.created_date || '—'}</td>
        <td><span class="badge bg-secondary">${d.response_count} responses</span></td>
        <td>
          <button class="btn btn-sm btn-outline-primary" onclick="editSurvey(${d.survey_id})"><i class="fa-solid fa-pen"></i></button>
          <button class="btn btn-sm btn-outline-danger" onclick="deleteItem('survey', ${d.survey_id}, '${d.title.replace(/'/g,"\\'")}')"><i class="fa-solid fa-trash"></i></button>
        </td>
      </tr>`).join('');
    $('#srv-table-wrap').html(`
      <div class="table-responsive">
        <table class="table">
          <thead><tr><th>Survey</th><th>Date Created</th><th>Responses</th><th>Actions</th></tr></thead>
          <tbody>${rows}</tbody>
        </table>
      </div>
      <div id="srv-pagination"></div>`);
    renderPagination('surveys', 'srv-pagination');
    $('#srvCount').text('(' + paged.items.length + ')');
  });
}

function openSurveyModal(id) {
  $('#srv_errors').addClass('d-none').html('');
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

// ===== SURVEY VALIDATION =====
function validateSurvey() {
  const errors = [];
  const title = $('#srv_title').val().trim();
  const date = $('#srv_date').val();

  if (!title) {
    errors.push('Survey title is required');
  } else if (title.length > 255) {
    errors.push('Survey title must be 255 characters or less');
  }

  if (date) {
    const dateObj = new Date(date);
    if (isNaN(dateObj.getTime())) {
      errors.push('Date must be a valid date');
    } else if (dateObj > new Date()) {
      errors.push('Date cannot be in the future');
    }
  }

  showFormErrors('srv_errors', errors);
  return errors;
}

$('#saveSurveyBtn').on('click', () => {
  const errors = validateSurvey();
  if (errors.length > 0) return;

  const id = $('#srv_id').val();
  const data = {
    title: $('#srv_title').val().trim(),
    description: $('#srv_desc').val().trim(),
    created_date: $('#srv_date').val()
  };

  toast(id ? 'Updating survey...' : 'Creating survey...', 'info');

  if (id) {
    data.survey_id = id;
    $.ajax({
      url: API+'surveys.php?id='+id,
      method:'PUT',
      contentType:'application/json',
      data:JSON.stringify(data),
      success: r => {
        if(!r.success){ toast(r.message || 'Update failed', 'error'); return; }
        toast('✓ Survey updated successfully!', 'success');
        bootstrap.Modal.getInstance('#surveyModal').hide();
        loadSurveys();
      },
      error: (xhr) => {
        let msg = 'Failed to update survey';
        try { msg = JSON.parse(xhr.responseText).message || msg; } catch(e) {}
        toast(msg, 'error');
      }
    });
  } else {
    apiPost('surveys.php', data, (res, msg) => {
      toast('✓ Survey created successfully!', 'success');
      bootstrap.Modal.getInstance('#surveyModal').hide();
      loadSurveys();
    });
  }
});

// ===== RESPONSES =====
function render_responses() {
  $('#page-content').html(`
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Survey Responses</h2>
      <button class="btn btn-primary" id="addRespBtn"><i class="fa-solid fa-plus me-2"></i>Add Response</button>
    </div>
    <div class="card">
      <div class="card-header">
        <div class="mb-2">
          <span class="fw-semibold">All Responses <span id="respCount" class="text-muted" style="font-size: 0.85rem;"></span></span>
        </div>
        <div class="row g-2 align-items-end">
          <div class="col-12 col-md-4">
            <input type="text" class="form-control form-control-sm" id="respSearch" placeholder="Search by survey, role, or question..." style="width:100%;">
          </div>
          <div class="col-6 col-md-2">
            <label class="form-label small text-muted mb-1">Rating:</label>
            <select class="form-select form-select-sm" id="respFilterRating">
              <option value="">All</option>
              <option value="1">1 Star</option>
              <option value="2">2 Stars</option>
              <option value="3">3 Stars</option>
              <option value="4">4 Stars</option>
              <option value="5">5 Stars</option>
            </select>
          </div>
          <div class="col-6 col-md-2">
            <label class="form-label small text-muted mb-1">From:</label>
            <input type="date" class="form-control form-control-sm" id="respFilterFromDate">
          </div>
          <div class="col-6 col-md-2">
            <label class="form-label small text-muted mb-1">To:</label>
            <input type="date" class="form-control form-control-sm" id="respFilterToDate">
          </div>
          <div class="col-12 col-md-2">
            <button class="btn btn-sm btn-outline-secondary w-100" id="respClearFilters">Clear</button>
          </div>
        </div>
      </div>
      <div class="card-body"><div id="resp-table-wrap"></div></div>
    </div>
  `);
  loadResponses();
  $('#addRespBtn').on('click', () => openResponseModal());
  
  function updateCount() {
    const visibleCount = $('#resp-table-wrap tbody tr:visible').length;
    $('#respCount').text(visibleCount);
  }
  
  function applyFilters() {
    const search = $('#respSearch').val().toLowerCase();
    const rating = $('#respFilterRating').val();
    const fromDate = $('#respFilterFromDate').val();
    const toDate = $('#respFilterToDate').val();
    
    $('#resp-table-wrap tbody tr').each(function() {
      const $row = $(this);
      const text = $row.text().toLowerCase();
      const $cells = $row.find('td');
      const dateCell = $cells.eq(5).text();
      const ratingCell = $cells.eq(4).text();
      
      let show = true;
      if (search && !text.includes(search)) show = false;
      
      if (rating) {
        const ratingMatch = ratingCell.match(/(\d+)/);
        const ratingValue = ratingMatch ? ratingMatch[1] : null;
        if (ratingValue !== rating) show = false;
      }
      
      if (fromDate || toDate) {
        if (fromDate && dateCell < fromDate) show = false;
        if (toDate && dateCell > toDate) show = false;
      }
      
      $row.toggle(show);
    });
    updateCount();
  }
  
  $('#respSearch, #respFilterRating, #respFilterFromDate, #respFilterToDate').on('change keyup', applyFilters);
  
  $('#respClearFilters').on('click', function() {
    $('#respSearch').val('');
    $('#respFilterRating').val('');
    $('#respFilterFromDate').val('');
    $('#respFilterToDate').val('');
    applyFilters();
  });
}

function loadResponses() {
  $('#resp-table-wrap').html('<div class="text-center text-muted py-5"><i class="fa-solid fa-spinner fa-spin"></i></div>');
  apiGet('responses.php', data => {
    if (!data || !data.length) {
      $('#resp-table-wrap').html('<div class="text-center text-muted py-5"><p>No responses yet.</p></div>');
      return;
    }
    const paged = paginatedData(data, 'responses');
    let rows = paged.items.map(d => `
      <tr>
        <td><strong>${d.survey_title}</strong></td>
        <td><span class="badge bg-secondary">${d.respondent_role}</span></td>
        <td style="max-width:220px;">${d.question}</td>
        <td style="max-width:200px;"><small>${d.answer}</small></td>
        <td>${d.rating ? `<span class="badge bg-info">${d.rating}/5</span>` : '<span class="text-muted">—</span>'}</td>
        <td><small>${d.response_date || '—'}</small></td>
        <td>
          <button class="btn btn-sm btn-outline-primary" onclick="editResponse(${d.response_id})"><i class="fa-solid fa-pen"></i></button>
          <button class="btn btn-sm btn-outline-danger" onclick="deleteItem('response', ${d.response_id}, 'this response')"><i class="fa-solid fa-trash"></i></button>
        </td>
      </tr>`).join('');
    $('#resp-table-wrap').html(`
      <div class="table-responsive">
        <table class="table">
          <thead><tr><th>Survey</th><th>Role</th><th>Question</th><th>Answer</th><th>Rating</th><th>Date</th><th>Actions</th></tr></thead>
          <tbody>${rows}</tbody>
        </table>
      </div>
      <div id="resp-pagination"></div>`);
    renderPagination('responses', 'resp-pagination');
    $('#respCount').text('(' + paged.items.length + ')');
  });
}

function openResponseModal(id) {
  $('#resp_errors').addClass('d-none').html('');
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

// ===== RESPONSE VALIDATION =====
function validateResponse() {
  const errors = [];
  const surveyId = $('#resp_survey').val();
  const role = $('#resp_role').val();
  const question = $('#resp_question').val().trim();
  const answer = $('#resp_answer').val().trim();
  const rating = $('#resp_rating').val();
  const date = $('#resp_date').val();

  if (!surveyId) {
    errors.push('Please select a survey');
  }

  if (!role) {
    errors.push('Respondent role is required');
  }

  if (!question) {
    errors.push('Question is required');
  } else if (question.length > 500) {
    errors.push('Question must be 500 characters or less');
  }

  if (!answer) {
    errors.push('Answer is required');
  } else if (answer.length > 1000) {
    errors.push('Answer must be 1000 characters or less');
  }

  if (rating && (rating < 1 || rating > 5)) {
    errors.push('Rating must be between 1 and 5');
  }

  if (date) {
    const dateObj = new Date(date);
    if (isNaN(dateObj.getTime())) {
      errors.push('Response date must be a valid date');
    } else if (dateObj > new Date()) {
      errors.push('Response date cannot be in the future');
    }
  }

  showFormErrors('resp_errors', errors);
  return errors;
}

$('#saveResponseBtn').on('click', () => {
  const errors = validateResponse();
  if (errors.length > 0) return;

  const id = $('#resp_id').val();
  const data = {
    survey_id: $('#resp_survey').val(),
    respondent_role: $('#resp_role').val(),
    question: $('#resp_question').val().trim(),
    answer: $('#resp_answer').val().trim(),
    rating: $('#resp_rating').val(),
    response_date: $('#resp_date').val()
  };

  toast(id ? 'Updating response...' : 'Adding response...', 'info');

  if (id) {
    data.response_id = id;
    $.ajax({
      url: API+'responses.php?id='+id,
      method:'PUT',
      contentType:'application/json',
      data:JSON.stringify(data),
      success: r => {
        if(!r.success){ toast(r.message || 'Update failed', 'error'); return; }
        toast('✓ Response updated successfully!', 'success');
        bootstrap.Modal.getInstance('#responseModal').hide();
        loadResponses();
      },
      error: (xhr) => {
        let msg = 'Failed to update response';
        try { msg = JSON.parse(xhr.responseText).message || msg; } catch(e) {}
        toast(msg, 'error');
      }
    });
  } else {
    apiPost('responses.php', data, (res, msg) => {
      toast('✓ Response added successfully!', 'success');
      bootstrap.Modal.getInstance('#responseModal').hide();
      loadResponses();
    });
  }
});

// ===== REPORT =====
function render_report() {
  $('#page-content').html(`
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>QA Report</h2>
      <div>
        <button class="btn btn-outline-secondary me-2" onclick="exportReportCsv()"><i class="fa-solid fa-file-csv me-2"></i>CSV</button>
        <button class="btn btn-primary" onclick="exportReportPdf()"><i class="fa-solid fa-file-pdf me-2"></i>PDF</button>
      </div>
    </div>
    
    <div class="card mb-4">
      <div class="card-header">
        <div class="mb-2">
          <span class="fw-semibold">Filter Report by Date</span>
        </div>
        <div class="row g-2 align-items-end">
          <div class="col-12 col-md-3">
            <label class="form-label small text-muted mb-1">From Date:</label>
            <input type="date" class="form-control" id="reportFilterFromDate">
          </div>
          <div class="col-12 col-md-3">
            <label class="form-label small text-muted mb-1">To Date:</label>
            <input type="date" class="form-control" id="reportFilterToDate">
          </div>
          <div class="col-6 col-md-2">
            <button class="btn btn-sm btn-primary w-100" id="reportGenerateBtn">Generate Report</button>
          </div>
          <div class="col-6 col-md-2">
            <button class="btn btn-sm btn-outline-secondary w-100" id="reportClearFiltersBtn">Clear</button>
          </div>
        </div>
      </div>
    </div>
    
    <div id="report-content"><div class="text-center text-muted py-5"><i class="fa-solid fa-spinner fa-spin"></i></div></div>
  `);
  
  // Set default dates (current year)
  function formatLocalDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
  }
  
  const today = new Date();
  const startOfYear = new Date(today.getFullYear(), 0, 1);
  $('#reportFilterFromDate').val(formatLocalDate(startOfYear));
  $('#reportFilterToDate').val(formatLocalDate(today));
  
  // Event handlers for filters
  $('#reportGenerateBtn').on('click', generateReport);
  $('#reportClearFiltersBtn').on('click', function() {
    function formatLocalDate(date) {
      const year = date.getFullYear();
      const month = String(date.getMonth() + 1).padStart(2, '0');
      const day = String(date.getDate()).padStart(2, '0');
      return `${year}-${month}-${day}`;
    }
    const today = new Date();
    const startOfYear = new Date(today.getFullYear(), 0, 1);
    $('#reportFilterFromDate').val(formatLocalDate(startOfYear));
    $('#reportFilterToDate').val(formatLocalDate(today));
    generateReport();
  });
  
  // Generate initial report
  generateReport();
}

function generateReport() {
  const fromDate = $('#reportFilterFromDate').val();
  const toDate = $('#reportFilterToDate').val();
  
  $('#report-content').html(`<div class="text-center text-muted py-5"><i class="fa-solid fa-spinner fa-spin"></i></div>`);
  
  Promise.all([
    new Promise(r => apiGet('indicators.php', r)),
    new Promise(r => apiGet('records.php', r)),
    new Promise(r => apiGet('surveys.php', r)),
    new Promise(r => apiGet('responses.php', r)),
    new Promise(r => apiGet('dashboard.php', r))
  ]).then(([indicators, records, surveys, responses, dash]) => {
    // Filter data by date range
    const filteredRecords = records.filter(r => {
      if (!fromDate && !toDate) return true;
      // Convert year to comparable format (assuming year is available, compare as string or timestamp)
      if (fromDate && r.year < fromDate.substring(0,4)) return false;
      if (toDate && r.year > toDate.substring(0,4)) return false;
      return true;
    });

    const filteredSurveys = surveys.filter(s => {
      if (!fromDate && !toDate) return true;
      const sDate = s.created_date || '';
      if (fromDate && sDate < fromDate) return false;
      if (toDate && sDate > toDate) return false;
      return true;
    });

    const filteredResponses = responses.filter(r => {
      if (!fromDate && !toDate) return true;
      const rDate = r.response_date || '';
      if (fromDate && rDate < fromDate) return false;
      if (toDate && rDate > toDate) return false;
      return true;
    });

    // Update indicators with filtered latest values based on filtered records
    const updatedIndicators = indicators.map(ind => {
      const filteredRecordsForInd = filteredRecords.filter(r => r.indicator_id === ind.indicator_id);
      if (filteredRecordsForInd.length > 0) {
        const latest = filteredRecordsForInd.reduce((prev, current) => 
          (parseInt(current.year) > parseInt(prev.year)) ? current : prev
        );
        return {
          ...ind,
          latest_value: latest.actual_value,
          latest_year: latest.year
        };
      }
      return ind;
    });

    const generatedAt = new Date().toLocaleDateString('en-US', {year:'numeric',month:'long',day:'numeric'});
    reportExportData = { indicators: updatedIndicators, surveys: filteredSurveys, responses: filteredResponses, records: filteredRecords, generatedAt };

    // Calculate metrics based on actual filtered records
    const totalKPIs = filteredRecords.length;
    const met = filteredRecords.filter(r => {
      const indicator = updatedIndicators.find(i => i.indicator_id === r.indicator_id);
      return indicator && parseFloat(r.actual_value) >= parseFloat(indicator.target_value);
    }).length;
    const unmet = filteredRecords.filter(r => {
      const indicator = updatedIndicators.find(i => i.indicator_id === r.indicator_id);
      return indicator && parseFloat(r.actual_value) < parseFloat(indicator.target_value);
    }).length;
    const noData = 0; // All filtered records have data

    // Calculate survey metrics
    const totalResponses = filteredResponses.length;
    const ratedResponses = filteredResponses.filter(r => r.rating).length;
    const avgRating = ratedResponses > 0
      ? (filteredResponses.filter(r => r.rating).reduce((sum, r) => sum + parseFloat(r.rating), 0) / ratedResponses).toFixed(2)
      : '—';

    // Calculate survey ratings by survey
    const surveyRatings = {};
    filteredResponses.forEach(resp => {
      if (!surveyRatings[resp.survey_id]) {
        surveyRatings[resp.survey_id] = { ratings: [] };
      }
      if (resp.rating) surveyRatings[resp.survey_id].ratings.push(parseFloat(resp.rating));
    });

    let indRows = filteredRecords.map(r => {
      const indicator = updatedIndicators.find(i => i.indicator_id === r.indicator_id);
      if (!indicator) return '';
      return `<tr>
        <td><strong>${indicator.name}</strong><br><small class="text-muted">${(indicator.description || '—').substring(0, 50)}</small></td>
        <td>${parseFloat(indicator.target_value).toFixed(2)}%</td>
        <td><strong>${parseFloat(r.actual_value).toFixed(2)}%</strong></td>
        <td>${r.year}</td>
        <td>${statusBadge(r.actual_value, indicator.target_value)}</td>
      </tr>`;
    }).join('');

    let srvRows = filteredSurveys.map(s => {
      const avgRating = surveyRatings[s.survey_id] && surveyRatings[s.survey_id].ratings.length > 0
        ? (surveyRatings[s.survey_id].ratings.reduce((a, b) => a + b) / surveyRatings[s.survey_id].ratings.length).toFixed(2)
        : '—';
      return `<tr>
        <td><strong>${s.title}</strong><br><small class="text-muted">${(s.description || '—').substring(0, 50)}</small></td>
        <td>${s.created_date||'—'}</td>
        <td>${s.response_count}</td>
        <td>${avgRating !== '—' ? `<strong>${avgRating}/5</strong> (${surveyRatings[s.survey_id].ratings.length} rated)` : 'No ratings'}</td>
      </tr>`;
    }).join('');

    // Helper function to format local date
    function formatLocalDate(date) {
      const year = date.getFullYear();
      const month = String(date.getMonth() + 1).padStart(2, '0');
      const day = String(date.getDate()).padStart(2, '0');
      return `${year}-${month}-${day}`;
    }
    
    const today = new Date();
    const startOfYear = new Date(today.getFullYear(), 0, 1);
    const displayFromDate = fromDate || formatLocalDate(startOfYear);
    const displayToDate = toDate || formatLocalDate(today);
    
    $('#report-content').html(`
      <div class="card p-4">
        <div class="text-center mb-4 pb-3 border-bottom">
          <h3 class="mb-2">Quality Assurance Management System Report</h3>
          <small class="text-muted">Generated: ${generatedAt}<br>Period: ${displayFromDate} to ${displayToDate}</small>
        </div>

        <h5 class="mb-3 fw-bold">KPI Performance Overview</h5>
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <div class="text-center p-3" style="background:#f8f9fa; border-radius:8px; border: 1px solid #dee2e6;">
              <div style="font-size:2.5rem; font-weight:bold; color:#0d6efd">${totalKPIs}</div>
              <small class="text-muted d-block">Total KPIs</small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center p-3" style="background:#f8f9fa; border-radius:8px; border: 1px solid #dee2e6;">
              <div style="font-size:2.5rem; font-weight:bold; color:#198754">${met}</div>
              <small class="text-muted d-block">Targets Met</small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center p-3" style="background:#f8f9fa; border-radius:8px; border: 1px solid #dee2e6;">
              <div style="font-size:2.5rem; font-weight:bold; color:#dc3545">${unmet}</div>
              <small class="text-muted d-block">Below Target</small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center p-3" style="background:#f8f9fa; border-radius:8px; border: 1px solid #dee2e6;">
              <div style="font-size:2.5rem; font-weight:bold; color:#6c757d">${noData}</div>
              <small class="text-muted d-block">No Data</small>
            </div>
          </div>
        </div>

        <h5 class="mb-3 fw-bold">Survey & Feedback Overview</h5>
        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <div class="text-center p-3" style="background:#f8f9fa; border-radius:8px; border: 1px solid #dee2e6;">
              <div style="font-size:2.5rem; font-weight:bold; color:#0d6efd">${filteredSurveys.length}</div>
              <small class="text-muted d-block">Total Surveys</small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center p-3" style="background:#f8f9fa; border-radius:8px; border: 1px solid #dee2e6;">
              <div style="font-size:2.5rem; font-weight:bold; color:#0dcaf0">${totalResponses}</div>
              <small class="text-muted d-block">Total Responses</small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center p-3" style="background:#f8f9fa; border-radius:8px; border: 1px solid #dee2e6;">
              <div style="font-size:2.5rem; font-weight:bold; color:#fd7e14">${ratedResponses}</div>
              <small class="text-muted d-block">Rated Responses</small>
            </div>
          </div>
          <div class="col-md-3">
            <div class="text-center p-3" style="background:#f8f9fa; border-radius:8px; border: 1px solid #dee2e6;">
              <div style="font-size:2.5rem; font-weight:bold; color:#6f42c1">${avgRating}</div>
              <small class="text-muted d-block">Avg Rating /5</small>
            </div>
          </div>
        </div>

        <h5 class="mt-4 mb-3 pb-2 border-bottom fw-bold">KPI Performance Summary</h5>
        <div class="table-responsive mb-4">
          <table class="table table-hover">
            <thead style="background-color:#f8f9fa">
              <tr>
                <th>Indicator</th>
                <th>Target</th>
                <th>Actual</th>
                <th>Year</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              ${indRows || '<tr><td colspan="5" class="text-center text-muted">No indicators</td></tr>'}
            </tbody>
          </table>
        </div>

        <h5 class="mt-4 mb-3 pb-2 border-bottom fw-bold">Survey Responses & Ratings</h5>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead style="background-color:#f8f9fa">
              <tr>
                <th>Survey</th>
                <th>Date Created</th>
                <th>Responses</th>
                <th>Average Rating</th>
              </tr>
            </thead>
            <tbody>
              ${srvRows || '<tr><td colspan="4" class="text-center text-muted">No surveys</td></tr>'}
            </tbody>
          </table>
        </div>

        <div class="mt-4 pt-3 border-top" style="font-size:0.95rem; color:#6c757d; line-height:1.6;">
          <small><strong>Report Summary:</strong> This comprehensive Quality Assurance report presents key performance metrics across two dimensions: KPI achievement against institutional targets and stakeholder satisfaction through survey feedback. The KPI section shows ${totalKPIs} total indicators with ${met} meeting targets (${totalKPIs > 0 ? Math.round((met/totalKPIs)*100) : 0}% achievement rate), while the survey section captures feedback from ${filteredSurveys.length} surveys with ${totalResponses} responses and an overall satisfaction rating of ${avgRating}/5.0.</small>
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
  const typeNames = { indicator: 'Indicator', record: 'Record', survey: 'Survey', response: 'Response' };

  deleteCallback = () => {
    toast(`Deleting ${typeNames[type] || 'item'}...`, 'info');
    $.ajax({
      url: API + endpoints[type]+'?id='+id,
      method: 'DELETE',
      success: r => {
        if (r.success === false) {
          toast(r.message || 'Delete failed', 'error');
          return;
        }
        toast(`✓ ${typeNames[type]} deleted successfully!`, 'success');
        bootstrap.Modal.getInstance('#deleteModal').hide();
        loaders[type]();
      },
      error: (xhr) => {
        let msg = `Failed to delete ${typeNames[type]}`;
        try { msg = JSON.parse(xhr.responseText).message || msg; } catch(e) {}
        toast(msg, 'error');
      }
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
