const tableBody = document.getElementById("table-body");
const searchInput = document.getElementById("search-input");
const paginationEl = document.getElementById("pagination");
const exportBtn = document.getElementById("export-excel-btn");

let allRequests = [];
let filteredRequests = [];
let sortConfig = { key: null, direction: "asc" };
let currentPage = 1;
const pageSize = 10;

// FETCH DATA FROM LARAVEL
fetch("/api/requests")
  .then((res) => res.json())
  .then((data) => {
    allRequests = data.map((item) => ({
      id: item.id,
      requestDate: item.request_date || "",
      taskReceived: item.request_type || "",
      application: item.application_name || "-",
      fileNameForm: item.request_date
        ? `Request_Form_${item.request_date}.pdf`
        : "Request_Form.pdf",
      fileUrl: "#",
      task: item.expectations || "",
      requestor: item.requestor || "",
      approvedBy: item.approvedBy || "",
      executedBy: item.executedBy || "",
      acknowledgedBy: item.acknowledgedBy || "",
      status: item.type || "",
      notes: item.notes || "",
      existing_condition: item.existing_condition || "",
      expectations: item.expectations || ""
    }));

    applyFilterAndSort();
  })
  .catch((err) => {
    console.error("Gagal fetch API:", err);
    tableBody.innerHTML =
      "<tr><td colspan='13'>Gagal mengambil data dari server</td></tr>";
  });

//  FILTER + SORT + PAGINATION 
function applyFilterAndSort() {
  const keyword = (searchInput?.value || "").toLowerCase();

  // filter
  filteredRequests = allRequests.filter((item) => {
    if (!keyword) return true;

    const haystack = [
      item.requestDate,
      item.taskReceived,
      item.application,
      item.task,
      item.requestor,
      item.status,
      item.notes
    ]
      .join(" ")
      .toLowerCase();

    return haystack.includes(keyword);
  });

  // sort
  if (sortConfig.key) {
    const { key, direction } = sortConfig;
    filteredRequests.sort((a, b) => {
      const valA = (a[key] || "").toString().toLowerCase();
      const valB = (b[key] || "").toString().toLowerCase();

      if (valA < valB) return direction === "asc" ? -1 : 1;
      if (valA > valB) return direction === "asc" ? 1 : -1;
      return 0;
    });
  }

  const maxPage = Math.max(1, Math.ceil(filteredRequests.length / pageSize));
  if (currentPage > maxPage) currentPage = maxPage;

  renderTable();
  renderPagination();
  updateSortIndicators();
}

function getPagedRequests() {
  const start = (currentPage - 1) * pageSize;
  const end = start + pageSize;
  return filteredRequests.slice(start, end);
}

// RENDER TABEL 
function renderTable() {
  tableBody.innerHTML = "";

  const pageData = getPagedRequests();

  if (!pageData.length) {
    tableBody.innerHTML = "<tr><td colspan='13'>Belum ada data</td></tr>";
    return;
  }

  pageData.forEach((item, index) => {
    const row = document.createElement("tr");

    const globalIndex = (currentPage - 1) * pageSize + index + 1;

    row.innerHTML = `
      <td>${globalIndex}</td>
      <td>${item.requestDate}</td>
      <td>${item.taskReceived}</td>
      <td>${item.application}</td>
      <td><a href="${item.fileUrl}" target="_blank">${item.fileNameForm}</a></td>
      <td>${item.task}</td>
      <td>${item.requestor}</td>
      <td>${item.approvedBy}</td>
      <td>${item.executedBy}</td>
      <td>${item.acknowledgedBy}</td>
      <td>${item.status}</td>
      <td>${item.notes || ""}</td>
      <td>
        <button class="action-pdf-btn" onclick="exportSinglePdf(${globalIndex - 1})">
          Export PDF
        </button>
      </td>
    `;

    tableBody.appendChild(row);
  });
}

