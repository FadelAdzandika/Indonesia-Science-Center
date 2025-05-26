@extends('layouts.app')

@section('title', 'Pesan Kunjungan | Indonesia Science Center')

@section('content')
<section id="kunjungan-form" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold text-primary mb-3">Rencanakan Kunjungan Anda</h1>
            <p class="fs-5 text-muted col-lg-8 mx-auto">
                Isi formulir di bawah untuk mengatur jadwal kunjungan Anda ke Indonesia Science Center.
                Tim kami akan segera menghubungi Anda melalui WhatsApp untuk konfirmasi.
            </p>
        </div>

        <div class="row g-lg-5 align-items-stretch justify-content-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <div class="card shadow-sm border-0 rounded-3 h-100 d-flex flex-column">
                    {{-- Jika ingin tetap ada gambar di kiri form, bisa diaktifkan lagi --}}
                    {{-- <div class="col-md-6 d-none d-md-block" style="background-image: url('{{ asset('images/kantor.jpg') }}'); background-size: cover; background-position: center; border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem; min-height: 400px;">
                    </div> --}}
                    {{-- <div class="col-md-12"> --}}
                    <div class="card-body p-4 p-lg-5 d-flex flex-column">
                        <h3 class="fw-bold mb-4 text-center">Formulir Kunjungan</h3>
                        <form id="pesanKunjunganForm" class="needs-validation flex-grow-1" novalidate>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="namaKunjungan" name="nama" placeholder="Nama Lengkap Anda" required>
                                <label for="namaKunjungan">Nama Lengkap</label>
                                <div class="invalid-feedback">Nama lengkap wajib diisi.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="emailKunjungan" name="email" placeholder="Alamat Email Anda" required>
                                <label for="emailKunjungan">Email</label>
                                <div class="invalid-feedback">Format email tidak valid.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="subjekKunjungan" name="subjek" placeholder="Contoh: Kunjungan Rombongan Sekolah" required>
                                <label for="subjekKunjungan">Subjek Kunjungan</label>
                                <div class="invalid-feedback">Subjek wajib diisi.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="pesanKunjungan" name="pesan" style="height: 100px" placeholder="Detail rencana kunjungan..." required></textarea>
                                <label for="pesanKunjungan">Detail Pesan</label>
                                <div class="invalid-feedback">Detail pesan wajib diisi.</div>
                            </div>
                            <button type="submit" class="w-100 btn btn-lg btn-success mt-auto">
                                <i class="bi bi-whatsapp me-2"></i>Kirim via WhatsApp
                            </button>
                        </form>
                    </div>
                    {{-- </div> --}}
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow-sm border-0 rounded-3 p-4 h-100 d-flex flex-column text-center text-lg-start">
                    <h4 class="mb-3 text-primary text-center">Temukan Kami</h4>
                    <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow-sm mb-3 flex-grow-1" style="min-height: 280px;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.280495311553!2d106.90099767400003!3d-6.302218093692077!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ed50d090bb61%3A0x51439bd053397c1b!2sIndonesia%20Science%20Center%20(PP-IPTEK)!5e0!3m2!1sen!2sid!4v1716630000000!5m2!1sen!2sid"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <p class="mb-1"><i class="bi bi-geo-alt-fill me-2 text-primary"></i>Gedung PP-IPTEK, Taman Mini Indonesia Indah (TMII), Jakarta Timur</p>
                    <p class="mb-3"><i class="bi bi-clock-fill me-2 text-primary"></i>Senin - Minggu: 08.30 - 17.00 WIB</p>
                    <a href="https://www.google.com/maps/place/Indonesia+Science+Center+(PP-IPTEK)/@-6.3022181,106.9035726,17z/data=!3m1!4b1!4m6!3m5!1s0x2e69ed50d090bb61:0x51439bd053397c1b!8m2!3d-6.3022181!4d106.9035726!16s%2Fg%2F1tdnt9jc?entry=ttu&g_ep=EgoyMDI1MDUyMS4wIKXMDSoASAFQAw%3D%3D" target="_blank" class="btn btn-outline-primary mt-auto">
                        <i class="bi bi-map-fill me-2"></i>Lihat Rute di Google Maps
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Bootstrap form validation
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                // Jika form valid, lanjutkan dengan logika WhatsApp
                event.preventDefault(); // Tetap cegah submit default agar bisa kirim ke WA
                const nama = document.getElementById('namaKunjungan').value;
                const email = document.getElementById('emailKunjungan').value;
                const subjek = document.getElementById('subjekKunjungan').value;
                const pesan = document.getElementById('pesanKunjungan').value;
                const nomorWhatsApp = '628179934325'; // GANTI DENGAN NOMOR WHATSAPP TUJUAN ANDA

                // Format pesan WhatsApp yang disesuaikan
                let pesanWhatsApp = `Halo nama saya, ${nama}.

Subjek Kunjungan: ${subjek}

Berikut adalah detail rencana kunjungan saya:
${pesan}

Mohon informasinya. Terima kasih.`;

                const urlWhatsApp = `https://web.whatsapp.com/send?phone=${nomorWhatsApp}&text=${encodeURIComponent(pesanWhatsApp)}`;
                window.open(urlWhatsApp, '_blank');
                // form.reset(); // Opsional: reset form setelah dikirim
                // form.classList.remove('was-validated'); // Hapus kelas validasi setelah submit
            }
            form.classList.add('was-validated');
        }, false);
    });
});
</script>
@endpush

@push('styles')
<style>
    /* Anda bisa menambahkan custom style di sini jika diperlukan */
    #kunjungan-form .card {
        transition: box-shadow 0.3s ease-in-out;
    }
    #kunjungan-form .card:hover {
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.1)!important; /* Sedikit lebih halus dari shadow-lg */
    }
</style>
@endpush