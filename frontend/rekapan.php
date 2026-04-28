<!DOCTYPE html>
<html>
<head>
    <title>Rekapan</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container mt-4">
    <div class="chart-box">
        <h3 class="page-title">Rekapan Poin</h3>

        <div class="filter-bar">
            <select class="form-select">
                <option>Terbanyak</option>
                <option>Ringan</option>
                <option>Sedang</option>
                <option>Berat</option>
            </select>

            <input type="text" class="form-control search-box" placeholder="Cari pelanggaran">
        </div>

        <canvas id="myChart"></canvas>
    </div>
</div>

<script>
new Chart(document.getElementById('myChart'), {
    type: 'bar',
    data: {
        labels: ['Ahmad', 'Rizky', 'Fajar'],
        datasets: [{
            label: 'Total Poin',
            data: [30, 12, 45]
        }]
    }
});
</script>

</body>
</html>