// ========== RENDER PAGINATION ==========
function renderPagination() {
  const total = filteredRequests.length;
  const maxPage = Math.max(1, Math.ceil(total / pageSize));

  paginationEl.innerHTML = "";

  const info = document.createElement("span");
  info.textContent = `Page ${currentPage} of ${maxPage} (${total} records)`;
  paginationEl.appendChild(info);

  const prevBtn = document.createElement("button");
  prevBtn.textContent = "Prev";
  prevBtn.disabled = currentPage === 1;
  prevBtn.onclick = () => {
    if (currentPage > 1) {
      currentPage--;
      renderTable();
      renderPagination();
    }
  };
  paginationEl.appendChild(prevBtn);

  const nextBtn = document.createElement("button");
  nextBtn.textContent = "Next";
  nextBtn.disabled = currentPage === maxPage;
  nextBtn.onclick = () => {
    if (currentPage < maxPage) {
      currentPage++;
      renderTable();
      renderPagination();
    }
  };
  paginationEl.appendChild(nextBtn);
}

// ========== SORTING ==========
function handleSort(key) {
  if (!key) return;

  if (sortConfig.key === key) {
    sortConfig.direction = sortConfig.direction === "asc" ? "desc" : "asc";
  } else {
    sortConfig.key = key;
    sortConfig.direction = "asc";
  }

  applyFilterAndSort();
}

function updateSortIndicators() {
  const ths = document.querySelectorAll("th.sortable");
  ths.forEach((th) => {
    const key = th.getAttribute("data-sort-key");
    const span = th.querySelector(".sort-indicator");
    if (!span) return;

    if (sortConfig.key === key) {
      span.textContent = sortConfig.direction === "asc" ? "▲" : "▼";
    } else {
      span.textContent = "";
    }
  });
}

// EXPORT EXCEL
function exportTableToExcel() {
  if (!filteredRequests.length) {
    alert("There is no data that can be exported yet.");
    return;
  }

  const header = [
    "No",
    "Request Date",
    "Task Received",
    "Application",
    "File Name Form",
    "Task",
    "Requestor",
    "Approved By",
    "Executed By",
    "Acknowledged By",
    "Status",
    "Notes"
  ];

  const body = filteredRequests.map((item, index) => [
    index + 1,
    item.requestDate,
    item.taskReceived,
    item.application,
    item.fileNameForm,
    item.task,
    item.requestor,
    item.approvedBy,
    item.executedBy,
    item.acknowledgedBy,
    item.status,
    item.notes || ""
  ]);

  const wsData = [header, ...body];
  const worksheet = XLSX.utils.aoa_to_sheet(wsData);
  const workbook = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(workbook, worksheet, "Requests");

  XLSX.writeFile(workbook, "request-data-table.xlsx");
}

