<!DOCTYPE html>
<html>
<head>
    <title>Atur Santri</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

/* ================= GLOBAL (KHUSUS HALAMAN INI) ================= */

body {
    background: linear-gradient(120deg, #eef2ff, #f8fafc);
    font-family: 'Inter', sans-serif;
}

/* ================= CARD ================= */

.page-card {
    background: rgba(255,255,255,0.95);
    border-radius: 28px;
    padding: 30px;
    backdrop-filter: blur(10px);
    box-shadow: 0 20px 60px rgba(15,23,42,0.08);
    border: 1px solid rgba(99,102,241,0.15);
}

/* ================= TITLE ================= */

.page-title {
    font-weight: 800;
    font-size: 28px;
    color: #3730a3;
}

.page-subtitle {
    color: #64748b;
    font-size: 14px;
}

/* ================= BUTTON ================= */

.btn-action {
    border-radius: 999px;
    padding: 10px 20px;
    font-weight: 600;
    transition: 0.3s;
}

.btn-primary {
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(79,70,229,0.3);
}

/* ================= TABLE WRAPPER ================= */

.table-responsive {
    border-radius: 20px;
    overflow: hidden;
}

/* ================= TABLE ================= */

.table-custom {
    border-collapse: separate;
    border-spacing: 0;
    background: #ffffff;
}

/* HEADER */

.table-custom thead {
    background: linear-gradient(135deg, #4f46e5, #3730a3);
}

.table-custom thead tr {
    box-shadow: inset 0 -2px 0 rgba(255,255,255,0.2);
}
.table-custom thead th {
    color: white;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 13px;
    letter-spacing: 0.05em;
    padding: 16px;
    border: none;
}

/* BODY */

.table-custom tbody tr {
    transition: 0.25s;
}

.table-custom tbody tr:nth-child(even) {
    background: #f8fafc;
}

.table-custom tbody tr:hover {
    background: rgba(99,102,241,0.08);
    transform: scale(1.01);
}

/* CELL */

.table-custom tbody td {
    padding: 18px;
    color: #334155;
    vertical-align: middle;
    border-top: 1px solid #e2e8f0;
}

/* ================= AKSI BUTTON ================= */

.table-custom .btn {
    border-radius: 999px;
    padding: 6px 14px;
    font-size: 13px;
    font-weight: 600;
    transition: 0.25s;
}

/* EDIT */

.btn-warning {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    border: none;
    color: white;
}

.btn-warning:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 18px rgba(245,158,11,0.3);
}

/* DELETE */

.btn-danger {
    background: linear-gradient(135deg, #ef4444, #b91c1c);
    border: none;
}

.btn-danger:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 18px rgba(239,68,68,0.3);
}

/* ================= EMPTY STATE ================= */

.text-muted {
    font-style: italic;
}

/* ================= RESPONSIVE ================= */

@media (max-width: 768px) {
    .page-card {
        padding: 20px;
    }

    .table-custom tbody td {
        padding: 14px;
    }
}
/* PAKSA HEADER MUNCUL & KELIATAN */
.table-custom thead {
    display: table-header-group !important;
}

.table-custom thead th {
    background: linear-gradient(135deg, #4f46e5, #3730a3) !important;
    color: #ffffff !important;
    font-weight: 700;
    font-size: 14px;
    padding: 18px !important;
    text-align: left;
    border: none;
}

/* Biar ada pembatas jelas */
.table-custom thead tr {
    border-bottom: 3px solid rgba(255,255,255,0.3);
}

/* FIX BOOTSTRAP OVERLAY */
.table > :not(caption) > * > * {
    background-color: transparent !important;
}
.table-custom thead th:first-child {
    border-top-left-radius: 12px;
}

.table-custom thead th:last-child {
    border-top-right-radius: 12px;
}

</style>
</head>
<body>

<div class="container my-5">
    <div class="page-card p-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
            <div>
                <h3 class="page-title mb-1">Atur Santri</h3>
                <p class="page-subtitle mb-0">Kelola daftar santri dengan tampilan yang lebih rapi dan nyaman.</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <button class="btn btn-primary btn-action" type="button" onclick="openTambahModal()">+ Tambah Santri</button>
                <a class="btn btn-outline-primary btn-action" href="dashboard.php">← Kembali</a>
            </div>
        </div>

        <div class="table-responsive rounded-4 shadow-sm overflow-hidden">
            <table class="table table-custom mb-0">
                <thead>
                    <tr>
                        <th>Nama Santri</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="dataSantri"></tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahSantriModal" tabindex="-1" aria-labelledby="tambahSantriModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="tambahSantriModalLabel">Tambah Santri</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form id="formTambahSantri">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="namaSantri" class="form-label">Nama Santri</label>
                        <input type="text" id="namaSantri" class="form-control" placeholder="Masukkan nama santri" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelasSantri" class="form-label">Kelas</label>
                        <input type="text" id="kelasSantri" class="form-control" placeholder="Contoh: XII" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-action" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-action">Simpan Santri</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editSantriModal" tabindex="-1" aria-labelledby="editSantriModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title" id="editSantriModalLabel">Edit Santri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <form id="formEditSantri">
                <input type="hidden" id="editIdSantri">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editNamaSantri" class="form-label">Nama Santri</label>
                        <input type="text" id="editNamaSantri" class="form-control" placeholder="Masukkan nama santri" required>
                    </div>
                    <div class="mb-3">
                        <label for="editKelasSantri" class="form-label">Kelas</label>
                        <input type="text" id="editKelasSantri" class="form-control" placeholder="Contoh: 7A" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-action" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning btn-action">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapusSantriModal" tabindex="-1" aria-labelledby="hapusSantriModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="hapusSantriModalLabel">Hapus Santri</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3">Yakin ingin menghapus data santri:</p>
                <p class="fw-semibold" id="hapusSantriNama"></p>
                <input type="hidden" id="hapusSantriId">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-action" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger btn-action" id="confirmHapusButton">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const tambahModal = new bootstrap.Modal(document.getElementById('tambahSantriModal'));
const editModal = new bootstrap.Modal(document.getElementById('editSantriModal'));
const hapusModal = new bootstrap.Modal(document.getElementById('hapusSantriModal'));

function openTambahModal() {
    document.getElementById('formTambahSantri').reset();
    tambahModal.show();
}

function openEditModal(id, nama, kelas) {
    document.getElementById('editIdSantri').value = id;
    document.getElementById('editNamaSantri').value = nama;
    document.getElementById('editKelasSantri').value = kelas;
    editModal.show();
}

function openHapusModal(id, nama) {
    document.getElementById('hapusSantriId').value = id;
    document.getElementById('hapusSantriNama').textContent = `${nama}`;
    hapusModal.show();
}

function loadData() {
    fetch('../api/siswa/get.php')
        .then(response => response.json())
        .then(data => {
            let html = '';

            if (!data.length) {
                html = `
                    <tr>
                        <td colspan="3" class="text-center py-4 text-muted">Belum ada santri. Tambahkan data santri di sini.</td>
                    </tr>
                `;
            } else {
                data.forEach(item => {
                    html += `
                        <tr>
                            <td>${item.nama_siswa}</td>
                            <td>${item.kelas}</td>
                            <td class="d-flex gap-2 flex-wrap">
                                <button class="btn btn-warning btn-sm btn-action" onclick='openEditModal(${item.id_siswa}, ${JSON.stringify(item.nama_siswa)}, ${JSON.stringify(item.kelas)})'>Edit</button>
                                <button class="btn btn-danger btn-sm btn-action" onclick='openHapusModal(${item.id_siswa}, ${JSON.stringify(item.nama_siswa)})'>Hapus</button>
                            </td>
                        </tr>
                    `;
                });
            }

            document.getElementById('dataSantri').innerHTML = html;
        })
        .catch(() => {
            document.getElementById('dataSantri').innerHTML = `
                <tr>
                    <td colspan="3" class="text-center py-4 text-danger">Gagal memuat data. Periksa koneksi API.</td>
                </tr>
            `;
        });
}

function submitTambahSantri(event) {
    event.preventDefault();

    const nama = document.getElementById('namaSantri').value.trim();
    const kelas = document.getElementById('kelasSantri').value.trim();

    if (!nama || !kelas) {
        return;
    }

    fetch('../api/siswa/tambah.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `nama=${encodeURIComponent(nama)}&kelas=${encodeURIComponent(kelas)}`
    })
        .then(() => {
            tambahModal.hide();
            loadData();
        });
}

function submitEditSantri(event) {
    event.preventDefault();

    const id = document.getElementById('editIdSantri').value;
    const nama = document.getElementById('editNamaSantri').value.trim();
    const kelas = document.getElementById('editKelasSantri').value.trim();

    if (!id || !nama || !kelas) {
        return;
    }

    fetch('../api/siswa/update.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id=${encodeURIComponent(id)}&nama=${encodeURIComponent(nama)}&kelas=${encodeURIComponent(kelas)}`
    })
        .then(() => {
            editModal.hide();
            loadData();
        });
}

function confirmHapusSantri() {
    const id = document.getElementById('hapusSantriId').value;

    if (!id) return;

    fetch('../api/siswa/hapus.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id=${encodeURIComponent(id)}`
    })
        .then(() => {
            hapusModal.hide();
            loadData();
        });
}

document.getElementById('formTambahSantri').addEventListener('submit', submitTambahSantri);
document.getElementById('formEditSantri').addEventListener('submit', submitEditSantri);
document.getElementById('confirmHapusButton').addEventListener('click', confirmHapusSantri);
loadData();
</script>

</body>
</html>