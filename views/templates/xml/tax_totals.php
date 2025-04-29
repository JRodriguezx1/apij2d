<?php foreach ($taxTotals as $key => $taxTotal): ?>
    <cac:TaxTotal>
        <cbc:TaxAmount currencyID="<?= htmlspecialchars($company->type_currencies->code) ?>">
            <?= number_format($taxTotal->tax_amount, 2, '.', '') ?>
        </cbc:TaxAmount>
        <cac:TaxSubtotal>
            <?php if (!$taxTotal->is_fixed_value): ?>
                <cbc:TaxableAmount currencyID="<?= htmlspecialchars($company->type_currencies->code) ?>">
                    <?= number_format($taxTotal->taxable_amount, 2, '.', '') ?>
                </cbc:TaxableAmount>
            <?php endif; ?>

            <cbc:TaxAmount currencyID="<?= htmlspecialchars($company->type_currencies->code) ?>">
                <?= number_format($taxTotal->tax_amount, 2, '.', '') ?>
            </cbc:TaxAmount>

            <?php if ($taxTotal->is_fixed_value): ?>
                <cbc:BaseUnitMeasure unitCode="<?= htmlspecialchars($taxTotal->unit_measure->code) ?>">
                    <?= number_format($taxTotal->base_unit_measure, 6, '.', '') ?>
                </cbc:BaseUnitMeasure>
                <cbc:PerUnitAmount currencyID="<?= htmlspecialchars($company->type_currencies->code) ?>">
                    <?= number_format($taxTotal->per_unit_amount, 2, '.', '') ?>
                </cbc:PerUnitAmount>
            <?php endif; ?>

            <cac:TaxCategory>
                <?php if (!$taxTotal->is_fixed_value): ?>
                    <cbc:Percent><?= number_format($taxTotal->percent, 2, '.', '') ?></cbc:Percent>
                <?php endif; ?>

                <cac:TaxScheme>
                    <cbc:ID><?= htmlspecialchars($taxTotal->tax->code) ?></cbc:ID>
                    <cbc:Name><?= htmlspecialchars($taxTotal->tax->name) ?></cbc:Name>
                </cac:TaxScheme>
            </cac:TaxCategory>
        </cac:TaxSubtotal>
    </cac:TaxTotal>
<?php endforeach; ?>
