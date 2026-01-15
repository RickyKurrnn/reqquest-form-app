<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

<script>
// document.addEventListener('DOMContentLoaded', function () {
//     const toggleBtn = document.getElementById('sidebarToggle');
//     const layout = document.querySelector('.app-layout');

//     toggleBtn.addEventListener('click', function () {
//         layout.classList.toggle('sidebar-collapsed');
//     });
// });
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('sidebarToggle');
    const layout = document.querySelector('.app-layout');

    toggleBtn.addEventListener('click', function () {
        layout.classList.toggle('sidebar-collapsed');

        // ⏱️ tunggu animasi sidebar selesai
        setTimeout(() => {
            if ($.fn.DataTable.isDataTable('#listDataTable')) {
                $('#listDataTable').DataTable().columns.adjust().draw(false);
            }
            if ($.fn.DataTable.isDataTable('#userTable')) {
                $('#userTable').DataTable().columns.adjust().draw(false);
            }

            if ($.fn.DataTable.isDataTable('#tcodeTable')) {
                $('#tcodeTable').DataTable().columns.adjust().draw(false);
            }
        }, 350); // samain dengan transition 0.3s
    });
});
</script>
