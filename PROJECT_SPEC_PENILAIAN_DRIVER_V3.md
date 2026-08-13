# PROJECT SPECIFICATION V3
# Sistem Penilaian Driver & Kendaraan — Laravel

> **Master specification untuk AI coding agent (Codex).**
>
> Gunakan dokumen ini bersama file **`aplikasi penilaian driver.pdf`**.
>
> **Functional source of truth:** dokumen Markdown ini.
>
> **Visual source of truth:** `aplikasi penilaian driver.pdf`.
>
> Jangan membuat UI dashboard Laravel generik. Struktur visual harus mengikuti rancangan PDF sedekat mungkin, sementara data dan business logic mengikuti dokumen ini.

---

# 1. INSTRUKSI UTAMA UNTUK AI CODEX

Sebelum menulis kode:

1. Baca seluruh dokumen ini.
2. Gunakan `aplikasi penilaian driver.pdf` sebagai referensi visual.
3. Pahami hubungan antara halaman admin, alur penumpang, master data, pertanyaan, dan report.
4. Jangan langsung membuat seluruh aplikasi secara acak.
5. Bangun sistem secara bertahap berdasarkan urutan implementasi.
6. Jangan mengubah business rule tanpa alasan.
7. Jangan menambahkan fitur yang belum diminta sebagai requirement wajib.
8. Jika detail visual tidak dapat dipastikan dari PDF, gunakan gaya visual paling konsisten dengan halaman lain.
9. Jangan mengganti desain menjadi template AdminLTE, Bootstrap dashboard generik, atau template dashboard lain yang tidak menyerupai rancangan.
10. Pastikan desktop dan mobile mengikuti karakter desain referensi.

---

# 2. SUMBER REFERENSI

File desain utama:

```text
aplikasi penilaian driver.pdf
```

PDF berisi:
- Desain keseluruhan sistem.
- Alur sistem penilaian.
- Dashboard admin.
- Report driver.
- Alur penumpang/mobile.
- Master Pertanyaan.
- Master Kendaraan.
- Master Driver.

Referensi PDF memperlihatkan sidebar admin berwarna gelap/navy, area konten putih/terang, aksen biru sebagai warna utama, card dengan sudut membulat, tabel modern, statistik berbentuk card, grafik, serta alur mobile untuk penumpang. fileciteturn1file0L13-L27

---

# 3. TUJUAN SISTEM

Sistem digunakan untuk melakukan penilaian terhadap:

1. Driver.
2. Kendaraan.

Penumpang masuk ke sistem melalui QR Code yang terpasang pada kendaraan.

Alur utama:

```text
QR KENDARAAN
      ↓
INFORMASI KENDARAAN
      ↓
PILIH DRIVER
      ↓
DETAIL DRIVER
      ↓
PENILAIAN
      ↓
SUBMIT
      ↓
SELESAI
      ↓
DATA TERSIMPAN
      ↓
ADMIN MONITORING + REPORT
```

---

# 4. TEKNOLOGI

Gunakan:
- Laravel
- PHP
- MySQL
- Blade
- HTML
- CSS
- JavaScript
- Eloquent ORM
- Laravel Migration
- Laravel Validation/Form Request
- Middleware/Policy
- QR Code generator

Gunakan struktur MVC Laravel yang rapi.

---

# 5. ROLE

## 5.1 Admin

Admin dapat:
- Login.
- Mengakses dashboard.
- Mengelola cabang/unit kerja.
- Mengelola driver.
- Mengelola kendaraan.
- Mengelola pertanyaan.
- Mengatur opsi jawaban.
- Generate QR Code kendaraan.
- Monitoring penilaian.
- Melihat hasil penilaian.
- Melihat report driver.
- Melihat report kendaraan.

## 5.2 Penumpang

Penumpang:
- Tidak perlu login.
- Scan QR kendaraan.
- Melihat informasi kendaraan.
- Memilih driver.
- Melihat detail driver.
- Mengisi pertanyaan.
- Mengirim penilaian.
- Melihat halaman berhasil.

---

# 6. DESIGN SYSTEM

Bagian ini wajib diperhatikan Codex ketika membuat UI.

