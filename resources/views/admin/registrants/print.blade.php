<!DOCTYPE html>
<html>

<head>
    <title>Bukti Pendaftaran - {{ $registrant->registration_number }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
        }

        /* HEADER */

        .header h1 {
            margin: 0;
            font-size: 18pt;
            font-weight: bold;
        }

        .header h2 {
            margin: 0;
            font-size: 14pt;
            font-weight: bold;
        }

        .header p {
            margin: 0;
            font-size: 10pt;
        }

        /* CONTENT */
        .title {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            text-decoration: underline;
        }

        .number {
            text-align: center;
            margin-bottom: 20px;
        }

        /* DATA TABLE */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .data-table td {
            vertical-align: top;
            padding: 4px;
        }

        .label {
            width: 35%;
        }

        .separator {
            width: 2%;
        }

        .value {
            width: 63%;
            font-weight: bold;
        }

        /* SIGNATURES */
        .signature-section {
            width: 100%;
            margin-top: 50px;
        }

        .signature-table {
            width: 100%;
        }

        .signature-box {
            width: 50%;
            text-align: center;
            vertical-align: top;
        }

        /* NOTES */
        .notes {
            border: 1px solid black;
            padding: 10px;
            margin-top: 20px;
            font-size: 10pt;
        }

        .notes h3 {
            margin-top: 0;
            font-size: 11pt;
        }

        /* UTILS */
        .uppercase {
            text-transform: uppercase;
        }

        .logo-image {
            width: 80px;
            /* Adjust size */
            height: auto;
        }

        /* Use a table for layout because DomPDF hates Flexbox */
        .header-table {
            width: 100%;
            border-bottom: 3px double black;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .logo-cell {
            width: 13%;
            /* Logo takes 15% width */
            vertical-align: middle;
            text-align: left;
        }

        .text-cell {
            width: 87%;
            /* Text takes the rest */
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <table class="header-table">
        <tr>
            <td class="logo-cell">
                <img src="{{ public_path('images/school-logo.jpg') }}" class="logo-image" alt="Logo">
            </td>
            <td class="text-cell header">
                <h1>SMK ROHMATUL UMMAH</h1>
                <h2>PANITIA SISTEM PENERIMAAN MURID BARU (SPMB)</h2>
                <p>Kampung Baladil Amin, Pulutan, Jekulo, Kec. Mejobo</p>
                <p>Kabupaten Kudus, Jawa Tengah</p>
                <p>Telp: {{ \App\Models\Setting::getValue('school_phone', '+62 821-2723-7451') }} | Email:
                    {{ \App\Models\Setting::getValue('school_email', 'info@smkrohmatulummah.sch.id') }}</p>
            </td>
        </tr>
    </table>

    <div class="title">BUKTI PENDAFTARAN PESERTA DIDIK BARU</div>
    <div class="number">Nomor: {{ $registrant->registration_number }}/SPMB/{{ now()->year }}</div>

    <p>Yang bertanda tangan di bawah ini, Panitia Sistem Penerimaan Murid Baru (SPMB) SMK Rohmatul Ummah Tahun Ajaran
        {{ \App\Models\Setting::getValue('academic_year', '2025/2026') }}, dengan ini menerangkan bahwa:</p>

    <table class="data-table">
        <tr>
            <td class="label">Nomor Pendaftaran</td>
            <td class="separator">:</td>
            <td class="value">{{ $registrant->registration_number }}</td>
        </tr>
        <tr>
            <td class="label">Nama Lengkap</td>
            <td class="separator">:</td>
            <td class="value uppercase">{{ $registrant->name }}</td>
        </tr>
        <tr>
            <td class="label">NISN</td>
            <td class="separator">:</td>
            <td class="value">{{ $registrant->nisn ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Tempat, Tanggal Lahir</td>
            <td class="separator">:</td>
            <td class="value uppercase">{{ $registrant->birth_place }}, {{ $registrant->birth_date
            ->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Jenis Kelamin</td>
            <td class="separator">:</td>
            <td class="value">{{ $registrant->gender->label() }}</td>
        </tr>
        <tr>
            <td class="label">Agama</td>
            <td class="separator">:</td>
            <td class="value">{{ $registrant->religion->label() }}</td>
        </tr>
        <tr>
            <td class="label">Alamat</td>
            <td class="separator">:</td>
            <td class="value">{{ $registrant->address?->full_address ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">No. Telepon/HP</td>
            <td class="separator">:</td>
            <td class="value">{{ $registrant->phone ?? $registrant->guardians->first()->phone ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Asal Sekolah</td>
            <td class="separator">:</td>
            <td class="value uppercase">{{ $registrant->academic->school_name ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Jurusan yang Dipilih</td>
            <td class="separator">:</td>
            <td class="value uppercase">{{ $registrant->major->name }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Pendaftaran</td>
            <td class="separator">:</td>
            <td class="value">{{ $registrant->created_at->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Status Pendaftaran</td>
            <td class="separator">:</td>
            <td class="value uppercase">{{ $registrant->status->label() }}</td>
        </tr>
    </table>

    <p>Demikian surat bukti pendaftaran ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>

    <div class="signature-section">
        <table class="signature-table">
            <tr>
                <td class="signature-box">
                    <br>
                    Calon Peserta Didik,
                    <br><br><br><br>
                    <b>{{ $registrant->name }}</b>
                </td>
                <td class="signature-box">
                    Kudus, {{ now()->translatedFormat('d F Y') }}<br>
                    Ketua Panitia SPMB,
                    <br><br><br><br>
                    <b>Drs. H. Ahmad Fauzi, M.Pd</b><br>
                    NIP. 196512301990031005
                </td>
            </tr>
        </table>
    </div>

    <div class="notes">
        <h3>Catatan Penting:</h3>
        <ol>
            <li>Simpan bukti pendaftaran ini dengan baik.</li>
            <li>Bukti ini merupakan tanda bahwa pendaftaran Anda telah tercatat dalam sistem PPDB.</li>
            <li>Cek status pendaftaran secara berkala melalui website sekolah.</li>
        </ol>
    </div>

</body>

</html>
