<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JenisSuratController extends Controller
{
    //
    public function index()
    {
        $jenisSurat = JenisSurat::latest()->get();

        return view('admin.jenis-surat.index', [
            'title' => 'Data Jenis Surat',
            'jenisSurat' => $jenisSurat
        ]);
    }


    function form($id = null)
    {
        $jenisSurat = $id ? JenisSurat::where('id', $id)->firstOrFail() : null;

        $data = [
            'title' => $jenisSurat ? 'Form Ubah Jenis Surat' : 'Form Tambah Jenis Surat',
            'jenisSurat' => $jenisSurat
        ];

        return view('admin.jenis-surat.form', $data);
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        $validated = $request->validate([
            'nama_jenis' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'form_fields' => 'required|json', // pastikan valid JSON
        ]);

        if ($id) {
            $slug = Str::slug($request->input('nama_jenis'));
        } else {
            $slug = Str::slug($request->input('nama_jenis'));
            $existingSlugCount = JenisSurat::where('slug', 'LIKE', "{$slug}%")->count();
            if ($existingSlugCount > 0) {
                $slug .= '-' . ($existingSlugCount + 1);
            }
        }
        // dd($slug);
        $data = [
            'slug' => $slug,
            'nama_jenis' => $validated['nama_jenis'],
            'deskripsi' => $validated['deskripsi'],
            'form_fields' => $validated['form_fields'],
        ];

        if ($id) {
            JenisSurat::findOrFail($id)->update($data);
            return redirect()->route('admin.jenis-surat.index')->with('success', 'Data berhasil diperbarui.');
        } else {
            JenisSurat::create($data);
            return redirect()->route('admin.jenis-surat.index')->with('success', 'Data berhasil ditambahkan.');
        }
    }

    public function destroy($id)
    {
        JenisSurat::findOrFail($id)->delete();
        return redirect()->route('admin.jenis-surat.index')->with('success', 'Data berhasil dihapus.');
    }
}