## 6.1 Prinsip Visual

Gunakan visual yang konsisten dengan PDF:

- Dashboard modern dan bersih.
- Sidebar kiri berwarna gelap/navy.
- Area utama berwarna putih atau sangat terang.
- Primary action menggunakan aksen biru.
- Card menggunakan background putih.
- Card memiliki border tipis dan/atau shadow ringan.
- Border radius terlihat membulat.
- Typography modern, jelas, dan compact.
- Tabel menggunakan header yang jelas.
- Badge status menggunakan warna berbeda sesuai status.
- Icon digunakan pada menu dan action.
- Spacing antar elemen cukup lega.
- Gunakan visual hierarchy yang kuat.
- Jangan membuat tampilan terlalu padat.
- Gunakan responsive layout.

## 6.2 Sidebar Admin

Sidebar pada desain menggunakan:
- Logo/brand.
- Dashboard.
- Kelompok Master Data.
- Kelompok Penilaian.
- Kelompok Laporan.

Struktur konseptual:

```text
LOGO / BRAND
----------------
Dashboard

MASTER DATA
├── Cabang / Unit Kerja
├── Driver
├── Kendaraan
└── Pertanyaan

PENILAIAN
├── Monitoring
└── Penilaian Driver & Kendaraan

LAPORAN
├── Laporan
├── Laporan Kendaraan
└── Laporan Driver
```

Nama menu dapat disesuaikan dengan implementasi final, tetapi struktur visual harus tetap menyerupai desain.

Sidebar:
- Fixed/sticky pada desktop jika sesuai layout.
- Lebar konsisten.
- Icon + label.
- Menu aktif diberi highlight.
- Pada mobile, berubah menjadi drawer/navigation yang nyaman.

## 6.3 Header

Header admin:
- Judul halaman/breadcrumb.
- Search/filter jika diperlukan.
- Informasi admin.
- Avatar/profile.
- Action utama jika halaman membutuhkan.

## 6.4 Card

Card:
- Background putih.
- Border halus.
- Radius membulat.
- Shadow ringan.
- Padding konsisten.

## 6.5 Button

Primary:
- Aksen biru.
- Text putih.
- Radius membulat.
- Icon boleh digunakan.

Secondary:
- Background putih/abu terang.
- Border.
- Text gelap.

Danger:
- Digunakan untuk delete/nonaktif jika diperlukan.

## 6.6 Status Badge

Gunakan badge yang mudah dibedakan untuk:
- Aktif.
- Nonaktif.
- Status lain jika diperlukan.

## 6.7 Table

Tabel harus:
- Bersih.
- Header jelas.
- Row spacing cukup.
- Avatar/foto jika diperlukan.
- Status badge.
- Action icon/button.
- Pagination.
- Search/filter.

## 6.8 Typography

Gunakan satu font sans-serif modern yang mendekati PDF. Jika font asli tidak tersedia, pilih satu font modern yang konsisten untuk seluruh aplikasi.

Jangan mencampurkan banyak font.

---

# 7. RESPONSIVE DESIGN

## Desktop
- Sidebar kiri.
- Header.
- Konten utama.
- Grid card.
- Table.
- Chart.

## Tablet
- Sidebar dapat diperkecil atau menjadi drawer.
- Grid menyesuaikan.
- Table dapat horizontal scroll jika diperlukan.

## Mobile
Khusus halaman penumpang:
- Mobile-first.
- Konten satu kolom.
- Tombol mudah ditekan.
- Card memenuhi sebagian besar lebar layar.
- Foto kendaraan/driver proporsional.
- Form pertanyaan nyaman disentuh.
- Tidak menggunakan sidebar admin.

---

# 8. ALUR PENUMPANG

Rancangan PDF memperlihatkan alur mobile:
1. Scan QR Code
2. Info Kendaraan
3. Pilih Driver
4. Detail Driver
5. Isi Penilaian
6. Selesai

Gunakan urutan tersebut sebagai flow utama. fileciteturn1file0L21-L24

---

# 9. HALAMAN MOBILE — SCAN QR

