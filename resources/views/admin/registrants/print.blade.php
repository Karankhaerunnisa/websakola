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
            margin-bottom: 0px;
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
            padding: 3px;
        }

        .label {
            width: 35%;
        }

        .separator {
            width: 2%;
        }

        .value {
            width: 43%;
        }

        /* SIGNATURES */
        .signature-section {
            width: 100%;
            margin-top: 10px;
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
            padding: 8px;
        }

        .pending {
            border: 1px transparent;
            background-color: #FEF9C3;
            color: #b7791f;
        }

        .verified {
            border: 1px transparent;
            background-color: #DBEAFE;
            color: #1A56DB;
        }

        .accepted {
            border: 1px transparent;
            background-color: #DCFCE7;
            color: #2f855a;
        }

        .rejected {
            border: 1px transparent;
            background-color: #fff5f5;
            color: #c53030;
        }

        /* UTILS */
        .uppercase {
            font-weight: bold;
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

        .kop-image {
            width: 100%;
            height: auto;
            display: block;
            border-bottom: 2px double black;
            margin-bottom: 20px;
        }

        .footer {
            font-size: 10pt;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    @if($kop = \App\Models\Setting::getValue('document_header'))
    <img src="{{ public_path('images/' . $kop) }}" class="kop-image" alt="Kop Surat">
    @else
    <table class="header-table">
        <tr>
            <td class="logo-cell">
                <img src="{{ public_path('images/' . \App\Models\Setting::getValue('app_logo', 'default.png')) }}"
                    class="logo-image" alt="Logo">
            </td>
            <td class="text-cell header">
                <h1>{{ \App\Models\Setting::getValue('school_name', 'SMK DEFAULT') }}</h1>
                <h2>PANITIA SISTEM PENERIMAAN MURID BARU (SPMB)</h2>
                <p>{{ \App\Models\Setting::getValue('school_address') }}</p>
                <p>Telp: {{ \App\Models\Setting::getValue('school_phone') }} | Email: {{
                    \App\Models\Setting::getValue('school_email') }}</p>
            </td>
        </tr>
    </table>
    @endif

    <div class="title">BUKTI PENDAFTARAN PESERTA DIDIK BARU</div>
    <div class="number">Nomor: {{ $registrant->registration_number }}/SPMB/{{ now()->year }}</div>

    <p>Yang bertanda tangan di bawah ini, Panitia Sistem Penerimaan Murid Baru (SPMB) SMK AL-GHIFARI BANYURESMI Tahun Ajaran
        {{ \App\Models\Setting::getValue('academic_year', '2025/2026') }}, dengan ini menerangkan bahwa:</p>

    <table class="data-table">
        <tr>
            <td class="label">Nomor Pendaftaran</td>
            <td class="separator">:</td>
            <td class="value uppercase">{{ $registrant->registration_number }}</td>
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
            <td class="value">{{ $registrant->birth_place }}, {{ $registrant->birth_date
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
            <td class="value">{{ $registrant->academic->school_name ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Jurusan yang Dipilih</td>
            <td class="separator">:</td>
            <td class="value">{{ $registrant->major->name }}</td>
        </tr>
        <tr>
            <td class="label">Jalur Pendaftaran</td>
            <td class="separator">:</td>
            <td class="">{{ $registrant->registration_path == 'prestasi' ? 'Prestasi' : 'Umum' }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Pendaftaran</td>
            <td class="separator">:</td>
            <td class="value">{{ $registrant->created_at->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Status Pendaftaran</td>
            <td class="separator">:</td>
            <td class="value uppercase"><span class="notes {{ $registrant->status->value }}">{{ $registrant->status->label() }}</span></td>
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
                    Garut, {{ now()->translatedFormat('d F Y') }}<br>
                    Ketua Panitia SPMB,
                    <br><br><br><br>
                    <b>{{ \App\Models\Setting::getValue('committee_head_name') }}</b><br>
                    NUPTK. {{ \App\Models\Setting::getValue('committee_head_nip') }}
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <ol>
            <li>Simpan bukti pendaftaran ini dengan baik.</li>
            <li>Bukti ini merupakan tanda bahwa pendaftaran Anda telah tercatat dalam SPMB.</li>
        </ol>
    </div>

</body>

</html>
