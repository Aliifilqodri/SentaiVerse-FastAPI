<?php
// Ambil data dari API
$response = @file_get_contents("http://127.0.0.1:8000/sentai/");
$data = json_decode($response);
$is_api_error = $data === null;


// List Super Sentai
$sentai_list = [
  "Himitsu Sentai Gorenger", "J.A.K.Q. Dengekitai", "Battle Fever J", "Denshi Sentai Denziman", "Taiyo Sentai Sun Vulcan",
  "Dai Sentai Goggle-V", "Kagaku Sentai Dynaman", "Choudenshi Bioman", "Dengeki Sentai Changeman", "Choushinsei Flashman",
  "Hikari Sentai Maskman", "Choujuu Sentai Liveman", "Kousoku Sentai Turboranger", "Chikyuu Sentai Fiveman",
  "Choujin Sentai Jetman", "Kyoryu Sentai Zyuranger", "Gosei Sentai Dairanger", "Ninja Sentai Kakuranger",
  "Chouriki Sentai Ohranger", "Gekisou Sentai Carranger", "Denji Sentai Megaranger", "Seijuu Sentai Gingaman",
  "Kyuukyuu Sentai GoGoFive", "Mirai Sentai Timeranger", "Hyakujuu Sentai Gaoranger", "Ninpuu Sentai Hurricaneger",
  "Bakuryuu Sentai Abaranger", "Tokusou Sentai Dekaranger", "Mahou Sentai Magiranger", "GoGo Sentai Boukenger",
  "Juken Sentai Gekiranger", "Engine Sentai Go-Onger", "Samurai Sentai Shinkenger", "Tensou Sentai Goseiger",
  "Kaizoku Sentai Gokaiger", "Tokumei Sentai Go-Busters", "Zyuden Sentai Kyoryuger", "Ressha Sentai ToQger",
  "Shuriken Sentai Ninninger", "Doubutsu Sentai Zyuohger", "Uchu Sentai Kyuranger", "Kaitou Sentai Lupinranger VS Keisatsu Sentai Patranger",
  "Kishiryu Sentai Ryusoulger", "Mashin Sentai Kiramager", "Kikai Sentai Zenkaiger", "Avataro Sentai Donbrothers",
  "Ohsama Sentai King-Ohger", "Bakuage Sentai Boonboomger"
];