Menjadi halaman awal ketika penumpang membuka QR Code.

Visual:
- Logo/brand.
- Judul singkat.
- Area QR/indikasi QR.
- Informasi singkat.
- Tombol/aksi utama jika diperlukan.

Jika QR dibuka langsung melalui URL, sistem tidak perlu meminta penumpang melakukan scan ulang.

---

# 10. HALAMAN MOBILE — INFORMASI KENDARAAN

Setelah QR valid, tampilkan:
- Foto kendaraan.
- Nomor polisi.
- Merk/model.
- Tahun.
- Warna.
- Cabang/unit kerja.
- Informasi kendaraan lain yang relevan.

CTA:

```text
Lanjutkan
```

Desain:
- Mobile-first.
- Card kendaraan menjadi fokus.
- Informasi ringkas.
- Tombol primary jelas.

---

# 11. HALAMAN MOBILE — PILIH DRIVER

Tampilkan driver aktif yang tersedia pada cabang kendaraan.

Business rule:

```text
vehicle.branch_id = driver.branch_id
```

Driver tidak terikat hanya pada satu kendaraan.

Contoh:

```text
Cabang A
├── Kendaraan A
├── Kendaraan B
├── Kendaraan C
├── Driver A
├── Driver B
└── Driver C
```

Driver card dapat berisi:
- Foto.
- Nama.
- Informasi singkat.
- Action/select.

---

# 12. HALAMAN MOBILE — DETAIL DRIVER

Tampilkan:
- Foto driver.
- Nama.
- Cabang.
- Informasi singkat.
- Data lain yang aman ditampilkan.

CTA:

```text
Pilih Driver
```

Berikan opsi kembali untuk memilih driver lain.

---

# 13. HALAMAN MOBILE — PENILAIAN

Form penilaian mengambil pertanyaan aktif.

Urutan:

```text
sort_order ASC
```

Kelompokkan berdasarkan target:
- Penilaian Driver.
- Penilaian Kendaraan.

Jika desain final menampilkan keduanya dalam satu halaman, gunakan satu form dengan grouping yang jelas.

---

# 14. HALAMAN MOBILE — SELESAI

Setelah submit:

```text
✓
Terima Kasih!

Penilaian Anda telah berhasil dikirim.
```

Gunakan visual sukses yang menyerupai desain referensi.

---

# 15. MASTER PERTANYAAN — DESIGN SPECIFICATION

PDF menunjukkan halaman Master Pertanyaan dengan sidebar admin, judul/deskripsi, flow pengelolaan, tabel/list pertanyaan, tombol tambah, form tambah/edit, detail/preview, serta pengaturan tampilan/opsi. fileciteturn1file0L22-L24

## 15.1 List

Tampilkan:
- Judul `Master Pertanyaan`.
- Deskripsi.
- Tombol `Tambah Pertanyaan`.
- Search.
- Filter target.
- Filter tipe jawaban.
- Filter status.
- Tabel.

Kolom:

```text
No
Pertanyaan
Target
Tipe Jawaban
Wajib
Urutan
Status
Action
```

Action:
- Detail.
- Edit.
- Aktif/nonaktif.
- Delete jika diperbolehkan.

## 15.2 Form Tambah/Edit

Bagi menjadi section/card.

### Informasi Pertanyaan

Field:
- Pertanyaan.
- Target.
- Tipe jawaban.
- Wajib.
- Urutan.
- Status.

### Target

```text
Driver
Kendaraan
```

### Tipe Jawaban

```text
Skala 1–5
Ya / Tidak
Pilihan Ganda
Checkbox
Jawaban Singkat
Paragraf
```

### Pengaturan Dinamis

Jika tipe membutuhkan opsi:

```text
Opsi Jawaban
[ Baik              ] [hapus]
[ Cukup             ] [hapus]
[ Kurang            ] [hapus]

[ + Tambah Opsi ]
```

Untuk rating 1–5:
- Jangan meminta label nilai.
- Nilai hanya 1,2,3,4,5.

Untuk Ya/Tidak:
- Ya = 1.
- Tidak = 0.

## 15.3 Preview

Form edit dapat memiliki preview di sisi kanan desktop.