function exportSinglePdf(rowIndex) {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF("portrait", "pt", "a4");

  const item = filteredRequests[rowIndex];
  if (!item) {
    alert("Data tidak ditemukan untuk baris ini.");
    return;
  }

  const pageWidth = doc.internal.pageSize.getWidth();
  const pageHeight = doc.internal.pageSize.getHeight();
  const marginLeft = 40;
  const contentWidth = pageWidth - marginLeft * 2;
  let y = 60;

  doc.setFontSize(16);
  doc.setFont("helvetica", "bold");
  doc.text("emtekmedia", marginLeft, y);
  doc.text("Form", pageWidth - marginLeft, y, { align: "right" });

  y += 24;
  doc.setFontSize(18);
  doc.text("Request Form [1]", marginLeft, y);
  y += 20;

  const dateBoxWidth = 180;
  const dateBoxHeight = 40;
  const dateBoxX = pageWidth - marginLeft - dateBoxWidth;
  const dateBoxY = 70;
  doc.rect(dateBoxX, dateBoxY, dateBoxWidth, dateBoxHeight);
  doc.setFontSize(9);
  doc.text("Request", dateBoxX + 8, dateBoxY + 14);
  doc.text("Date", dateBoxX + 8, dateBoxY + 26);
  doc.text(":", dateBoxX + 60, dateBoxY + 20);
  doc.text(item.requestDate || "-", dateBoxX + 70, dateBoxY + 20);

  y += 10;

  doc.setFontSize(11);
  doc.text("Doc Number:", marginLeft, y);
  y += 18;
  doc.text("Application Name:", marginLeft, y);
  doc.text(item.application || "-", marginLeft + 120, y);

  y += 26;
  doc.setFontSize(10);
  doc.text(
    "This form is to request change(s) of the following data:",
    marginLeft,
    y
  );

  y += 12;

  const boxHeight1 = 90;
  doc.setFontSize(11);
  doc.rect(marginLeft, y, contentWidth, boxHeight1);
  doc.setFont("helvetica", "bold");
  doc.text("Existing/Current Condition", marginLeft + 4, y + 14);
  doc.setFont("helvetica", "normal");
  doc.setFontSize(9);
  doc.text(
    "(Deskripsi kondisi saat ini)",
    marginLeft + contentWidth - 180,
    y + 14
  );

  // existing
  doc.setFontSize(11);
  const existingText = item.existing_condition || "-";
  doc.text(existingText, marginLeft + 4, y + 32, {
    maxWidth: contentWidth - 8
  });

  y += boxHeight1 + 16;

  // Expectations
  const boxHeight2 = 90;
  doc.rect(marginLeft, y, contentWidth, boxHeight2);
  doc.setFont("helvetica", "bold");
  doc.setFontSize(11);
  doc.text("Expectations", marginLeft + 4, y + 14);
  doc.setFont("helvetica", "normal");
  doc.setFontSize(9);
  doc.text(
    "(Deskripsi kondisi yang diharapkan)",
    marginLeft + contentWidth - 210,
    y + 14
  );

  doc.setFontSize(11);
  const expText = item.task || item.expectations || "-";
  doc.text(expText, marginLeft + 4, y + 32, {
    maxWidth: contentWidth - 8
  });

  y += boxHeight2 + 18;

  // Requested / Approved / Executed / Acknowledged
  const colWidth = contentWidth / 2;
  const blockHeight = 90;

  // Requested + Approved row
  doc.rect(marginLeft, y, contentWidth, blockHeight);
  doc.line(
    marginLeft + colWidth,
    y,
    marginLeft + colWidth,
    y + blockHeight
  );

  doc.setFont("helvetica", "bold");
  doc.setFontSize(11);
  doc.text("Requested By", marginLeft + 4, y + 16);
  doc.text("Approved By", marginLeft + colWidth + 4, y + 16);

  doc.setFont("helvetica", "normal");
  let yy = y + 38;
  doc.text(item.requestor || "", marginLeft + 4, yy);
  doc.text(item.approvedBy || "", marginLeft + colWidth + 4, yy);

  yy += 18;
  doc.text("Date:", marginLeft + 4, yy);
  doc.text("Date:", marginLeft + colWidth + 4, yy);

  yy += 18;
  doc.text("[Nama / Jabatan]", marginLeft + 4, yy);
  doc.text("[Nama / Jabatan]", marginLeft + colWidth + 4, yy);

  y += blockHeight + 10;

  // Executed + Acknowledged row
  doc.rect(marginLeft, y, contentWidth, blockHeight);
  doc.line(
    marginLeft + colWidth,
    y,
    marginLeft + colWidth,
    y + blockHeight
  );

  doc.setFont("helvetica", "bold");
  doc.setFontSize(11);
  doc.text("Executed By", marginLeft + 4, y + 16);
  doc.text("Acknowledged By", marginLeft + colWidth + 4, y + 16);

  doc.setFont("helvetica", "normal");
  yy = y + 38;
  doc.text(item.executedBy || "", marginLeft + 4, yy);
  doc.text(item.acknowledgedBy || "", marginLeft + colWidth + 4, yy);

  yy += 18;
  doc.text("Date:", marginLeft + 4, yy);
  doc.text("Date:", marginLeft + colWidth + 4, yy);

  // footer
  doc.setFontSize(9);
  doc.text(
    "Emtek Media – Information Technology",
    marginLeft,
    pageHeight - 40
  );
  doc.text(
    "IT Business Application – IT Custom Application",
    marginLeft,
    pageHeight - 25
  );
  doc.text(`Page 1 of 1`, pageWidth - marginLeft, pageHeight - 25, {
    align: "right"
  });

  doc.save(`request-${rowIndex + 1}.pdf`);
}

document.addEventListener("DOMContentLoaded", () => {
  // search
  if (searchInput) {
    searchInput.addEventListener("input", () => {
      currentPage = 1;
      applyFilterAndSort();
    });
  }

  // sorting header
  const sortableHeaders = document.querySelectorAll("th.sortable");
  sortableHeaders.forEach((th) => {
    th.addEventListener("click", () => {
      const key = th.getAttribute("data-sort-key");
      handleSort(key);
    });
  });

  // export excel
  if (exportBtn) {
    exportBtn.addEventListener("click", exportTableToExcel);
  }
});
