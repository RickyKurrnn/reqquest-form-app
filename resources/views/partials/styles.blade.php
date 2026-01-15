@push('styles')
    <style>
        html,
        body {
            height: 100%;
            overflow: hidden;
        }

        table.dataTable thead .sorting::before,
        table.dataTable thead .sorting::after,
        table.dataTable thead .sorting_asc::before,
        table.dataTable thead .sorting_asc::after,
        table.dataTable thead .sorting_desc::before,
        table.dataTable thead .sorting_desc::after {
            display: none !important;
        }

        .app-layout {
            display: grid;
            grid-template-columns: 240px 1fr;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 240px;
            height: 100vh;
            background: #fff;
            border-right: 1px solid #dee2e6;
        }

        .main-content {
            min-width: 0;
            height: 100vh;
            overflow-y: auto;
            overflow-x: hidden;
            padding-left: 20px;
            transition: padding-left 0.3s ease;
        }

        .app-layout.sidebar-collapsed .main-content {
            padding-left: 45px;
        }

        /* mobile */
        /* @media (max-width: 768px) {
                        .sidebar-toggle {
                            top: 15px;
                            height: 40px;
                        }
                    } */

        .sidebar .nav-link {
            color: #495057;
            border-radius: 8px;
            padding: 10px 12px;
            font-weight: 500;
        }

        .sidebar .nav-link:hover {
            background-color: #f1f3f5;
        }

        .sidebar .nav-link.active {
            background-color: #0d6efd;
            color: #fff;
        }

        .sidebar .nav-link.active i {
            color: #fff;
        }

        .sidebar {
            transition: transform 0.3s ease;
        }

        .app-layout.sidebar-collapsed .sidebar {
            transform: translateX(-100%);
        }

        .app-layout {
            transition: grid-template-columns 0.3s ease;
        }

        .app-layout.sidebar-collapsed {
            grid-template-columns: 0 1fr;
        }

        .sidebar-toggle {
            position: fixed;
            top: 20px;
            left: 240px;
            z-index: 1040;
            background: #ffffff;
            color: #495057;
            border: 1px solid #dee2e6;
            border-left: none;

            width: 30px;
            height: 45px;
            border-radius: 0 8px 8px 0;

            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 4px 0 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background-color: #f8f9fa;
            color: #0d6efd;
            width: 35px;
        }

        .sidebar-toggle i {
            transition: transform 0.3s ease;
            font-size: 12px;
        }

        .app-layout.sidebar-collapsed .sidebar-toggle {
            left: 0;
        }

        .app-layout.sidebar-collapsed .sidebar-toggle i {
            transform: rotate(180deg);
        }

        /* #listDataTable {
            table-layout: fixed;
            width: 100% !important;
        }

        #listDataTable th,
        #listDataTable td {
            white-space: nowrap;
            vertical-align: middle;
        }

        #listDataTable th {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        #listDataTable td {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        #listDataTable td:first-child,
        #listDataTable td:last-child {
            width: 1%;
            white-space: nowrap;
        } */
    </style>
@endpush

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