Contoh:

```text
PREVIEW

Bagaimana keramahan driver?

1   2   3   4   5
```

Preview berubah mengikuti tipe jawaban.

---

# 16. MASTER KENDARAAN — DESIGN SPECIFICATION

PDF menunjukkan Master Kendaraan dengan sidebar, judul/deskripsi, flow pengelolaan, daftar kendaraan, form tambah/edit, detail kendaraan, dan area QR Code. fileciteturn1file0L25-L27

## 16.1 List Kendaraan

Tampilkan:
- Foto thumbnail.
- Nomor polisi.
- Merk/model.
- Tahun.
- Cabang.
- Status.
- Action.

Action:
- Detail.
- Edit.
- QR.
- Aktif/nonaktif.
- Delete jika diperbolehkan.

## 16.2 Form Kendaraan

### Informasi Kendaraan
- Nomor polisi.
- Merk.
- Tipe/model.
- Tahun.
- Warna.
- Nomor rangka.
- Nomor mesin.
- Bahan bakar.
- Transmisi.
- Kapasitas penumpang.

### Informasi Operasional
- Cabang.
- Status.
- Tanggal perolehan.
- Sumber pengadaan.
- Jenis kepemilikan.
- Nomor kontrak.
- Masa berlaku kontrak.
- Keterangan.

### Foto
- Foto utama.
- Preview.
- Upload/update.

## 16.3 Detail Kendaraan

Tampilkan:
- Foto besar kendaraan.
- QR Code.
- Informasi kendaraan.
- Informasi operasional.
- Cabang.
- Status.

Action:

```text
Preview QR
Download QR
Print QR
Regenerate QR
```

---

# 17. MASTER DRIVER — DESIGN SPECIFICATION

PDF menunjukkan Master Driver dengan sidebar, judul/deskripsi, flow pengelolaan, daftar driver, form tambah/edit, dan detail driver. fileciteturn1file0L25-L27

## 17.1 List Driver

Tampilkan:
- Foto.
- Nama.
- Identitas relevan.
- Cabang.
- Kontak.
- Status.
- Action.

Filter:
- Cabang.
- Status.
- Search.

## 17.2 Form Driver

### Data Pribadi
- Nama lengkap.
- Nama panggilan.
- Tempat lahir.
- Tanggal lahir.
- Jenis kelamin.
- Alamat.
- Nomor HP.
- Email.
- Foto.

### Data SIM
- Nomor SIM.
- Jenis SIM.
- Masa berlaku.
- Foto SIM.

### Informasi Pekerjaan
- Cabang/unit kerja.
- Tanggal bergabung.
- Status.

## 17.3 Detail Driver

Tampilkan:
- Foto.
- Informasi personal relevan.
- Kontak.
- SIM.
- Cabang.
- Status.

Jangan menampilkan data pribadi yang tidak diperlukan kepada penumpang.

---

# 18. DASHBOARD — DESIGN SPECIFICATION

PDF menunjukkan dashboard dengan sidebar kiri, filter periode/cabang, statistic cards, grafik tren, donut chart, tabel penilaian, aktivitas terbaru, statistik cabang, dan ranking. fileciteturn1file0L18-L20

## Header
- Breadcrumb/judul Dashboard.
- Periode.
- Filter cabang/unit kerja.
- Profile admin.

## Statistic Cards

Contoh:
- Total penilaian.
- Rating driver.
- Rating kendaraan.
- Total driver.
- Total kendaraan.
- Penilaian hari ini.

Setiap card:
- Icon.
- Label.
- Nilai utama.
- Trend jika tersedia.

## Grafik
- Trend penilaian.
- Trend rating driver/kendaraan jika tersedia.

## Distribusi
Gunakan donut/pie chart untuk distribusi rating 1–5.

## Penilaian Terbaru

Kolom:
- Waktu.
- Driver.
- Kendaraan.
- Cabang.
- Rating.
- Detail.

## Statistik Cabang
Tampilkan perbandingan penilaian/rating antar cabang.

## Aktivitas Terbaru
Tampilkan aktivitas sistem terbaru jika tersedia.

