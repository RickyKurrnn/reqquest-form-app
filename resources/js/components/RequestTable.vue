<template>
  <div class="page-wrap">
    <h2 class="title">Request Data Table</h2>

    <div class="toolbar">
      <input
        v-model="search"
        class="search-input"
        type="text"
        placeholder="Filter by type / application / status / notes..."
      />

      <button class="export-excel-btn" @click="exportExcel">
        Export Excel
      </button>
    </div>

    <!-- Table -->
    <table class="request-table">
      <thead>
        <tr class="header-main">
          <th>No</th>
          <th>
            Request Date<br />
            <span class="sub-label">(The one written in the Forms)</span>
          </th>
          <th>Task Received</th>
          <th>Application</th>
          <th>File Name Form</th>
          <th>Task</th>
          <th>Requestor</th>
          <th>Approved by</th>
          <th>Executed By</th>
          <th>Acknowledged By</th>
          <th>Status</th>
          <th>Notes</th>
          <th>Action</th>
        </tr>
        <tr class="header-sub">
          <th></th>
          <th>Desember</th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="row in filteredRows" :key="row.no">
          <td>{{ row.no }}</td>
          <td>{{ row.requestDate }}</td>
          <td>{{ row.taskReceived }}</td>
          <td><span class="link-blue">{{ row.application }}</span></td>
          <td>
            <a v-if="row.fileName" :href="row.fileUrl || '#'" target="_blank" rel="noopener" class="link-blue">
              {{ row.fileName }}
            </a>
            <span v-else>-</span>
          </td>
          <td>{{ row.task }}</td>
          <td>{{ row.requestor }}</td>
          <td>{{ row.approvedBy }}</td>
          <td>{{ row.executedBy }}</td>
          <td>{{ row.acknowledgedBy }}</td>
          <td>
            <span :class="['status-pill', row.status === 'Active' || row.status === 'Pending' ? 'active' : 'deactive']">
              {{ row.status }}
            </span>
          </td>

          <td class="notes-col">{{ row.notes }}</td>

          <td>
            <button class="action-link" @click="exportRowToPDF(row)">
              Export PDF
            </button>
          </td>
        </tr>

        <tr v-if="!filteredRows.length" class="empty-row">
          <td colspan="13">No data available</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
  initialRows: {
    type: Array,
    default: () => [],
  },
})

const rows = ref(Array.isArray(props.initialRows) ? props.initialRows : [])

const search = ref('')

const filteredRows = computed(() => {
  const keyword = search.value.toLowerCase().trim()
  if (!keyword) return rows.value

  return rows.value.filter((row) => {
    return (
      (row.requestDate || '').toLowerCase().includes(keyword) ||
      (row.taskReceived || '').toLowerCase().includes(keyword) ||
      (row.application || '').toLowerCase().includes(keyword) ||
      (row.requestor || '').toLowerCase().includes(keyword) ||
      (row.status || '').toLowerCase().includes(keyword) ||
      (row.notes || '').toLowerCase().includes(keyword)
    )
  })
})

function exportExcel() {
  const XLSX = window.XLSX
  if (!XLSX) {
    alert('XLSX library not found. Please check CDN or include library.')
    return
  }

  const header = [
    'No',
    'Request Date',
    'Task Received',
    'Application',
    'File Name Form',
    'Task',
    'Requestor',
    'Approved by',
    'Executed By',
    'Acknowledged By',
    'Status',
    'Notes',
  ]

  const data = filteredRows.value.map((row) => [
    row.no ?? '',
    row.requestDate ?? '',
    row.taskReceived ?? '',
    row.application ?? '',
    row.fileName ?? '',
    row.task ?? '',
    row.requestor ?? '',
    row.approvedBy ?? '',
    row.executedBy ?? '',
    row.acknowledgedBy ?? '',
    row.status ?? '',
    row.notes ?? '',
  ])

  const worksheet = XLSX.utils.aoa_to_sheet([header, ...data])
  const workbook = XLSX.utils.book_new()
  XLSX.utils.book_append_sheet(workbook, worksheet, 'Requests')

  XLSX.writeFile(workbook, 'request-data.xlsx')
}

function exportRowToPDF(row) {
  const jsPDF = window.jspdf && window.jspdf.jsPDF
  const autoTable = window.jspdf_autotable || (window.jspdf && window.jspdf.autoTable)

  if (!jsPDF || !autoTable) {
    alert('jsPDF or AutoTable not found. Please check CDN.')
    return
  }

  const doc = new jsPDF()
  doc.setFontSize(14)
  doc.text('Request Detail', 14, 16)

  const body = [
    ['No', row.no ?? ''],
    ['Request Date', row.requestDate ?? ''],
    ['Task Received', row.taskReceived ?? ''],
    ['Application', row.application ?? ''],
    ['File Name Form', row.fileName ?? ''],
    ['Task', row.task ?? ''],
    ['Requestor', row.requestor ?? ''],
    ['Approved by', row.approvedBy ?? ''],
    ['Executed By', row.executedBy ?? ''],
    ['Acknowledged By', row.acknowledgedBy ?? ''],
    ['Status', row.status ?? ''],
    ['Notes', row.notes ?? ''],
  ]

  autoTable(doc, {
    startY: 22,
    head: [['Field', 'Value']],
    body,
    styles: { fontSize: 10 },
    headStyles: { fillColor: [0, 0, 0] },
  })

  const filename = row.fileName ? row.fileName.replace(/\.[^.]+$/, '') + '.pdf' : 'request-detail.pdf'
  doc.save(filename)
}
</script>

<style scoped>
.page-wrap { font-family: Arial, sans-serif; margin: 16px; }
.title { margin-bottom: 8px; }
.toolbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:8px; gap:8px; }
.search-input { padding:6px 10px; font-size:12px; border-radius:4px; border:1px solid #ccc; min-width:220px; }
.export-excel-btn { padding:6px 12px; font-size:12px; border-radius:4px; border:none; background:#22c55e; color:#fff; cursor:pointer; font-weight:600; }
.export-excel-btn:hover { background:#16a34a; }

.request-table { width:100%; border-collapse:collapse; font-size:12px; table-layout:fixed; }
.request-table th, .request-table td { border:1px solid #000; padding:4px 6px; text-align:center; vertical-align:middle; word-wrap:break-word; }
.request-table th:first-child, .request-table td:first-child { width:40px; }
.header-main th { background:#000;color:#fff;font-weight:bold; white-space:nowrap; }
.sub-label { font-size:10px; }
.header-sub th { background:#c6e0b4; font-weight:bold; }
.link-blue { color:#3e5bac; text-decoration:none; }
.notes-col { text-align:left; padding:4px 10px; max-width:380px; line-height:1.35; }
.action-link { background:none; border:none; padding:0; font-size:12px; color:#3e5bac; cursor:pointer; }
.empty-row td { text-align:center; font-style:italic; color:#555; }

/* status pill */
.status-pill { display:inline-block; padding:6px 10px; border-radius:14px; font-weight:600; font-size:13px; }
.status-pill.active { background:#e6f5ff; color:#163463; border:1px solid rgba(22,52,99,0.06); }
.status-pill.deactive { background:#fff0f0; color:#a33; border:1px solid rgba(255,0,0,0.06); }
</style>
