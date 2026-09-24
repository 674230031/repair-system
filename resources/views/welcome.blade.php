<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบแจ้งซ่อม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">🔧 Repair System</a>
            <a href="{{ route('repairs.index') }}" class="btn btn-light">รายการแจ้งซ่อม</a>
        </div>
    </nav>

    <div class="container py-5">
        <div class="bg-white rounded-4 shadow-sm p-5 text-center">
            <div class="display-1 mb-3">🔧</div>
            <h1 class="fw-bold">ระบบแจ้งซ่อม</h1>
            <p class="text-secondary fs-5">
                แจ้งปัญหา ติดตามสถานะ และจัดการงานซ่อมได้ในระบบเดียว
            </p>

            <div class="mt-4">
                <a href="{{ route('repairs.create') }}" class="btn btn-primary btn-lg px-4">
                    + แจ้งซ่อม
                </a>
                <a href="{{ route('repairs.index') }}" class="btn btn-outline-primary btn-lg px-4 ms-2">
                    ดูรายการแจ้งซ่อม
                </a>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="fs-1">📝</div>
                        <h5 class="fw-bold mt-2">แจ้งปัญหา</h5>
                        <p class="text-secondary mb-0">กรอกรายละเอียดและแนบรูปภาพปัญหาได้</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="fs-1">🔧</div>
                        <h5 class="fw-bold mt-2">จัดการงานซ่อม</h5>
                        <p class="text-secondary mb-0">อัปเดตสถานะและผลการซ่อมได้</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="fs-1">📊</div>
                        <h5 class="fw-bold mt-2">ติดตามสถานะ</h5>
                        <p class="text-secondary mb-0">ดูว่างานอยู่ระหว่างรอ ดำเนินการ หรือเสร็จแล้ว</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