## Ranking
Tampilkan:
- Top driver.
- Top kendaraan.

---

# 19. REPORT — DESIGN SPECIFICATION

PDF menunjukkan report dengan sidebar, header report, filter, statistic cards, grafik tren, distribusi rating, statistik kategori, dan tabel performa driver. fileciteturn1file0L18-L20

## Filter

Minimal:
- Periode.
- Cabang.
- Driver.

Action:

```text
Terapkan
Reset
Export
```

Export hanya dibuat jika requirement export diaktifkan.

## Statistic Cards

Contoh:
- Total driver.
- Rating rata-rata.
- Total penilaian.
- Driver terbaik.

## Grafik
- Tren rating.
- Distribusi rating.
- Perbandingan driver jika diperlukan.

## Tabel Performa Driver

Kolom:
- Foto.
- Nama.
- Cabang.
- Total penilaian.
- Rating rata-rata.
- Rating 1.
- Rating 2.
- Rating 3.
- Rating 4.
- Rating 5.
- Persentase Ya/Tidak jika relevan.
- Status/trend.

---

# 20. REPORT KENDARAAN

Gunakan pola visual report driver, tetapi fokus pada kendaraan.

Tampilkan:
- Total kendaraan.
- Rating rata-rata kendaraan.
- Total penilaian.
- Kendaraan terbaik.
- Grafik tren.
- Distribusi rating.
- Tabel performa kendaraan.

---

# 21. MONITORING

Monitoring digunakan untuk melihat penilaian yang masuk.

Tampilkan:
- Tanggal/waktu.
- Driver.
- Kendaraan.
- Cabang.
- Rating.
- Status.
- Detail.

Filter:
- Periode.
- Cabang.
- Driver.
- Kendaraan.

---

# 22. BUSINESS RULE MASTER DATA

Cabang adalah penghubung driver dan kendaraan.

```text
Branch
├── Drivers
└── Vehicles
```

Driver dimiliki oleh satu cabang.

Kendaraan dimiliki oleh satu cabang.

Tidak ada relasi wajib:

```text
Driver → Vehicle
```

karena driver dapat menggunakan beberapa kendaraan dalam cabang yang sama.

---

# 23. MASTER PERTANYAAN — BUSINESS RULE

Target:

```text
driver
vehicle
```

Tipe:

```text
rating
yes_no
multiple_choice
checkbox
short_text
paragraph
```

Required:

```text
true
false
```

Status:

```text
active
inactive
```

Urutan:

```text
sort_order ASC
```

Pertanyaan nonaktif tidak boleh muncul pada form penumpang.

---

# 24. PERHITUNGAN NILAI

## Rating

Rentang:

```text
1–5
```

Rata-rata:

```text
SUM(rating) / COUNT(rating)
```

## Ya/Tidak

```text
Ya    = 1
Tidak = 0
```

Report:

```text
Persentase Ya
Persentase Tidak
```

Jangan mencampurkan nilai 0/1 dengan rating 1–5 dalam satu rata-rata.

## Bobot

Tidak digunakan pada V3.

---

# 25. QR CODE

Setiap kendaraan memiliki token unik.

Contoh URL:

```text
/rating/{vehicleToken}
```

Admin:
- Generate.
- Preview.
- Download.
- Print.
- Regenerate.

Penumpang diarahkan langsung ke kendaraan yang sesuai.

---

# 26. DATABASE

## branches

```text
id
code
name
address
status
created_at
updated_at
```

## drivers

```text
id
branch_id
full_name
nickname
birth_place
birth_date
gender
address
phone
email
photo
sim_number
sim_type
sim_expired_at
sim_photo
join_date
status
created_at
updated_at
```

## vehicles

```text
id
branch_id
police_number
brand
model
year
color
chassis_number
engine_number
fuel_type
transmission
passenger_capacity
acquisition_date
acquisition_source
ownership_type
contract_number
contract_expired_at
description
photo
status
qr_token
created_at
updated_at
```

## questions

```text
id
question
target_type
answer_type
is_required
sort_order
status
created_at
updated_at
```

## question_options

```text
id
question_id
option_text
sort_order
created_at
updated_at
```

