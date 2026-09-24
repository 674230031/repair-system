<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Technician Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <span class="navbar-brand fw-bold">
                🔧 Repair System - Technician
            </span>

            <a href="{{ route('repairs.index') }}" class="btn btn-light">
                รายการแจ้งซ่อม
            </a>
        </div>
    </nav>

    <div class="container py-4">

        <h2 class="fw-bold mb-4">
            🔧 Dashboard ช่างซ่อม
        </h2>

        <div class="row g-4">

            <!-- รอดำเนินการ -->
            <div class="col-md-4">

                <div class="card shadow-sm h-100">

                    <div class="card-header bg-warning">
                        <strong>🟡 รอดำเนินการ</strong>
                    </div>

                    <div class="card-body">

                        <h3 class="fw-bold">
                            {{ $pending->count() }}
                        </h3>

                        <p class="text-muted">
                            งานที่รอช่างรับเรื่อง
                        </p>

                        @foreach($pending as $repair)

                            <div class="border rounded p-3 mb-3">

                                <h6 class="fw-bold">
                                    {{ $repair->title }}
                                </h6>

                                <p class="mb-1">
                                    👤 {{ $repair->requester_name }}
                                </p>

                                <p class="mb-2">
                                    📍 {{ $repair->location }}
                                </p>

                                <a href="{{ route('repairs.edit', $repair->id) }}" class="btn btn-sm btn-warning">
                                    รับงาน
                                </a>

                                <a href="{{ route('repairs.show', $repair->id) }}" class="btn btn-sm btn-outline-secondary">
                                    ดูรายละเอียด
                                </a>

                            </div>

                        @endforeach

                    </div>
                </div>

            </div>


            <!-- กำลังดำเนินการ -->
            <div class="col-md-4">

                <div class="card shadow-sm h-100">

                    <div class="card-header bg-info">
                        <strong>🔵 กำลังดำเนินการ</strong>
                    </div>

                    <div class="card-body">

                        <h3 class="fw-bold">
                            {{ $processing->count() }}
                        </h3>

                        <p class="text-muted">
                            งานที่กำลังซ่อม
                        </p>

                        @foreach($processing as $repair)

                            <div class="border rounded p-3 mb-3">

                                <h6 class="fw-bold">
                                    {{ $repair->title }}
                                </h6>

                                <p class="mb-1">
                                    👤 {{ $repair->requester_name }}
                                </p>

                                <p class="mb-2">
                                    📍 {{ $repair->location }}
                                </p>

                                <a href="{{ route('repairs.edit', $repair->id) }}" class="btn btn-sm btn-info">
                                    อัปเดตงาน
                                </a>

                                <a href="{{ route('repairs.show', $repair->id) }}" class="btn btn-sm btn-outline-secondary">
                                    ดูรายละเอียด
                                </a>

                            </div>

                        @endforeach

                    </div>
                </div>

            </div>


            <!-- เสร็จแล้ว -->
            <div class="col-md-4">

                <div class="card shadow-sm h-100">

                    <div class="card-header bg-success text-white">
                        <strong>🟢 ดำเนินการเสร็จแล้ว</strong>
                    </div>

                    <div class="card-body">

                        <h3 class="fw-bold">
                            {{ $completed->count() }}
                        </h3>

                        <p class="text-muted">
                            งานที่ซ่อมเสร็จแล้ว
                        </p>

                        @foreach($completed as $repair)

                            <div class="border rounded p-3 mb-3">

                                <h6 class="fw-bold">
                                    {{ $repair->title }}
                                </h6>

                                <p class="mb-1">
                                    👤 {{ $repair->requester_name }}
                                </p>

                                <p class="mb-2">
                                    📍 {{ $repair->location }}
                                </p>

                                <a href="{{ route('repairs.show', $repair->id) }}" class="btn btn-sm btn-success">
                                    ดูรายละเอียด
                                </a>
                            </div>

                        @endforeach

                    </div>
                </div>

            </div>

        </div>

    </div>

</body>

</html>