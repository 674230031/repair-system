<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดการแจ้งซ่อม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">🔧 Repair System</a>
    </div>
</nav>

<div class="container py-4">
    <div class="card border-0 shadow-sm mx-auto" style="max-width: 900px;">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h2 class="fw-bold">{{ $repair->title }}</h2>
                    <p class="text-secondary">รายการแจ้งซ่อม #{{ $repair->id }}</p>
                </div>
                @php
                    $status = [
                        'pending' => ['รอดำเนินการ', 'warning'],
                        'processing' => ['กำลังดำเนินการ', 'info'],
                        'completed' => ['เสร็จสิ้น', 'success'],
                        'cancelled' => ['ยกเลิก', 'danger'],
                    ][$repair->status] ?? ['ไม่ทราบสถานะ', 'secondary'];
                @endphp
                <span class="badge text-bg-{{ $status[1] }} fs-6">{{ $status[0] }}</span>
            </div>

            <hr>

            <div class="row g-3">
                <div class="col-md-6"><strong>ผู้แจ้ง:</strong> {{ $repair->requester_name }}</div>
                <div class="col-md-6"><strong>ประเภท:</strong> {{ $repair->category }}</div>
                <div class="col-md-6"><strong>สถานที่:</strong> {{ $repair->location }}</div>
                <div class="col-md-6"><strong>วันที่แจ้ง:</strong> {{ $repair->created_at->format('d/m/Y H:i') }}</div>
            </div>

            <div class="mt-4">
                <h5 class="fw-bold">รายละเอียดปัญหา</h5>
                <div class="bg-light rounded p-3">{{ $repair->description }}</div>
            </div>

            @if($repair->image)
                <div class="mt-4">
                    <h5 class="fw-bold">รูปภาพ</h5>
                    <img src="{{ asset('storage/' . $repair->image) }}"
                         class="img-fluid rounded" style="max-height: 400px;">
                </div>
            @endif

            @if($repair->repair_result)
                <div class="mt-4">
                    <h5 class="fw-bold">ผลการซ่อม</h5>
                    <div class="bg-light rounded p-3">{{ $repair->repair_result }}</div>
                </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('repairs.index') }}" class="btn btn-secondary">กลับ</a>
                <a href="{{ route('repairs.edit', $repair) }}" class="btn btn-warning">แก้ไข</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
