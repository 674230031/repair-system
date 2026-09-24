<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขรายการแจ้งซ่อม</title>
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
            <h2 class="fw-bold mb-4">✏️ แก้ไขรายการแจ้งซ่อม #{{ $repair->id }}</h2>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('repairs.update', $repair) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">ชื่อผู้แจ้ง</label>
                    <input type="text" name="requester_name" class="form-control"
                           value="{{ old('requester_name', $repair->requester_name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">หัวข้อปัญหา</label>
                    <input type="text" name="title" class="form-control"
                           value="{{ old('title', $repair->title) }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">ประเภทงาน</label>
                        <select name="category" class="form-select" required>
                            @foreach(['คอมพิวเตอร์','อินเทอร์เน็ต/เครือข่าย','ไฟฟ้า','เครื่องปรับอากาศ','อุปกรณ์สำนักงาน','อื่น ๆ'] as $category)
                                <option value="{{ $category }}" @selected(old('category', $repair->category) === $category)>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">สถานที่</label>
                        <input type="text" name="location" class="form-control"
                               value="{{ old('location', $repair->location) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">รายละเอียดปัญหา</label>
                    <textarea name="description" class="form-control" rows="5" required>{{ old('description', $repair->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">สถานะ</label>
                    <select name="status" class="form-select" required>
                        <option value="pending" @selected($repair->status === 'pending')>รอดำเนินการ</option>
                        <option value="processing" @selected($repair->status === 'processing')>กำลังดำเนินการ</option>
                        <option value="completed" @selected($repair->status === 'completed')>เสร็จสิ้น</option>
                        <option value="cancelled" @selected($repair->status === 'cancelled')>ยกเลิก</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">ผลการซ่อม</label>
                    <textarea name="repair_result" class="form-control" rows="4"
                              placeholder="บันทึกผลการซ่อมเมื่อดำเนินการแล้ว">{{ old('repair_result', $repair->repair_result) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">เปลี่ยนรูปภาพ</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                <button type="submit" class="btn btn-primary px-4">บันทึกการแก้ไข</button>
                <a href="{{ route('repairs.show', $repair) }}" class="btn btn-outline-secondary">ยกเลิก</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