## ratings

```text
id
branch_id
vehicle_id
driver_id
submitted_at
created_at
updated_at
```

## rating_answers

```text
id
rating_id
question_id
answer_value
answer_text
created_at
updated_at
```

Untuk checkbox, gunakan struktur yang mampu menyimpan lebih dari satu pilihan secara konsisten.

---

# 27. ELOQUENT RELATIONSHIP

```text
Branch hasMany Driver
Branch hasMany Vehicle
Branch hasMany Rating

Driver belongsTo Branch
Driver hasMany Rating

Vehicle belongsTo Branch
Vehicle hasMany Rating

Question hasMany QuestionOption
Question hasMany RatingAnswer

QuestionOption belongsTo Question

Rating belongsTo Branch
Rating belongsTo Driver
Rating belongsTo Vehicle
Rating hasMany RatingAnswer

RatingAnswer belongsTo Rating
RatingAnswer belongsTo Question
```

---

# 28. ROUTES

## Admin

```text
/admin/dashboard
/admin/branches
/admin/drivers
/admin/vehicles
/admin/questions
/admin/ratings
/admin/monitoring
/admin/reports/drivers
/admin/reports/vehicles
```

## Penumpang

```text
/rating/{vehicleToken}
/rating/{vehicleToken}/vehicle
/rating/{vehicleToken}/drivers
/rating/{vehicleToken}/driver/{driver}
/rating/{vehicleToken}/assessment
/rating/{vehicleToken}/success
```

Route dapat disesuaikan selama flow tetap sama.

---

# 29. VALIDATION

## Vehicle
- QR token valid.
- Kendaraan aktif.

## Driver
- Driver aktif.
- Driver berada pada cabang yang sama dengan kendaraan.

## Question
- Pertanyaan aktif.
- Target valid.
- Answer type valid.
- Required tervalidasi.
- Sort order valid.
- Option wajib tersedia untuk tipe yang membutuhkan opsi.

## Rating
- Vehicle valid.
- Driver valid.
- Driver dan vehicle satu cabang.
- Required questions terjawab.
- Rating hanya 1–5.
- Yes/No hanya 0/1.
- Multiple choice hanya menerima option milik question tersebut.
- Checkbox hanya menerima option milik question tersebut.

---

# 30. SECURITY

Implementasikan:
- Admin authentication.
- Authorization.
- CSRF.
- Validation.
- Mass assignment protection.
- Secure QR token.
- Rate limiting jika diperlukan.
- Jangan expose data pribadi driver yang tidak diperlukan.
- Jangan memperbolehkan manipulasi `driver_id`, `vehicle_id`, atau `question_id` tanpa validasi server.
- Jangan percaya data dari browser tanpa validasi server.

---

# 31. COMPONENT ARCHITECTURE

Gunakan reusable components.

Contoh:

```text
resources/views/components/
├── admin/
│   ├── sidebar.blade.php
│   ├── header.blade.php
│   ├── stat-card.blade.php
│   ├── data-table.blade.php
│   ├── status-badge.blade.php
│   └── page-header.blade.php
│
└── passenger/
    ├── progress.blade.php
    ├── vehicle-card.blade.php
    ├── driver-card.blade.php
    ├── question.blade.php
    └── success-card.blade.php
```

Nama dapat disesuaikan.

---

# 32. UI IMPLEMENTATION RULES

1. Jangan hardcode data master.
2. Jangan hardcode pertanyaan.
3. Jangan hardcode daftar driver.
4. Jangan hardcode kendaraan.
5. Gunakan database.
6. Gunakan reusable components.
7. Gunakan CSS variables/theme jika membantu konsistensi.
8. Pertahankan spacing dan hierarchy.
9. Jangan menggunakan terlalu banyak warna.
10. Gunakan icon konsisten.
11. Gunakan empty state.
12. Gunakan loading state jika async.
13. Gunakan validation error yang jelas.
14. Gunakan confirmation sebelum tindakan destructive.
15. Pastikan tabel usable pada layar kecil.
16. Pastikan form mudah digunakan.

---

# 33. DATA DUMMY / SEEDER

