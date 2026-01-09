<!DOCTYPE html>
<html>

<head>
    <title>Surat Kelulusan - {{ $registrant->registration_number }}</title>
    <style>
        @page {
            margin: 1cm 1.5cm;
            size: legal portrait;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.4;
            margin: 0;
            padding: 0;
        }

        /* HEADER */
        .kop-image {
            width: 100%;
            height: auto;
            display: block;
            
            margin-bottom: 15px;
        }

        .header-table {
            width: 100%;
            border-bottom: 3px double black;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .logo-cell {
            width: 13%;
            vertical-align: middle;
            text-align: left;
        }

        .logo-image {
            width: 80px;
            height: auto;
        }

        .text-cell {
            width: 87%;
            text-align: center;
            vertical-align: middle;
        }

        .text-cell h1 {
            margin: 0;
            font-size: 16pt;
            font-weight: bold;
        }

        .text-cell h2 {
            margin: 0;
            font-size: 12pt;
            font-weight: bold;
        }

        .text-cell p {
            margin: 0;
            font-size: 11pt;
        }

        /* DOCUMENT NUMBER & INFO */
        .doc-info {
            margin-bottom: 15px;
        }

        .doc-info table {
            width: 100%;
        }

        .doc-info td {
            vertical-align: top;
        }

        .doc-label {
            width: 60px;
        }

        .doc-separator {
            width: 15px;
        }

        /* RECIPIENT INFO */
        .recipient {
            margin-bottom: 15px;
        }

        .recipient table {
            margin-left: 30px;
        }

        .recipient td {
            vertical-align: top;
            padding: 2px 0;
        }

        /* MAIN CONTENT */
        .content {
            text-align: justify;
            margin-bottom: 10px;
        }

        .content p {
            margin: 0 0 10px 0;
            text-indent: 40px;
        }

        .status-lulus {
            font-weight: bold;
            text-align: center;
            font-size: 16pt;
            margin: 5px 0;
        }

        .status-lulus .diterima {
            color: #000;
            text-decoration: underline;
        }

        .jurusan {
            font-weight: bold;
            text-align: center;
            font-size: 13pt;
            margin-bottom: 5px;
        }

        /* PAYMENT INFO */
        .payment-section {
            margin: 5px 0;
        }

        .payment-table {
            width: 100%;
            margin-bottom: 5px;
        }

        .payment-table td {
            padding: 2px 0;
            vertical-align: top;
        }

        .payment-label {
            width: 30px;
            text-align: center;
        }

        .payment-name {
            width: 250px;
        }

        .payment-rp {
            width: 30px;
            text-align: right;
        }

        .payment-amount {
            width: 100px;
            text-align: right;
        }

        .payment-total {
            font-weight: bold;
            border-top: 1px solid black;
        }

        .terbilang {
            font-style: italic;
        }

        /* PAYMENT NOTE */
        .payment-note {
            text-align: justify;
            margin: 15px 0;
        }

        /* SIGNATURE SECTION */
        .signature-section {
            width: 100%;
            margin-top: 20px;
        }

        .signature-table {
            width: 100%;
        }

        .signature-box {
            width: 100%;
            vertical-align: top;
        }

        .signature-left {
            text-align: center;
        }

        .signature-right {
            text-align: center;
        }

        .signature-name {
            font-weight: bold;
            margin-top: 60px;
        }

        .signature-image {
            max-width: 120px;
            max-height: 80px;
            margin-top: 10px;
        }

        .stamp-container {
            position: relative;
            display: inline-block;
        }

        .stamp-image {
            max-width: 100px;
            max-height: 100px;
            position: absolute;
            top: -30px;
            right: -30px;
            opacity: 0.8;
        }

        /* NOTES SECTION */
        .notes-section {
            margin-top: 20px;
            font-size: 12pt;
        }

        .notes-section h4 {
            margin: 0 0 5px 0;
            font-size: 11pt;
            text-decoration: underline;
            color: #990000;
        }

        .notes-section ol {
            margin: 0;
            padding-left: 20px;
        }

        .notes-section li {
            margin-bottom: 3px;
            text-align: justify;
        }

        /* UTILS */
        .text-center {
            text-align: center;
        }

        .text-bold {
            font-weight: bold;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .underline {
            text-decoration: underline;
        }

        .italic {
            font-style: italic;
        }

        .salam {
            font-style: italic;
            margin: 10px 0;
        }

        .panitia-title {
            font-weight: bold;
            text-align: center;
            font-size: 12pt;
            margin: 20px 0 5px 0;
            text-decoration: underline;
        }

        .tahun-ajaran {
            text-align: center;
            font-size: 11pt;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    {{-- HEADER with Letterhead --}}
    @if($kop = \App\Models\Setting::getValue('document_header'))
    <img src="{{ public_path('images/' . $kop) }}" class="kop-image" alt="Kop Surat">
    @else
    <table class="header-table">
        <tr>
            <td class="logo-cell">
                <img src="{{ public_path('images/' . \App\Models\Setting::getValue('app_logo', 'default.png')) }}"
                    class="logo-image" alt="Logo">
            </td>
            <td class="text-cell">
                <h1>{{ \App\Models\Setting::getValue('school_name', 'SMK DEFAULT') }}</h1>
                <h2>PANITIA PENERIMAAN PESERTA DIDIK BARU (PPDB)</h2>
                <p>{{ \App\Models\Setting::getValue('school_address') }}</p>
                <p>Telp: {{ \App\Models\Setting::getValue('school_phone') }} | Email: {{ \App\Models\Setting::getValue('school_email') }}</p>
            </td>
        </tr>
    </table>
    @endif

    {{-- DOCUMENT INFO --}}
    <div class="doc-info">
        <table>
            <tr>
                <td class="doc-label">Nomor</td>
                <td class="doc-separator">:</td>
                <td>{{ str_pad($pengumuman->id, 3, '0', STR_PAD_LEFT) }} / PPDB-SMK AG/VI/{{ date('Y') }}</td>
            </tr>
            <tr>
                <td class="doc-label">Perihal</td>
                <td class="doc-separator">:</td>
                <td><strong>Kelulusan Seleksi Murid Baru Tahun Ajaran {{ \App\Models\Setting::getValue('academic_year', '2025/2026') }}</strong></td>
            </tr>
        
    </table>
    
        <p>Kepada Yth,</p>
        <p style="margin: 0;">Bapak/ Ibu Orang Tua/Wali dari : <strong>{{ strtoupper($registrant->name) }}</strong></p>
        <p style="margin: 0;">Asal Sekolah : <strong>{{ $registrant->academic->school_name ?? '-' }}</strong></p>
    </div>

    {{-- GREETING --}}
    <p class="salam"><em>Assalamu'alaikum Wr. Wb.</em></p>

    {{-- MAIN CONTENT --}}
    <div class="content">
        <p>
            Berdasarkan hasil akhir seleksi Tes Minat dan Bakat serta Wawancara Penerimaan Peserta Didik Baru (PPDB) SMK Al-Ghifari Tahun Pelajaran
             {{ \App\Models\Setting::getValue('academic_year', '2025/2026') }} pada tahap pergelombang, dengan ini diumumkan pada hari {{ $pengumuman->created_at->translatedFormat('l, d F Y') }}   
           , bahwa putra/putri Bapak/Ibu dinyatakan:
        </p>
    </div>

    {{-- STATUS KELULUSAN --}}
    @if($pengumuman->status === 'Lulus')
    <div class="status-lulus">
        <span class="diterima">DITERIMA</span>
    </div>
    <div class="jurusan">
    Jurusan : {{ $registrant->major->name ?? '-' }}
    </div>
    @else
    <div class="status-lulus">
        <span class="diterima" style="color: #990000;">TIDAK DITERIMA</span>
    </div>
    @endif

    @if($pengumuman->status === 'Lulus')
    {{-- SELANJUTNYA (DAFTAR ULANG) --}}
    <div class="content">
        <p style="text-indent: 0;">
            Selanjutnya bagi saudara/i yang diterima agar segera melaksanakan <strong>Daftar Ulang</strong>, dengan ketentuan sebagai berikut :
        </p>
    </div>

    {{-- PAYMENT INFO --}}
    <div class="payment-section">
        <table class="payment-table">
            <tr>
                <td class="payment-label">1.</td>
                <td class="payment-name">Membayar Biaya MOPD/MPLS</td>
                <td class="payment-rp">Rp.</td>
                <td class="payment-amount">150.000,-</td>
            </tr>
            <tr>
                <td class="payment-label">2.</td>
                <td class="payment-name">Membayar Biaya Perkemahan</td>
                <td class="payment-rp">Rp.</td>
                <td class="payment-amount">200.000,-</td>
            </tr>
            <tr class="payment-total">
                <td class="payment-label"></td>
                <td class="payment-name"><strong>J u m l a h</strong></td>
                <td class="payment-rp"><strong>Rp.</strong></td>
                <td class="payment-amount"><strong>350.000,-</strong></td>
            </tr>
            <tr>
                <td class="payment-label"></td>
                <td colspan="3" class="terbilang">Terbilang : <em>(Tiga Ratus Lima Puluh Ribu Rupiah)</em></td>
            </tr>
        </table>
        {{-- PAYMENT NOTE --}}
    <div class="payment-note">
        <p>
            Kewajiban keuangan diatas dibayarkan di Kantor <strong>SMK Al-Ghifari Banyuresmi</strong> setiap hari kerja dari 
            jam 08.00–13.00 WIB, mulai hari Rabu, 01 Maret sampai dengan Sabtu, 11 Juli {{ date('Y') }}. Jika sampai 
            tanggal tersebut tidak melaksanakan daftar ulang, tanpa konfirmasi dianggap mengundurkan diri.
        </p>
        <p>
            Demikian pemberitahuan ini kami sampaikan untuk diketahui sebagaimana mestinya.
        </p>
    </div>

    <p class="salam"><em>Wassalamu'alaikum Wr. Wb.</em></p>
    @else
    <div class="content">
        <p>
            Demikian pemberitahuan ini kami sampaikan untuk diketahui sebagaimana mestinya.
        </p>
    </div>
    <p class="salam"><em>Wassalamu'alaikum Wr. Wb.</em></p>
    @endif

    {{-- SIGNATURE SECTION --}}
    <div class="signature-section">
        <table class="signature-table">
            <tr>
                <td class="signature-box signature-left">
                    <br>
                    Mengetahui,<br>
                    Kepala SMK Al-Ghifari Banyuresmi,<br>
                    @php
                        $ttdKepsek = \App\Models\Setting::getValue('ttd_kepala_sekolah');
                    @endphp
                    @if($ttdKepsek)
                    <div style="height: 70px; text-align: center;">
                        <img src="{{ public_path('images/' . $ttdKepsek) }}" style="max-width: 500px; max-height: 100px;" alt="TTD Kepsek">
                    </div>
                    @else
                    <br><br><br><br>
                    @endif
                    <span class="signature-name underline">{{ \App\Models\Setting::getValue('principal_name', '................................') }}</span><br>
                    @if(\App\Models\Setting::getValue('principal_nip'))
                    <span style="font-size: 12pt;">NUKS. {{ \App\Models\Setting::getValue('principal_nip') }}</span>
                    @endif
                </td>
                <td class="signature-box signature-right">
                    Garut, {{ now()->translatedFormat('d F Y') }}<br><br>
                    Ketua Panitia PPDB,<br>
                    @php
                        $ttd = \App\Models\Setting::getValue('ttd_panitia');
                    @endphp
                    @if($ttd)
                    <div style="height: 70px; text-align: center;">
                        <img src="{{ public_path('images/' . $ttd) }}" style="max-width: 500px; max-height: 100px;" alt="TTD">
                    </div>
                    @else
                    <br><br><br><br>
                    @endif
                    <span class="signature-name underline">{{ \App\Models\Setting::getValue('committee_head_name', 'Ketua Panitia') }}</span><br>
                    @if(\App\Models\Setting::getValue('committee_head_nip'))
                    <span style="font-size: 12pt;">NUPTK. {{ \App\Models\Setting::getValue('committee_head_nip') }}</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    @if($pengumuman->status === 'Lulus')
    {{-- NOTES SECTION --}}
    <div class="notes-section">
        <h4 style="color: #990000;">Catatan :</h4>
        <ol>
            <li>Kepada Orangtua/Wali*) Segera melakukan Daftar Ulang sesuai dengan ketentuan</li>
            <li>Bagi Orangtua/wali yang belum bisa membayar biaya daftar ulang secara lunas sampai batas waktu yang ditentukan (Konfirmasi ke pihak Sekolah)</li>
            <li>Bagi Siswa/i yang telah melaksanakan daftar ulang wajib hadir pada pengarahan MPLS hari Sabtu tanggal 12 Juli {{ date('Y') }} Pukul 07.00 WIB Memakai seragam SMP/MTs dan membawa alat tulis.</li>
            <li>Biaya yang telah dibayarkan pada waktu daftar ulang tidak dapat diambil kembali dengan alasan apapun.</li>
            <li>Untuk jurusan TKRO, TBSM, FARMASI Wajib Melengkapi Surat Buta Warna Dokter</li>
        </ol>
    </div>
    @endif

</body>

</html>
