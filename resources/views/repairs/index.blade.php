<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการแจ้งซ่อม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">🔧 Repair System</a>
        <a href="{{ route('repairs.create') }}" class="btn btn-light">+ แจ้งซ่อม</a>
    </div>
</nav>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">รายการแจ้งซ่อม</h2>
            <p class="text-secondary mb-0">จัดการและติดตามงานซ่อมทั้งหมด</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>ผู้แจ้ง</th>
                            <th>หัวข้อ</th>
                            <th>ประเภท</th>
                            <th>สถานที่</th>
                            <th>สถานะ</th>
                            <th class="text-center">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($repairs as $repair)
                        <tr>
                            <td>{{ $repair->id }}</td>
                            <td>{{ $repair->requester_name }}</td>
                            <td>{{ $repair->title }}</td>
                            <td>{{ $repair->category }}</td>
                            <td>{{ $repair->location }}</td>
                            <td>
                                @php
                                    $status = [
                                        'pending' => ['รอดำเนินการ', 'warning'],
                                        'processing' => ['กำลังดำเนินการ', 'info'],
                                        'completed' => ['เสร็จสิ้น', 'success'],
                                        'cancelled' => ['ยกเลิก', 'danger'],
                                    ][$repair->status] ?? ['ไม่ทราบสถานะ', 'secondary'];
                                @endphp
                                <span class="badge text-bg-{{ $status[1] }}">{{ $status[0] }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('repairs.show', $repair) }}" class="btn btn-sm btn-outline-primary">ดู</a>
                                <a href="{{ route('repairs.edit', $repair) }}" class="btn btn-sm btn-outline-warning">แก้ไข</a>
                                <form action="{{ route('repairs.destroy', $repair) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('ยืนยันการลบรายการนี้?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">ลบ</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-secondary">
                                ยังไม่มีรายการแจ้งซ่อม
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $repairs->links() }}
    </div>
</div>

</body>
</html>
