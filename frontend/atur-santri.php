<!DOCTYPE html>
<html>
<head>
    <title>Atur Santri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<div class="container mt-4">
    <h3>Atur Santri</h3>

    <button class="btn btn-success mb-3" onclick="tambahSantri()">+ Tambah Santri</button>
    <!-- KANAN -->
    <a href="dashboard.php" 
       style="
            text-decoration: none;
            background: #4f46e5;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: 0.3s;
       "
       onmouseover="this.style.background='#4338ca'"
       onmouseout="this.style.background='#4f46e5'">
        ← Back
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="dataSantri"></tbody>
    </table>
</div>

<script>

// LOAD DATA
function loadData() {
    fetch('http://localhost/project-software/api/siswa/get.php')
    .then(res => res.json())
    .then(data => {
        let html = '';

        data.forEach(item => {
            html += `
                <tr>
                    <td>${item.nama_siswa}</td>
                    <td>${item.kelas}</td>
                    <td>
                        <button class="btn btn-warning btn-sm"
                            onclick="editSantri(${item.id_siswa}, '${item.nama_siswa}', '${item.kelas}')">
                            Edit
                        </button>

                        <button class="btn btn-danger btn-sm"
                            onclick="hapusSantri(${item.id_siswa})">
                            Hapus
                        </button>
                    </td>
                </tr>
            `;
        });

        document.getElementById('dataSantri').innerHTML = html;
    });
}

// TAMBAH
function tambahSantri() {
    let nama = prompt("Nama santri:");
    let kelas = prompt("Kelas:");

    fetch('http://localhost/project-software/api/siswa/tambah.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `nama=${nama}&kelas=${kelas}`
    })
    .then(() => loadData());
}

// HAPUS
function hapusSantri(id) {
    if (!confirm("Yakin hapus?")) return;

    fetch('http://localhost/project-software/api/siswa/hapus.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id=${id}`
    })
    .then(() => loadData());
}

// EDIT
function editSantri(id, namaLama, kelasLama) {
    let nama = prompt("Edit nama:", namaLama);
    let kelas = prompt("Edit kelas:", kelasLama);

    fetch('http://localhost/project-software/api/siswa/update.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id=${id}&nama=${nama}&kelas=${kelas}`
    })
    .then(() => loadData());
}

// LOAD AWAL
loadData();

</script>

</body>
</html>