Seeder dapat dibuat untuk development:
- Cabang.
- Driver.
- Kendaraan.
- Pertanyaan.
- Question options.
- Admin.

Data dummy tidak boleh menjadi data utama production.

---

# 34. ACCEPTANCE CRITERIA — PENUMPANG

- [ ] QR kendaraan dapat dibuka.
- [ ] Sistem menemukan kendaraan.
- [ ] Kendaraan nonaktif ditolak.
- [ ] Informasi kendaraan tampil.
- [ ] Driver aktif dari cabang yang sama tampil.
- [ ] Driver dari cabang lain tidak tampil.
- [ ] Driver nonaktif tidak tampil.
- [ ] Dapat memilih driver.
- [ ] Detail driver tampil.
- [ ] Form penilaian dapat dibuka.
- [ ] Pertanyaan aktif tampil.
- [ ] Pertanyaan nonaktif tidak tampil.
- [ ] Pertanyaan sesuai urutan.
- [ ] Target Driver/Kendaraan benar.
- [ ] Rating 1–5 berjalan.
- [ ] Ya/Tidak berjalan.
- [ ] Multiple choice berjalan.
- [ ] Checkbox berjalan.
- [ ] Jawaban singkat berjalan.
- [ ] Paragraf berjalan.
- [ ] Pertanyaan wajib divalidasi.
- [ ] Data tersimpan.
- [ ] Halaman sukses tampil.

---

# 35. ACCEPTANCE CRITERIA — ADMIN

- [ ] Admin dapat login.
- [ ] Dashboard tampil.
- [ ] Sidebar konsisten.
- [ ] Cabang dapat dikelola.
- [ ] Driver dapat dikelola.
- [ ] Kendaraan dapat dikelola.
- [ ] QR dapat dibuat.
- [ ] QR dapat di-preview.
- [ ] QR dapat di-download.
- [ ] QR dapat di-print.
- [ ] Pertanyaan dapat dibuat.
- [ ] Pertanyaan dapat diedit.
- [ ] Pertanyaan dapat diaktifkan/nonaktifkan.
- [ ] Target dapat dipilih.
- [ ] Tipe jawaban dapat dipilih.
- [ ] Opsi dapat dibuat.
- [ ] Wajib/tidak wajib dapat diatur.
- [ ] Urutan dapat diatur.
- [ ] Monitoring tersedia.
- [ ] Report driver tersedia.
- [ ] Report kendaraan tersedia.
- [ ] Dashboard mengambil data database.

---

# 36. ACCEPTANCE CRITERIA — VISUAL

Codex harus memeriksa:

- [ ] Sidebar memiliki karakter visual seperti PDF.
- [ ] Header memiliki struktur seperti PDF.
- [ ] Card statistik menyerupai desain.
- [ ] Tabel memiliki gaya modern seperti desain.
- [ ] Tombol primary menggunakan aksen biru.
- [ ] Status menggunakan badge.
- [ ] Form menggunakan section/card.
- [ ] Detail menggunakan layout card.
- [ ] Dashboard menggunakan chart.
- [ ] Report memiliki filter dan summary.
- [ ] Mobile flow satu kolom.
- [ ] Font konsisten.
- [ ] Spacing konsisten.
- [ ] Border radius konsisten.
- [ ] UI responsive.
- [ ] Tidak terlihat seperti template dashboard generik.

---

# 37. URUTAN IMPLEMENTASI CODEX

```text
PHASE 1
Laravel setup
Environment
Database
Authentication
Admin layout
Theme/UI foundation

PHASE 2
Migration
Models
Relationships
Seeders

PHASE 3
Master Cabang
Master Driver
Master Kendaraan

PHASE 4
QR Code
Vehicle QR flow

PHASE 5
Master Pertanyaan
Question options
Dynamic question renderer
Question preview

PHASE 6
Passenger mobile flow
QR entry
Vehicle info
Driver selection
Driver detail
Assessment
Success

PHASE 7
Rating storage
Validation
Business rules

PHASE 8
Dashboard
Monitoring
Report Driver
Report Kendaraan

PHASE 9
Responsive refinement
UI matching
Empty state
Loading state
Error state

PHASE 10
Security
Testing
Bug fixing
Final polish
```

