1\. Autentikasi (Berisi fitur login dan logout)

* Login (Merupakan fitur untuk memasuki portal admin aplikasi.)
username, password, validation, error message
* Logout



2\. Master (master data)

* Unit kerja 

Mengelola data unit kerja/cabang yang digunakan sebagai induk data driver dan kendaraan, termasuk tambah, ubah, hapus, pencarian, dan melihat detail unit kerja. 



fitur : 

pencarian 

Filter data

tambah unit kerja 

edit unit kerja 

hapus / nonaktifkan unit kerja 

halaman detail unit kerja 



isian form tambah unit kerja 

kode unit kerja 

cabang unit kerja

alamat 

kabupaten (pilihan dropdown)

pic unit 

no telpon 

email 

pilihan status (aktif / nonaktif)



tampilan halaman detail unit cabang :

jawaban isian form

total jumlah driver 

qr active 

total jumlah kendaraan

total jumlah penilaian 

data driver unit kerja hari ini

data kendaraan unit kerja hari ini 



catatan : 

unit kerja jadi induk bagi driver dan kendaraan 

QR kendaraan terhubung dengan unit kerja

* Driver 

Mengelola data driver meliputi identitas, foto, informasi SIM, unit kerja, status aktif, pencarian, filter, serta melihat detail driver. 



fitur : 

tambah driver 

edit driver 

nonaktif / hapus 

tabel list data driver 

detail driver 

search 

filter by status and unit kerja 



isian form : 

a. data pribadi 

nama lengkap (text)

nama panggilan (text) 

tempat (text), tanggal lahir (format date)

jenis kelamin (pilihan)

alamat lengkap (text)

no hp 

email → validasi format email 

status pernikahan (dropdown)

b. dokumen pengemudi 

no sim 

jenis sim (dropdwon)

berlaku hingga (date)

upload gambar sim (image)

c. informasi pekerjaan 

unit kerja (dropdown)

tanggal bergabung (date)

status (aktif / tidak aktif) → pilihan 



* Kendaraan 

Mengelola data kendaraan meliputi identitas kendaraan, informasi operasional, foto kendaraan, unit kerja, status kendaraan, serta fasilitas cetak dan unduh QR Code untuk setiap kendaraan. 



fitur : 

cetak QR kendaraan

tambah data kendaraan 

edit data kendaraan 

lihat detail data kendaraan 

hapus / nonaktifkan kendaraan 

pencarian 

filter by status dan unit kerja 



tampilan kolom tabel data kendaraaan : 

no 

foto 

no polisi 

merk/ tipe

tahun 

warna 

unit kerja 

status

QR code 

aksi 



isian form tambah dan edit kendaraan (data ini akan tampil di detail juga)

a. informasi kendaraan

no polisi 

merk 

tipe / model 

tahun 

warna 

no  rangka / VIN

no mesin

bahan bakar (pilihan dropdown)

transmisi (pilihan dropdown)

kapasitas penumpang

b. informasi operasional 

unit kerja (cabang) (pilihan dropdown)

status (pilihan → aktif /nonaktif)

tanggal pengadaan (date)

sumber pengadaan (pilihan dropdown)

kepemilikan (pilihan → milik perusahaan / leasing (sewa))

masa berlaku STNK (date)

masa berlaku KIR (date)

keterangan (catatan bersifat opsional)

c. foto kendaraan 

foto eksterior

foto interior 



detail kendaraan 

menampilkan isian data kendaraan 

pilihan cetak QR code



alur cetak QR code 

pilih kendaraan 

preview QR code 

atur cetak 

cetak / unduh

* Pertanyaan (Mengelola master pertanyaan penilaian dengan pengaturan kategori (Driver/Kendaraan), urutan pertanyaan, status aktif, tipe jawaban, serta konfigurasi tampilan pertanyaan yang akan muncul pada aplikasi mobile.)

Fitur 

tambah data pertanyaan

edit data pertanyaan

lihat detail data pertanyaan  

hapus / nonaktifkan kendaraan 

pencarian 

filter by status dan kategori 

mapping kategori (pertanyaan dimapping berdasarkan kategori kendaraannya) → untuk di filter nya. 



isian form tambah / edit 

a. informasi pertanyaan 

pertanyaan (wajib), kategori (wajib), tipe jawaban (dropdown pilihan rating), inputan wajib diisi (ya / tidak), urutan, status (aktif / nonaktif)

b. pengaturan tampilan 

deskripsi / petunjuk (opsional), placeholder (opsional), skala rating, label skala (sangat buruk - sangat baik), icon gambar (opsional)



tampilan output hasil penilaian (bedakan antara driver dan kendaraan)



isian kolom tabel data pertanyaan 

no, pertanyaan, kategori, tipe jawaban, wajib / tidak, uruta, status, aksi 



3\. Scan QR Code

4\. Isi Penilaian

5\. Informasi Kendaraan

6\. Pilih Driver

7\. Dashboard

8\. Penilaian

9\. Report \& Monitoring

10\. Pengaturan

11\. Detail Driver

12\. Selesai

