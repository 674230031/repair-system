<?php

namespace App\Http\Controllers;

use App\Models\RepairRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RepairRequestController extends Controller
{
    // ==========================================
    // แสดงรายการแจ้งซ่อมทั้งหมด
    // ==========================================
    public function index()
    {
        $repairs = RepairRequest::latest()->paginate(10);

        return view('repairs.index', compact('repairs'));
    }

    // ==========================================
    // หน้าแจ้งซ่อม
    // ==========================================
    public function create()
    {
        return view('repairs.create');
    }

    // ==========================================
    // บันทึกการแจ้งซ่อม
    // ==========================================
    public function store(Request $request)
    {
        $data = $request->validate([
            'requester_name' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // อัปโหลดรูปภาพ
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('repairs', 'public');
        }

        // สถานะเริ่มต้น
        $data['status'] = 'pending';

        // บันทึกลง Database
        RepairRequest::create($data);

        return redirect()
            ->route('repairs.index')
            ->with('success', 'แจ้งซ่อมเรียบร้อยแล้ว');
    }

    // ==========================================
    // Dashboard ช่าง
    // ==========================================
    public function technician()
    {
        // งานรอดำเนินการ
        $pending = RepairRequest::where('status', 'pending')
            ->latest()
            ->get();

        // งานกำลังดำเนินการ
        $processing = RepairRequest::where('status', 'processing')
            ->latest()
            ->get();

        // งานเสร็จแล้ว
        $completed = RepairRequest::where('status', 'completed')
            ->latest()
            ->get();

        return view('technician.index', compact(
            'pending',
            'processing',
            'completed'
        ));
    }

    // ==========================================
    // ช่างรับงาน
    // ==========================================
    public function start(RepairRequest $repair)
    {
        $repair->update([
            'status' => 'processing',
        ]);

        return redirect()
            ->route('technician')
            ->with('success', 'รับงานเรียบร้อยแล้ว');
    }

    // ==========================================
    // ดูรายละเอียดการแจ้งซ่อม
    // ==========================================
    public function show(RepairRequest $repair)
    {
        return view('repairs.show', compact('repair'));
    }

    // ==========================================
    // หน้าแก้ไขข้อมูล
    // ==========================================
    public function edit(RepairRequest $repair)
    {
        return view('repairs.edit', compact('repair'));
    }

    // ==========================================
    // อัปเดตข้อมูลแจ้งซ่อม
    // ==========================================
    public function update(Request $request, RepairRequest $repair)
    {
        $data = $request->validate([
            'requester_name' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'repair_result' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // ถ้ามีรูปใหม่
        if ($request->hasFile('image')) {

            // ลบรูปเก่า
            if ($repair->image) {
                Storage::disk('public')->delete($repair->image);
            }

            // บันทึกรูปใหม่
            $data['image'] = $request->file('image')
                ->store('repairs', 'public');
        }

        // อัปเดตข้อมูล
        $repair->update($data);

        return redirect()
            ->route('repairs.index')
            ->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
    }

    // ==========================================
    // ลบรายการแจ้งซ่อม
    // ==========================================
    public function destroy(RepairRequest $repair)
    {
        // ลบรูปภาพ
        if ($repair->image) {
            Storage::disk('public')->delete($repair->image);
        }

        // ลบข้อมูล
        $repair->delete();

        return redirect()
            ->route('repairs.index')
            ->with('success', 'ลบรายการแจ้งซ่อมเรียบร้อยแล้ว');
    }
}