Jangan membuat seluruh UI sebagai mockup yang tidak terhubung ke database.

---

# 38. TESTING

## QR

```text
valid QR → vehicle ditemukan
invalid QR → error
inactive vehicle → ditolak
```

## Driver

```text
same branch → tampil
different branch → tidak tampil
inactive driver → tidak tampil
```

## Question

```text
active → tampil
inactive → tidak tampil
required kosong → gagal submit
rating < 1 → gagal
rating > 5 → gagal
yes/no selain 0/1 → gagal
```

## Rating

```text
valid → tersimpan
invalid vehicle → gagal
invalid driver → gagal
different branch → gagal
```

---

# 39. REQUIREMENT YANG BELUM DITETAPKAN

Jangan mengarang keputusan final untuk:
1. Nama brand/logo final.
2. Font asli yang digunakan.
3. Exact color code jika tidak diberikan sebagai design token.
4. Jumlah role admin.
5. Metode login final.
6. Apakah penumpang dapat menilai berkali-kali.
7. Anti-duplicate/spam.
8. Export PDF.
9. Export Excel.
10. Penyimpanan file local/cloud.
11. Field tambahan driver.
12. Field tambahan kendaraan.
13. Dropdown sebagai tipe jawaban.
14. Randomisasi pertanyaan.
15. Batas karakter.
16. Audit log.
17. Notifikasi.
18. Integrasi eksternal.

Jika belum ditentukan:
- Gunakan requirement yang sudah ada.
- Jangan membuat business rule baru.
- Jangan menambahkan fitur kompleks hanya karena tersedia di framework.

---

# 40. FUNCTION VS DESIGN

Jika menyangkut fungsi:

```text
Gunakan PROJECT_SPEC_PENILAIAN_DRIVER_V3.md
```

Jika menyangkut visual:

```text
Gunakan aplikasi penilaian driver.pdf
```

Jika keduanya perlu digabung:

```text
FUNCTION
→ Markdown

VISUAL
→ PDF

IMPLEMENTATION
→ Laravel
```

Contoh:

```text
Markdown:
"Driver ditampilkan berdasarkan cabang kendaraan."

PDF:
"Driver ditampilkan dalam card mobile dengan foto dan informasi."

Implementation:
Query berdasarkan branch_id
+
render dalam driver card yang mengikuti visual PDF.
```

---

# 41. FINAL USER FLOW

## Admin

```text
Login
 ↓
Dashboard
 ↓
Master Cabang
 ↓
Master Driver
 ↓
Master Kendaraan
 ↓
Generate QR
 ↓
Master Pertanyaan
 ↓
Aktifkan Pertanyaan
 ↓
Monitoring
 ↓
Report
```

## Penumpang

```text
Scan QR
 ↓
Kendaraan
 ↓
Lanjutkan
 ↓
Pilih Driver
 ↓
Detail Driver
 ↓
Pilih Driver
 ↓
Penilaian
 ↓
Submit
 ↓
Selesai
```

---

# 42. FINAL PRINCIPLE

Sistem harus menghasilkan:

```text
MASTER DATA
       ↓
CABANG
       ↓
DRIVER + KENDARAAN
       ↓
PERTANYAAN
       ↓
QR CODE
       ↓
PENUMPANG
       ↓
PENILAIAN
       ↓
DATABASE
       ↓
DASHBOARD
       ↓
MONITORING
       ↓
REPORT
```

**Tujuan utama:**

Membuat sistem penilaian driver dan kendaraan berbasis Laravel yang mudah digunakan penumpang melalui QR Code, mudah dikelola admin, menghasilkan data penilaian terstruktur, dan memiliki UI yang secara visual mengikuti rancangan PDF yang diberikan.

**Prioritas implementasi:**

1. Fungsionalitas benar.
2. Business rule benar.
3. Data tersimpan benar.
4. Security dan validation benar.
5. UI mengikuti PDF sedekat mungkin.
6. Responsive pada desktop, tablet, dan terutama mobile.
