
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ANG || Interview Card</title>

    <style>
        * {
            box-sizing: border-box;
        }

        @page {
            size: 2.5in 1.7in;
            margin: 0;
        }

        html,
        body {
            width: 2.5in;
            height: 1.7in;
            margin: 0;
            padding: 0;
            background: #fff;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
        }

        .card {
            position: relative;
            width: 2.5in;
            height: 1.7in;
            overflow: hidden;
            background: #fff;
            border: 1px solid #b8bec6;
            padding: 7px 9px 6px;
        }

        .top-accent {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #2563eb;
            z-index: 5;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-25deg);
            font-size: 28px;
            font-weight: 900;
            letter-spacing: 2px;
            color: #2563eb;
            opacity: 0.08;
            white-space: nowrap;
            pointer-events: none;
            user-select: none;
            z-index: 1;
        }

        .header {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 3px;
            padding-bottom: 4px;
            border-bottom: 1px solid #d9dde2;
            text-align: center;
        }

        .brand-info {
            width: 100%;
            line-height: 1.1;
        }

        .company-name {
            font-size: 11px;
            font-weight: 900;
            color: #111827;
            text-transform: uppercase;
            line-height: 1.05;
            letter-spacing: .15px;
        }

        .module-name {
            display: block;
            margin-top: 2px;
            font-size: 6.8px;
            font-weight: 600;
            color: #4b5563;
            line-height: 1;
        }

        .card-title {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 3px 0 2px;
            font-size: 7px;
            font-weight: 900;
            color: #2563eb;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .applicant-section {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 1px 0 3px;
        }

        .applicant-id {
            font-size: 16px;
            font-weight: 900;
            letter-spacing: 1.2px;
            color: #111827;
            line-height: 1;
        }

        .information {
            position: relative;
            z-index: 2;
            border-top: 1px solid #eef0f2;
            padding-top: 2px;
        }

        .info-row {
            display: flex;
            align-items: center;
            min-height: 12px;
            line-height: 1.1;
        }

        .label {
            width: 67px;
            flex: 0 0 67px;
            color: #4b5563;
            font-size: 7.2px;
            font-weight: 700;
        }

        .value {
            flex: 1;
            color: #111827;
            font-size: 7.8px;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .footer {
            position: absolute;
            left: 9px;
            right: 9px;
            bottom: 5px;
            z-index: 2;
            padding-top: 3px;
            border-top: 1px solid #d9dde2;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .footer-title {
            font-size: 7px;
            font-weight: 900;
            color: #2563eb;
            letter-spacing: .4px;
            text-transform: uppercase;
        }

        .date {
            font-size: 6.5px;
            color: #4b5563;
            font-weight: 600;
        }

        @media print {
            html,
            body {
                width: 2.5in;
                height: 1.7in;
                margin: 0;
                padding: 0;
            }

            .card {
                width: 2.5in;
                height: 1.7in;
                margin: 0;
                border: 1px solid #b8bec6;
                page-break-after: avoid;
            }

            .watermark {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>

<div class="card">

    <div class="top-accent"></div>

    <div class="watermark">
        INTERVIEW
    </div>

    <div class="header">
        <div class="brand-info">
            <div class="company-name">
                {{ $applicant->organization->name ?? '-' }}

                <span class="module-name">
                    {{ $applicant->organization->address ?? '-' }}
                </span>
            </div>
        </div>
    </div>

    <div class="card-title">
        Interview Card
    </div>

    <div class="applicant-section">
        <div class="applicant-id">
            {{ $applicant->id }}
        </div>
    </div>

    <div class="information">

        <div class="info-row">
            <div class="label">Name</div>
            <div class="value">
                {{ $applicant->name ?? '-' }}
            </div>
        </div>

        <div class="info-row">
            <div class="label">Name Bangla</div>
            <div class="value">
                {{ $applicant->name_bangla ?? '-' }}
            </div>
        </div>

        <div class="info-row">
            <div class="label">Department</div>
            <div class="value">
                {{ $applicant->department->department ?? '-' }}
            </div>
        </div>

        <div class="info-row">
            <div class="label">Designation</div>
            <div class="value">
                {{ $applicant->designation->designation ?? '-' }}
            </div>
        </div>

        <div class="info-row">
            <div class="label">Mobile</div>
            <div class="value">
                {{ $applicant->mobile ?? '-' }}
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="footer-title">
            Interview Candidate
        </div>

        <div class="date">
            {{ \Carbon\Carbon::now()->format('d M Y') }}
        </div>
    </div>

</div>

<script>
    window.onload = function () {
        setTimeout(function () {
            window.print();
        }, 300);
    };
</script>

</body>
</html>

