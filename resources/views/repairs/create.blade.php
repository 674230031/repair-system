<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งซ่อม</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">🔧 Repair System</a>
    </div>
</nav>

<div class="container py-4">
    <div class="card border-0 shadow-sm mx-auto" style="max-width: 800px;">
        <div class="card-body p-4 p-md-5">
            <h2 class="fw-bold mb-1">📝 แจ้งซ่อม</h2>
            <p class="text-secondary mb-4">กรอกข้อมูลปัญหาที่ต้องการแจ้ง</p>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('repairs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">ชื่อผู้แจ้ง</label>
                    <input type="text" name="requester_name" class="form-control"
                           value="{{ old('requester_name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">หัวข้อปัญหา</label>
                    <input type="text" name="title" class="form-control"
                           placeholder="เช่น คอมพิวเตอร์เปิดไม่ติด"
                           value="{{ old('title') }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">ประเภทงาน</label>
                        <select name="category" class="form-select" required>
                            <option value="">-- เลือกประเภท --</option>
                            @foreach(['คอมพิวเตอร์','อินเทอร์เน็ต/เครือข่าย','ไฟฟ้า','เครื่องปรับอากาศ','อุปกรณ์สำนักงาน','อื่น ๆ'] as $category)
                                <option value="{{ $category }}" @selected(old('category') === $category)>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">สถานที่</label>
                        <input type="text" name="location" class="form-control"
                               placeholder="เช่น ห้อง 43 อาคาร..."
                               value="{{ old('location') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">รายละเอียดปัญหา</label>
                    <textarea name="description" class="form-control" rows="5"
                              placeholder="อธิบายอาการหรือปัญหาที่พบ" required>{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">รูปภาพปัญหา (ถ้ามี)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <div class="form-text">รองรับรูปภาพ ขนาดไม่เกิน 2 MB</div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">ส่งแจ้งซ่อม</button>
                    <a href="{{ route('repairs.index') }}" class="btn btn-outline-secondary">ยกเลิก</a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
