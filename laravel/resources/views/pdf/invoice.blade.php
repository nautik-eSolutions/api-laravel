<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Factura NAUTIK</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #1a1a2e;
            background: #ffffff;
            line-height: 1.5;
        }

        .header {
            background-color: #0d1b4b;
            padding: 32px 40px;
            margin-bottom: 0;
        }

        .header-inner {
            width: 100%;
        }

        .header-top {
            display: table;
            width: 100%;
        }

        .header-logo-block {
            display: table-cell;
            vertical-align: middle;
            width: 50%;
        }

        .logo-text {
            font-size: 28px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 4px;
        }

        .logo-tagline {
            font-size: 10px;
            color: #a0aec0;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .header-invoice-block {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 50%;
        }

        .invoice-label {
            font-size: 11px;
            color: #a0aec0;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .invoice-number {
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
            margin-top: 2px;
        }

        .accent-bar {
            height: 4px;
            background-color: #3b82f6;
        }

        .body-wrapper {
            padding: 36px 40px;
        }

        .meta-row {
            display: table;
            width: 100%;
            margin-bottom: 32px;
        }

        .meta-cell {
            display: table-cell;
            vertical-align: top;
            width: 33.33%;
        }

        .meta-label {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #718096;
            margin-bottom: 4px;
        }

        .meta-value {
            font-size: 13px;
            font-weight: 600;
            color: #1a1a2e;
        }

        .badge-paid {
            display: inline-block;
            background-color: #d1fae5;
            color: #065f46;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 20px;
            border: 1px solid #6ee7b7;
        }

        .divider {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 24px 0;
        }

        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 32px;
        }

        .info-col {
            display: table-cell;
            vertical-align: top;
            width: 50%;
            padding-right: 24px;
        }

        .info-col:last-child {
            padding-right: 0;
            padding-left: 24px;
            border-left: 1px solid #e2e8f0;
        }

        .info-section-title {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #3b82f6;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 6px;
        }

        .info-key {
            display: table-cell;
            color: #718096;
            font-size: 11px;
            width: 45%;
        }

        .info-val {
            display: table-cell;
            color: #1a1a2e;
            font-size: 11px;
            font-weight: 600;
        }

        .section-title {
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #3b82f6;
            font-weight: 700;
            margin-bottom: 12px;
        }

        table.items {
            width: 100%;
            border-collapse: collapse;
        }

        table.items thead tr {
            background-color: #0d1b4b;
        }

        table.items thead th {
            color: #ffffff;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 10px 12px;
            text-align: left;
            font-weight: 600;
        }

        table.items thead th:last-child {
            text-align: right;
        }

        table.items tbody tr {
            border-bottom: 1px solid #e2e8f0;
        }

        table.items tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        table.items tbody td {
            padding: 12px 12px;
            font-size: 11px;
            color: #2d3748;
            vertical-align: middle;
        }

        table.items tbody td:last-child {
            text-align: right;
            font-weight: 600;
        }

        .item-name {
            font-weight: 600;
            color: #1a1a2e;
            font-size: 12px;
        }

        .item-sub {
            font-size: 10px;
            color: #718096;
            margin-top: 2px;
        }

        .totals-wrapper {
            margin-top: 20px;
            display: table;
            width: 100%;
        }

        .totals-spacer {
            display: table-cell;
            width: 55%;
        }

        .totals-box {
            display: table-cell;
            width: 45%;
        }

        .totals-row {
            display: table;
            width: 100%;
            padding: 6px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .totals-label {
            display: table-cell;
            font-size: 11px;
            color: #718096;
        }

        .totals-amount {
            display: table-cell;
            font-size: 11px;
            text-align: right;
            color: #2d3748;
            font-weight: 500;
        }

        .totals-row-final {
            display: table;
            width: 100%;
            padding: 10px 0;
            background-color: #0d1b4b;
            margin-top: 4px;
            border-radius: 4px;
        }

        .totals-label-final {
            display: table-cell;
            font-size: 12px;
            color: #ffffff;
            font-weight: 700;
            padding: 0 12px;
        }

        .totals-amount-final {
            display: table-cell;
            font-size: 14px;
            text-align: right;
            color: #ffffff;
            font-weight: 700;
            padding: 0 12px;
        }

        .legal-note {
            margin-top: 32px;
            padding: 16px;
            background-color: #f0f4ff;
            border-left: 3px solid #3b82f6;
            border-radius: 0 4px 4px 0;
        }

        .legal-note p {
            font-size: 10px;
            color: #4a5568;
            line-height: 1.6;
        }

        .footer {
            margin-top: 40px;
            padding-top: 16px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
        }

        .footer p {
            font-size: 9px;
            color: #a0aec0;
            letter-spacing: 0.5px;
        }

        .footer .footer-brand {
            font-size: 11px;
            font-weight: 700;
            color: #0d1b4b;
            letter-spacing: 2px;
            margin-bottom: 4px;
        }
    </style>
</head>
<body>

@php
    $item       = $bookings->first();
    $portName   = $item['mooring']['mooring_category']['zone']['port']['name'] ?? '—';
    $mooringNum = $item['mooring']['number'] ?? '—';

    $basePrice     = round($item['total_cost'] / 1.21, 2);
    $tax           = round($item['total_cost'] - $basePrice, 2);
    $totalPrice    = round($item['total_cost'], 2);

    $startDate     = \Carbon\Carbon::parse($item['start_date']);
    $endDate       = \Carbon\Carbon::parse($item['end_date']);
    $nights        = $startDate->diffInDays($endDate);
    $pricePerNight = $nights > 0 ? round($basePrice / $nights, 2) : $basePrice;
@endphp

<div class="header">
    <div class="header-inner">
        <div class="header-top">
            <div class="header-logo-block">
                <div class="logo-text">NAUTIK</div>
                <div class="logo-tagline">Gestión de amarres · Marina Management</div>
            </div>
            <div class="header-invoice-block">
                <div class="invoice-label">Factura / Invoice</div>
                <div class="invoice-number">#{{ $item['order_number'] ?? '—' }}</div>
            </div>
        </div>
    </div>
</div>
<div class="accent-bar"></div>

<div class="body-wrapper">

    <div class="meta-row">
        <div class="meta-cell">
            <div class="meta-label">Fecha de emisión</div>
            <div class="meta-value">{{ now()->format('d/m/Y') }}</div>
        </div>
        <div class="meta-cell">
            <div class="meta-label">Período de estancia</div>
            <div class="meta-value">
                {{ $startDate->format('d/m/Y') }} al {{ $endDate->format('d/m/Y') }}
                <span style="color:#718096; font-weight:400; font-size:11px;">({{ $nights }} {{ $nights === 1 ? 'noche' : 'noches' }})</span>
            </div>
        </div>
        <div class="meta-cell" style="text-align:right;">
            <div class="meta-label">Estado</div>
            <div><span class="badge-paid">&#10003; Pagado</span></div>
        </div>
    </div>

    <hr class="divider">

    <div class="info-grid">
        <div class="info-col">
            <div class="info-section-title">&#9875; Embarcación</div>
            <div class="info-row">
                <span class="info-key">Nombre</span>
                <span class="info-val">{{ $item['boat']['name'] ?? '—' }}</span>
            </div>
            <div class="info-row">
                <span class="info-key">Amarre asignado</span>
                <span class="info-val">{{ $mooringNum }}</span>
            </div>
        </div>
        <div class="info-col">
            <div class="info-section-title">&#9875; Puerto</div>
            <div class="info-row">
                <span class="info-key">Nombre del puerto</span>
                <span class="info-val">{{ $portName }}</span>
            </div>
            <div class="info-row">
                <span class="info-key">Check-in</span>
                <span class="info-val">{{ $startDate->format('d/m/Y') }}</span>
            </div>
            <div class="info-row">
                <span class="info-key">Check-out</span>
                <span class="info-val">{{ $endDate->format('d/m/Y') }}</span>
            </div>
        </div>
    </div>

    <hr class="divider">

    <div class="section-title">&#9776; Detalle de conceptos</div>
    <table class="items">
        <thead>
        <tr>
            <th style="width:50%;">Concepto</th>
            <th style="width:15%; text-align:center;">Noches</th>
            <th style="width:18%; text-align:right;">Precio/noche</th>
            <th style="width:17%;">Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <div class="item-name">Servicio de amarre</div>
                <div class="item-sub">{{ $portName }} · Amarre {{ $mooringNum }}</div>
            </td>
            <td style="text-align:center;">{{ $nights }}</td>
            <td style="text-align:right;">{{ number_format($pricePerNight, 2, ',', '.') }} €</td>
            <td>{{ number_format($basePrice, 2, ',', '.') }} €</td>
        </tr>
        </tbody>
    </table>

    <div class="totals-wrapper">
        <div class="totals-spacer"></div>
        <div class="totals-box">
            <div class="totals-row">
                <span class="totals-label">Base imponible</span>
                <span class="totals-amount">{{ number_format($basePrice, 2, ',', '.') }} €</span>
            </div>
            <div class="totals-row">
                <span class="totals-label">IVA (21%)</span>
                <span class="totals-amount">{{ number_format($tax, 2, ',', '.') }} €</span>
            </div>
            <div class="totals-row-final">
                <span class="totals-label-final">TOTAL</span>
                <span class="totals-amount-final">{{ number_format($totalPrice, 2, ',', '.') }} €</span>
            </div>
        </div>
    </div>

    <div class="legal-note">
        <p>
            Este documento tiene carácter de factura y acredita el pago completo del servicio de amarre descrito.
            Conserve este documento para cualquier reclamación o consulta futura.
            En caso de incidencia, contacte con la administración del puerto o con el soporte de NAUTIK.
        </p>
    </div>

    <div class="footer">
        <p class="footer-brand">NAUTIK</p>
        <p>www.nautik.app · soporte@nautik.app</p>
        <p style="margin-top:4px;">Documento generado automáticamente el {{ now()->format('d/m/Y \a \l\a\s H:i') }} · Factura nº {{ $item['order_number'] ?? '—' }}</p>
    </div>

</div>

</body>
</html>