$colors = ["Merah", "Biru", "Kuning", "Hijau", "Hitam", "Putih", "Pink", "Perak", "Emas", "Cyan", "Oranye", "Ungu"];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Super Sentai</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600&family=Open+Sans&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Open Sans', sans-serif;
      background: #0f0f0f;
      color: #fff;
      padding: 30px;
    }
    h1 {
      text-align: center;
      font-family: 'Orbitron', sans-serif;
      font-size: 2.5rem;
      margin-bottom: 30px;
      color: #00ffe5;
      text-shadow: 0 0 10px #00ffe5;
    }
    form, .search-bar {
      max-width: 700px;
      margin: 0 auto 30px auto;
      background: #1c1c1c;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0, 255, 229, 0.2);
      border: 1px solid #00ffe5;
    }
    form input, .search-bar input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      background: #0f0f0f;
      border: 1px solid #00ffe5;
      border-radius: 8px;
      color: #00ffe5;
    }
    .file-wrapper {
      position: relative;
      overflow: hidden;
      margin-bottom: 15px;
      width: 100%;
    }
    .file-label {
      display: block;
      background-color: #00ffe5;
      color: #000;
      text-align: center;
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }
    .file-label:hover {
      background-color: #00c8bd;
    }
    .file-wrapper input[type="file"] {
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0;
      width: 100%;
      height: 100%;
      cursor: pointer;
    }
    #file-name {
      margin-top: 8px;
      font-size: 0.9rem;
      color: #00ffe5;
      text-align: center;
      word-break: break-word;
    }
    .search-bar button {
      background: #00ffe5;
      color: #000;
      padding: 10px 20px;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
    }
    .search-bar button:hover {
      background: #00c8bd;
    }
    form button, .card button {
      padding: 10px 20px;
      background: #00ffe5;
      border: none;
      border-radius: 8px;
      color: #000;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
      margin-right: 5px;
    }
    form button:hover, .card button:hover {
      background: #00c8bd;
    }
    .container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      max-width: 1100px;
      margin: auto;
    }
    .card {
      color: #fff;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0, 255, 229, 0.2);
      transition: all 0.3s ease;
      border: 1px solid #00ffe5;
      position: relative;
      overflow: hidden;
    }
    .card:hover {
      box-shadow: 0 0 20px #00ffe5;
      transform: scale(1.03);
    }
    .card h3 {
      font-size: 1.4rem;
      margin-bottom: 10px;
      color: #fff;
    }
    .card p {
      font-size: 1rem;
      color: #ccc;
    }
    .alert {
      text-align: center;
      color: red;
      font-weight: bold;
      margin-top: 40px;
    }
    .card img {
      width: 100%;
      border-radius: 10px;
      margin-bottom: 10px;
      cursor: pointer;
      transition: transform 0.3s;
    }
    .card img:hover {
      transform: scale(1.05);
    }
    .card .actions {
      margin-top: 10px;
    }
    .modal {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(0, 0, 0, 0.6);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1000;
      animation: fadeIn 0.3s ease;
    }
    .modal-content {
      background: linear-gradient(145deg, #1f1f1f, #292929);
      padding: 30px;
      border-radius: 15px;
      max-width: 400px;
      width: 90%;
      text-align: center;
      box-shadow: 0 0 20px #00ffe5;
      animation: slideUp 0.4s ease;
    }
    .modal-content input {
      width: 100%;
      padding: 10px;
      background: #0f0f0f;
      border: 1px solid #00ffe5;
      border-radius: 8px;
      color: #00ffe5;
      margin-bottom: 15px;
    }
    .modal-content button {
      padding: 10px 20px;
      margin-top: 10px;
      background: #00ffe5;
      border: none;
      border-radius: 8px;
      color: #000;
      font-weight: bold;
      cursor: pointer;
    }

    .sentai-dropdown {
  width: 100%;
  padding: 12px 16px;
  font-size: 1rem;
  background-color: #0f0f0f;
  border: 2px solid #00ffe5;
  border-radius: 10px;
  color: #00ffe5;
  appearance: none;
  margin-bottom: 20px; /* 🟢 Tambah jarak ke bawah */
  background-image: none;
    }

    .modal-content button:hover {
      background: #00c8bd;
    }

    
    @keyframes fadeIn {
      from { opacity: 0; } to { opacity: 1; }
    }
    @keyframes slideUp {
      from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; }
    }
    footer {
      text-align: center;
      margin-top: 50px;
      font-size: 0.9rem;
      color: #666;
    }
  </style>
</head>
<body>
  <h1>DAFTAR SUPER SENTAI</h1>

  <!-- Search Bar -->
  <div class="search-bar">
    <input type="text" id="searchInput" placeholder="Cari berdasarkan nama, warna, atau tim...">
    <button onclick="triggerSearch()">🔍 Cari</button>
  </div>

  <!-- Form Tambah Karakter -->
  <form enctype="multipart/form-data" method="post" action="upload.php">
    <input type="text" name="name" placeholder="Nama Karakter" required>
    <input type="text" name="color" placeholder="Warna" required>
    

    <select name="team" id="team" class="sentai-dropdown" required>
  <option value="">🔽 Pilih Tim Sentai</option>
  <?php foreach ($sentai_list as $team): ?>
    <option value="<?= htmlspecialchars($team) ?>"><?= htmlspecialchars($team) ?></option>
  <?php endforeach; ?>
