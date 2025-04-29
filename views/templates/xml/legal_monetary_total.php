<cac:<?= htmlspecialchars($node) ?>>
    <cbc:LineExtensionAmount currencyID="<?= htmlspecialchars($company->type_currencies->code) ?>">
        <?= number_format($legalMonetaryTotals->line_extension_amount, 2, '.', '') ?>
    </cbc:LineExtensionAmount>

    <cbc:TaxExclusiveAmount currencyID="<?= htmlspecialchars($company->type_currencies->code) ?>">
        <?= number_format($legalMonetaryTotals->tax_exclusive_amount, 2, '.', '') ?>
    </cbc:TaxExclusiveAmount>

    <cbc:TaxInclusiveAmount currencyID="<?= htmlspecialchars($company->type_currencies->code) ?>">
        <?= number_format($legalMonetaryTotals->tax_inclusive_amount, 2, '.', '') ?>
    </cbc:TaxInclusiveAmount>

    <?php if ($legalMonetaryTotals->allowance_total_amount): ?>
        <cbc:AllowanceTotalAmount currencyID="<?= htmlspecialchars($company->type_currencies->code) ?>">
            <?= number_format($legalMonetaryTotals->allowance_total_amount, 2, '.', '') ?>
        </cbc:AllowanceTotalAmount>
    <?php endif; ?>

    <?php if ($legalMonetaryTotals->charge_total_amount): ?>
        <cbc:ChargeTotalAmount currencyID="<?= htmlspecialchars($company->type_currencies->code) ?>">
            <?= number_format($legalMonetaryTotals->charge_total_amount, 2, '.', '') ?>
        </cbc:ChargeTotalAmount>
    <?php endif; ?>

    <?php if ($legalMonetaryTotals->pre_paid_amount): ?>
        <cbc:PrePaidAmount currencyID="<?= htmlspecialchars($company->type_currencies->code) ?>">
            <?= number_format($legalMonetaryTotals->pre_paid_amount, 2, '.', '') ?>
        </cbc:PrePaidAmount>
    <?php endif; ?>

    <cbc:PayableAmount currencyID="<?= htmlspecialchars($company->type_currencies->code) ?>">
        <?= number_format($legalMonetaryTotals->payable_amount, 2, '.', '') ?>
    </cbc:PayableAmount>
</cac:<?= htmlspecialchars($node) ?>>