</select>


    <!-- Custom File Upload -->
    <div class="file-wrapper">
      <label for="file-input" class="file-label">📁 Pilih Gambar</label>
      <input type="file" name="image" id="file-input" accept="image/*" required>
      <div id="file-name">Belum ada file dipilih</div>
    </div>

    <button type="submit">+ Tambah Karakter</button>
  </form>

  <div class="container" id="characterContainer">
    <?php if ($is_api_error): ?>
      <div class="alert">❌ Gagal memuat data dari API. Pastikan FastAPI berjalan di <code>127.0.0.1:8000</code></div>
    <?php else: ?>
      <?php
        $teamColors = [
          'Dekaranger' => '#0047AB',
          'Gokaiger' => '#ff004c',
          'Shinkenger' => '#ff9900',
          'Kiramager' => '#00ffe5',
          'Gekiranger' => '#ffcc00',
        ];
      ?>
      <?php foreach ($data as $char): ?>
        <?php $teamBg = $teamColors[$char->team] ?? '#1e1e1e'; ?>
        <div class="card" style="background-color: <?= $teamBg ?>;" data-name="<?= $char->name ?>" data-color="<?= $char->color ?>" data-team="<?= $char->team ?>">
          <?php if (!empty($char->image)): ?>
            <img src="../static/<?= htmlspecialchars($char->image) ?>" alt="<?= htmlspecialchars($char->name) ?>">
          <?php endif; ?>
          <h3><?= htmlspecialchars($char->name) ?> (<?= htmlspecialchars($char->color) ?>)</h3>
          <p>Team: <?= htmlspecialchars($char->team) ?></p>
          <div class="actions">
            <button onclick="deleteChar(<?= $char->id ?>)">Hapus</button>
            <button onclick='openEditModal(<?= json_encode($char) ?>)'>Edit</button>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- Modal Edit -->
  <div id="editModal" class="modal" style="display:none;">
    <div class="modal-content">
      <h3>Edit Karakter</h3>
      <input type="text" id="editName" placeholder="Nama">
      <input type="text" id="editColor" placeholder="Warna">
      <input type="text" id="editTeam" placeholder="Tim">
      <input type="hidden" id="editId">
      <input type="hidden" id="editImage">
      <button onclick="saveEdit()">💾 Simpan</button>
      <button onclick="closeEditModal()">❌ Batal</button>
    </div>
  </div>

  <footer>
    © <?= date('Y') ?> Sentai List UI | Powered by FastAPI & PHP
  </footer>

  <script>
    function triggerSearch() {
      const query = document.getElementById('searchInput').value.toLowerCase();
      document.querySelectorAll('.card').forEach(card => {
        const name = card.dataset.name.toLowerCase();
        const color = card.dataset.color.toLowerCase();
        const team = card.dataset.team.toLowerCase();
        card.style.display = name.includes(query) || color.includes(query) || team.includes(query) ? '' : 'none';
      });
    }

    function deleteChar(id) {
      if (confirm("Yakin ingin menghapus karakter ini?")) {
        fetch(`http://127.0.0.1:8000/sentai/${id}`, { method: 'DELETE' })
          .then(res => res.ok ? location.reload() : alert("Gagal menghapus data"));
      }
    }

    function openEditModal(charData) {
      document.getElementById("editId").value = charData.id;
      document.getElementById("editName").value = charData.name;
      document.getElementById("editColor").value = charData.color;
      document.getElementById("editTeam").value = charData.team;
      document.getElementById("editImage").value = charData.image;
      document.getElementById("editModal").style.display = "flex";
    }

    function closeEditModal() {
      document.getElementById("editModal").style.display = "none";
    }

    function saveEdit() {
      const id = document.getElementById("editId").value;
      const name = document.getElementById("editName").value;
      const color = document.getElementById("editColor").value;
      const team = document.getElementById("editTeam").value;
      const image = document.getElementById("editImage").value;

      fetch(`http://127.0.0.1:8000/sentai/${id}`, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name, color, team, image })
      })
      .then(res => {
        if (res.ok) location.reload();
        else alert("Gagal memperbarui data");
      });
    }

    // File input preview
    document.getElementById('file-input').addEventListener('change', function () {
      const fileName = this.files.length > 0 ? this.files[0].name : "Belum ada file dipilih";
      document.getElementById('file-name').textContent = fileName;
    });
  </script>
</body>
</html>
